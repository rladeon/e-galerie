<?php

namespace Model;

class Book extends \Spot\Entity
{
    protected static $table = 'book';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'author'      => ['type' => 'string', 'required' => true, ],
		'title'      => ['type' => 'string', 'required' => true, 'unique' => true],
		'pages_number'      => ['type' => 'integer', 'required' => true],
        'collection'     => ['type' => 'string', 'required' => true],
        'format'  => ['type' => 'string', 'required' => true],
		'slug'  => ['type' => 'string', 'required' => true],
		'description'  => ['type' => 'text', 'required' => true],
		'date_publish'  => ['type' => 'date', 'required' => true],

		'price'     => ['type' => 'decimal', 'default' => 0.00],
		'weight' => ['type' => 'decimal', 'default' => 0.00],
		
      ];
    }
}
?>