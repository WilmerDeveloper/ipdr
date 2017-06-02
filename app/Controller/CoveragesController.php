<?php

Class CoveragesController extends AppController {

    public $name = 'Coverages';

    function index($property_id) {
        $this->layout = "ajax";
        $this->Coverage->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('Coverage' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Coverage.id', 'Coverage.cobertura', 'Coverage.area', 'Coverage.porcentaje', 'Coverage.area_total', 'Coverage.porcentaje_total', 'Coverage.property_id')));
        $this->set('Coverages', $this->paginate(array('Coverage.property_id' => $property_id)));
    }

    function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Coverage->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Coverages', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($cover_id) {
        $this->layout = "ajax";
        $this->Coverage->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Coverage->find('first', array('conditions' => array('Coverage.id' => $cover_id), 'fields' => array('Coverage.id', 'Coverage.cobertura', 'Coverage.area', 'Coverage.porcentaje', 'Coverage.area_total', 'Coverage.porcentaje_total', 'Coverage.property_id')));
        } else {
            if ($this->Coverage->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Coverages', 'action' => 'index', $this->data['Coverage']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function delete($coverage_id, $property_id) {
        $this->layout = "ajax";
        if ($this->Coverage->delete($coverage_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Coverages', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }

}

?>