<?php

namespace Controller;
use Model\Book;

class BookController extends Controller
{
    public function show($slug)
    {			
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
					  "breadcrumb" => "",
					  "root" => $this->root,
					  "book" => $value,
					  "media"=> $list_media,
					  
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
		$book = spot()->mapper('Model\Book');
		$book->migrate();	  
		$date = \DateTime::createFromFormat('d/m/Y', '13/10/2017');
				
		$myNewBook = $book->create([

	    'author' => 'Christiane Ladéon',
		"title" => "L'endométriose: De l'ombre à la lumière",
		"collection"=> "Edilivre",
		"date_publish" => $date,
		"pages_number"=> 94,
		"format" => "13x20",
    	"slug" => "christiane-ladeon-l-endometriose-de-l-ombre-a-la-lumiere",
		"description"=> "Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		Nullam faucibus luctus ligula, vitae lacinia eros faucibus ut. 
		Vestibulum eget iaculis ligula. Integer posuere sed nulla nec elementum.
		Nulla convallis nisl id sagittis convallis. Interdum et malesuada 
		fames ac ante ipsum primis in faucibus. Etiam id ex et turpis sollicitudin
		fermentum vitae sit amet urna. Vestibulum faucibus libero non eleifend eleifend.
		Mauris a lectus ac justo dictum porttitor ac id nisi. Donec dapibus dapibus velit,
		eget convallis lorem tempor nec. Fusce malesuada justo ac nibh facilisis imperdiet.
		Vestibulum lectus diam, mollis eget rutrum vitae, aliquet a lorem. Etiam dignissim 
		sem non orci ultricies hendrerit. Nam a augue sed tortor tempor interdum.
		Etiam eget arcu pretium, molestie massa et, posuere justo.",
		
        
      ]);
      echo "A new book has been created: " . $myNewBook->title;
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