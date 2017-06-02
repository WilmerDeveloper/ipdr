<?php

Class AgriculturalSystemsController extends AppController {

    public $name = 'AgriculturalSystems';

    function add($baseline_id) {
        $this->set('baseline_id', $baseline_id);
        $this->set('productiveActivities', $this->AgriculturalSystem->ProductiveActivity->find('list', array('fields' => array('ProductiveActivity.id', 'ProductiveActivity.nombre'), 'conditions' => array('ProductiveActivity.tipo' => 'AgricolaSeg'))));
        if (empty($this->data)) {
            
        } else {

            if ($this->AgriculturalSystem->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'AgriculturalSystems', 'action' => 'index', $baseline_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->set('productiveActivities', $this->AgriculturalSystem->ProductiveActivity->find('list', array('fields' => array('ProductiveActivity.id', 'ProductiveActivity.nombre'), 'conditions' => array('ProductiveActivity.tipo' => 'AgricolaSeg'))));
        $this->AgriculturalSystem->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->AgriculturalSystem->find('first', array('conditions' => array('AgriculturalSystem.id' => $id), 'fields' => array('AgriculturalSystem.id', 'AgriculturalSystem.variedad', 'AgriculturalSystem.extension', 'AgriculturalSystem.densidad', 'AgriculturalSystem.distancia_surcos', 'AgriculturalSystem.distancia_plantas', 'AgriculturalSystem.edad_cultivo', 'AgriculturalSystem.estado', 'AgriculturalSystem.produccion', 'AgriculturalSystem.autoconsumo', 'AgriculturalSystem.venta', 'AgriculturalSystem.fertilizacion', 'AgriculturalSystem.control_fito_sanitario', 'AgriculturalSystem.labores_culturales', 'AgriculturalSystem.tipo', 'AgriculturalSystem.productive_baseline_id', 'AgriculturalSystem.productive_activity_id', 'AgriculturalSystem.id')));
        } else {

            if ($this->AgriculturalSystem->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'AgriculturalSystems', 'action' => 'index', $this->data['AgriculturalSystem']['productive_baseline_id']));
//            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($baseline_id) {
        $this->set('baseline_id', $baseline_id);
        $this->paginate = array('AgriculturalSystem' => array('maxLimit' => 500, 'recursive' => 0, 'limit' => 50, 'fields' => array('AgriculturalSystem.id', 'AgriculturalSystem.variedad', 'ProductiveActivity.nombre', 'AgriculturalSystem.extension', 'AgriculturalSystem.densidad', 'AgriculturalSystem.distancia_surcos', 'AgriculturalSystem.distancia_plantas', 'AgriculturalSystem.edad_cultivo', 'AgriculturalSystem.estado', 'AgriculturalSystem.produccion', 'AgriculturalSystem.autoconsumo', 'AgriculturalSystem.venta', 'AgriculturalSystem.fertilizacion', 'AgriculturalSystem.control_fito_sanitario', 'AgriculturalSystem.labores_culturales', 'AgriculturalSystem.tipo', 'AgriculturalSystem.id')));
        $this->set('AgriculturalSystems', $this->paginate(array('AgriculturalSystem.activo'=>1, 'AgriculturalSystem.productive_baseline_id' => $baseline_id)));
    }

    function delete($system_id, $baseline_id) {
         $datos=array('AgriculturalSystem'=>array(
            'id'=>$system_id,
            'sincronizado'=>0,
            'activo'=>0
        ));
        if ($this->AgriculturalSystem->delete($system_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'AgriculturalSystems', 'action' => 'index', $baseline_id));
        } else {
            $this->Session->setFlash('Error editando datos');
        }
//        if ($this->AgriculturalSystem->delete($system_id)) {
//            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
//            $this->redirect(array('controller' => 'AgriculturalSystems', 'action' => 'index', $baseline_id));
//        } else {
//            $this->Session->setFlash('Error editando datos');
//        }
    }

}

?>