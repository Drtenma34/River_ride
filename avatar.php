<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mon avatar</title>
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
                <a class="nav-link active" href="compte.php">Mon Compte</a>
            </li>
            <li>
                <a class="nav-link" href="regle.php">Réglages</a>
            </li>
            <li>
                <a class="nav-link" href="salon.php">Événements</a>
            </li>
            <li>
                <a class="nav-link" href="anime.html">Mes animes</a>
            </li>
        </ul>
    </nav>
</header>

<body class="corp">
    <h1>Mon Avatar</h1>

    <div class="avatar-container">
        <div class="avatar">
            <img src="avatar/tete1.png" alt="Tête principale de l'avatar">
        </div>
    </div>
    
    <div>
        <h2>Composez Votre Avatar</h2>
        
        <h3>Cheveux</h3>
        <button onclick="addHair('avatar/hair1.png')">Choix 1</button>
        <button onclick="addHair('avatar/hair2.png')">Choix 2</button>
        <button onclick="addHair('avatar/hair3.png')">Choix 3</button>
        <button onclick="removeHair()">Retirer les cheveux</button>

        <h3>Yeux</h3>
        <button onclick="addEyes('avatar/yeux1.png')">Choix 1</button>
        <button onclick="addEyes('avatar/yeux2.png')">Choix 2</button>
        <button onclick="addEyes('avatar/yeux3.png')">Choix 3</button>
        <button onclick="removeEyes()">Retirer les yeux</button>

        <h3>Bouche</h3>
        <button onclick="addMouth('avatar/mouth1.png')">Choix 1</button>
        <button onclick="addMouth('avatar/mouth2.png')">Choix 2</button>
        <button onclick="addMouth('avatar/mouth3.png')">Choix 3</button>
        <button onclick="removeMouth()">Retirer la bouche</button>

        <h3>Nez</h3>
        <button onclick="addNose('avatar/nez1.png')">Choix 1</button>
        <button onclick="addNose('avatar/nez2.png')">Choix 2</button>
        <button onclick="addNose('avatar/nez3.png')">Choix 3</button>
        <button onclick="removeNose()">Retirer le nez</button>
    </div>

    <script>
        function addHair(src) {
            var avatar = document.querySelector('.avatar');

            if (src) {
                var hair = document.createElement('img');
                hair.src = src;
                hair.classList.add('hair');
                hair.dataset.part = 'hair';

                avatar.appendChild(hair);
            }
        }

        function removeHair() {
            var avatar = document.querySelector('.avatar');
            var hairElements = avatar.querySelectorAll('[data-part="hair"]');

            hairElements.forEach(function(hair) {
                avatar.removeChild(hair);
            });
        }

        function addEyes(src) {
            var avatar = document.querySelector('.avatar');

            if (src) {
                var eyes = document.createElement('img');
                eyes.src = src;
                eyes.classList.add('eyes');
                eyes.dataset.part = 'eyes';

                avatar.appendChild(eyes);
            }
        }

        function removeEyes() {
            var avatar = document.querySelector('.avatar');
            var eyesElements = avatar.querySelectorAll('[data-part="eyes"]');

            eyesElements.forEach(function(eyes) {
                avatar.removeChild(eyes);
            });
        }

        function addMouth(src) {
            var avatar = document.querySelector('.avatar');

            if (src) {
                var mouth = document.createElement('img');
                mouth.src = src;
                mouth.classList.add('mouth');
                mouth.dataset.part = 'mouth';

                avatar.appendChild(mouth);
            }
        }

        function removeMouth() {
            var avatar = document.querySelector('.avatar');
            var mouthElements = avatar.querySelectorAll('[data-part="mouth"]');

            mouthElements.forEach(function(mouth) {
                avatar.removeChild(mouth);
            });
        }

        function addNose(src) {
            var avatar = document.querySelector('.avatar');

            if (src) {
                var nose = document.createElement('img');
                nose.src = src;
                nose.classList.add('nose');
                nose.dataset.part = 'nose';

                avatar.appendChild(nose);
            }
        }

        function removeNose() {
            var avatar = document.querySelector('.avatar');
            var noseElements = avatar.querySelectorAll('[data-part="nose"]');

            noseElements.forEach(function(nose) {
                avatar.removeChild(nose);
            });
        }
    </script>
    <button onclick="saveAvatar()">Enregistrer l'avatar</button>
    <script>
function saveAvatar() {
    alert('Avatar enregistré comme image de profil !');
}
</script>
</body>
</html>