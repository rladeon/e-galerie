<?php

namespace Controller;

use \Twig_Loader_Filesystem;
use \Twig_Environment;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\Session\Session;

class Controller
{
    protected $twig;
	protected $className;
	protected $seo;
	protected $root;
	protected $session;
	protected $mailconfig; 
	
    function __construct()
    {
      $this->className = strtolower(substr(get_class($this), 11, -10));
      // Twig Configuration
      $loader = new Twig_Loader_Filesystem('./view/');
      $this->twig = new Twig_Environment($loader, array(
          'cache' => false,
      ));
	  $this->session = new Session();
	  $this->session->start();
	 
	  $this->twig->addGlobal('session', $_SESSION);
	  $this->seo = new Slugify();
	  $this->root = "/e-galerie/";
	  $this->mailconfig = array("Host" => 'mail.christianeladeon.com',
		"Port" => 465,
		"Username" => 'info@christianeladeon.com',
		"Password" => 'keGDV.Kn([Bl');
      //
	  
    }
}
?>