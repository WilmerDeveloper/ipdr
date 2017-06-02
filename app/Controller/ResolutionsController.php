<?php

Class ResolutionsController extends AppController {

    public $name = 'Resolutions';

    public function index() {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = "ajax";
        } else {
            $this->layout = "default";
        }
        $this->set("codigo", $this->Session->read('codigo'));
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);
        $publicado = 1;
        if ($proyect_id == "") {
            $this->Session->setFlash('No ha seleccionado Proyecto');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        } else {
            if ($publicado == 1) {
                $this->paginate = array('Resolution' => array('maxLimit' => 20, 'limit' => 20, 'fields' => array('Resolution.id', 'Resolution.fecha', 'Resolution.numero', 'Resolution.adjunto')));
                $this->set('Resolutions', $this->paginate(array('Resolution.proyect_id' => $proyect_id)));
            } else {
                $this->Session->setFlash('Este proyecto aún no ha sido publicado.', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        }
    }

    public function add($proyect_id) {
        $this->layout = "ajax";
        $this->set('proyect_id', $proyect_id);
        if (empty($this->data)) {

            $this->Resolution->Proyect->InitialEvaluation->recursive = -1;
            if ($evaluation = $this->Resolution->Proyect->InitialEvaluation->find('first', array('recursive' => -1, 'conditions' => array('InitialEvaluation.proyect_id' => $proyect_id), 'order' => array('InitialEvaluation.id DESC'), 'fields' => array('InitialEvaluation.id', 'InitialEvaluation.calificacion_integral')))) {
                if ($evaluation['InitialEvaluation']['calificacion_integral'] == "VIABLE") {

                    $this->set('evaluation_id', $evaluation['InitialEvaluation']['id']);
                    App::Import('model', 'Property');
                    App::Import('model', 'PropertyFinalReview');

                    $property = new Property();
                    $property->recursive = -1;
                    $predios = $property->find('all', array('conditions' => array('Property.proyect_id' => $proyect_id), 'fields' => array('Property.id')));

                    $cont = $this->Resolution->find('count', array('conditions' => array('Resolution.tipo' => 'ADJUDICACIÓN', 'Resolution.proyect_id' => $proyect_id)));
                    $this->set('cont', $cont);
                } else {
                    $this->Session->setFlash('Este proyecto no ha sido calificado como viable');
                    $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
                }
            } else {
                $this->Session->setFlash('No se ha realizado evaluación final a este proyecto');
                $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
            }
        } else {
            if ($this->Resolution->save($this->data)) {

                $this->Session->setFlash('Registro Adicionado correctamente');
                $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($resolution_id) {
        $this->layout = "ajax";
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('resolution_id', $resolution_id);
        $this->Resolution->recursive = -1;


        if (empty($this->data)) {
            $cont = $this->Resolution->find('count', array('conditions' => array('Resolution.tipo' => 'ADJUDICACIÓN', 'Resolution.proyect_id' => $proyect_id)));
            $this->set('cont', $cont);
            $this->data = $this->Resolution->find('first', array('conditions' => array('Resolution.id' => $resolution_id)));
        } else {

            if ($this->Resolution->saveAll($this->data)) {
                $codigo = $this->Resolution->Proyect->field('codigo', array('Proyect.id' => $proyect_id));
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $nombreArchivo = "SoporteResolucion-$codigo-$resolution_id.pdf";
                $rutaArchivo.= "/" . $nombreArchivo;
                if (move_uploaded_file($this->data['Resolution']['archivo']['tmp_name'], $rutaArchivo)) {
                    $this->Resolution->id = $this->data['Resolution']['id'];
                    $this->Resolution->saveField('adjunto', $nombreArchivo);
                    $this->Session->setFlash('Registro Adicionado correctamente con archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }


                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {
                $this->Session->setFlash('Error Guardando datos', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        }
    }

    function print_letter($resolution_id) {
        $this->layout = "pdf";
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);

        $options = array();
        $options['joins'] = array(
            array(
                'table' => 'proyects',
                'type' => 'left',
                'alias' => 'Proyect',
                'conditions' => array('Proyect.id=Resolution.proyect_id'),
            ),
            array(
                'table' => 'calls',
                'type' => 'left',
                'alias' => 'Call',
                'conditions' => array('Call.id=Proyect.call_id'),
            ),
            array(
                'table' => 'cities',
                'type' => 'left',
                'alias' => 'City',
                'conditions' => array('City.id=Proyect.city_id'),
            )
            ,
            array(
                'table' => 'branches',
                'type' => 'left',
                'alias' => 'Branch',
                'conditions' => array('Branch.departament_id=City.departament_id'),
            ),
            array(
                'table' => 'departaments',
                'type' => 'left',
                'alias' => 'Departament',
                'conditions' => array('City.departament_id=Departament.id'),
            )
        );
        $options['conditions'] = array('Resolution.id' => $resolution_id);
        $options['fields'] = array('Resolution.reviso', 'Departament.capital', 'Resolution.proyecto', 'Resolution.proyect_id', 'Departament.name', 'City.name', 'Branch.director', 'Proyect.codigo', 'Proyect.id', 'Resolution.id', 'Resolution.fecha', 'Resolution.numero', 'Resolution.initial_evaluation_id', 'Call.nombre', 'Branch.nombre');

        $this->Resolution->recursive = -1;
        $resolucion = $this->Resolution->find('first', $options);




        $this->Resolution->Proyect->Property->recursive = -1;
        $predios = $this->Resolution->Proyect->Property->find('all', array('conditions' => array('Property.proyect_id' => $resolucion['Proyect']['id'], 'Property.calificacion_visita' => 'Cumple'), 'fields' => array('Property.id', 'Property.matricula', 'Property.nombre', 'Property.oficina_registro', 'City.name', 'Departament.name', 'Property.area_total_m', 'Property.area_total_ha', 'Property.tipo_tenencia', 'Property.cedula_catastral', 'Property.oficina_registro'), 'joins' => array(array('table' => 'cities', 'type' => 'left', 'alias' => 'City', 'conditions' => array('Property.city_id=City.id')), array('table' => 'departaments', 'type' => 'left', 'alias' => 'Departament', 'conditions' => 'Departament.id=City.departament_id'))));
        $this->Resolution->Proyect->InitialEvaluation->recursive = -1;
        $evaluacion = $this->Resolution->Proyect->InitialEvaluation->find('first', array('conditions' => array('InitialEvaluation.proyect_id' => $resolucion['Resolution']['proyect_id']), 'fields' => array('InitialEvaluation.id', 'InitialEvaluation.calificacion_integral', 'InitialEvaluation.nombre_proyecto', 'InitialEvaluation.monto_solicitado', 'InitialEvaluation.valor_total'), 'order' => array('InitialEvaluation.id DESC')));
        $this->set('predios', $predios);
        $this->set('resolucion', $resolucion);
        $this->set('evaluacion', $evaluacion);
    }

    function comunication_letter($resolution_id) {
        $this->layout = 'pdf';

        $options = array();
        $options['joins'] = array(
            array(
                'table' => 'proyects',
                'type' => 'left',
                'alias' => 'Proyect',
                'conditions' => array('Proyect.id=Resolution.proyect_id'),
            ),
            array(
                'table' => 'calls',
                'type' => 'left',
                'alias' => 'Call',
                'conditions' => array('Call.id=Proyect.call_id'),
            ),
            array(
                'table' => 'branches',
                'type' => 'left',
                'alias' => 'Branch',
                'conditions' => array('Branch.id=Proyect.branch_id'),
            ),
            array(
                'table' => 'cities',
                'type' => 'left',
                'alias' => 'City',
                'conditions' => array('City.id=Proyect.city_id'),
            )
            ,
            array(
                'table' => 'departaments',
                'type' => 'left',
                'alias' => 'Departament',
                'conditions' => array('City.departament_id=Departament.id'),
            )
        );
        $options['conditions'] = array('Resolution.id' => $resolution_id);
        $options['fields'] = array('Departament.capital', 'Resolution.numero', 'Resolution.fecha', 'Resolution.final_evaluation_id', 'Departament.name', 'City.name', 'Branch.director', 'Branch.direccion', 'Proyect.codigo', 'Proyect.id', 'Resolution.id', 'Resolution.final_evaluation_id', 'Call.nombre', 'Branch.nombre', 'Branch.director');
        $this->Resolution->recursive = -1;
        $resolucion = $this->Resolution->find('first', $options);
        $evaluacion = $this->Resolution->Proyect->InitialEvaluation->find('first', array('conditions' => array('InitialEvaluation.id' => $resolucion['Resolution']['final_evaluation_id']), 'fields' => array('InitialEvaluation.id', 'InitialEvaluation.familias_habilitadas')));
        App::Import('model', 'Candidate');
        $Candidate = new Candidate();
        $Candidate->recursive = -1;
        $aspirantes = $Candidate->find('all', array('conditions' => array('Candidate.proyect_id' => $resolucion['Proyect']['id'], 'Candidate.jerarquia !=' => 0, 'Candidate.estado_filtro' => array(1, 5), 'Candidate.renuncio' => 0), 'fields' => array('Candidate.id', 'Candidate.tipo_ident', 'Candidate.nro_ident', 'Candidate.1er_apellido', 'Candidate.2do_apellido', 'Candidate.1er_nombre', 'Candidate.2do_nombre', 'Candidate.jerarquia', 'Candidate.telefono', 'Candidate.direccion'), 'order' => array('Candidate.jerarquia ASC')));

        $this->set('resolucion', $resolucion);
        $this->set('aspirantes', $aspirantes);
        $this->set('evaluacion', $evaluacion);
    }
    
        public function delete($id) {
        $this->layout = "ajax";
        if ($this->Resolution->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Resolutions', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error Eliminando datos');
        }
    }

}

?>
