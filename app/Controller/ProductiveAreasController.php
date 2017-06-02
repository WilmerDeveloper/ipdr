<?php

Class ProductiveAreasController extends AppController {

    public $name = 'ProductiveAreas';

    function edit($id) {
         $this->layout="ajax";
          $this->set('productiveActivities', $this->ProductiveArea->ProductiveActivity->find('list',array('fields'=>array('id','nombre'))));
          $this->ProductiveArea->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->ProductiveArea->find('first', array('conditions' => array('ProductiveArea.id' => $id)));
        } else {

            if ($this->ProductiveArea->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente','flash_custom');
                                $this->redirect(array('controller' => 'ProductiveAreas', 'action' => 'index',$this->data['ProductiveArea']['productive_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add($productive_poll_id) {
        $this->layout="ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        $this->set('productiveActivities', $this->ProductiveArea->ProductiveActivity->find('list',array('fields'=>array('id','nombre'))));
        if (empty($this->data)) {
            
        } else {

            if ($this->ProductiveArea->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente','flash_custom');
                $this->redirect(array('controller' => 'ProductiveAreas', 'action' => 'index',$productive_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index($productive_poll_id) {
        $this->layout="ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        $this->paginate = array('ProductiveArea' => array('maxLimit' => 500,'recursive'=>1,  'limit' => 50, 'fields' => array('ProductiveActivity.nombre', 'ProductiveArea.area', 'ProductiveArea.asociado', 'ProductiveArea.unidad', 'ProductiveArea.densidad', 'ProductiveArea.volumen_producion', 'ProductiveArea.unidad_produccion', 'ProductiveArea.cosechas', 'ProductiveArea.id','ProductiveArea.orden')));
        $this->set('ProductiveAreas', $this->paginate(array('ProductiveArea.productive_poll_id' => $productive_poll_id)));
    }

}

?>