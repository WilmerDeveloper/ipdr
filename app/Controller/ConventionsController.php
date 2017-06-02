<?php

Class ConventionsController extends AppController {

    public $name = 'Conventions';

    function edit($id) {
        $this->layout = "ajax";
        $this->Convention->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Convention->find('first', array('conditions' => array('Convention.id' => $id), 'fields' => array('Convention.id', 'Convention.tipo', 'Convention.institucion', 'Convention.asociation_id', 'Convention.id')));
        } else {

            if ($this->Convention->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Conventions', 'action' => 'index', $this->data['Convention']['asociation_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add($asociation_id) {
        $this->layout = "ajax";
        $this->set('asociation_id', $asociation_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Convention->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Conventions', 'action' => 'index', $asociation_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index($asociation_id) {
        $this->layout = "ajax";
        $this->Convention->recursive = -1;
        $this->set('asociation_id', $asociation_id);
        $this->paginate = array('Convention' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Convention.id', 'Convention.tipo', 'Convention.institucion', 'Convention.asociation_id', 'Convention.id')));
        $this->set('Conventions', $this->paginate(array('Convention.asociation_id' => $asociation_id)));
    }

    function delete($convention_id, $asociation_id) {
        $this->layout = "ajax";
        if ($this->Convention->delete($convention_id)) {
            $this->Session->setFlash('Registro borrado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Conventions', 'action' => 'index', $asociation_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

}

?>