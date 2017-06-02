<?php

Class TypologiesController extends AppController {

    public $name = 'Typologies';

    public function add($plot_poll_id) {
        $this->set('plot_poll_id', $plot_poll_id);
        if (!empty($this->data)) {
            if ($this->Typology->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Typologies', 'action' => 'index', $plot_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {
        $this->Typology->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Typology->find('first', array('recursive' => -1, 'conditions' => array('Typology.id' => $id)));
        } else {
            if ($this->Typology->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Typologies', 'action' => 'index', $this->data['Typology']['plot_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function delete($id, $plot_poll_id) {
        if ($this->Typology->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Typologies', 'action' => 'index', $plot_poll_id));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_custom');
        }
    }

    public function index($plot_poll_id) {
        $this->set('plot_poll_id', $plot_poll_id);
        $this->set('Typologies', $this->paginate(array('Typology.plot_poll_id' => $plot_poll_id)));
    }

}

?>