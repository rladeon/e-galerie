<?php

namespace Controller;

use Model\User;

class UserController extends Controller
{
    public function index()
    {
        echo "Hello User Page!";
    }
	/*public function createadmin()
    {
      
      $userMapper = spot()->mapper('Model\User');
      $userMapper->migrate();
	  
	  $sPwd = '*******************';
	  $hash = password_hash($sPwd , PASSWORD_BCRYPT, array('cost' => 14));
      $myNewUser = $userMapper->create([
	    'pseudo' => 'admin',
        'name'      => "ladeon",
		'firstname' => 'rudi',
        'email'     => '**************',
        'password'  => $sPwd,
		'hash' => $hash,
		'admin' => true
      ]);
      echo "A new user has been created: " . $myNewUser->name;
    }*/

    public function getalluser()
    {
      $userMapper = spot()->mapper('Model\User');
      $userMapper->migrate();
      $userList = $userMapper->all();
      echo "List: <br />";
      foreach ($userList as $user) {
        echo $user->name . "<br />";
      }
      echo "---";
    }
	public function login()
	{
		echo $this->twig->render($this->className.'/login.php',
			["title" => "Login",
			"breadcrumb" => "",
			"root" => $this->root,
			
			
			]
		);
	}
	public function verify($param=null)
	{
		if(empty($_POST["username"]))
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il faut renseigner l'identifiant."));
				die();
		}
		else if(empty($_POST["password"]))
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il faut renseigner le mot de passe."));
				die();
		}
		else
		{
			$mapper = spot()->mapper('Model\User');
			$user = $mapper->where(['pseudo' => $_POST["username"] ])->first();
			
			if($user == false)
			{
				echo json_encode(array("result"=>'error', 
					"errors"=>"L'identifiant: ".$_POST["username"]." n'existe pas dans la base de données."));
					die();
			}
			else if($param != null && $param["access"]== "admin")
			{
				if (password_verify($_POST["password"], $user->hash) )
				{
					if($user->admin != true)
					{
						echo json_encode(array("result"=>'error', 
						"errors"=>"Désolé la partie administration est réservé aux utilisateurs ayant le statut admin."));
						die();
					}
					else if($user->admin == true)
					{
						$_SESSION['logged_in'] = true;
						$_SESSION['user'] = array("id"=>$user->id, "is_admin"=>$user->admin);
						echo json_encode(array("result"=>'success', 
						"message"=>"OK"));
						die();
					}
					else
					{
						echo json_encode(array("result"=>'error', 
						"errors"=>"Erreur inexplicable ;-; "));
						die();
					}
				}
				else
				{
					echo json_encode(array("result"=>'error', 
					"errors"=>"Le mot de passe est incorrect!"));
					die();
				}
			}
			else if (password_verify($_POST["password"], $user->hash))
			{
				$_SESSION['logged_in'] = true;
				$_SESSION['user'] = array("id"=>$user->id, "is_admin"=>$user->admin);
				echo json_encode(array("result"=>'success', 
				"message"=>"OK"));
				die();
			} 
			else
			{
				echo json_encode(array("result"=>'error', 
				"errors"=>"Le mot de passe est incorrect!"));
				die();
			}
		}
	}
	public function logout()
	{
		session_destroy();
		header('HTTP/1.0 302');
		header("Location: ". $this->root. "user/login"); 
	}
	public function reset_password()
	{
		
	}
	public function account()
	{
		
			echo $this->twig->render($this->className.'/account.php',
			["title" => "Compte",
			"breadcrumb" => "",
			"root" => $this->root,
			
			
			]
			);
		
	}
}
?>