<?php

Class LendersController extends AppController {

    public $name = 'Lenders';

    function edit($id) {
        $this->layout = "ajax";
        $this->Lender->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Lender->find('first', array('conditions' => array('Lender.id' => $id), 'fields' => array('Lender.nombre', 'Lender.id')));
        } else {

            if ($this->Lender->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Lenders', 'action' => 'index', $this->data['Lender']['productive_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add($productive_poll_id) {
        $this->layout = "ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        $this->Lender->recursive = -1;
        if (empty($this->data)) {
            
        } else {

            if ($this->Lender->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Lenders', 'action' => 'index', $productive_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index($productive_poll_id) {
        $this->layout = "ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        $this->paginate = array('Lender' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Lender.id', 'Lender.nombre', 'Lender.id')));
        $this->set('Lenders', $this->paginate(array('Lender.productive_poll_id'=>$productive_poll_id)));
    }

}

?>