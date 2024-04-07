<?php

class loginController extends Controller
{
	protected $oLoginModel;

	public function __construct()
	{
		$this->oLoginModel = new LoginModel();
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
			if (isset($_POST['pseudo'], $_POST['password'])) {
				$userId = $this->oLoginModel->existsUser($_POST['pseudo'], $_POST['password']);
				if ($userId > 0) {
					//error_log("IDENTIFIE");
					$_SESSION['userid'] = $userId;
					$colors = ['#007AFF', '#FF7000', '#FF7000', '#15E25F', '#CFC700', '#CFC700', '#CF1100', '#CF00BE', '#F00'];
					$_SESSION['color'] = $colors[array_rand($colors)];

					header('location:/chatmvc/chat/chatIndex/1');
				} else {
					echo '<script>alert("Problème d\'identifiant ou de mot de passe !")</script>';
				}
			}
		}
		$this->render('loginView');
	}


	public function signup()
	{
		if (isset($_POST['signup'])) {
			if (isset($_POST['pseudo'], $_POST['password'], $_POST['email'])) {
				$userId = $this->oLoginModel->createUser($_POST['pseudo'], $_POST['password'], $_POST['email']);
				if ($userId > 0) {
					echo '<script>alert("Votre enregistrement est réussi !")</script>';
					header('location:/chatmvc/chat/chatIndex/1');
					exit;
				} else {
					echo '<script>alert("Un problème est survenu. Veuillez recommencer niveau user or email");</script>';
				}
			}
		}
		$this->render('signupView');
	}

	public function forgotPassword()
	{
		if (isset($_POST['forgot'])) {
			if (isset($_POST['pseudo'], $_POST['email'], $_POST['new_password'])) {
				if (TRUE === $this->oLoginModel->retrievePassword($_POST['pseudo'], $_POST['email'], $_POST['password'])) {
					header('Location:/chatmvc/login/loginIndex');
					exit;
				}
				else{
					echo '<script>alert("Un problème est survenu. Veuillez recommencer");</script>';
				}
			}
		}
		$this->render('forgotPasswordView');
	}
}
