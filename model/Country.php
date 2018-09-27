<?php

namespace Model;

class Country extends \Spot\Entity
{
    protected static $table = 'country';

    public static function fields()
    {
      return [
        'id'        => ['type' => 'integer', 'primary' => true, 'autoincrement' => true],
        'code'      => ['type' => 'integer', 'required' => true, 'unique'=>true],
		'alpha2'      => ['type' => 'string', 'required' => true,'unique'=>true],
		'alpha3'      => ['type' => 'string', 'required' => true ,'unique'=>true],
		'nom_en_gb'      => ['type' => 'string', 'required' => true],
		'nom_fr_fr'      => ['type' => 'string', 'required' => true],
		
		
      ];
    }
}
?>