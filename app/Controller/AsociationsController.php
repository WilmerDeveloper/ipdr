<?php

Class AsociationsController extends AppController {

    public $name = 'Asociations';

    function add($beneficiary_id) {
        $this->layout = "ajax";
        $this->request->data['Asociation']['beneficiary_id'] = $beneficiary_id;


        if ($this->Asociation->save($this->data)) {
            $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Asociations', 'action' => 'index', $beneficiary_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->Asociation->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Asociation->find('first', array('conditions' => array('Asociation.id' => $id), 'fields' => array('Asociation.id', 'Asociation.nombre', 'Asociation.comercializacion', 'Asociation.informacion_financiera', 'Asociation.infraestructura', 'Asociation.apoyo_agricola', 'Asociation.apoyo_familiar', 'Asociation.experiencias_agricultores', 'Asociation.participacion', 'Asociation.reuniones', 'Asociation.confianza_lideres', 'Asociation.confianza_socios', 'Asociation.confianza_vecinos', 'Asociation.confianza_intermediarios', 'Asociation.confianza_comerciantes', 'Asociation.confianza_empresarios', 'Asociation.confianza_autoridades', 'Asociation.confianza_tecnicos', 'Asociation.observaciones', 'Asociation.tierras', 'Asociation.oficinas', 'Asociation.maquinaria', 'Asociation.herramientas', 'Asociation.cultivos', 'Asociation.otro_estructura', 'Asociation.centros_acopio', 'Asociation.decision_consenso', 'Asociation.decision_director', 'Asociation.decision_consejo', 'Asociation.decision_otro', 'Asociation.decision_no_sabe', 'Asociation.decision_asamblea', 'Asociation.beneficiary_id', 'Asociation.id')));
        } else {

            if ($this->Asociation->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Asociations', 'action' => 'index',$this->data['Asociation']['beneficiary_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($beneficiary_id) {
        $this->layout = "ajax";
        
            $this->set('beneficiary_id', $beneficiary_id);
            $this->paginate = array('Asociation' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Asociation.id', 'Asociation.nombre', 'Asociation.observaciones', 'Asociation.id')));
            $this->set('Asociations', $this->paginate(array('Asociation.beneficiary_id' => $beneficiary_id)));
       
    }

}

?>