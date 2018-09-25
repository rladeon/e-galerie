<?php

namespace Component;
define('INACTIVITY_TIMEOUT',3600*2);

class Utils
{
	public function inactivity()
	{
		return INACTIVITY_TIMEOUT;
	}
	public function allIPs()
	// Returns the IP address of the client (Used to prevent session cookie hijacking.)
	{
		$ip = $_SERVER["REMOTE_ADDR"];
		// Then we use more HTTP headers to prevent session hijacking from users behind the same proxy.
		if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { $ip=$ip.'_'.$_SERVER['HTTP_X_FORWARDED_FOR']; }
		if (isset($_SERVER['HTTP_CLIENT_IP'])) { $ip=$ip.'_'.$_SERVER['HTTP_CLIENT_IP']; }
		return $ip;
	}
	public function isloggedin()
	{
		// If session does not exist on server side, or IP address has changed, or session has expired, show login screen.
		if (!isset ($_SESSION['uid']) || !$_SESSION['uid'] || $_SESSION['ip']!= $this->allIPs() || time()>=$_SESSION['expires_on'])
		{
			if (session_status() != PHP_SESSION_NONE) 
			{
				//session_destroy();
			}
			
			return false;
		}
		$_SESSION['expires_on']=time()+INACTIVITY_TIMEOUT;  // User accessed a page : Update his/her session expiration date.
		return true;
	}
}

?>