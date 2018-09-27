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
	
	public function update_session_params($user)
	{
		$_SESSION['logged_in'] = true;
		$_SESSION['user'] = array("id"=>$user->id, "is_admin"=>$user->admin, 
			"name"=>$user->name, "firstname"=>$user->firstname);
		$_SESSION['ip'] = $this->utils->allIPs();
		$_SESSION['expires_on']=time()+$this->utils->inactivity(); 
		$_SESSION['uid'] = sha1(uniqid('',true).'_'.mt_rand());
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
			$user = $mapper->where(['pseudo' => filter_var($_POST["username"], FILTER_SANITIZE_STRING) ])->first();
			
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
						$this->update_session_params($user);
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
				$this->update_session_params($user);
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
	public function reservation()
	{
		if($this->utils->isloggedin() && !empty($_SESSION["user"]["id"]))
		{
			$user_id = $_SESSION["user"]["id"];
		
			$reservation = spot()->mapper('Model\Reservation');
			$rzr = $reservation->where([ "id_user"=> $user_id]);
			$exposure = spot()->mapper('Model\Exposure');
			$expo = $exposure->all();
			foreach( $rzr as $key=>$value)
			{
				$list[$value->id_exposure] = array(
						"id"=>$value->id,
						"id_exposure" => $value->id_exposure
						
					);
			}
			$list_expo = null;
			
			foreach( $expo as $key=>$value)
			{
				if(!empty($list[$value->id]))
				{
					$list_expo[$value->id] = array(
						"id_reservation" => $list[$value->id]["id"],
						"title" => $value->title,
						"start" => $value->date_start->format("d/m/Y"),
						"end" => $value->date_end->format("d/m/Y"),
						
					);
				}
			}
		}
		else
		{
			$list_expo = null;
		}	
			echo $this->twig->render($this->className.'/reservation.php',
				["title" => "reservation",
				"breadcrumb" => "",
				"root" => $this->root,			
				"reservation" => $list_expo,
			
			]
			);
		
	}
	public function refresh()
	{
		
		if($this->utils->isloggedin() && !empty($_SESSION["user"]["id"]))
		{
			$user_id = $_SESSION["user"]["id"];
			$user = spot()->mapper('Model\User');
			$user = $user->where([ "id"=> $user_id])->first();
			if($user)
			{
				echo $this->twig->render($this->className.'/refresh.php',
					["title" => "refresh",
					"breadcrumb" => "",
					"root" => $this->root,
					"connected" => true,
					"welcome" => $user->name.' '.$user->firstname,
					"name" => $user->name,
					"firstname" => $user->firstname,
					"email" => $user->email,
					"pseudo" => $user->pseudo,
					"id"=> $user->id,
					"error" => false,
					
				]
				);
			}
			else
			{
				echo $this->twig->render($this->className.'/refresh.php',
					["title" => "refresh",
					"breadcrumb" => "",
					"root" => $this->root,	
					"connected" => true,					
					"error" => true,
					"message" =>"L'utilisateur n'existe pas.",
				]
				);				
			}
		}
		else
		{
			echo $this->twig->render($this->className.'/refresh.php',
					["title" => "refresh",
					"breadcrumb" => "",
					"root" => $this->root,	
					"connected" => false,					
				]
				);
		}
	}
	public function update()
	{
		 if(empty($_POST["pseudo"]))
		{	
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il manque le pseudo."));
				die();
		}
		else if(empty($_POST["username"]))
		{	
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il manque le nom."));
				die();
		}
		else if(empty($_POST["firstname"]))
		{	
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il manque le prénom."));
				die();
		}
		else if(empty($_POST["email"]))
		{	
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il manque l'adresse e-mail."));
				die();
		}
		else if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) 
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Cette adresse e-mail n'est pas valide."));
				die();
		}
		else if(empty($_POST["userid"]))
		{	
			echo json_encode(array("result"=>'error', 
				"errors"=>"Il manque l'id utilisateur."));
				die();
		}
		else if (filter_var($_POST["userid"], FILTER_VALIDATE_INT) === false) 
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"L'id n'est pas un entier."));
				die();
		}
		else		
		{
			
			$pseudo = filter_var($_POST["pseudo"], FILTER_SANITIZE_STRING);
			$userm = spot()->mapper('Model\User');
			$userm->migrate();
			$user = $userm->where([ "pseudo"=> $pseudo])->first();
			$id = filter_var($_POST["userid"], FILTER_SANITIZE_NUMBER_INT);
			if($user == false)
			{
				$user = $userm->where([ "id"=> $id ])->first();
				$user->pseudo = $pseudo;
				$userm->update($user);
			}
			$user = $userm->where([ "email"=> $_POST["email"]])->first();
			if($user == false)
			{
				$user = $userm->where([ "id"=> $id])->first();
				$user->email = $_POST["email"];
				$userm->update($user);
			}
			
			$name = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
			$firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
			$user = $userm->where([ "id"=> $id ])->first();
			$user->name = $name;
			$user->firstname = $firstname;
			$userm->update($user);
			$_SESSION['user']["name"] = $name;
			$_SESSION['user']["firstname"] = $firstname;
			
			echo json_encode(array("result"=>'success', 
				"message"=>"Les données ont été mises à jour."));
				die();
		}
	}
}
?>