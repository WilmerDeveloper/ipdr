<?php

Class ExtractsController extends AppController {

    public $name = 'Extracts';

    public function edit($id) {
        $this->layout = "ajax";
        if (empty($this->data)) {
            $this->data = $this->Extract->find('first', array('conditions' => array('Extract.id' => $id), 'fields' => array('Extract.*')));
        } else {
            if ($this->Extract->save($this->data)) {
                if (!empty($this->data['Extract']['archivo']['tmp_name'])) {

                    try {
                        $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . "ExtractosBancariosComites/";

                        if (!is_dir($rutaArchivo)) {
                            if (!mkdir($rutaArchivo)) {
                                echo "error creando archivo";
                                //redirect
                            }
                        }

                        $nombreArchivo = "ExtractoBancarioComite-$id.pdf";
                        $rutaArchivo.= "/" . $nombreArchivo;

                        if (move_uploaded_file($this->data['Extract']['archivo']['tmp_name'], $rutaArchivo)) {
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
        $this->request->data['Extract']['proyect_id'] = $proyect_id;
        if ($this->Extract->save($this->request->data)) {
            $this->Session->setFlash('Registro creado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Extracts', 'action' => 'index', $proyect_id));
        }
        $this->Session->setFlash('Este proyecto no ha sido evaluado');
        $this->redirect(array('controller' => 'Extracts', 'action' => 'index', $proyect_id));
    }

    public function index($proyect_id) {
        if ($proyect_id != "") {
            $this->paginate = array('Extract' => array(
                    'maxLimit' => 500,
                    'limit' => 50,
                    'recursive' => -1,
                    'fields' => array('Extract.*')
            ));
            $this->set('Extracts', $this->paginate(array('Extract.proyect_id' => $proyect_id)));
            $this->set('proyect_id', $proyect_id);
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    public function delete($id, $proyect_id) {
        if ($this->Extract->delete($id)) {
            $this->Session->setFlash('Registro borrado correctamente');
            $this->redirect(array('controller' => 'Extracts', 'action' => 'index', $proyect_id));
        } else {
            $this->Session->setFlash('Error borrando los datos, intentelo nuevamente.');
        }
    }

    public function report() {

        $this->layout = 'csv';
        ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
        //create a file
        $filename = "Extractos_IPDR_" . date("Y.m.d") . ".csv";
        $csv_file = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $sql = "SELECT Proyect.codigo codigo, Call1.nombre vigencia, Departament.name direccion_territorial, MAX(Payment.fecha_desembolso) fecha_desembolso, SUM(Payment.valor_desembolsado) as total_desembolsado, MAX(Payment.cuenta_beneficiario) cuenta_beneficiario, MAX(Payment.banco_beneficiario) banco_beneficiario,
  (SELECT b.fecha
  FROM extracts b
  WHERE b.id = (SELECT MAX(a.id) FROM extracts a
				WHERE a.proyect_id = Proyect.id)) fecha_extracto,
  ISNULL((SELECT b.saldo
  FROM extracts b
  WHERE b.id = (SELECT MAX(a.id) FROM extracts a
				WHERE a.proyect_id = Proyect.id)),SUM(Payment.valor_desembolsado)) saldo,
 (SELECT COUNT(*) extractos
  FROM extracts b
  WHERE b.proyect_id = Proyect.id) as cantidad
  FROM proyects Proyect
  LEFT JOIN payments Payment ON Proyect.id = Payment.proyect_id
  LEFT JOIN calls Call1 ON Call1.id = Proyect.call_id
  LEFT JOIN departaments Departament ON Departament.id = Proyect.departament_id
  GROUP BY Proyect.codigo, Call1.nombre, Departament.name, Proyect.id
  ORDER BY vigencia, direccion_territorial ASC";

        $results = $this->Extract->query($sql);

        // The column headings of your .csv file
        $header_row = array("CÓDIGO", 
            "VIGENCIA", 
            "DIRECCIÓN TERRITORIAL", 
            "NÚMERO CUENTA BENEFICIARIO", 
            "BANCO BENEFICIARIO", 
            "FECHA DEL DESEMBOLSO", 
            "VALOR DESEMBOLSADO A LA CUENTA CONTROLADA",
            "SALDO CUENTA BANCARIA", 
            "FECHA ULTIMO EXTRACTO BANCARIO", 
            "CANTIDAD DE EXTRACTOS BANCARIOS CARGADOS");

        $newRow = array();

        foreach ($header_row as $a) {
            $newRow[] = iconv('UTF-8', 'Windows-1252', $a);
        }

        fputcsv($csv_file, $newRow, ';', '"');

        foreach ($results as $result) {

            // Array indexes correspond to the field names in your db table(s)
            $row = array(
                $result[0]['codigo'],
                $result[0]['vigencia'],
                $result[0]['direccion_territorial'],
                "'" . $result[0]['cuenta_beneficiario'],
                $result[0]['banco_beneficiario'],
                $result[0]['fecha_desembolso'],
                number_format($result[0]['total_desembolsado'], 0, ',', '.'),
                number_format($result[0]['saldo'], 0, ',', '.'),
                $result[0]['fecha_extracto'],
                $result[0]['cantidad']
            );

            $newRow = array();

            foreach ($row as $a) {
                $newRow[] = iconv('UTF-8', 'Windows-1252', $a);
            }

            fputcsv($csv_file, $newRow, ';', '"');
        }

        fclose($csv_file);
        exit;
    }

}

?>