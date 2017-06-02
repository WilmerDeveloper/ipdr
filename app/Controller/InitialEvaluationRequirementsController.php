<?php

Class InitialEvaluationRequirementsController extends AppController {

    public $name = 'InitialEvaluationRequirements';

    function edit($id, $ac_id) {
        $this->layout = "ajax";

        $this->set('acordeon_id', $ac_id);



        if (empty($this->data)) {

            $this->data = $this->InitialEvaluationRequirement->find('first', array('conditions' => array('InitialEvaluationRequirement.id' => $id), 'fields' => array('InitialEvaluationRequirement.*', 'Requirement.puntaje_maximo', 'Requirement.texto_ayuda', 'Requirement.tipo', 'Requirement.nombre')));
        } else {
            if ($this->data['InitialEvaluationRequirement']['calificacion'] == 'Nulo') {
                $this->request->data['InitialEvaluationRequirement']['puntaje'] = 0;
                ;
            } elseif ($this->data['InitialEvaluationRequirement']['calificacion'] == 'Bajo') {
                $this->request->data['InitialEvaluationRequirement']['puntaje'] = round($this->data['Requerimiento']['puntaje_maximo'] * 0.3);
                $this->request->data['InitialEvaluationRequirement']['puntaje'];
            } elseif ($this->data['InitialEvaluationRequirement']['calificacion'] == 'Bueno') {
                $this->request->data['InitialEvaluationRequirement']['puntaje'] = round($this->data['Requerimiento']['puntaje_maximo'] * 0.7);
                $this->request->data['InitialEvaluationRequirement']['puntaje'];
            } elseif ($this->data['InitialEvaluationRequirement']['calificacion'] == 'Excelente') {
                $this->request->data['InitialEvaluationRequirement']['puntaje'] = $this->data['Requerimiento']['puntaje_maximo'];
                $this->request->data['InitialEvaluationRequirement']['puntaje'];
            }


            if ($this->InitialEvaluationRequirement->save($this->data)) {
                $this->Session->write('acordeon_id', $ac_id);
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                if ($siguiente = $this->InitialEvaluationRequirement->find('first', array('conditions' => array('InitialEvaluationRequirement.id >' => $id, 'Requirement.tipo' => $this->data['InitialEvaluationRequirement']['tipo_requerimiento'], 'InitialEvaluationRequirement.initial_evaluation_id' => $this->data['InitialEvaluationRequirement']['initial_evaluation_id']), 'fields' => array('InitialEvaluationRequirement.*', 'Requirement.puntaje_maximo', 'Requirement.texto_ayuda', 'Requirement.tipo', 'Requirement.nombre')))) {

                $this->redirect(array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $siguiente['InitialEvaluationRequirement']['id'],$ac_id));
                } else {
                    $this->redirect(array('controller' => 'InitialEvaluations', 'action' => 'edit', $this->data['InitialEvaluationRequirement']['initial_evaluation_id']));
                }
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

}

?>