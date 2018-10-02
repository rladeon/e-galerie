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
	public function update($id)
	{
		
		
	}
	public function delete($id)
	{
		
	}
	public function booklist()
	{
		
	}
}
?>