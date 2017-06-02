<?php

Class FloorUnitsController extends AppController {

    public $name = 'FloorUnits';

    function index($property_id) {
        $this->layout = "ajax";
        $this->FloorUnit->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('FloorUnit' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('FloorUnit.id', 'FloorUnit.area', 'FloorUnit.pendiente', 'FloorUnit.erosion', 'FloorUnit.profundidad_efectiva', 'FloorUnit.pedregosidad', 'FloorUnit.salinidad', 'FloorUnit.color', 'FloorUnit.drenaje', 'FloorUnit.encharcamiento', 'FloorUnit.erosion', 'FloorUnit.inundabilidad', 'FloorUnit.freatico', 'FloorUnit.textura', 'FloorUnit.profundidad_efectiva', 'FloorUnit.ph', 'FloorUnit.area_util', 'FloorUnit.agrologica', 'FloorUnit.encharcamiento', 'FloorUnit.horizonte', 'FloorUnit.pedregosidad_superficial', 'FloorUnit.otro', 'FloorUnit.property_id')));
        $this->set('FloorUnits', $this->paginate(array('FloorUnit.property_id' => $property_id)));
    }
    function baseline_index($property_id) {
        $this->layout = "ajax";
        $this->FloorUnit->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('FloorUnit' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('FloorUnit.id', 'FloorUnit.area', 'FloorUnit.pendiente', 'FloorUnit.erosion', 'FloorUnit.profundidad_efectiva', 'FloorUnit.pedregosidad', 'FloorUnit.salinidad', 'FloorUnit.color', 'FloorUnit.drenaje', 'FloorUnit.encharcamiento', 'FloorUnit.erosion', 'FloorUnit.inundabilidad', 'FloorUnit.freatico', 'FloorUnit.textura', 'FloorUnit.profundidad_efectiva', 'FloorUnit.ph', 'FloorUnit.area_util', 'FloorUnit.agrologica', 'FloorUnit.encharcamiento', 'FloorUnit.horizonte', 'FloorUnit.pedregosidad_superficial', 'FloorUnit.otro', 'FloorUnit.property_id')));
        $this->set('FloorUnits', $this->paginate(array('FloorUnit.property_id' => $property_id)));
    }

    function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->FloorUnit->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FloorUnits', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }
    function baseline_add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->FloorUnit->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FloorUnits', 'action' => 'baseline_index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->FloorUnit->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->FloorUnit->find('first', array('conditions' => array('FloorUnit.id' => $id), 'fields' => array('FloorUnit.id', 'FloorUnit.area', 'FloorUnit.pendiente', 'FloorUnit.erosion', 'FloorUnit.color', 'FloorUnit.profundidad_efectiva', 'FloorUnit.pedregosidad', 'FloorUnit.salinidad', 'FloorUnit.drenaje', 'FloorUnit.encharcamiento', 'FloorUnit.inundabilidad', 'FloorUnit.freatico', 'FloorUnit.textura', 'FloorUnit.profundidad_efectiva', 'FloorUnit.ph', 'FloorUnit.area_util', 'FloorUnit.agrologica', 'FloorUnit.encharcamiento', 'FloorUnit.horizonte', 'FloorUnit.pedregosidad_superficial', 'FloorUnit.otro', 'FloorUnit.property_id')));
        } else {
            if ($this->FloorUnit->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FloorUnits', 'action' => 'index', $this->data['FloorUnit']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }
    function baseline_edit($id) {
        $this->layout = "ajax";
        $this->FloorUnit->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->FloorUnit->find('first', array('conditions' => array('FloorUnit.id' => $id), 'fields' => array('FloorUnit.id', 'FloorUnit.area', 'FloorUnit.pendiente', 'FloorUnit.erosion', 'FloorUnit.color', 'FloorUnit.profundidad_efectiva', 'FloorUnit.pedregosidad', 'FloorUnit.salinidad', 'FloorUnit.drenaje', 'FloorUnit.encharcamiento', 'FloorUnit.inundabilidad', 'FloorUnit.freatico', 'FloorUnit.textura', 'FloorUnit.profundidad_efectiva', 'FloorUnit.ph', 'FloorUnit.area_util', 'FloorUnit.agrologica', 'FloorUnit.encharcamiento', 'FloorUnit.horizonte', 'FloorUnit.pedregosidad_superficial', 'FloorUnit.otro', 'FloorUnit.property_id')));
        } else {
            if ($this->FloorUnit->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FloorUnits', 'action' => 'baseline_index', $this->data['FloorUnit']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function delete($floorunit_id, $property_id) {
        $this->layout = "ajax";
        if ($this->FloorUnit->delete($floorunit_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'FloorUnits', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }
    function baseline_delete($floorunit_id, $property_id) {
        $this->layout = "ajax";
        if ($this->FloorUnit->delete($floorunit_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'FloorUnits', 'action' => 'baseline_index', $property_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }

}
