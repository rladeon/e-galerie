<?php

namespace Controller;

use \Twig_Loader_Filesystem;
use \Twig_Environment;
use Cocur\Slugify\Slugify;
class Controller
{
    protected $twig;
	protected $className;
	protected $seo;
	protected $root;
	
    function __construct()
    {
      $this->className = strtolower(substr(get_class($this), 11, -10));
      // Twig Configuration
      $loader = new Twig_Loader_Filesystem('./view/');
      $this->twig = new Twig_Environment($loader, array(
          'cache' => false,
      ));
	  $this->seo = new Slugify();
	  $this->root = "/e-galerie/";
      //
	  
    }
}
?>