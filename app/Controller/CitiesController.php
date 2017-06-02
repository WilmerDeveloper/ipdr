<?php

Class CitiesController extends AppController {

    public $name = 'Cities';

    function edit($id) {
        $this->layout = "ajax";
        $this->set('departaments', $this->City->Departament->find('list'));
        $this->City->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->City->find('first', array('conditions' => array('City.id' => $id), 'fields' => array('City.name', 'City.departament_id', 'City.divipol', 'City.id')));
        } else {

            if ($this->City->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente');
                $this->redirect(array('controller' => 'Cities', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add() {
        $this->layout = "ajax";
        $this->set('departaments', $this->City->Departament->find('list'));
        if (empty($this->data)) {
            
        } else {

            if ($this->City->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente');
                $this->redirect(array('controller' => 'Cities', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index() {
        $this->layout = "ajax";
        $this->paginate = array('City' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('City.name', 'City.divipol', 'City.id')));
        $this->set('Cities', $this->paginate());
    }

}

?>