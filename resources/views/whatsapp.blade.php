<!DOCTYPE html>
<html>
<head>
    <title>WhatsApp Sender</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
        }
        .button {
            padding: 15px 30px;
            font-size: 18px;
            background-color: #25D366;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #128C7E;
        }
    </style>
</head>
<body>
    <button class="button" onclick="sendWhatsAppMessage()">Send WhatsApp Message</button>

    <script>
        function sendWhatsAppMessage() {
            fetch('/api/send-whatsapp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                alert('Message sent successfully!');
            })
            .catch(error => {
                alert('Error sending message');
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
