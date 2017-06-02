<?php

Class RoadsController extends AppController {

    public $name = 'Roads';

    function index($property_id) {
        $this->layout = "ajax";
        $this->Road->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('Road' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Road.id', 'Road.tipo', 'Road.estado', 'Road.distancia', 'Road.descripcion')));
        $this->set('Roads', $this->paginate(array('Road.property_id' => $property_id ,'Road.activo'=>1)));
    }

    function add($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Road->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Roads', 'action' => 'index', $property_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($road_id) {
        $this->layout = "ajax";
        $this->Road->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Road->find('first', array('conditions' => array('Road.id' => $road_id), 'fields' => array('Road.id', 'Road.tipo', 'Road.estado', 'Road.distancia', 'Road.descripcion', 'Road.property_id')));
        } else {
            if ($this->Road->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Roads', 'action' => 'index', $this->data['Road']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function delete($road_id, $property_id) {
        $this->layout = "ajax";
        $datos=array('Road'=>array(
            'id'=>$road_id,
            'sincronizado'=>0,
            'activo'=>0
        ));
        if ($this->Road->save($datos)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Roads', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
//        if ($this->Road->delete($road_id)) {
//            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
//            $this->redirect(array('controller' => 'Roads', 'action' => 'index', $property_id));
//        } else {
//            $this->Session->setFlash('Error Eliminando datos');
//        }
    }

}

?>