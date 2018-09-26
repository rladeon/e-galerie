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
}
?>