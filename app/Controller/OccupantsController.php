<?php

Class OccupantsController extends AppController {

    public $name = 'Occupants';

    public function index($plot_poll_id) {
        $this->set('plot_poll_id', $plot_poll_id);
        $this->paginate = array('Occupant' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50));
        $this->set('Occupants', $this->paginate(array('Occupant.plot_poll_id' => $plot_poll_id)));
    }

    public function edit($id) {
        $this->Occupant->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Occupant->find('first', array('conditions' => array('Occupant.id' => $id)));
        } else {

            if ($this->Occupant->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Occupants', 'action' => 'index', $this->data['Occupant']['plot_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function delete($id, $plot_poll_id) {
        if ($this->Occupant->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Occupants', 'action' => 'index', $plot_poll_id));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_custom');
        }
    }

    public function add($plot_poll_id) {
        $this->set('plot_poll_id', $plot_poll_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Occupant->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Occupants', 'action' => 'index', $plot_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

}

?>