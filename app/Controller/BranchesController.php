<?php


Class BranchesController extends AppController {
	public $name='Branches';

	function add() {
	$this->set('departaments',$this->Branch->Departament->find('list') );
	if(empty($this->data)){

	
	}else{

	if($this->Branch->save($this->data)){
		$this->Session->setFlash('Registro Adicionado correctamente','flash_custom');
		$this->redirect(array( 'controller'=>'Branches','action'=>'index')); 
	}else{
		$this->Session->setFlash('Error Guardando datos');
	}
	}
	}
function edit($id){
	$this->set('departaments',$this->Branch->Departament->find('list') );
	$this->Branch->recursive=-1;
	if(empty($this->data)){

	$this->data=$this->Branch->find('first',array('conditions'=>array('Branch.id'=>$id)) );

	}else{

	if($this->Branch->save($this->data)){
		$this->Session->setFlash('Registro editado correctamente','flash_custom');
		$this->redirect(array( 'controller'=>'Branches','action'=>'index')); 
	}else{
		$this->Session->setFlash('Error editando datos');
	}
	}
	}
function index() {
	$this->paginate = array('Branch' => array('maxLimit' => 500, 'limit' => 50,'fields'=>array( 'Branch.id','Branch.nombre','Branch.codigo','Branch.director','Branch.direccion','Branch.telefono','Branch.departament_id','Branch.id') ) );
	$this->set('Branches',$this->paginate());
	}

} 


?>