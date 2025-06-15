
<?= $this->extend('layout/templateUser'); ?>
<?= $this->section('content'); ?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .header {
            background-color: white;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 30px;
            height: 30px;
            background-color: #ccc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-bar {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 20px;
            width: 250px;
            outline: none;
        }

        .nav-menu {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .nav-item {
            color: #666;
            text-decoration: none;
            padding: 5px 10px;
            transition: color 0.3s;
        }

        .nav-item:hover {
            color: #333;
        }

        .nav-item.active {
            color: #333;
            font-weight: bold;
        }

        .cart-btn {
            background-color: #666;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 30px;
            font-weight: normal;
        }

        .chat-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            height: 500px;
            display: flex;
            flex-direction: column;
        }

        .chat-messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .message {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            max-width: 70%;
        }

        .message.user {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .message.admin {
            align-self: flex-start;
        }

        .message-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #333;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .message-bubble {
            background-color: #f8f9fa;
            padding: 12px 16px;
            border-radius: 18px;
            font-size: 14px;
            line-height: 1.4;
            border: 1px solid #e9ecef;
        }

        .message.user .message-bubble {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
        }

        .welcome-message {
            text-align: center;
            color: #666;
            padding: 40px 20px;
            font-style: italic;
        }

        .chat-input-container {
            padding: 20px;
            border-top: 1px solid #eee;
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .chat-input {
            flex: 1;
            padding: 12px 16px;
            border: 1px solid #ddd;
            border-radius: 25px;
            outline: none;
            font-size: 14px;
            resize: none;
            max-height: 100px;
        }

        .chat-input:focus {
            border-color: #007bff;
        }

        .send-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .send-btn:hover {
            background-color: #555;
        }

        .send-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        .typing-indicator {
            display: none;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
            color: #666;
            font-style: italic;
            font-size: 14px;
        }

        .typing-dots {
            display: flex;
            gap: 3px;
        }

        .typing-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: #666;
            animation: typing 1.4s infinite ease-in-out;
        }

        .typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .typing-dot:nth-child(2) { animation-delay: -0.16s; }

        @keyframes typing {
            0%, 80%, 100% {
                transform: scale(0);
            }
            40% {
                transform: scale(1);
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            
            .search-bar {
                width: 200px;
            }
            
            .chat-container {
                height: 400px;
            }
            
            .message {
                max-width: 85%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="page-title">Bantuan Konsultasi</h1>
        
        <div class="chat-container">
            <div class="chat-messages" id="chatMessages">
                <div class="welcome-message">
                    Halo ada yg bisa saya bantu?
                </div>
            </div>
            
            <div class="typing-indicator" id="typingIndicator">
                <div class="message-avatar">👤</div>
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
                    placeholder="Aku cape kuliah..."
                    rows="1"
                ></textarea>
                <button class="send-btn" id="sendBtn" onclick="sendMessage()">
                    👤
                </button>
            </div>
        </div>
    </div>

    <script>
        const chatMessages = document.getElementById('chatMessages');
        const chatInput = document.getElementById('chatInput');
        const sendBtn = document.getElementById('sendBtn');
        const typingIndicator = document.getElementById('typingIndicator');

        // Auto-resize textarea
        chatInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 100) + 'px';
            
            // Enable/disable send button
            sendBtn.disabled = this.value.trim() === '';
        });

        // Send message on Enter (but allow Shift+Enter for new line)
        chatInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        function sendMessage() {
            const message = chatInput.value.trim();
            if (message === '') return;

            // Add user message
            addMessage(message, 'user');
            
            // Clear input
            chatInput.value = '';
            chatInput.style.height = 'auto';
            sendBtn.disabled = true;

            // Show typing indicator
            showTypingIndicator();

            // Simulate admin response
            setTimeout(() => {
                hideTypingIndicator();
                addAdminResponse(message);
            }, 1500 + Math.random() * 1000);
        }

        function addMessage(text, sender) {
            const messageDiv = document.createElement('div');
            messageDiv.className = `message ${sender}`;
            
            const avatar = document.createElement('div');
            avatar.className = 'message-avatar';
            avatar.textContent = sender === 'user' ? '👤' : '👤';
            
            const bubble = document.createElement('div');
            bubble.className = 'message-bubble';
            bubble.textContent = text;
            
            messageDiv.appendChild(avatar);
            messageDiv.appendChild(bubble);
            
            // Remove welcome message if it exists
            const welcomeMsg = chatMessages.querySelector('.welcome-message');
            if (welcomeMsg) {
                welcomeMsg.remove();
            }
            
            chatMessages.appendChild(messageDiv);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }

        function addAdminResponse(userMessage) {
            let response = '';
            
            // Simple response logic
            const lowerMessage = userMessage.toLowerCase();
            if (lowerMessage.includes('cape') || lowerMessage.includes('lelah')) {
                response = 'Saya mengerti Anda merasa lelah. Apakah ada yang bisa saya bantu untuk mengatasi masalah ini?';
            } else if (lowerMessage.includes('kuliah') || lowerMessage.includes('kampus')) {
                response = 'Tentang masalah kuliah, bisa ceritakan lebih detail apa yang membuat Anda merasa kesulitan?';
            } else if (lowerMessage.includes('obat') || lowerMessage.includes('medicine')) {
                response = 'Untuk informasi obat-obatan, saya bisa membantu. Apakah Anda sedang mencari obat tertentu?';
            } else if (lowerMessage.includes('terima kasih') || lowerMessage.includes('thanks')) {
                response = 'Sama-sama! Senang bisa membantu Anda. Ada yang lain yang bisa saya bantu?';
            } else {
                response = 'Terima kasih telah menghubungi kami. Bisa dijelaskan lebih detail mengenai masalah yang Anda hadapi?';
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

        // Initialize
        sendBtn.disabled = true;

        // Search functionality
        document.querySelector('.search-bar').addEventListener('keypress', function(e) {
            if(e.key === 'Enter') {
                alert('Pencarian: ' + this.value);
            }
        });
    </script>
<?= $this->endSection() ?>