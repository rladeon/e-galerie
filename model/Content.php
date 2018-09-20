<?php

namespace Model;

class Content extends \Spot\Entity
{
    protected static $table = 'content';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'title'      => ['type' => 'string', 'required' => true, 'unique' => true],
		'slug'      => ['type' => 'string', 'required' => true],
		'category'      => ['type' => 'string'],
		'date_publish'     => ['type' => 'date'],

        'published'     => ['type' => 'boolean', 'default' => false, 'value'=>false],
        'description'  => ['type' => 'text', 'required' => true],
		'resume'  => ['type' => 'string'],
		'view' => ['type' => 'integer', 'default' => 0, 'value' => 0],
        'author'     => ['type' => 'string'],
		'timestamp' => ['type' => 'integer', 'default' => 0, 'value' => 0],
		
      ];
    }
}
?>