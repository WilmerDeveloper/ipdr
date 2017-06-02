<?php

Class ProyectsController extends AppController {

    public $name = 'Proyects';

    function add() {
        $this->layout = "ajax";
        $this->set('departaments', $this->Proyect->Departament->find('list'));
        App::import("Model", "Call");
        $Call = new Call();
        $Call->recursive = -1;
        $this->set('calls', $Call->find('list', array('fields' => array('Call.id', 'Call.nombre'), 'order' => array('Call.id DESC'))));

        if (empty($this->data)) {
            
        } else {
            if ($this->Proyect->find('first', array('conditions' => array('Proyect.call_id' => $this->request->data['Proyect']['call_id'], 'Proyect.codigo' => strtoupper($this->request->data['Proyect']['codigo']))))) {

                $this->Session->setFlash('Ya existe un proyecto con ese código intente de nuevo', 'flash_custom');
                $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
            }
            $this->request->data['Proyect']['codigo'] = strtoupper($this->request->data['Proyect']['codigo']);
            if ($this->Proyect->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($proyect_id = null) {

        $this->Set('group_id', $this->Auth->user('group_id'));
        if (!isset($proyect_id))
            $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {

            $this->set('departaments', $this->Proyect->Departament->find('list'));
            $this->Proyect->recursive = -1;
            App::import("Model", "Call");
            $Call = new Call();
            $Call->recursive = -1;
            $this->set('calls', $Call->find('list', array('fields' => array('Call.id', 'Call.nombre'), 'order' => array('Call.id DESC'))));

            if (empty($this->data)) {
                $this->set('cities', $this->Proyect->City->find('list'));
                $this->data = $this->Proyect->find('first', array('conditions' => array('Proyect.id' => $proyect_id), 'joins' => array(array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Proyect.city_id')), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')), array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Call.id=Proyect.call_id'))), 'fields' => array("Proyect.*", 'Departament.id')));
                $this->request->data['Proyect']['departament.id'] = $this->request->data['Departament']['id'];
            } else {

                if ($this->Proyect->save($this->data)) {
                    $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
                } else {
                    $this->Session->setFlash('Error editando datos');
                }
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    function index() {
        App::Import('model', 'Branch');
        $Branch = new Branch();
        $regional = $Branch->find('first', array('fields' => array('Branch.departament_id'), 'recursive' => -1, 'conditions' => array('Branch.id' => $this->Auth->user('branch_id'))));

        if (empty($this->data) or $this->data['Proyect']['busqueda'] == "") {
            if ($this->Auth->user('group_id') == 4) {
                $this->paginate = array('Proyect' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50, 'joins' => array(array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Proyect.city_id')), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')), array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Call.id=Proyect.call_id')),), 'order' => array('Call.id' => 'DESC', 'Departament.name' => 'ASC', 'Proyect.codigo' => 'ASC'), 'fields' => array('Proyect.id', 'Proyect.codigo', 'Proyect.valor', 'Proyect.id', 'City.name', 'Call.nombre', 'Departament.name')));
                $this->set('Proyects', $this->paginate(array('Proyect.departament_id' => $regional['Branch']['departament_id'])));
            } else {
                $this->paginate = array('Proyect' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50, 'joins' => array(array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Proyect.city_id')), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')), array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Call.id=Proyect.call_id')),), 'order' => array('Call.id' => 'DESC'), 'fields' => array('Proyect.id', 'Proyect.codigo', 'Proyect.valor', 'Proyect.id', 'City.name', 'Call.nombre', 'Departament.name')));
                $this->set('Proyects', $this->paginate());
            }
        } else {

            if ($this->Auth->user('group_id') == 4 or $this->Auth->user('group_id') == 17) {
                $this->paginate = array('Proyect' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50, 'joins' => array(array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Proyect.city_id')), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')), array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Call.id=Proyect.call_id')),), 'order' => array('Call.id' => 'DESC'), 'fields' => array('Proyect.id', 'Proyect.codigo', 'Proyect.valor', 'Proyect.id', 'City.name', 'Call.nombre', 'Departament.name')));
                $this->set('Proyects', $this->paginate(array('Proyect.departament_id' => $regional['Branch']['departament_id'], 'or' => array('Proyect.codigo LIKE' => "%" . $this->data['Proyect']['busqueda'] . "%", 'Call.nombre LIKE ' => "%" . $this->data['Proyect']['busqueda'] . "%", 'City.name LIKE ' => "%" . $this->data['Proyect']['busqueda'] . "%", 'Departament.name LIKE ' => "%" . $this->data['Proyect']['busqueda'] . "%"))));
            } else {
                $this->paginate = array('Proyect' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50, 'joins' => array(array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Proyect.city_id')), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')), array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Call.id=Proyect.call_id')),), 'order' => array('Call.id' => 'DESC'), 'fields' => array('Proyect.id', 'Proyect.codigo', 'Proyect.valor', 'Proyect.id', 'City.name', 'Call.nombre', 'Departament.name')));
                $this->set('Proyects', $this->paginate(array('or' => array('Proyect.codigo LIKE' => "%" . $this->data['Proyect']['busqueda'] . "%", 'Call.nombre LIKE ' => "%" . $this->data['Proyect']['busqueda'] . "%", 'City.name LIKE ' => "%" . $this->data['Proyect']['busqueda'] . "%", 'Departament.name LIKE ' => "%" . $this->data['Proyect']['busqueda'] . "%"))));
            }
        }
    }

    function select_proyect() {
        $this->pageTitle = 'Convocatorias 2011';
        $this->disableCache();
        $this->layout = "ajax";

        $codigo = strtoupper($this->data['Proyect']['codigo']);

        $this->Proyect->recursive = -1;

        if (!empty($this->data)) {

            if ($this->Auth->user('group_id') == 8) {

                if ($proyecto = $this->Proyect->find('first', array('conditions' => array('Proyect.codigo' => $codigo, 'Proyect.call_id' => $this->data['Proyect']['call_id']), 'fields' => array('Proyect.call_id', 'Proyect.codigo', 'Proyect.id', 'Proyect.tipo', 'Proyect.cerrado')))) {
                    App::Import('model', 'UserProyect');
                    $UserProyect = new UserProyect();
                    $cont = $UserProyect->find('count', array('recursive' => -1, 'conditions' => array('UserProyect.user_id' => $this->Auth->user('id'), 'UserProyect.proyect_id' => $proyecto['Proyect']['id'])));
                    if ($cont == 0) {
                        $this->Session->write('cod', "");
                        $this->Session->write('proyect_id', "");
                        $this->Session->write('call_id', "");
                        $this->Session->write('estado', 0);
                        $this->Session->write('call_nombre', "");
                        $this->Session->write('cerrado', "");
                        $this->set("respuesta", "<h2>NO TIENE ASIGNADO EL PROYECTO $codigo</h2> ");
                    } else {
                        $this->Session->write('codigo', "$codigo");
                        $this->Session->write('call_id', $this->data['Proyect']['call_id']);
                        $this->Session->write('proyect_id', $proyecto['Proyect']['id']);
                        $this->Session->write('proyect_tipo', $proyecto['Proyect']['tipo']);
                        $this->Session->write('cerrado', $proyecto['Proyect']['cerrado']);
                        $this->set("respuesta", "<h1>PROYECTO ACTIVO:<br>  $codigo</h1>");
                        $this->set("proyecto", $this->Session->read('cod'));
                    }
                } else {
                    $this->Session->write('codigo', "");
                    $this->Session->write('proyect_id', "");
                    $this->Session->write('candidate_id', "");
                    $this->Session->write('call_id', "");
                    $this->Session->write('proyect_tipo', "");
                    $this->Session->write('cerrado', "");
                    $this->set("respuesta", "<h1>No ha seleccionado proyecto</h1>");
                    $this->Session->setFlash("No existe proyecto con codigo '$codigo'", 'flash_custom');
                }
            } else {

                if ($proyecto = $this->Proyect->find('first', array('conditions' => array('Proyect.codigo' => $codigo, 'Proyect.call_id' => $this->data['Proyect']['call_id']), 'fields' => array('Proyect.call_id', 'Proyect.codigo', 'Proyect.id', 'Proyect.tipo', 'Proyect.cerrado')))) {
                    $this->Session->write('codigo', "$codigo");
                    $this->Session->write('call_id', $this->data['Proyect']['call_id']);
                    $this->Session->write('proyect_id', $proyecto['Proyect']['id']);
                    $this->Session->write('proyect_tipo', $proyecto['Proyect']['tipo']);
                    $this->Session->write('cerrado', $proyecto['Proyect']['cerrado']);

                    //Se busca si el proyecto tiene un desembolso calificado como CUMPLE
                    $this->loadModel('Payment');

                    $bloquear = $this->Payment->find('count', array('conditions' => array('Payment.proyect_id' => $proyecto['Proyect']['id'], 'Payment.calificacion_global' => 'Cumple')));

                    if ($bloquear > 0) {
                        $this->Session->write('bloqueado', 1);
                    } else {
                        $this->Session->write('bloqueado', 0);
                    }
                    $this->set("respuesta", "<h1>PROYECTO ACTIVO:<br>$codigo</h1>");
                } else {
                    $this->Session->write('codigo', "");
                    $this->Session->write('proyect_id', "");
                    $this->Session->write('candidate_id', "");
                    $this->Session->write('call_id', "");
                    $this->Session->write('proyect_tipo', "");
                    $this->Session->write('cerrado', "");
                    $this->set("respuesta", "<h1>No ha seleccionado proyecto</h1>");
                    $this->Session->setFlash("No existe proyecto con codigo '$codigo'", 'flash_custom');
                    //  $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
                }
            }
        }
    }

    function select() {
        $this->layout = "ajax";
        $this->set('cities', $this->Proyect->City->find('list', array(
                    'order' => array('name' => 'ASC'),
                    'conditions' => array('City.departament_id' => $this->data['Proyect']['departament_id'])
                        )
        ));
    }

    function total_index() {
        if (empty($this->data)) {
            $joins = array(array('table' => 'calls', 'alias' => 'Call', 'conditions' => array('Call.id=Proyect.call_id')), array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Property.proyect_id=Proyect.id')));
            $this->paginate = array('Proyect' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50, 'joins' => $joins, 'fields' => array('Proyect.id', 'Proyect.codigo', 'Proyect.valor', 'Proyect.id', 'Property.nombre', 'Call.nombre', 'Property.id')));
            $this->set('Proyects', $this->paginate(array('Proyect.call_id' => 2)));
        }
    }

    function add_proyect() {
        App::Import('model', 'Departament');
        $Departament = new Departament();
        $this->set('departaments', $Departament->find('list'));
        App::import("Model", "Call");
        $Call = new Call();
        $Call->recursive = -1;
        $this->set('calls', $Call->find('list', array('fields' => array('Call.id', 'Call.nombre'), 'order' => array('Call.id' => 'DESC'))));
        if (empty($this->data)) {
            
        } else {
            if ($this->Proyect->save($this->data['Proyect'])) {
                $this->request->data['Property']['proyect_id'] = $this->Proyect->getLastInsertId();


                APP::Import('model', 'Property');
                $Property = new Property();

                if ($Property->save($this->request->data['Property'])) {
                    $this->Session->setFlash("Proyecto registrado correctamente", 'flash_custom');
                    $this->redirect(array('controller' => 'Proyects', 'action' => 'total_index'));
                } else {
                    $this->Session->setFlash("ERROR", 'flash_custom');
                }
            }
        }
    }

    function edit_proyect($proyect_id) {
        $this->layout = "ajax";


        if (empty($this->data)) {
            App::Import('model', 'Branch');
            $this->loadModel('City');
            $Branch = new Branch();
            $regional = $Branch->find('first', array('fields' => array('Branch.departament_id'), 'recursive' => -1, 'conditions' => array('Branch.id' => $this->Auth->user('branch_id'))));

            $city_id = $this->Proyect->field('city_id', array('Proyect.id' => $proyect_id));
            $dep_id = $this->City->field('departament_id', array('City.id' => $city_id));


            $this->set('Properties', $this->Proyect->Property->find('all', array('recursive' => -1, 'conditions' => array('Property.proyect_id' => 0, 'Departament.id' => $dep_id), 'joins' => array(array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('City.id=Property.city_id')), array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => array('Property.call_id=Call.id')), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id'))), 'fields' => array("Property.id", 'Call.nombre', 'Departament.name', 'City.name', 'Property.nombre', 'Property.calificacion_fase0', 'Property.matricula'), 'order' => array('Departament.id' => 'ASC', 'City.id' => 'ASC', 'Property.calificacion_fase0' => 'ASC'))));

            $this->data = $this->Proyect->find('first', array('recursive' => -1, 'conditions' => array('Proyect.id' => $proyect_id), 'fields' => array('Proyect.id', 'Proyect.codigo')));
        } else {

            $this->Proyect->Property->recursive = -1;
            foreach ($this->data['lista'] as $key => $value) {

                $datos = array('Property' => array(
                        'id' => $value,
                        'proyect_id' => $this->data['Proyect']['id'],
                        'sincronizado' => 0
                ));


                $this->Proyect->Property->save($datos);
            }
            $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
        }
    }

    function search() {
        if (!empty($this->data)) {
            App::Import('model', 'Beneficiary');
            $Beneficiary = new Beneficiary();
            $Beneficiary->recursive = -1;
            $ide = $this->data['Proyect']['busqueda'];
            if ($ide != "") {

                $resultados = $Beneficiary->find('all', array('conditions' => array(
                        "or" => array(
                            "Beneficiary.numero_identificacion LIKE" => "%$ide%",
                            "Beneficiary.nombres LIKE" => "%$ide%",
                            " (Beneficiary.nombres+' '+Beneficiary.primer_apellido) LIKE" => "%$ide%",
                            " (Beneficiary.nombres+' '+Beneficiary.primer_apellido+' '+Beneficiary.segundo_apellido) LIKE" => "%$ide%",
                            "(Beneficiary.nombres+' '+Beneficiary.primer_apellido) LIKE" => "%$ide%",
                            "Beneficiary.primer_apellido LIKE" => "%$ide%",
                            "Beneficiary.segundo_apellido LIKE" => "%$ide%",
                            "Beneficiary.nombres LIKE" => "%$ide%",
                        )
                    ),
                    'fields' => array('Proyect.codigo', 'Property.nombre', 'Beneficiary.tipo_identificacion', 'Beneficiary.numero_identificacion', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido'),
                    'joins' => array(
                        array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => 'Property.id=Beneficiary.property_id'),
                        array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Property.proyect_id')
                    ),
                        )
                );

                $predios = $this->Proyect->Property->find('all', array('conditions' => array(
                        "or" => array(
                            "Property.nombre LIKE" => "%$ide%",
                            "Property.matricula LIKE" => "%$ide%",
                            "Property.cedula_catastral LIKE" => "%$ide%",
                        )
                    ),
                    'recursive' => -1,
                    'fields' => array('Proyect.codigo', 'Property.nombre', 'Property.matricula', 'Property.cedula_catastral', 'Property.vereda', 'City.name', 'Departament.name'),
                    'joins' => array(
                        array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Property.proyect_id'),
                        array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => 'Property.city_id=City.id'),
                        array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => 'City.departament_id=Departament.id'),
                    ),
                ));

                //Busqueda de familiares

                $familiares = $Beneficiary->Family->find('all', array('conditions' => array(
                        "or" => array(
                            "Family.numero_identificacion LIKE" => "%$ide%",
                            "Family.nombres LIKE" => "%$ide%",
                            "(Family.nombres+' '+Family.primer_apellido) LIKE" => "%$ide%",
                            "(Family.nombres+' '+Family.primer_apellido+' '+Family.segundo_apellido) LIKE" => "%$ide%",
                            "(Family.nombres+' '+Family.segundo_apellido) LIKE" => "%$ide%",
                        )
                    ),
                    'recursive' => -1,
                    'fields' => array('Beneficiary.numero_identificacion', 'Proyect.codigo', 'Property.nombre', 'Family.tipo_identificacion', 'Family.numero_identificacion', 'Family.nombres', 'Family.primer_apellido', 'Family.segundo_apellido'),
                    'joins' => array(
                        array('table' => 'beneficiaries', 'alias' => 'Beneficiary', 'type' => 'left', 'conditions' => 'Beneficiary.id=Family.beneficiary_id'),
                        array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => 'Property.id=Beneficiary.property_id'),
                        array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Property.proyect_id')
                    ),
                ));


                $this->set('resultados', $resultados);
                $this->set('predios', $predios);
                $this->set('familiares', $familiares);
                //$this->set('propietarios', $propietarios);
            }
        }
    }

    function total_report() {
        $this->layout = "ajax";
        ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
        //create a file
        $filename = "consolidado" . date("Y.m.d") . ".csv";
        $csv_file = fopen('php://output', 'w');
        $this->response->type('application/csv');


        header('Content-Disposition: attachment; filename="' . $filename . '"');

        if ($this->Auth->user('group_id') != 13) {
            $Proyectos = $this->Proyect->find('all', array(
                'recursive' => -1,
                'joins' => array(
                    array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => 'Call.id=Proyect.Call_id'),
                    array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => 'City.id=Proyect.City_id'),
                    array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => 'Departament.id=City.departament_id'),
                ),
                'fields' => array('Call.nombre', 'Proyect.codigo', 'Proyect.id', 'Departament.name', 'City.name'),
                'order' => array('Call.id' => 'DESC', 'Departament.name' => 'DESC', 'City.name' => 'DESC'),
            ));
        } else {
            $Proyectos = $this->Proyect->find('all', array(
                'recursive' => -1,
                'joins' => array(
                    array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => 'Call.id=Proyect.Call_id'),
                    array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => 'City.id=Proyect.City_id'),
                    array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => 'Departament.id=City.departament_id'),
                ),
                'conditions' => array('Call.id' => 3),
                'fields' => array('Call.nombre', 'Proyect.codigo', 'Proyect.id', 'Departament.name', 'City.name', 'Call.id'),
                'order' => array('Call.id' => 'DESC', 'Departament.name' => 'DESC', 'City.name' => 'DESC'),
            ));
        }

        $cabecera = array('Convocatoria', 'Proyecto', 'Departamento', 'Municipio', 'Número Resolución', 'Fecha resolución', 'familias_campesinas', 'familias_desplazadas', 'familias_indigenas', 'familias_negritudes', 'familias_mujer_cabeza', 'familias_rom', 'Valor total', 'Valor contrapartidas certificadas', 'Recursos propios', 'Valor cofinanciación', 'Valor desembolsado', 'Formulador', 'Evaluador', 'Formulacion', 'Evaluacion', 'Resolución generada', 'Resolución cargada', 'Desembolsado totalmente');
        fputcsv($csv_file, $cabecera, ';', '"');
        foreach ($Proyectos as $Proyecto) {
            $fila = array();
            $fila[] = $Proyecto['Call']['nombre'];
            $fila[] = $Proyecto['Proyect']['codigo'];
            $fila[] = $Proyecto['Departament']['name'];
            $fila[] = $Proyecto['City']['name'];

            $this->loadModel('Resolution');
            $resolucion = 'No';
            $numeroResolucion = '';
            $idResolucion = '';
            $resolucionCargada = 'No';
            if ($Resolucion = $this->Resolution->find('first', array('conditions' => array('Resolution.proyect_id' => $Proyecto['Proyect']['id'], 'Resolution.tipo' => 'ADJUDICACIÓN'), 'order' => array('Resolution.id' => 'DESC')))) {
                $resolucion = 'Si';
                $numeroResolucion = $Resolucion['Resolution']['numero'];
                $fechaResolucion = $Resolucion['Resolution']['fecha'];
                $idResolucion = $Resolucion['Resolution']['id'];

                //busco si la resolución esta cargada
                $path = WWW_ROOT . DS . 'files' . DS . $Proyecto['Proyect']['id'] . "-" . $Proyecto['Proyect']['codigo'] . DS . "SoporteResolucion-" . $Proyecto['Proyect']['codigo'] . "-" . $idResolucion . '.pdf';

                if (file_exists($path)) {
                    $resolucionCargada = 'SI';
                }
            }

            $fila[] = $numeroResolucion;
            $fila[] = $fechaResolucion;
            $this->loadModel('Formulation');
            $formulacion = 'No';
            $formulador = '';

            $familias_campesinas = 0;
            $familias_desplazadas = 0;
            $familias_indigenas = 0;
            $familias_negritudes = 0;
            $familias_mujer_cabeza = 0;
            $familias_rom = 0;

            if ($Formulacion = $this->Formulation->find('first', array(
                'recursive' => -1,
                'conditions' => array('Formulation.proyect_id' => $Proyecto['Proyect']['id']),
                'order' => array('Formulation.id' => 'DESC'),
                'fields' => array('User.nombre', 'User.id', 'User.primer_apellido', 'Formulation.*'),
                'joins' => array(
                    array('table' => 'users', 'alias' => 'User', 'type' => 'left', 'conditions' => 'Formulation.user_id=User.id')
                )
                    )
                    )
            ) {

                $formulacion = 'Si';
                $formulador = $Formulacion['User']['nombre'] . " " . $Formulacion['User']['primer_apellido'];
                $familias_campesinas = $Formulacion['Formulation']['familias_campesinas'];
                $familias_desplazadas = $Formulacion['Formulation']['familias_desplazadas'];
                $familias_indigenas = $Formulacion['Formulation']['familias_indigenas'];
                $familias_negritudes = $Formulacion['Formulation']['familias_negritudes'];
                $familias_mujer_cabeza = $Formulacion['Formulation']['familias_mujer_cabeza'];
                $familias_rom = $Formulacion['Formulation']['familias_rom'];
            }


            $fila[] = $familias_campesinas;
            $fila[] = $familias_desplazadas;
            $fila[] = $familias_indigenas;
            $fila[] = $familias_negritudes;
            $fila[] = $familias_mujer_cabeza;
            $fila[] = $familias_rom;



            $this->loadModel('InitialEvaluation');
            $evaluacion = 'No';
            $evaluador = '';
            if ($Evaluacion = $this->InitialEvaluation->find('first', array(
                'recursive' => -1,
                'conditions' => array('InitialEvaluation.proyect_id' => $Proyecto['Proyect']['id']),
                'order' => array('InitialEvaluation.id' => 'DESC'),
                'fields' => array('User.nombre', 'User.id', 'User.primer_apellido', 'InitialEvaluation.id', 'InitialEvaluation.monto_solicitado', 'InitialEvaluation.valor_total', 'InitialEvaluation.contraprtidas_propias', 'InitialEvaluation.certificadas'),
                'joins' => array(
                    array('table' => 'users', 'alias' => 'User', 'type' => 'left', 'conditions' => 'InitialEvaluation.user_id=User.id')
                )
                    )
                    )
            ) {
                $evaluacion = 'Si';
                $evaluador = $Evaluacion['User']['nombre'] . " " . $Evaluacion['User']['primer_apellido'];
            }

            $fila[] = number_format($Evaluacion['InitialEvaluation']['valor_total'], 0, ',', '.');
            $fila[] = number_format($Evaluacion['InitialEvaluation']['certificadas'], 0, ',', '.');
            $fila[] = number_format($Evaluacion['InitialEvaluation']['contraprtidas_propias'], 0, ',', '.');


            $this->loadModel('Payment');

            $pagado = 0;

            if ($Pagos = $this->Payment->find('all', array(
                'recursive' => -1,
                'conditions' => array('Payment.proyect_id' => $Proyecto['Proyect']['id'], "NOT" => array('Payment.fecha_radicacion' => null)),
                'order' => array('Payment.id' => 'DESC'),
                'fields' => array('Payment.valor_desembolsado'),
                    )
                    )
            ) {

                foreach ($Pagos as $Pago) {
                    $pagado+=$Pago['Payment']['valor_desembolsado'];
                }
            }
            $pago = 'No';


            if (($pagado == $Evaluacion['InitialEvaluation']['monto_solicitado']) and $pagado != 0) {
                $pago = 'Si';
            }

            $fila[] = number_format($Evaluacion['InitialEvaluation']['monto_solicitado'], 0, ',', '.');
            $fila[] = number_format($pagado, 0, ',', '.');
            $fila[] = $formulador;
            $fila[] = $evaluador;
            $fila[] = $formulacion;
            $fila[] = $evaluacion;
            $fila[] = $resolucion;
            $fila[] = $resolucionCargada;
            $fila[] = $pago;
            fputcsv($csv_file, $fila, ';', '"');
        }


        fclose($csv_file);
        $this->autoRender = false;
    }

    public function detalle_report() {
        $this->layout = "ajax";
        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
        //create a file
        $filename = "Reporte_detalle_IPDR_" . date("Y.m.d") . ".csv";
        $csv_file = fopen('php://output', 'w');
        $this->response->type('application/csv');

        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $header_row = array("DT", "Convocatoria", "Código Proyecto", "Identificación o  Código del Predio", "Código Sexo",
            "Tipo de documento de identificación del beneficiario", "Identificación beneficiario", "Fecha de Nacimiento",
            "Departamento Nacimiento", "Municipio Nacimiento", "1er.  Apellido", "2o. Apellido", "1er.  Nombre", "2o. Nombre",
            "Código Sexo Cónyuge o compañero", "Tipo de documento de identificación del cónyuge o compañero",
            "Identificación del cónyuge o compañero", "Fecha de Nacimiento del cónyugue o compañero",
            "Departamento  de nacimiento del cónyuge o compañero", "Municipio  de nacimiento del cónyuge o compañero",
            "1er.  Apellido del cónyuge o compañero", "2o. Apellido del cónyuge o compañero", "1er.  Nombre del cónyuge o compañero",
            "2o. Nombre del cónyuge o compañero", "Departamento  de residencia", "Municipio de residencia", "Tipo de beneficiario",
            "Madre cabeza de familia", "Código de pertenencia étnica", "Número de acta de selección", "Fecha de acta de selección (AAAA-MM-DD)",
            "Puntaje de adjudicación", "Tipo de documento de adjudicación", "Número de documento de adjudicación",
            "Fecha de documento de adjudicación (AAAA-MM-DD)", "Tipo de documento de Revocatoria",
            "Número de documento de Revocatoria", "Fecha de documento de Revocatroria (AAAA-MM-DD)",
            "Tipo de beneficio", "Valor del beneficio", "Fecha de entrega del último beneficio",
            "Estado  del beneficio", "Radicación de acción social", "Fecha de acción social (AAAA-MM-DD)",
            "Certificación de la OACPP", "Fecha certificación OACPP", "Comentarios");

        $newRow = array();

        foreach ($header_row as $a) {
            $newRow[] = iconv('UTF-8', 'Windows-1252', $a);
        }

        fputcsv($csv_file, $newRow, ';', '"');

        $sql = "SELECT Beneficiary.tipo_identificacion as BTipoIdentificacion
      ,Beneficiary.numero_identificacion as BNumeroIdentificacion
      ,Beneficiary.nombres as BNombres
      ,Beneficiary.primer_apellido as BPrimerApellido
      ,Beneficiary.segundo_apellido as BSegundoApellido
      ,Beneficiary.genero as BGenero
      ,Beneficiary.tipo as BTipo
      ,Beneficiary.fecha_nacimiento as BFechaNacimiento
      ,Conyugue.tipo_identificacion as CTipoIdentificacion
      ,Conyugue.numero_identificacion as CNumeroIdentificacion
      ,Conyugue.nombres as CNombres
      ,Conyugue.primer_apellido as CPrimerApellido
      ,Conyugue.segundo_apellido as CSegundoApellido
      ,Conyugue.genero as CGenero
      ,Conyugue.fecha_nacimiento as CFechaNacimiento   
      ,Beneficiary.property_id as BPropertyID
      ,Convocatoria.nombre as Convocatoria
      ,Proyect.codigo as Codigo
      ,Proyect.id as ProyectID
      ,Property.nombre as PropertyNombre
      ,Resolution.numero as ResolutionNumero
      ,Resolution.fecha as ResolutionFecha
      ,City.name as CityName
      ,Departament.name as DepartamentName
  FROM [ipdr].[dbo].[beneficiaries] AS Beneficiary
  LEFT JOIN properties AS Property ON Property.id = Beneficiary.property_id
  LEFT JOIN cities AS City ON City.id = Property.city_id
  LEFT JOIN departaments AS Departament ON Departament.id = City.departament_id
  LEFT JOIN proyects AS Proyect ON Proyect.id = Property.proyect_id
  LEFT JOIN beneficiaries AS Conyugue ON Conyugue.beneficiary_id = Beneficiary.id
  LEFT JOIN calls AS Convocatoria ON Convocatoria.id = Proyect.call_id
  LEFT JOIN resolutions AS Resolution ON Resolution.proyect_id = Proyect.id
  WHERE Beneficiary.beneficiary_id = 0 and Beneficiary.fallecido != 'Si' and Beneficiary.calificacion_visita != 'No cumple' and Resolution.tipo = 'Adjudicación';";

        $resultados = $this->Proyect->query($sql);

        $resolucion_revocatoria = $numero_revocatoria = $fecha_revocatoria = "";



        foreach ($resultados as $resultado) {
            //var_dump($resultado);exit;
            $row = array(
                $resultado[0]['DepartamentName'],
                $resultado[0]['Convocatoria'],
                $resultado[0]['Codigo'],
                $resultado[0]['PropertyNombre'],
                $resultado[0]['BGenero'],
                $resultado[0]['BTipoIdentificacion'],
                $resultado[0]['BNumeroIdentificacion'],
                $resultado[0]['BFechaNacimiento'],
                "",
                "",
                $resultado[0]['BPrimerApellido'],
                $resultado[0]['BSegundoApellido'],
                $resultado[0]['BNombres'],
                "",
                $resultado[0]['CGenero'],
                $resultado[0]['CTipoIdentificacion'],
                $resultado[0]['CNumeroIdentificacion'],
                $resultado[0]['CFechaNacimiento'],
                "",
                "",
                $resultado[0]['CPrimerApellido'],
                $resultado[0]['CSegundoApellido'],
                $resultado[0]['CNombres'],
                "",
                $resultado[0]['DepartamentName'],
                $resultado[0]['CityName'],
                $resultado[0]['BTipo'],
                "",
                "",
                "",
                "",
                "",
                "Resolución",
                $resultado[0]['ResolutionNumero'],
                $resultado[0]['ResolutionFecha'],
                $resolucion_revocatoria,
                $numero_revocatoria,
                $fecha_revocatoria,
                "",
                "",
                "",
                "",
                "",
                "",
                "",
                "",
                ""
            );

            $newRow = array();

            foreach ($row as $a) {
                $newRow[] = iconv('UTF-8', 'Windows-1252', $a);
            }

            fputcsv($csv_file, $newRow, ';', '"');
        }



        fclose($csv_file);
        $this->autoRender = false;
    }

    public function seguimiento() {
        $this->layout = 'ajax';
        if ($this->Session->read('proyect_id') != "") {
            //busco si tiene mas de un desembolso
            $numeroDesembolsos = $this->Proyect->Payment->find('count', array('conditions' => array('Payment.proyect_id' => $this->Session->read('proyect_id'))));
            if ($numeroDesembolsos >= 1) {
                $this->set('proyect_id', $this->Session->read('proyect_id'));
            } else {
                $this->Session->setFlash('El proyecto no tiene desembolsos', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        } else {
            $this->Session->setFlash('No ha seleccionado Proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

}

?>