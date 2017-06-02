<?php

Class WrappersController extends AppController {

    public $name = 'Wrappers';

    function edit($id) {
        $this->layout = "ajax";
        $this->Wrapper->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Wrapper->find('first', array('conditions' => array('Wrapper.id' => $id), 'fields' => array('Wrapper.tipo', 'Wrapper.productive_poll_id', 'Wrapper.id')));
        } else {

            if ($this->Wrapper->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Wrappers', 'action' => 'index',$this->data['Wrapper']['productive_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add($productive_poll_id) {
        $this->layout = "ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Wrapper->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Wrappers', 'action' => 'index',$productive_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index($productive_poll_id) {
        $this->layout = "ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        $this->paginate = array('Wrapper' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Wrapper.id', 'Wrapper.tipo', 'Wrapper.id')));
        $this->set('Wrappers', $this->paginate(array('Wrapper.productive_poll_id' => $productive_poll_id)));
    }

}

?>