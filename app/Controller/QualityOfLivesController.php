<?php

Class QualityOfLivesController extends AppController {

    public $name = 'QualityOfLives';

    function add($poll_id) {
        $this->layout = "ajax";
        $this->set('poll_id', $poll_id);

        if (empty($this->data)) {
            
        } else {

            if ($this->QualityOfLife->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'QualityOfLives', 'action' => 'index', $poll_id));
            } else {
                $this->Session->setFlash('Error guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";

        $this->QualityOfLife->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->QualityOfLife->find('first', array('conditions' => array('QualityOfLife.id' => $id)));
        } else {

            if ($this->QualityOfLife->saveAll($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'QualityOfLives', 'action' => 'index', $this->data['QualityOfLife']['family_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($poll_id) {
        $this->layout = "ajax";
        $this->QualityOfLife->recursive = -1;
        $this->set('poll_id', $poll_id);
        $this->data = $this->QualityOfLife->find('first', array('order'=>'QualityOfLife.id DESC', 'conditions' => array('QualityOfLife.family_poll_id' => $poll_id)));
        $this->set('QualityOfLives', $this->paginate(array('QualityOfLife.family_poll_id' => $poll_id)));
    }

}

?>
