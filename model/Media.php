<?php

namespace Model;

class Media extends \Spot\Entity
{
    protected static $table = 'media';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'title'      => ['type' => 'string', 'required' => true, 'unique' => true],
		'path_large'      => ['type' => 'string', 'required' => true],
		'path_mid'      => ['type' => 'string', 'required' => true],
		'path_thumb'      => ['type' => 'string', 'required' => true],
		'extension'      => ['type' => 'string'],
        'size'     => ['type' => 'integer'],
        'id_book'  => ['type' => 'integer'],
		'id_content'  => ['type' => 'integer'],
		'id_exposure'  => ['type' => 'integer'],
		'category' => ['type' => 'string'],
        'datacateg'     => ['type' => 'string'],
		'default_img' => ['type' => 'boolean', 'default' => false],
		'gallery' => ['type' => 'boolean', 'default' => false],
		'timestamp' => ['type' => 'integer', 'default' => time()],

      ];
    }
	
}
?>