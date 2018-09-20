<?php

namespace Controller;

use Model\Content;

class ContentController extends Controller
{
    public function create()
    {
		$userMapper = spot()->mapper('Model\Content');
		$userMapper->migrate();
	    $date = \DateTime::createFromFormat('d/m/Y', '19/05/2017');
		$title = "catalogue n°1 du concours devenez l'artiste de l'année 2017";
		$myNewUser = $userMapper->create([
			
        'title'      => $title,
		'slug'      => $this->seo->slugify($title),
		'category'      => "press",
		"date_publish" => $date,
        'published'     => true,
        'description'  => "Suspendisse lacinia erat risus, ut laoreet nulla commodo vel. Praesent maximus viverra aliquam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer quis augue pretium, ultricies lorem non, interdum quam. Curabitur feugiat non arcu nec pretium. Pellentesque mattis urna pulvinar maximus ultrices. Curabitur interdum, ligula non hendrerit porttitor, metus ligula egestas ipsum, quis pharetra magna enim a metus. Proin eu suscipit turpis, et suscipit nibh. Vestibulum id accumsan magna. Aliquam ante elit, bibendum quis maximus eu, ullamcorper ut nisi. Praesent sagittis tristique ultricies.

Aliquam eget ipsum eu quam porttitor posuere eu et neque. Nulla quis aliquet orci. Pellentesque suscipit risus a nibh consectetur condimentum. Suspendisse in volutpat neque, at ullamcorper enim. Curabitur vitae sapien fringilla, vehicula dui sed, lobortis felis. Suspendisse eleifend augue eros, sit amet mattis nibh posuere quis. Nulla tempor justo est. Mauris quis pellentesque risus. Sed dignissim dignissim lectus ac dignissim. Quisque eu diam viverra, congue magna id, accumsan mi..",
		'resume'  => null,
		'view' => 0,
        'author'     => "",
		'timestamp' => time(),
      ]);
      echo "A new content has been created: " . $myNewUser->title;
	}
}
?>