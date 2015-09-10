<?php
App::uses('AppModel', 'Model');
class ClienProd extends AppModel {
	public $useTable = 'clien_prod';
	 var $primaryKey = 'unique_id';

    public $hasMany = array(
        'Desincorporado' => array(
            'className'    => 'Desincorporado',
            'foreignKey'   => 'clien_prod_id'
        ),
    );
}

?>