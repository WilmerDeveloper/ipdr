<?php

Class CandidatesController extends AppController {

    public $name = 'Candidates';

    function add($poll_id) {
        $this->layout = "ajax";
        $this->set('poll_id',$poll_id);  

        if (empty($this->data)) {
            
        } else {

            if ($this->Candidate->save($this->data)) {
                $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Candidates', 'action' => 'index', $poll_id));
            } else {
                $this->Session->setFlash('Error guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        
        $this->Candidate->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Candidate->find('first', array('conditions' => array('Candidate.id' => $id)));
        } else {

            if ($this->Candidate->saveAll($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Candidates', 'action' => 'index', $this->data['Candidate']['family_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($poll_id) {
        $this->layout = "ajax";
        $this->Candidate->recursive = -1;


        $this->set('poll_id', $poll_id);

        $this->paginate = array(
            'Candidate' => array(
                'maxLimit' => 500,
                'limit' => 50,
                'fields' => array('Proyect.codigo','Property.nombre', 'Candidate.primer_nombre', 'Candidate.primer_apellido', 'Candidate.id'),
                'joins' => array(array('type'=>'left', 'table' => 'family_polls', 'alias' => 'FamilyPoll', 'conditions' => 'FamilyPoll.id=Candidate.family_poll_id'),array('type'=>'left', 'table' => 'properties', 'alias' => 'Property', 'conditions' => 'FamilyPoll.property_id=Property.id'), array('type'=>'left','table' => 'proyects', 'alias' => 'Proyect', 'conditions' => 'Proyect.id=Property.proyect_id'))

            ),
        );
        $this->set('Candidates', $this->paginate(array('Candidate.family_poll_id' => $poll_id)));
    }

    function select($candidate_id) {
        $this->layout = "ajax";
        $this->Session->write('candidate_id', $candidate_id);
        $this->set('aspirante', $this->Candidate->find('first', array('conditions' => array('Candidate.id' => $candidate_id), 'fields' => array('Candidate.primer_nombre'))));

        $this->Session->setFlash('El Aspirante ha sido seleccionado', 'flash_custom');
    }

    function delete($candidate_id, $property_id) {
        $this->layout = "ajax";
        if ($this->Candidate->delete($candidate_id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Candidates', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }

}

?>
