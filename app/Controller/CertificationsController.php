<?php

Class CertificationsController extends AppController {

    public $name = 'Certifications';

    function add($productive_poll_id) {
        $this->layout = "ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->Certification->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente','flash_custom');
                $this->redirect(array('controller' => 'Certifications', 'action' => 'index',$productive_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
       $this->layout = "ajax";
        $this->Certification->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Certification->find('first', array('conditions' => array('Certification.id' => $id), 'fields' => array('Certification.entidad', 'Certification.nombre_certificacion', 'Certification.fecha_inicio', 'Certification.fecha_fin', 'Certification.productive_poll_id', 'Certification.id')));
        } else {

            if ($this->Certification->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente','flash_custom');
                $this->redirect(array('controller' => 'Certifications', 'action' => 'index',$this->data['Certification']['productive_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($productive_poll_id) {
        $this->layout = "ajax";
        $this->Certification->recursive = -1;
        $this->set('productive_poll_id', $productive_poll_id);
        $this->paginate = array('Certification' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Certification.entidad', 'Certification.nombre_certificacion', 'Certification.fecha_inicio', 'Certification.fecha_fin', 'Certification.id')));
        $this->set('Certifications', $this->paginate(array('Certification.productive_poll_id' => $productive_poll_id)));
    }

}

?>