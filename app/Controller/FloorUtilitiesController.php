<?php

Class FloorUtilitiesController extends AppController {

    public $name = 'FloorUtilities';

    function index($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        $this->paginate = array('FloorUtility' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('FloorUtility.id', 'FloorUtility.clase', 'FloorUtility.agricultura', 'FloorUtility.pecuaria', 'FloorUtility.forestal_productiva', 'FloorUtility.otros_usos', 'FloorUtility.area_no_explotada', 'FloorUtility.forestal_protectora', 'FloorUtility.no_productiva', 'FloorUtility.id')));
        $this->set('FloorUtilities', $this->paginate(array('FloorUtility.property_id' => $property_id)));
    }

    function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->FloorUtility->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FloorUtilities', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->FloorUtility->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->FloorUtility->find('first', array('conditions' => array('FloorUtility.id' => $id), 'fields' => array('FloorUtility.id', 'FloorUtility.clase', 'FloorUtility.agricultura', 'FloorUtility.pecuaria', 'FloorUtility.forestal_productiva', 'FloorUtility.otros_usos', 'FloorUtility.area_no_explotada', 'FloorUtility.forestal_protectora', 'FloorUtility.no_productiva', 'FloorUtility.property_id', 'FloorUtility.id')));
        } else {

            if ($this->FloorUtility->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FloorUtilities', 'action' => 'index', $this->data['FloorUtility']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function delete($floorutility_id, $property_id) {
        $this->layout = "ajax";
        if ($this->FloorUtility->delete($floorutility_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'FloorUtilities', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }

}

?>