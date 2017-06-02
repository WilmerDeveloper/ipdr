<?php

Class ConsumptionsController extends AppController {

    public $name = 'Consumptions';

    function add($productive_poll_id) {
        $this->layout = "ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        $this->set('productiveActivities', $this->Consumption->ProductiveActivity->find('list', array('fields' => array('ProductiveActivity.id', 'ProductiveActivity.nombre'))));
        if (empty($this->data)) {
            
        } else {

            if ($this->Consumption->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Consumptions', 'action' => 'index', $productive_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->set('productiveActivities', $this->Consumption->ProductiveActivity->find('list', array('fields' => array('ProductiveActivity.id', 'ProductiveActivity.nombre'))));
        $this->Consumption->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Consumption->find('first', array('conditions' => array('Consumption.id' => $id), 'fields' => array('Consumption.consumo_estimado', 'Consumption.porcentaje_cosecha', 'Consumption.unidad_medida', 'Consumption.productive_poll_id', 'Consumption.productive_activity_id', 'Consumption.id')));
        } else {

            if ($this->Consumption->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Consumptions', 'action' => 'index', $this->data['Consumption']['productive_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($productive_poll_id) {
        $this->layout = "ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        $this->paginate = array('Consumption' => array('recursive' => 1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('ProductiveActivity.nombre', 'Consumption.id', 'Consumption.unidad_medida', 'Consumption.consumo_estimado', 'Consumption.porcentaje_cosecha', 'Consumption.id')));
        $this->set('Consumptions', $this->paginate(array('Consumption.productive_poll_id' => $productive_poll_id)));
    }

}

?>