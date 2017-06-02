<?php

App::uses('CakeEmail', 'Network/Email');

Class PaymentsController extends AppController {

    public $name = 'Payments';

    public function index() {
        $this->layout = "ajax";
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {

            $this->loadModel('Resolution');
            if ($resolucion = $this->Resolution->find('first', array('fields' => array('Resolution.id', 'Resolution.adjunto', 'Proyect.id', 'Proyect.codigo'), 'conditions' => array('Resolution.proyect_id' => $proyect_id), 'order' => array('Resolution.id' => 'DESC')))) {

                $this->set('Resolution', $resolucion);
                $this->set('payments', $this->Payment->find('all', array(
                            'conditions' => array('Payment.proyect_id' => $proyect_id),
                            'recursive' => -1,
                            'fields' => array('Payment.*', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Proyect.id', 'Proyect.codigo'),
                            'joins' => array(
                                array('table' => 'beneficiaries', 'alias' => 'Beneficiary', 'type' => 'left', 'conditions' => 'Beneficiary.id=Payment.beneficiary_id'),
                                array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Payment.proyect_id')
                            )
                )));
            } else {
                $this->Session->setFlash('No se ha generado una resolución para este proyecto', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    public function add($proyect_id) {
        $this->layout = "ajax";

        if (empty($this->request->data)) {
            $this->request->data['Payment']['proyect_id'] = $proyect_id;
            $this->request->data['Payment']['beneficiary_id'] = 0;
            if ($this->Payment->save($this->request->data)) {
                $this->Session->setFlash('la informacion se ha agregado correctamente.');
                $this->redirect(array('action' => 'index', $this->data['Payment']['proyect_id']));
            } else {
                $this->Session->setFlash('La informacion  no se  ha agregado.');
                $this->redirect(array('action' => 'index', $this->data['Payment']['proyect_id']));
            }
        }
    }

    public function edit($payment_id) {
        $this->layout = "ajax";
        $this->set('group_id', $this->Auth->user('group_id'));
        $this->set('user_id', $this->Auth->user('id'));
        if (!empty($this->request->data)) {

            if ($this->Payment->save($this->request->data)) {
                $this->Session->setFlash('La información se ha agregado correctamente.');
                $this->redirect(array('action' => 'index', $this->data['Payment']['proyect_id']));
            } else {
                $this->Session->setFlash('La información no se ha agregado.');
                $this->redirect(array('action' => 'index', $this->data['Payment']['proyect_id']));
            }
        } else {
            $this->data = $this->Payment->find('first', array('recursive' => -1, 'conditions' => array('Payment.id' => $payment_id)));
            $this->request->data['Payment']['valor_desembolsado'] = str_replace(".0000", '', $this->request->data['Payment']['valor_desembolsado']);
            App::Import('model', 'Beneficiary');
            $Beneficiary = new Beneficiary();
            $Beneficiary->virtualFields = array(
                'name' => "Beneficiary.nombres+ ''+Beneficiary.primer_apellido"
            );
            $beneficiarios = $Beneficiary->find('list', array(
                'recursive' => 0,
                'conditions' => array('Property.proyect_id' => $this->data['Payment']['proyect_id']),
                'fields' => array('Beneficiary.id', 'Beneficiary.name')
            ));
            $this->set('beneficiaries', $beneficiarios);
        }
    }

    function delete($payment_id) {
        if ($this->Payment->delete($payment_id)) {
            $this->Session->setFlash('Registro borrado correctamente.');
            $this->redirect(array('action' => 'index', $payment_id));
        }
    }

    function print_certification($payment_id) {
        $this->layout = "pdf";
        $this->response->type('application/pdf');
        $pago = $this->Payment->find('first', array(
            'joins' => array(
                array('table' => 'proyects', 'type' => 'left', 'alias' => 'Proyect', 'conditions' => 'Proyect.id=Payment.proyect_id'),
                array('table' => 'beneficiaries', 'type' => 'left', 'alias' => 'Beneficiary', 'conditions' => 'Beneficiary.id=Payment.beneficiary_id'),
                array('table' => 'calls', 'type' => 'left', 'alias' => 'Call', 'conditions' => 'Call.id=Proyect.call_id'),
                array('table' => 'properties', 'type' => 'left', 'alias' => 'Property', 'conditions' => 'Property.id=Beneficiary.property_id'),
                array('table' => 'cities', 'type' => 'left', 'alias' => 'City', 'conditions' => 'Property.city_id=City.id'),
                array('table' => 'departaments', 'type' => 'left', 'alias' => 'Departament', 'conditions' => 'Departament.id=City.departament_id')
            ),
            'recursive' => -1,
            'conditions' => array('Payment.id' => $payment_id),
            'fields' => array('Payment.*', 'Proyect.codigo', 'Proyect.id', 'Call.nombre', 'Call.convenio', 'Beneficiary.tipo_identificacion', 'Beneficiary.numero_identificacion', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.telefono', 'Beneficiary.direccion', 'City.name', 'Departament.name'),
        ));

        App::Import('model', 'Resolution');
        $Resolution = new Resolution();

        $resolucion = $Resolution->find('first', array('recursive' => 1, 'conditions' => array('Resolution.proyect_id' => $pago['Payment']['proyect_id'])));

        $this->set('resolucion', $resolucion);
        $this->set('pago', $pago);
    }

    function upload_files($payment_id) {
        $this->layout = 'ajax';
        if (empty($this->data)) {
            $this->data = $this->Payment->find('first', array('recursive' => -1, 'conditions' => array('Payment.id' => $payment_id), 'fields' => array('Payment.id', 'Payment.proyect_id')));
        } else {

            $this->request->data['Payment']['adjuntador'] = $this->Auth->user('id');
            $this->loadModel('User');
            $this->User->recursive = -1;
            $User = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));

            if ($this->Payment->save($this->data)) {
                $last_id = $this->data['Payment']['id'];
                $this->Payment->Proyect->recursive = -1;
                $proyect_id = $this->data['Payment']['proyect_id'];
                $codigo = $this->Payment->Proyect->field('codigo', array('Proyect.id' => $proyect_id));

                $rutaArchivo = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $ext = explode(".", $this->data['Payment']['archivo_poliza']['name']);

                $conteo = count($ext);
                $extension = 'pdf';
                $nombreArchivo = "Poliza-$last_id." . $extension;
                $rutaArchivo.= "/" . $nombreArchivo;
                $rutaArchivo1 = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo" . "/" . "Cert-bancaria-$last_id." . $extension;
                $rutaArchivo2 = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo" . "/" . "Notificacion-$last_id." . $extension;
                $rutaArchivo3 = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo" . "/" . "Poder-$last_id." . $extension;
                $rutaArchivo4 = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo" . "/" . "Comp-sanitario-$last_id." . $extension;
                $rutaArchivo5 = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo" . "/" . "Aprobacion-$last_id." . $extension;
                $rutaArchivo6 = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo" . "/" . "Distrito-riego-$last_id." . $extension;
                $rutaArchivo7 = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo" . "/" . "Tecnico-$last_id." . $extension;
                ;
                $subidos = 1;
                $mensaje = " ";
                if (!empty($this->request->data['Payment']['archivo_poliza']['tmp_name'])) {
                    if (move_uploaded_file($this->data['Payment']['archivo_poliza']['tmp_name'], $rutaArchivo)) {
                        $mensaje.="Se ha adjuntado la poliza.<br>";
                        $this->Payment->create();
                        $this->Payment->id = $last_id;
                        $this->Payment->saveField('adjunto_poliza', $nombreArchivo);
                    } else {
                        $subidos = 0;
                    }
                }
                if (!empty($this->request->data['Payment']['certificacion_bancaria']['tmp_name'])) {
                    if (move_uploaded_file($this->data['Payment']['certificacion_bancaria']['tmp_name'], $rutaArchivo1)) {
                        $mensaje.="Se ha adjuntado la certificación bancaria.<br>";
                        $this->Payment->create();
                        $this->Payment->id = $last_id;
                        $this->Payment->saveField('adjunto_bancaria', "Cert-bancaria-$last_id." . $extension);
                    } else {
                        $subidos = 0;
                    }
                }
                if (!empty($this->request->data['Payment']['notificacion']['tmp_name'])) {
                    if (move_uploaded_file($this->data['Payment']['notificacion']['tmp_name'], $rutaArchivo2)) {
                        $mensaje.="Se ha adjuntado documento notificacion.<br>";
                        $this->Payment->create();
                        $this->Payment->id = $last_id;
                        $this->Payment->saveField('adjunto_notificacion', "Notificacion-$last_id." . $extension);
                    } else {
                        $subidos = 0;
                    }
                }
                if (!empty($this->request->data['Payment']['poder']['tmp_name'])) {
                    if (move_uploaded_file($this->data['Payment']['poder']['tmp_name'], $rutaArchivo3)) {
                        $mensaje.="Se ha adjuntado documento poder.<br>";
                        $this->Payment->create();
                        $this->Payment->id = $last_id;
                        $this->Payment->saveField('adjunto_poder', "Poder-$last_id." . $extension);
                    } else {
                        $subidos = 0;
                    }
                }
                if (!empty($this->request->data['Payment']['componentes_sanitarios']['tmp_name'])) {
                    if (move_uploaded_file($this->data['Payment']['componentes_sanitarios']['tmp_name'], $rutaArchivo4)) {
                        $mensaje.="Se ha adjuntado documento componentes sanitarios.<br>";
                        $this->Payment->create();
                        $this->Payment->id = $last_id;
                        $this->Payment->saveField('adjunto_sanitario', "Comp-sanitario-$last_id." . $extension);
                    } else {
                        $subidos = 0;
                    }
                }
                if (!empty($this->request->data['Payment']['aprobacion']['tmp_name'])) {
                    if (move_uploaded_file($this->data['Payment']['aprobacion']['tmp_name'], $rutaArchivo5)) {
                        $mensaje.="Se ha adjuntado documento aprobación de la póliza.<br>";
                        $this->Payment->create();
                        $this->Payment->id = $last_id;
                        $this->Payment->saveField('adjunto_aprobacion', "Aprobacion-$last_id." . $extension);
                    } else {
                        $subidos = 0;
                    }
                }
                if (!empty($this->request->data['Payment']['distrito_riego']['tmp_name'])) {
                    if (move_uploaded_file($this->data['Payment']['distrito_riego']['tmp_name'], $rutaArchivo6)) {
                        $mensaje.="Se ha adjuntado documento Influencia de distrito de riegos .<br>";
                        $this->Payment->create();
                        $this->Payment->id = $last_id;
                        $this->Payment->saveField('adjunto_distrito', "Distrito-riego-$last_id." . $extension);
                    } else {
                        $subidos = 0;
                    }
                }
                if (!empty($this->request->data['Payment']['equipo_tecnico']['tmp_name'])) {
                    if (move_uploaded_file($this->data['Payment']['equipo_tecnico']['tmp_name'], $rutaArchivo7)) {
                        $mensaje.="Se ha adjuntado Formato De Revisión Del Equipo Técnico (F4-Pm-Ipdr-01) .<br>";
                        $this->Payment->create();
                        $this->Payment->id = $last_id;
                        $this->Payment->saveField('adjunto_tecnico', "Tecnico-$last_id." . $extension);
                    } else {
                        $subidos = 0;
                    }
                }


                if ($subidos) {

                    $this->loadModel('UserProyect');

                    $asignados = $this->UserProyect->find('all', array('fields' => array('User.email'), 'recursive' => -1, 'joins' => array(array('table' => 'users', 'alias' => 'User', 'conditions' => 'User.id=UserProyect.user_id')), 'conditions' => array('UserProyect.proyect_id' => $this->data['Payment']['proyect_id'], 'User.group_id' => 6)));
                    $Email = new CakeEmail('gmail');
                    $Email->from(array('ipdr.soporte@gmail.com' => 'Apicativo IPDR'));
                    $Email->addTo('elopez@incoder.gov.co');


                    foreach ($asignados as $asignado) {
                        $Email->addTo($asignado['User']['email']);
                    }
                    $Email->subject("Documentos desembolso IPDR  " . $codigo . "");
                    $Email->emailFormat('html');

                    $mensaje.="Subidos por: " . $User['User']['nombre'] . " " . $User['User']['primer_apellido'];
                    $Email->send($mensaje);



                    $this->Session->setFlash('Registro Adicionado correctamente con archivo ' . $mensaje, 'flash_custom');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }
            }
        }
    }

    function reports() {
        $this->layout = "ajax";
        $this->loadModel('Call');
        $this->set('calls', $this->Call->find('list', array('fields' => array('Call.id', 'Call.nombre'))));
        $this->Payment->virtualFields = array(
            'suma' => 'Sum(Payment.valor_desembolsado)'
        );


        if (empty($this->data)) {
            $pagos = $this->Payment->find('all', array(
                'recursive' => -1,
                'conditions' => array('Payment.fecha_desembolso IS NOT NULL'),
                'fields' => array('Payment.suma', 'Departament.name'),
                'group' => array('Departament.id', 'Departament.name'),
                'joins' => array(
                    array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Payment.proyect_id'),
                    array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => 'Proyect.call_id=Call.id'),
                    array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => 'City.id=Proyect.city_id'),
                    array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => 'City.departament_id=Departament.id'),
                )
            ));
        } else {
            if ($this->data['Payment']['call_id'] != "") {

                $pagos = $this->Payment->find('all', array(
                    'recursive' => -1,
                    'conditions' => array('Payment.fecha_desembolso IS NOT NULL'),
                    'conditions' => array('Proyect.call_id' => $this->data['Payment']['call_id'], 'Payment.fecha_desembolso IS NOT NULL'),
                    'fields' => array('Payment.suma', 'Departament.name'),
                    'group' => array('Departament.id', 'Departament.name'),
                    'joins' => array(
                        array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Payment.proyect_id'),
                        array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => 'Proyect.call_id=Call.id'),
                        array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => 'City.id=Proyect.city_id'),
                        array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => 'City.departament_id=Departament.id'),
                    )
                ));
            } else {


                $pagos = $this->Payment->find('all', array(
                    'recursive' => -1,
                    'fields' => array('Payment.suma', 'Departament.name', 'Call.nombre'),
                    'group' => array('Departament.id'),
                    'joins' => array(
                        array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Payment.proyect_id'),
                        array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => 'Proyect.call_id=Call.id'),
                        array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => 'City.id=Proyect.city_id'),
                        array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => 'City.departament_id=Departament.id'),
                    )
                ));
            }
        }
        $str = "";
        foreach ($pagos as $pago) {
            if (is_null($pago['Payment']['suma']))
                $pago['Payment']['suma'] = 0;
            $str.="['" . $pago['Departament']['name'] . "'," . $pago['Payment']['suma'] . "],";
        }
        $this->set('datos', $str);
    }

    function total_report() {
        $this->layout = "csv";
        ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
        //create a file
        $filename = "Reporte_desembolsos_" . date("Y.m.d") . ".csv";
        $csv_file = fopen('php://output', 'w');
        $this->response->type('application/csv');


        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $cabecera = array();
        $flag = 0;
        $pagos = $this->Payment->find('all', array(
            'recursive' => -1,
            'fields' => array('Call.nombre AS Convocatoria', 'Proyect.codigo AS Codigo', 'Departament.name AS Departamento', 'City.name AS Municipio', 'Beneficiary.nombres As Nombres', 'Beneficiary.primer_apellido As Apellido', 'Beneficiary.numero_identificacion As Cedula', 'cuenta_beneficiario', 'valor_desembolsado', 'banco_beneficiario', 'tipo_cuenta_beneficiario', 'observaciones', 'fecha_radicacion', 'fecha_desembolso'),
            'order' => array('Call.id' => 'DESC', 'Departament.name' => 'ASC', 'City.name' => 'ASC', 'Payment.fecha_desembolso' => 'DESC'),
            'joins' => array(
                array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Payment.proyect_id'),
                array('table' => 'beneficiaries', 'alias' => 'Beneficiary', 'type' => 'left', 'conditions' => 'Beneficiary.id=Payment.beneficiary_id'),
                array('table' => 'calls', 'alias' => 'Call', 'type' => 'left', 'conditions' => 'Proyect.call_id=Call.id'),
                array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => 'City.id=Proyect.city_id'),
                array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => 'City.departament_id=Departament.id'),
            )
                )
        );
        foreach ($pagos as $key => $value) {
            $cabecera = array();
            $datos = array();
            foreach ($value as $key1 => $value1) {

                foreach ($value1 as $key2 => $value2) {
                    $cabecera[] = utf8_decode($key2);
                    ;
                    $value2 = str_replace(".0000", "", $value2);
                    $datos[] = utf8_decode("$value2");
                }
            }

            if ($flag == 0) {
                fputcsv($csv_file, $cabecera, ';', '"');
                $flag = 1;
            }
            fputcsv($csv_file, $datos, ';', '"');
        }


        fclose($csv_file);
        $this->autoRender = false;
    }

    function view($payment_id) {
        $this->data = $this->Payment->find('first', array(
            'conditions' => array('Payment.id' => $payment_id),
            'recursive' => -1,
            'fields' => array('Payment.*', 'Proyect.codigo'),
            'joins' => array(
                array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Payment.proyect_id'),
            )
        ));
    }

    function qualify($payment_id) {
        if (empty($this->data)) {
            $this->data = $this->Payment->find('first', array(
                'conditions' => array('Payment.id' => $payment_id),
                'recursive' => -1,
                'fields' => array('Payment.*', 'Proyect.codigo'),
                'joins' => array(
                    array('table' => 'proyects', 'alias' => 'Proyect', 'type' => 'left', 'conditions' => 'Proyect.id=Payment.proyect_id'),
                )
            ));
        } else {
            $this->request->data['Payment']['revisor'] = $this->Auth->user('id');
            $this->loadModel('User');
            $this->User->recursive = -1;
            $User = $this->User->find('first', array('conditions' => array('User.id' => $this->Auth->user('id'))));
            $UserAdjuntador = $this->User->find('first', array('conditions' => array('User.id' => $this->data['Payment']['adjuntador'])));
            if ($this->Payment->save($this->data)) {
                $Email = new CakeEmail('gmail');
                $Email->from(array('ipdr.soporte@gmail.com' => 'Apicativo IPDR'));
                if (!empty($UserAdjuntador['User']['email']))
                    $Email->addTo($UserAdjuntador['User']['email']);
                $Email->addTo('elopez@incoder.gov.co');
                $Email->addTo($User['User']['email']);
                $Email->subject('Revisión de documentos de desembolso Proyecto ' . $this->data['Proyect']['codigo']);

                $polizacal = $this->data['Payment']['calificacion_poliza'];
                $polizaobs = $this->data['Payment']['observacion_poliza'];
                $aprobacioncal = $this->data['Payment']['calificacion_aprobacion'];
                $aprobacionobs = $this->data['Payment']['observacion_aprobacion'];
                $bancariacal = $this->data['Payment']['calificacion_bancaria'];
                $bancariaobs = $this->data['Payment']['observacion_bancaria'];
                $notical = $this->data['Payment']['calificacion_notificacion'];
                $notiobs = $this->data['Payment']['observacion_notificacion'];
                $podercal = $this->data['Payment']['calificacion_poder'];
                $poderobs = $this->data['Payment']['observacion_poder'];
                $sanical = $this->data['Payment']['calificacion_sanitario'];
                $saniobs = $this->data['Payment']['observacion_sanitario'];
                $riegocal = $this->data['Payment']['calificacion_riego'];
                $riegoobs = $this->data['Payment']['observacion_riego'];
                $teccal = $this->data['Payment']['calificacion_tecnico'];
                $tecobs = $this->data['Payment']['observacion_tecnico'];
                $global = $this->data['Payment']['calificacion_global'];
                $global_obs = $this->data['Payment']['observacion_global'];
                $revisor = $User['User']['nombre'] . " " . $User['User']['primer_apellido'];
                $adjuntdoPor = $UserAdjuntador['User']['nombre'] . " " . $UserAdjuntador['User']['primer_apellido'];
                $mensaje = "<table border=\"1\">
    <tbody>
        
        <tr>
            <td>Revisado por:</td>
            <td>
            $revisor
            </td>
        </tr>
        <tr>
            <td>adjuntado por:</td>
            <td>
            $adjuntdoPor
            </td>
        </tr>
        <tr>
            <td>Póliza calificación</td>
            <td>
            $polizacal
            </td>
        </tr>
        <tr>
            <td>Póliza observación</td>
            <td>
            $polizaobs
            </td>
        </tr>
        
        <tr>
            <td>Aprobación de la Póliza calificación</td>
            <td>
            $aprobacioncal
            </td>
        </tr>
        <tr>
            <td>Aprobación de la Póliza observación</td>
            <td>
            $aprobacionobs
            </td>
        </tr>
        
        <tr>
            <td>Calificación Certificación bancaria</td>
            <td>
            
            $bancariacal
            </td>
        </tr>
        <tr>
            <td>Observaciones Certificación bancaria</td>
            <td>
            $bancariaobs
            </td>
        </tr>
        
        <tr>
            <td>Calificaión Formato Notificación</td>
            <td>
            $notical
            </td>
        </tr>
        <tr>
            <td>Observaciones Formato Notificación</td>
            <td>
            $notiobs
            </td>
        </tr>
       
        <tr>
            <td>Calificaión Poder</td>
            <td>
            $podercal
            </td>
        </tr>
        <tr>
            <td>Observaciones Poder</td>
            <td>
            $poderobs
            </td>
        </tr>
       
        <tr>
            <td>Calificaión Componente sanitario</td>
            <td>
            $sanical
            </td>
        </tr>
        <tr>
            <td>Observaciones Componente sanitario</td>
            <td>
            $saniobs
            </td>
        </tr>
        
        <tr>
            <td>Calificaión Distrito de riego</td>
            <td>
            $riegocal
            </td>
        </tr>
        <tr>
            <td>Observaciones Distrito de riego</td>
            <td>
            $riegoobs
            </td>
        </tr>
       
        <tr>
            <td>Revisión equipo técnico</td>
            <td>
            $teccal
            </td>
        </tr>
        <tr>
            <td>Revisión equipo técnico</td>
            <td>
            $tecobs
            </td>
        </tr>
        <tr>
            <td>Calificación global</td>
            <td>
               $global
            </td>
        </tr>
        <tr>
            <td>Observación global</td>
            <td>
               $global_obs
            </td>
        </tr>
    </tbody>
</table>";
                $Email->emailFormat('html');
                $Email->send(str_replace("empty", 'No aplica', $mensaje));
                $this->Session->setFlash('Registro guardado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Payments', 'action' => 'index'));
            }
        }
    }

}

?>
