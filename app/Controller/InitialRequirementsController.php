<?php

Class InitialRequirementsController extends AppController {

    public $name = 'InitialRequirements';

    function add($call_id) {
        $this->set('call_id',$call_id);
        App::import('model','Call');
        $Call = new Call();
            $Call->recursive = -1;
            $this->set('calls', $Call->find('list', array('fields' => array('Call.id', 'Call.nombre'),'order'=>array('Call.id DESC') )));
    
        if (empty($this->data)) {
            
        } else {

            if ($this->InitialRequirement->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'InitialRequirements', 'action' => 'index',$call_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->InitialRequirement->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->InitialRequirement->find('first', array('conditions' => array('InitialRequirement.id' => $id), 'fields' => array('InitialRequirement.id', 'InitialRequirement.texto', 'InitialRequirement.tipo', 'InitialRequirement.call_id','InitialRequirement.id')));
        } else {

            if ($this->InitialRequirement->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'InitialRequirements', 'action' => 'index',$this->data['InitialRequirement']['call_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($call_id) {
        $this->set('call_id',$call_id);
        $this->paginate = array('InitialRequirement' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('InitialRequirement.id', 'InitialRequirement.texto', 'InitialRequirement.tipo', 'InitialRequirement.id')));
        $this->set('InitialRequirements', $this->paginate(array('InitialRequirement.call_id'=>$call_id)));
    }

}

?>