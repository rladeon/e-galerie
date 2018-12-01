<?php

namespace Controller;
use Model\Media;

class ArchiverController extends Controller
{
	public function create()
	{
		$mediaMapper = spot()->mapper('Model\Archiver');
		$mediaMapper->migrate();	  
	 
		$myNewMedia = $mediaMapper->create([
	    
        "id_exposure" => 1,
		"resume" => "hello world",
		
		"year_expo" => 2018,
				
      ]);
      echo "A new archive has been created: " . $myNewMedia->year_expo;
	}	
	public function getall()
	{
		if(!$this->utils->isadmin())
		{
			
		    echo $this->twig->render('admin/login.php',
					[
					  "title" => "Admin",
					  "breadcrumb" => "",
					  "root" => $this->root,
					  
					  
					  
					]);
		}
		else
		{
			$m = spot()->mapper('Model\Archiver');
			$a = $m->all();	  
			$list = null;
			foreach( $a as $key=>$b)
			{
				$e = spot()->mapper('Model\Exposure');
				$exposure = "";
				if($e != false)
				{
					$expo = $e->where(["id"=>$b->id_exposure])->first();
					if($expo !=false)
					{	
						$exposure = $expo->title;
						$date_expo = $expo->date_start->format('d/m/Y');
					}
				}
				$list[$b->id] = array(
					
					"exposure" => $exposure,
					"date"=> $date_expo,
					  
				);
			}
			
			echo $this->twig->render($this->className.'/getall.php',
					[
					  "title" => "Admin",
					  "archivers" => $list,
					  "root" => $this->root,			  
					  
					]);
		}
		
	}	
	public function update($param)
	{
		$mediaMapper = spot()->mapper('Model\Archiver');
		$mediaMapper->migrate();	  
	 
		$myNewMedia = $mediaMapper->create([
	    
        "id_exposure" => 1,
		"resume" => "hello world",
		
		"year_expo" => 2018,
				
      ]);
      echo "A new archive has been created: " . $myNewMedia->year_expo;
	}	
	public function delete($param)
	{
		$mediaMapper = spot()->mapper('Model\Archiver');
		$mediaMapper->migrate();	  
	 
		$myNewMedia = $mediaMapper->create([
	    
        "id_exposure" => 1,
		"resume" => "hello world",
		
		"year_expo" => 2018,
				
      ]);
      echo "A new archive has been created: " . $myNewMedia->year_expo;
	}	
}
 ?>