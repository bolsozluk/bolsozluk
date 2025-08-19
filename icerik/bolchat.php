<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//session_start();
//$kullaniciAdi = isset($_SESSION['kullaniciAdi']) ? $_SESSION['kullaniciAdi'] : '';
//$yetki = isset($_SESSION['yetki']) ? $_SESSION['yetki'] : '';
?>

<div id="bolsozluk-chat-container" style="text-align:left;">
    <div id="chat-header">
<h3>
  <a href="https://www.bolsozluk.com/sozluk.php?process=bolchat" target="_blank" style="color: white;">bolchat</a>
</h3>
    <button id="toggle-dark-mode" type="button" style="margin-left:10px;font-size:0.8em;background:#555;color:white;border:none;padding:2px 8px;border-radius:3px;cursor:pointer;">🌙</button>

        <div id="online-count">on: <span>0</span></div>
        <?php if($kulYetki === 'admin' || $kulYetki === 'mod'): ?>
            <button id="toggle-hidden" type="button" style="margin-left:10px;font-size:0.8em;background:#e74c3c;color:white;border:none;padding:2px 8px;border-radius:3px;">Gizli Mesajlar</button>
        <?php endif; ?>
    </div>
    
    <div id="chat-messages"></div>
    <div id="hidden-messages" style="display:none;"></div>
    
    <div id="chat-input-area">
        <form id="chat-form" method="post">
            <div class="input-group">
                <input 
                    type="text" 
                    id="nick" 
                    name="nick" 
                    placeholder="<?= $kullaniciAdi ? 'Giriş yapmış kullanıcı: ' . htmlspecialchars($kullaniciAdi) : 'Nickiniz' ?>" 
                    <?= $kullaniciAdi ? 'readonly' : '' ?>                    
                    value="<?= htmlspecialchars($kullaniciAdi) ?>" 

                    autocomplete="off"
                >
                <div class="input-main">
                    <textarea 
                        id="message" 
                        name="message" 
                        placeholder="Mesajınızı yazın..." 
                        rows="1" 
                        maxlength="255"
                        autocomplete="off"
                    ></textarea>
                    <button type="submit" id="send-button" aria-label="Mesaj Gönder">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="currentColor" d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>

    .ban-ip-button {
    color: #ff4444 !important;
    font-size: 0.8em;
    margin-left: 5px;
    text-decoration: none;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
}

.ban-ip-button:hover {
    text-decoration: underline;
}
    
    .message-content a {
    color: #2980b9;
    text-decoration: none;
}

.message-content a:hover {
    text-decoration: underline;
}

.own-message .message-content a {
    color: #fff;
    text-decoration: underline;
}

/* Dark mode için */
.dark-mode .message-content a {
    color: #3498db;
}

.dark-mode .own-message .message-content a {
    color: #fff;
}

/* Dark Mode Temel Stilleri */

.dark-mode .verified-badge {
    color: #FFA726; /* Daha yumuşak turuncu */
    background: rgba(0, 0, 0, 0.3); /* Yarı saydam koyu arkaplan */
    border-color: #FFA726;
}

.dark-mode .user-avatar {
    background: linear-gradient(145deg, #FF7043, #FFA000); /* Gradient efekti */
    color: #121212; /* Koyu metin rengi */
}
.dark-mode #bolsozluk-chat-container {
    background-color: #1e1e1e;
    color: #e0e0e0;
}

.dark-mode #chat-header {
    background-color: #121212;
    color: #ffffff;
}

.dark-mode #chat-messages {
    background-color: #252525;
    color: #e0e0e0 !important;
}

.dark-mode .message-content {
    background-color: #333;
    color: #fff;
}

.dark-mode .own-message .message-content {
    background-color: #1a5276;
    color: #fff;
}

.dark-mode #chat-input-area {
    background-color: #1e1e1e;
    border-top-color: #333;
}

.dark-mode .input-main {
    background-color: #333;
}

.dark-mode textarea#message {
    background-color: transparent;
    color: #fff;
}

.dark-mode #nick {
    background-color: #333;
    color: #fff;
    border-color: #444;
}

.dark-mode .username {
    color: #bbbbbb;
}

.dark-mode .message-time {
    color: #888;
}

.dark-mode #chat-messages::-webkit-scrollbar-thumb,
.dark-mode #hidden-messages::-webkit-scrollbar-thumb {
    background: #555;
}

.dark-mode #chat-messages::-webkit-scrollbar-track,
.dark-mode #hidden-messages::-webkit-scrollbar-track {
    background: #333;
}

.dark-mode #hidden-messages {
    background-color: #252525;
    color: #e0e0e0;
}

.verified-badge {
    display: inline-block;
    color: #1DA1F2; /* Twitter mavisi */
    background: white;
    border-radius: 50%;
    font-size: 0.7em;
    width: 14px;
    height: 14px;
    text-align: center;
    line-height: 14px;
    margin-left: 4px;
    border: 1px solid currentColor;
    vertical-align: middle;
}

.own-message .verified-badge {
    background: #3498db; /* Kendi mesajında farklı stil */
    color: white;
    border-color: white;
}

#chat-messages::-webkit-scrollbar,
#hidden-messages::-webkit-scrollbar {
    width: 12px;
}
#chat-messages::-webkit-scrollbar-track,
#hidden-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
}
#chat-messages::-webkit-scrollbar-thumb,
#hidden-messages::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

#hidden-messages {
    display: none;
    overflow-y: auto; /* Scroll özelliği ekledik */
    max-height: 60vh; /* Sabit yükseklik */
    padding: 15px;
    background: #f5f5f5;
    flex: 1 1 auto; /* Esnek boyutlandırma */
    min-height: 0; /* Firefox için gerekli */
}

#bolsozluk-chat-container {
    font-family: 'Segoe UI', Roboto, sans-serif;
    max-width: 600px;
    margin: 0 auto;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    overflow: hidden;
    background: #fff;
    font-size: 12px;
    line-height: 1.4;
    height: 65vh;
    display: flex;
    flex-direction: column;
}

#chat-header {
    flex: 0 0 auto;
    background: #2c3e50;
    color: white;
    padding: 15px 20px;
    display: flex;
    justify-content: flex-start !important;
    position: relative;
    align-items: center;
}

#chat-header h3 {
    margin: 0;
    font-size: 1.2rem;
}

#online-count {
    font-size: 0.9rem;
    background: rgba(255,255,255,0.2);
    padding: 3px 10px;
    border-radius: 20px;
    margin-left: auto;
}

#chat-messages {
    scroll-behavior: smooth; /* Yumuşak scroll için */
    flex: 1 1 auto;
    min-height: 0;
    overflow-y: auto;
    padding: 15px;
    background: #f5f5f5;
    color: black !important;
}

.message {
    margin-bottom: 15px;
    max-width: 80%;
    animation: fadeIn 0.3s ease;
}

.own-message {
    margin-left: auto;
}

.message-header {
    display: flex;
    align-items: center;
    margin-bottom: 5px;
}

.user-avatar {
    width: 28px;
    height: 28px;
    background: #3498db;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 8px;
    font-weight: bold;
    font-size: 0.8rem;
    text-transform: uppercase;
}

.username {
    font-weight: 600;
    font-size: 0.9rem;
    color: #2c3e50;
}

.message-time {
    font-size: 0.7rem;
    color: #95a5a6;
    margin-left: 8px;
    font-family: monospace;
}

.message-content {
    background: white;
    padding: 10px 15px;
    border-radius: 18px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    display: inline-block;
    word-break: break-word;
    white-space: pre-wrap;
}

.own-message .message-content {
    background: #3498db;
    color: white;
    border-bottom-right-radius: 4px;
}

#chat-input-area {
    flex: 0 0 auto;
    background: #fff;
    border-top: 1px solid #eee;
    padding: 15px;
}

.input-group {
    display: flex;
    gap: 10px;
}

.input-main {
    flex: 1;
    display: flex;
    background: #f5f5f5;
    border-radius: 24px;
    padding: 8px 15px;
}

#nick {
    width: 100px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 20px;
    font-size: 0.9rem;
}

textarea#message {
    flex: 1;
    border: none;
    background: transparent;
    resize: none;
    outline: none;
    font-family: inherit;
    font-size: 0.95rem;
    max-height: 120px;
    padding: 5px 0;
}

#send-button {
    background: none;
    border: none;
    color: #3498db;
    cursor: pointer;
    padding: 0 0 0 10px;
    display: flex;
    align-items: center;
}

.delete-message {
    color: red !important;
    font-size: 0.8em;
    margin-left: 5px;
    text-decoration: none;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
}

.delete-message:hover {
    text-decoration: underline;
}

.restore-message {
    color: green !important;
    font-size: 0.8em;
    margin-left: 5px;
    text-decoration: none;
    cursor: pointer;
    background: none;
    border: none;
    padding: 0;
}

.hidden-message {
    opacity: 0.6;
    border-left: 3px solid #e74c3c;
    padding-left: 5px;
}

#send-button:hover {
    color: #2980b9;
}

.ip-display {
    color: #8B4513; /* Kahverengi */
    font-family: monospace;
    font-size: 1em;
    margin-left: 5px;
    opacity: 0.8;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 640px) {
    #bolsozluk-chat-container {
        border-radius: 0;
        height: 90vh;
        max-height: 90vh;
    }
    
    #chat-messages {
        min-height: 200px;
    }
    
    .message {
        max-width: 90%;
    }
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function() {
    var lastMessageTime = '1970-01-01 00:00:00';
    var username = '<?= addslashes($kullaniciAdi) ?>';
    var isAdmin = <?= ($kulYetki === 'admin' || $kulYetki === 'mod') ? 'true' : 'false' ?>;
    var $chatMessages = $('#chat-messages');
    var $hiddenMessages = $('#hidden-messages');
    var showingHidden = false;

// Dark mode butonu için
$('#toggle-dark-mode').click(function(e) {
    e.stopPropagation(); // Olay yayılımını durdur
    e.preventDefault(); // Varsayılan davranışı engelle
    toggleDarkMode();
});

    // Dark mode toggle fonksiyonu
function toggleDarkMode() {
    const isDark = document.body.classList.toggle('dark-mode');
    localStorage.setItem('chatDarkMode', isDark);
    $('#toggle-dark-mode').text(isDark ? '☀️' : '🌙');
}

// Sayfa yüklendiğinde dark mode kontrolü
function checkDarkModePreference() {
    const darkModeEnabled = localStorage.getItem('chatDarkMode') === 'true';
    if (darkModeEnabled) {
        document.body.classList.add('dark-mode');
        $('#toggle-dark-mode').text('☀️');
    }
}




    function escapeHtml(text) {
        return $('<div>').text(text).html();
    }

    function loadMessages() {
        $.getJSON('sozluk.php?process=chat&action=get_messages', function(messages) {
        var newMessagesHtml = '';
        var currentScroll = $chatMessages.scrollTop();
        var containerHeight = $chatMessages.innerHeight();
        var scrollHeight = $chatMessages[0].scrollHeight;
        // Scroll'un en altta olup olmadığını kontrol et (50px tolerans)
        var isScrolledToBottom = (currentScroll + containerHeight >= scrollHeight - 50);

        for (var i = 0; i < messages.length; i++) {
            var msg = messages[i];
            if (msg.created_at > lastMessageTime) {
                newMessagesHtml += buildMessageHtml(msg, false);
                lastMessageTime = msg.created_at;
            }
        }

        if (newMessagesHtml !== '') {
            $chatMessages.append(newMessagesHtml);
            
            // Sadece zaten en alttaysak veya yeni mesaj çok uzunsa scroll et
            if (isScrolledToBottom || newMessagesHtml.length > 1000) {
                $chatMessages.stop().animate({
                    scrollTop: $chatMessages[0].scrollHeight
                }, 200); // 200ms'lik yumuşak geçiş
            }
        }
        
        bindMessageEvents();
    }).fail(function() {
        console.error('Mesajlar yüklenemedi');
    });
}

function buildMessageHtml(msg, isHidden) {
    var isOwn = (msg.username === username);
    var isVerified = parseInt(msg.is_verified) === 1;
    var verifiedBadge = isVerified ? ' <span class="verified-badge">✓</span>' : '';

        // URL'leri hyperlink'e çeviren fonksiyon
    function linkifyUrls(text) {
        // URL regex pattern
        var urlPattern = /(https?:\/\/[^\s<]+[^\s<\.)])/gi;
        
        // URL'leri link etiketine çevir
        return text.replace(urlPattern, function(url) {
            return '<a href="' + url + '" target="_blank" rel="noopener noreferrer">' + url + '</a>';
        });
    }

    var html = 
        '<div class="message ' + (isOwn ? 'own-message' : '') + 
        (isHidden ? ' hidden-message' : '') + '" data-message-id="' + msg.id + '">' +
            '<div class="message-header">' +
                '<span class="user-avatar">' + escapeHtml(msg.username.charAt(0).toUpperCase()) + '</span>' +
                '<span class="username">' + escapeHtml(msg.username) + verifiedBadge +  '</span>' +
                (isHidden && msg.ip ? '<span class="ip-display">IP:' + escapeHtml(msg.ip) + '</span>' : '') +
                '<span class="message-time">' + escapeHtml(msg.created_at.substring(11,16)) + '</span>' +
            '</div>' +
            '<div class="message-content">' + linkifyUrls(escapeHtml(msg.message));
        
        if (isAdmin) {
            if (isHidden) {
                html += ' <button class="restore-message">[geri getir]</button>';
            } else {
                html += ' <button class="delete-message">[gizle]</button>';
            }
        }

    if (isAdmin && !isHidden) {
    html += ' <button class="ban-ip-button" data-ip="' + escapeHtml(msg.ip) + '">[ipban]</button>';
}
        
        html += '</div></div>';
        return html;
    }

function updateOnlineCount() {
    $.get('sozluk.php?process=chat&action=get_online_count', function(count) {
        $('#online-count span').text(count);
    }).fail(function() {
        console.error('Online sayacı güncellenemedi');
    });
}
    function bindMessageEvents() {
        $('.delete-message').off('click').click(function(e) {
            e.preventDefault();
            var messageDiv = $(this).closest('.message');
            var messageId = messageDiv.data('message-id');
            
            if (confirm('Bu mesajı gizlemek istediğinize emin misiniz?')) {
                $.post('sozluk.php?process=chat', {
                    action: 'delete_message',
                    message_id: messageId
                }, function(response) {
                    if (response.trim() === 'OK') {
                        messageDiv.fadeOut(300, function() {
                            $(this).remove();
                        });
                    } else {
                        alert('Gizleme işlemi başarısız: ' + response);
                    }
                }).fail(function() {
                    alert('Gizleme işlemi sırasında hata oluştu');
                });
            }
        });

        $('.restore-message').off('click').click(function(e) {
            e.preventDefault();
            var messageDiv = $(this).closest('.message');
            var messageId = messageDiv.data('message-id');
            
            if (confirm('Bu mesajı geri getirmek istediğinize emin misiniz?')) {
                $.post('sozluk.php?process=chat', {
                    action: 'restore_message',
                    message_id: messageId
                }, function(response) {
                    if (response.trim() === 'OK') {
                        messageDiv.fadeOut(300, function() {
                            $(this).remove();
                            loadMessages();
                        });
                    } else {
                        alert('Geri getirme işlemi başarısız: ' + response);
                    }
                }).fail(function() {
                    alert('Geri getirme işlemi sırasında hata oluştu');
                });
            }
        });
    }

    $('.ban-ip-button').off('click').click(function(e) {
    e.preventDefault();
    var ip = $(this).data('ip');
    if (confirm('Bu IP (' + ip + ') adresini kalıcı olarak banlamak istediğinize emin misiniz?\n\nBu işlem geri alınamaz!')) {
        $.post('sozluk.php?process=chat', {
            action: 'ban_ip',
            ip: ip
        }, function(response) {
            if (response.trim() === 'OK') {
                alert('IP başarıyla banlandı: ' + ip);
            } else {
                alert('Ban işlemi başarısız: ' + response);
            }
        }).fail(function() {
            alert('Ban işlemi sırasında hata oluştu');
        });
    }
});

    $('#toggle-hidden').click(function() {
        showingHidden = !showingHidden;
        if (showingHidden) {
            $(this).css('background', '#2ecc71');
            $chatMessages.hide();
            $hiddenMessages.show().empty();
            
            $.getJSON('sozluk.php?process=chat&action=get_hidden_messages', function(messages) {
                var hiddenHtml = '';
                for (var i = 0; i < messages.length; i++) {
                    hiddenHtml += buildMessageHtml(messages[i], true);
                }
                $hiddenMessages.html(hiddenHtml);
                bindMessageEvents();
            });
        } else {
            $(this).css('background', '#e74c3c');
            $hiddenMessages.hide();
            $chatMessages.show();
            loadMessages();
        }
    });

    $('#message').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    $('#message').on('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            $('#chat-form').submit();
        }
    });

$('#chat-form').submit(function(e) {
    e.preventDefault();
    
    // 1. Kullanıcı ne yazdıysa onu al (girişli olsa bile)
    var nick = $('#nick').val().trim();
    var message = $('#message').val().trim();
    
    // 2. Mesaj boş mu kontrol et
    if(!message) return;
    
    // 3. Direkt gönder (artık girişli kullanıcı nicki override edilmez)
    $.post('sozluk.php?process=chat', {
        nick: nick, // Artık her zaman input'taki nick gider
        message: message,
        action: 'send_message'
    }).done(function(response) {
        if(response.trim() === 'OK') {
            $('#message').val('').height('auto');
            if(!showingHidden) loadMessages();
        }
    }).fail(console.error);
});

    // Dark mode kontrolü
    checkDarkModePreference();
    
    // Dark mode toggle eventi
   // $('#toggle-dark-mode').click(toggleDarkMode);

    setInterval(loadMessages, 3000);

    updateOnlineCount();
    loadMessages();
});
</script>
