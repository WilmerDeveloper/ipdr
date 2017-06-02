<?php

Class PlotPollsController extends AppController {

    public $name = 'PlotPolls';

    public function index($beneficiary_id) {

        $this->set('beneficiary_id', $beneficiary_id);
        $this->paginate = array('PlotPoll' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('PlotPoll.id', 'PlotPoll.observaciones', 'User.nombre', 'User.primer_apellido', 'PlotPoll.fecha_ultima_visita')));
        $this->set('PlotPolls', $this->paginate(array('PlotPoll.beneficiary_id' => $beneficiary_id)));
    }

    public function add($beneficiary_id) {
        if (empty($this->data)) {
            $this->request->data['PlotPoll']['beneficiary_id'] = $beneficiary_id;
            $this->request->data['PlotPoll']['user_id'] = $this->Auth->user('id');
            if ($this->PlotPoll->save($this->request->data)) {

                $this->Session->setFlash("Registro adicionado correctamente", 'flash_custom');
                $this->redirect(array('Controller' => 'PlotPolls', 'action' => 'index', $beneficiary_id));
            }
        }
    }

    public function edit_explotation($plot_id) {
        $this->PlotPoll->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->PlotPoll->find('first', array('conditions' => array('PlotPoll.id' => $plot_id), 'fields' => array('PlotPoll.area_ha', 'PlotPoll.area_m', 'PlotPoll.id', 'PlotPoll.documento_contractual', 'PlotPoll.numero_documento_contractual', 'PlotPoll.acuerdo_financiamiento', 'PlotPoll.contrato_operacion', 'PlotPoll.fecha_inicio', 'PlotPoll.fecha_terminacion', 'PlotPoll.duracion', 'PlotPoll.familias_beneficiadas', 'PlotPoll.tipo_familias', 'PlotPoll.fecha_desembolso', 'PlotPoll.valor_desembolzado', 'PlotPoll.objeto', 'PlotPoll.id')));
        } else {

            if ($this->PlotPoll->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'PlotPolls', 'action' => 'explotation_index', $plot_id));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function work_index($plot_id) {
        $this->paginate = array('PlotPoll' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('PlotPoll.observaciones', 'PlotPoll.mano_obra_familiar', 'PlotPoll.mano_obra_externa', 'PlotPoll.valor_jormal', 'PlotPoll.id')));
        $this->set('PlotPolls', $this->paginate(array('PlotPoll.id' => $plot_id)));
    }
    public function ambiental_index($plot_id) {
        $this->paginate = array('PlotPoll' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('PlotPoll.id', 'PlotPoll.concesion_agua', 'PlotPoll.erosion', 'PlotPoll.remocion_en_masa', 'PlotPoll.contaminacion_agua','PlotPoll.invasion_zonas_protecion','PlotPoll.residuos_solidos','PlotPoll.acueducto_veredal','PlotPoll.quebrada','PlotPoll.pozo','PlotPoll.rio','PlotPoll.aljibe','PlotPoll.lluvia','PlotPoll.observacion_ambiental')));
        $this->set('PlotPolls', $this->paginate(array('PlotPoll.id' => $plot_id)));
    }

    
     public function edit_ambiental($id) {
        $this->PlotPoll->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->PlotPoll->find('first', array('conditions' => array('PlotPoll.id' => $id), 'fields' => array('PlotPoll.id','PlotPoll.deforestacion', 'PlotPoll.concesion_agua', 'PlotPoll.erosion', 'PlotPoll.remocion_en_masa', 'PlotPoll.contaminacion_agua','PlotPoll.invasion_zonas_protecion','PlotPoll.residuos_solidos','PlotPoll.acueducto_veredal','PlotPoll.quebrada','PlotPoll.pozo','PlotPoll.rio','PlotPoll.aljibe','PlotPoll.lluvia','PlotPoll.observacion_ambiental')));
        } else {

            if ($this->PlotPoll->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'PlotPolls', 'action' => 'ambiental_index', $id));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }
    public function edit_work($id) {
        $this->PlotPoll->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->PlotPoll->find('first', array('conditions' => array('PlotPoll.id' => $id), 'fields' => array('PlotPoll.observaciones', 'PlotPoll.mano_obra_familiar', 'PlotPoll.mano_obra_externa', 'PlotPoll.valor_jormal', 'PlotPoll.id')));
        } else {

            if ($this->PlotPoll->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'PlotPolls', 'action' => 'work_index', $id));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function tecnical_edit($id) {
        $this->PlotPoll->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->PlotPoll->find('first', array('conditions' => array('PlotPoll.id' => $id), 'fields' => array('PlotPoll.asistencia_tecnica', 'PlotPoll.entidad_asistencia', 'PlotPoll.frecuencia_visita_tecnica', 'PlotPoll.id')));
        } else {

            if ($this->PlotPoll->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'PlotPolls', 'action' => 'tecnical_index', $id));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function tecnical_index($poll_id) {
        $this->paginate = array('PlotPoll' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('PlotPoll.asistencia_tecnica', 'PlotPoll.entidad_asistencia', 'PlotPoll.frecuencia_visita_tecnica', 'PlotPoll.id')));
        $this->set('PlotPolls', $this->paginate(array('PlotPoll.id' => $poll_id)));
    }

    public function general_index($poll_id) {

        $this->paginate = array('PlotPoll' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('PlotPoll.numero_de_parcela', 'PlotPoll.area_ha', 'PlotPoll.area_m', 'PlotPoll.cuenta_con_vivienda', 'PlotPoll.comparte_vivienda', 'PlotPoll.Habita_vivienda', 'PlotPoll.id')));
        $this->set('PlotPolls', $this->paginate(array('PlotPoll.id' => $poll_id)));
    }

    public function edit_general($id) {
        $this->PlotPoll->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->PlotPoll->find('first', array('conditions' => array('PlotPoll.id' => $id), 'fields' => array('PlotPoll.id', 'PlotPoll.fecha_ultima_visita', 'Plotpoll.observaciones', 'PlotPoll.numero_de_parcela', 'PlotPoll.area_ha', 'PlotPoll.area_m', 'PlotPoll.cuenta_con_vivienda', 'PlotPoll.comparte_vivienda', 'PlotPoll.Habita_vivienda', 'PlotPoll.beneficiary_id', 'PlotPoll.user_id', 'PlotPoll.incumplimiento', 'PlotPoll.id')));
        } else {
            if ($this->data['PlotPoll']['area_m'] < 10000) {
                if ($this->PlotPoll->save($this->data)) {
                    $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'PlotPolls', 'action' => 'general_index', $id));
                } else {
                    $this->Session->setFlash('Error editando datos');
                }
            } else {
                $this->Session->setFlash('El área en metros no debe ser mayor a 10.000', 'flash_custom');
                $this->redirect(array('controller' => 'PlotPolls', 'action' => 'general_index', $id));
            }
        }
    }

    public function view_poll($poll_id, $beneficiary_id) {
        $this->set('poll_id', $poll_id);
        $this->set('beneficiary_id', $beneficiary_id);
        $visit_id = $this->PlotPoll->field('visit_id', array('PlotPoll.id' => $poll_id));
        $this->loadModel('Visit');
        $follow_id = $this->Visit->field('follow_id', array('Visit.id' => $visit_id));
        $this->set('visit_id', $visit_id);
        $this->set('follow_id', $follow_id);
    }
    
    
    public function print_list() {
        $this->layout = "pdf";
        $this->response->type('application/pdf');
        $this->loadModel('Beneficiary');
        $proyect_id=$this->Session->read('proyect_id');
        $this->set('Beneficiaries', $this->Beneficiary->find('all',array('recursive'=>-1, 'joins'=>array(array('table'=>'properties','alias'=> 'Property','conditions'=>'Property.id=Beneficiary.property_id')), 'conditions'=>array('Property.proyect_id'=>$proyect_id,'Beneficiary.calificacion_visita'=>'Cumple'),'fields'=>array('Beneficiary.nombres','Beneficiary.primer_apellido','Beneficiary.primer_apellido','Beneficiary.numero_identificacion','Beneficiary.direccion','Beneficiary.telefono','Beneficiary.email') ))) ;
    }

}

?>