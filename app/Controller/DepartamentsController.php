<?php

Class DepartamentsController extends AppController {

    public $name = 'Departaments';

    function add() {
        $this->layout = "ajax";
        if (empty($this->data)) {
            
        } else {

            if ($this->Departament->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente');
                $this->redirect(array('controller' => 'Departaments', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->Departament->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Departament->find('first', array('conditions' => array('Departament.id' => $id), 'fields' => array('Departament.name', 'Departament.id')));
        } else {

            if ($this->Departament->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente');
                $this->redirect(array('controller' => 'Departaments', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index() {
        $this->layout = "ajax";
        $this->Departament->recursive = -1;
        $this->paginate = array('Departament' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Departament.name', 'Departament.id')));
        $this->set('Departaments', $this->paginate());
    }

}

?>