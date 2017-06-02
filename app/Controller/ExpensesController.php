<?php

Class ExpensesController extends AppController {

    public $name = 'Expenses';

    function add($family_poll_id) {
        $this->set('family_poll_id', $family_poll_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Expense->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Expenses', 'action' => 'index', $family_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->Expense->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Expense->find('first', array('conditions' => array('Expense.id' => $id)));
        } else {

            if ($this->Expense->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Expenses', 'action' => 'index', $this->data['Expense']['family_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($family_poll_id) {
        $this->set('family_poll_id', $family_poll_id);
        $this->paginate = array('Expense' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50));
        $this->set('Expenses', $this->paginate(array('Expense.activo' => 1, 'Expense.family_poll_id' => $family_poll_id)));
    }

    function delete($expense_id, $family_poll_id) {
//        $datos = array('Expense' => array(
//                'id' => $expense_id,
//                'sincronizado' => 0,
//                'activo' => 0
//        ));
//        if ($this->Expense->save($datos)) {
//            $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
//            $this->redirect(array('controller' => 'Expenses', 'action' => 'index', $family_poll_id));
//        } else {
//            $this->Session->setFlash('Error Guardando datos');
//        }
        if ($this->Expense->delete($expense_id)) {
            $this->Session->setFlash('Registro Borrado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Expenses', 'action' => 'index', $family_poll_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

}

?>