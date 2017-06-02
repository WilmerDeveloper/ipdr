<?php

Class PropertiesController extends AppController {

    public $name = 'Properties';

    public function add($proyect_id) {
        $this->layout = "ajax";
        $this->set('proyect_id', $proyect_id);
        if (empty($this->data)) {
            $this->set('departaments', $this->Property->Departament->find('list'));
        } else {

            if ($this->Property->save($this->data)) {

                $property_id = $this->Property->getInsertID();
                $this->request->data['PropertyControl']['property_id'] = $property_id;
                if ($this->Property->PropertyControl->save($this->data)) {
                    $this->Session->setFlash('Registro adicionado correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'Properties', 'action' => 'index', $proyect_id));
                } else {
                    $this->Session->setFlash('Error guardando datos', 'flash_custom');
                }
            } else {
                $this->Session->setFlash('Error guardando datos2', 'flash_custom');
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->Property->recursive = -1;
        $this->set('departaments', $this->Property->Departament->find('list'));
        App::Import('model', 'Proyect');
        $Proyect = new Proyect();
        $this->set('proyects', $Proyect->find('list', array('fields' => array('Proyect.id', 'Proyect.codigo'))));

        if (empty($this->data)) {

            $this->data = $this->Property->find('first', array('conditions' => array('Property.id' => $id),));
            $this->set('cities', $this->Property->City->find('list', array('conditions' => array('City.departament_id' => $this->data['Property']['departament_id']))));
        } else {
            if ($this->Property->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Properties', 'action' => 'edit', $this->data['Property']['id']));
            } else {
                $this->Session->setFlash('Por favor verifique los datos.', 'flash_custom');
            }
        }
    }

    public function baseline($property_id) {
        $this->layout = "ajax";
        $this->Property->recursive = -1;
        $this->set('property_id', $property_id);
        $this->set('proyect_id', $this->Session->read('proyect_id'));
        $this->loadModel('Proyect');
        $codigo = $this->Proyect->field('codigo', array('Proyect.id' => $this->Session->read('proyect_id')));
        $adjunto = $this->Property->field('adjunto_encuesta', array('Property.id' => $property_id));
        $this->set('codigo', $codigo);
        $this->set('adjunto', $adjunto);
    }

    public function productive_baseline($property_id) {
        $this->layout = "ajax";
        $this->Property->recursive = -1;
        $this->set('departaments', $this->Property->Departament->find('list'));
        App::Import('model', 'Proyect');
        $Proyect = new Proyect();
        $this->set('proyects', $Proyect->find('list', array('fields' => array('Proyect.id', 'Proyect.codigo'))));

        if (empty($this->data)) {
            $this->data = $this->Property->find('first', array('conditions' => array('Property.id' => $property_id),));
            $this->set('cities', $this->Property->City->find('list', array('conditions' => array('City.departament_id' => $this->data['Property']['departament_id']))));
        } else {

            if ($this->Property->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Properties', 'action' => 'baseline', $property_id));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_custom');
            }
        }
    }

    public function index() {

        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);
        if ($proyect_id != "") {
            $this->layout = "ajax";
            $this->Property->recursive = -1;
            $this->paginate = array('Property' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Property.id', 'Property.nombre', 'Property.matricula', 'Property.cedula_catastral', 'Property.extension')));
            $this->set('Properties', $this->paginate(array('Property.proyect_id' => $proyect_id)));
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    public function baselines_index() {
        $this->layout = "ajax";
        $this->Property->recursive = -1;
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('group_id', $this->Auth->user('group_id'));
        $this->set('proyect_id', $proyect_id);
        if ($proyect_id != "") {
            $this->paginate = array('Property' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('City.name', 'Departament.name', 'Property.id', 'Property.nombre', 'Property.calificacion_visita', 'Property.matricula', 'Property.cedula_catastral', 'Property.area_total_ha', 'Property.area_total_m'), 'joins' => array(array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Property.city_id')), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')))));
            if (empty($this->data) or $this->data['Property']['busqueda'] == "") {


                $this->set('Properties', $this->paginate(array('Property.proyect_id' => $proyect_id)));
            } else {


                $this->set('Properties', $this->paginate(array('Property.proyect_id' => $proyect_id, 'or' => array('Property.nombre LIKE' => "%" . $this->data['Property']['busqueda'] . "%", 'Property.matricula LIKE ' => "%" . $this->data['Property']['busqueda'] . "%", 'Property.cedula_catastral LIKE ' => "%" . $this->data['Property']['busqueda'] . "%", 'Departament.name LIKE ' => "%" . $this->data['Property']['busqueda'] . "%"))));
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
    }

    public function index1() {


        $this->layout = "ajax";
        $this->Property->recursive = -1;
        $this->paginate = array('Property' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Property.id', 'Property.nombre', 'Property.matricula', 'Property.cedula_catastral', 'Property.extension')));
        $this->set('Properties', $this->paginate(array('Property.proyect_id' => 0)));
    }

    public function requirement_index() {
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);
        if ($proyect_id != "") {
            $this->layout = "ajax";
            $this->paginate = array('Property' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Property.id', 'Property.nombre', 'Property.matricula', 'Property.georeferencia1', 'Property.georeferencia2', 'Property.georeferencia3', 'Property.georeferencia4', 'Property.georeferencia5', 'Property.georeferencia6', 'Property.colindante_norte', 'Property.colindante_sur', 'Property.colindante_occidente', 'Property.colindante_oriente', 'Property.fam_beneficiaria_campesina', 'Property.fam_beneficiaria_desplazada', 'Property.habitante_beneficiario_campesino', 'Property.habitante_beneficiario_desplazado', 'Property.habitante_no_beneficiario_campesino', 'Property.habitante_no_beneficiario_desplazado', 'Property.organization', 'Property.vivienda', 'Property.vivienda_numero', 'Property.agua', 'Property.electricidad', 'Property.gas', 'Property.telefono_fijo', 'Property.ninguno', 'Property.origen_productivo', 'Property.tipo_otro', 'Property.lineas_productivas', 'Property.area_explotacion', 'Property.infraestructura', 'Property.infraestructura_tipo', 'Property.tipo_otro2', 'Property.observacion', 'Property.encuestado', 'Property.documento', 'Property.vereda', 'Property.corregimiento', 'Property.altitud_max', 'Property.altitud_min', 'Property.temperatura_max', 'Property.temperatura_min', 'Property.piso', 'Property.lluvias', 'Property.departament_id', 'Property.city_id', 'Property.proyect_id', 'Property.numero_resolucion', 'Property.certificacion_suelos', 'Property.id')));
            $this->set('Properties', $this->paginate(array('Property.proyect_id' => $proyect_id)));
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    public function select() {
        $this->layout = "ajax";
        $this->set('cities', $this->Property->City->find('list', array(
                    'order' => 'name ASC',
                    'conditions' => array('City.departament_id' => $this->data['Property']['departament_id'])
                        )
        ));
    }

    public function upload_files($property_id) {
        $this->layout = "ajax";
        $this->set('property_id', $property_id);
        if (empty($this->data)) {
            $this->data = $this->Property->find('first', array('recursive' => -1, 'conditions' => array('Property.id' => $property_id), 'fields' => array('Property.id', 'Property.proyect_id', 'Property.tipo_tenencia')));
        } else {
            $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Predio-" . $this->data['Property']['id'];
            if (!is_dir($rutaArchivo)) {
                if (!mkdir($rutaArchivo)) {
                    echo "error creando archivo";
                    //redirect
                }
            }

            $codigo = "Predio-" . $this->data['Property']['id'];
            $rutaResolucion = $rutaArchivo;
            $rutaMatricula = $rutaArchivo;
            $rutaDistrito = $rutaArchivo;
            $rutaResguardo = $rutaArchivo;
            $rutaConsejo = $rutaArchivo;
            $rutaUso = $rutaArchivo;
            $rutaConceptoAmbiental = $rutaArchivo;
            $rutaParquesNacional = $rutaArchivo;
            $rutaMinAmbiente = $rutaArchivo;
            $rutaCruceAmbiental = $rutaArchivo;

            $rutaDeclaracionExtrajuicio = $rutaArchivo;
            $rutaJuntaAccionComunal = $rutaArchivo;
            $rutaSanaPosesion = $rutaArchivo;
            $rutaManifiestoColindancias = $rutaArchivo;

            if (empty($this->request->data['Property']['archivo_resolucion']['tmp_name']) and
                    empty($this->request->data['Property']['archivo_matricula']['tmp_name']) and
                    empty($this->request->data['Property']['distrito']['tmp_name']) and
                    empty($this->request->data['Property']['resguardo']['tmp_name']) and
                    empty($this->request->data['Property']['consejo']['tmp_name']) and
                    empty($this->request->data['Property']['uso_suelo']['tmp_name']) and
                    empty($this->request->data['Property']['concepto_ambiental']['tmp_name']) and
                    empty($this->request->data['Property']['parques_nacionales']['tmp_name']) and
                    empty($this->request->data['Property']['ministerio_medio_ambiente']['tmp_name']) and
                    empty($this->request->data['Property']['cruce_ambiental_preliminar']['tmp_name']) and
                    empty($this->request->data['Property']['declaracion_extrajuicio']['tmp_name']) and
                    empty($this->request->data['Property']['junta_accion_comunal']['tmp_name']) and
                    empty($this->request->data['Property']['sana_posesion']['tmp_name']) and
                    empty($this->request->data['Property']['manifiesto_colindancias']['tmp_name'])
            ) {
                $this->Session->setFlash('No eligió ningun archivo', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {

                $exito = 1;
                if (!empty($this->request->data['Property']['archivo_resolucion']['tmp_name'])) {
                    $nombreResolucion = "Resolucion-$codigo" . ".pdf";
                    $rutaResolucion.=DS . $nombreResolucion;
                    $this->request->data['Property']['ruta_resolucion'] = $nombreResolucion;

                    if (move_uploaded_file($this->data['Property']['archivo_resolucion']['tmp_name'], $rutaResolucion)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando resolucion', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['archivo_matricula']['tmp_name'])) {
                    $nombreMatricula = "Matricula-$codigo" . ".pdf";
                    $rutaMatricula.=DS . $nombreMatricula;
                    $this->request->data['Property']['ruta_matricula'] = $nombreMatricula;
                    if (move_uploaded_file($this->data['Property']['archivo_matricula']['tmp_name'], $rutaMatricula)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando matricula', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['distrito']['tmp_name'])) {
                    $nombreDistrito = "Distrito-$codigo" . ".pdf";
                    $rutaDistrito.=DS . $nombreDistrito;
                    $this->request->data['Property']['archivo_distrito'] = $nombreDistrito;
                    if (move_uploaded_file($this->data['Property']['distrito']['tmp_name'], $rutaDistrito)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando distrito de riego', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['resguardo']['tmp_name'])) {
                    $nombreResguardo = "Resguardo-$codigo" . ".pdf";
                    $rutaResguardo.=DS . $nombreResguardo;
                    $this->request->data['Property']['archivo_resguardo'] = $nombreResguardo;
                    if (move_uploaded_file($this->data['Property']['resguardo']['tmp_name'], $rutaResguardo)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando resguardo', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['consejo']['tmp_name'])) {
                    $nombreConsejo = "Consejo-$codigo" . ".pdf";
                    $rutaConsejo.=DS . $nombreConsejo;
                    $this->request->data['Property']['archivo_consejo'] = $nombreConsejo;
                    if (move_uploaded_file($this->data['Property']['consejo']['tmp_name'], $rutaConsejo)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando resguardo', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['uso_suelo']['tmp_name'])) {
                    $nombreUso = "Uso_suelo-$codigo" . ".pdf";
                    $rutaUso.=DS . $nombreUso;
                    $this->request->data['Property']['archivo_uso_suelo'] = $nombreUso;
                    if (move_uploaded_file($this->data['Property']['uso_suelo']['tmp_name'], $rutaUso)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando resguardo', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['concepto_ambiental']['tmp_name'])) {
                    $nombreConceptoAmbiental = "concepto_ambiental-$codigo" . ".pdf";
                    $rutaConceptoAmbiental.=DS . $nombreConceptoAmbiental;
                    $this->request->data['Property']['archivo_concepto_ambiental'] = $nombreConceptoAmbiental;
                    if (move_uploaded_file($this->data['Property']['concepto_ambiental']['tmp_name'], $rutaConceptoAmbiental)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando concepto ambiental', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['parques_nacionales']['tmp_name'])) {
                    $nombreParquesNacional = "parques_nacionales-$codigo" . ".pdf";
                    $rutaParquesNacional.=DS . $nombreParquesNacional;
                    $this->request->data['Property']['archivo_parques_nacionales'] = $nombreParquesNacional;
                    if (move_uploaded_file($this->data['Property']['parques_nacionales']['tmp_name'], $rutaParquesNacional)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando parques nacionales', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['ministerio_medio_ambiente']['tmp_name'])) {
                    $nombreMinAmbiente = "ministerio_medio_ambiente-$codigo" . ".pdf";
                    $rutaMinAmbiente.=DS . $nombreMinAmbiente;
                    $this->request->data['Property']['archivo_ministerio_medio_ambiente'] = $nombreMinAmbiente;
                    if (move_uploaded_file($this->data['Property']['ministerio_medio_ambiente']['tmp_name'], $rutaMinAmbiente)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando ministerio medio ambiente', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['cruce_ambiental_preliminar']['tmp_name'])) {
                    $nombreCruceAmbiental = "cruce_ambiental_preliminar-$codigo" . ".pdf";
                    $rutaCruceAmbiental.=DS . $nombreCruceAmbiental;
                    $this->request->data['Property']['archivo_cruce_ambiental_preliminar'] = $nombreCruceAmbiental;
                    if (move_uploaded_file($this->data['Property']['cruce_ambiental_preliminar']['tmp_name'], $rutaCruceAmbiental)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando cruce ambiental preliminar', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['junta_accion_comunal']['tmp_name'])) {
                    $nombreJuntaAccionComunal = "junta_accion_comunal-$codigo" . ".pdf";
                    $rutaJuntaAccionComunal.=DS . $nombreJuntaAccionComunal;
                    $this->request->data['Property']['archivo_junta_accion_comunal'] = $nombreJuntaAccionComunal;
                    if (move_uploaded_file($this->data['Property']['junta_accion_comunal']['tmp_name'], $rutaJuntaAccionComunal)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando declaración extrajuicio', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['sana_posesion']['tmp_name'])) {
                    $nombreSanaPosesion = "sana_posesion-$codigo" . ".pdf";
                    $rutaSanaPosesion.=DS . $nombreSanaPosesion;
                    $this->request->data['Property']['archivo_sana_posesion'] = $nombreSanaPosesion;
                    if (move_uploaded_file($this->data['Property']['sana_posesion']['tmp_name'], $rutaSanaPosesion)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando sana posesión', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['manifiesto_colindancias']['tmp_name'])) {
                    $nombreManifiestoColindancias = "manifiesto_colindancias-$codigo" . ".pdf";
                    $rutaManifiestoColindancias.=DS . $nombreManifiestoColindancias;
                    $this->request->data['Property']['archivo_manifiesto_colindancias'] = $nombreManifiestoColindancias;
                    if (move_uploaded_file($this->data['Property']['manifiesto_colindancias']['tmp_name'], $rutaManifiestoColindancias)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando manifiesto colindancias', 'flash_custom');
                    }
                }

                if (!empty($this->request->data['Property']['declaracion_extrajuicio']['tmp_name'])) {
                    $nombreDeclaracionExtrajuicio = "declaracion_extrajuicio-$codigo" . ".pdf";
                    $rutaDeclaracionExtrajuicio.=DS . $nombreDeclaracionExtrajuicio;
                    $this->request->data['Property']['archivo_declaracion_extrajuicio'] = $nombreDeclaracionExtrajuicio;
                    if (move_uploaded_file($this->data['Property']['declaracion_extrajuicio']['tmp_name'], $rutaDeclaracionExtrajuicio)) {
                        
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando declaración extrajuicio', 'flash_custom');
                    }
                }

                if ($exito == 1) {
                    if ($this->Property->save($this->data)) {

                        $this->Session->setFlash('Archivo cargado correctamente', 'flash_custom');

                        $this->redirect(array('controller' => 'Properties', 'action' => 'property_index', $property_id));
                    } else {
                        $this->Session->setFlash('Error adjuntando archivo', 'flash_custom');
                        $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                    }
                } else {

                    $this->Session->setFlash('Error Guardando archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }
            }
        }
    }

    public function property_index($property_id) {
        //$this->layout = "ajax";
        //$this->Property->recursive = -1;
        $this->paginate = array(
            'Property' => array(
                'recursive' => -1,
                'maxLimit' => 500,
                'limit' => 200,
                'order' => array('Property.call_id' => 'DESC', 'Property.id' => 'DESC'),
                'fields' => array('Call.nombre', 'City.name', 'Departament.name', 'Property.id', 'Property.nombre', 'Property.matricula', 'Property.proyect_id', 'Property.cedula_catastral', 'Property.area_total_ha', 'Property.area_total_m'),
                'joins' => array(
                    array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Property.city_id')),
                    array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')),
                    array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Call.id=Property.call_id'))
                )
            )
        );

        if ($property_id == 0) {
            if (empty($this->data) or $this->data['Property']['busqueda'] == "") {


                if ($this->Auth->user('group_id') == 4) {
                    App::Import('model', 'Branch');
                    $Branch = new Branch();
                    $regional = $Branch->find('first', array('fields' => array('Branch.departament_id'), 'recursive' => -1, 'conditions' => array('Branch.id' => $this->Auth->user('branch_id'))));
                    $this->set('Properties', $this->paginate(array('Property.departament_id' => $regional['Branch']['departament_id'], 'Property.proyect_id' => 0)));
                } else {

                    $this->set('Properties', $this->paginate(array('Property.proyect_id' => 0)));
                }
            } else {

                if ($this->Auth->user('group_id') == 4) {
                    App::Import('model', 'Branch');
                    $Branch = new Branch();
                    $regional = $Branch->find('first', array('fields' => array('Branch.departament_id'), 'recursive' => -1, 'conditions' => array('Branch.id' => $this->Auth->user('branch_id'))));
                    $this->set('Properties', $this->paginate(array('Property.departament_id' => $regional['Branch']['departament_id'], 'Property.proyect_id' => 0, 'or' => array('Property.nombre LIKE' => "%" . $this->data['Property']['busqueda'] . "%", 'Property.matricula LIKE ' => "%" . $this->data['Property']['busqueda'] . "%", 'Property.cedula_catastral LIKE ' => "%" . $this->data['Property']['busqueda'] . "%", 'City.name LIKE ' => "%" . $this->data['Property']['busqueda'] . "%"))));
                } else {
                    $this->set('Properties', $this->paginate(array('Property.proyect_id' => 0, 'or' => array('Property.nombre LIKE' => "%" . $this->data['Property']['busqueda'] . "%", 'Property.matricula LIKE ' => "%" . $this->data['Property']['busqueda'] . "%", 'Property.cedula_catastral LIKE ' => "%" . $this->data['Property']['busqueda'] . "%", 'Departament.name LIKE ' => "%" . $this->data['Property']['busqueda'] . "%", 'City.name LIKE ' => "%" . $this->data['Property']['busqueda'] . "%"))));
                }
            }
        } else {
            $this->set('Properties', $this->paginate(array('Property.id' => $property_id)));
        }
    }

    public function index2() {
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);
        if ($proyect_id != "") {
            $this->layout = "ajax";
            $this->Property->recursive = -1;
            $this->paginate = array('Property' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Property.id', 'Property.nombre', 'Property.matricula', 'Property.cedula_catastral', 'Property.extension')));
            $this->set('Properties', $this->paginate(array('Property.proyect_id' => $proyect_id)));
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    public function view_files($property_id) {
        $this->set("property_id", $property_id);
        $this->layout = "ajax";
        $this->Property->recursive = -1;
        $this->paginate = array('Property' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Property.id', 'Property.ruta_matricula', 'Property.archivo_distrito', 'Property.archivo_consejo',
                    'Property.ruta_resolucion', 'Property.archivo_resguardo', 'Property.archivo_uso_suelo', 'Property.archivo_concepto_ambiental', 'Property.archivo_parques_nacionales',
                    'Property.archivo_ministerio_medio_ambiente', 'Property.archivo_cruce_ambiental_preliminar', 'Property.tipo_tenencia',
                    'Property.archivo_declaracion_extrajuicio', 'Property.archivo_junta_accion_comunal', 'Property.archivo_sana_posesion', 'Property.archivo_manifiesto_colindancias')));
        $this->set('Properties', $this->paginate(array('Property.id' => $property_id)));
    }

    public function add_property() {
        $this->layout = "ajax";
        if (empty($this->data)) {
            App::Import('model', 'Departament');
            $Departament = new Departament();
            $this->set('departaments', $Departament->find('list'));
        } else {
            if ($this->Property->save($this->data)) {
                $this->Session->setFlash('Predio creado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Properties', 'action' => 'property_index', 0));
            } else {
                $this->Session->setFlash('Error adjuntando archivo', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        }
    }

    public function edit_property($id) {
        $this->layout = "ajax";
        $this->Property->recursive = -1;
        $this->set('departaments', $this->Property->Departament->find('list'));
        if (empty($this->data)) {
            $this->data = $this->Property->find('first', array('conditions' => array('Property.id' => $id),));
            $this->set('cities', $this->Property->City->find('list', array('conditions' => array('City.departament_id' => $this->data['Property']['departament_id']))));
        } else {

            if ($this->Property->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Properties', 'action' => 'property_index', $id));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_custom');
            }
        }
    }

    public function phase0_evaluation($property_id, $redirect) {

        $this->set("property_id", $property_id);
        $this->set("redirect", $redirect);
        //Busco requisitos predio
        $this->loadModel('PropertyRequirement');
        $this->loadModel('Beneficiary');
        $this->loadModel('BeneficiaryRequirement');

        $requerimientos_pred = $this->PropertyRequirement->find('all', array('recursive' => 0, 'conditions' => array('PropertyRequirement.property_id' => $property_id), 'fields' => array('PropertyRequirement.id', 'PropertyRequirement.calificacion')));

        $cumple_req_predio = true;
        foreach ($requerimientos_pred as $requerimiento) {
            if ($requerimiento['PropertyRequirement']['calificacion'] == '' or is_null($requerimiento['PropertyRequirement']['calificacion'])) {
                $cumple_req_predio = false;
            }
        }
        //Busco los beneficiarios del proyecto
        $ben = $this->Beneficiary->find('all', array('conditions' => array('Beneficiary.property_id' => $property_id), 'fields' => array('Beneficiary.id')));


        //Busco todos los requisitos de todos los beneficiarios
        $cumple_req_ben = true;
        foreach ($ben as $b) {
            $requerimientos_ben = $this->BeneficiaryRequirement->find('all', array('recursive' => 0, 'conditions' => array('BeneficiaryRequirement.beneficiary_id' => $b['Beneficiary']['id']), 'fields' => array('BeneficiaryRequirement.calificacion')));
            if (empty($requerimientos_ben)) {
                $cumple_req_ben = false;
            }
            //Todos los requisitos del beneficiario deben ser distintos a null o vacio
            foreach ($requerimientos_ben as $requerimiento_ben) {
                if ($requerimiento_ben['BeneficiaryRequirement']['calificacion'] == '' or is_null($requerimiento_ben['BeneficiaryRequirement']['calificacion'])) {
                    $cumple_req_ben = false;
                }
            }
        }

        $mostrar_calificacion = 0;
        if ($cumple_req_predio and $cumple_req_ben) {
            $mostrar_calificacion = 1;
        }

        $this->set("cumple_req_ben", $cumple_req_ben);
        $this->set("cumple_req_predio", $cumple_req_predio);
        $this->set("mostrar_calificacion", $mostrar_calificacion);
    }

    public function phase0_calification_index($property_id, $mostrar_calificacion = null) {

        if (empty($this->data)) {
            $this->set('mostrar_calificacion', $mostrar_calificacion);
            $this->paginate = array('Property' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('Property.id', 'Property.calificacion_fase0', 'Property.concepto_fase0', 'Property.nombre')));
            $this->set('Properties', $this->paginate(array("Property.id" => $property_id)));
        }
    }

    public function edit_phase0($property_id) {

        $this->Property->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Property->find('first', array('conditions' => array('Property.id' => $property_id), 'fields' => array("Property.calificacion_fase0", 'Property.id', 'Property.concepto_fase0')));
        } else {

            if ($this->Property->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Properties', 'action' => 'phase0_calification_index', $property_id));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_custom');
            }
        }
    }

    public function print_list($property_id) {
        $this->layout = "pdf";

        $this->set('predio', $this->Property->find('first', array('fields' => array('Property.nombre', 'Property.id', 'Property.vereda', 'City.name', 'Departament.name'), 'recursive' => -1, 'conditions' => array('Property.id' => $property_id), 'joins' => array(array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => 'Property.city_id=City.id'), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => 'City.departament_id=Departament.id')))));
    }

    public function delete($property_id) {


        App::import('model', 'Beneficiary');
        $Beneficiary = new Beneficiary();
        $beneficiarios = $Beneficiary->find('all', array('recursive' => -1, 'conditions' => array('Beneficiary.property_id' => $property_id), 'fields' => array('Beneficiary.id')));
        foreach ($beneficiarios as $beneficiario) {
            // se borran los requisitos
            $Beneficiary->BeneficiaryRequirement->recursive = -1;
            $Beneficiary->BeneficiaryRequirement->deleteAll(array('BeneficiaryRequirement.beneficiary_id' => $beneficiario['Beneficiary']['id']));
            $Beneficiary->delete($beneficiario['Beneficiary']['id']);
        }
        App::import('model', 'PropertyRequirement');

        $PropertyRequirement = new PropertyRequirement();
        $PropertyRequirement->recursive = -1;
        $PropertyRequirement->deleteAll(array('PropertyRequirement.property_id' => $property_id));
        if ($this->Property->delete($property_id)) {

            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Properties', 'action' => 'property_index', $property_id));
        }
    }

    public function view($property_id) {
        $this->layout = "ajax";
        $this->set("property_id", $property_id);
        $this->set('property', $this->Property->find('first', array('recursive' => -1, 'conditions' => array('Property.id' => $property_id), 'joins' => array(array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Property.city_id')), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id'))), 'fields' => array('Property.*', 'City.name', 'Departament.name'))));
    }

    public function phase1_index() {
        $this->layout = "ajax";
        $this->Property->recursive = -1;
        $this->paginate = array('Property' =>
            array('maxLimit' => 500,
                'limit' => 50,
                'order' => array('Property.id' => 'DESC'),
                'fields' => array('City.name', 'Proyect.codigo', 'Call.nombre', 'Departament.name', 'Property.id', 'Property.nombre', 'Property.matricula', 'Property.cedula_catastral', 'Property.area_total_ha', 'Property.area_total_m'),
                'joins' => array(
                    array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Property.city_id')),
                    array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')),
                    array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => array('Proyect.id=Property.proyect_id')),
                    array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Proyect.call_id=Call.id')),
                ),
        ));
        if (empty($this->data) or $this->data['Property']['busqueda'] == "") {


            if ($this->Auth->user('group_id') == 4) {
                App::Import('model', 'Branch');
                $Branch = new Branch();
                $regional = $Branch->find('first', array('fields' => array('Branch.departament_id'), 'recursive' => -1, 'conditions' => array('Branch.id' => $this->Auth->user('branch_id'))));
                $this->set('Properties', $this->paginate(array('Property.departament_id' => $regional['Branch']['departament_id'], 'Property.proyect_id' => 0)));
            } else {

                $this->set('Properties', $this->paginate(array()));
            }
        } else {

            if ($this->Auth->user('group_id') == 4) {
                App::Import('model', 'Branch');
                $Branch = new Branch();
                $regional = $Branch->find('first', array('fields' => array('Branch.departament_id'), 'recursive' => -1, 'conditions' => array('Branch.id' => $this->Auth->user('branch_id'))));
                $this->set('Properties', $this->paginate(array('Property.departament_id' => $regional['Branch']['departament_id'], 'Property.proyect_id' => 0, 'or' => array('Property.nombre LIKE' => "%" . $this->data['Property']['busqueda'] . "%", 'Property.matricula LIKE ' => "%" . $this->data['Property']['busqueda'] . "%", 'Property.cedula_catastral LIKE ' => "%" . $this->data['Property']['busqueda'] . "%"))));
            } else {
                $this->set('Properties', $this->paginate(array('or' => array('Property.nombre LIKE' => "%" . $this->data['Property']['busqueda'] . "%", 'Property.matricula LIKE ' => "%" . $this->data['Property']['busqueda'] . "%", 'Property.cedula_catastral LIKE ' => "%" . $this->data['Property']['busqueda'] . "%"))));
            }
        }
    }

    public function resolution_index() {
        $this->layout = "ajax";
        $this->Property->recursive = -1;
        $this->set('group_id', $this->Auth->user('group_id'));

        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);
        if ($proyect_id != "") {
            $this->paginate = array('Property' =>
                array('maxLimit' => 500,
                    'limit' => 50,
                    'order' => array('Property.id' => 'DESC'),
                    'fields' => array('City.name', 'Proyect.codigo', 'Call.nombre', 'Departament.name', 'Property.id', 'Property.calificacion_visita', 'Property.calificacion_fase0', 'Property.nombre', 'Property.matricula', 'Property.cedula_catastral', 'Property.area_total_ha', 'Property.area_total_m'),
                    'joins' => array(
                        array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Property.city_id')),
                        array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')),
                        array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => array('Proyect.id=Property.proyect_id')),
                        array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Proyect.call_id=Call.id')),
                    ),
            ));
            if (empty($this->data) or $this->data['Property']['busqueda'] == "") {
                $this->set('Properties', $this->paginate(array('Property.proyect_id' => $proyect_id)));
            } else {
                $this->set('Properties', $this->paginate(array('Property.proyect_id' => $proyect_id, 'or' => array('Property.nombre LIKE' => "%" . $this->data['Property']['busqueda'] . "%", 'Property.matricula LIKE ' => "%" . $this->data['Property']['busqueda'] . "%", 'Property.cedula_catastral LIKE ' => "%" . $this->data['Property']['busqueda'] . "%"))));
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    public function visit($property_id) {
        $this->set('call_id', $this->Session->read('call_id'));
        if (empty($this->data)) {
            $this->data = $this->Property->find("first", array("conditions" => array("Property.id" => $property_id)));
        } else {
            if ($this->Property->save($this->data)) {
                $this->Session->setFlash('Predio editado  correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Properties', 'action' => 'resolution_index', $this->data['Property']['id']));
            }
        }
    }

    public function identification_index($property_id) {
        $this->set('property_id', $property_id);
        $this->paginate = array('Property' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('City.name', 'Departament.name', 'Property.vereda', 'Property.corregimiento', 'Property.numero_parcelas', 'Property.numero_habitantes', 'Property.nombre_resguardo', 'Property.nombre_consejo', 'Property.city_id', 'Property.departament_id', 'Property.proyect_id', 'Property.nombre', 'Property.matricula', 'Property.extension', 'Property.georeferencia1', 'Property.georeferencia2', 'Property.georeferencia3', 'Property.georeferencia4', 'Property.georeferencia5', 'Property.georeferencia6', 'Property.id')));
        $this->set('Properties', $this->paginate(array('Property.id' => $property_id)));
    }

    public function edit_identification($property_id) {
        $this->layout = "ajax";
        $this->Property->recursive = -1;
        $this->set('departaments', $this->Property->Departament->find('list'));
        $this->set('cities', $this->Property->Departament->City->find('list'));
        App::Import('model', 'Proyect');
        $Proyect = new Proyect();
        $Proyect->recursive = -1;
        $this->set('proyects', $Proyect->find('list', array('fields' => array('Proyect.id', 'Proyect.codigo'))));
        if (empty($this->data)) {
            $this->data = $this->Property->find('first', array('recursive' => -1, 'conditions' => array('Property.id' => $property_id), 'fields' => array('Property.vereda', 'Property.corregimiento', 'Property.numero_parcelas', 'Property.numero_habitantes', 'Property.nombre_resguardo', 'Property.nombre_consejo', 'Property.city_id', 'Property.departament_id', 'Property.proyect_id', 'Property.nombre', 'Property.matricula', 'Property.extension', 'Property.georeferencia1', 'Property.georeferencia2', 'Property.georeferencia3', 'Property.georeferencia4', 'Property.georeferencia5', 'Property.georeferencia6', 'Property.id')));
            $this->set('cities', $this->Property->City->find('list', array('conditions' => array('City.departament_id' => $this->data['Property']['departament_id']))));
        } else {
            if ($this->Property->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Properties', 'action' => 'identification_index', $property_id));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_custom');
                $this->redirect(array('controller' => 'Properties', 'action' => 'baselines_index', $property_id));
            }
        }
    }

    public function edit_acopio($property_id, $tipo) {
        $this->layout = "ajax";
        $this->Property->recursive = -1;
        $this->set('tipo', $tipo);
        if (empty($this->data)) {

            if ($tipo == 1) {
                $this->data = $this->Property->find('first', array('conditions' => array('Property.id' => $property_id), 'fields' => array('Property.centro_acopio', 'Property.tiempo_centro_acopio', 'Property.id', 'Property.proyect_id')));
            }
            if ($tipo == 2) {
                $this->data = $this->Property->find('first', array(
                    'conditions' => array('Property.id' => $property_id),
                    'fields' => array('Property.precipitacion_promedio', 'Property.luminosidad_promedio', 'Property.temperatura_promedio', 'Property.altura_promedio', 'Property.piso', 'Property.lluvias', 'Property.id', 'Property.proyect_id')
                ));
            }
            if ($tipo == 3) {
                $this->data = $this->Property->find('first', array(
                    'conditions' => array('Property.id' => $property_id),
                    'fields' => array('Property.observacion_linea_base', 'Property.id', 'Property.proyect_id')
                ));
            }
        } else {

            if ($this->Property->save($this->data)) {



                $this->loadModel('Proyect');
                $codigo = $this->Proyect->field('codigo', array('Proyect.id' => $this->data['Property']['proyect_id']));
                $proyect_id = $this->data['Property']['proyect_id'];
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                $nombreArchivo = "Encuesta_predio_$property_id.pdf";
                $rutaArchivo.= "/" . $nombreArchivo;
                $exito = 1;
                if (isset($this->data['Property']['archivo_encuesta']['tmp_name'])) {
                    if (move_uploaded_file($this->data['Property']['archivo_encuesta']['tmp_name'], $rutaArchivo)) {
                        $this->Property->id = $property_id;
                        $this->Property->saveField('adjunto_encuesta', $nombreArchivo);
                    } else {
                        $exito = 0;
                    }
                }

                if ($exito) {
                    $this->Session->setFlash('Registro Editado correctamente con archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'Properties', 'action' => 'acopio_index', $property_id, $tipo));
                } else {
                    $this->Session->setFlash('error adjuntando archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'Properties', 'action' => 'acopio_index', $property_id, $tipo));
                }
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_custom');
                $this->redirect(array('controller' => 'Properties', 'action' => 'acopio_index', $property_id, $tipo));
            }
        }
    }

    public function acopio_index($property_id, $tipo) {
        $this->set('property_id', $property_id);
        $this->set('tipo', $tipo);
        if ($tipo == 1) {
            $this->paginate = array('Property' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('Property.centro_acopio', 'Property.tiempo_centro_acopio', 'Property.id', 'Property.proyect_id')));
        }
        if ($tipo == 2) {
            $this->paginate = array('Property' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('Property.precipitacion_promedio', 'Property.luminosidad_promedio', 'Property.temperatura_promedio', 'Property.altura_promedio', 'Property.piso', 'Property.lluvias', 'Property.id', 'Property.proyect_id')));
        }
        if ($tipo == 3) {

            $this->paginate = array('Property' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('Property.observacion_linea_base', 'Property.id', 'Property.proyect_id')));
        }

        $this->set('Properties', $this->paginate(array('Property.id' => $property_id)));
    }

    public function phase0_report() {
        $this->layout = 'csv';
        ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
        //create a file
        $filename = "Reporte_Fase_0_" . date("Y.m.d") . ".csv";
        $csv_file = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        App::import('model', 'PropertyRequirement');
        $PropertyRequirement = new PropertyRequirement();
        $header_row = array("Departamento", "Municipio", "Corregimiento / vereda", "Nombre del predio o Disrito de Riego", "No. Resolución", "Fecha resolución", "Tipo Adquisición y/o Proceso misional", "área total", "Area productíva", "UAF (Ha)", "No. Campesinos", "No Desplazados", "No. Negritudes", "No. Indígenas", "No. Madres cabeza de familia", "No. Otros", "No. Total familias", "Número matrícula", "Oficina de Registro", 'Archivo matrícula inmobiliaria', 'Cruce ambiental', 'Actividad productiva actual', 'Nombre de la organización Si existe', 'No. Flias beneficiarias actual en el predio *');

        $predios = $this->Property->find('all', array(
            'recursive' => -1,
            'fields' => array('City.name', 'Departament.name', 'Property.id', 'Property.nombre', 'Property.id', 'Property.matricula', 'Property.cedula_catastral', 'Property.area_total_ha', 'Property.area_total_m', 'Property.area_productiva', 'Property.corregimiento', 'Property.vereda', 'Property.origen', 'Property.uaf', 'Property.familias_campesinas', 'Property.familias_desplazadas', 'Property.familias_negritudes', 'Property.familias_indigenas', 'Property.madres_cabeza', 'Property.otras_familias', 'Property.oficina_registro', 'Property.total_familias_beneficiarios', "Property.ruta_matricula", 'Property.actividad_productiva', 'Property.total_familias_beneficiarios', 'Property.nombre_organizacion'),
            'joins' => array(array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Property.city_id')), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id'))),
            'conditions' => array('Property.proyect_id' => 0)
        ));
        $newRow = array();

        foreach ($header_row as $a) {
            $newRow[] = iconv('UTF-8', 'Windows-1252', $a);
        }

        fputcsv($csv_file, $newRow, ';', '"');
        foreach ($predios as $predio) {
            $ambiemtal = "";
            $requisitos = $PropertyRequirement->find('all', array('conditions' => array('PropertyRequirement.property_id' => $predio['Property']['id'])));
            foreach ($requisitos as $requisito) {
                $cal = "Sin registro";
                if (!is_null($requisito['PropertyRequirement']['calificacion'])) {
                    $cal = $requisito['PropertyRequirement']['calificacion'];
                }
                $ambiemtal.=$requisito['InitialRequirement']['texto'] . ": " . $cal . "\n";
            }
            $total_familias = $predio['Property']['familias_campesinas'] + $predio['Property']['familias_desplazadas'] + $predio['Property']['familias_negritudes'] + $predio['Property']['familias_indigenas'] + $predio['Property']['madres_cabeza'] + $predio['Property']['otras_familias'];
            $row = array($predio['Departament']['name'], $predio['City']['name'], $predio['Property']['corregimiento'] . " " . $predio['Property']['vereda'], $predio['Property']['nombre'], "", "", $predio['Property']['origen'], $predio['Property']['area_total_ha'] . "," . $predio['Property']['area_total_m'], $predio['Property']['area_productiva'], number_format($predio['Property']['uaf'], 4, ",", "."), $predio['Property']['familias_campesinas'], $predio['Property']['familias_desplazadas'], $predio['Property']['familias_negritudes'], $predio['Property']['familias_indigenas'], $predio['Property']['madres_cabeza'], $predio['Property']['otras_familias'], $total_familias, $predio['Property']['matricula'], $predio['Property']['oficina_registro'], $predio['Property']['ruta_matricula'], $ambiemtal, $predio['Property']['actividad_productiva'], $predio['Property']['nombre_organizacion'], $predio['Property']['total_familias_beneficiarios']);
            $fila = array();
            foreach ($row as $a) {
                $fila[] = iconv('UTF-8', 'Windows-1252', $a);
            }

            fputcsv($csv_file, $fila, ';', '"');
        }

        fclose($csv_file);
    }

    public function requirements_report() {
        $this->layout = "csv";
        ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
        //create a file
        $filename = "Reporte_predios_" . date("Y.m.d") . ".csv";
        $csv_file = fopen('php://output', 'w');
        $this->response->type('application/csv');
        //$this->response->download($filename);
        header('Content-Disposition: attachment; charset=cp1252;filename="' . $filename . '"');

        $cabecera = array();
        $sql = "SELECT Conv.nombre As Convocatoria,pr.codigo AS Código , e.name As Departamento, d.name As municipio, a.nombre As predio, c.texto as Requisito, b.calificacion As calificacion
                FROM properties AS a
                LEFT JOIN property_requirements AS b ON b.property_id = a.id
                LEFT JOIN initial_requirements AS c ON c.id = b.initial_requirement_id
                LEFT JOIN cities AS d ON a.city_id = d.id
                LEFT JOIN departaments AS e ON d.departament_id = e.id
                LEFT JOIN proyects pr on pr.id=a.proyect_id
                LEFT JOIN calls Conv ON a.call_id=Conv.id
                WHERE 1=1 ORDER BY Conv.id DESC ,e.name ASC ,d.id DESC ";
        $flag = 0;
        $resultados = $this->Property->query($sql);
        foreach ($resultados as $key => $value) {
            $cabecera = array();
            $datos = array();
            foreach ($value as $key1 => $value1) {

                foreach ($value1 as $key2 => $value2) {
                    $cabecera[] = utf8_decode($key2); //iconv('UTF-8', 'Windows-1252', $key2);;
                    $datos[] = utf8_decode($value2); //iconv('UTF-8', 'Windows-1252', $value2);
                }
            }

            if ($flag == 0) {
                fputcsv($csv_file, $cabecera, ';', '"');
                $flag = 1;
            }
            fputcsv($csv_file, $datos, ';', '"');
        }
        //var_dump($cabecera);

        fclose($csv_file);
        $this->autoRender = false;
    }

    public function total_report() {
        $this->layout = "csv";
        ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
        //create a file
        $filename = "Reporte_predios_" . date("Y.m.d") . ".csv";
        $csv_file = fopen('php://output', 'w');
        $this->response->type('application/csv');

        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $cabecera = array();
        $sql = "SELECT Conv.nombre AS Convocatoria, pr.codigo AS código, c.name AS Departmento, b.name AS Municipio, a.nombre AS predio, a.concepto_fase0, a.calificacion_fase0,
                a.georeferencia1 AS latitudG, a.georeferencia2 AS latitudM, a.georeferencia3 AS latitudS, a.georeferencia4 AS longitudG, a.georeferencia5 AS longitudM, a.georeferencia6 AS longitudS
                FROM properties AS a
                LEFT JOIN cities AS b ON a.city_id = b.id
                LEFT JOIN departaments AS c ON b.departament_id = c.id
                LEFT JOIN proyects pr ON pr.id = a.proyect_id
                LEFT JOIN calls Conv ON a.call_id = Conv.id
                WHERE 1=1 
                ORDER BY Conv.id DESC  , c.name ASC , b.id DESC";
        $flag = 0;
        $resultados = $this->Property->query($sql);
        foreach ($resultados as $key => $value) {
            $cabecera = array();
            $datos = array();
            foreach ($value as $key1 => $value1) {

                foreach ($value1 as $key2 => $value2) {
                    $cabecera[] = utf8_decode($key2);
                    $datos[] = utf8_decode($value2);
                }
            }

            if ($flag == 0) {
                fputcsv($csv_file, $cabecera, ';', '"');
                $flag = 1;
            }
            fputcsv($csv_file, $datos, ';', '"');
        }
        //var_dump($cabecera);

        fclose($csv_file);
        $this->autoRender = false;
    }

    public function unregister($property_id) {
        $this->Property->id = $property_id;
        if ($this->Property->saveField('proyect_id', 0)) {
            $this->Session->setFlash('El predio pasó a fase 0', 'flash_custom');
            $this->redirect(array('controller' => 'Properties', 'action' => 'resolution_index'));
        } else {
            $this->Session->setFlash('Error', 'flash_custom');
            $this->redirect(array('controller' => 'Properties', 'action' => 'resolution_index'));
        }
        $this->autoRender = false;
    }

    public function open_phase0($property_id) {
        $this->Property->id = $property_id;
        if ($this->Property->saveField('calificacion_fase0', 0)) {
            $this->Session->setFlash('La evaluacion ha sido abierta', 'flash_custom');
            $this->redirect(array('controller' => 'Properties', 'action' => 'phase0_evaluation', $property_id, 0));
        } else {
            $this->Session->setFlash('Error', 'flash_custom');
            $this->redirect(array('controller' => 'Properties', 'action' => 'resolution_index'));
        }
        $this->autoRender = false;
    }

}

?>
