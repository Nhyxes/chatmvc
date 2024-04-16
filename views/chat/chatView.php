<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="aside">
            <div class="link">
                <!-- PHP code to display all rooms -->

                <?php foreach ($rooms as $room) : ?>
                    <?php if (isset($room['room_id']) && isset($room['room_name'])) : ?>
                        <a href="<?php echo $room['room_id']; ?>">
                            <?php echo $room['room_name']; ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>

                <div id="titre">
                    <h3>Vous êtes sur la room : <?= isset($currentRoom['room_name']) ? $currentRoom['room_name'] : '' ?></h3>
                </div>

                <!-- Search button (currently inactive) -->
                <button disabled>Rechercher</button>

                <div class="chat-wrapper">
                    <div id="message-box">
                        <!-- PHP code to display all messages in the current room -->
                        <?php foreach ($messages as $message) : ?>
                            <p style="color:<?echo $message['color'] ?>>
                            <strong><?= $message['username'] ?>:</strong>
                            
                            <?= $message['content'] ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                    <div class="user-panel">
                        <input type="text" name="name" id="name" value="<?= $userName ?>" disabled="disabled" />
                        <input type="text" name="message" id="message" placeholder="Type your message here..." maxlength="100" />
                        <button id="send-message">Send</button>
                    </div>
                </div>

                <script src="../../js/chat.js "></script>
                <script>
                    $(document).ready(function() {
                        $('.room-link').click(function(e) {
                            e.preventDefault();
                            var roomId = $(this).data('id');
                            $.post('../asset/setRoomId.php', {
                                room_id: roomId
                            }, function() {
                                location.reload();
                            });
                        });
                    });
                </script>
            </div>
</body>

</html>