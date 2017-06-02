<?php

Class LiveStocksController extends AppController {

    public $name = 'LiveStocks';

    function add($home_id) {
        $this->layout = "ajax";
        $this->set('home_id', $home_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->LiveStock->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'LiveStocks', 'action' => 'index', $home_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->LiveStock->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->LiveStock->find('first', array('conditions' => array('LiveStock.id' => $id), 'fields' => array('LiveStock.id', 'LiveStock.tipo', 'LiveStock.cantidad', 'LiveStock.home_id', 'LiveStock.id', 'LiveStock.otro')));
        } else {

            if ($this->LiveStock->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'LiveStocks', 'action' => 'index', $this->data['LiveStock']['home_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($home_id) {
        $this->layout = "ajax";
        $this->LiveStock->recursive = -1;
        $this->set('home_id', $home_id);
        $this->paginate = array('LiveStock' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('LiveStock.id', 'LiveStock.tipo', 'LiveStock.cantidad', 'LiveStock.id')));
        $this->set('LiveStocks', $this->paginate(array('LiveStock.home_id' => $home_id)));
    }

    function delete($liveStock_id, $home_id) {
        $this->layout = "ajax";
        if ($this->LiveStock->delete($liveStock_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'LiveStocks', 'action' => 'index', $home_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

}

?>