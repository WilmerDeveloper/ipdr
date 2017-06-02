<?php


Class MonitoringActivitiesController extends AppController {
	public $name='MonitoringActivities';

	function add() {
	if(empty($this->data)){

	
	}else{

	if($this->MonitoringActivity->save($this->data)){
		$this->Session->setFlash('Registro Adicionado correctamente','flash_custom');
		$this->redirect(array( 'controller'=>'MonitoringActivities','action'=>'index')); 
	}else{
		$this->Session->setFlash('Error Guardando datos');
	}
	}
	}
function edit($id){
	$this->MonitoringActivity->recursive=-1;
	if(empty($this->data)){

	$this->data=$this->MonitoringActivity->find('first',array('conditions'=>array('MonitoringActivity.id'=>$id),'fields'=>array( 'MonitoringActivity.id','MonitoringActivity.nombre','MonitoringActivity.tipo','MonitoringActivity.id')) );

	}else{

	if($this->MonitoringActivity->save($this->data)){
		$this->Session->setFlash('Registro editado correctamente','flash_custom');
		$this->redirect(array( 'controller'=>'MonitoringActivities','action'=>'index')); 
	}else{
		$this->Session->setFlash('Error editando datos');
	}
	}
	}
function index() {
	$this->paginate = array('MonitoringActivity' => array('maxLimit' => 500, 'limit' => 50,'fields'=>array( 'MonitoringActivity.id','MonitoringActivity.nombre','MonitoringActivity.tipo','MonitoringActivity.id') ) );
	$this->set('MonitoringActivities',$this->paginate());
	}

} 


?>