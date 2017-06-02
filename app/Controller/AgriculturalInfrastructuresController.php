<?php

Class AgriculturalInfrastructuresController extends AppController {

    public $name = 'AgriculturalInfrastructures';

    function add($property_id) {
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->AgriculturalInfrastructure->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'AgriculturalInfrastructures', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->AgriculturalInfrastructure->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->AgriculturalInfrastructure->find('first', array('conditions' => array('AgriculturalInfrastructure.id' => $id)));
        } else {

            if ($this->AgriculturalInfrastructure->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'AgriculturalInfrastructures', 'action' => 'index', $this->data['AgriculturalInfrastructure']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($property_id) {
        $this->set('property_id', $property_id);
        $this->AgriculturalInfrastructure->recursive = -1;
        $this->paginate = array('AgriculturalInfrastructure' => array('maxLimit' => 500, 'limit' => 50, 'recursive' => -1));
        $this->set('AgriculturalInfrastructures', $this->paginate(array('AgriculturalInfrastructure.activo'=>1, 'AgriculturalInfrastructure.property_id' => $property_id)));
    }

    function delete($estructure_id, $property_id) {
        $datos=array('AgriculturalInfrastructure'=>array(
            'id'=>$estructure_id,
            'sincronizado'=>0,
            'activo'=>0
        ));
        if ($this->AgriculturalInfrastructure->save($datos)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'AgriculturalInfrastructures', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error editando datos');
        }
//        if ($this->AgriculturalInfrastructure->delete($estructure_id)) {
//            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
//            $this->redirect(array('controller' => 'AgriculturalInfrastructures', 'action' => 'index', $property_id));
//        } else {
//            $this->Session->setFlash('Error editando datos');
//        }
    }

}

?>