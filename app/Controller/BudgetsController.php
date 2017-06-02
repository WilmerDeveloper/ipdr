<?php

Class BudgetsController extends AppController {

    public $name = 'Budgets';

    public function add($follow_id) {
        $this->set('follow_id', $follow_id);
        if (empty($this->data)) {
            $this->Budget->MonitoringActivity->virtualFields = array(
                'name' => "MonitoringActivity.nombre+ ' ('+ MonitoringActivity.tipo+')'"
            );
            $this->set('monitoringActivities', $this->Budget->MonitoringActivity->find('list', array('fields' => array('id', 'name'), 'order' => array('MonitoringActivity.nombre ASC'))));
        } else {

            if ($this->data['Budget']['cantidad'] >= 1 and ($this->data['Budget']['cantidad'] * $this->data['Budget']['valor_unitario']) == ($this->data['Budget']['cofinanciacion_incoder'] + $this->data['Budget']['cofinaciacion_comunidad'] + $this->data['Budget']['contapartida_certificada'] + $this->data['Budget']['otra_contrapartida'])) {
                if ($this->Budget->saveAll($this->data)) {
                    $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'Budgets', 'action' => 'index', $follow_id));
                } else {
                    $this->Session->setFlash('Error Guardando datos');
                }
            } else {
                $this->Session->setFlash('El valor unitario por la cantidad debe ser igual a la suma de las cofinanciaciones. Por favor verificar la información.', 'flash_custom');
                $this->Budget->MonitoringActivity->virtualFields = array(
                    'name' => "MonitoringActivity.nombre+ ' ('+ MonitoringActivity.tipo+')'"
                );
                $this->set('monitoringActivities', $this->Budget->MonitoringActivity->find('list', array('fields' => array('id', 'name'), 'order' => array('MonitoringActivity.nombre ASC'))));
            }
        }
    }

    public function edit($id) {
        $this->Budget->MonitoringActivity->virtualFields = array(
            'name' => "MonitoringActivity.nombre+ ' ('+ MonitoringActivity.tipo+')'"
        );
        $this->set('monitoringActivities', $this->Budget->MonitoringActivity->find('list', array('fields' => array('id', 'name'), 'order' => array('MonitoringActivity.nombre ASC'))));
        $this->Budget->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Budget->find('first', array('conditions' => array('Budget.id' => $id)));
            foreach ($this->data['Budget'] as $key => $value) {
                $this->request->data['Budget'][$key] = str_replace(".0000", '', $value);
                //echo $key.".........".$value;
            }
        } else {
            if ($this->data['Budget']['cantidad'] >= 1 and ($this->data['Budget']['cantidad'] * $this->data['Budget']['valor_unitario']) == ($this->data['Budget']['cofinanciacion_incoder'] + $this->data['Budget']['cofinaciacion_comunidad'] + $this->data['Budget']['contapartida_certificada'] + $this->data['Budget']['otra_contrapartida'])) {
                if ($this->Budget->saveAll($this->data)) {
                    $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'Budgets', 'action' => 'index', $this->data['Budget']['follow_id']));
                } else {
                    $this->Session->setFlash('Error editando datos');
                }
            } else {
                $this->Session->setFlash('El valor unitario por la cantidad debe ser igual a la suma de las cofinanciaciones. Por favor verificar la información.', 'flash_custom');
                $this->Budget->MonitoringActivity->virtualFields = array(
                    'name' => "MonitoringActivity.nombre+ ' ('+ MonitoringActivity.tipo+')'"
                );
                $this->data = $this->Budget->find('first', array('recursive' => 1, 'conditions' => array('Budget.id' => $id)));
            }
        }
    }

    public function edit_calendario($id) {
        $this->set('monitoringActivities', $this->Budget->MonitoringActivity->find('list', array('fields' => array('id', 'nombre'))));
        $this->Budget->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Budget->find('first', array('conditions' => array('Budget.id' => $id)));
            foreach ($this->data['Budget'] as $key => $value) {
                $this->request->data['Budget'][$key] = str_replace(".0000", '', $value);
                //echo $key.".........".$value;
            }
        } else {
            if (($this->data['Budget']['mes1'] + $this->data['Budget']['mes2'] + $this->data['Budget']['mes3'] + $this->data['Budget']['mes4'] + $this->data['Budget']['mes4'] + $this->data['Budget']['mes6']) > ($this->data['Budget']['valor_unitario'] * $this->data['Budget']['cantidad'])) {
                $this->Session->setFlash('La suma de valores ingresados ' . ($this->data['Budget']['mes1'] + $this->data['Budget']['mes2'] + $this->data['Budget']['mes3'] + $this->data['Budget']['mes4'] + $this->data['Budget']['mes4'] + $this->data['Budget']['mes6']) . ' es mayor a la del plan de inversión ' . ($this->data['Budget']['valor_unitario'] * $this->data['Budget']['cantidad']), 'flash_custom');
                $this->redirect(array('controller' => 'Budgets', 'action' => 'index', $this->data['Budget']['follow_id']));
            } else {
                if ($this->Budget->saveAll($this->data)) {
                    $this->Session->setFlash('Registro editado correctamente', 'flash_custom');

                    $this->redirect(array('controller' => 'Budgets', 'action' => 'index', $this->data['Budget']['follow_id']));
                } else {
                    $this->Session->setFlash('Error editando datos');
                }
            }
        }
    }

    public function print_budget($follow_id) {
        $this->layout = "pdf";
        $this->response->type('application/pdf');
        $this->set('follow_id', $follow_id);
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);
        $Budgets = $this->Budget->find('all', array('recursive' => 0, 'order' => array('Budget.monitoring_activity_id ASC'), 'conditions' => array('Budget.follow_id' => $follow_id), 'fields' => array('Budget.*', 'MonitoringActivity.tipo', 'MonitoringActivity.nombre')));
        $this->set('Budgets', $Budgets);

        App::Import('Model', 'Property');
        $property = new Property();

        $predios = $property->find("all", array('recursive' => -1, 'conditions' => array('Property.proyect_id' => $proyect_id), 'fields' => array('Property.id')));

        App::Import('Model', 'Beneficiary');
        $ben = new Beneficiary();

        $fam_campesinas = 0;
        $fam_desplazadas = 0;
        $fam_indigena = 0;
        $fam_negritud = 0;
        $fam_rom = 0;
        $fam_mujer_cabeza = 0;
        $total_familias = 0;



        foreach ($predios as $predio) {
            $total_familias += $ben->find('count', array('recursive' => -1, 'conditions' => array('Beneficiary.property_id' => $predio['Property']['id'], 'Beneficiary.beneficiary_id' => 0, 'Beneficiary.calificacion_visita' => 'Cumple')));

            $fam_campesinas += $ben->find('count', array('recursive' => -1, 'conditions' => array('Beneficiary.property_id' => $predio['Property']['id'], 'Beneficiary.beneficiary_id' => 0, 'Beneficiary.tipo' => 'Campesino', 'Beneficiary.calificacion_visita' => 'Cumple')));
            $fam_desplazadas += $ben->find('count', array('recursive' => -1, 'conditions' => array('Beneficiary.property_id' => $predio['Property']['id'], 'Beneficiary.beneficiary_id' => 0, 'Beneficiary.tipo' => 'Desplazado', 'Beneficiary.calificacion_visita' => 'Cumple')));
            $fam_indigena += $ben->find('count', array('recursive' => -1, 'conditions' => array('Beneficiary.property_id' => $predio['Property']['id'], 'Beneficiary.beneficiary_id' => 0, 'Beneficiary.tipo' => 'Indigena', 'Beneficiary.calificacion_visita' => 'Cumple')));
            $fam_negritud += $ben->find('count', array('recursive' => -1, 'conditions' => array('Beneficiary.property_id' => $predio['Property']['id'], 'Beneficiary.beneficiary_id' => 0, 'Beneficiary.tipo' => 'Negritudes', 'Beneficiary.calificacion_visita' => 'Cumple')));
            $fam_rom += $ben->find('count', array('recursive' => -1, 'conditions' => array('Beneficiary.property_id' => $predio['Property']['id'], 'Beneficiary.beneficiary_id' => 0, 'Beneficiary.tipo' => 'Rom', 'Beneficiary.calificacion_visita' => 'Cumple')));
            $fam_mujer_cabeza += $ben->find('count', array('recursive' => -1, 'conditions' => array('Beneficiary.property_id' => $predio['Property']['id'], 'Beneficiary.beneficiary_id' => 0, 'Beneficiary.tipo' => 'Mujer cabeza de familia', 'Beneficiary.calificacion_visita' => 'Cumple')));
        }

        if ($fam_campesinas > 0)
            $this->set('fam_campesinas', $fam_campesinas);
        if ($fam_desplazadas > 0)
            $this->set('fam_desplazadas', $fam_desplazadas);
        if ($fam_indigena > 0)
            $this->set('fam_indigena', $fam_indigena);
        if ($fam_negritud > 0)
            $this->set('fam_negritud', $fam_negritud);
        if ($fam_rom > 0)
            $this->set('fam_rom', $fam_rom);
        if ($fam_mujer_cabeza > 0)
            $this->set('fam_mujer_cabeza', $fam_mujer_cabeza);
        if ($total_familias - $fam_campesinas - $fam_desplazadas - $fam_indigena - $fam_negritud - $fam_rom - $fam_mujer_cabeza > 0) {
            $total_familias = $total_familias - $fam_campesinas - $fam_desplazadas - $fam_indigena - $fam_negritud - $fam_rom - $fam_mujer_cabeza;
            $this->set('total_familias', $total_familias);
        }
    }

    public function print_calendar($follow_id) {

        $this->layout = "pdf";
        $this->response->type('application/pdf');
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);
        $this->set('follow_id', $follow_id);
        $Budgets = $this->Budget->find('all', array('conditions' => array('Budget.follow_id' => $follow_id), 'recursive' => 0, 'order' => array('Budget.monitoring_activity_id ASC'), 'fields' => array('Budget.*', 'MonitoringActivity.nombre', 'MonitoringActivity.tipo', 'Budget.cantidad', 'Budget.valor_unitario', 'Budget.mes1', 'Budget.mes2', 'Budget.mes3', 'Budget.mes4', 'Budget.mes5', 'Budget.mes6', 'Budget.observaciones_mes')));
        $this->set('Budgets', $Budgets);
    }

    public function index($follow_id) {
        $this->layout = "ajax";
        $this->set('follow_id', $follow_id);
        $this->loadModel('Follow');
        $this->set('cerrado', $this->Follow->field('cerrado', array('Follow.id' => $follow_id)));
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);
        $Budgets = $this->Budget->find('all', array('recursive' => 0, 'order' => array('Budget.monitoring_activity_id ASC'), 'conditions' => array('Budget.follow_id' => $follow_id)));
        $this->set('Budgets', $Budgets);
    }

    public function delete($budget_id, $follow_id) {

        if ($this->Budget->delete($budget_id)) {
            $this->loadModel("CommitteeBudget");
            App::import('model', 'CommitteeBudget');
            $CommitteeBudget = new CommitteeBudget();
            if ($CommitteeBudget->deleteAll(array('CommitteeBudget.budget_id' => $budget_id))) {
                $this->Session->setFlash('Registro Borrado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Budgets', 'action' => 'index', $follow_id));
            }
        }
    }

}

?>