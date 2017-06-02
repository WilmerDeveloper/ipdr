<?php

Class ProductiveActivitiesController extends AppController {

    public $name = 'ProductiveActivities';

    public function edit($id) {
        $this->layout = "ajax";
        $this->ProductiveActivity->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->ProductiveActivity->find('first', array('conditions' => array('ProductiveActivity.id' => $id), 'fields' => array('ProductiveActivity.*')));
        } else {
            if ($this->ProductiveActivity->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente');
                $this->redirect(array('controller' => 'ProductiveActivities', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function add() {
        $this->layout = "ajax";
        if (!empty($this->data)) {
            if ($this->ProductiveActivity->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente');
                $this->redirect(array('controller' => 'ProductiveActivities', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function index() {
        $this->layout = "ajax";
        $this->paginate = array('ProductiveActivity' => array('maxLimit' => 500, 'limit' => 50, 'order' => array('ProductiveActivity.tipo' => 'ASC', 'ProductiveActivity.nombre' => 'ASC'), 'fields' => array('ProductiveActivity.*')));
        $this->set('ProductiveActivities', $this->paginate());
    }

}

?>