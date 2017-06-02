<?php

class BeneficiariesController extends AppController {

    var $name = 'Beneficiaries';

    public function index($property_id) {
        if (!$this->RequestHandler->isAjax()) {
            $this->layout = "default";
        } else {
            $this->layout = "ajax";
        }
        $this->loadModel('Property');
        $call_id = $this->Property->field('call_id', array('Property.id' => $property_id));
        $this->set("call_id", $call_id);
        $this->Beneficiary->recursive = -1;
        $this->paginate = array(
            'Beneficiary' => array(
                'maxLimit' => 500,
                'limit' => 50,
                'recursive' => 1,
                'fields' => array('Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo', 'Beneficiary.archivo_cedula', 'Beneficiary.archivo_policia', 'Beneficiary.archivo_contraloria', 'Beneficiary.archivo_procuraduria', 'Beneficiary.archivo_sisben')
                ));
        $this->set("beneficiaries", $this->paginate(array('Beneficiary.property_id' => $property_id, 'Beneficiary.beneficiary_id' => 0)));
        $this->set('predio', $this->Beneficiary->Property->find('first', array('recursive' => -1, 'conditions' => array('Property.id' => $property_id), 'fields' => array('Property.nombre'))));
        $this->set('property_id', $property_id);
    }

    public function review_index($property_id) {
        $this->layout = "ajax";
        $this->Beneficiary->recursive = -1;
        $this->loadModel('Property');
        $call_id = $this->Property->field('call_id', array('Property.id' => $property_id));
        $this->set("call_id", $call_id);
        $ben = $this->Beneficiary->find('all', array('conditions' => array('Beneficiary.property_id' => $property_id, 'Beneficiary.beneficiary_id' => 0), 'fields' => array('Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo', 'Beneficiary.archivo_cedula', 'Beneficiary.archivo_policia', 'Beneficiary.archivo_contraloria', 'Beneficiary.archivo_procuraduria', 'Beneficiary.property_id', 'Beneficiary.archivo_sisben')));
        $this->set("beneficiarios", $ben);
        $this->set('property_id', $property_id);
    }

    public function phase1_index($property_id) {

        $this->Beneficiary->recursive = -1;
        $this->set('group_id', $this->Auth->user('group_id'));
        $ben = $this->Beneficiary->find('all', array('conditions' => array('Beneficiary.property_id' => $property_id, 'Beneficiary.beneficiary_id' => 0), 'fields' => array('Beneficiary.id', 'Beneficiary.archivo_cedula', 'Beneficiary.archivo_policia', 'Beneficiary.archivo_contraloria', 'Beneficiary.archivo_procuraduria', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo', 'Beneficiary.calificacion_visita', 'Beneficiary.concepto_visita', 'Beneficiary.property_id')));
        $this->set("beneficiarios", $ben);
        $this->set('property_id', $property_id);
    }

    public function add($property_id, $beneficiary_id, $redirect) {


        $this->layout = "ajax";

        $this->set('beneficiary_id', $beneficiary_id);
        $this->set('redirect', $redirect);
        $this->set('property_id', $property_id);

        if (!empty($this->data)) {

            if ($this->Beneficiary->saveAll($this->data)) {

                $last_id = $this->Beneficiary->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Predio-" . $property_id;
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Predio-" . $property_id . DS . "Documentos verificacion";

                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $exito = 1;


                if (!empty($this->data['Beneficiary']['cedula']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Cedula-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['cedula']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_cedula' => $nombrearchivo
                                ));
                        $this->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando cedula', 'flash_custom');
                    }
                }

                if (!empty($this->data['Beneficiary']['policia']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Policia-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['policia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_policia' => $nombrearchivo
                                ));
                        $this->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando policia', 'flash_custom');
                    }
                }

                if (!empty($this->data['Beneficiary']['contraloria']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Contraloria-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['contraloria']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_contraloria' => $nombrearchivo
                                ));
                        $this->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando contraloria', 'flash_custom');
                    }
                }

                if (!empty($this->data['Beneficiary']['procuraduria']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Procuraduria-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['procuraduria']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_procuraduria' => $nombrearchivo
                                ));
                        $this->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando contraloria', 'flash_custom');
                    }
                }

                if (!empty($this->data['Beneficiary']['sisben']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Sisben-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['sisben']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_sisben' => $nombrearchivo
                                ));
                        $this->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando sisben', 'flash_custom');
                    }
                }

                if ($exito == 1) {
                    $this->Session->setFlash('Beneficiario guardado correctamente', 'flash_custom');
                    if ($beneficiary_id == 0 and $redirect == 0) {
                        $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'index', $property_id));
                    } elseif ($beneficiary_id != 0 and $redirect == 0) {



                        $this->redirect(array('controller' => 'Families', 'action' => 'index', $beneficiary_id, $property_id));
                    } else {
                        $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'phase_1index', $property_id));
                    }
                } else {
                    $this->Session->setFlash('Error guardando el archivo por favor intentelo nuevamente', 'flash_custom');
                }
            } else {
                $this->Session->setFlash('error guardando datos');
            }
        }
    }

    public function edit($id, $beneficiary_id, $redirect) {
        $this->set('beneficiary_id', $beneficiary_id);
        $this->set('redirect', $redirect);
        $this->loadModel('Property');
        $property_id = $this->Beneficiary->field('Beneficiary.property_id', array('Beneficiary.id' => $id));
        $proyect_id = $this->Property->field('Property.proyect_id', array('Property.id' => $property_id));
        if ($proyect_id != 0) {
            $predios = $this->Beneficiary->Property->find('list', array('conditions' => array('Property.proyect_id' => $proyect_id), 'fields' => array('Property.id', 'Property.nombre')));
        } else {
            $predios = array();
        }
        $this->set('properties', $predios);
        $this->layout = "ajax";
        $this->Beneficiary->virtualFields = array(
            'name' => "Beneficiary.nombres+' '+Beneficiary.primer_apellido"
        );
        $this->Beneficiary->recursive = -1;

        if (empty($this->data)) {
            $this->data = $this->Beneficiary->find("first", array("conditions" => array("Beneficiary.id" => $id)));
            $this->set('beneficiaries', $this->Beneficiary->find('list', array('fields' => array('Beneficiary.id', 'Beneficiary.name'), 'conditions' => array('Beneficiary.property_id' => $this->data['Beneficiary']['property_id'], 'Beneficiary.beneficiary_id' => 0))));
        } else {

            $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Predio-" . $this->data['Beneficiary']['property_id'];
            if (!is_dir($rutaArchivo)) {
                if (!mkdir($rutaArchivo)) {
                    echo "error creando archivo";
                    //redirect
                }
            }
            $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Predio-" . $this->data['Beneficiary']['property_id'] . DS . "Documentos verificacion";

            if (!is_dir($rutaArchivo)) {
                if (!mkdir($rutaArchivo)) {
                    echo "error creando archivo";
                    //redirect
                }
            }


            if (empty($this->data['Beneficiary']['beneficiary_id'])) {
                $this->request->data['Beneficiary']['beneficiary_id'] = 0;
            }

            if ($this->Beneficiary->save($this->data)) {


                $exito = 1;
                $last_id = $this->data['Beneficiary']['id'];
                $property_id = $this->data['Beneficiary']['property_id'];

                if (!empty($this->data['Beneficiary']['cedula']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Cedula-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['cedula']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_cedula' => $nombrearchivo
                                ));
                        $this->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando cedula', 'flash_custom');
                    }
                }



                if (!empty($this->data['Beneficiary']['policia']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Policia-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['policia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_policia' => $nombrearchivo
                                ));
                        $this->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando policia', 'flash_custom');
                    }
                }

                if (!empty($this->data['Beneficiary']['contraloria']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Contraloria-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['contraloria']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {

                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_contraloria' => $nombrearchivo
                                ));
                        $this->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando contraloria', 'flash_custom');
                    }
                }

                if (!empty($this->data['Beneficiary']['procuraduria']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Procuraduria-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['procuraduria']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {

                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_procuraduria' => $nombrearchivo
                                ));
                        $this->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando contraloria', 'flash_custom');
                    }
                }

                if (!empty($this->data['Beneficiary']['sisben']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Sisben-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['sisben']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_sisben' => $nombrearchivo
                                ));
                        $this->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando sisben', 'flash_custom');
                    }
                }

                $this->Session->setFlash('Beneficiario guardado correctamente', 'flash_custom');
                if ($exito == 1) {


                    $this->Session->setFlash('Beneficiario guardado correctamente', 'flash_custom');
                    if ($beneficiary_id == 0 and $redirect == 0) {
                        $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'index', $this->data['Beneficiary']['property_id']));
                    } elseif ($beneficiary_id != 0 and $redirect == 0) {
                        $this->redirect(array('controller' => 'Families', 'action' => 'index', $beneficiary_id, $this->data['Beneficiary']['property_id']));
                    } elseif ($redirect == 1) {
                        $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'phase1_index', $this->data['Beneficiary']['property_id']));
                    } elseif ($redirect == 2) {
                        $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'total_index'));
                    }
                } else {
                    
                }
            } else {
                $this->Session->setFlash('Error guardando datos');
            }
        }
    }

    public function delete($beneficiary_id, $property_id, $redirect) {
        $this->Beneficiary->BeneficiaryRequirement->deleteAll(array('BeneficiaryRequirement.beneficiary_id' => $beneficiary_id));
        if ($this->Beneficiary->delete($beneficiary_id)) {
            $this->Beneficiary->BeneficiaryRequirement->deleteAll(array('BeneficiaryRequirement.beneficiary_id' => $beneficiary_id));

            if ($conyuge = $this->Beneficiary->find('first', array('recursive' => -1, 'conditions' => array('Beneficiary.beneficiary_id' => $beneficiary_id), 'fields' => array('Beneficiary.id')))) {
                if ($this->Beneficiary->delete($conyuge['Beneficiary']['id'])) {
                    $this->Beneficiary->BeneficiaryRequirement->deleteAll(array('BeneficiaryRequirement.beneficiary_id' => $conyuge['Beneficiary']['id']));
                    $this->Session->setFlash('Beneficiario y conyuge borrado correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'index', $property_id));
                }
            } else {
                $this->Session->setFlash('Beneficiario  borrado correctamente', 'flash_custom');
                if ($redirect == 0)
                    $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'index', $property_id));
                if ($redirect == 1)
                    $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'total_index'));
            }
        }
    }

    public function acceptance_letters($property_id) {
        $this->Beneficiary->recursive = -1;
        $this->layout = "pdf";

        $this->set("beneficiarios", $this->Beneficiary->find('all', array(
                    'conditions' => array('Beneficiary.calificacion_visita' => 'Cumple', 'Beneficiary.property_id' => $property_id),
                    'joins' => array(array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Property.id=Beneficiary.property_id')), array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Property.city_id')), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')), array('table' => 'branches', 'alias' => 'Branch', 'type' => 'left', 'conditions' => array('Branch.departament_id=Departament.id'))),
                    'fields' => array('Branch.director', 'Property.nombre', 'City.name', 'Departament.name', 'Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo_identificacion')
                )));
        $this->set('predio', $this->Beneficiary->Property->find('first', array('recursive' => -1, 'conditions' => array('Property.id' => $property_id), 'fields' => array('Property.nombre'))));
        $this->set('property_id', $property_id);
    }

    public function representative_letter($evaluation_id) {
        $this->Beneficiary->recursive = -1;
        $this->layout = "pdf";

        App::Import('model', 'InitialEvaluation');

        $InitialEvaluation = new InitialEvaluation();

        $evaluacion = $InitialEvaluation->find('first', array(
            'conditions' => array('InitialEvaluation.id' => $evaluation_id),
            'recursive' => -1,
            'fields' => array('InitialEvaluation.nombre_proyecto', 'Proyect.id', 'InitialEvaluation.proyect_id', 'Proyect.codigo', 'City.name', 'Departament.name', 'InitialEvaluation.nombre_aliado', 'InitialEvaluation.beneficiarios', 'Branch.nombre', 'Branch.director'),
            'joins' => array(
                array('table' => 'proyects', 'type' => 'left', 'alias' => 'Proyect', 'conditions' => array('Proyect.id=InitialEvaluation.proyect_id')),
                array('table' => 'cities', 'type' => 'left', 'alias' => 'City', 'conditions' => array('City.id=Proyect.city_id')),
                array('table' => 'departaments', 'type' => 'left', 'alias' => 'Departament', 'conditions' => array('Departament.id=City.departament_id')),
                array('table' => 'branches', 'alias' => 'Branch', 'type' => 'left', 'conditions' => array('Branch.departament_id=Departament.id')),
            )
                ));
        $this->set('evaluacion', $evaluacion);
        $this->set("beneficiarios", $this->Beneficiary->find('all', array(
                    'conditions' => array('Beneficiary.calificacion_visita' => 'Cumple', 'Beneficiary.es_representante' => 'Si', 'Property.proyect_id' => $evaluacion['Proyect']['id']),
                    'joins' => array(
                        array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Property.id=Beneficiary.property_id')),
                    ),
                    'fields' => array('Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo_identificacion')
                )));
        $this->set('predios', $this->Beneficiary->Property->find('all', array('recursive' => -1, 'conditions' => array('Property.proyect_id' => $evaluacion['Proyect']['id']), 'fields' => array('Property.nombre'))));
    }

    public function visit($beneficiary_id) {

        $this->set('call_id', $this->Session->read('call_id'));
        if (empty($this->data)) {
            $this->data = $this->Beneficiary->find("first", array("conditions" => array("Beneficiary.id" => $beneficiary_id)));
        } else {
            if ($this->Beneficiary->save($this->data)) {
                $this->Session->setFlash('Beneficiario editado  correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'total_index', $this->data['Beneficiary']['property_id']));
            }
        }
    }

    public function view($beneficiary_id) {
        $this->layout = "ajax";
        $this->set('beneficiary', $this->Beneficiary->find('first', array('conditions' => array('Beneficiary.id' => $beneficiary_id))));
    }

    public function poll_index() {
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {
            if (empty($this->data) or $this->data['Beneficiary']['busqueda'] == "") {
                $this->set("beneficiarios", $this->Beneficiary->find('all', array(
                            'conditions' => array('Beneficiary.calificacion_visita' => 'Cumple', 'Beneficiary.beneficiary_id' => 0, 'Property.proyect_id' => $proyect_id),
                            'joins' => array(
                                array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Property.id=Beneficiary.property_id')),
                            ),
                            'recursive' => -1,
                            'fields' => array('Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo_identificacion', 'Property.nombre')
                        )));
            } else {

                $this->set("beneficiarios", $this->Beneficiary->find('all', array(
                            'conditions' => array('Beneficiary.calificacion_visita' => 'Cumple', 'Beneficiary.beneficiary_id' => 0, 'Property.proyect_id' => $proyect_id, 'or' => array('Beneficiary.nombres LIKE' => '%' . $this->data['Beneficiary']['busqueda'] . '%', 'Beneficiary.numero_identificacion LIKE' => '%' . $this->data['Beneficiary']['busqueda'] . '%', 'Beneficiary.primer_apellido LIKE' => '%' . $this->data['Beneficiary']['busqueda'] . '%')),
                            'joins' => array(
                                array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Property.id=Beneficiary.property_id')),
                            ),
                            'recursive' => -1,
                            'fields' => array('Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo_identificacion', 'Property.nombre')
                        )));
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

    public function baseline_index($property_id) {

        $this->set('property_id', $property_id);
        if (empty($this->data) or $this->data['Beneficiary']['busqueda'] == "") {
            $this->set("beneficiarios", $this->Beneficiary->find('all', array(
                        'conditions' => array('Beneficiary.beneficiary_id' => 0, 'Property.id' => $property_id),
                        'joins' => array(
                            array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Property.id=Beneficiary.property_id')),
                        ),
                        'recursive' => -1,
                        'fields' => array('Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo_identificacion', 'Property.nombre')
                    )));
        } else {

            $this->set("beneficiarios", $this->Beneficiary->find('all', array(
                        'conditions' => array('Beneficiary.beneficiary_id' => 0, 'Property.id' => $property_id, 'or' => array('Beneficiary.nombres LIKE' => '%' . $this->data['Beneficiary']['busqueda'] . '%', 'Beneficiary.numero_identificacion LIKE' => '%' . $this->data['Beneficiary']['busqueda'] . '%', 'Beneficiary.primer_apellido LIKE' => '%' . $this->data['Beneficiary']['busqueda'] . '%')),
                        'joins' => array(
                            array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Property.id=Beneficiary.property_id')),
                        ),
                        'recursive' => -1,
                        'fields' => array('Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo_identificacion', 'Property.nombre')
                    )));
        }
    }

    public function edit_poll($beneficiary_id) {
        $this->layout = "ajax";

        $this->Beneficiary->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Beneficiary->find('first', array('conditions' => array('Beneficiary.id' => $beneficiary_id)));
        } else {

            if ($this->Beneficiary->saveAll($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'poll_index'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function social_index($beneficiary_id) {
        $this->Beneficiary->recursive = -1;
        $this->set('beneficiario', $this->Beneficiary->find('first', array('conditions' => array('Beneficiary.id' => $beneficiary_id))));
    }

    public function social_edit($beneficiary_id) {
        $this->layout = "ajax";

        $this->Beneficiary->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Beneficiary->find('first', array('conditions' => array('Beneficiary.id' => $beneficiary_id)));
        } else {

            if ($this->Beneficiary->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'social_index', $beneficiary_id));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function generalidades($beneficiary_id) {
        $this->Beneficiary->recursive = -1;
        $this->set('beneficiario', $this->Beneficiary->find('first', array('conditions' => array('Beneficiary.id' => $beneficiary_id))));
    }

    public function edit_generalidades($beneficiary_id) {
        $this->layout = "ajax";

        $this->Beneficiary->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Beneficiary->find('first', array('conditions' => array('Beneficiary.id' => $beneficiary_id)));
        } else {

            if ($this->Beneficiary->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'generalidades', $beneficiary_id));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function add_conyuge($beneficiary_id) {
        $this->set('beneficiary_id', $beneficiary_id);
        if (!empty($this->data)) {

            if ($this->Beneficiary->save($this->data)) {

                $this->Session->setFlash('Beneficiario guardado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Families', 'action' => 'poll_index', $beneficiary_id));
            }
        }
    }

    public function total_index() {
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {
            if (empty($this->data) or $this->data['Beneficiary']['busqueda'] == "") {
                $this->set("beneficiarios", $this->Beneficiary->find('all', array(
                            'conditions' => array('Property.proyect_id' => $proyect_id),
                            'joins' => array(
                                array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Property.id=Beneficiary.property_id')),
                            ),
                            'recursive' => -1,
                            'fields' => array('Beneficiary.id', 'Beneficiary.concepto_visita', 'Beneficiary.calificacion_visita', 'Beneficiary.property_id', 'Beneficiary.beneficiary_id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo_identificacion', 'Property.nombre', 'Beneficiary.property_id', 'Beneficiary.archivo_contraloria', 'Beneficiary.archivo_policia', 'Beneficiary.archivo_cedula', 'Beneficiary.archivo_procuraduria', 'Beneficiary.archivo_sisben')
                        )));
            } else {

                $this->set("beneficiarios", $this->Beneficiary->find('all', array(
                            'conditions' => array('Property.proyect_id' => $proyect_id, 'or' => array('Beneficiary.nombres LIKE' => '%' . $this->data['Beneficiary']['busqueda'] . '%', 'Beneficiary.numero_identificacion LIKE' => '%' . $this->data['Beneficiary']['busqueda'] . '%', 'Beneficiary.primer_apellido LIKE' => '%' . $this->data['Beneficiary']['busqueda'] . '%')),
                            'joins' => array(
                                array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Property.id=Beneficiary.property_id')),
                            ),
                            'recursive' => -1,
                            'fields' => array('Beneficiary.id', 'Beneficiary.concepto_visita', 'Beneficiary.calificacion_visita', 'Beneficiary.property_id', 'Beneficiary.beneficiary_id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo_identificacion', 'Property.nombre', 'Beneficiary.property_id', 'Beneficiary.archivo_contraloria', 'Beneficiary.archivo_policia', 'Beneficiary.archivo_cedula', 'Beneficiary.archivo_procuraduria', 'Beneficiary.archivo_sisben')
                        )));
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

    public function follow_edit($id) {
        if (empty($this->data)) {
            $this->data = $this->Beneficiary->find('first', array('recursive' => -1, 'conditions' => array('Beneficiary.id' => $id), 'fields' => array('Beneficiary.id', 'Beneficiary.tipo_identificacion', 'Beneficiary.numero_identificacion', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.telefono', 'Beneficiary.direccion', 'Beneficiary.celular', 'Beneficiary.email', 'Beneficiary.id', 'Beneficiary.habitante')));
        } else {

            if ($this->Beneficiary->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Beneficiaries', 'action' => 'plot_index', $id));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function plot_index($beneficiary_id) {
        $this->set('beneficiary_id', $beneficiary_id);
        $this->paginate = array('Beneficiary' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Beneficiary.tipo_identificacion', 'Beneficiary.numero_identificacion', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.telefono', 'Beneficiary.direccion', 'Beneficiary.celular', 'Beneficiary.email', 'Beneficiary.habitante', 'Beneficiary.id')));
        $this->set('Beneficiaries', $this->paginate(array('or' => array('Beneficiary.beneficiary_id' => $beneficiary_id, 'Beneficiary.id' => $beneficiary_id))));
    }

    public function follow_index() {
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {
            if (empty($this->request->data)) {
                $this->set("beneficiarios", $this->Beneficiary->find('all', array(
                            'conditions' => array('Property.proyect_id' => $proyect_id, 'Beneficiary.calificacion_visita' => 'Cumple', 'Beneficiary.beneficiary_id' => 0),
                            'joins' => array(
                                array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Property.id=Beneficiary.property_id')),
                            ),
                            'recursive' => -1,
                            'fields' => array('Beneficiary.id', 'Beneficiary.concepto_visita', 'Beneficiary.calificacion_visita', 'Beneficiary.beneficiary_id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo_identificacion', 'Property.nombre', 'Beneficiary.property_id', 'Beneficiary.archivo_contraloria', 'Beneficiary.archivo_policia', 'Beneficiary.archivo_cedula', 'Beneficiary.archivo_procuraduria')
                        )));
            } else {
                if (!isset($this->request->data['Beneficiary']['busqueda'])) {
                    $busqueda = "";
                } else {
                    $busqueda = $this->request->data['Beneficiary']['busqueda'];
                }
                $this->set("beneficiarios", $this->Beneficiary->find('all', array(
                            'conditions' => array('Beneficiary.calificacion_visita' => 'Cumple', 'Beneficiary.beneficiary_id' => 0, 'Property.proyect_id' => $proyect_id, 'or' => array('Beneficiary.nombres LIKE' => '%' . $busqueda . '%', 'Beneficiary.numero_identificacion LIKE' => '%' . $busqueda . '%', 'Beneficiary.primer_apellido LIKE' => '%' . $busqueda . '%')),
                            'joins' => array(
                                array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Property.id=Beneficiary.property_id')),
                            ),
                            'recursive' => -1,
                            'fields' => array('Beneficiary.id', 'Beneficiary.concepto_visita', 'Beneficiary.calificacion_visita', 'Beneficiary.beneficiary_id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo_identificacion', 'Property.nombre', 'Beneficiary.property_id', 'Beneficiary.archivo_contraloria', 'Beneficiary.archivo_policia', 'Beneficiary.archivo_cedula', 'Beneficiary.archivo_procuraduria')
                        )));
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

    public function requirements_report() {
        $this->layout = "ajax";
        ini_set('memory_limit','512M');
        ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
        //create a file
        $filename = "Reporte_beneficiarios_" . date("Y.m.d") . ".csv";
        $csv_file = fopen('php://output', 'w');
        $this->response->type('application/csv');

        header('Content-Disposition: attachment; filename="' . $filename . '"');
        //dirección territorial a la que pertenece el usuario 
        $branch_id = $this->Auth->user('branch_id');
        
        $cabecera = array();
        $sql = "SELECT Conv.nombre AS Convocatoria, pr.codigo ,e.id as municipio_id ,f.id as departamento_id, f.name As Departamento, e.name AS municipio, Property.nombre, Property.matricula, Property.cedula_catastral, Property.oficina_registro, Property.uaf, Property.origen, Property.area_total_ha, Property.area_total_m, Property.actividad_productiva, Property.georeferencia1, Property.georeferencia2, Property.georeferencia3, Property.georeferencia4, Property.georeferencia5, Property.georeferencia6, Property.dato_origen, Property.familias_campesinas, Property.familias_desplazadas, Property.familias_negritudes, Property.familias_indigenas, Property.madres_cabeza, Property.otras_familias, Property.ruta_matricula, Property.ruta_resolucion, Property.archivo_distrito, Property.archivo_resguardo, Property.archivo_consejo, Property.archivo_uso_suelo, 
                a.nombres, a.primer_apellido, a.segundo_apellido,a.numero_identificacion,a.fecha_nacimiento,a.genero,a.tipo,a.telefono,a.direccion,a.archivo_cedula,a.archivo_policia,a.archivo_contraloria,a.archivo_procuraduria,a.numero_resolucion,a.fecha_resolucion, c.texto AS requerimiento,b.calificacion As calificación , b.concepto AS Concepto
                FROM properties Property 
                LEFT JOIN beneficiaries as a ON a.property_id = Property.id
                LEFT JOIN beneficiary_requirements AS b ON b.beneficiary_id = a.id
                LEFT JOIN initial_requirements AS c ON b.initial_requirement_id = c.id
                LEFT JOIN cities AS e ON Property.city_id = e.id
                LEFT JOIN departaments AS f ON e.departament_id = f.id
                LEFT JOIN proyects pr on pr.id=Property.proyect_id
                LEFT JOIN calls Conv ON Property.call_id=Conv.id
                LEFT JOIN branches Branch ON Branch.departament_id = f.id
                WHERE Branch.id=$branch_id ORDER BY Conv.id DESC, f.name ASC ,e.id DESC ";
        $flag = 0;
        $this->loadModel('Property');
        $resultados = $this->Property->query($sql);

        foreach ($resultados as $key => $value) {
            $cabecera = array();
            $datos = array();
            //var_dump($value);

            foreach ($value as $key1 => $value1) {

                foreach ($value1 as $key2 => $value2) {

                    $cabecera[] = utf8_decode($key2);
                    $datos[] = utf8_decode($value2);
                }
            }

            if ($flag == 0) {
                fputcsv($csv_file, $cabecera, ';', '"');
            }
            $flag++;
            fputcsv($csv_file, $datos, ';', '"');
        }


        fclose($csv_file);
        $this->autoRender = false;
    }

}

?>