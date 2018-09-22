<?php

namespace Model;

class Exposure extends \Spot\Entity
{
    protected static $table = 'exposure';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'title'      => ['type' => 'string', 'required' => true, 'unique' => true],
		'slug'      => ['type' => 'string', 'required' => true],
		'category'      => ['type' => 'string'],
		'date_start'     => ['type' => 'date', 'required' => true],
		'date_end'     => ['type' => 'date', 'required' => true],
        'published'     => ['type' => 'boolean', 'default' => false, 'value'=>false],
        'description'  => ['type' => 'text', 'required' => true],
		'resume'  => ['type' => 'string'],
		'hours' => ['type' => 'string', 'required' => true],
        'nb_place'     => ['type' => 'integer','default' => 0, 'value' => 0],
		'booked' => ['type' => 'integer','default' => 0, 'value' => 0],
		'notfullback' => ['type'=>'boolean','default' => true, 'value' => true],
		'timestamp' => ['type' => 'integer', 'default' => 0, 'value' => 0],
		
      ];
    }
}
?>