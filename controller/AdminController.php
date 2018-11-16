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
					  "id"=> $book->id,
					
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
	public function updatexposure($param)
	{
		if($this->utils->isadmin())
		{
			$mapper = spot()->mapper('Model\Exposure');
			$b = $mapper->where(["id"=>$param["id"]])->first();
			
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
			$list = array(
					
				"title" => $b->title,
				"category" => $b->category,
				"date_start" => $b->date_start->format("d/m/Y"),
				"date_end" => $b->date_end->format("d/m/Y"),
				"published" => $b->published,
				"description" => $b->description,
				"resume" => $b->resume,
				"hours" => $b->hours,
				"nb_place" => $b->nb_place,
				
				"timestamp" => time(),
				"tel1" => $b->tel1,
				"address" => $b->address,
				"zipcode" => $b->zipcode,
				"city" => $b->city,
				"id" => $b->id,
				
					
				);
			echo $this->twig->render($this->className.'/updatexposure.php',
					[
					  "title" => "Admin",					  
					  "root" => $this->root,			
						"book" => $list,"country" => $country,"landofsalty" => $b->country,
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
	public function medialist()
	{
		if($this->utils->isadmin())
		{
			$mapper = spot()->mapper('Model\Media');
			$medias = $mapper->all()->order(["timestamp" => "DESC"]);
			$mapper = spot()->mapper('Model\Book');
			$b = $mapper->all();
			$mapper = spot()->mapper('Model\Content');
			$c = $mapper->all();
			$mapper = spot()->mapper('Model\Exposure');
			$e = $mapper->all();
			$list= null;$blist= null;$clist= null;$elist= null;
			foreach( $b as $key=>$book)
			{
				$blist[$book->id] = array(
					'title'      => $book->title,					
					"id"=> $book->id,					
				);
			}
			foreach( $c as $key=>$book)
			{
				$clist[$book->id] = array(					
					'title'      => $book->title,					
					"id"=> $book->id,					
				);
			}
			foreach( $e as $key=>$book)
			{
				$elist[$book->id] = array(					
					'title'      => $book->title,
					"id"=> $book->id,					
				);
			}
			
			foreach( $medias as $key=>$m)
			{
				$link = false;
				if(!empty($m->id_book))
				{
					if(!empty($blist[$m->id_book]))
					{
						$link = $blist[$m->id_book]["title"];
					}
				}
				else if(!empty($m->id_content))
				{
					if(!empty($clist[$m->id_content]))
					{
						$link = $clist[$m->id_content]["title"];
					}
				}
				else if(!empty($m->id_exposure))
				{
					if(!empty($elist[$m->id_exposure]))
					{
						$link = $elist[$m->id_exposure]["title"];
					}
				}
				
				$list[$m->id] = array(
					
					'title'      => $m->title,
					'path_large'      => $m->path_large,
					'path_mid'      => $m->path_mid,
					'path_thumb'      => $m->path_thumb,
					'path_flyer'      => $m->path_flyer,
					'id_book'  => $m->id_book,
					'id_content'  => $m->id_content,
					'id_exposure'  => $m->id_exposure,
					"id"=> $m->id,
					"link" => $link,
					
				);
			}
			
		    echo $this->twig->render($this->className.'/medialist.php',
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
	public function updatemedia($param)
	{
		if($this->utils->isadmin())
		{
			$mapper = spot()->mapper('Model\Media');
			$medias = $mapper->where(["id"=>$param["id"]])->first();
			$mapper = spot()->mapper('Model\Exposure');
			$exposures = $mapper->all();
			$mapper = spot()->mapper('Model\Content');
			$contents = $mapper->all();
			$mapper = spot()->mapper('Model\Book');
			$books = $mapper->all();
			$list = null;
			$blist= null;$clist= null;$elist= null;
			foreach( $books as $key=>$book)
			{
				$blist[$book->id] = array(
					'title'      => $book->title,					
					"id"=> $book->id,					
				);
			}
			foreach( $contents as $key=>$c)
			{
				$clist[$c->id] = array(					
					'title'      => $c->title,					
					"id"=> $c->id,					
				);
			}
			foreach( $exposures as $key=>$e)
			{
				$elist[$e->id] = array(					
					'title'      => $e->title,
					"id"=> $e->id,					
				);
			}
			if($medias == false)
			{
				echo $this->twig->render($this->className.'/updatemedia.php',
					[
					  "title" => "Admin",					
					  "root" => $this->root,
					 	"error" => true,
						"message" => "l'id de cette image n'existe pas",						
					]);
			}
			else
			{
				$list = array(
				"id"=>$medias->id,
				"title"=>$medias->title,
				"category"=>$medias->category,
				"datacateg"=>$medias->datacateg,
				"defaultimg"=>$medias->default_img,
				"gallery"=>$medias->gallery,
				"idofcontent" =>$medias->id_content,
				"idofbook" =>$medias->id_book,
				"idofexposure" =>$medias->id_exposure,
				);
				echo $this->twig->render($this->className.'/updatemedia.php',
					[
					  "title" => "Admin",					
					  "root" => $this->root,
					 	"error" => false,			  
						"media" => $list,
						"book" => $blist,
						"content" => $clist,
						"exposure" => $elist,
						
					]);
			}
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
	public function updateimage($param)
	{
		if($this->utils->isadmin())
		{
			$mapper = spot()->mapper('Model\Media');
			$mapper->migrate();
			$medias = $mapper->where(["id"=>$param["id"]])->first();
			
			$list = null;
			
			if($medias == false)
			{
				echo $this->twig->render($this->className.'/updateimage.php',
					[
					  "title" => "Admin",					
					  "root" => $this->root,
					 	"error" => true,
						"message" => "l'id de cette image n'existe pas",						
					]);
			}
			else
			{
				$message = "";
				if(!empty($_POST["id"]) && $_POST["id"] == $param["id"])
				{
					$year = date("Y");
					$id = $medias->id;
					$path = "/public/images/".$year."/".$id."/";
					$ret = $this->utils->upload_file($path);
					$message = $ret["message"];
					if(!empty($ret["result"]) && $ret["result"] == true)
					{
						$sizes = array("-large."=>1000, "-mid."=>300, "-thumb."=>100); 
						$uploadpath = $ret["uploadpath"];
						$currentDir = getcwd();
						
						foreach($sizes as $key=>$value)
						{
							$this->utils->resize_image($uploadpath, $ret["path"].'/'.$this->utils->remove_extension($ret["filename"]).$key.$this->utils->get_extension($ret["filename"]), $width = 0, $height = $value);
							$filepath = "public/images/".$year."/".$id."/".$this->utils->remove_extension($ret["filename"]).$key.$this->utils->get_extension($ret["filename"]);
							
							if( $value == 1000 )
							{
								unlink($currentDir."/".$medias->path_large);
								$medias->path_large = $filepath;
							}
							else if( $value == 300)
							{
								unlink($currentDir."/".$medias->path_mid);
								$medias->path_mid = $filepath;
							}
							else
							{
								unlink($currentDir."/".$medias->path_thumb);
								$medias->path_thumb = $filepath;
							}
							$medias->extension = $ret["fileExtension"];
							$medias->timestamp = time();
							$mapper->update($medias);
						
						}
						
						unlink($uploadpath);
						header('HTTP/1.0 302');
						header("Location: ".$this->root."admin/medialist"); 
					}
				}
				$list = array(
				"id" => $medias->id,
				"title" => $medias->title,
				"path" => $medias->path_mid,
				);
				echo $this->twig->render($this->className.'/updateimage.php',
					[
					  "title" => "Admin",					
					  "root" => $this->root,
					 	"error" => false,			  
						"media" => $list,
						"message" => $message,
						
					]);
			}
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