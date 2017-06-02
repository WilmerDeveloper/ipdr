<?php

Class WaterSourcesController extends AppController {

    public $name = 'WaterSources';

    function add($home_id) {
        $this->layout = "ajax";
        $this->set('home_id', $home_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->WaterSource->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'WaterSources', 'action' => 'index', $home_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->WaterSource->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->WaterSource->find('first', array('conditions' => array('WaterSource.id' => $id), 'fields' => array('WaterSource.id', 'WaterSource.tipo', 'WaterSource.home_id', 'WaterSource.id')));
        } else {

            if ($this->WaterSource->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'WaterSources', 'action' => 'index', $this->data['WaterSource']['home_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($home_id) {
        $this->layout = "ajax";
        $this->WaterSource->recursive = -1;
        $this->set('home_id', $home_id);
        $this->paginate = array('WaterSource' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('WaterSource.id', 'WaterSource.tipo', 'WaterSource.id')));
        $this->set('WaterSources', $this->paginate(array('WaterSource.home_id' => $home_id)));
    }

    function delete($source_id, $home_id) {
        $this->layout = "ajax";
        if ($this->WaterSource->delete($source_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'WaterSources', 'action' => 'index', $home_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

}

?>