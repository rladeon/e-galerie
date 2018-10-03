<?php

namespace Controller;

use Model\User;

class AdminController extends Controller
{
    public function index()
    {
		if($this->utils->isadmin())
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
	public function booklist()
	{
		if($this->utils->isadmin())
		{
			$mapper = spot()->mapper('Model\Book');
			$books = $mapper->all();
			$list= null;
			foreach( $books as $key=>$book)
			{
				$list[$book->id] = array(
					
					   "id" => $book->id,
					  "author"=> $book->author,
					  "title" => $book->title,
					  "collection"=> $book->collection,
					  "date" => $book->date_publish->format('d/m/Y'),
					  "pages_number"=> $book->pages_number,
					  "format" => $book->format,
					  "slug" => $book->slug,
					  "description"=> $book->description,
					  
					
				);
			}
			
		    echo $this->twig->render($this->className.'/booklist.php',
					[
					  "title" => "Admin",
					  "breadcrumb" => "",
					  "root" => $this->root,
					  "books" => $list,					  
					]);
		}
		else
		{
			echo $this->twig->render($this->className.'/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
	}
	public function updatebook($param)
	{
		if($this->utils->isadmin())
		{
			$mapper = spot()->mapper('Model\Book');
			$book = $mapper->where(["id"=>$param["id"]])->first();
			
			$list = array(
					
					   "id" => $book->id,
					  "author"=> $book->author,
					  "title" => $book->title,
					  "collection"=> $book->collection,
					  "date" => $book->date_publish->format('d/m/Y'),
					  "pages_number"=> $book->pages_number,
					  "format" => $book->format,
					  "slug" => $book->slug,
					  "description"=> $book->description,
					  "price" => $book->price,
					  "weight" => $book->weight,
					
				);
			echo $this->twig->render($this->className.'/updatebook.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,			
						"book" => $list,
					]);
			
		}
		else
		{
			echo $this->twig->render($this->className.'/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
	}
	public function createbook()
	{
		if($this->utils->isadmin())
		{
			echo $this->twig->render($this->className.'/createbook.php',
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
					  "root" => $this->root,					  
					]);
		}
	}
	public function contentlist()
	{
		if($this->utils->isadmin())
		{
			$mapper = spot()->mapper('Model\Content');
			$books = $mapper->all();
			$list= null;
			foreach( $books as $key=>$book)
			{
				$list[$book->id] = array(
					
					   "id" => $book->id,
					  "category"=> $book->category,
					  "title" => $book->title,
					  "author"=> $book->author,
					  "date" => empty($book->date_publish)?null:$book->date_publish->format('d/m/Y'),
					  "published"=> $book->published,
					  "description" => $book->description,
					  "resume" => $book->resume,
					  "description"=> $book->description,
					  //"timestamp" => time(),
					  
					
				);
			}
			
		    echo $this->twig->render($this->className.'/contentlist.php',
					[
					  "title" => "Admin",
					
					  "root" => $this->root,
					  "books" => $list,					  
					]);
		}
		else
		{
			echo $this->twig->render($this->className.'/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
	}
	public function createcontent()
	{
		if($this->utils->isadmin())
		{
			echo $this->twig->render($this->className.'/createcontent.php',
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
					  "root" => $this->root,					  
					]);
		}
	}
	public function updatecontent($param)
	{
		if($this->utils->isadmin())
		{
			$mapper = spot()->mapper('Model\Content');
			$book = $mapper->where(["id"=>$param["id"]])->first();
			$list = array(
					
					   "id" => $book->id,
					  "category"=> $book->category,
					  "title" => $book->title,
					  "author"=> $book->author,
					  "date" => empty($book->date_publish)?null:$book->date_publish->format('d/m/Y'),
					  "published"=> $book->published,
					  "description" => $book->description,
					  "resume" => $book->resume,
					  //"timestamp" => time(),
					  
					
				);
			
			echo $this->twig->render($this->className.'/updatecontent.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,			
						"book" => $list,
					]);
			
		}
		else
		{
			echo $this->twig->render($this->className.'/login.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,					  
					]);
		}
	}
}
?>