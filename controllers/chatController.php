<?php
class chatController extends Controller
{
    private $userid;
    private $oChatModel;

    public function __construct()
    {
        $this->userid = $_SESSION['userid'];
        $this->oChatModel = new chatModel();
    }

    public function chatIndex($roomId)
    {
        $username = $this->oChatModel->getUserNameById($this->userid);
        
        $data = [
            'rooms' => $this->oChatModel->getAllRooms(),
            'currentRoom' => $this->oChatModel->getCurrentRoom($roomId),
            'messages' => $this->oChatModel->getMessages(),
            'userName' => $username,
        ];


        $this->loadView('chat/chatView', $data);
    }

    public function addMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = $_POST['message'];
            $room_id = $_POST['room_id'];
            $this->oChatModel->addMessage($this->userid, $room_id, $message);
            $this->redirect('chat/chatIndex');
        }
    }

    public function searchMessages()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $keyword = $_GET['keyword'];
            $data = [
                'messages' => $this->oChatModel->searchMessages($keyword),
            ];
            $this->loadView('chat/searchView', $data);
        }
    }

    private function loadView($view, $data)
    {
        extract($data);
        require_once(ROOT . 'views/' . $view . '.php');
    }

    private function redirect($action)
    {
        return header('Location: ' . ROOT . $action);
    }
}
