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
	  
	  $name = 'your name';
	  
	  $sPwd = 'your password';
	  $sPwd = password_hash($sPwd , PASSWORD_BCRYPT, array('cost' => 14));
      $myNewUser = $userMapper->create([
	    'pseudo' => 'admin',
        'name'      => $name,
		'firstname' => 'your firstname',
        'email'     => 'your email',
        'password'  => $sPwd,
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
	
}
?>