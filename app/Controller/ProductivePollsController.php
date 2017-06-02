<?php

Class ProductivePollsController extends AppController {

    public $name = 'ProductivePolls';

    function index($beneficiary_id) {
        $this->layout = "ajax";
        $this->ProductivePoll->recursive = -1;
        $this->set('beneficiary_id', $beneficiary_id);
        $this->paginate = array('ProductivePoll' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('ProductivePoll.dominio_parcela', 'ProductivePoll.id', 'ProductivePoll.volumen_cultivo_primario', 'ProductivePoll.volumen_cultivo_secundario', 'ProductivePoll.concepto_cultivo_secundario', 'ProductivePoll.perdidas', 'ProductivePoll.asistencia_tecnica', 'ProductivePoll.concepto_cultivo_primario ')));
        $this->set('ProductivePolls', $this->paginate(array('ProductivePoll.beneficiary_id' => $beneficiary_id)));
    }
   
    function add($beneficiary_id) {
        $this->layout = "ajax";
        $this->set('beneficiary_id', $beneficiary_id);
        $this->request->data['ProductivePoll']['beneficiary_id'] = $beneficiary_id;
        if ($this->ProductivePoll->save($this->data)) {
            $this->Session->setFlash('Registro Adicionado correctamente. Ahora puede editarlo', 'flash_custom');
            $this->redirect(array('controller' => 'ProductivePolls', 'action' => 'index', $beneficiary_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->ProductivePoll->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->ProductivePoll->find('first', array('conditions' => array('ProductivePoll.id' => $id)));
        } else {

            if ($this->ProductivePoll->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'ProductivePolls', 'action' => 'edit', $this->data['ProductivePoll']['id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function delete($poll_id, $beneficiary_id) {
        $this->layout = "ajax";
        if ($this->ProductivePoll->delete($poll_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'ProductivePolls', 'action' => 'index', $beneficiary_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }

}

?>