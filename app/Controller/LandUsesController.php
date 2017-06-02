<?php

Class LandUsesController extends AppController {

    public $name = 'LandUses';

    function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->LandUse->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'LandUses', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->LandUse->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->LandUse->find('first', array('conditions' => array('LandUse.id' => $id), 'fields' => array('LandUse.id', 'LandUse.property_id', 'LandUse.area', 'LandUse.nombre', 'LandUse.unidad', 'LandUse.property_id', 'LandUse.id')));
        } else {

            if ($this->LandUse->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'LandUses', 'action' => 'index', $this->data['LandUse']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        $this->paginate = array('LandUse' => array('maxLimit' => 500, 'recursive' => 0, 'limit' => 50, 'fields' => array('LandUse.area', 'LandUse.id', 'Property.nombre', 'LandUse.nombre', 'LandUse.unidad', 'LandUse.property_id', 'LandUse.id')));
        $this->set('LandUses', $this->paginate(array('LandUse.activo' =>1,'LandUse.property_id' => $property_id)));
    }

    function delete($use_id, $property_id) {
        $datos=array('LandUse'=>array(
            'id'=>$use_id,
            'sincronizado'=>0,
            'activo'=>0
        ));
        if ($this->LandUse->save($datos)) {
            $this->Session->setFlash('Registro borrado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'LandUses', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error editando datos');
        }
//        if ($this->LandUse->delete($use_id)) {
//            $this->Session->setFlash('Registro borrado correctamente', 'flash_custom');
//            $this->redirect(array('controller' => 'LandUses', 'action' => 'index', $property_id));
//        } else {
//            $this->Session->setFlash('Error editando datos');
//        }
    }

}

?>