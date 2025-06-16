<?= $this->extend('layout/TemplateApoteker'); ?>
<?= $this->section('content'); ?>

<style>
    body {
        background-color: #f5f7fb;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
        max-width: 800px;
        margin: 2rem auto;
        background-color: #ffffff;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }

    .page-title {
        text-align: center;
        font-size: 2rem;
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }

    .chat-container {
        display: flex;
        flex-direction: column;
        height: 500px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e0e0e0;
    }

    .chat-messages {
        flex-grow: 1;
        padding: 1rem;
        overflow-y: auto;
        background-color: #f9fafb;
    }

    .chat-input-container {
        display: flex;
        align-items: center;
        padding: 0.8rem 1rem;
        background-color: #fff;
        border-top: 1px solid #e0e0e0;
    }

    .chat-input {
        flex: 1;
        border: none;
        outline: none;
        padding: 0.6rem 1rem;
        font-size: 1rem;
        border-radius: 20px;
        background-color: #f0f2f5;
        resize: none;
        max-height: 100px;
    }

    .send-btn {
        background-color: #3498db;
        border: none;
        color: white;
        padding: 0.5rem 1rem;
        margin-left: 0.5rem;
        border-radius: 20px;
        cursor: pointer;
        font-size: 1.2rem;
        transition: background 0.3s;
    }

    .send-btn:hover {
        background-color: #2980b9;
    }

    .message {
        display: flex;
        margin-bottom: 1rem;
        align-items: flex-end;
        animation: fadeIn 0.3s ease-in-out;
    }

    .message.user {
        justify-content: flex-end;
    }

    .message.admin {
        justify-content: flex-start;
    }

    .message-avatar {
        width: 32px;
        height: 32px;
        background-color: #ccc;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin: 0 0.5rem;
    }

    .message-bubble {
        max-width: 70%;
        padding: 0.7rem 1rem;
        border-radius: 20px;
        background-color: #ecf0f1;
        position: relative;
        font-size: 0.95rem;
        line-height: 1.4;
    }

    .message.user .message-bubble {
        background-color: #d1ecf1;
        color: #0c5460;
        border-bottom-right-radius: 0;
    }

    .message.admin .message-bubble {
        background-color: #eaf2ff;
        color: #1b1b1b;
        border-bottom-left-radius: 0;
    }

    .welcome-message {
        text-align: center;
        color: #666;
        margin-bottom: 1rem;
    }

    .typing-indicator {
        display: none;
        align-items: center;
        padding-left: 1rem;
        background-color: #fff;
        border-top: 1px solid #e0e0e0;
    }

    .typing-dots {
        display: flex;
        margin-left: 8px;
    }

    .typing-dot {
        width: 6px;
        height: 6px;
        background-color: #aaa;
        border-radius: 50%;
        margin: 0 2px;
        animation: blink 1.2s infinite;
    }

    .typing-dot:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-dot:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes blink {
        0%, 80%, 100% { opacity: 0; }
        40% { opacity: 1; }
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

</style>

<div class="container">
    <h1 class="page-title">Bantuan Konsultasi</h1>

    <div class="chat-container">
        <div class="chat-messages" id="chatMessages">
            <div class="welcome-message">👋 Halo Apoteker, ada yang bisa kami bantu hari ini?</div>
        </div>

        <div class="typing-indicator" id="typingIndicator">
            <div class="message-avatar">🤖</div>
            <span>Admin sedang mengetik</span>
            <div class="typing-dots">
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
                <div class="typing-dot"></div>
            </div>
        </div>

        <div class="chat-input-container">
            <textarea 
                class="chat-input" 
                id="chatInput" 
                placeholder="Ketik pesan Anda di sini..."
                rows="1"
            ></textarea>
            <button class="send-btn" id="sendBtn" onclick="sendMessage()">📨</button>
        </div>
    </div>
</div>

<script>
    const chatMessages = document.getElementById('chatMessages');
    const chatInput = document.getElementById('chatInput');
    const sendBtn = document.getElementById('sendBtn');
    const typingIndicator = document.getElementById('typingIndicator');

    chatInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 100) + 'px';
        sendBtn.disabled = this.value.trim() === '';
    });

    chatInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    function sendMessage() {
        const message = chatInput.value.trim();
        if (message === '') return;

        addMessage(message, 'user');
        chatInput.value = '';
        chatInput.style.height = 'auto';
        sendBtn.disabled = true;

        showTypingIndicator();

        setTimeout(() => {
            hideTypingIndicator();
            addAdminResponse(message);
        }, 1000 + Math.random() * 1000);
    }

    function addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}`;

        const avatar = document.createElement('div');
        avatar.className = 'message-avatar';
        avatar.textContent = sender === 'user' ? '🧑' : '🤖';

        const bubble = document.createElement('div');
        bubble.className = 'message-bubble';
        bubble.textContent = text;

        messageDiv.appendChild(sender === 'user' ? bubble : avatar);
        messageDiv.appendChild(sender === 'user' ? avatar : bubble);

        const welcomeMsg = chatMessages.querySelector('.welcome-message');
        if (welcomeMsg) welcomeMsg.remove();

        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function addAdminResponse(userMessage) {
        let response = '';
        const msg = userMessage.toLowerCase();

        if (msg.includes('obat') || msg.includes('efek samping')) {
            response = 'Untuk informasi obat, silakan sebutkan nama obatnya ya.';
        } else if (msg.includes('jadwal') || msg.includes('buka')) {
            response = 'Apotek kami buka setiap hari pukul 08.00 - 20.00 WIB.';
        } else if (msg.includes('terima kasih') || msg.includes('makasih')) {
            response = 'Sama-sama, senang bisa membantu! 😊';
        } else {
            response = 'Terima kasih atas pertanyaannya. Bisa dijelaskan lebih lanjut agar saya bisa bantu dengan tepat?';
        }

        addMessage(response, 'admin');
    }

    function showTypingIndicator() {
        typingIndicator.style.display = 'flex';
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function hideTypingIndicator() {
        typingIndicator.style.display = 'none';
    }

    sendBtn.disabled = true;
</script>

<?= $this->endSection(); ?>
