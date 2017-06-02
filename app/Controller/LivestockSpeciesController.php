<?php

Class LivestockSpeciesController extends AppController {

    public $name = 'LivestockSpecies';

    function add($productive_baseline_id) {
        $this->set('productive_baseline_id', $productive_baseline_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->LivestockSpecy->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'LivestockSpecies', 'action' => 'index', $productive_baseline_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->LivestockSpecy->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->LivestockSpecy->find('first', array('conditions' => array('LivestockSpecy.id' => $id), 'fields' => array('LivestockSpecy.id', 'LivestockSpecy.tipo', 'LivestockSpecy.machos', 'LivestockSpecy.hembras', 'LivestockSpecy.productive_baseline_id', 'LivestockSpecy.id')));
        } else {

            if ($this->LivestockSpecy->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'LivestockSpecies', 'action' => 'index', $this->data['LivestockSpecy']['productive_baseline_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($productive_baseline_id) {
        $this->set('productive_baseline_id', $productive_baseline_id);
        $this->paginate = array('LivestockSpecy' => array('recursive'=>-1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('LivestockSpecy.tipo', 'LivestockSpecy.machos', 'LivestockSpecy.hembras', 'LivestockSpecy.productive_baseline_id', 'LivestockSpecy.id')));
        $this->set('LivestockSpecies', $this->paginate(array('LivestockSpecy.activo'=>1 ,'LivestockSpecy.productive_baseline_id' => $productive_baseline_id)));
    }

    function delete($specy_id, $productive_baseline_id) {
//        $datos = array('LivestockSpecy' => array(
//                'id' => $specy_id,
//                'sincronizado' => 0,
//                'activo' => 0
//        ));
//        if ($this->LivestockSpecy->save($datos)) {
//            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
//            $this->redirect(array('controller' => 'LivestockSpecies', 'action' => 'index', $productive_baseline_id));
//        } else {
//            $this->Session->setFlash('Error editando datos');
//        }
        if ($this->LivestockSpecy->delete($specy_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'LivestockSpecies', 'action' => 'index', $productive_baseline_id));
        } else {
            $this->Session->setFlash('Error editando datos');
        }
    }

}

?>