<?php

Class WaterResourcesController extends AppController {

    public $name = 'WaterResources';

    function index($property_id) {
        $this->layout = "ajax";
        $this->WaterResource->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('WaterResource' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('WaterResource.id', 'WaterResource.recurso_tipo', 'WaterResource.recurso_cantidad', 'WaterResource.recurso_nombre', 'WaterResource.uso_agua_domestico', 'WaterResource.uso_agua_agricultura', 'WaterResource.uso_agua_ganaderia', 'WaterResource.uso_agua_piscicultura', 'WaterResource.disponibilidad', 'WaterResource.estado', 'WaterResource.suficiencia', 'WaterResource.suficiencia_razon')));
        $this->set('WaterResources', $this->paginate(array('WaterResource.activo'=>1, 'WaterResource.property_id' => $property_id)));
    }

    function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->WaterResource->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'WaterResources', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->WaterResource->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->WaterResource->find('first', array('conditions' => array('WaterResource.id' => $id), 'fields' => array('WaterResource.tipo_otro', 'WaterResource.id', 'WaterResource.recurso_tipo', 'WaterResource.recurso_cantidad', 'WaterResource.recurso_nombre', 'WaterResource.uso_agua_domestico', 'WaterResource.uso_agua_agricultura', 'WaterResource.uso_agua_piscicultura', 'WaterResource.uso_agua_ganaderia', 'WaterResource.disponibilidad', 'WaterResource.estado', 'WaterResource.suficiencia', 'WaterResource.suficiencia_razon', 'WaterResource.property_id')));
        } else {
            if ($this->WaterResource->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'WaterResources', 'action' => 'index', $this->data['WaterResource']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function delete($waterresource_id, $property_id) {
        $this->layout = "ajax";
        $datos=array(
            'WaterResource'=>array(
                'id'=>$waterresource_id,
                'sincronizado'=>0,
                'activo'=>0,
            )
        );
        if ($this->WaterResource->save($datos)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'WaterResources', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
//        if ($this->WaterResource->delete($waterresource_id)) {
//            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
//            $this->redirect(array('controller' => 'WaterResources', 'action' => 'index', $property_id));
//        } else {
//            $this->Session->setFlash('Error Guardando datos');
//        }
    }

}

?>