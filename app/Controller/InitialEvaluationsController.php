<?php

Class InitialEvaluationsController extends AppController {

    public $name = 'InitialEvaluations';

    public function edit($id) {
        $this->InitialEvaluation->recursive = -1;
        App::Import('model', 'InitialEvaluationRequirement');
        App::Import('model', 'User');
        $User = new User();

        $this->set('users', $User->find('list', array('fields' => array('User.id', 'User.nombre'))));
        App::Import('model', 'Branch');
        $Branch = new Branch();
        $this->set('branches', $Branch->find('list', array('fields' => array('Branch.id', 'Branch.nombre'))));

        if (empty($this->data)) {
            $Requisito = new InitialEvaluationRequirement();
            $this->data = $this->InitialEvaluation->find('first', array('conditions' => array('InitialEvaluation.id' => $id), 'fields' => array('InitialEvaluation.*')));

            //busco si existe más de un registro de la evaluacion para este proyecto, si es así no creo los requisitos
//            $registros = $this->InitialEvaluation->find('count', array(
//                'conditions' => array('InitialEvaluation.proyect_id' => $this->data['InitialEvaluation']['proyect_id'])
//                    ));

            foreach ($this->data['InitialEvaluation'] as $key => $value) {
                $this->request->data['InitialEvaluation'][$key] = str_replace('.0000', '', $value);
            }

            $requisitos = $Requisito->Requirement->find('all', array('fields' => array('Requirement.id'), 'conditions' => array('Requirement.call_id' => $this->Session->read('call_id'))));


            foreach ($requisitos as $requisito) {
                if ($Requisito->find('count', array('recursive' => -1, 'fields' => array('InitialEvaluationRequirement.id'), 'conditions' => array('InitialEvaluationRequirement.initial_evaluation_id' => $this->data['InitialEvaluation']['id'], 'InitialEvaluationRequirement.requirement_id' => $requisito['Requirement']['id']))) == 0) {

                    $Requisito->create();
                    $datos = array(
                        'InitialEvaluationRequirement' => array(
                            'initial_evaluation_id' => $this->data['InitialEvaluation']['id'],
                            'requirement_id' => $requisito['Requirement']['id'],
                            'puntaje' => 0,
                            ));
                    $Requisito->save($datos);
                }
            }
            $this->set('group_id', $this->Auth->user('group_id'));
            $this->set('requisitos', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'General', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.observaciones', 'Requirement.nombre'))));
            $this->set('caracterizaciones', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Caracterización', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.concepto', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo', 'InitialEvaluationRequirement.preguntas_proponente', 'InitialEvaluationRequirement.observaciones'))));
            $this->set('formulacion', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Formulación', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.concepto', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo', 'InitialEvaluationRequirement.preguntas_proponente', 'InitialEvaluationRequirement.observaciones'))));
            $this->set('tecnicos', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Criterios técnicos', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.concepto', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo', 'InitialEvaluationRequirement.preguntas_proponente', 'InitialEvaluationRequirement.observaciones'))));
            $this->set('financieros', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Análisis financiero', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.concepto', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo', 'InitialEvaluationRequirement.preguntas_proponente', 'InitialEvaluationRequirement.observaciones'))));
            $this->set('ambientales', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Componente ambiental', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.concepto', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo', 'InitialEvaluationRequirement.preguntas_proponente', 'InitialEvaluationRequirement.observaciones'))));
            $this->set('economicos', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Verificación económica', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.observaciones', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo'))));
            $this->set('acTecnicos', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Aclaración técnica', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.observaciones', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo'))));
            $this->set('acFinanciera', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Aclaración financiera', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.observaciones', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo'))));
            $this->set('acAmbiental', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Aclaración ambiental', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.observaciones', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo'))));
            $this->set('acSocial', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Aclaración social', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.observaciones', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo'))));
            $this->set('noFinanciables', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Rubros no financiables', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.observaciones', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo'))));
            $this->set('noElegibles', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Gastos contrapartida', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.observaciones', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo'))));
            $this->set('generales', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'OBJETIVOS-ACTIVIDADES Y METAS', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.concepto', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo'))));
            $this->set('compSociales', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Componente social', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.concepto', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo'))));
            $this->set('compComerciales', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Componente comercial', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.concepto', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo'))));
            $this->set('alimenticios', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => 'Seguridad alimentaria', 'InitialEvaluationRequirement.initial_evaluation_id' => $id), 'fields' => array('InitialEvaluationRequirement.id', 'InitialEvaluationRequirement.calificacion', 'InitialEvaluationRequirement.concepto', 'InitialEvaluationRequirement.puntaje', 'Requirement.nombre', 'Requirement.puntaje_maximo'))));
        } else {

            if (!empty($this->data['InitialEvaluation']['calificacion_integral'])) {
                $this->request->data['InitialEvaluation']['fecha_finalizacion'] = date("Y.m.d");
            }
            if ($this->InitialEvaluation->save($this->data)) {
                $this->Session->write('acordeon_id', 0);
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'InitialEvaluations', 'action' => 'edit', $id));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function index() {
        $this->set('group_id', $this->Auth->user('group_id'));
        $proyect_id = $this->Session->read('proyect_id');


        if ($proyect_id != "") {
            $this->InitialEvaluation->Proyect->recursive = -1;
            $codigo = $this->InitialEvaluation->Proyect->field('codigo', array('Proyect.id' => $proyect_id));
            $this->set('proyect_id', $proyect_id);
            $this->set('codigo', $codigo);
            $this->paginate = array('InitialEvaluation' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50, 'order' => array('InitialEvaluation.fecha_creacion' => 'DESC', 'InitialEvaluation.id' => 'DESC'), 'fields' => array('InitialEvaluation.id', 'InitialEvaluation.fecha_creacion', 'Proyect.codigo', 'Proyect.id', 'Formulation.adjunto', 'User.nombre', 'User.primer_apellido', 'InitialEvaluation.proyecto_productivo', 'InitialEvaluation.calificacion_integral', 'InitialEvaluation.concepto_tecnico_final', 'InitialEvaluation.proyect_id', 'InitialEvaluation.id')));
            $this->set('InitialEvaluations', $this->paginate(array('InitialEvaluation.proyect_id' => $proyect_id)));
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    public function add($proyect_id) {

        $evaluacionInicial = $this->InitialEvaluation->find('first', array('recursive' => -1, 'conditions' => array('InitialEvaluation.proyect_id' => $proyect_id), 'order' => array('InitialEvaluation.id DESC')));

        if (empty($evaluacionInicial)) {
            $this->set('proyect_id', $proyect_id);
            $this->request->data['InitialEvaluation']['proyect_id'] = $proyect_id;
            $this->request->data['InitialEvaluation']['user_id'] = $this->Auth->user('id');
            $this->request->data['InitialEvaluation']['fecha_creacion'] = date("Y.m.d");
            $this->request->data['InitialEvaluation']['formulation_id'] = 0;
            if ($this->InitialEvaluation->saveAll($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'InitialEvaluations', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        } else {
            //Retiro el registro del id para crear un nuevo registro
            $first_id = $evaluacionInicial['InitialEvaluation']['id'];

            unset($evaluacionInicial['InitialEvaluation']['id']);
            unset($evaluacionInicial['InitialEvaluation']['user_id']);
            unset($evaluacionInicial['InitialEvaluation']['fecha_creacion']);

            $evaluacionInicial['InitialEvaluation']['calificacion_integral'] = "";
            $evaluacionInicial['InitialEvaluation']['fecha_creacion'] = date("Y.m.d");
            $evaluacionInicial['InitialEvaluation']['user_id'] = $this->Auth->user('id');
            //Creo el nuevo registro de la evaluación inicial con la información de la anterior
            if ($this->InitialEvaluation->saveAll($evaluacionInicial)) {
                //Busco el id del registro guardado
                $last_id = $this->InitialEvaluation->field('id', array('InitialEvaluation.proyect_id' => $proyect_id), 'id DESC');
                //Busco los registros hechos anteriormente en la tabla 
                $this->loadModel('InitialEvaluationRequirement');
                $requirements = $this->InitialEvaluationRequirement->find('all', array('recursive' => -1, 'conditions' => array('InitialEvaluationRequirement.initial_evaluation_id' => $first_id), 'fields' => array('InitialEvaluationRequirement.*')));

                $problema = false;

                foreach ($requirements as $requirement) {

                    $this->InitialEvaluationRequirement->create();

                    $requirement1 = $requirement;
                    unset($requirement1['InitialEvaluationRequirement']['initial_evaluation_id']);
                    unset($requirement1['InitialEvaluationRequirement']['id']);
                    $requirement1['InitialEvaluationRequirement']['initial_evaluation_id'] = $last_id;


                    if (!$this->InitialEvaluationRequirement->save($requirement1)) {
                        $problema = true;
                    }
                }

                if (!$problema) {
                    $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'InitialEvaluations', 'action' => 'index'));
                } else {
                    $this->Session->setFlash('Error Guardando datos');
                }
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function print_letter($evaluation_id) {
        $this->layout = "pdf";
        $this->response->type('application/pdf');
        //header("Content-type: application/pdf");
        $this->InitialEvaluation->recursive = -1;
        $evaluacion = $this->InitialEvaluation->find('first', array(
            'conditions' => array('InitialEvaluation.id' => $evaluation_id),
            'fields' => array('User.nombre', 'User.id', 'User.primer_apellido', 'User.segundo_apellido', 'User.cedula', 'InitialEvaluation.*'),
            'joins' => array(
                array('table' => 'users', 'alias' => 'User', 'type' => 'left', 'conditions' => 'User.id=InitialEvaluation.user_id'),
                )));
        $this->set('evaluacion', $evaluacion);
        App::Import('Model', 'Proyect');
        $Proyect = new Proyect();
        App::Import('Model', 'Beneficiary');
        $ben = new Beneficiary();

        $options = array();
        $options['recursive'] = -1;
        $options['conditions'] = array('Property.proyect_id' => $evaluacion['InitialEvaluation']['proyect_id']);
        $options['joins'] = array(
            array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('Property.city_id=City.id')),
            array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')),
        );
        $options['fields'] = array('Property.nombre', 'Property.vereda', 'City.name', 'Departament.name', 'Property.id');

        $predios = $Proyect->Property->find('all', $options);
        $this->set('predios', $predios);
        $this->set('proyecto', $Proyect->find('first', array('recursive' => -1, 'fields' => array('Proyect.codigo'), 'conditions' => array('Proyect.id' => $evaluacion['InitialEvaluation']['proyect_id']))));
        App::Import('model', 'InitialEvaluationRequirement');
        $Requisito = new InitialEvaluationRequirement();

        $Requisito->Requirement->recursive = -1;
        $Requisito->virtualFields = array(
            'sumaPuntaje' => 'SUM(InitialEvaluationRequirement.puntaje)'
        );
        $Requisito->Requirement->virtualFields = array(
            'puntajeMaximo' => 'SUM(Requirement.puntaje_maximo)'
        );

        $maximo = $Requisito->Requirement->find('first', array(
            'conditions' => array('InitialEvaluationRequirement.initial_evaluation_id' => $evaluation_id),
            'fields' => array('Requirement.puntajeMaximo'),
            'joins' => array(array('table' => 'initial_evaluation_requirements', 'alias' => 'InitialEvaluationRequirement', 'conditions' => array('InitialEvaluationRequirement.requirement_id=Requirement.id')))
                ));

        $familias_beneficiarias = 0;

        foreach ($predios as $predio) {
            $familias_beneficiarias += $ben->find('count', array('recursive' => -1, 'conditions' => array('Beneficiary.property_id' => $predio['Property']['id'], 'Beneficiary.beneficiary_id' => 0, 'Beneficiary.calificacion_visita' => 'Cumple')));
        }

        $this->set('puntajeMaximo', $maximo['Requirement']['puntajeMaximo']);
        $this->set('familias_beneficiarias', $familias_beneficiarias);
        $this->set('sumaPuntaje', $Requisito->field('InitialEvaluationRequirement.sumaPuntaje', array('InitialEvaluationRequirement.initial_evaluation_id' => $evaluation_id)));
        $this->set('caracterizaciones', $Requisito->find('all', array('conditions' => array('Requirement.tipo' => array('Caracterización', 'Criterios técnicos', 'Análisis financiero', 'Componente ambiental', 'Formulación'), 'InitialEvaluationRequirement.initial_evaluation_id' => $evaluation_id), 'fields' => array('InitialEvaluationRequirement.concepto', 'Requirement.tipo'))));
    }

    public function print_card($evaluation_id) {
        $this->layout = "pdf";
        $this->response->type('application/pdf');
        $this->InitialEvaluation->recursive = -1;
        $evaluacion = $this->InitialEvaluation->find('first', array(
            'conditions' => array('InitialEvaluation.id' => $evaluation_id),
            'fields' => array('User.nombre', 'User.id', 'User.cedula', 'User.primer_apellido', 'User.segundo_apellido', 'User.cedula', 'InitialEvaluation.proyect_id', 'InitialEvaluation.valor_total', 'InitialEvaluation.monto_solicitado', 'InitialEvaluation.calificacion_integral', 'InitialEvaluation.concepto_tecnico_final', 'InitialEvaluation.objetivo', 'Branch.nombre', 'InitialEvaluation.id', 'InitialEvaluation.nombre_proyecto', 'InitialEvaluation.nombre_aliado', 'InitialEvaluation.origen_tema', 'InitialEvaluation.justificacion', 'InitialEvaluation.descripcion_poblacion', 'InitialEvaluation.resultados_esperados', 'InitialEvaluation.descripcion_poblacion', 'InitialEvaluation.resultados_esperados', 'InitialEvaluation.descripcion_personal_tecnico', 'InitialEvaluation.innovacion', 'InitialEvaluation.programacion_actividades', 'InitialEvaluation.fecha_finalizacion'),
            'joins' => array(
                array('table' => 'branches', 'alias' => 'Branch', 'type' => 'left', 'conditions' => 'Branch.id=InitialEvaluation.branch_id'),
                array('table' => 'users', 'alias' => 'User', 'type' => 'left', 'conditions' => 'User.id=InitialEvaluation.user_id'),
            )
                ));
        $this->set('evaluacion', $evaluacion);
        App::Import('Model', 'Proyect');
        $Proyect = new Proyect();

        $options = array();
        $options['conditions'] = array('Property.proyect_id' => $evaluacion['InitialEvaluation']['proyect_id']);
        $options['joins'] = array(array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('Property.city_id=City.id')), array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')));
        $options['fields'] = array('Property.nombre', 'Property.vereda', 'City.name', 'Departament.name');
        $options['recursive'] = -1;
        $this->set('proyecto', $Proyect->find('first', array('recursive' => -1, 'fields' => array('Proyect.codigo'), 'conditions' => array('Proyect.id' => $evaluacion['InitialEvaluation']['proyect_id']))));
    }

    public function uploadFile($evaluation_id) {
        $this->layout = "ajax";
        $this->set('evaluation_id', $evaluation_id);



        App::import('Vendor', 'Excel/oleread.inc');
        App::import('Vendor', 'Spreadsheet_Excel_Reader', array('file' => 'reader/excel_reader2.php'));
        $data = new Spreadsheet_Excel_Reader();
        $nombreArchivo = "";
        if (!empty($this->data)) {
            if (is_dir(APP . "/webroot/files")) {
                if ($this->Auth->user('id') == 1)
                    $nombreArchivo = "evaluacion.xls";
                else
                    $nombreArchivo = "evaluacion1.xls";
                if (move_uploaded_file($this->data['InitialEvaluation']['adjunto']['tmp_name'], APP . "/webroot/files/" . $nombreArchivo)) {
                    $data = new Spreadsheet_Excel_Reader();
                    //$data->setOutputEncoding('CP1251');

                    $data->read('../webroot/files/' . $nombreArchivo);
                    //error_reporting(E_ALL ^ E_NOTICE);
                    //DATOS GENERALES


                    $nombre_proyecto = utf8_encode($data->sheets[0]['cells'][8][4]);
                    $nombre_aliado = utf8_encode($data->sheets[0]['cells'][15][4]);
                    $tipoProyecto = utf8_encode($data->sheets[0]['cells'][16][4]);
                    $tipoPoblacion = utf8_encode($data->sheets[0]['cells'][15][4]);
                    $numeroBeneficiarios = utf8_encode($data->sheets[0]['cells'][17][4]);
                    // $numeroAdjudicatariosNoBeneficiarios = utf8_encode($data->sheets[0]['cells'][18][4]);
                    $this->InitialEvaluation->query("UPDATE   initial_evaluations set beneficiarios='$numeroBeneficiarios',nombre_proyecto='$nombre_proyecto' ,tipo_proyecto='$tipoProyecto',tipo_poblacion='$tipoPoblacion' WHERE id=" . $evaluation_id);


                    //CALIFICACIONES HOJA 1
//CALIFICACIONES HOJA 1
                    $calificacion = "";
                    if ($data->sheets[0]['cells'][24][7] == "x" OR $data->sheets[0]['cells'][24][7] == "X") {
                        $calificacion = "Muy alto";
                    }
                    if ($data->sheets[0]['cells'][24][8] == "x" OR $data->sheets[0]['cells'][24][8] == "X") {
                        $calificacion = "Alto";
                    }
                    if ($data->sheets[0]['cells'][24][9] == "x" OR $data->sheets[0]['cells'][24][9] == "X") {
                        $calificacion = "Medio";
                    }
                    if ($data->sheets[0]['cells'][24][10] == "x" OR $data->sheets[0]['cells'][24][10] == "X") {
                        $calificacion = "Bajo";
                    }
                    if ($data->sheets[0]['cells'][24][11] == "x" OR $data->sheets[0]['cells'][24][11] == "X") {
                        $calificacion = "Nulo";
                    }

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=62 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[0]['cells'][24][12]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);
                    $calificacion = "";
                    if ($data->sheets[0]['cells'][25][7] == "x" OR $data->sheets[0]['cells'][25][7] == "X") {
                        $calificacion = "Muy alto";
                    }
                    if ($data->sheets[0]['cells'][25][8] == "x" OR $data->sheets[0]['cells'][25][8] == "X") {
                        $calificacion = "Alto";
                    }
                    if ($data->sheets[0]['cells'][25][9] == "x" OR $data->sheets[0]['cells'][25][9] == "X") {
                        $calificacion = "Medio";
                    }
                    if ($data->sheets[0]['cells'][25][10] == "x" OR $data->sheets[0]['cells'][25][10] == "X") {
                        $calificacion = "Bajo";
                    }
                    if ($data->sheets[0]['cells'][24][11] == "x" OR $data->sheets[0]['cells'][25][11] == "X") {
                        $calificacion = "Nulo";
                    }

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=63 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[0]['cells'][25][12]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);

                    $calificacion = "";
                    if ($data->sheets[0]['cells'][26][7] == "x" OR $data->sheets[0]['cells'][26][7] == "X") {
                        $calificacion = "Muy alto";
                    }
                    if ($data->sheets[0]['cells'][26][8] == "x" OR $data->sheets[0]['cells'][26][8] == "X") {
                        $calificacion = "Alto";
                    }
                    if ($data->sheets[0]['cells'][26][9] == "x" OR $data->sheets[0]['cells'][26][9] == "X") {
                        $calificacion = "Medio";
                    }
                    if ($data->sheets[0]['cells'][26][10] == "x" OR $data->sheets[0]['cells'][26][10] == "X") {
                        $calificacion = "Bajo";
                    }
                    if ($data->sheets[0]['cells'][26][11] == "x" OR $data->sheets[0]['cells'][26][11] == "X") {
                        $calificacion = "Nulo";
                    }

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=64 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[0]['cells'][26][12]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);


                    $calificacion = "";
                    if ($data->sheets[0]['cells'][27][7] == "x" OR $data->sheets[0]['cells'][27][7] == "X") {
                        $calificacion = "Muy alto";
                    }
                    if ($data->sheets[0]['cells'][27][8] == "x" OR $data->sheets[0]['cells'][27][8] == "X") {
                        $calificacion = "Alto";
                    }
                    if ($data->sheets[0]['cells'][27][9] == "x" OR $data->sheets[0]['cells'][27][9] == "X") {
                        $calificacion = "Medio";
                    }
                    if ($data->sheets[0]['cells'][27][10] == "x" OR $data->sheets[0]['cells'][27][10] == "X") {
                        $calificacion = "Bajo";
                    }
                    if ($data->sheets[0]['cells'][27][11] == "x" OR $data->sheets[0]['cells'][27][11] == "X") {
                        $calificacion = "Nulo";
                    }

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=65 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[0]['cells'][27][12]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);


                    $calificacion = "";
                    if ($data->sheets[1]['cells'][15][3] == "x" OR $data->sheets[1]['cells'][15][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][15][4] == "x" OR $data->sheets[1]['cells'][15][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][15][5] == "x" OR $data->sheets[1]['cells'][15][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=66 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][15][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);


                    $calificacion = "";
                    if ($data->sheets[1]['cells'][16][3] == "x" OR $data->sheets[1]['cells'][16][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][16][4] == "x" OR $data->sheets[1]['cells'][16][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][16][5] == "x" OR $data->sheets[1]['cells'][16][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=67 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][16][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);



                    $calificacion = "";
                    if ($data->sheets[1]['cells'][17][3] == "x" OR $data->sheets[1]['cells'][17][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][17][4] == "x" OR $data->sheets[1]['cells'][17][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][17][5] == "x" OR $data->sheets[1]['cells'][17][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=68 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][17][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);

                    $calificacion = "";
                    if ($data->sheets[1]['cells'][18][3] == "x" OR $data->sheets[1]['cells'][18][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][18][4] == "x" OR $data->sheets[1]['cells'][18][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][18][5] == "x" OR $data->sheets[1]['cells'][18][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=69 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][18][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);

                    $calificacion = "";
                    if ($data->sheets[1]['cells'][19][3] == "x" OR $data->sheets[1]['cells'][19][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][19][4] == "x" OR $data->sheets[1]['cells'][19][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][19][5] == "x" OR $data->sheets[1]['cells'][19][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=70 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][19][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);


                    $calificacion = "";
                    if ($data->sheets[1]['cells'][23][3] == "x" OR $data->sheets[1]['cells'][23][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][23][4] == "x" OR $data->sheets[1]['cells'][23][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][23][5] == "x" OR $data->sheets[1]['cells'][23][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=76 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][23][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);


                    $calificacion = "";
                    if ($data->sheets[1]['cells'][24][3] == "x" OR $data->sheets[1]['cells'][24][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][24][4] == "x" OR $data->sheets[1]['cells'][24][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][24][5] == "x" OR $data->sheets[1]['cells'][24][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=77 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][24][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);

                    $calificacion = "";
                    if ($data->sheets[1]['cells'][25][3] == "x" OR $data->sheets[1]['cells'][25][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][25][4] == "x" OR $data->sheets[1]['cells'][25][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][25][5] == "x" OR $data->sheets[1]['cells'][25][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=78 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][25][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);


                    $calificacion = "";
                    if ($data->sheets[1]['cells'][26][3] == "x" OR $data->sheets[1]['cells'][26][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][26][4] == "x" OR $data->sheets[1]['cells'][26][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][26][5] == "x" OR $data->sheets[1]['cells'][26][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=79 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][26][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);


                    $calificacion = "";
                    if ($data->sheets[1]['cells'][27][3] == "x" OR $data->sheets[1]['cells'][27][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][27][4] == "x" OR $data->sheets[1]['cells'][27][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][27][5] == "x" OR $data->sheets[1]['cells'][27][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=80 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][27][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);


                    $calificacion = "";
                    if ($data->sheets[1]['cells'][28][3] == "x" OR $data->sheets[1]['cells'][28][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][28][4] == "x" OR $data->sheets[1]['cells'][28][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][28][5] == "x" OR $data->sheets[1]['cells'][28][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=81 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][28][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);


                    $calificacion = "";
                    if ($data->sheets[1]['cells'][31][3] == "x" OR $data->sheets[1]['cells'][31][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][31][4] == "x" OR $data->sheets[1]['cells'][31][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][31][5] == "x" OR $data->sheets[1]['cells'][31][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=71 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][31][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);

                    $calificacion = "";
                    if ($data->sheets[1]['cells'][32][3] == "x" OR $data->sheets[1]['cells'][32][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][32][4] == "x" OR $data->sheets[1]['cells'][32][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][32][5] == "x" OR $data->sheets[1]['cells'][32][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=72 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][32][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);


                    $calificacion = "";
                    if ($data->sheets[1]['cells'][33][3] == "x" OR $data->sheets[1]['cells'][33][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][33][4] == "x" OR $data->sheets[1]['cells'][33][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][33][5] == "x" OR $data->sheets[1]['cells'][33][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=73 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][33][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);
                    $calificacion = "";
                    if ($data->sheets[1]['cells'][34][3] == "x" OR $data->sheets[1]['cells'][34][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][34][4] == "x" OR $data->sheets[1]['cells'][34][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][34][5] == "x" OR $data->sheets[1]['cells'][34][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=74 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][34][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);
                    $calificacion = "";
                    if ($data->sheets[1]['cells'][35][3] == "x" OR $data->sheets[1]['cells'][35][3] == "X") {
                        $calificacion = "Cumple";
                    }
                    if ($data->sheets[1]['cells'][35][4] == "x" OR $data->sheets[1]['cells'][35][4] == "X") {
                        $calificacion = "No cumple";
                    }
                    if ($data->sheets[1]['cells'][35][5] == "x" OR $data->sheets[1]['cells'][35][5] == "X") {
                        $calificacion = "No aplica";
                    }


                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=75 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones =\" " . utf8_encode($data->sheets[1]['cells'][35][6]) . "\" WHERE id=" . $requisito[0]['Requisito']['id']);

///Financiacion

                    $valor = explode('*', $data->sheets[1]['cells'][38][3]);
                    if ($data->sheets[1]['cells'][38][6] == 'SI' or $data->sheets[1]['cells'][38][6] == 'Si' or $data->sheets[1]['cells'][38][6] == 'si') {
                        $valorcalificacion = "SI";
                    } else {
                        $valorcalificacion = "NO";
                    }

                    $valorTotal = str_replace(",", "", $valor[1]);

                    $valor = explode('*', $data->sheets[1]['cells'][39][3]);
                    if ($data->sheets[1]['cells'][39][6] == 'SI' or $data->sheets[1]['cells'][39][6] == 'Si' or $data->sheets[1]['cells'][39][6] == 'si') {
                        $calMonto = "SI";
                    } else {
                        $calMonto = "NO";
                    }

                    $valorMonto = str_replace(",", "", $valor[1]);

                    $valor = explode('*', $data->sheets[1]['cells'][40][3]);
                    if ($data->sheets[1]['cells'][40][6] == 'SI' or $data->sheets[1]['cells'][40][6] == 'Si' or $data->sheets[1]['cells'][40][6] == 'si') {
                        $calContra = "SI";
                    } else {
                        $calContra = "NO";
                    }

                    $valorContrapartida = str_replace(",", "", $valor[1]);


                    $valor = explode('*', $data->sheets[1]['cells'][41][3]);
                    if ($data->sheets[1]['cells'][41][6] == 'SI' or $data->sheets[1]['cells'][41][6] == 'Si' or $data->sheets[1]['cells'][41][6] == 'si') {
                        $calPropias = "SI";
                    } else {
                        $calPropias = "NO";
                    }

                    $valorPropias = str_replace(",", "", $valor[1]);

                    $valor = explode('*', $data->sheets[1]['cells'][42][3]);
                    if ($data->sheets[1]['cells'][42][6] == 'SI') {
                        $calCredito = "SI";
                    } else {
                        $calCredito = "NO";
                    }

                    $valorCredito = str_replace(",", "", $valor[1]);


                    $valor = explode('*', $data->sheets[1]['cells'][45][3]);
                    if ($data->sheets[1]['cells'][45][6] == 'SI') {
                        $calTransferir = "SI";
                    } else {
                        $calTransferir = "NO";
                    }
                    $valorTransferir = str_replace(",", "", $valor[1]);

                    $valor = explode('*', $data->sheets[1]['cells'][46][3]);
                    if ($data->sheets[1]['cells'][46][6] == 'SI') {
                        $calTranContrap = "SI";
                    } else {
                        $calTranContrap = "NO";
                    }

                    $valorTranContrap = str_replace(",", "", $valor[1]);

                    $valor = explode('*', $data->sheets[1]['cells'][47][3]);
                    if ($data->sheets[1]['cells'][47][6] == 'SI') {
                        $calTotal = "SI";
                    } else {
                        $calTotal = "NO";
                    }

                    $valorTRansTotal = str_replace(",", "", $valor[1]);

                    $this->InitialEvaluation->query("UPDATE   initial_evaluations set valor_total= '$valorTotal',valor_total_calificacion='$valorcalificacion',	monto_solicitado='$valorMonto' ,monto_solicitado_calificacion='$calMonto' ,certificadas='$valorContrapartida' , certificadas_calificacion='$calContra',contraprtidas_propias='$valorPropias',contrapartidas_propias_calificacion='$calPropias',credito='$valorCredito',credito_calificacion='$calCredito' ,total_transferir_incoder='$valorTransferir',total_transferir_incoder_calificacion='$calTransferir' ,total_transferir_contrapartida='$valorTranContrap' ,total_transferir_contrapartida_calficacion='$calTranContrap' ,total_transferencia='$valorTRansTotal',total_transferencia_calificacion='$calTotal' WHERE id=" . $evaluation_id);


                    //requisito 82
                    $calificacion = $data->sheets[2]['cells'][28][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][28][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][28][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][28][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][28][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=82 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 83
                    $calificacion = $data->sheets[2]['cells'][29][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][29][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][29][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][29][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][29][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=83 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 84
                    $calificacion = $data->sheets[2]['cells'][30][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][30][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][30][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][30][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][30][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=84 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 85
                    $calificacion = $data->sheets[2]['cells'][31][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][31][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][31][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][31][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][31][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=85 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 86
                    $calificacion = $data->sheets[2]['cells'][34][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][34][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][34][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][34][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][34][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=86 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 87
                    $calificacion = $data->sheets[2]['cells'][35][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][35][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][35][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][35][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][35][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=87 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 90
                    $calificacion = $data->sheets[2]['cells'][36][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][36][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][36][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][36][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][36][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=90 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 88
                    $calificacion = $data->sheets[2]['cells'][37][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][37][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][37][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][37][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][37][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=88 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 89
                    $calificacion = $data->sheets[2]['cells'][38][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][38][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][38][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][38][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][38][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=89 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 91
                    $calificacion = $data->sheets[2]['cells'][39][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][39][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][39][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][39][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][39][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=91 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 92
                    $calificacion = $data->sheets[2]['cells'][42][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][42][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][42][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][42][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][42][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=92 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 93
                    $calificacion = $data->sheets[2]['cells'][43][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][43][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][43][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][43][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][43][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=93 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 94
                    $calificacion = $data->sheets[2]['cells'][44][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][44][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][44][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][44][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][44][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=94 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 96
                    $calificacion = $data->sheets[2]['cells'][45][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][45][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][45][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][45][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][45][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=96 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 97
                    $calificacion = $data->sheets[2]['cells'][46][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][46][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][46][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][46][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][46][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=97 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 98
                    $calificacion = $data->sheets[2]['cells'][47][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][47][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][47][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][47][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][47][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=98 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 99
                    $calificacion = $data->sheets[2]['cells'][48][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][48][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][48][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][48][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][48][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=99 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 100
                    $calificacion = $data->sheets[2]['cells'][49][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][49][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][49][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][49][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][49][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=100 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 101
                    $calificacion = $data->sheets[2]['cells'][50][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][50][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][50][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][50][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][50][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=101 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 102
                    $calificacion = $data->sheets[2]['cells'][51][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][51][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][51][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][51][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][51][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=102 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 103
                    $calificacion = $data->sheets[2]['cells'][52][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][52][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][52][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][52][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][52][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=103 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 104
                    $calificacion = $data->sheets[2]['cells'][55][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][55][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][55][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][55][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][55][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=104 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 105
                    $calificacion = $data->sheets[2]['cells'][56][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][56][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][56][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][56][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][56][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=105 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 106
                    $calificacion = $data->sheets[2]['cells'][59][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][59][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][59][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][59][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][59][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=106 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);

                    //requisito 107
                    $calificacion = $data->sheets[2]['cells'][60][5];
                    $concepto = utf8_encode($data->sheets[2]['cells'][60][6]);
                    $observacion = utf8_encode($data->sheets[2]['cells'][60][7]);
                    $pregunta = utf8_encode($data->sheets[2]['cells'][60][8]);
                    $puntaje = utf8_encode($data->sheets[2]['cells'][60][4]);

                    // se busca el requerimiento en la base de datos .
                    $requisito = $this->InitialEvaluation->query("SELECT  id FROM initial_evaluation_requirements Requisito WHERE requirement_id=107 AND initial_evaluation_id = $evaluation_id ORDER BY id DESC Limit 1 ");
                    $this->InitialEvaluation->query("UPDATE   initial_evaluation_requirements  set calificacion = '$calificacion' ,observaciones ='$observacion',concepto='$concepto' ,puntaje='$puntaje' WHERE id=" . $requisito[0]['Requisito']['id']);


                    echo $concepto_tecnico = utf8_encode($data->sheets[3]['cells'][16][2]);
                    $conceptoEconomico = utf8_encode($data->sheets[3]['cells'][38][2]);
                    $riesgos = utf8_encode($data->sheets[3]['cells'][41][2]);
                    $recomendaciones = utf8_encode($data->sheets[3]['cells'][44][2]);
                    $calIntegral = ($data->sheets[3]['cells'][16][10]);
                    if ($data->sheets[3]['cells'][34][8] == 'CUMPLE') {
                        $verEconomica = "Cumple";
                    } else {
                        $verEconomica = "No cumple";
                    }
                    if ($data->sheets[3]['cells'][35][8] == 'CUMPLE') {
                        $topes = "Cumple";
                    } else {
                        $topes = "No cumple";
                    }
                    if ($data->sheets[3]['cells'][36][8] == 'CUMPLE') {
                        $calEconomica = "Cumple";
                    } else {
                        $calEconomica = "No cumple";
                    }

                    $this->InitialEvaluation->query("UPDATE   initial_evaluations set calificacion_integral='$calIntegral', concepto_tecnico_final= '$concepto_tecnico',verificacion_economica='$verEconomica' , topes_maximos='$topes' ,evaluacion_economica='$calEconomica' ,concepto_economico='$conceptoEconomico' ,riesgo='$riesgos',recomendaciones='$recomendaciones' WHERE id=" . $evaluation_id);

                    $objetivo = utf8_encode($data->sheets[4]['cells'][8][3] . "\n" . $data->sheets[4]['cells'][9][3]);
                    $origen = utf8_encode($data->sheets[4]['cells'][11][3]);
                    $justificacion = utf8_encode($data->sheets[4]['cells'][12][3]);
                    $poblacion = utf8_encode($data->sheets[4]['cells'][16][3]);
                    $resultados = utf8_encode($data->sheets[4]['cells'][21][3]);
                    $innovacion = utf8_encode($data->sheets[4]['cells'][25][3]);
                    $personal = utf8_encode($data->sheets[4]['cells'][28][3]);
                    $actividades = utf8_encode($data->sheets[4]['cells'][36][3]);
                    //$solicitud = utf8_encode($data->sheets[4]['cells'][44][3]);
                    $nombre_proyecto = utf8_encode($data->sheets[0]['cells'][7][3]);

                    $this->InitialEvaluation->query("UPDATE   initial_evaluations set objetivo= '$objetivo', origen_tema='$origen' ,justificacion='$justificacion' ,descripcion_poblacion='$poblacion',resultados_esperados='$resultados',innovacion='$innovacion' ,descripcion_personal_tecnico='$personal',programacion_actividades='$actividades' WHERE id=" . $evaluation_id);

                    $this->Session->setFlash("Subido correctamente", 'flash_custom');
                    $this->redirect(array('controller' => 'InitialEvaluations', 'action' => 'index', $evaluation_id));
                } else {
                    $this->Session->setFlash('ERROR', 'flash_custom');
                    $this->redirect(array('controller' => 'InitialEvaluations', 'action' => 'index', $evaluation_id));
                };
            } else {

                $this->Session->setFlash('NO ES', 'flash_custom');
            }
        }
    }

    public function productive_proyect($initial_evaluation_id) {
        $this->layout = "ajax";
        if (empty($this->data)) {
            $this->data = $this->InitialEvaluation->find('first', array('conditions' => array('InitialEvaluation.id' => $initial_evaluation_id), 'fields' => array('InitialEvaluation.id', 'InitialEvaluation.proyect_id')));
        } else {
            if ($this->InitialEvaluation->saveAll($this->data)) {

                $this->InitialEvaluation->Proyect->recursive = -1;
                $codigo = $this->InitialEvaluation->Proyect->field('codigo', array('Proyect.id' => $this->data['InitialEvaluation']['proyect_id']));
                $proyect_id = $this->data['InitialEvaluation']['proyect_id'];
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $ext = explode(".", $this->data['InitialEvaluation']['archivo']['name']);
                $nombreArchivo = "ProyectoProductivo-$initial_evaluation_id." . $ext[1];
                $rutaArchivo.= "/" . $nombreArchivo;
                if (move_uploaded_file($this->data['InitialEvaluation']['archivo']['tmp_name'], $rutaArchivo)) {
                    $this->InitialEvaluation->id = $this->data['InitialEvaluation']['id'];
                    $this->InitialEvaluation->saveField('proyecto_productivo', $nombreArchivo);
                    $this->Session->setFlash('Registro Adicionado correctamente con archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }


                $this->Session->setFlash('Archivo subido  correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {
                $this->Session->setFlash('Error Guardando datos', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        }
    }

    public function delete($evaluation_id) {
        if ($this->InitialEvaluation->delete($evaluation_id)) {

            App::Import('model', 'InitialEvaluationRequirement');
            $InitialEvaluationRequirement = new InitialEvaluationRequirement();
            if ($InitialEvaluationRequirement->deleteAll(array('InitialEvaluationRequirement.initial_evaluation_id' => $evaluation_id))) {

                $this->Session->setFlash('Registro borrado correctamente con archivo', 'flash_custom');
                $this->redirect(array('controller' => 'initialEvaluations', 'action' => 'index'));
            }
        }
    }

}

?>
