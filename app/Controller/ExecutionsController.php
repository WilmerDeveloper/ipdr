<?php

Class ExecutionsController extends AppController {

    public $name = 'Executions';

    public function edit($execution_id, $follow_id) {
        $this->layout = "ajax";

        $this->set('follow_id', $follow_id);
        $this->Execution->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Execution->find('first', array('conditions' => array('Execution.id' => $execution_id)));
            $this->request->data['Execution']['acumulado'] = str_replace(".0000", "", $this->data['Execution']['acumulado']);
        } else {
            if ($this->data['Execution']['acumulado'] >= $this->data['Execution']['ejecutado']) {
                if ($this->Execution->save($this->data)) {
                    $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'Executions', 'action' => 'index', $follow_id, $this->data['Execution']['visit_id']));
                } else {
                    $this->Session->setFlash('Error editando datos', 'flash_custom');
                    $this->redirect(array('controller' => 'Executions', 'action' => 'index', $follow_id, $this->data['Execution']['visit_id']));
                }
            } else {
                $this->Session->setFlash('El valor ejecutado es mayor al valor acumulado', 'flash_custom');
                $this->redirect(array('controller' => 'Executions', 'action' => 'index', $follow_id, $this->data['Execution']['visit_id']));
            }
        }
    }

    public function index($follow_id, $visit_id) {
        $this->layout = "ajax";
        $this->Execution->recursive = -1;
        $this->set('follow_id', $follow_id);
        $this->loadModel('CommitteeBudget');
        $budgets = $this->CommitteeBudget->find('all', array(
            'recursive' => -1,
            'fields' => array('MonitoringActivity.nombre', 'Budget.id', 'CommitteeBudget.valor'),
            'conditions' => array('Budget.follow_id' => $follow_id),
            'order' => array('Budget.id' => 'DESC'),
            'joins' => array(
                array('table' => 'budgets', 'alias' => 'Budget', 'type' => 'left', 'conditions' => 'Budget.id=CommitteeBudget.budget_id'),
                //array('table'=>'committees','alias'=>'Committe','type'=>'left','conditions'=>'Committe.id=CommitteeBudget.committee_id'),
                array('table' => 'monitoring_activities', 'alias' => 'MonitoringActivity', 'type' => 'left', 'conditions' => 'MonitoringActivity.id=Budget.monitoring_activity_id'),
            )
                ));


        $current = 0;
        foreach ($budgets as $budget) {


            if ($res = $this->Execution->find('first', array('conditions' => array('Execution.visit_id' => $visit_id, 'Execution.budget_id' => $budget['Budget']['id'])))) {
                
            } else {

                $this->CommitteeBudget->virtualFields = array('suma' => 'SUM(CommitteeBudget.valor)');
                $sumatoria = $this->CommitteeBudget->find('first', array('recursive' => 0, 'fields' => array('CommitteeBudget.suma'), 'conditions' => array('CommitteeBudget.budget_id' => $budget['Budget']['id'], 'Budget.follow_id' => $follow_id)));
                $this->Execution->create();
                $datos = array('Execution' => array(
                        'visit_id' => $visit_id,
                        'budget_id' => $budget['Budget']['id'],
                        'acumulado' => $sumatoria['CommitteeBudget']['suma'],
                        'ejecutado' => 0,
                        'modificado' => date("Y/m/d"),
                        ));
                $this->Execution->save($datos);
            }
        }

        $Executions = $this->Execution->find('all', array(
            'recursive' => -1,
            'fields' => array('MonitoringActivity.nombre', 'Budget.id', 'Execution.ejecutado', 'Execution.acumulado', 'Execution.id', 'Execution.modificado'),
            'conditions' => array('Execution.visit_id' => $visit_id),
            'order' => array('Budget.id' => 'DESC'),
            'joins' => array(
                array('table' => 'budgets', 'alias' => 'Budget', 'type' => 'left', 'conditions' => 'Budget.id=Execution.budget_id'),
                //array('table'=>'committees','alias'=>'Committe','type'=>'left','conditions'=>'Committe.id=CommitteeBudget.committee_id'),
                array('table' => 'monitoring_activities', 'alias' => 'MonitoringActivity', 'type' => 'left', 'conditions' => 'MonitoringActivity.id=Budget.monitoring_activity_id'),
            )
                ));


        $this->set('Executions', $Executions);
    }

    public function delete($asset_id, $visit_id) {
        $this->layout = "ajax";
        if ($this->Execution->delete($asset_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Executions', 'action' => 'index', $visit_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

}

?>