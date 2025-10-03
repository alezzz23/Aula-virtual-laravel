@extends('layouts.app')

@section('title', 'Chat IA - Asistente Educativo')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <i class="fas fa-robot"></i> Chat IA - Asistente Educativo
        </h1>
        <div class="d-flex gap-2">
            <span class="badge bg-info fs-6">
                <i class="fas fa-brain"></i> Qwen3 235B A22B
            </span>
            <button id="clearChat" class="btn btn-outline-danger">
                <i class="fas fa-trash"></i> Limpiar Chat
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Chat Container -->
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-comments"></i> Conversación
                    </h5>
                </div>
                <div class="card-body" style="height: 500px; overflow-y: auto;" id="chatContainer">
                    <div class="text-center text-muted">
                        <i class="fas fa-robot fa-3x mb-3"></i>
                        <p>¡Hola! Soy tu asistente educativo. ¿En qué puedo ayudarte hoy?</p>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <input type="text" class="form-control" id="messageInput" 
                               placeholder="Escribe tu pregunta aquí..." maxlength="4000">
                        <button class="btn btn-primary" id="sendButton" type="button">
                            <i class="fas fa-paper-plane"></i> Enviar
                        </button>
                    </div>
                    <small class="text-muted">
                        Presiona Enter para enviar. Máximo 4000 caracteres.
                    </small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Información del Usuario -->
            <div class="card mb-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-user"></i> Información
                    </h6>
                </div>
                <div class="card-body">
                    <p><strong>Usuario:</strong> {{ auth()->user()->namefull }}</p>
                    <p><strong>Rol:</strong> {{ auth()->user()->role->nombre ?? 'Sin rol' }}</p>
                    <p><strong>Sección:</strong> {{ auth()->user()->curso->seccion ?? 'Sin sección' }}</p>
                </div>
            </div>

            <!-- Sugerencias -->
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-lightbulb"></i> Preguntas Sugeridas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary btn-sm suggestion-btn" 
                                data-suggestion="¿Cómo puedo mejorar mis notas en matemáticas?">
                            <i class="fas fa-calculator"></i> Ayuda con Matemáticas
                        </button>
                        <button class="btn btn-outline-success btn-sm suggestion-btn" 
                                data-suggestion="Explícame el tema de la clase de hoy">
                            <i class="fas fa-book"></i> Explicar Tema
                        </button>
                        <button class="btn btn-outline-info btn-sm suggestion-btn" 
                                data-suggestion="¿Cómo organizar mejor mi tiempo de estudio?">
                            <i class="fas fa-clock"></i> Técnicas de Estudio
                        </button>
                        <button class="btn btn-outline-warning btn-sm suggestion-btn" 
                                data-suggestion="Ayúdame a crear un resumen de mi materia">
                            <i class="fas fa-file-alt"></i> Crear Resumen
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatContainer = document.getElementById('chatContainer');
    const messageInput = document.getElementById('messageInput');
    const sendButton = document.getElementById('sendButton');
    const clearChatButton = document.getElementById('clearChat');
    const suggestionButtons = document.querySelectorAll('.suggestion-btn');

    let isLoading = false;

    // Cargar historial del chat
    loadChatHistory();

    // Enviar mensaje
    function sendMessage() {
        const message = messageInput.value.trim();
        if (!message || isLoading) return;
        
        // Agregar mensaje del usuario al chat
        addMessageToChat('user', message);
        messageInput.value = '';
        
        // Mostrar indicador de carga
        showTypingIndicator();

        // Enviar a la API
        fetch('/api/openrouter/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                message: message,
                user_id: {{ auth()->user()->id }},
                context: 'Eres un asistente educativo del Aula Virtual. Ayuda a estudiantes y profesores con preguntas académicas, explicaciones de temas, técnicas de estudio, y cualquier consulta relacionada con la educación.'
            })
        })
        .then(response => response.json())
        .then(data => {
            hideTypingIndicator();
            
            if (data.success) {
                addMessageToChat('assistant', data.data.response);
            } else {
                addMessageToChat('system', 'Error: ' + data.error);
            }
        })
        .catch(error => {
            hideTypingIndicator();
            addMessageToChat('system', 'Error de conexión. Por favor, intenta de nuevo.');
            console.error('Error:', error);
        });
    }

    // Agregar mensaje al chat
    function addMessageToChat(role, content) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `mb-3 ${role === 'user' ? 'text-end' : 'text-start'}`;
        
        const messageContent = document.createElement('div');
        messageContent.className = `d-inline-block p-3 rounded ${
            role === 'user' ? 'bg-primary text-white' : 
            role === 'assistant' ? 'bg-light border' : 'bg-warning text-dark'
        }`;
        messageContent.style.maxWidth = '80%';
        
        const roleIcon = role === 'user' ? 'fas fa-user' : 
                        role === 'assistant' ? 'fas fa-robot' : 'fas fa-exclamation-triangle';
        
        messageContent.innerHTML = `
            <div class="d-flex align-items-start">
                <i class="${roleIcon} me-2 mt-1"></i>
                <div class="flex-grow-1">
                    <div class="message-content">${formatMessage(content)}</div>
                    <small class="text-muted">${new Date().toLocaleTimeString()}</small>
                </div>
            </div>
        `;
        
        messageDiv.appendChild(messageContent);
        chatContainer.appendChild(messageDiv);
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Formatear mensaje (markdown básico)
    function formatMessage(content) {
        return content
            .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
            .replace(/\*(.*?)\*/g, '<em>$1</em>')
            .replace(/\n/g, '<br>')
            .replace(/`(.*?)`/g, '<code>$1</code>');
    }

    // Mostrar indicador de escritura
    function showTypingIndicator() {
        isLoading = true;
        sendButton.disabled = true;
        
        const typingDiv = document.createElement('div');
        typingDiv.id = 'typingIndicator';
        typingDiv.className = 'mb-3 text-start';
        
        const typingContent = document.createElement('div');
        typingContent.className = 'd-inline-block p-3 rounded bg-light border';
        typingContent.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-robot me-2"></i>
                <div class="typing-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        `;
        
        typingDiv.appendChild(typingContent);
        chatContainer.appendChild(typingDiv);
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Ocultar indicador de escritura
    function hideTypingIndicator() {
        isLoading = false;
        sendButton.disabled = false;
        
        const typingIndicator = document.getElementById('typingIndicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }

    // Cargar historial del chat
    function loadChatHistory() {
        fetch(`/api/chat/history/{{ auth()->user()->id }}`)
        .then(response => response.json())
        .then(data => {
            if (data.success && data.data.length > 0) {
                chatContainer.innerHTML = '';
                data.data.forEach(message => {
                    addMessageToChat(message.role, message.content);
                });
            }
        })
        .catch(error => {
            console.error('Error cargando historial:', error);
        });
    }

    // Limpiar chat
    function clearChat() {
        if (confirm('¿Estás seguro de que quieres limpiar todo el historial del chat?')) {
            fetch(`/api/chat/clear/{{ auth()->user()->id }}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    chatContainer.innerHTML = `
                        <div class="text-center text-muted">
                            <i class="fas fa-robot fa-3x mb-3"></i>
                            <p>¡Hola! Soy tu asistente educativo. ¿En qué puedo ayudarte hoy?</p>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error limpiando chat:', error);
            });
        }
    }

    // Event listeners
    sendButton.addEventListener('click', sendMessage);
    clearChatButton.addEventListener('click', clearChat);
    
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    // Sugerencias
    suggestionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const suggestion = this.getAttribute('data-suggestion');
            messageInput.value = suggestion;
            messageInput.focus();
        });
    });
});
</script>

<style>
.typing-dots {
    display: inline-flex;
    align-items: center;
}

.typing-dots span {
    height: 8px;
    width: 8px;
    background-color: #6c757d;
    border-radius: 50%;
    display: inline-block;
    margin: 0 2px;
    animation: typing 1.4s infinite ease-in-out;
}

.typing-dots span:nth-child(1) {
    animation-delay: -0.32s;
}

.typing-dots span:nth-child(2) {
    animation-delay: -0.16s;
}

@keyframes typing {
    0%, 80%, 100% {
        transform: scale(0);
        opacity: 0.5;
    }
    40% {
        transform: scale(1);
        opacity: 1;
    }
}

.message-content {
    word-wrap: break-word;
}

.suggestion-btn {
    text-align: left;
    white-space: normal;
    height: auto;
    padding: 8px 12px;
}
</style>
@endpush
@endsection
