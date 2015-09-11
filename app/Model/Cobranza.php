<?php
App::uses('AppModel', 'Model');
class Cobranza extends AppModel {
	function buscarGestiones($cedula,$empresas) { //Funcion que busca todas las gestiones de un deudor dada su cedula
		$empresas = Set::combine($empresas, '{n}.Cliente.id', '{n}.Cliente.rif');
		foreach ($empresas as $e) {
			$gestiones[$e] = $this->find('all',array(
				'fields' => array('ClienGest.*','Cobranza.*','User.*','Gestor.*'),
				'conditions' => array('Cobranza.CEDULAORIF' => $cedula,'Cobranza.RIF_EMP' => $e),
				'joins' => array(
					array(
						'table' => 'clien_gests',
						'alias' => 'ClienGest',
						'type' => 'INNER',
						'conditions' => array(
							'ClienGest.cedulaorif' => $cedula,
							'ClienGest.rif_emp' => $e,
						)
					),
					array(
						'table' => 'gestors',
						'alias' => 'Gestor',
						'type' => 'INNER',
						'conditions' => array(
							'Gestor.Clave = Cobranza.Gestor',
						),
					),
					array(
						'table' => 'users',
						'alias' => 'User',
						'type' => 'INNER',
						'conditions' => array(
							'User.id = Gestor.user_id',
						)
					)
				),
				'order' => array('ClienGest.id DESC')
			));
		}
		return isset($gestiones) ? $gestiones : null;
	}
	
	function buscarEmpresas($cedula){
		$empresas = $this->find('all',array(
			'fields' => array('DISTINCT(Cobranza.rif_emp)','Cliente.*'),
			'conditions' => array('Cobranza.cedulaorif' => $cedula),
			'joins' => array(
				array(
					'table' => 'clientes',
					'alias' => 'Cliente',
					'type' => 'INNER',
					'conditions' => array(
						'Cliente.rif = Cobranza.rif_emp',
					)
				),
			),
		));
		return($empresas);
	}
	public function paginate($conditions = null, $fields = null, $order = null, $limit, $page = 1,$recursive = null, $extra = array()) {
		
		 
		 $sql = "SELECT * from cobranzas
				INNER JOIN clien_gests on clien_gests.cedulaorif = cobranzas.CEDULAORIF
				INNER JOIN clien_gests c2 on c2.numero = cobranzas.UltGestion

				INNER JOIN gestor on gestor.Clave = cobranzas.Gestor

				limit $limit";
		 $results = $this->query($sql);
		 //die(var_dump($results));
		 return $results;
	}
	public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
		

		/*$sql = "SELECT COUNT(*) from cobranzas
				INNER JOIN clien_gests on clien_gests.cedulaorif = cobranzas.CEDULAORIF
				INNER JOIN clien_gests c2 on c2.numero = cobranzas.UltGestion

				INNER JOIN gestor on gestor.Clave = cobranzas.Gestor limit 10";

		$this->recursive = -1;

		$results = $this->query($sql);
		 die(var_dump($results));
		return $results[0][0]['count'];*/
		 $conditions = compact('conditions');
        if ($recursive != $this->recursive) {
            $conditions['recursive'] = $recursive;
        }
        unset( $extra['contain'] );
        $count = $this->find('count', array_merge($conditions, $extra));
       
            if (isset($extra['group'])) {
                $count = $this->getAffectedRows();
            }
       
        return $count;
	}
}

?>