<?php

namespace Model;

class Invite extends \Spot\Entity
{
    protected static $table = 'invite';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'title'      => ['type' => 'string', 'required' => true, 'unique' => true],
		'category'      => ['type' => 'string'],
		'path'      => ['type' => 'string','required' => true,],
		'date_limit'     => ['type' => 'date', ],
		'id_exposure' => ['type' => 'integer', 'required' => true],
		
      ];
    }
}
?>