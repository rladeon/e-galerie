<?php

namespace Controller;

use Model\Content;

class ContentController extends Controller
{
    public function create()
    {
		if($this->utils->isadmin())
		{
			$userMapper = spot()->mapper('Model\Content');
			$userMapper->migrate();
			if(empty($_POST["date_publish"]))
			{
				$date = null;
			}
			else
			{
				$date = \DateTime::createFromFormat('d/m/Y', $_POST["date_publish"]);
			}
			$title = $_POST["title"];
			$category = empty($_POST["category"])?null:$_POST["category"];
			$resume = empty($_POST["resume"])?null:$_POST["resume"];

			$published = empty($_POST["published"])?false:$_POST["published"];
			$description = $_POST["description"];
			$author = empty($_POST["author"])?null:$_POST["author"];

			$myNewUser = $userMapper->insert([
				
			'title'      => $title,
			'slug'      => $this->seo->slugify($title),
			'category'      => $category,
			"date_publish" => $date,
			'published'     => $published,
			'description'  => $description,
			'resume'  => $resume,
			'author'     => $author,
			'timestamp' => time(),
		  ]);
			if($myNewUser == false)
			{
				echo json_encode(array("result"=>'error', 
				"errors"=>"Le contenu n'a pas été ajouté."));
				die();
			}
			else
			{
				echo json_encode(array("result"=>'success', 
					"message"=>"Le contenu a été ajouté."));
					die();
			}
		}
		else
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Vous n'êtes pas connecté."));
				die();
		}
	}
	public function update($param)
	{
		if($this->utils->isadmin())
		{
			$userMapper = spot()->mapper('Model\Content');
			$userMapper->migrate();
			if(empty($_POST["date_publish"]))
			{
				$date = null;
			}
			else
			{
				$date = \DateTime::createFromFormat('d/m/Y', $_POST["date_publish"]);
			}
			$title = $_POST["title"];
			$category = empty($_POST["category"])?null:$_POST["category"];
			$resume = empty($_POST["resume"])?null:$_POST["resume"];

			$published = empty($_POST["published"])?false:$_POST["published"];
			$description = $_POST["description"];
			$author = empty($_POST["author"])?null:$_POST["author"];

			$content = $userMapper->where(["id" => $param["id"]])->first();
				
			$content->title = $title;
			$content->slug = $this->seo->slugify($title);
			$content->category = $category;
			$content->date_publish = $date;
			$content->published = $published;
			$content->description = $description;
			$content->resume = $resume;
			$content->author = $author;
			$content->timestamp = time();
		 
		  $myNewUser = $userMapper->update($content);
			if($myNewUser == false)
			{
				echo json_encode(array("result"=>'error', 
				"errors"=>"Le contenu n'a pas été mis à jour."));
				die();
			}
			else
			{
				echo json_encode(array("result"=>'success', 
					"message"=>"Le contenu a été mis à jour."));
					die();
			}
		}
		else
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Vous n'êtes pas connecté."));
				die();
		}
	}
	public function delete($param)
	{
		if($this->utils->isadmin())
		{
			$book = spot()->mapper('Model\Content');

			$b = $book->where(["id"=>$param["id"]])->first();		
			if($b == false)
			{
				 echo json_encode(array("result"=>'error', 
				"errors"=>"L'id de ce contenu n'existe pas dans la base données."));
				die();
			}
			else
			{
				$myNewBook = $book->delete(["id"=>$param["id"]]);
				if($myNewBook == false)
				 {
					 echo json_encode(array("result"=>'error', 
					"errors"=>"Le contenu n'a pas été supprimé."));
					die();
				 }
				 else
				 {
					echo json_encode(array("result"=>'success', 
						"message"=>"Le contenu a été supprimé."));
						die();
				 }
			}	
		}
		else
		{
			echo json_encode(array("result"=>'error', 
				"errors"=>"Vous n'êtes pas connecté."));
				die();			
		}
	}
	public function cgu()
	{
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array("CGU"=> "content/cgu"),$net->home_url);
		$content = "";
		$book = spot()->mapper('Model\Content');

		$content = $book->where(["title"=>"cgu"])->first();
		echo $this->twig->render($this->className.'/cgu.php',
			["title" => "CGU",
			"breadcrumb" => $breadcrumb,
			"root" => $this->root,
			"content" => $content->description,
			
			
			]
		);
	}
	public function legitmention()
	{
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array("mentions légales"=> "content/legitmention"),$net->home_url);
		$content = "";
		$book = spot()->mapper('Model\Content');

		$content = $book->where(["title"=>"politique de confidentialité"])->first();
		echo $this->twig->render($this->className.'/legitmention.php',
			["title" => "RGPD",
			"breadcrumb" => $breadcrumb,
			"root" => $this->root,
			"content" => $content->description,
			
			
			]
		);
	}
}
?>