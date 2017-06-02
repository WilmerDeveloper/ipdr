<?php

Class ProductiveProblemsController extends AppController {

    public $name = 'ProductiveProblems';

    function add($productive_poll_id) {
        $this->layout = "ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->ProductiveProblem->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente','flash_custom');
                $this->redirect(array('controller' => 'ProductiveProblems', 'action' => 'index',$productive_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->ProductiveProblem->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->ProductiveProblem->find('first', array('conditions' => array('ProductiveProblem.id' => $id), 'fields' => array('ProductiveProblem.tipo', 'ProductiveProblem.valor', 'ProductiveProblem.productive_poll_id', 'ProductiveProblem.id')));
        } else {

            if ($this->ProductiveProblem->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente','flash_custom');
                $this->redirect(array('controller' => 'ProductiveProblems', 'action' => 'index',$this->data['ProductiveProblem']['productive_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($productive_poll_id) {
        $this->layout = "ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        $this->paginate = array('ProductiveProblem' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('ProductiveProblem.id', 'ProductiveProblem.tipo', 'ProductiveProblem.valor', 'ProductiveProblem.id')));
        $this->set('ProductiveProblems', $this->paginate(array('ProductiveProblem.productive_poll_id' => $productive_poll_id)));
    }

}

?>