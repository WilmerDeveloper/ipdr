<?php

Class FollowsController extends AppController {

    public $name = 'Follows';

    public function edit($id) {
        $this->layout = "ajax";
        if (empty($this->data)) {
            $this->data = $this->Follow->find('first', array('conditions' => array('Follow.id' => $id), 'fields' => array('Follow.*')));
        } else {
            if ($this->Follow->save($this->data)) {
                if (!empty($this->data['Follow']['archivo_plan_inversion']['tmp_name'])) {

                    try {
                        $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . "PlanesInversion/";

                        if (!is_dir($rutaArchivo)) {
                            if (!mkdir($rutaArchivo)) {
                                echo "error creando archivo";
                                //redirect
                            }
                        }

                        $nombreArchivo = "PlanInversion-$id.pdf";
                        $rutaArchivo.= "/" . $nombreArchivo;

                        if (move_uploaded_file($this->data['Follow']['archivo_plan_inversion']['tmp_name'], $rutaArchivo)) {
                            $this->Session->setFlash('Se ha cargado el archivo del plan de inversion', 'flash_custom');
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
        $this->request->data['Follow']['proyect_id'] = $proyect_id;
        if ($this->Follow->save($this->request->data)) {
            $this->Session->setFlash('Registro creado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Follows', 'action' => 'index'));
        }
        $this->Session->setFlash('Este proyecto no ha sido evaluado');
        $this->redirect(array('controller' => 'Follows', 'action' => 'index'));
    }

    public function index() {
        $this->layout = "ajax";
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {

            $this->paginate = array('Follow' => array(
                    'maxLimit' => 500,
                    'limit' => 50,
                    'recursive' => -1,
                    'fields' => array('Follow.observaciones', 'Follow.id')
            ));
            $this->set('Follows', $this->paginate(array('Follow.proyect_id' => $proyect_id)));
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    public function print_letter($follow_id) {
        $this->layout = "ajax";
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);
        $this->set('follow_id', $follow_id);

        if ($proyect_id != "") {

            $this->set('comites', $this->Follow->Committee->find('all', array('recursive' => -1, 'conditions' => array('Committee.follow_id' => $follow_id))));
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    public function delete($id) {
        if ($this->Follow->delete($id)) {
            $this->Session->setFlash('Registro borrado correctamente');
            $this->redirect(array('controller' => 'Follows', 'action' => 'index'));
        } else {
            $this->Session->setFlash('Error borrando los datos, intentelo nuevamente.');
        }
    }

    public function close($follow_id) {

        $this->Follow->id = $follow_id;
        if ($this->Follow->field('cerrado', array('Follow.id' => $follow_id)) == 1) {
            if ($this->Follow->saveField('cerrado', 0)) {
                $this->loadModel('Budget');
                $this->Budget->updateAll(array('Budget.cerrado' => 0), array('Budget.follow_id' => $follow_id));
                $this->Session->setFlash('Registro abierto correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Follows', 'action' => 'index'));
            }
        } else {
            if ($this->Follow->saveField('cerrado', 1)) {
                $this->loadModel('Budget');
                $this->Budget->updateAll(array('Budget.cerrado' => 1), array('Budget.follow_id' => $follow_id));
                $this->Session->setFlash('Registro cerrado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Follows', 'action' => 'index'));
            }
        }
    }

    public function report() {

        $this->layout = 'csv';
        ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
        //create a file
        $filename = "Seguimiento_IPDR_" . date("Y.m.d") . ".csv";
        $csv_file = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $sql = "SELECT Proyect.id AS ProyectID, Proyect.codigo AS Codigo, Call2.nombre AS Convocatoria, Departament.name AS DT, count(*) AS PlanesInversion,
                ROUND((SELECT SUM(Payment.valor_desembolsado)
                FROM payments Payment
                WHERE Payment.proyect_id = Proyect.id
                GROUP BY Payment.proyect_id),0) as MontoDesembolsado,
                (SELECT MAX(Payment.fecha_desembolso) 
                FROM payments Payment
                WHERE Payment.proyect_id = Proyect.id
                GROUP BY Payment.proyect_id) as FechaPagoReal,
                (SELECT MIN(Committee.fecha) FROM committees Committee
                WHERE Committee.fecha != '0000-00-00' and Committee.proyect_id = Proyect.id
                GROUP BY Committee.proyect_id) as FechaPrimerComite,
                (SELECT count(*) FROM committees Committee2
                WHERE Committee2.fecha != '0000-00-00' and Committee2.proyect_id = Proyect.id
                GROUP BY Committee2.proyect_id) as NumeroComites,
                ROUND((SELECT SUM(Committee3.valor) FROM committees Committee3
                WHERE Committee3.fecha != '0000-00-00' and Committee3.proyect_id = Proyect.id
                GROUP BY Committee3.proyect_id),0) as ValorEjecutado,
                (SELECT  COUNT(*)
                FROM visits Visit
                WHERE Visit.proyect_id = Proyect.id
                GROUP BY Visit.proyect_id) as NumeroVisitasSeguimiento,
                (SELECT Visit3.porcentaje_ejecucion
                FROM visits Visit3
                WHERE Visit3.id = (SELECT MAX(Visit2.id)
                FROM visits Visit2
                WHERE Visit2.proyect_id = Proyect.id
                GROUP BY Visit2.proyect_id)) as PorcentajeEjecucion,
                (SELECT COUNT(*) FROM advices Advice 
                WHERE Advice.proyect_id = Proyect.id and Advice.fecha != '0000-00-00' 
                GROUP BY Advice.proyect_id) as NumeroVisitasAcompanamiento
                FROM follows Follow
                LEFT JOIN proyects Proyect ON Proyect.id = Follow.proyect_id
                LEFT JOIN calls Call2 ON Call2.id = Proyect.call_id
                LEFT JOIN departaments Departament ON Departament.id = Proyect.departament_id
                WHERE Proyect.codigo IS NOT NULL
                GROUP BY Proyect.id, Proyect.codigo, Call2.nombre, Departament.name";

        $results = $this->Follow->query($sql);

        //var_dump($results); exit;
        // The column headings of your .csv file
        $header_row = array("CÓDIGO DEL PROYECTO", "VIGENCIA", "DIRECCIÓN TERRITORIAL", "VALOR PP DESEMBOLSADO A LA CUENTA CONTROLADA", "FECHA DEL DESEMBOLSO", "FECHA DE INICIO DE LA EJECUCIÓN DEL PROYECTO PRODUCTIVO", "NÚMERO DE COMITÉS DE COMPRA EFECTUADOS", "VALOR EJECUTADO SEGÚN COMITÉS DE COMPRA", "PORCENTAJE DE EJECUCIÓN FINANCIERA (%)", "PORCENTAJE DE EJECUCIÓN FISICA (%)", "NUMERO DE VISITAS DE SEGUIMIENTO REALIZADAS", "NUMERO DE VISITAS DE ACOMPAÑAMIENTO REALIZADAS", "NUMERO DE MODIFICACIONES EFECTUADAS AL PROYECTO");

        $newRow = array();

        foreach ($header_row as $a) {
            $newRow[] = iconv('UTF-8', 'Windows-1252', $a);
        }

        fputcsv($csv_file, $newRow, ';', '"');


        foreach ($results as $result) {
            if ($result[0]['MontoDesembolsado'] != 0) {
                $porcentajeEjecucion = ($result[0]['ValorEjecutado'] / $result[0]['MontoDesembolsado']) * 100;
            } else {
                $porcentajeEjecucion = 0;
            }

            // Array indexes correspond to the field names in your db table(s)
            $row = array(
                $result[0]['Codigo'],
                $result[0]['Convocatoria'],
                $result[0]['DT'],
                number_format($result[0]['MontoDesembolsado'], 0, ',', '.'),
                $result[0]['FechaPagoReal'],
                $result[0]['FechaPrimerComite'],
                $result[0]['NumeroComites'],
                number_format($result[0]['ValorEjecutado'], 0, ',', '.'),
                number_format($porcentajeEjecucion, 1, ',', '.'),
                $result[0]['PorcentajeEjecucion'],
                $result[0]['NumeroVisitasSeguimiento'],
                $result[0]['NumeroVisitasAcompanamiento'],
                ($result[0]['PlanesInversion'] - 1)
            );

            $newRow = array();

            foreach ($row as $a) {
                $newRow[] = iconv('UTF-8', 'Windows-1252', $a);
            }

            fputcsv($csv_file, $newRow, ';', '"');
        }

        fclose($csv_file);
    }

}

?>