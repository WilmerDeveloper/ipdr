<?php

Class CommitteeBudgetsController extends AppController {

    public $name = 'CommitteeBudgets';

    public function edit($id) {
        $this->CommitteeBudget->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->CommitteeBudget->find('first', array('conditions' => array('CommitteeBudget.id' => $id)));
             foreach ($this->data['CommitteeBudget'] as $key => $value) {
                $this->request->data['CommitteeBudget'][$key]=  str_replace(".0000", '',$value);
               
            }
            
        } else {
            $rubro = $this->CommitteeBudget->Budget->find('first', array('recursive' => -1, 'conditions' => array('Budget.id' => $this->data['CommitteeBudget']['budget_id']), 'fields' => array('Budget.cantidad', 'Budget.valor_unitario', 'Budget.follow_id', 'Budget.monitoring_activity_id')));
            $comites = $this->CommitteeBudget->find('all', array('recursive' => 0, 'conditions' => array('Budget.follow_id' => $rubro['Budget']['follow_id'], 'CommitteeBudget.id !=' => $this->data['CommitteeBudget']['id']), 'fields' => array('CommitteeBudget.budget_id', 'CommitteeBudget.valor')));
            $suma = 0;
            foreach ($comites as $comite) {

                $rubreoRelacionado = $this->CommitteeBudget->Budget->find('first', array('conditions' => array('Budget.id' => $comite['CommitteeBudget']['budget_id']), 'fields' => array('Budget.cantidad', 'Budget.valor_unitario', 'Budget.follow_id', 'Budget.monitoring_activity_id')));
                if ($rubro['Budget']['monitoring_activity_id'] == $rubreoRelacionado['Budget']['monitoring_activity_id']) {
                    $suma+=$comite['CommitteeBudget']['valor'];
                }
            }
            $valorTotal = $rubro['Budget']['cantidad'] * $rubro['Budget']['valor_unitario'];
            $suma = ($suma + ($this->data['CommitteeBudget']['valor']));
            if ($valorTotal >= $suma) {
                if ($this->CommitteeBudget->save($this->data)) {
                    $proyect_id = $this->Session->read('proyect_id');
                    App::import('model', 'Proyect');
                    $Proyect = new Proyect();
                    $codigo = $Proyect->field('codigo', array('Proyect.id' => $proyect_id));
                    $rutaArchivo = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                    if (!is_dir($rutaArchivo)) {
                        if (!mkdir($rutaArchivo)) {
                            echo "error creando archivo";
                            //redirect
                        }
                    }

                    $ext = explode(".", $this->data['CommitteeBudget']['archivo']['name']);

                    $conteo = count($ext);
                    $nombreArchivo = "Comitee-$id." . $ext[$conteo - 1];
                    $rutaArchivo.= "/" . $nombreArchivo;
                    if (!empty($this->data['CommitteeBudget']['archivo']['tmp_name'])) {
                        if (move_uploaded_file($this->data['CommitteeBudget']['archivo']['tmp_name'], $rutaArchivo)) {
                            $this->CommitteeBudget->id = $id;
                            $this->CommitteeBudget->saveField('adjunto', $nombreArchivo);
                        } else {
                            $this->Session->setFlash('Error cargando el archivo, supera el tamaño máximo permitido.', 'flash_custom');
                            $this->redirect(array('controller' => 'CommitteeBudgets', 'action' => 'index', $this->data['CommitteeBudget']['committee_id']));
                        }
                    }

                    $this->Session->setFlash('Registro editado correctamente. Valor total ingresado' . $valorTotal . "<br> Sumatoria hasta este comité: $suma", 'flash_custom');
                    $this->redirect(array('controller' => 'CommitteeBudgets', 'action' => 'index', $this->data['CommitteeBudget']['committee_id']));
                } else {
                    $this->Session->setFlash('Error editando datos');
                }
            } else {
                $this->Session->setFlash('La suma de los valores de este rubro en los comites ' . $suma . ' es mayor a la del plan ' . $valorTotal, 'flash_custom');
                $this->redirect(array('controller' => 'CommitteeBudgets', 'action' => 'index', $this->data['CommitteeBudget']['committee_id']));
            }
        }
    }

    function index($committee_id) {
        $this->set('committee_id', $committee_id);
        $proyect_id = $this->Session->read('proyect_id');
        App::import('model', 'Proyect');
        $Proyect = new Proyect();
        $codigo = $Proyect->field('codigo', array('Proyect.id' => $proyect_id));
        $this->set('proyect_id', $proyect_id);
        $this->set('codigo', $codigo);

        $this->CommitteeBudget->Committee->recursive = -1;
        $comite = $this->CommitteeBudget->Committee->find('first', array('conditions' => array('Committee.id' => $committee_id)));
        $follow_id = $comite['Committee']['follow_id'];
        $this->set('fecha_comite', $comite['Committee']['fecha']);
        $this->set('follow_id', $follow_id);
        $rubros = $this->CommitteeBudget->Budget->find('all', array('conditions' => array('Budget.follow_id' => $follow_id), 'recursive' => -1, 'fields' => array('Budget.id')));
        foreach ($rubros as $rubro) {
            $conteo = $this->CommitteeBudget->find('count', array('recursive' => -1, 'conditions' => array('CommitteeBudget.budget_id' => $rubro['Budget']['id'], 'CommitteeBudget.committee_id' => $committee_id)));
            if ($conteo == 0) {
                $datos = array(
                    'CommitteeBudget' => array(
                        'budget_id' => $rubro['Budget']['id'],
                        'committee_id' => $committee_id,
                        'valor' => 0
                    )
                );

                $this->CommitteeBudget->create();
                $this->CommitteeBudget->save($datos);
            }
        }
        $this->paginate = array('CommitteeBudget' => array(
                'maxLimit' => 500,
                'limit' => 50,
                'recursive' => -1,
                'fields' => array('MonitoringActivity.nombre', 'CommitteeBudget.valor', 'CommitteeBudget.adjunto', 'CommitteeBudget.observacion', 'CommitteeBudget.id'),
                'joins' => array(
                    array('table' => 'budgets', 'alias' => 'Budget', 'type' => 'left', 'conditions' => array('Budget.id=CommitteeBudget.budget_id')),
                    array('table' => 'monitoring_activities', 'alias' => 'MonitoringActivity', 'type' => 'left', 'conditions' => array('Budget.monitoring_activity_id=MonitoringActivity.id')),
                )
                ));
        $this->set('CommitteeBudgets', $this->paginate(array('CommitteeBudget.committee_id' => $committee_id)));
    }
    
    function delete($id,$committee_id) {
        if($this->CommitteeBudget->delete($id)){
             $this->Session->setFlash('Registro eliminado','flash_custom');
            $this->redirect(array('controller' => 'CommitteeBudgets', 'action' => 'index', $committee_id));
            
        } 
    }

}

?>