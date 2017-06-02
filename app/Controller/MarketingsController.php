<?php

Class MarketingsController extends AppController {

    public $name = 'Marketings';

    function add($productive_baseline_id) {
        $this->layout = "ajax";
        $this->set('productiveActivities', $this->Marketing->ProductiveActivity->find('list', array('fields' => array('ProductiveActivity.id', 'ProductiveActivity.nombre'))));
        $this->set('productive_baseline_id', $productive_baseline_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Marketing->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Marketings', 'action' => 'index', $productive_baseline_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->set('productiveActivities', $this->Marketing->ProductiveActivity->find('list', array('fields' => array('ProductiveActivity.id', 'ProductiveActivity.nombre'))));
        $this->Marketing->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Marketing->find('first', array('conditions' => array('Marketing.id' => $id), 'fields' => array('Marketing.tipo', 'Marketing.nombre_canal', 'Marketing.variedad', 'Marketing.calidad', 'Marketing.unidad', 'Marketing.cantidad_unidad', 'Marketing.precio_promedio', 'Marketing.productive_baseline_id', 'Marketing.productive_activity_id', 'Marketing.id')));
        } else {

            if ($this->Marketing->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Marketings', 'action' => 'index', $this->data['Marketing']['productive_baseline_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($productive_baseline_id) {
        $this->layout = "ajax";
        $this->set('productive_baseline_id', $productive_baseline_id);
        $this->paginate = array('Marketing' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('ProductiveActivity.nombre', 'Marketing.tipo', 'Marketing.nombre_canal', 'Marketing.variedad', 'Marketing.calidad', 'Marketing.unidad', 'Marketing.cantidad_unidad', 'Marketing.precio_promedio', 'Marketing.productive_baseline_id', 'Marketing.productive_activity_id', 'Marketing.id')));
        $this->set('Marketings', $this->paginate(array('Marketing.activo' => 1, 'Marketing.productive_baseline_id' => $productive_baseline_id)));
    }

    function delete($marketing_id, $productive_baseline_id) {
//        $datos = array('Marketing' => array(
//                'id' => $marketing_id,
//                'sincronizado' => 0,
//                'activo' => 0
//        ));
//        if ($this->Marketing->save($datos)) {
//            $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
//            $this->redirect(array('controller' => 'Marketings', 'action' => 'index', $productive_baseline_id));
//        } else {
//            $this->Session->setFlash('Error Guardando datos');
//        }
            if ($this->Marketing->delete($marketing_id)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Marketings', 'action' => 'index',$productive_baseline_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
    }

}

?>