<!DOCTYPE html>
<html>
<head>
    <title>Laravel Real-Time Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <h1>Chat Room</h1>
    <div id="messages"></div>
    <form id="message-form">
        <input type="text" id="message-input" placeholder="Type your message here">
        <button type="submit">Send</button>
    </form>

    <!-- Include compiled JavaScript -->
    @vite('resources/js/app.js')

    <script>
        const messages = document.getElementById('messages');
        const messageForm = document.getElementById('message-form');
        const messageInput = document.getElementById('message-input');

        messageForm.addEventListener('submit', function(e) {
            e.preventDefault();

            axios.post('/send-message', {
                message: messageInput.value
            });

            messageInput.value = '';
        });

        console.log('Echo:', window.Echo);

        window.Echo.channel('chat')
            .listen('MessageSent', (e) => {
                const messageElement = document.createElement('p');
                messageElement.textContent = e.message;
                messages.appendChild(messageElement);
            });
    </script>
</body>
</html>
