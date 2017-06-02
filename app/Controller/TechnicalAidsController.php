<?php

Class TechnicalAidsController extends AppController {

    public $name = 'TechnicalAids';

    function edit($id) {
        $this->TechnicalAid->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->TechnicalAid->find('first', array('conditions' => array('TechnicalAid.id' => $id)));
        } else {

            if ($this->TechnicalAid->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'TechnicalAids', 'action' => 'index', $this->data['TechnicalAid']['id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add($productive_baseline_id) {
        $this->TechnicalAid->recursive = -1;
        $this->set('productive_baseline_id', $productive_baseline_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->TechnicalAid->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'TechnicalAids', 'action' => 'index', $productive_baseline_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index($productive_baseline_id) {
         $this->TechnicalAid->recursive = -1;
        $this->set('productive_baseline_id', $productive_baseline_id);
        $this->paginate = array('TechnicalAid' => array('maxLimit' => 500, 'limit' => 50));
        $this->set('TechnicalAids', $this->paginate(array('TechnicalAid.activo'=>1, 'TechnicalAid.productive_baseline_id' => $productive_baseline_id)));
    }

    function delete($aid_id, $productive_baseline_id) {
//         $datos = array('TechnicalAid' => array(
//                'id' => $aid_id,
//                'sincronizado' => 0,
//                'activo' => 0
//        ));
//        if ($this->TechnicalAid->save($datos)) {
//            $this->Session->setFlash('Registro Borrado correctamente', 'flash_custom');
//            $this->redirect(array('controller' => 'TechnicalAids', 'action' => 'index', $productive_baseline_id));
//        } else {
//            $this->Session->setFlash('Error Guardando datos');
//        }
        if ($this->TechnicalAid->delete($aid_id)) {
            $this->Session->setFlash('Registro Borrado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'TechnicalAids', 'action' => 'index', $productive_baseline_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

}

?>