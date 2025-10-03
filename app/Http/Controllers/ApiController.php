<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Models\ChatHistory;

class ApiController extends Controller
{
    private $openRouterApiKey;
    private $openRouterBaseUrl = 'https://openrouter.ai/api/v1';

    public function __construct()
    {
        $this->openRouterApiKey = config('services.openrouter.api_key');
    }

    /**
     * Enviar mensaje al chat de OpenRouter
     */
    public function chat(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'message' => 'required|string|max:4000',
                'user_id' => 'required|integer|exists:usuarios,id',
                'context' => 'nullable|string'
            ]);

            $model = config('services.openrouter.default_model', 'qwen/qwen-2.5-72b-instruct:free');
            $message = $request->input('message');
            $userId = $request->input('user_id');
            $context = $request->input('context', 'Eres un asistente educativo del Aula Virtual. Ayuda a estudiantes y profesores con preguntas académicas.');

            // Obtener historial del chat
            $chatHistory = ChatHistory::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get()
                ->reverse();

            // Construir mensajes para la API
            $messages = [
                [
                    'role' => 'system',
                    'content' => $context
                ]
            ];

            // Agregar historial
            foreach ($chatHistory as $history) {
                $messages[] = [
                    'role' => $history->role,
                    'content' => $history->content
                ];
            }

            // Agregar mensaje actual
            $messages[] = [
                'role' => 'user',
                'content' => $message
            ];

            // Llamar a OpenRouter
            $response = $this->callOpenRouter($model, $messages);

            if ($response['success']) {
                // Guardar en historial
                ChatHistory::create([
                    'user_id' => $userId,
                    'role' => 'user',
                    'content' => $message
                ]);

                ChatHistory::create([
                    'user_id' => $userId,
                    'role' => 'assistant',
                    'content' => $response['data']['content']
                ]);

                return response()->json([
                    'success' => true,
                    'data' => [
                        'response' => $response['data']['content'],
                        'model' => $model,
                        'usage' => $response['data']['usage'] ?? null
                    ]
                ]);
            }

            return response()->json([
                'success' => false,
                'error' => $response['error']
            ], 500);

        } catch (\Exception $e) {
            Log::error('Error en chat API: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Completar texto usando OpenRouter
     */
    public function completion(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'prompt' => 'required|string|max:4000',
                'max_tokens' => 'nullable|integer|min:1|max:4000'
            ]);

            $model = config('services.openrouter.default_model', 'qwen/qwen-2.5-72b-instruct:free');
            $prompt = $request->input('prompt');
            $maxTokens = $request->input('max_tokens', 500);

            $messages = [
                [
                    'role' => 'user',
                    'content' => $prompt
                ]
            ];

            $response = $this->callOpenRouter($model, $messages, $maxTokens);

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error('Error en completion API: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Obtener modelos disponibles de OpenRouter
     */
    public function getModels(): JsonResponse
    {
        try {
            // Cache por 1 hora
            $models = Cache::remember('openrouter_models', 3600, function () {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $this->openRouterApiKey,
                    'Content-Type' => 'application/json'
                ])->get($this->openRouterBaseUrl . '/models');

                if ($response->successful()) {
                    return $response->json();
                }

                return null;
            });

            if ($models) {
                return response()->json([
                    'success' => true,
                    'data' => $models
                ]);
            }

            return response()->json([
                'success' => false,
                'error' => 'No se pudieron obtener los modelos'
            ], 500);

        } catch (\Exception $e) {
            Log::error('Error obteniendo modelos: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Chat con streaming
     */
    public function streamChat(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'message' => 'required|string|max:4000',
                'user_id' => 'required|integer|exists:usuarios,id'
            ]);

            $model = config('services.openrouter.default_model', 'qwen/qwen-2.5-72b-instruct:free');
            $message = $request->input('message');
            $userId = $request->input('user_id');

            $messages = [
                [
                    'role' => 'system',
                    'content' => 'Eres un asistente educativo del Aula Virtual.'
                ],
                [
                    'role' => 'user',
                    'content' => $message
                ]
            ];

            $response = $this->callOpenRouterStream($model, $messages);

            return response()->json($response);

        } catch (\Exception $e) {
            Log::error('Error en stream chat: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Enviar mensaje (alias para chat)
     */
    public function sendMessage(Request $request): JsonResponse
    {
        return $this->chat($request);
    }

    /**
     * Obtener historial de chat
     */
    public function getChatHistory(Request $request, $userId): JsonResponse
    {
        try {
            $history = ChatHistory::where('user_id', $userId)
                ->orderBy('created_at', 'desc')
                ->limit(50)
                ->get()
                ->reverse()
                ->values();

            return response()->json([
                'success' => true,
                'data' => $history
            ]);

        } catch (\Exception $e) {
            Log::error('Error obteniendo historial: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Limpiar historial de chat
     */
    public function clearChatHistory(Request $request, $userId): JsonResponse
    {
        try {
            ChatHistory::where('user_id', $userId)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Historial limpiado exitosamente'
            ]);

        } catch (\Exception $e) {
            Log::error('Error limpiando historial: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Error interno del servidor'
            ], 500);
        }
    }

    /**
     * Llamar a la API de OpenRouter
     */
    private function callOpenRouter(string $model, array $messages, int $maxTokens = 1000): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->openRouterApiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url'),
                'X-Title' => 'Aula Virtual Laravel'
            ])->timeout(60)->post($this->openRouterBaseUrl . '/chat/completions', [
                'model' => $model,
                'messages' => $messages,
                'max_tokens' => $maxTokens,
                'temperature' => 0.7,
                'top_p' => 1,
                'frequency_penalty' => 0,
                'presence_penalty' => 0
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => true,
                    'data' => [
                        'content' => $data['choices'][0]['message']['content'] ?? '',
                        'usage' => $data['usage'] ?? null
                    ]
                ];
            }

            return [
                'success' => false,
                'error' => 'Error en la API de OpenRouter: ' . $response->body()
            ];

        } catch (\Exception $e) {
            Log::error('Error llamando OpenRouter: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => 'Error de conexión con OpenRouter'
            ];
        }
    }

    /**
     * Llamar a OpenRouter con streaming
     */
    private function callOpenRouterStream(string $model, array $messages): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->openRouterApiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url'),
                'X-Title' => 'Aula Virtual Laravel'
            ])->timeout(60)->post($this->openRouterBaseUrl . '/chat/completions', [
                'model' => $model,
                'messages' => $messages,
                'max_tokens' => 1000,
                'temperature' => 0.7,
                'stream' => true
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => [
                        'stream' => $response->body()
                    ]
                ];
            }

            return [
                'success' => false,
                'error' => 'Error en streaming de OpenRouter'
            ];

        } catch (\Exception $e) {
            Log::error('Error en streaming OpenRouter: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => 'Error de conexión con OpenRouter'
            ];
        }
    }
}
