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
	public function exposurelist()
	{
		if($this->utils->isadmin())
		{
			$mapper = spot()->mapper('Model\Exposure');
			$books = $mapper->all();
			$list= null;
			foreach( $books as $key=>$book)
			{
				$list[$book->id] = array(
					
					'title'      => $book->title,
					'category'      => $book->category,
					'date_start'     => $book->date_start->format("d/m/Y"),
					'date_end'     => $book->date_end->format("d/m/Y"),
					'published'     => $book->published,
					'description'  => $book->description,
					'resume'  => $book->resume,
					'hours' => $book->hours,
					'nb_place'     => $book->nb_place,
					'booked' => $book->booked,
					'notfullback' => $book->notfullback,
					'timestamp' => $book->timestamp,
					'address'  => $book->address,
					'zipcode'  => $book->zipcode,
					'city'  => $book->city,
					'country'  => $book->country,
					'tel1'  => $book->tel1,
					  
					
				);
			}
			
		    echo $this->twig->render($this->className.'/exposurelist.php',
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
	public function createxposure()
	{
		if($this->utils->isadmin())
		{
			$c = spot()->mapper('Model\Country');
			$countries = $c->all()->order(["nom_fr_fr" => "ASC"]);
			$country = null;
			foreach($countries as $key => $value)
			{
				$country[$value->id] = array(
				"nom_fr_fr" => utf8_encode($value->nom_fr_fr),
				"id" => $value->id,
				"alpha2" => $value->alpha2,
				);
			}
			echo $this->twig->render($this->className.'/createxposure.php',
					[
					  "title" => "Admin",
					  "breadcrumb" => "",
					  "root" => $this->root,
					 	"country" => $country,				  
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