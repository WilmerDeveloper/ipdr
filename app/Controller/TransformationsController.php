<?php

Class TransformationsController extends AppController {

    public $name = 'Transformations';

    function edit($id) {
        $this->layout = "ajax";
        $this->Transformation->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Transformation->find('first', array('conditions' => array('Transformation.id' => $id), 'fields' => array('Transformation.tipo', 'Transformation.productive_poll_id', 'Transformation.id')));
        } else {

            if ($this->Transformation->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Transformations', 'action' => 'index', $this->data['Transformation']['productive_poll_id']));
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

            if ($this->Transformation->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Transformations', 'action' => 'index', $productive_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index($productive_poll_id) {
        $this->layout = "ajax";
        $this->Transformation->recursive = -1;
        $this->set('productive_poll_id', $productive_poll_id);
        $this->paginate = array('Transformation' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Transformation.id', 'Transformation.tipo', 'Transformation.id')));
        $this->set('Transformations', $this->paginate(array('Transformation.productive_poll_id' => $productive_poll_id)));
    }

}

?>