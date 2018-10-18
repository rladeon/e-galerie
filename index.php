<?php  

require_once "vendor/autoload.php";
//use Cocur\Slugify\Slugify;
// Spot2 ORM Configuration
function spot() {
    static $spot;
    if ($spot === null) {
      $cfg = new \Spot\Config();
      $cfg->addConnection('mysql', [
          'dbname' => 'egalerie',
          'user' => 'root',
          'password' => 'root',
          'host' => 'localhost',
		  /*'host' => 'db',*/
          'driver' => 'pdo_mysql',
      ]);
      $spot = new \Spot\Locator($cfg);
    }

    return $spot;
}
//
$class = "Controller\\" . (isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'HomeController');
$target = isset($_GET['t']) ? $_GET['t'] : "index";
$getParams = isset($_GET['params']) ? $_GET['params'] : null;
$postParams = isset($_POST['params']) ? $_POST['params'] : null;
$params = [
    "get"  => $getParams,
    "post" => $postParams
];
//$slugify = new Slugify();
//var_dump($slugify->slugify('Hello World!')); // hello-world

if (class_exists($class, true)) 
{
    $class = new $class();
    if (in_array($target, get_class_methods($class))) 
	{
        call_user_func_array([$class, $target], $params);
    }
	else
	{
        //call_user_func([$class, "index"]);
		header('HTTP/1.0 404 Not Found');
		header("Location: /e-galerie/error/error_404"); 
    }
}
else
{
    header('HTTP/1.0 404 Not Found');
	header("Location: /e-galerie/error/error_404"); 
}

?>