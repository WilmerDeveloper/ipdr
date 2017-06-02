<?php

Class DevicesController extends AppController {

    public $name = 'Devices';

    function edit($id) {
        $this->layout = "ajax";
        $this->Device->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Device->find('first', array('conditions' => array('Device.id' => $id), 'fields' => array('Device.name', 'Device.cantidad', 'Device.home_id', 'Device.id')));
        } else {

            if ($this->Device->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Devices', 'action' => 'index', $this->data['Device']['home_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($home_id) {
        $this->layout = "ajax";
        $this->Device->recursive = -1;
        $this->set('home_id', $home_id);
        $this->paginate = array('Device' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Device.id', 'Device.name', 'Device.cantidad', 'Device.id')));
        $this->set('Devices', $this->paginate(array('Device.home_id' => $home_id)));
    }

    function add($home_id) {
        $this->layout = "ajax";
        $this->set('home_id', $home_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Device->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Devices', 'action' => 'index', $home_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function delete($device_id, $home_id) {
        $this->layout = "ajax";
        if ($this->Device->delete($device_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Devices', 'action' => 'index', $home_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

}

?>