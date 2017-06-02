<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of candidate_requirements_controller
 *
 * @author wilson
 */
class PropertyRequirementscontroller extends AppController {

    //put your code here
    var $name = "PropertyRequirements";

    function index($property_id = null) {

        $this->layout = "ajax";
        $call_id = "2";
        $requerimientos = $this->PropertyRequirement->InitialRequirement->find(
                'all', array(
            'conditions' => array('InitialRequirement.tipo' => 'Predio', 'InitialRequirement.call_id' => $call_id),
            'fields' => array('InitialRequirement.id'),
            'recursive' => -1,
        ));

        foreach ($requerimientos as $req) {


            $r = $req['InitialRequirement']['id'];


            $cont = $this->PropertyRequirement->find('count', array('recursive' => -1, 'conditions' => array('PropertyRequirement.initial_requirement_id' => $req['InitialRequirement']['id'], 'PropertyRequirement.property_id' => $property_id)));
            if ($cont == 0) {
                $this->PropertyRequirement->query("INSERT INTO property_requirements (property_id,initial_requirement_id,sincronizado)values($property_id,$r,0)");
            }
        }
        $this->loadModel('Property');
        $cerrado = 0;
        if ($cal0 = $this->Property->field('Property.calificacion_fase0', array('Property.id' => $property_id))) {
            if ($cal0 == "Cumple" || $cal0 == "No cumple") {
                $cerrado = 1;
            }
        }
        $this->set('cerrado', $cerrado);

        $requerimientos = $this->PropertyRequirement->find('all', array('recursive' => 0, 'conditions' => array('PropertyRequirement.property_id' => $property_id), 'fields' => array('PropertyRequirement.property_id', 'PropertyRequirement.id', 'InitialRequirement.texto', 'PropertyRequirement.calificacion', 'PropertyRequirement.concepto')));
        $this->set('requisitos', $requerimientos);
        $this->set('predio', $this->PropertyRequirement->Property->find('first', array('recursive' => -1, 'conditions' => array('Property.id' => $property_id), 'fields' => array('Property.nombre'))));
    }

    function delete($id, $property_id) {
        if ($this->PropertyRequirement->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'PropertyRequirements', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error borrando datos', 'flash_custom');
        }
    }

    function edit($id = null) {

        if (empty($this->data)) {

            $this->data = $this->PropertyRequirement->find('first', array('conditions' => array('PropertyRequirement.id' => $id), 'fields' => array('PropertyRequirement.id', 'PropertyRequirement.initial_requirement_id', 'PropertyRequirement.property_id', 'PropertyRequirement.concepto', 'PropertyRequirement.calificacion', 'Property.nombre', 'InitialRequirement.texto')));
        } else {
            $pr = $this->data['PropertyRequirement']['property_id'];
            if ($this->PropertyRequirement->save($this->data)) {
                $this->Session->setFlash('Registro guardado exitosamente');
                
                if ($nextId = $this->PropertyRequirement->field('PropertyRequirement.id', array('PropertyRequirement.id >' => $id, 'PropertyRequirement.property_id' => $pr))) {
                    $this->redirect(array('controller' => 'PropertyRequirements', 'action' => 'edit', $nextId));  
                }else{
                  $this->redirect(array('controller' => 'PropertyRequirements', 'action' => 'index', $pr));  
                }
                
            }
        }
    }

}

?>