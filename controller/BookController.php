<?php

namespace Controller;

class BookController extends Controller
{
    public function show($slug)
    {			
		$list = array(
				1=>array(
				   "id" => 1,
				  "author"=> "Christiane Ladéon",
				  "title" => "L'endométriose: De l'ombre à la lumière",
				  "collection"=> "Edilivre",
				  "date" => "Paru le 13 octobre 2017",
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
				  Etiam eget arcu pretium, molestie massa et, posuere justo."
				  
				),
			);
			$list_media = array( 
				1=>array(
					"path_large" =>"/public/images/2018/1/couverture-du-livre-large.jpg",
					"path_mid" =>"/public/images/2018/1/couverture-du-livre-mid.jpg",
					"path_thumb" =>"/public/images/2018/1/couverture-du-livre-thumb.jpg",
					"id_book" => 1,
					"default_img" => 1,
				),
				26=>array(
					"path_large" =>"/public/images/2018/26/4eme_couverture-large.jpg",
					"path_mid" =>"/public/images/2018/26/4eme_couverture-mid.jpg",
					"path_thumb" =>"/public/images/2018/26/4eme_couverture-thumb.jpg",
					"id_book" => 1,
					"default_img" => 1,
				),
				19=>array(
					"path_large" =>"/public/images/2018/19/dedicace-1-1-large.jpg",
					"path_mid" =>"/public/images/2018/19/dedicace-1-1-mid.jpg",
					"path_thumb" =>"/public/images/2018/19/dedicace-1-1-thumb.jpg",
					"id_book" => 1,
					"default_img" => 1,
				),
				20=>array(
					"path_large" =>"/public/images/2018/20/dedicace-1-2-large.jpg",
					"path_mid" =>"/public/images/2018/20/dedicace-1-2-mid.jpg",
					"path_thumb" =>"/public/images/2018/20/dedicace-1-2-thumb.jpg",
					"id_book" => 1,
					"default_img" => 1,
				),
				21=>array(
					"path_large" =>"/public/images/2018/21/dedicace-1-3-large.jpg",
					"path_mid" =>"/public/images/2018/21/dedicace-1-3-mid.jpg",
					"path_thumb" =>"/public/images/2018/21/dedicace-1-3-thumb.jpg",
					"id_book" => 1,
					"default_img" => 1,
				),
				22=>array(
					"path_large" =>"/public/images/2018/22/dedicace-1-4-large.jpg",
					"path_mid" =>"/public/images/2018/22/dedicace-1-4-mid.jpg",
					"path_thumb" =>"/public/images/2018/22/dedicace-1-4-thumb.jpg",
					"id_book" => 1,
					"default_img" => 1,
				),
				23=>array(
					"path_large" =>"/public/images/2018/23/dedicace-1-5-large.jpg",
					"path_mid" =>"/public/images/2018/23/dedicace-1-5-mid.jpg",
					"path_thumb" =>"/public/images/2018/23/dedicace-1-5-thumb.jpg",
					"id_book" => 1,
					"default_img" => 1,
				),
				24=>array(
					"path_large" =>"/public/images/2018/24/dedicace-1-6-large.jpg",
					"path_mid" =>"/public/images/2018/24/dedicace-1-6-mid.jpg",
					"path_thumb" =>"/public/images/2018/24/dedicace-1-6-thumb.jpg",
					"id_book" => 1,
					"default_img" => 1,
				),
				25=>array(
					"path_large" =>"/public/images/2018/25/dedicace-1-7-large.jpg",
					"path_mid" =>"/public/images/2018/25/dedicace-1-7-mid.jpg",
					"path_thumb" =>"/public/images/2018/25/dedicace-1-7-thumb.jpg",
					"id_book" => 1,
					"default_img" => 1,
				),
			
			);
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
}
?>