<?php

Class FollowProductsController extends AppController {

    public $name = 'FollowProducts';

    public function add($proyect_id) {
        $this->set('proyect_id', $proyect_id);
        $this->loadModel('ProductiveActivity');
        $this->set('productiveActivities', $this->ProductiveActivity->find('list', array('order' => array('ProductiveActivity.nombre' => 'ASC'), 'conditions' => array('ProductiveActivity.tipo' => array('')), 'fields' => array('ProductiveActivity.id', 'ProductiveActivity.nombre'))));
        if (!empty($this->data)) {
            if ($this->FollowProduct->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FollowProducts', 'action' => 'index', $proyect_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {
        $this->loadModel('ProductiveActivity');
        $this->set('productiveActivities', $this->ProductiveActivity->find('list', array('order' => array('ProductiveActivity.nombre' => 'ASC'), 'conditions' => array('ProductiveActivity.tipo' => array('')), 'fields' => array('ProductiveActivity.id', 'ProductiveActivity.nombre'))));
        $this->FollowProduct->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->FollowProduct->find('first', array('conditions' => array('FollowProduct.id' => $id)));
        } else {
            if ($this->FollowProduct->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FollowProducts', 'action' => 'index', $this->data['FollowProduct']['proyect_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function delete($id) {
        if ($this->FollowProduct->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Proyects', 'action' => 'seguimiento'));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_custom');
        }
    }

    public function index($proyect_id) {
        $this->set('proyect_id2', $proyect_id);
        $this->paginate = array('FollowProduct' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50, 'joins' => array(array('table' => 'productive_activities', 'alias' => 'ProductiveActivity', 'type' => 'left', 'conditions' => 'ProductiveActivity.id=FollowProduct.productive_activity_id')), 'fields' => array('ProductiveActivity.nombre', 'FollowProduct.*')));
        $this->set('FollowProducts', $this->paginate(array('FollowProduct.proyect_id' => $proyect_id)));
    }

}

?>