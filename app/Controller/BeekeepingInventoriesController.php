<?php

Class BeekeepingInventoriesController extends AppController {

    public $name = 'BeekeepingInventories';

    function edit($id) {

        $this->BeekeepingInventory->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->BeekeepingInventory->find('first', array('conditions' => array('BeekeepingInventory.id' => $id)));
        } else {

            if ($this->BeekeepingInventory->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'BeekeepingInventories', 'action' => 'index', $this->data['BeekeepingInventory']['productive_baseline_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add($productive_baseline_id) {
        $this->set('productive_baseline_id', $productive_baseline_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->BeekeepingInventory->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'BeekeepingInventories', 'action' => 'index', $productive_baseline_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index($productive_baseline_id) {
        $this->set('productive_baseline_id', $productive_baseline_id);
        $this->BeekeepingInventory->recursive = -1;
        $this->paginate = array('BeekeepingInventory' => array('recursive' => 1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('BeekeepingInventory.id', 'BeekeepingInventory.botellas', 'BeekeepingInventory.id')));
        $this->set('BeekeepingInventories', $this->paginate(array('BeekeepingInventory.activo' => 1, 'BeekeepingInventory.productive_baseline_id' => $productive_baseline_id)));
    }

    function delete($bee_id, $productive_baseline_id) {
//        $datos = array('BeekeepingInventory' => array(
//                'id' => $bee_id,
//                'sincronizado' => 0,
//                'activo' => 0
//        ));
//        if ($this->BeekeepingInventory->save($datos)) {
//                $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
//                $this->redirect(array('controller' => 'BeekeepingInventories', 'action' => 'index',$productive_baseline_id));
//            } else {
//                $this->Session->setFlash('Error Guardando datos');
//            }
        if ($this->BeekeepingInventory->delete($bee_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'BeekeepingInventories', 'action' => 'index', $productive_baseline_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

}

?>