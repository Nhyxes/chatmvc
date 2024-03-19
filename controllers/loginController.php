<?php

class loginController
{
	protected $oLoginModel;

	public function __construct()
	{
		$this->oLoginModel = new LoginModel;
	}

	/**
	 * Méthode permettant à l'utilisateur de se logger
	 *
	 * @param 
	 * @return void
	 */
	public function loginIndex()
	{
		// On instancie le modèle "loginModel"
		//$oLoginModel = new loginModel;

		if (isset($_POST['login'])) {
			$userId = $this->oLoginModel->existsUser($_POST['pseudo'], $_POST['password']);

			if ($userId > 0) {
				//error_log("IDENTIFIE");
				$_SESSION['userid'] = $userId;
				$colors = ['#007AFF', '#FF7000', '#FF7000', '#15E25F', '#CFC700', '#CFC700', '#CF1100', '#CF00BE', '#F00'];
				$_SESSION['color'] = $colors[array_rand($colors)];

				header('location:../chatmvcsoluce/chat/chatIndex/1');
			}
		}

		error_log('ici');
		require_once(ROOT . 'views/login/loginView.php');
	}


	public function signup()
	{
		//$oLoginModel = $this->loadModel('loginModel');

		if (isset($_POST['signup'])) {
			$userId = $this->oLoginModel->createUser($_POST['pseudo'], $_POST['password'],$_POST['email']);
			if ($userId > 0) {
				header('location:../chat/chatIndex/1');
			}
		}

		require_once(ROOT . 'views/login/signupView.php');
	}

	public function forgotpassword()
	{
		//$oLoginModel = $this->loadModel('loginModel');

		if (isset($_POST['forgot'])) {
			if (TRUE === $this->oLoginModel->retrievePassword($_POST['pseudo'],$_POST['email'], $_POST['password'])) {
				header('location:login');
			}
		}

		require_once(ROOT . 'views/login/forgotPasswordView.php');
	}
}
