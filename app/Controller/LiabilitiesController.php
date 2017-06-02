<?php

Class LiabilitiesController extends AppController {

    public $name = 'Liabilities';

    public function add($plot_poll_id) {
        $this->set('plot_poll_id', $plot_poll_id);
        if (!empty($this->data)) {
            if ($this->Liability->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Liabilities', 'action' => 'index', $plot_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {
        $this->Liability->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Liability->find('first', array('conditions' => array('Liability.id' => $id)));
        } else {
            if ($this->Liability->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Liabilities', 'action' => 'index', $this->data['Liability']['plot_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function delete($id, $plot_poll_id) {
        if ($this->Liability->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Liabilities', 'action' => 'index', $plot_poll_id));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_custom');
        }
    }

    public function index($plot_poll_id) {
        $this->set('plot_poll_id', $plot_poll_id);
        $this->set('Liabilities', $this->paginate(array('Liability.plot_poll_id' => $plot_poll_id)));
    }

}

?>