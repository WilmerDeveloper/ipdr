<?php

Class FamilyPollsController extends AppController {

    public $name = 'FamilyPolls';

    function edit($id) {
        $this->layout = "ajax";
        APP::Import('model', 'Departament');
        $Departament = new Departament();
        $this->set('departaments', $Departament->find('list'));
        $this->set('cities', $Departament->City->find('list', array('fields' => array('divipol', 'name'))));
        $this->FamilyPoll->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->FamilyPoll->find('first', array('conditions' => array('FamilyPoll.id' => $id)));
        } else {
            if (!isset($this->request->data['FamilyPoll']['ciudad_desplazamiento'])) {
                $this->request->data['FamilyPoll']['ciudad_desplazamiento'] = 0;
            }
            if (!isset($this->request->data['FamilyPoll']['jac'])) {
                $this->request->data['FamilyPoll']['jac'] = 0;
            }
            if (!isset($this->request->data['FamilyPoll']['organizacion'])) {
                $this->request->data['FamilyPoll']['organizacion'] = 0;
            }
            if (!isset($this->request->data['FamilyPoll']['comite'])) {
                $this->request->data['FamilyPoll']['comite'] = 0;
            }
            if (!isset($this->request->data['FamilyPoll']['circulo'])) {
                $this->request->data['FamilyPoll']['circulo'] = 0;
            }
            if (!isset($this->request->data['FamilyPoll']['asociacion_padres'])) {
                $this->request->data['FamilyPoll']['asociacion_padres'] = 0;
            }
            if ($this->FamilyPoll->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FamilyPolls', 'action' => 'index', $this->data['FamilyPoll']['beneficiary_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add($beneficiary_id) {
        $this->layout = "ajax";
        $this->set('beneficiary_id', $beneficiary_id);
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('properties', $this->FamilyPoll->Property->find('list', array('conditions' => array('Property.proyect_id' => $proyect_id), 'fields' => array('Property.id', 'Property.nombre'))));
        APP::Import('model', 'Departament');
        $Departament = new Departament();
        $this->set('departaments', $Departament->find('list'));
        if (empty($this->data)) {
            
        } else {

            if (!isset($this->request->data['FamilyPoll']['ciudad_desplazamiento'])) {
                $this->request->data['FamilyPoll']['ciudad_desplazamiento'] = 0;
            }
            if (!isset($this->request->data['FamilyPoll']['jac'])) {
                $this->request->data['FamilyPoll']['jac'] = 0;
            }
            if (!isset($this->request->data['FamilyPoll']['organizacion'])) {
                $this->request->data['FamilyPoll']['organizacion'] = 0;
            }
            if (!isset($this->request->data['FamilyPoll']['comite'])) {
                $this->request->data['FamilyPoll']['comite'] = 0;
            }
            if (!isset($this->request->data['FamilyPoll']['circulo'])) {
                $this->request->data['FamilyPoll']['circulo'] = 0;
            }
            if (!isset($this->request->data['FamilyPoll']['asociacion_padres'])) {
                $this->request->data['FamilyPoll']['asociacion_padres'] = 0;
            }


            $this->request->data['FamilyPoll']['user_id'] = $this->Auth->user('id');

            if ($this->FamilyPoll->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FamilyPolls', 'action' => 'index', $beneficiary_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function get_city() {
        $this->layout = "ajax";
        foreach ($this->data['FamilyPoll'] as $key => $value) {
            if ($key == "departament_id") {
                $this->set('tipo', 1);
                $this->set('cities', $this->FamilyPoll->City->find('list', array(
                            'order' => 'name ASC',
                            'conditions' => array('City.departament_id' => $this->data['FamilyPoll']['departament_id'])
                                )
                ));
            } else {
                $this->set('tipo', 2);
                $this->set('cities', $this->FamilyPoll->City->find('list', array(
                            'order' => 'name ASC',
                            'conditions' => array('City.departament_id' => $this->data['FamilyPoll']['departamento_desplazamiento'])
                                )
                ));
            }
        }
    }

    function index($beneficiary_id) {

        $this->set('beneficiary_id', $beneficiary_id);
        $this->paginate = array('FamilyPoll' => array(
                'recursive' => -1,
                'maxLimit' => 500,
                'limit' => 50,
                'fields' => array('Property.nombre', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'FamilyPoll.id', 'FamilyPoll.nombre_aliado', 'FamilyPoll.nombre_encuestador', 'FamilyPoll.documento_encuestador', 'FamilyPoll.fecha_entrevista', 'FamilyPoll.codigo_formulario', 'FamilyPoll.nombre_encuestado', 'FamilyPoll.documento_encuestado', 'FamilyPoll.id'),
                'joins' => array(array('type' => 'left', 'table' => 'properties', 'alias' => 'Property', 'conditions' => 'FamilyPoll.property_id=Property.id'), array('type' => 'left', 'table' => 'proyects', 'alias' => 'Proyect', 'conditions' => 'Proyect.id=Property.proyect_id'), array('type' => 'left', 'table' => 'beneficiaries', 'alias' => 'Beneficiary', 'conditions' => 'FamilyPoll.beneficiary_id=Beneficiary.id'))
        ));
        $this->set('FamilyPolls', $this->paginate(array('FamilyPoll.beneficiary_id' => $beneficiary_id)));
    }

    function baseline_index($beneficiary_id) {

        $this->set('beneficiary_id', $beneficiary_id);
        $this->loadModel('Beneficiary');
        $this->loadModel('Proyect');
        $this->loadModel('Property');
        $property_id = $this->Beneficiary->field('property_id', array('Beneficiary.id' => $beneficiary_id));
        $proyect_id = $this->Property->field('proyect_id', array('Property.id' => $property_id));
        $codigo = $this->Proyect->field('codigo', array('Proyect.id' => $proyect_id));

        $this->set('codigo', $codigo);
        $this->set('proyect_id', $proyect_id);


        $this->set('property_id', $property_id);
        $this->paginate = array('FamilyPoll' => array(
                'recursive' => -1,
                'maxLimit' => 500,
                'limit' => 50,
                'fields' => array('Property.nombre', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'FamilyPoll.id', 'FamilyPoll.nombre_aliado', 'FamilyPoll.adjunto_encuesta', 'FamilyPoll.nombre_encuestador', 'FamilyPoll.documento_encuestador', 'FamilyPoll.fecha_entrevista', 'FamilyPoll.codigo_formulario', 'FamilyPoll.nombre_encuestado', 'FamilyPoll.documento_encuestado', 'FamilyPoll.id'),
                'joins' => array(array('type' => 'left', 'table' => 'properties', 'alias' => 'Property', 'conditions' => 'FamilyPoll.property_id=Property.id'), array('type' => 'left', 'table' => 'proyects', 'alias' => 'Proyect', 'conditions' => 'Proyect.id=Property.proyect_id'), array('type' => 'left', 'table' => 'beneficiaries', 'alias' => 'Beneficiary', 'conditions' => 'FamilyPoll.beneficiary_id=Beneficiary.id'))
        ));
        $this->set('FamilyPolls', $this->paginate(array('FamilyPoll.beneficiary_id' => $beneficiary_id)));
    }

    function desplazados() {
        $this->layout = "ajax";
        APP::Import('model', 'Departament');
        $Departament = new Departament();
        $this->set('departaments', $Departament->find('list'));
        if ($this->data['FamilyPoll']['tipo_poblacion'] == "Desplazado") {
            $this->set('desplazados', 1);
        } else {
            $this->set('desplazados', 0);
        }
    }

    function add_baseline($beneficiary_id) {
        $this->request->data['FamilyPoll']['user_id'] = $this->Auth->user('id');
        $this->request->data['FamilyPoll']['beneficiary_id'] = $beneficiary_id;
        $this->request->data['FamilyPoll']['sioncronizado'] = 0;
        if ($this->FamilyPoll->save($this->data)) {
            $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'FamilyPolls', 'action' => 'baseline_index', $beneficiary_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

    function edit_baseline($family_poll_id, $beneficiary_id) {
        $this->set('family_poll_id', $family_poll_id);
        $this->set('beneficiary_id', $beneficiary_id);
    }

    function identification_index($family_poll_id) {

        $this->set('family_poll_id', $family_poll_id);
        $this->paginate = array('FamilyPoll' => array(
                'recursive' => -1,
                'maxLimit' => 500,
                'limit' => 50,
                'fields' => array('Property.nombre', 'FamilyPoll.corregimiento', 'FamilyPoll.id', 'FamilyPoll.vereda', 'FamilyPoll.nombre_encuestador', 'FamilyPoll.documento_encuestador', 'FamilyPoll.fecha_entrevista', 'FamilyPoll.codigo_formulario', 'FamilyPoll.area_predio', 'FamilyPoll.area_parcela', 'FamilyPoll.nombre_consejo', 'FamilyPoll.nombre_resguardo', 'FamilyPoll.id', 'Departament.name', 'City.name'),
                'joins' => array(
                    array('type' => 'left', 'table' => 'cities', 'alias' => 'City', 'conditions' => 'FamilyPoll.city_id=City.id'),
                    array('type' => 'left', 'table' => 'departaments', 'alias' => 'Departament', 'conditions' => 'Departament.id=City.departament_id'),
                    array('type' => 'left', 'table' => 'beneficiaries', 'alias' => 'Beneficiary', 'conditions' => 'Beneficiary.id=FamilyPoll.beneficiary_id'),
                    array('type' => 'left', 'table' => 'properties', 'alias' => 'Property', 'conditions' => 'Property.id=Beneficiary.property_id'),
                )
        ));
        $this->set('FamilyPolls', $this->paginate(array('FamilyPoll.id' => $family_poll_id)));
    }

    function edit_identification($family_poll_id) {
        $this->layout = "ajax";
        $this->set('family_poll_id', $family_poll_id);
        APP::Import('model', 'Departament');
        $Departament = new Departament();
        if (empty($this->data)) {

            $this->set('departaments', $Departament->find('list'));
            $this->set('cities', $Departament->City->find('list'));
            $this->data = $this->FamilyPoll->find('first', array(
                'conditions' => array('FamilyPoll.id' => $family_poll_id),
                'recursive' => -1,
                'fields' => array('FamilyPoll.corregimiento', 'FamilyPoll.departament_id', 'City.departament_id', 'FamilyPoll.id', 'FamilyPoll.vereda', 'FamilyPoll.nombre_encuestador', 'FamilyPoll.documento_encuestador', 'FamilyPoll.fecha_entrevista', 'FamilyPoll.codigo_formulario', 'FamilyPoll.area_predio', 'FamilyPoll.area_parcela', 'FamilyPoll.nombre_consejo', 'FamilyPoll.nombre_resguardo', 'FamilyPoll.city_id'),
                'joins' => array(
                    array('type' => 'left', 'table' => 'cities', 'alias' => 'City', 'conditions' => 'FamilyPoll.city_id=City.id'),
                )
                    )
            );
        } else {
            if ($this->FamilyPoll->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FamilyPolls', 'action' => 'identification_index', $family_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit_asociation($family_poll_id) {
        $this->layout = "ajax";
        $this->set('family_poll_id', $family_poll_id);
        APP::Import('model', 'Departament');
        $Departament = new Departament();
        if (empty($this->data)) {

            $this->set('departaments', $Departament->find('list'));
            $this->set('cities', $Departament->City->find('list'));
            $this->data = $this->FamilyPoll->find('first', array(
                'conditions' => array('FamilyPoll.id' => $family_poll_id),
                'recursive' => -1,
                'fields' => array('FamilyPoll.id', 'FamilyPoll.jac', 'FamilyPoll.corregimiento_desplazamiento', 'FamilyPoll.nombre_encuestador', 'FamilyPoll.organizacion', 'FamilyPoll.consejo_juvenil', 'FamilyPoll.circulo', 'FamilyPoll.otro_asociacion', 'FamilyPoll.consejo_comunitario', 'FamilyPoll.comite', 'FamilyPoll.cabildo', 'FamilyPoll.asociacion_padres', 'FamilyPoll.sindicato', 'Departament.id', 'FamilyPoll.ciudad_desplazamiento', 'FamilyPoll.tipo_poblacion', 'FamilyPoll.asociacion_comunitaria', 'FamilyPoll.asociacion_productiva', 'FamilyPoll.cual_asociacion', 'FamilyPoll.pertenece_asociacion ', 'FamilyPoll.id', 'FamilyPoll.estrato', 'FamilyPoll.grupo_poblacion', 'FamilyPoll.etnia', 'FamilyPoll.fecha_desplazamiento', 'FamilyPoll.vereda_desplazamiento', 'FamilyPoll.corregimiento_desplazamiento', 'FamilyPoll.ciudad_desplazamiento', 'FamilyPoll.pertenece_asociacion', 'FamilyPoll.cual_asociacion', 'FamilyPoll.asociacion_productiva', 'FamilyPoll.asociacion_comunitaria'),
                'joins' => array(
                    array('type' => 'left', 'table' => 'cities', 'alias' => 'City', 'conditions' => 'FamilyPoll.ciudad_desplazamiento=City.id'),
                    array('type' => 'left', 'table' => 'departaments', 'alias' => 'Departament', 'conditions' => 'Departament.id=City.departament_id'),
                )
                    )
            );
        } else {
            if ($this->FamilyPoll->save($this->data)) {
                $this->Session->setFlash('Registro Editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FamilyPolls', 'action' => 'asociation_index', $family_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function asociation_index($family_poll_id) {

        $this->set('family_poll_id', $family_poll_id);
        $this->paginate = array('FamilyPoll' => array(
                'recursive' => -1,
                'maxLimit' => 500,
                'limit' => 50,
                'fields' => array('FamilyPoll.pertenece_asociacion', 'FamilyPoll.cual_asociacion', 'FamilyPoll.asociacion_productiva', 'FamilyPoll.asociacion_comunitaria', 'City.name', 'FamilyPoll.corregimiento_desplazamiento', 'FamilyPoll.jac', 'FamilyPoll.organizacion', 'FamilyPoll.consejo_juvenil', 'FamilyPoll.circulo', 'FamilyPoll.otro_asociacion', 'FamilyPoll.consejo_comunitario', 'FamilyPoll.comite', 'FamilyPoll.cabildo', 'FamilyPoll.asociacion_padres', 'FamilyPoll.sindicato', 'Departament.name', 'FamilyPoll.tipo_poblacion', 'FamilyPoll.asociacion_comunitaria', 'FamilyPoll.asociacion_productiva', 'FamilyPoll.cual_asociacion', 'FamilyPoll.pertenece_asociacion ', 'FamilyPoll.id', 'FamilyPoll.estrato', 'FamilyPoll.grupo_poblacion', 'FamilyPoll.etnia', 'FamilyPoll.fecha_desplazamiento', 'FamilyPoll.vereda_desplazamiento', 'FamilyPoll.corregimiento_desplazamiento', 'FamilyPoll.ciudad_desplazamiento', 'FamilyPoll.area_parcela', 'FamilyPoll.nombre_consejo', 'FamilyPoll.nombre_resguardo', 'FamilyPoll.id'),
                'joins' => array(
                    array('type' => 'left', 'table' => 'cities', 'alias' => 'City', 'conditions' => 'FamilyPoll.ciudad_desplazamiento=City.id'),
                    array('type' => 'left', 'table' => 'departaments', 'alias' => 'Departament', 'conditions' => 'Departament.id=City.departament_id'),
                )
        ));
        $this->set('FamilyPolls', $this->paginate(array('FamilyPoll.id' => $family_poll_id)));
    }

    function operative_index($family_poll_id) {

        $this->set('family_poll_id', $family_poll_id);
        $this->paginate = array('FamilyPoll' => array(
                'recursive' => -1,
                'maxLimit' => 500,
                'limit' => 50,
                'fields' => array('FamilyPoll.codigo_formulario', 'FamilyPoll.nombre_encuestador', 'FamilyPoll.numero_visitas', 'FamilyPoll.nombre_aliado', 'FamilyPoll.fecha_entrevista', 'FamilyPoll.id', 'User.nombre', 'User.primer_apellido'),
                'joins' => array(
                    array('type' => 'left', 'table' => 'users', 'alias' => 'User', 'conditions' => 'FamilyPoll.user_id=User.id'),
                )
        ));
        $this->set('FamilyPolls', $this->paginate(array('FamilyPoll.id' => $family_poll_id)));
    }

    function edit_operative($family_poll_id) {
        $this->layout = "ajax";
        $this->set('family_poll_id', $family_poll_id);
        APP::Import('model', 'Departament');
        $Departament = new Departament();
        if (empty($this->data)) {

            $this->set('departaments', $Departament->find('list'));
            $this->set('cities', $Departament->City->find('list'));
            $this->data = $this->FamilyPoll->find('first', array(
                'conditions' => array('FamilyPoll.id' => $family_poll_id),
                'recursive' => -1,
                'fields' => array('FamilyPoll.codigo_formulario', 'FamilyPoll.nombre_encuestador', 'FamilyPoll.numero_visitas', 'FamilyPoll.nombre_aliado', 'FamilyPoll.fecha_entrevista', 'FamilyPoll.id'),
                    )
            );
        } else {
            if ($this->FamilyPoll->save($this->data)) {
                $this->Session->setFlash('Registro Editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'FamilyPolls', 'action' => 'operative_index', $family_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function delete($param) {
        
    }

    function upload_file($baseline_id, $beneficiary_id) {
        $this->set('beneficiary_id', $beneficiary_id);
        if (empty($this->data)) {
            $this->data = $this->FamilyPoll->find('first', array('recursive' => -1, 'conditions' => array('FamilyPoll.id' => $baseline_id), 'fields' => array('FamilyPoll.beneficiary_id', 'FamilyPoll.id')));
        } else {
            if ($this->FamilyPoll->save($this->data)) {

                $this->loadModel('Proyect');
                $this->loadModel('Property');
                $this->loadModel('Beneficiary');
                $property_id = $this->Beneficiary->field('property_id', array('Beneficiary.id' => $beneficiary_id));
                $proyect_id = $this->Property->field('proyect_id', array('Property.id' => $property_id));
                $codigo = $this->Proyect->field('codigo', array('Proyect.id' => $proyect_id));

                $rutaArchivo = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                $nombreArchivo = "Encuesta_beneficiario_$baseline_id.pdf";
                $rutaArchivo.= "/" . $nombreArchivo;
                $exito = 1;
                if (isset($this->data['FamilyPoll']['archivo_encuesta']['tmp_name'])) {
                    if (move_uploaded_file($this->data['FamilyPoll']['archivo_encuesta']['tmp_name'], $rutaArchivo)) {
                        $this->FamilyPoll->id = $baseline_id;
                        $this->FamilyPoll->saveField('adjunto_encuesta', $nombreArchivo);
                    } else {
                        $exito = 0;
                    }
                }

                if ($exito) {
                    $this->Session->setFlash('Registro Editado correctamente con archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'FamilyPolls', 'action' => 'baseline_index', $beneficiary_id));
                } else {
                    $this->Session->setFlash('error adjuntando archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'FamilyPolls', 'action' => 'baseline_index', $beneficiary_id));
                }
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

}

?>
