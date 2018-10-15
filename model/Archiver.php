<?php

namespace Model;

class Archiver extends \Spot\Entity
{
    protected static $table = 'archiver';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'id_exposure'  => ['type' => 'integer', 'required' => true],
		'resume'      => ['type' => 'text'],
		'year_expo'      => ['type' => 'integer', 'required' => true],
        		
      ];
    }
}
?>