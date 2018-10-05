<?php

namespace Controller;
use Model\Invite;

class InviteController extends Controller
{
	public function create()
	{
		$inviteMapper = spot()->mapper('Model\invite');
		$inviteMapper->migrate();	  
	 
		$myNewinvite = $inviteMapper->create([
	    
        "title" => 'caraibbean-expo',
		"path" =>"public/files/2018/1/invitation_eng_ladeon.pdf",
		"id_exposure" => 1,
		
		
      ]);
      echo "A new invite has been created: " . $myNewinvite->title;
	}
}
?>