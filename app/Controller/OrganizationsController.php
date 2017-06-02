<?php

Class OrganizationsController extends AppController {

    public $name = 'Organizations';

    function index($property_id) {
        $this->layout = "ajax";
        $this->Organization->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('Organization' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Organization.id', 'Organization.tipo', 'Organization.tipo_otro', 'Organization.legalidad', 'Organization.nombre', 'Organization.sigla', 'Organization.representante_nombre', 'Organization.numero_miembros', 'Organization.numero_asociados', 'Organization.tiempo', 'Organization.property_id')));
        $this->set('Organizations', $this->paginate(array('Organization.property_id' => $property_id)));
    }

    function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Organization->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Organizations', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($org_id) {
        $this->layout = "ajax";
        $this->Organization->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Organization->find('first', array('conditions' => array('Organization.id' => $org_id), 'fields' => array('Organization.id', 'Organization.tipo', 'Organization.tipo_otro', 'Organization.legalidad', 'Organization.nombre', 'Organization.sigla', 'Organization.representante_nombre', 'Organization.numero_miembros', 'Organization.numero_asociados', 'Organization.tiempo', 'Organization.property_id')));
        } else {
            if ($this->Organization->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Organizations', 'action' => 'index', $this->data['Organization']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function delete($organization_id, $property_id) {
        $this->layout = "ajax";
        if ($this->Organization->delete($organization_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Organizations', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

}

?>