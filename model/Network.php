<?php

namespace Model;

class Network extends \Spot\Entity
{
    protected static $table = 'network';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'domain'      => ['type' => 'string', 'required' => true, 'unique' => true],
		'home_url'      => ['type' => 'string', 'required' => true,'unique' => true],
		'ip'      => ['type' => 'string', 'required' => true,'unique' => true],
		
		
      ];
    }
}
?>