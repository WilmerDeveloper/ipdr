<?php

Class VisitsController extends AppController {

    public $name = 'Visits';

    public function add($proyect_id) {
        $this->set('proyect_id', $proyect_id);
        if (!empty($this->data)) {
            if ($this->Visit->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {
        $this->Visit->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Visit->find('first', array('conditions' => array('Visit.id' => $id)));
        } else {

            if ($this->Visit->save($this->data)) {
                if (!empty($this->data['Visit']['archivo']['tmp_name'])) {

                    try {
                        $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . "InformesVisita/";

                        if (!is_dir($rutaArchivo)) {
                            if (!mkdir($rutaArchivo)) {
                                echo "error creando archivo";
                                //redirect
                            }
                        }

                        $nombreArchivo = "InformeVisita-$id.pdf";
                        $rutaArchivo.= "/" . $nombreArchivo;

                        if (move_uploaded_file($this->data['Visit']['archivo']['tmp_name'], $rutaArchivo)) {
                            $this->Session->setFlash('Se ha cargado el informe de visita', 'flash_custom');
                        } else {
                            $this->Session->setFlash('Error cargando el archivo.', 'flash_custom');
                        }
                    } catch (Exception $exc) {
                        echo $exc->getMessage();
                        $this->Session->setFlash('No se pudo adjuntar archivo', 'flash_custom');
                    }
                }


                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function index($proyect_id) {
        $this->set('proyect_id', $proyect_id);
        $this->paginate = array('Visit' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Visit.*')));
        $this->set('Visits', $this->paginate(array('Visit.proyect_id' => $proyect_id)));
    }

    public function delete($visita_id, $proyect_id) {
        if ($this->Visit->delete($visita_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Visits', 'action' => 'index', $proyect_id));
        } else {
            $this->Session->setFlash('Error eliminando registro, por favor intentelo nuevamente.', 'flash_custom');
        }
    }

    function beneficiary_index($visit_id, $follow_id) {

        $this->loadModel('Candidate');
        $this->loadModel('Follow');
        $this->loadModel('PlotPoll');
        $this->set('follow_id', $follow_id);
        $proyecto = $this->Follow->find('first', array('fields' => array('FinalEvaluation.proyect_id'), 'conditions' => array('Follow.id' => $follow_id)));
        $beneficiarios = $this->Candidate->find('all', array('conditions' => array('Candidate.proyect_id' => $proyecto['FinalEvaluation']['proyect_id'], 'Candidate.estado_filtro' => array(1, 5, 6), 'Candidate.candidate_id' => 0), 'fields' => array('Candidate.id')));

        foreach ($beneficiarios as $beneficiario) {

            if ($this->PlotPoll->find('first', array('recursive' => -1, 'fields' => array('PlotPoll.id'), 'conditions' => array('PlotPoll.candidate_id' => $beneficiario['Candidate']['id'])))) {
                
            } else {
                $this->PlotPoll->create();
                $data = array('PlotPoll' => array(
                        'visit_id' => $visit_id,
                        'candidate_id' => $beneficiario['Candidate']['id'],
                        'area_ha' => 0,
                        'area_m' => 0,
                        'user_id' => $this->Auth->user('id'),
                ));
                $this->PlotPoll->save($data);
            }
        }

        $this->paginate = array('Visit' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50, 'joins' => array(array('table' => 'plot_polls', 'alias' => 'PlotPoll', 'type' => 'left', 'conditions' => 'Visit.id=PlotPoll.visit_id'), array('table' => 'candidates', 'alias' => 'Candidate', 'type' => 'left', 'conditions' => 'Candidate.id=PlotPoll.candidate_id')), 'fields' => array('PlotPoll.id', 'PlotPoll.observaciones', 'Candidate.1er_nombre', 'Candidate.1er_apellido', 'Candidate.id', 'PlotPoll.fecha_ultima_visita'), 'order' => array('Candidate.1er_apellido' => 'ASC')));
        $this->set('PlotPolls', $this->paginate(array('PlotPoll.visit_id' => $visit_id)));
    }

}

?>