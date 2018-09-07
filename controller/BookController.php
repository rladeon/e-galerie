<?php

namespace Controller;

class BookController extends Controller
{
    public function show($slug)
    {			
		if($slug['page'] == "christiane-ladeon-l-endometriose-de-l-ombre-a-la-lumiere")
		{
			$list = [
			  "root" =>$this->root,	
			  "title" => "Livre", 
			  "auteur"=> "Christiane Ladéon",
			  "titre" => "L'endométriose: De l'ombre à la lumière",
			  "collection"=> "Edilivre",
			  "date" => "Paru le 13 octobre 2017",
			  "nombre_de_pages"=> 94,
			  "format" => "13x20",
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
			  Etiam eget arcu pretium, molestie massa et, posuere justo."
			  
			];
		}
		else
		{
			$list = ["root" =>$this->root];
		}
        echo $this->twig->render($this->className.'/show.php',$list
		);
    }
}
?>