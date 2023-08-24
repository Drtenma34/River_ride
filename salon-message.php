<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Messagerie de groupe</title>
    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="Anime.css">
</head>
<header>
    <div>
        <img src="image anime/logo.png" alt="Logo" style="width:200px; height:150px;">
    </div>
    <nav>
        <ul class="tete">
            <li>
                <a class="nav-link" href="salon.php">Événements</a>
            </li>
           
        </ul>
    </nav>
</header>

<main>
    <div>
        <img src="image anime/planning.jpeg" alt="Logo" style="width:550px; height:450px;">
    </div>
</main>

<body class="corp">
    <h1>Groupe Salon Mangas</h1>
    <img src="image anime/salon2.jpeg" alt="Salon Mangas" style="width:250px;">

    <div class="message-container" id="messageContainer">

        <div class="message admin-message">
            <span class="user">Admin:</span>
            <span class="content">Bienvenue dans le forum de discussion Salons Mangas !</span>
        </div>
        <div class="message">
            <span class="user">Utilisateur1:</span>
            <span class="content">Bonjour à tous !</span>
            <span class="time">09:00</span>
        </div>
        <div class="message">
            <span class="user">Utilisateur2:</span>
            <span class="content">Glissez vos questions ici nous vous répondrons dans les plus brefs délais !</span>
            <span class="time">09:05</span>
        </div>
    </div>

    <div class="input-container">
        <input type="text" id="message-input" placeholder="Entrez votre message">
        <button onclick="sendMessage()">Envoyer</button>
    </div>

    <div>
        <button onclick="deleteLastUserMessage()">Supprimer mon dernier message</button>
    </div>

    <div>
        <button onclick="redirectToPayment()">Prenez votre place</button>
    </div>

    <script>
        function sendMessage() {
            var messageInput = document.getElementById('message-input');
            var messageContent = messageInput.value;

            if (messageContent.trim() !== '') {
                var messageContainer = document.getElementById('messageContainer');

                var message = document.createElement('div');
                message.classList.add('message');

                var user = document.createElement('span');
                user.classList.add('user');
                user.textContent = 'Utilisateur1:';

                var content = document.createElement('span');
                content.classList.add('content');
                content.textContent = messageContent;

                var time = document.createElement('span');
                time.classList.add('time');
                var currentTime = new Date().toLocaleTimeString();
                time.textContent = currentTime;

                message.appendChild(user);
                message.appendChild(content);
                message.appendChild(time);

                messageContainer.appendChild(message);

                messageInput.value = '';
            }
        }

        function deleteLastUserMessage() {
            var messageContainer = document.getElementById('messageContainer');
            var messages = messageContainer.getElementsByClassName('message');
            var userMessages = Array.from(messages).filter(function(message) {
                return message.querySelector('.user').textContent === 'Utilisateur1:';
            });
            
            if (userMessages.length > 0) {
                var lastUserMessage = userMessages[userMessages.length - 1];
                messageContainer.removeChild(lastUserMessage);
            }
        }

        function redirectToPayment() {
            window.location.href = 'paiement.php';
        }
    </script>
</body>
</html>
