<?php

Class FishInventoriesController extends AppController {

    public $name = 'FishInventories';

    function add($productive_baseline_id) {
        $this->set('productive_baseline_id', $productive_baseline_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->FishInventory->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FishInventories', 'action' => 'index', $productive_baseline_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index($productive_baseline_id) {
        $this->set('productive_baseline_id', $productive_baseline_id);
        $this->paginate = array('FishInventory' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50));
        $this->set('FishInventories', $this->paginate( array('FishInventory.activo'=>1,'FishInventory.productive_baseline_id'=>$productive_baseline_id)));
    }

    function edit($id) {
        $this->FishInventory->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->FishInventory->find('first', array('conditions' => array('FishInventory.id' => $id), 'fields' => array('FishInventory.id', 'FishInventory.area_espejo', 'FishInventory.alevinos', 'FishInventory.desechos', 'FishInventory.manejo_desechos', 'FishInventory.productive_baseline_id', 'FishInventory.id')));
        } else {

            if ($this->FishInventory->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FishInventories', 'action' => 'index', $this->data['FishInventory']['productive_baseline_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function delete($fish_id, $productive_baseline_id) {

        
        if ($this->FishInventory->delete($fish_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'FishInventories', 'action' => 'index', $productive_baseline_id));
        } else {
            $this->Session->setFlash('Error editando datos');
        }
    }

}

?>