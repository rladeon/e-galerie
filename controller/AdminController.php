<?php

namespace Controller;

use Model\User;

class AdminController extends Controller
{
    public function index()
    {
        echo $this->twig->render('index.html');
    }
	
	
}
?>