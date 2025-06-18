<?= $this->extend('layout/templateApoteker'); ?>
<?= $this->section('content'); ?>

<style>
    .chat-admin-container {
        display: flex;
        height: 600px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .user-list {
        width: 300px;
        border-right: 1px solid #eee;
        background: #f8f9fa;
    }

    .user-list-header {
        padding: 20px;
        background: #007bff;
        color: white;
        font-weight: bold;
    }

    .user-item {
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .user-item:hover {
        background-color: #e9ecef;
    }

    .user-item.active {
        background-color: #007bff;
        color: white;
    }

    .user-name {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .last-message {
        font-size: 12px;
        color: #666;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-item.active .last-message {
        color: rgba(255,255,255,0.8);
    }

    .chat-area {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .chat-header {
        padding: 20px;
        background: #f8f9fa;
        border-bottom: 1px solid #eee;
        font-weight: bold;
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
        align-self: flex-start;
    }

    .message.apoteker {
        align-self: flex-end;
        flex-direction: row-reverse;
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
    }

    .message.apoteker .message-bubble {
        background-color: #28a745;
        color: white;
        border: 1px solid #28a745;
    }

    .message-time {
        font-size: 11px;
        color: #666;
        margin-top: 5px;
        opacity: 0.7;
    }

    .message.apoteker .message-time {
        color: rgba(255,255,255,0.8);
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
        background-color: #28a745;
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
        background-color: #218838;
    }

    .send-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .no-chat-selected {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
        color: #666;
        font-style: italic;
    }

    .no-users {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 200px;
        color: #666;
        font-style: italic;
    }
</style>

<div class="main-content">
    <div class="container">
        <h1 style="margin-bottom: 30px;">Bantuan Konsultasi - Panel Apoteker</h1>
        
        <div class="chat-admin-container">
            <!-- Daftar User -->
            <div class="user-list">
                <div class="user-list-header">
                    Daftar Konsultasi
                </div>
                <div class="user-list-content">
                    <?php if (empty($users)): ?>
                        <div class="no-users">
                            Belum ada konsultasi
                        </div>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <div class="user-item" onclick="selectUser(<?= $user['id'] ?>, '<?= esc($user['nama']) ?>')">
                                <div class="user-name"><?= esc($user['nama']) ?></div>
                                <div class="last-message">
                                    <?= date('d/m/Y H:i', strtotime($user['last_message'])) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Area Chat -->
            <div class="chat-area">
                <div class="chat-header" id="chatHeader">
                    Pilih konsultasi untuk memulai
                </div>
                
                <div class="chat-messages" id="chatMessages">
                    <div class="no-chat-selected" id="noChatSelected">
                        Pilih pengguna dari daftar di samping untuk melihat percakapan
                    </div>
                </div>
                
                <div class="chat-input-container" id="chatInputContainer" style="display: none;">
                    <textarea 
                        class="chat-input" 
                        id="chatInput" 
                        placeholder="Ketik balasan Anda..." 
                        rows="1"
                    ></textarea>
                    <button class="send-btn" id="sendBtn" onclick="sendReply()">
                        ⬆️
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<br><br>

<script>
    let currentUserId = null;
    let currentUserName = null;
    const chatMessages = document.getElementById('chatMessages');
    const chatInput = document.getElementById('chatInput');
    const sendBtn = document.getElementById('sendBtn');
    const chatHeader = document.getElementById('chatHeader');
    const chatInputContainer = document.getElementById('chatInputContainer');
    const noChatSelected = document.getElementById('noChatSelected');

    // Auto-resize textarea
    chatInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 100) + 'px';
        sendBtn.disabled = this.value.trim() === '';
    });

    // Send message on Enter
    chatInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            sendReply();
        }
    });

    function selectUser(userId, userName) {
        currentUserId = userId;
        currentUserName = userName;
        
        // Update active user
        document.querySelectorAll('.user-item').forEach(item => {
            item.classList.remove('active');
        });
        event.currentTarget.classList.add('active');
        
        // Update header
        chatHeader.textContent = `Konsultasi dengan ${userName}`;
        
        // Show input container
        chatInputContainer.style.display = 'flex';
        noChatSelected.style.display = 'none';
        
        // Load chat messages
        loadChatMessages(userId);
    }

    function loadChatMessages(userId) {
        fetch(`<?= base_url('apoteker/getChatByUser') ?>/${userId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                displayMessages(data.data);
            }
        })
        .catch(error => {
            console.error('Error loading messages:', error);
        });
    }

    function displayMessages(messages) {
        chatMessages.innerHTML = '';
        
        if (messages.length === 0) {
            chatMessages.innerHTML = '<div class="no-chat-selected">Belum ada percakapan</div>';
            return;
        }

        messages.forEach(message => {
            addMessage(message.message, message.sender_role, new Date(message.created_at));
        });
        
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    function sendReply() {
        const message = chatInput.value.trim();
        if (message === '' || !currentUserId) return;

        // Disable input sementara
        chatInput.disabled = true;
        sendBtn.disabled = true;

        // Kirim balasan ke server
        fetch('<?= base_url('apoteker/sendReply') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Csrf-Token': '<?= csrf_token() ?>'
            },
            body: `user_id=${currentUserId}&message=${encodeURIComponent(message)}&<?= csrf_token() ?>=<?= csrf_hash() ?>`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Tambahkan pesan ke chat
                addMessage(message, 'apoteker', new Date());
                chatInput.value = '';
                chatInput.style.height = 'auto';
            } else {
                alert('Gagal mengirim balasan: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengirim balasan');
        })
        .finally(() => {
            // Enable input kembali
            chatInput.disabled = false;
            sendBtn.disabled = false;
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

    // Auto refresh untuk mendapatkan pesan baru
    function checkNewMessages() {
        if (currentUserId) {
            loadChatMessages(currentUserId);
        }
    }

    // Check pesan baru setiap 5 detik
    setInterval(checkNewMessages, 5000);

    // Inisialisasi
    sendBtn.disabled = true;
</script>

<?= $this->endSection(); ?>