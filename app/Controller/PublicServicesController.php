<?php

Class PublicServicesController extends AppController {

    public $name = 'PublicServices';

    function edit($id) {
        $this->layout = "ajax";
        $this->PublicService->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->PublicService->find('first', array('conditions' => array('PublicService.id' => $id), 'fields' => array('PublicService.id', 'PublicService.name', 'PublicService.home_id', 'PublicService.id')));
        } else {

            if ($this->PublicService->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'PublicServices', 'action' => 'index', $this->data['PublicService']['home_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add($home_id) {
        $this->layout = "ajax";
        $this->set('home_id', $home_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->PublicService->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'PublicServices', 'action' => 'index', $home_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index($home_id) {
        $this->layout = "ajax";
        $this->PublicService->recursive = -1;
        $this->set('home_id', $home_id);
        $this->paginate = array('PublicService' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('PublicService.id', 'PublicService.name', 'PublicService.home_id', 'PublicService.id')));
        $this->set('PublicServices', $this->paginate(array('PublicService.home_id' => $home_id)));
    }

    function delete($service_id, $home_id) {
        $this->layout = "ajax";
        if ($this->PublicService->delete($service_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'PublicServices', 'action' => 'index', $home_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

}

?>