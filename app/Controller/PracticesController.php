<?php

Class PracticesController extends AppController {

    public $name = 'Practices';

    function add($productive_poll_id) {
        $this->layout = "ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Practice->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente','flash_custom');
                $this->redirect(array('controller' => 'Practices', 'action' => 'index',$productive_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->Practice->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Practice->find('first', array('conditions' => array('Practice.id' => $id), 'fields' => array('Practice.tipo', 'Practice.productive_poll_id', 'Practice.id')));
        } else {

            if ($this->Practice->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente','flash_custom');
                $this->redirect(array('controller' => 'Practices', 'action' => 'index',$this->data['Practice']['productive_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($productive_poll_id) {
        $this->layout = "ajax";
        $this->Practice->recursive = -1;
        $this->set('productive_poll_id', $productive_poll_id);
        $this->paginate = array('Practice' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Practice.id', 'Practice.tipo', 'Practice.id')));
        $this->set('Practices', $this->paginate(array('Practice.productive_poll_id' => $productive_poll_id)));
    }

}

?>