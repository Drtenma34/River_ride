<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Captcha Puzzle</title>
        <link rel="stylesheet" href="puzzle.css">
        <script src="puzzle.js"></script>
    </head>

   <p class = "text-black">Résolvez ce puzzle pour vous inscrire ! </p>
    <body>
        <br>
        <div id="tab"></div>
        <h2>Turns: <span id="turns">0</span></h2>
        <div id="pieces"></div>
        <button onclick="validateCaptchaPuzzle()">Valider le Captcha</button>
    </body>
</html>
