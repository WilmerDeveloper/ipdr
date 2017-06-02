<?php

Class PlotProductionsController extends AppController {

    public $name = 'PlotProductions';

    public function add($plot_poll_id) {
        $this->set('plot_poll_id', $plot_poll_id);
        $this->set('products', $this->PlotProduction->Product->find('list', array('fields' => array('Product.id', 'Product.nombre'))));

        if (empty($this->data)) {
            
        } else {

            if ($this->PlotProduction->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'PlotProductions', 'action' => 'index', $plot_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {
        $this->set('products', $this->PlotProduction->Product->find('list', array('fields' => array('Product.id', 'Product.nombre'))));

        $this->PlotProduction->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->PlotProduction->find('first', array('conditions' => array('PlotProduction.id' => $id), 'fields' => array('PlotProduction.cantidad', 'PlotProduction.unidad', 'PlotProduction.valor',  'PlotProduction.plot_poll_id', 'PlotProduction.product_id', 'PlotProduction.id', 'PlotProduction.observaciones')));
        } else {

            if ($this->PlotProduction->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'PlotProductions', 'action' => 'index', $this->data['PlotProduction']['plot_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function delete($id, $plot_poll_id) {
        if ($this->PlotProduction->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'PlotProductions', 'action' => 'index', $plot_poll_id));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_custom');
        }
    }

    public function index($plot_poll_id) {
        $this->set('plot_poll_id', $plot_poll_id);
        $this->paginate = array('PlotProduction' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('PlotProduction.cantidad', 'Product.nombre', 'PlotProduction.unidad', 'PlotProduction.valor',  'PlotProduction.id')));
        $this->set('PlotProductions', $this->paginate(array('PlotProduction.plot_poll_id' => $plot_poll_id)));
    }

}

?>