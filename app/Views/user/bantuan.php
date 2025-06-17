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

    .message.apoteker {
        align-self: flex-start;
    }

    .message-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: #007bff;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }

    .message.apoteker .message-avatar {
        background-color: #28a745;
    }

    .message-bubble {
        background-color: #f8f9fa;
        padding: 12px 16px;
        border-radius: 18px;
        font-size: 14px;
        line-height: 1.4;
        border: 1px solid #e9ecef;
        position: relative;
    }

    .message.user .message-bubble {
        background-color: #007bff;
        color: white;
        border: 1px solid #007bff;
    }

    .message-time {
        font-size: 11px;
        color: #666;
        margin-top: 5px;
        opacity: 0.7;
    }

    .message.user .message-time {
        color: rgba(255,255,255,0.8);
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
        background-color: #007bff;
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
        background-color: #0056b3;
    }

    .send-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .loading {
        display: none;
        text-align: center;
        color: #666;
        padding: 10px;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .chat-container {
            height: 400px;
        }

        .message {
            max-width: 85%;
        }

        .chat-input {
            font-size: 13px;
        }
    }
</style>

<div class="container">
    <h1 class="page-title">Bantuan Konsultasi</h1>
    
    <div class="chat-container">
        <div class="chat-messages" id="chatMessages">
            <?php if (empty($chats)): ?>
                <div class="welcome-message" id="welcomeMessage">
                    Halo! Selamat datang di layanan konsultasi. Ada yang bisa saya bantu?
                </div>
            <?php else: ?>
                <?php foreach ($chats as $chat): ?>
                    <div class="message <?= $chat['sender_role'] ?>">
                        <div class="message-avatar">
                            <?= $chat['sender_role'] == 'user' ? '👤' : '🧑‍⚕️' ?>
                        </div>
                        <div class="message-content">
                            <div class="message-bubble">
                                <?= esc($chat['message']) ?>
                            </div>
                            <div class="message-time">
                                <?= date('H:i', strtotime($chat['created_at'])) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="loading" id="loadingIndicator">
            Mengirim pesan...
        </div>
        
        <div class="chat-input-container">
            <textarea 
                class="chat-input" 
                id="chatInput" 
                placeholder="Ketik pesan Anda di sini..." 
                rows="1"
            ></textarea>
            <button class="send-btn" id="sendBtn" onclick="sendMessage()">
                ⬆️
            </button>
        </div>
    </div>
</div>

<script>
    const chatMessages = document.getElementById('chatMessages');
    const chatInput = document.getElementById('chatInput');
    const sendBtn = document.getElementById('sendBtn');
    const loadingIndicator = document.getElementById('loadingIndicator');
    const welcomeMessage = document.getElementById('welcomeMessage');

    // Auto-resize textarea
    chatInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 100) + 'px';
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

        // Disable input sementara
        chatInput.disabled = true;
        sendBtn.disabled = true;
        loadingIndicator.style.display = 'block';

        // Kirim pesan ke server
        fetch('<?= base_url('user/sendMessage') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Csrf-Token': '<?= csrf_token() ?>'
            },
            body: 'message=' + encodeURIComponent(message) + '&<?= csrf_token() ?>=' + '<?= csrf_hash() ?>'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Tambahkan pesan ke chat
                addMessage(message, 'user', new Date());
                chatInput.value = '';
                chatInput.style.height = 'auto';
                
                // Hapus welcome message jika ada
                if (welcomeMessage) {
                    welcomeMessage.remove();
                }
            } else {
                alert('Gagal mengirim pesan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim pesan');
        })
        .finally(() => {
            // Enable input kembali
            chatInput.disabled = false;
            sendBtn.disabled = false;
            loadingIndicator.style.display = 'none';
            chatInput.focus();
        });
    }

    function addMessage(text, sender, timestamp) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}`;
        
        const avatar = document.createElement('div');
        avatar.className = 'message-avatar';
        avatar.textContent = sender === 'user' ? '👤' : '🧑‍⚕️';
        
        const messageContent = document.createElement('div');
        messageContent.className = 'message-content';
        
        const bubble = document.createElement('div');
        bubble.className = 'message-bubble';
        bubble.textContent = text;
        
        const time = document.createElement('div');
        time.className = 'message-time';
        time.textContent = timestamp.toLocaleTimeString('id-ID', {hour: '2-digit', minute: '2-digit'});
        
        messageContent.appendChild(bubble);
        messageContent.appendChild(time);
        messageDiv.appendChild(avatar);
        messageDiv.appendChild(messageContent);
        
        chatMessages.appendChild(messageDiv);
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Auto refresh untuk mendapatkan balasan dari apoteker
    function checkNewMessages() {
        fetch('<?= base_url('user/getMessages') ?>')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const currentMessages = chatMessages.querySelectorAll('.message').length;
                if (data.data.length > currentMessages) {
                    // Ada pesan baru, reload halaman atau update secara dinamis
                    location.reload();
                }
            }
        })
        .catch(error => {
            console.error('Error checking messages:', error);
        });
    }

    // Check pesan baru setiap 10 detik
    setInterval(checkNewMessages, 10000);

    // Scroll ke bawah saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    });

    // Inisialisasi
    sendBtn.disabled = true;
</script>

<?= $this->endSection(); ?>