<?php

Class PoultryInventoriesController extends AppController {

    public $name = 'PoultryInventories';

    function edit($id) {
        $this->PoultryInventory->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->PoultryInventory->find('first', array('conditions' => array('PoultryInventory.id' => $id), 'fields' => array('PoultryInventory.id', 'PoultryInventory.pollos_engorde', 'PoultryInventory.gallinas_de_postura', 'PoultryInventory.aves_de_traspatio', 'PoultryInventory.patos', 'PoultryInventory.piscos', 'PoultryInventory.codornices', 'PoultryInventory.producion_postura', 'PoultryInventory.producion_traspatio', 'PoultryInventory.huevos_galinas_postura', 'PoultryInventory.huevos_galinas_traspatio', 'PoultryInventory.autoconsumo_postura', 'PoultryInventory.autoconsumo_traspatio', 'PoultryInventory.venta_postura', 'PoultryInventory.venta_traspatio', 'PoultryInventory.area_galpon', 'PoultryInventory.area_corral', 'PoultryInventory.piso_cemento', 'PoultryInventory.piso_madera', 'PoultryInventory.piso_tierra', 'PoultryInventory.piso_otro', 'PoultryInventory.desinfeccion', 'PoultryInventory.vacuna_newcastle', 'PoultryInventory.vacuna_gumboro', 'PoultryInventory.vacuna_salomonella', 'PoultryInventory.vacuna_bronquitis', 'PoultryInventory.productive_baseline_id', 'PoultryInventory.id')));
        } else {

            if ($this->PoultryInventory->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'PoultryInventories', 'action' => 'index', $this->data['PoultryInventory']['productive_baseline_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add($productive_baseline_id) {
        $this->set('productive_baseline_id', $productive_baseline_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->PoultryInventory->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'PoultryInventories', 'action' => 'index', $productive_baseline_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index($productive_baseline_id) {
        $this->set('productive_baseline_id', $productive_baseline_id);
        $this->paginate = array('PoultryInventory' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50));
        $this->set('PoultryInventories', $this->paginate(array('PoultryInventory.activo'=>1, 'PoultryInventory.productive_baseline_id' => $productive_baseline_id)));
    }

    function delete($poultry_id, $productive_baseline_id) {
        
//        $datos=array('PoultryInventory'=>array(
//            'id'=>$poultry_id,
//            'sincronizado'=>0,
//            'activo'=>0
//        ));
//        
//        if ($this->PoultryInventory->save($datos)) {
//            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
//            $this->redirect(array('controller' => 'PoultryInventories', 'action' => 'index', $productive_baseline_id));
//        } else {
//            $this->Session->setFlash('Error Guardando datos');
//        }
        if ($this->PoultryInventory->delete($poultry_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'PoultryInventories', 'action' => 'index', $productive_baseline_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

}

?>