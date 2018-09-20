<?php

namespace Controller;

use Model\User;

class AdminController extends UserController
{
    public function index()
    {
		if(!empty($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true && $_SESSION["user"]["is_admin"] == true)
		{
			
		    echo $this->twig->render($this->className.'/index.php',
					[
					  "title" => "Admin",
					  "breadcrumb" => "",
					  "root" => $this->root,
					  
					  
					  
					]);
		}
		else
		{
			echo $this->twig->render($this->className.'/login.php',
					[
					  "title" => "Admin",
					  "breadcrumb" => "",
					  "root" => $this->root,
					  
					  
					  
					]);
		}
    }
	
	
}
?>