<?php

namespace Controller;

class HomeController extends Controller
{
    public function index()
    {
        echo $this->twig->render($this->className.'/index.php',
		[
          "title" => "Accueil"
        ]);
    }
}
?>