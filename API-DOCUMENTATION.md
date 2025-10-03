# API Documentation - Aula Virtual Laravel

## OpenRouter Integration API

Esta API permite integrar modelos de IA de OpenRouter en el sistema Aula Virtual Laravel.

### Configuración

Agregar las siguientes variables al archivo `.env`:

```env
OPENROUTER_API_KEY=tu_api_key_aqui
OPENROUTER_BASE_URL=https://openrouter.ai/api/v1
OPENROUTER_DEFAULT_MODEL=meta-llama/llama-3.1-8b-instruct:free
```

### Endpoints

#### 1. Chat con IA

**POST** `/api/openrouter/chat`

Envía un mensaje al modelo de IA y recibe una respuesta.

**Parámetros:**
```json
{
    "message": "string (requerido, máx 4000 caracteres)",
    "model": "string (opcional, modelo por defecto: meta-llama/llama-3.1-8b-instruct:free)",
    "user_id": "integer (requerido, ID del usuario)",
    "context": "string (opcional, contexto del sistema)"
}
```

**Respuesta exitosa:**
```json
{
    "success": true,
    "data": {
        "response": "Respuesta del modelo de IA",
        "model": "modelo_usado",
        "usage": {
            "prompt_tokens": 100,
            "completion_tokens": 50,
            "total_tokens": 150
        }
    }
}
```

**Ejemplo de uso:**
```bash
curl -X POST http://localhost:8000/api/openrouter/chat \
  -H "Content-Type: application/json" \
  -H "X-CSRF-TOKEN: tu_token_csrf" \
  -d '{
    "message": "¿Cómo puedo mejorar mis notas en matemáticas?",
    "user_id": 1,
    "context": "Eres un asistente educativo del Aula Virtual."
  }'
```

#### 2. Completar Texto

**POST** `/api/openrouter/completion`

Completa un texto usando el modelo de IA.

**Parámetros:**
```json
{
    "prompt": "string (requerido, máx 4000 caracteres)",
    "model": "string (opcional)",
    "max_tokens": "integer (opcional, máx 4000, por defecto: 500)"
}
```

**Respuesta:**
```json
{
    "success": true,
    "data": {
        "content": "Texto completado por la IA",
        "usage": {
            "prompt_tokens": 50,
            "completion_tokens": 100,
            "total_tokens": 150
        }
    }
}
```

#### 3. Obtener Modelos Disponibles

**GET** `/api/openrouter/models`

Obtiene la lista de modelos disponibles en OpenRouter.

**Respuesta:**
```json
{
    "success": true,
    "data": {
        "data": [
            {
                "id": "meta-llama/llama-3.1-8b-instruct:free",
                "name": "Llama 3.1 8B Instruct (Free)",
                "context_length": 8192,
                "pricing": {
                    "prompt": "0",
                    "completion": "0"
                }
            }
        ]
    }
}
```

#### 4. Chat con Streaming

**POST** `/api/openrouter/stream`

Chat con respuesta en streaming (tiempo real).

**Parámetros:**
```json
{
    "message": "string (requerido)",
    "model": "string (opcional)",
    "user_id": "integer (requerido)"
}
```

### Chat del Aula Virtual

#### 5. Enviar Mensaje

**POST** `/api/chat/send`

Alias para el endpoint de chat principal.

#### 6. Obtener Historial de Chat

**GET** `/api/chat/history/{user_id}`

Obtiene el historial de conversaciones de un usuario.

**Respuesta:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "role": "user",
            "content": "Mensaje del usuario",
            "created_at": "2024-01-01T12:00:00.000000Z"
        },
        {
            "id": 2,
            "user_id": 1,
            "role": "assistant",
            "content": "Respuesta de la IA",
            "created_at": "2024-01-01T12:01:00.000000Z"
        }
    ]
}
```

#### 7. Limpiar Historial

**DELETE** `/api/chat/clear/{user_id}`

Elimina todo el historial de chat de un usuario.

**Respuesta:**
```json
{
    "success": true,
    "message": "Historial limpiado exitosamente"
}
```

### Modelos Recomendados

#### Modelos Gratuitos:
- `meta-llama/llama-3.1-8b-instruct:free` - Llama 3.1 8B (Recomendado)
- `microsoft/phi-3-mini-128k-instruct:free` - Phi-3 Mini
- `google/gemma-2-9b-it:free` - Gemma 2 9B

#### Modelos de Pago:
- `meta-llama/llama-3.1-70b-instruct` - Llama 3.1 70B
- `openai/gpt-3.5-turbo` - GPT-3.5 Turbo
- `openai/gpt-4` - GPT-4
- `anthropic/claude-3-haiku` - Claude 3 Haiku
- `anthropic/claude-3-sonnet` - Claude 3 Sonnet

### Características

- ✅ **Historial de conversaciones** persistente
- ✅ **Múltiples modelos** de IA disponibles
- ✅ **Streaming** en tiempo real
- ✅ **Cache** de modelos disponibles
- ✅ **Validación** de entrada
- ✅ **Manejo de errores** robusto
- ✅ **Logging** completo
- ✅ **Rate limiting** (configurable)
- ✅ **Contexto personalizable** por usuario

### Interfaz Web

Accede a la interfaz web del chat en: `/chat`

Características de la interfaz:
- Chat en tiempo real
- Selección de modelos
- Sugerencias de preguntas
- Historial persistente
- Indicadores de escritura
- Formateo de mensajes (markdown básico)

### Seguridad

- Validación de entrada en todos los endpoints
- Límites de caracteres por mensaje
- Autenticación requerida (configurable)
- Rate limiting para prevenir abuso
- Logging de todas las interacciones

### Ejemplos de Uso

#### JavaScript (Frontend)
```javascript
// Enviar mensaje
const response = await fetch('/api/openrouter/chat', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
    },
    body: JSON.stringify({
        message: '¿Cómo estudiar mejor?',
        user_id: 1,
        context: 'Eres un tutor educativo.'
    })
});

const data = await response.json();
console.log(data.data.response);
```

#### PHP (Backend)
```php
use Illuminate\Support\Facades\Http;

$response = Http::post('/api/openrouter/chat', [
    'message' => 'Explica el teorema de Pitágoras',
    'user_id' => auth()->id(),
    'model' => 'meta-llama/llama-3.1-8b-instruct:free'
]);

if ($response->successful()) {
    $data = $response->json();
    echo $data['data']['response'];
}
```

### Troubleshooting

#### Error: "API key not found"
- Verificar que `OPENROUTER_API_KEY` esté configurado en `.env`
- Reiniciar el servidor después de cambiar variables de entorno

#### Error: "Model not found"
- Verificar que el modelo existe en OpenRouter
- Usar el endpoint `/api/openrouter/models` para ver modelos disponibles

#### Error: "Rate limit exceeded"
- Implementar delays entre requests
- Considerar usar un modelo gratuito si se alcanza el límite

#### Error: "Connection timeout"
- Verificar conexión a internet
- Aumentar timeout en la configuración de HTTP client
