<?php
//require_once 'Controller.php';

class chatController extends Controller
{
	private $userid;
	private $oChatModel;

	public function __construct()
	{
		$this->userid = $_SESSION['userid'];
		$this->oChatModel = new chatModel();
	}

	public function chatIndex()
	{
		$roomId = 
		$data = [
			$data ['room'] = $thisochatmodel->getRoom
		]
		require_once(ROOT . 'views/chat/chatView.php');
	}

	public function addMessage(){
		
	}


	public function searchMessages(){

	}

	
	// class enfant de controller donc elle va recevoir les noms des fichiers et l'envoyer a controller 

	// elle va appeler la fonction isertMessage en lui envoyant (int $userId, int $roomId, string $message) : string cela signifie que la fonction va recevoir un string; ce string sera utilisé avec une fonction 

	// recuperation des diferents userid de la room dans laquelle il se trouve et le message qu'il veut inserer

	//----------------------------------------------------------------
	//a cette etape il faut faire la partie layout qui qui est la partie js pour pouvoir contineur 
}
