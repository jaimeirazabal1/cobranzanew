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
		return $gestiones;
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
}

?>