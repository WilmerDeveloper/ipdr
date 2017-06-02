<?php

Class AssetsController extends AppController {

    public $name = 'Assets';

    function add($home_id) {
        $this->layout = "ajax";
        $this->set('home_id', $home_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Asset->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Assets', 'action' => 'index', $home_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->set('home_id', $home_id);
        $this->Asset->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Asset->find('first', array('conditions' => array('Asset.id' => $id), 'fields' => array('Asset.tipo', 'Asset.otro', 'Asset.home_id', 'Asset.id')));
        } else {

            if ($this->Asset->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Assets', 'action' => 'index', $this->data['Asset']['home_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($home_id) {
        $this->layout = "ajax";
        $this->Asset->recursive = -1;
        $this->set('home_id', $home_id);
        $this->paginate = array('Asset' => array('recursive' => 1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('Asset.id', 'Asset.tipo', 'Asset.otro', 'Asset.id')));
        $this->set('Assets', $this->paginate(array('Asset.home_id' => $home_id)));
    }
    
    
    function delete($asset_id,$home_id) {
        $this->layout = "ajax";
        if ($this->Asset->delete($asset_id)) {
                $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Assets', 'action' => 'index', $home_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
    }

}

?>