
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div class="container">
        <div class="aside">
            <div class="link">
                <!-- ici on va remplacer ca par du php -->
                <a href="#" id="Bienvenue">Bienvenue</a>
                <a href="#" id="Vielletechno">Vielletechno</a>
                "php boucle pour afficher toute les sales"
            </div>
            

        </div>

        <div id="titre">
            <h3>Vous êtes sur la room numero "php"</h3>
        </div>

        <!-- <button disabled>Rechercher</button> Bouton de recherche inactif -->

        <div class="chat-wrapper">
            <div id="message-box"></div>
            <div class="user-panel">
                <input type="text" name="name" id="name" placeholder="Your Name" maxlength="15" />
                <input type="text" name="message" id="message" placeholder="Type your message here..." maxlength="100" />
                <button id="send-message">Send</button>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../../js/chat.js "></script>
</body>

</html>