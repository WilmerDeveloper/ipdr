<?php

Class LivestockPollsController extends AppController {

    public $name = 'LivestockPolls';

    public function add($plot_poll_id) {
        $this->set('plot_poll_id', $plot_poll_id);
        $this->loadModel('PlotPoll');
        $this->loadModel('Visit');
        $visit_id = $this->PlotPoll->field('PlotPoll.visit_id', array('PlotPoll.id' => $plot_poll_id));
        $follow_id = $this->Visit->field('Visit.follow_id', array('Visit.id' => $visit_id));
        $this->set('productiveActivities', $this->LivestockPoll->ProductiveActivity->find('list', array('joins' => array(array('table' => 'follow_products', 'alias' => 'FollowProduct', 'type' => 'left', 'conditions' => array('FollowProduct.productive_activity_id=ProductiveActivity.id'))), 'fields' => array('ProductiveActivity.id', 'ProductiveActivity.nombre'), 'conditions' => array('FollowProduct.follow_id' => $follow_id, 'ProductiveActivity.tipo' => 'PecuarioSeg'))));
        if (empty($this->data)) {
            
        } else {

            if ($this->LivestockPoll->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'LivestockPolls', 'action' => 'index', $plot_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {
        $this->LivestockPoll->recursive = -1;

        if (empty($this->data)) {

            $this->data = $this->LivestockPoll->find('first', array('conditions' => array('LivestockPoll.id' => $id)));
            $this->loadModel('PlotPoll');
            $this->loadModel('Visit');
            $visit_id = $this->PlotPoll->field('PlotPoll.visit_id', array('PlotPoll.id' => $this->data['LivestockPoll']['plot_poll_id']));
            $follow_id = $this->Visit->field('Visit.follow_id', array('Visit.id' => $visit_id));
            $this->set('productiveActivities', $this->LivestockPoll->ProductiveActivity->find('list', array('joins' => array(array('table' => 'follow_products', 'alias' => 'FollowProduct', 'type' => 'left', 'conditions' => array('FollowProduct.productive_activity_id=ProductiveActivity.id'))), 'fields' => array('ProductiveActivity.id', 'ProductiveActivity.nombre'), 'conditions' => array('FollowProduct.follow_id' =>$follow_id, 'ProductiveActivity.tipo' => 'PecuarioSeg'))));
        } else {

            if ($this->LivestockPoll->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'LivestockPolls', 'action' => 'index', $this->data['LivestockPoll']['plot_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function delete($id, $plot_poll_id) {
        if ($this->LivestockPoll->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'LivestockPolls', 'action' => 'index', $plot_poll_id));
        } else {
            $this->Session->setFlash('Error editando datos');
        }
    }

    public function index($plot_poll_id) {
        $this->set('plot_poll_id', $plot_poll_id);
        $this->LivestockPoll->unbindModel(
        array('belongsTo' => array('PlotPoll'))
    );
        $this->paginate = array('LivestockPoll' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50));
        $this->set('LivestockPolls', $this->paginate(array('LivestockPoll.plot_poll_id' => $plot_poll_id)));
    }

}

?>