<?php

namespace Model;

class Session extends \Spot\Entity
{
    protected static $table = 'session';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'id_user'      => ['type' => 'integer', 'required' => true, ],
		'expires'      => ['type' => 'integer', 'required' => true],
		'canceled'      => ['type' => 'boolean','default'=> false, 'value'=> false],
		
		
      ];
    }
}
?>