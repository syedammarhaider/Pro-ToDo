// Message System - Single source for all popup messages
(() => {
    // Check if message container exists, if not create it
    let messageContainer = document.getElementById('messageContainer');
    if (!messageContainer) {
        messageContainer = document.createElement('div');
        messageContainer.id = 'messageContainer';
        messageContainer.className = 'message-container';
        messageContainer.setAttribute('aria-live', 'assertive');
        messageContainer.setAttribute('aria-atomic', 'true');
        messageContainer.setAttribute('aria-relevant', 'additions');
        document.body.appendChild(messageContainer);
    }

    // Show message function
    window.showMessage = function(text, type = 'info', duration = 2000) {
        if (!messageContainer) return;
        
        const icons = {
            success: 'fas fa-check-circle',
            error: 'fas fa-exclamation-circle',
            warning: 'fas fa-exclamation-triangle',
            info: 'fas fa-info-circle'
        };
        
        const messageId = 'msg-' + Date.now();
        const message = document.createElement('div');
        message.className = `message ${type}`;
        message.id = messageId;
        
        message.innerHTML = `
            <div class="message-content">
                <div class="message-icon"><i class="${icons[type]}"></i></div>
                <div class="message-text">
                    <h5>${type.charAt(0).toUpperCase() + type.slice(1)}</h5>
                    <p>${text}</p>
                </div>
            </div>
            <button class="message-close" aria-label="Close message" onclick="removeMessage('${messageId}')">
                <i class="fas fa-times"></i>
            </button>
        `;
        
        messageContainer.appendChild(message);
        
        // Trigger animation
        setTimeout(() => message.classList.add('show'), 10);
        
        // Auto-remove after duration
        if (duration > 0) {
            setTimeout(() => removeMessage(messageId), duration);
        }
    };

    // Remove message function
    window.removeMessage = function(id) {
        const message = document.getElementById(id);
        if (!message) return;
        
        message.classList.remove('show');
        setTimeout(() => {
            if (message.parentNode) {
                message.parentNode.removeChild(message);
            }
        }, 500);
    };

    // Initialize message system
    console.log('Message system initialized');
})();
