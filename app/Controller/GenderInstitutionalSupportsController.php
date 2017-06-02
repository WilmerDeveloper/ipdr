<?php

Class GenderInstitutionalSupportsController extends AppController {

    public $name = 'GenderInstitutionalSupports';

    function add($poll_id) {
        $this->layout = "ajax";
        $this->set('poll_id', $poll_id);

        if (empty($this->data)) {
            
        } else {

            if ($this->GenderInstitutionalSupport->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'GenderInstitutionalSupports', 'action' => 'index', $poll_id));
            } else {
                $this->Session->setFlash('Error guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";

        $this->GenderInstitutionalSupport->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->GenderInstitutionalSupport->find('first', array('conditions' => array('GenderInstitutionalSupport.id' => $id)));
        } else {

            if ($this->GenderInstitutionalSupport->saveAll($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'GenderInstitutionalSupports', 'action' => 'index', $this->data['GenderInstitutionalSupport']['family_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($poll_id) {
        $this->layout = "ajax";
        $this->GenderInstitutionalSupport->recursive = -1;

        $this->set('poll_id', $poll_id);



        $this->data = $this->GenderInstitutionalSupport->find('first', array('conditions' => array('GenderInstitutionalSupport.family_poll_id' => $poll_id), 'order' => array('GenderInstitutionalSupport.id DESC')));
    }

}

?>
