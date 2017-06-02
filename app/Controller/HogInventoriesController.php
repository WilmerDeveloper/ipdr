<?php

Class HogInventoriesController extends AppController {

    public $name = 'HogInventories';

    function add($productive_baseline_id) {
        $this->set('productive_baseline_id', $productive_baseline_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->HogInventory->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'HogInventories', 'action' => 'index',$productive_baseline_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
      
        $this->HogInventory->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->HogInventory->find('first', array('conditions' => array('HogInventory.id' => $id), 'fields' => array('HogInventory.id', 'HogInventory.cerdas_madre', 'HogInventory.cerdas_reproduccion', 'HogInventory.lechonas_lactantes', 'HogInventory.cerdos_levante', 'HogInventory.cerdos_ceba', 'HogInventory.reproductores', 'HogInventory.corrales_seciones_definidas', 'HogInventory.corrales_flujo_continuo', 'HogInventory.corrales_no_tecnificados', 'HogInventory.cemento', 'HogInventory.cama_profunda', 'HogInventory.madera', 'HogInventory.plastico', 'HogInventory.otro', 'HogInventory.tierra', 'HogInventory.vacunacion', 'HogInventory.productive_baseline_id', 'HogInventory.id')));
        } else {

            if ($this->HogInventory->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'HogInventories', 'action' => 'index',$this->data['HogInventory']['productive_baseline_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($productive_baseline_id) {
         $this->set('productive_baseline_id', $productive_baseline_id);
        $this->paginate = array( 'HogInventory' => array('rcursive'=>-1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('HogInventory.id', 'HogInventory.cerdas_madre', 'HogInventory.cerdas_reproduccion', 'HogInventory.lechonas_lactantes', 'HogInventory.cerdos_levante', 'HogInventory.cerdos_ceba', 'HogInventory.reproductores', 'HogInventory.corrales_seciones_definidas', 'HogInventory.corrales_flujo_continuo', 'HogInventory.corrales_no_tecnificados', 'HogInventory.cemento', 'HogInventory.cama_profunda', 'HogInventory.madera', 'HogInventory.plastico', 'HogInventory.otro', 'HogInventory.tierra', 'HogInventory.vacunacion', 'HogInventory.id')));
        $this->set('HogInventories', $this->paginate(array('HogInventory.productive_baseline_id'=>$productive_baseline_id,'HogInventory.activo'=>1)));
    }
    
    function delete($hog_id,$productive_baseline_id) {
         
         if ($this->HogInventory->delete($hog_id)) {
            $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'HogInventories', 'action' => 'index', $productive_baseline_id));
        } else {
            $this->Session->setFlash('Error editando datos');
        }
        
    }

}

?>