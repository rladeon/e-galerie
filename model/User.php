<?php

namespace Model;

class User extends \Spot\Entity
{
    protected static $table = 'user';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'pseudo'      => ['type' => 'string', 'required' => true, 'unique' => true],
		'name'      => ['type' => 'string', 'required' => true],
		'firstname'      => ['type' => 'string', 'required' => true],
        'email'     => ['type' => 'string', 'required' => true, 'unique' => true],
        'password'  => ['type' => 'string', 'required' => true],
		'role' => ['type' => 'integer', 'default' => null, 'value' => null],
        'admin'     => ['type' => 'boolean', 'default' => false, 'value' => false],
		'activate' => ['type' => 'boolean', 'default' => false, 'value' => false],
      ];
    }
}
?>