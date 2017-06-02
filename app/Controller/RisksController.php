<?php

Class RisksController extends AppController {

    public $name = 'Risks';

    function edit($id) {
        $this->Risk->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Risk->find('first', array('conditions' => array('Risk.id' => $id)));
        } else {

            if ($this->Risk->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Risks', 'action' => 'index',$this->data['Risk']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add($property_id) {
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Risk->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Risks', 'action' => 'index',$property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index($property_id) {
         $this->Risk->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('Risk' => array('maxLimit' => 500, 'limit' => 50));
        $this->set('Risks', $this->paginate(array('Risk.activo'=>1, 'Risk.property_id' => $property_id)));
    }
    
    function delete($risk_id,$property_id) {
        $data=array('Risk'=>array(
            'id'=>$risk_id,
            'activo'=>0,
            'sincronizado'=>0
        ));
         if ($this->Risk->delete($risk_id)) {
                $this->Session->setFlash('Registro borrado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Risks', 'action' => 'index',$property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
            
//         if ($this->Risk->delete($risk_id)) {
//                $this->Session->setFlash('Registro borrado correctamente', 'flash_custom');
//                $this->redirect(array('controller' => 'Risks', 'action' => 'index',$property_id));
//            } else {
//                $this->Session->setFlash('Error Guardando datos');
//            }
    }

}

?>