<?php

namespace Controller;
use Model\Invite;

class InviteController extends Controller
{
	public function create()
	{	$this->session->start();
		if(!$this->utils->isadmin())
		{
			echo $this->twig->render('admin/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
		else
		{
			$inviteMapper = spot()->mapper('Model\Exposure');
			$expo = $inviteMapper->all();
			$list = null;
			foreach( $expo as $key=>$value)
			{
				$list[$value->id] = array(
					"id"=> $value->id,
					"title"=>$value->title,
				);
			}
			$m = "";
			
			if(!empty($_SESSION["error"]["message"]))
			{
				$m = $_SESSION["error"]["message"];				
			}
			unset($_SESSION['error']);
			echo $this->twig->render($this->className.'/create.php',
						[
						  "title" => "Admin",					
						  "root" => $this->root,
						  "exposure" => $list,
						  "message" => $m,
						]);
		}
	}
	public function addinvite()
	{
		$this->session->start();
		unset($_SESSION['error']);
		if(!$this->utils->isadmin())
		{
			echo $this->twig->render('admin/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
		else
		{
			$inviteMapper = spot()->mapper('Model\invite');
			$inviteMapper->migrate();	 
			
			if(empty($_POST["title"]))
			{
				$_SESSION['error']["message"] = "Il manque le titre.";
				header('HTTP/1.0 302');
				header("Location: ".$this->root."invite/create"); 
			}
			
			if(!empty($_FILES['path']['name']) && !empty($_POST["exposure"]))
			{
				$myNewinvite = $inviteMapper->create([
				
				"title" => "",
				"path" => "",
						
				]);
				$year = date("Y");
				$path = "/public/files/".$year."/".$myNewinvite->id."/";
				$ret = $this->utils->upload_file($path);
			}
			
			if(empty($_POST["exposure"]))
			{
				$_SESSION["error"]["message"] = "Il manque l'exposition.";
				header('HTTP/1.0 302');
				header("Location: ".$this->root."invite/create");
			}
			if(!empty($ret["result"]) && $ret["result"] == true)
			{					
				$title  = $_POST["title"];
				$id_exposure = $_POST["exposure"];
				$invite  = $inviteMapper->where(["id"=>$myNewinvite->id])->first();
				
				if( $invite == false )
				{
					$_SESSION["error"]["message"] = "L'invitation n'a pas été créée.";
					header('HTTP/1.0 302');
					header("Location: ".$this->root."invite/create");
				}
				else
				{
					$invite->title = $title;
					$invite->path = "public/files/".$year."/".$myNewinvite->id."/".$ret["filename"];
					$invite->id_exposure = $id_exposure;
					$inviteMapper->update($invite);
					header('HTTP/1.0 302');
					header("Location: ".$this->root."invite/getall");
				}
			}
			else
			{
				$_SESSION["error"]["message"] = "Le fichier n'a pas été téléchargé.";
				header('HTTP/1.0 302');
			    header("Location: ".$this->root."invite/create"); 
			}
		}
	}
	public function getall()
	{
		$this->session->start();
		if(!$this->utils->isadmin())
		{
			echo $this->twig->render('admin/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
		else
		{
			$mediaMapper = spot()->mapper('Model\Invite');
			$invite = $mediaMapper->all();
			$list = null;
			foreach( $invite as $key=>$value)
			{
				$expoMapper = spot()->mapper('Model\Exposure');
				$exposure = $expoMapper->where(["id" => $value->id_exposure])->first();
				if(!empty($value->path))
				{
					$list[$value->id] = array(
						"title" => $value->title,
						"path" => $value->path,
						"exposure" => $exposure->title,
						"id" => $value->id,
					);
				}
			}
			echo $this->twig->render($this->className.'/list.php',
					[
					  "title" => "Admin",					
					  "root" => $this->root,
					  "invites" => $list,					  
					]);
		}
	}
	public function updateinvite($param)
	{
		$this->session->start();
		if(!$this->utils->isadmin())
		{
			echo $this->twig->render('admin/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
		else
		{
			$m = "";
			
			if(!empty($_SESSION["error"]["message"]))
			{
				$m = $_SESSION["error"]["message"];				
			}
			unset($_SESSION['error']);
			$inviteMapper = spot()->mapper('Model\Invite');
			$invite = $inviteMapper->where(["id" => $param["id"]])->first();
			$expoMapper = spot()->mapper('Model\Exposure');
			$exposure = $expoMapper->where(["id" => $invite->id_exposure])->first();
			if($invite != false)
			{
				$list = array(
						"title" => $invite->title,
						"path" => $invite->path,
						"title_exposure" => $exposure->title,
						"expo" => $exposure->id,
						"id" => $invite->id,
					);
				$inviteMapper = spot()->mapper('Model\Exposure');
				$expo = $inviteMapper->all();
				$exposure = null;
				foreach( $expo as $key => $value )
				{
					$exposure[$value->id] = array(
						"id" => $value->id,
						"title" => $value->title,
					);
				}
				echo $this->twig->render($this->className.'/updateinvite.php',
					[
					    "title" => "Admin",					
					    "root" => $this->root,
					    "invite" => $list,	
						"exposure" => $exposure,
						"message" => $m,
					]);
			}
		}
	}
	public function update($param)
	{
		$this->session->start();
		if(!$this->utils->isadmin())
		{
			echo $this->twig->render('admin/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
		else
		{
			$inviteMapper = spot()->mapper('Model\invite');
			$inviteMapper->migrate();	 
			
			if(empty($_POST["title"]))
			{
				$_SESSION['error']["message"] = "Il manque le titre.";
				header('HTTP/1.0 302');
				header("Location: ".$this->root."invite/updateinvite/id/".$param["id"]); 
			}
			
			if(!empty($_FILES['path']['name']) )
			{				
				$year = date("Y");
				$path = "/public/files/".$year."/".$param["id"]."/";
				$ret = $this->utils->upload_file($path);
			}
			
			if(empty($_POST["exposure"]))
			{
				$_SESSION["error"]["message"] = "Il manque l'exposition.";
				header('HTTP/1.0 302');
				header("Location: ".$this->root."invite/updateinvite/id/".$param["id"]);
			}
			$title  = $_POST["title"];
			$id_exposure = $_POST["exposure"];
			$invite  = $inviteMapper->where(["id"=>$param["id"]])->first();
			if(!empty($ret["result"]) && $ret["result"] == true)
			{				
				if( $invite == false )
				{
					$_SESSION["error"]["message"] = "L'invitation n'a pas été créée.";
					header('HTTP/1.0 302');
					header("Location: ".$this->root."invite/updateinvite/id/".$param["id"]);
				}
				else
				{
					$invite->title = $title;
					unlink(getcwd().$invite->path);
					$invite->path = "public/files/".$year."/".$param["id"]."/".$ret["filename"];
					$invite->id_exposure = $id_exposure;
					$inviteMapper->update($invite);
					
					header('HTTP/1.0 302');
					header("Location: ".$this->root."invite/getall");
				}
			}
			else
			{
				$invite->title = $title;
				$invite->id_exposure = $id_exposure;
				$inviteMapper->update($invite);
				header('HTTP/1.0 302');
			    header("Location: ".$this->root."invite/getall");
			}
		}
	}
}
?>