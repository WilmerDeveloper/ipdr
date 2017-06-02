<?php

Class CallsController extends AppController {

    public $name = 'Calls';

    function add() {
        if (empty($this->data)) {
            
        } else {

            if ($this->Call->saveAll($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Calls', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->Call->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Call->find('first', array('conditions' => array('Call.id' => $id), 'fields' => array('Call.nombre', 'Call.*')));
        } else {

            if ($this->Call->saveAll($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Calls', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function requirements_index() {
        $this->paginate = array('Call' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Call.*')));
        $this->set('Calls', $this->paginate());
    }
    function index() {
        $this->paginate = array('Call' => array('recursive'=>-1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('Call.*')));
        $this->set('Calls', $this->paginate());
    }

}

?>