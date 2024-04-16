<?php

class chatModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }
    //ajouter des bind param avec pdo::PARAM* pour sécuriser les requetes
    public function addMessage(int $userId, int $roomId, string $message): string
    {
        $stmt = $this->_connection->prepare("INSERT INTO messages (user_id ,room_id ,msg_text, msg_color) VALUES (:user_id ,:room_id ,:msg_text, :msg_color)");

        $stmt->execute(
            array(
                ':user_id' => $userId,
                ':room_id' => $roomId,
                ':msg_text' => $message,
                ':msg_color' => $_SESSION['color']
            )
        );
        $lastInsertId = $this->_connection->lastInsertId();
        if ($lastInsertId) {
            return "Message inserted successfully";
        } else {
            return "Message not inserted";
        }
    }

    // recuperer le nom de l'utilisateur par son id
    public function getUserNameById($id)
    {
        $this->id = $id;
        $stmt = $this->_connection->prepare("SELECT user_name FROM users WHERE user_id = :id");
        $stmt->execute(array(':id' => $this->id));
        return $stmt->fetchColumn();
    }

    //recuperer les 10 derniers messages par room_id

    public function getLatestMessagesByRoomId($roomId)
    {
        try {

            $stmt = $this->_connection->prepare("SELECT * FROM messages WHERE room_id = :roomId ORDER BY created_at DESC LIMIT 10");
            $stmt->execute(array(':roomId' => $roomId));
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result ? $result : [];
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
        }
    }


    public function getAllRooms()
    {
        $stmt = $this->_connection->prepare("SELECT * FROM rooms");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    //Récuprer current room
    public function getCurrentRoom($roomId)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM rooms WHERE room_id = :id");
        $stmt->execute(array(':id' => $roomId));
        return $stmt->fetch();
    }

    //recuperer les messages
    public function getMessages()
    {
        $stmt = $this->_connection->prepare("SELECT * FROM messages");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function searchMessages(string $keyword)
    {
        $stmt = $this->_connection->prepare("SELECT * FROM messages WHERE msg_text LIKE :keyword");
        $stmt->execute(array(':keyword' => '%' . $keyword . '%'));
        return $stmt->fetchAll();
    }
}
