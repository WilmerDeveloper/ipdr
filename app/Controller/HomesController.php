<?php

Class HomesController extends AppController {

    public $name = 'Homes';

    function add($beneficiary_id) {
        $this->layout = "ajax";
        $this->set('beneficiary_id', $beneficiary_id);
        $this->request->data['Home']['beneficiary_id'] = $beneficiary_id;

        if ($this->Home->save($this->data)) {
            $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Homes', 'action' => 'index', $beneficiary_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->Home->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Home->find('first', array('conditions' => array('Home.id' => $id)));
        } else {

            if ($this->Home->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Homes', 'action' => 'edit', $this->data['Home']['id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($beneficiary_id) {
        $this->layout = "ajax";
        $this->Home->recursive = -1;
        
       
            $this->set('beneficiary_id', $beneficiary_id);
            $this->paginate = array('Home' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Home.id', 'Home.tenencia', 'Home.tipo', 'Home.id')));
            $this->set('Homes', $this->paginate(array('Home.beneficiary_id' => $beneficiary_id)));
        
    }

    function delete($home_id, $beneficiary_id) {
        $this->layout = "ajax";
        if ($this->Home->delete($home_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Homes', 'action' => 'index', $beneficiary_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }

}

?>