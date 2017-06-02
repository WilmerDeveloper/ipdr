<?php

Class EnvironmentsController extends AppController {

    public $name = 'Environments';

    function index($property_id) {
        $this->layout = "ajax";
        $this->Environment->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('Environment' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Environment.id', 'Environment.inundacion_area', 'Environment.inundacion_periodo', 'Environment.derrumbe_area', 'Environment.derrumbe_ubicacion', 'Environment.sensibilizacion1', 'Environment.sensibilizacion2', 'Environment.observacion', 'Environment.property_id')));
        $this->set('Environments', $this->paginate(array('Environment.property_id' => $property_id)));
    }

    function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Environment->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Environments', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->Environment->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Environment->find('first', array('conditions' => array('Environment.id' => $id), 'fields' => array('Environment.id', 'Environment.inundacion_area', 'Environment.inundacion_periodo', 'Environment.derrumbe_area', 'Environment.derrumbe_ubicacion', 'Environment.sensibilizacion1', 'Environment.sensibilizacion2', 'Environment.observacion', 'Environment.property_id')));
        } else {
            if ($this->Environment->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Environments', 'action' => 'index', $this->data['Environment']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

}