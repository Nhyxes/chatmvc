<?php

class Controller
{

	public function loadModel(string $model)
	{
		return new $model();
	}

	public function render(string $fichier): void
	{
		$class = strtolower(get_class($this)); // Par exemple : chatController
		$dir = preg_replace("#controller#", "", $class);

		require_once(ROOT . 'views/' . $dir . '/' . $fichier . '.php');
	}
}
 