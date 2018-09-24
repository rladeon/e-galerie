<?php

namespace Model;

class Reservation extends \Spot\Entity
{
    protected static $table = 'reservation';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'id_user'      => ['type' => 'integer', 'required' => true, ],
		'id_exposure'      => ['type' => 'integer', 'required' => true],
		'canceled'      => ['type' => 'boolean','default'=> false, 'value'=> false],
		
		
      ];
    }
}
?>