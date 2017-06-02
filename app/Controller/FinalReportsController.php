<?php

Class FinalReportsController extends AppController {

    public $name = 'FinalReports';

    public function edit($id) {
        $this->layout = "ajax";
        if (empty($this->data)) {
            $this->data = $this->FinalReport->find('first', array('conditions' => array('FinalReport.id' => $id), 'fields' => array('FinalReport.*')));
        } else {
            if ($this->FinalReport->save($this->data)) {
                if (!empty($this->data['FinalReport']['archivo_formato']['tmp_name'])) {

                    try {
                        $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . "ReportesFinales/";

                        if (!is_dir($rutaArchivo)) {
                            if (!mkdir($rutaArchivo)) {
                                echo "error creando archivo";
                                //redirect
                            }
                        }

                        $nombreArchivo = "ReporteFinal-$id.pdf";
                        $rutaArchivo.= "/" . $nombreArchivo;

                        if (move_uploaded_file($this->data['FinalReport']['archivo_formato']['tmp_name'], $rutaArchivo)) {
                            $this->Session->setFlash('Se ha cargado el archivo', 'flash_custom');
                        } else {
                            $this->Session->setFlash('Error cargando el archivo.', 'flash_custom');
                        }
                    } catch (Exception $exc) {
                        echo $exc->getMessage();
                        $this->Session->setFlash('No se pudo adjuntar archivo', 'flash_custom');
                    }
                }
                if (!empty($this->data['FinalReport']['archivo_cierre_cuenta']['tmp_name'])) {

                    try {
                        $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . "ReportesFinales/";

                        if (!is_dir($rutaArchivo)) {
                            if (!mkdir($rutaArchivo)) {
                                echo "error creando archivo";
                                //redirect
                            }
                        }

                        $nombreArchivo = "CierreCuenta-$id.pdf";
                        $rutaArchivo.= "/" . $nombreArchivo;

                        if (move_uploaded_file($this->data['FinalReport']['archivo_cierre_cuenta']['tmp_name'], $rutaArchivo)) {
                            $this->Session->setFlash('Se ha cargado el archivo', 'flash_custom');
                        } else {
                            $this->Session->setFlash('Error cargando el archivo.', 'flash_custom');
                        }
                    } catch (Exception $exc) {
                        echo $exc->getMessage();
                        $this->Session->setFlash('No se pudo adjuntar archivo', 'flash_custom');
                    }
                }

                $this->Session->setFlash('Registro editado correctamente');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function add($proyect_id) {
        $this->layout = "ajax";
        $this->request->data['FinalReport']['proyect_id'] = $proyect_id;
        if ($this->FinalReport->save($this->request->data)) {
            $this->Session->setFlash('Registro creado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'FinalReports', 'action' => 'index'));
        }
        $this->redirect(array('controller' => 'FinalReports', 'action' => 'index'));
    }

    public function index() {
        $this->layout = "ajax";
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {

            $this->paginate = array('FinalReport' => array(
                    'maxLimit' => 500,
                    'limit' => 50,
                    'recursive' => -1,
                    'fields' => array('FinalReport.generales', 'FinalReport.id')
            ));
            $this->set('FinalReports', $this->paginate(array('FinalReport.proyect_id' => $proyect_id)));
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    public function print_letter($final_report_id) {
        $this->layout = "pdf";
        $this->response->type('application/pdf');
        $this->FinalReport->recursive = -1;
        $reporteFinal = $this->FinalReport->find('first', array(
            'conditions' => array('FinalReport.id' => $final_report_id),
            'fields' => array('FinalReport.*')));
        $this->set('reporteFinal', $reporteFinal);

        App::Import('Model', 'Proyect');
        $Proyect = new Proyect();
        App::Import('Model', 'Beneficiary');
        $ben = new Beneficiary();
        App::Import('Model', 'InitialEvaluation');
        $evaluacion = new InitialEvaluation();
        App::Import('Model', 'Payment');
        $payment = new Payment();
        App::Import('Model', 'Follow');
        $follow = new Follow();
        App::Import('Model', 'Committee');
        $committee = new Committee();
//        App::Import('Model', 'Extract');
//        $extract = new Extract();

        $options = array();
        $options['recursive'] = -1;
        $options['conditions'] = array('Property.proyect_id' => $reporteFinal['FinalReport']['proyect_id']);
        $options['joins'] = array(
            array('table' => 'cities', 'alias' => 'City', 'type' => 'left', 'conditions' => array('Property.city_id=City.id')),
            array('table' => 'departaments', 'alias' => 'Departament', 'type' => 'left', 'conditions' => array('Departament.id=City.departament_id')),
        );
        $options['fields'] = array('Property.nombre', 'Property.vereda', 'City.name', 'Departament.name', 'Property.id', 'Property.area_total_ha', 'Property.area_total_m');

        $predios = $Proyect->Property->find('all', $options);
        $this->set('predios', $predios);
        $this->set('proyecto', $Proyect->find('first', array('recursive' => -1, 'fields' => array('Proyect.codigo', ''), 'conditions' => array('Proyect.id' => $reporteFinal['FinalReport']['proyect_id']))));

        $familias_campesinas = 0;
        $familias_desplazadas = 0;

        $campesinos = array('Campesino', 'Negritudes', 'Indigena', 'Mujer cabeza de familia', '');
        $desplazados = array('Desplazado');

        foreach ($predios as $predio) {
            $familias_campesinas += $ben->find('count', array('recursive' => -1, 'conditions' =>
                array('Beneficiary.property_id' => $predio['Property']['id'], 'Beneficiary.beneficiary_id' => 0, 'Beneficiary.calificacion_visita' => 'Cumple', "Beneficiary.tipo" => $campesinos)));
            $familias_desplazadas += $ben->find('count', array('recursive' => -1, 'conditions' =>
                array('Beneficiary.property_id' => $predio['Property']['id'], 'Beneficiary.beneficiary_id' => 0, 'Beneficiary.calificacion_visita' => 'Cumple', "Beneficiary.tipo" => $desplazados)));
        }
        $this->set('familias_campesinas', $familias_campesinas);
        $this->set('familias_desplazadas', $familias_desplazadas);

        $evaluacion1 = $evaluacion->find('first', array(
            'conditions' => array('InitialEvaluation.proyect_id' => $reporteFinal['FinalReport']['proyect_id']),
            'recursive' => -1,
            'fields' => array('InitialEvaluation.nombre_proyecto', 'InitialEvaluation.valor_total', 'InitialEvaluation.monto_solicitado'),
            'order' => array('InitialEvaluation.id DESC')));
        $this->set('evaluacion', $evaluacion1);

        $pagos = $payment->find('all', array(
            'conditions' => array('Payment.proyect_id' => $reporteFinal['FinalReport']['proyect_id']),
            'recursive' => -1,
            'fields' => array('Payment.*'),
            'order' => array('Payment.id ASC')));
        $this->set('pagos', $pagos);

        $modificaciones = $follow->find('all', array(
            'conditions' => array('Follow.proyect_id' => $reporteFinal['FinalReport']['proyect_id'], 'and' => array('Follow.tipo !=' => "", 'Follow.tipo !=' => "empty")),
            'recursive' => -1,
            'fields' => array('Follow.*'),
            'order' => array('Follow.id ASC')));
        $this->set('modificaciones', $modificaciones);

        $comites = $committee->find('all', array(
            'conditions' => array('Committee.proyect_id' => $reporteFinal['FinalReport']['proyect_id']),
            'recursive' => -1,
            'fields' => array('Committee.*'),
            'order' => array('Committee.id ASC')));
        $this->set('comites', $comites);

        $saldo_cuenta = $this->FinalReport->Proyect->Extract->field('Extract.saldo', array('Extract.proyect_id' => $reporteFinal['FinalReport']['proyect_id']), array('Extract.id' => 'DESC'));
        $this->set('saldo_cuenta', $saldo_cuenta);

        $lineas_productivas = $this->FinalReport->Proyect->FollowProduct->find('all', array(
            'conditions' => array('FollowProduct.proyect_id' => $reporteFinal['FinalReport']['proyect_id']),
            'recursive' => -1,
            'fields' => array('FollowProduct.cantidad', 'FollowProduct.cantidad_real', 'ProductiveActivity.nombre'),
            'joins' => array(
                array('table' => 'productive_activities',
                    'alias' => 'ProductiveActivity',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'ProductiveActivity.id = FollowProduct.productive_activity_id',
                    )
                )
            )
        ));
        $this->set('lineas_productivas', $lineas_productivas);

        $ejecucion_fisica = $this->FinalReport->Proyect->Visit->field('visit.porcentaje_ejecucion', array('visit.proyect_id' => $reporteFinal['FinalReport']['proyect_id']), array('visit.id' => 'DESC'));
        $this->set('ejecucion_fisica', $ejecucion_fisica);

        $visitas = $this->FinalReport->Proyect->Visit->find('all', array('conditions' => array('visit.proyect_id' => $reporteFinal['FinalReport']['proyect_id']), 'recursive' => -1, 'fields' => array('visit.fecha', 'visit.id'), 'order' => array('visit.id ASC')));
        $this->set('visitas', $visitas);

        $acompanamientos = $this->FinalReport->Proyect->Advice->find('all', array('conditions' => array('advice.proyect_id' => $reporteFinal['FinalReport']['proyect_id']), 'recursive' => -1, 'fields' => array('advice.fecha', 'advice.id', 'advice.observaciones'), 'order' => array('advice.id ASC')));
        $this->set('acompanamientos', $acompanamientos);
    }

    public function delete($id) {
        if ($this->FinalReport->delete($id)) {
            $this->Session->setFlash('Registro borrado correctamente');
            $this->redirect(array('controller' => 'FinalReports', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error borrando los datos, intentelo nuevamente.');
        }
    }

}

?>