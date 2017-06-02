<?php

Class DegradedAreasController extends AppController {

    public $name = 'DegradedAreas';

    function index($property_id) {
        $this->layout = "ajax";
        $this->DegradedArea->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('DegradedArea' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('DegradedArea.id', 'DegradedArea.causa', 'DegradedArea.area', 'DegradedArea.porcentaje', 'DegradedArea.property_id')));
        $this->set('DegradedAreas', $this->paginate(array('DegradedArea.property_id' => $property_id)));
    }

    function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->DegradedArea->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'DegradedAreas', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->DegradedArea->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->DegradedArea->find('first', array('conditions' => array('DegradedArea.id' => $id), 'fields' => array('DegradedArea.id', 'DegradedArea.causa', 'DegradedArea.area', 'DegradedArea.porcentaje',  'DegradedArea.property_id')));
        } else {
            if ($this->DegradedArea->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'DegradedAreas', 'action' => 'index', $this->data['DegradedArea']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function delete($degraded_id, $property_id) {
        $this->layout = "ajax";
        if ($this->DegradedArea->delete($degraded_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'DegradedAreas', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }

}