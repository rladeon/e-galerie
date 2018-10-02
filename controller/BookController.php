<?php

namespace Controller;
use Model\Book;

class BookController extends Controller
{
    public function show($slug)
    {	
		$mapper = spot()->mapper('Model\Network');
		$net = $mapper->all()->first();
		$breadcrumb = $this->utils->build_breadcrumb(array("Livre"=> "book/show/page/".$slug['page'] ),$net->home_url);
		$url = $net->home_url."/book/show/page/".$slug['page'];
		$mapper = spot()->mapper('Model\Book');
		$book = $mapper->where(['slug' => $slug['page'] ])->first();
		if($book != false)
		{
			
			$list = array(
				$book->id=>array(
				   "id" => $book->id,
				  "author"=> $book->author,
				  "titre" => $book->title,
				  "collection"=> $book->collection,
				  "date" => $book->date_publish->format('d/m/Y'),
				  "pages_number"=> $book->pages_number,
				  "format" => $book->format,
    			  "slug" => $book->slug,
				  "description"=> $book->description,
				  
				),
			);
		}
		$mapper = spot()->mapper('Model\Media');
		// Where can be called directly from the mapper
		$posts = $mapper->all()->where(['id_book !=' => null]);
		$list_media = null;
		
		foreach( $posts as $key=>$value)
		{
			$list_media[$value->id] = array(
					
					"path_large" => $value->path_large,
					"path_mid" => $value->path_mid,
					"path_thumb" => $value->path_thumb,
					"id_book" =>$value->id_book,
					"default_img" =>$value->default_img
					
				);
		}//var_dump($list_media);
			
			foreach($list as $key =>$value)
			{
				if($slug['page'] == $value["slug"])
				{
					echo $this->twig->render($this->className.'/show.php',
					[
					  "title" => "Livre",
					  "breadcrumb" => $breadcrumb,
					  "root" => $this->root,
					  "book" => $value,
					  "media"=> $list_media,
					  "url" => $url,
					  
					]);
					break;
				}
				else
				{
					echo $this->twig->render($this->className.'/show.php',
					[
					  "title" => "Livre",
					  "breadcrumb" => "",
					  "root" => $this->root,
					  "book" => null,
					  "media"=> $list_media,
					  
					]);
				}
			}
    }
	public function create()
	{
		if($this->utils->isadmin())
		{
			$author = $_POST["author"];
			$title = $_POST["title"];
			$collection = $_POST["collection"];
			$pages_number = $_POST["pages_number"];
			$format = $_POST["format"];
			$slug = $this->seo->slugify($title);
			$date_publish = $_POST["date_publish"];
			$price = $_POST["price"];
			$weight = $_POST["weight"];
			$format = $_POST["format"];
			$description = $_POST["description"];
			
			$book = spot()->mapper('Model\Book');
			$book->migrate();	  
			$date = \DateTime::createFromFormat('d/m/Y', $date_publish);
					
			$myNewBook = $book->insert([

			'author' => $author,
			"title" => $title,
			"collection"=> $collection,
			"date_publish" => $date,
			"pages_number"=> $pages_number,
			"format" => $format,
			"slug" => $slug,
			"description"=> $description,
			"price" => $price,
			"weight" => $weight,		
			
		  ]);
			 if($myNewBook == false)
			 {
				 echo json_encode(array("result"=>'error', 
				"errors"=>"Le livre n'a pas été enregistré."));
				die();
			 }
			 else
			 {
				echo json_encode(array("result"=>'success', 
					"message"=>"A new book has been created"));
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
	
	public function read($id)
	{
		
	}
	public function update($param)
	{
		if($this->utils->isadmin())
		{
			$author = $_POST["author"];
			$title = $_POST["title"];
			$collection = $_POST["collection"];
			$pages_number = $_POST["pages_number"];
			$format = $_POST["format"];
			$slug = $this->seo->slugify($title);
			$date_publish = $_POST["date_publish"];
			$price = $_POST["price"];
			$weight = $_POST["weight"];
			
			$description = $_POST["description"];
			
			$book = spot()->mapper('Model\Book');
			$book->migrate();	  
			$date = \DateTime::createFromFormat('d/m/Y', $date_publish);
			$b = $book->where(["id"=>$param["id"]])->first();		
			if($b == false)
			{
				 echo json_encode(array("result"=>'error', 
				"errors"=>"L'id de ce livre n'existe pas dans la base données."));
				die();
			}
			else
			{
				
				$b->author = $author;
				$b->title = $title;
				$b->collection = $collection;
				$b->date_publish = $date;
				$b->pages_number = $pages_number;
				$b->format = $format;
				$b->slug = $slug;
				$b->description = $description;
				$b->price = number_format($price, 2, '.', '');
				$b->weight = number_format($weight, 2, '.', '');
				$myNewBook = $book->update($b);
				
			}			
		 
			 if($myNewBook == false)
			 {
				 echo json_encode(array("result"=>'error', 
				"errors"=>"Le livre n'a pas été mis à jour."));
				die();
			 }
			 else
			 {
				echo json_encode(array("result"=>'success', 
					"message"=>"Le livre a été mis à jour."));
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
			$book = spot()->mapper('Model\Book');

			$b = $book->where(["id"=>$param["id"]])->first();		
			if($b == false)
			{
				 echo json_encode(array("result"=>'error', 
				"errors"=>"L'id de ce livre n'existe pas dans la base données."));
				die();
			}
			else
			{
				$myNewBook = $book->delete(["id"=>$param["id"]]);
				if($myNewBook == false)
				 {
					 echo json_encode(array("result"=>'error', 
					"errors"=>"Le livre n'a pas été supprimé."));
					die();
				 }
				 else
				 {
					echo json_encode(array("result"=>'success', 
						"message"=>"Le livre a été supprimé."));
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
	
}
?>