<?php

Class PropertyControlsController extends AppController {

    public $name = 'PropertyControls';

    function add($property_id) {
        $this->layout = "ajax";
        $this->PropertyControl->recursive = -1;
        $this->set('property_id',$property_id);
        if (empty($this->data)) {

        } else {

            if ($this->PropertyControl->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'PropertyControls', 'action' => 'index',$property_id));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }
    function edit($id) {
        $this->layout = "ajax";
        $this->PropertyControl->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->PropertyControl->find('first', array('conditions' => array('PropertyControl.id' => $id), 'fields' => array('PropertyControl.formulario', 'PropertyControl.nombre_aliado','PropertyControl.fecha_entrevista', 'PropertyControl.numero_visitas', 'PropertyControl.nombre_encuestador', 'PropertyControl.documento_encuestador', 'PropertyControl.property_id', 'PropertyControl.id')));
        } else {

            if ($this->PropertyControl->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'PropertyControls', 'action' => 'index',$this->data['PropertyControl']['property_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($property_id) {
        $this->layout = "ajax";
        $this->PropertyControl->recursive = -1;
        $this->set('property_id', $property_id);
        $this->paginate = array('PropertyControl' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('PropertyControl.id', 'PropertyControl.formulario', 'PropertyControl.nombre_aliado', 'PropertyControl.numero_visitas', 'PropertyControl.nombre_encuestador', 'PropertyControl.documento_encuestador', 'PropertyControl.property_id', 'PropertyControl.id')));
        $this->set('PropertyControls', $this->paginate(array('PropertyControl.property_id' => $property_id)));
    }

}

?>