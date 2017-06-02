<?php

Class FollowAreasController extends AppController {

    public $name = 'FollowAreas';

    public function add($plot_poll_id) {
        $this->set('plot_id', $plot_poll_id);
        $this->loadModel('PlotPoll');
        $this->loadModel('Visit');
        $visit_id = $this->PlotPoll->field('PlotPoll.visit_id', array('PlotPoll.id' => $plot_poll_id));
        $follow_id = $this->Visit->field('Visit.follow_id', array('Visit.id' => $visit_id));
        $this->set('productiveActivities', $this->FollowArea->ProductiveActivity->find('list', array('joins' => array(array('table' => 'follow_products', 'alias' => 'FollowProduct', 'type' => 'left', 'conditions' => array('FollowProduct.productive_activity_id=ProductiveActivity.id'))), 'fields' => array('ProductiveActivity.id', 'ProductiveActivity.nombre'), 'conditions' => array('FollowProduct.follow_id' => $follow_id, 'ProductiveActivity.tipo' => 'AgricolaSeg'))));
        if (empty($this->data)) {
            
        } else {

            if ($this->FollowArea->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FollowAreas', 'action' => 'index', $plot_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {

        $this->FollowArea->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->FollowArea->find('first', array('conditions' => array('FollowArea.id' => $id)));
            $this->loadModel('PlotPoll');
            $this->loadModel('Visit');
            $visit_id = $this->PlotPoll->field('PlotPoll.visit_id', array('PlotPoll.id' => $this->data['FollowArea']['plot_poll_id']));
            $follow_id = $this->Visit->field('Visit.follow_id', array('Visit.id' => $visit_id));
            $this->set('productiveActivities', $this->FollowArea->ProductiveActivity->find('list', array('joins' => array(array('table' => 'follow_products', 'alias' => 'FollowProduct', 'type' => 'left', 'conditions' => array('FollowProduct.productive_activity_id=ProductiveActivity.id'))), 'fields' => array('ProductiveActivity.id', 'ProductiveActivity.nombre'), 'conditions' => array('FollowProduct.follow_id' => $follow_id, 'ProductiveActivity.tipo' => 'AgricolaSeg'))));

        } else {

            if ($this->FollowArea->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FollowAreas', 'action' => 'index', $this->data['FollowArea']['plot_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function index($plot_id) {
        $this->set('plot_id', $plot_id);
        $this->paginate = array('FollowArea' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('ProductiveActivity.*', 'FollowArea.*')));
        $this->set('FollowAreas', $this->paginate(array('FollowArea.plot_poll_id' => $plot_id)));
    }

    public function delete($id, $plot_id) {
        if ($this->FollowArea->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'FollowAreas', 'action' => 'index', $plot_id));
        }
    }

}

?>