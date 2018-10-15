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
}
 ?>