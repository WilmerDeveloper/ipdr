<?php

Class ProducersController extends AppController {

    public $name = 'Producers';

    function edit($id) {
        $this->layout = "ajax";
        $this->Producer->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Producer->find('first', array('conditions' => array('Producer.id' => $id),));
        } else {

            if ($this->Producer->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Producers', 'action' => 'index', $this->data['Producer']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Producer->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Producers', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index($property_id) {
        $this->Producer->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('Producer' => array('maxLimit' => 500, 'limit' => 50));
        $this->set('Producers', $this->paginate(array('Producer.property_id' => $property_id ,'Producer.activo'=>1) ));
    }

    function delete($producer_id, $property_id) {
        $datos=array('Producer'=>array(
            'id'=>$producer_id,
            'activo'=>0,
            'sincronizado'=>0,
        ));
        if($this->Producer->save($datos) ) {
            
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Producers', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
        
        
//        if ($this->Producer->delete($producer_id)) {
//            $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
//            $this->redirect(array('controller' => 'Producers', 'action' => 'index', $property_id));
//        } else {
//            $this->Session->setFlash('Error Guardando datos');
//        }
    }

}

?>