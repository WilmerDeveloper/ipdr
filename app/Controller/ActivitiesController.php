<?php

Class ActivitiesController extends AppController {

    public $name = 'Activities';

    function index($property_id) {
        $this->layout = "ajax";
        $this->Activity->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('Activity' => array('recursive' => 1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('Activity.id', 'Activity.actividad', 'Activity.actividad_realizacion', 'Activity.tipo_otro', 'Activity.frecuencia', 'Activity.property_id')));
        $this->set('Activities', $this->paginate(array('Activity.property_id' => $property_id)));
    }

    function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Activity->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Activities', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($acti_id) {
        $this->layout = "ajax";
        $this->Activity->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Activity->find('first', array('conditions' => array('Activity.id' => $acti_id), 'fields' => array('Activity.id', 'Activity.actividad', 'Activity.actividad_realizacion', 'Activity.tipo_otro', 'Activity.frecuencia', 'Activity.property_id')));
        } else {
            if ($this->Activity->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Activities', 'action' => 'index', $this->data['Activity']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function delete($activity_id, $property_id) {
        $this->layout = "ajax";
        if ($this->Activity->delete($activity_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Activities', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }

}