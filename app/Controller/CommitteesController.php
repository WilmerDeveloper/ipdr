<?php

Class CommitteesController extends AppController {

    public $name = 'Committees';

    function add($proyect_id) {
        $this->set('proyect_id', $proyect_id);
        if (!empty($this->data)) {
            if ($this->Committee->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Committees', 'action' => 'index', $proyect_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->Committee->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Committee->find('first', array('conditions' => array('Committee.id' => $id)));
        } else {

            if ($this->Committee->save($this->data)) {

                if (!empty($this->data['Committee']['archivo_soporte']['tmp_name'])) {

                    try {
                        $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . "SoportesComites/";

                        if (!is_dir($rutaArchivo)) {
                            if (!mkdir($rutaArchivo)) {
                                echo "error creando archivo";
                                //redirect
                            }
                        }

                        $nombreArchivo = "SoporteComite-$id.pdf";
                        $rutaArchivo.= "/" . $nombreArchivo;

                        if (move_uploaded_file($this->data['Committee']['archivo_soporte']['tmp_name'], $rutaArchivo)) {
                            $this->Session->setFlash('Se ha cargado el archivo soporte del comité', 'flash_custom');
                        } else {
                            $this->Session->setFlash('Error cargando el archivo.', 'flash_custom');
                        }
                    } catch (Exception $exc) {
                        echo $exc->getMessage();
                        $this->Session->setFlash('No se pudo adjuntar archivo', 'flash_custom');
                    }
                }

                if (!empty($this->data['Committee']['archivo_cotizaciones']['tmp_name'])) {

                    try {
                        $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . "Cotizaciones/";

                        if (!is_dir($rutaArchivo)) {
                            if (!mkdir($rutaArchivo)) {
                                echo "error creando archivo";
                                //redirect
                            }
                        }

                        $nombreArchivo = "Cotizacion-$id.pdf";
                        $rutaArchivo.= "/" . $nombreArchivo;

                        if (move_uploaded_file($this->data['Committee']['archivo_cotizaciones']['tmp_name'], $rutaArchivo)) {
                            $this->Session->setFlash('Se ha cargado el archivo de la cotización', 'flash_custom');
                        } else {
                            $this->Session->setFlash('Error cargando el archivo.', 'flash_custom');
                        }
                    } catch (Exception $exc) {
                        echo $exc->getMessage();
                        $this->Session->setFlash('No se pudo adjuntar archivo', 'flash_custom');
                    }
                }

                if (!empty($this->data['Committee']['archivo_facturas']['tmp_name'])) {

                    try {
                        $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . "Facturas/";

                        if (!is_dir($rutaArchivo)) {
                            if (!mkdir($rutaArchivo)) {
                                echo "error creando archivo";
                                //redirect
                            }
                        }

                        $nombreArchivo = "Factura-$id.pdf";
                        $rutaArchivo.= "/" . $nombreArchivo;

                        if (move_uploaded_file($this->data['Committee']['archivo_facturas']['tmp_name'], $rutaArchivo)) {
                            $this->Session->setFlash('Se ha cargado el archivo de las facturas', 'flash_custom');
                        } else {
                            $this->Session->setFlash('Error cargando el archivo.', 'flash_custom');
                        }
                    } catch (Exception $exc) {
                        echo $exc->getMessage();
                        $this->Session->setFlash('No se pudo adjuntar archivo', 'flash_custom');
                    }
                }

                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($proyect_id) {
        $this->set('proyect_id', $proyect_id);
        $this->set('Committees', $this->Committee->find('all', array('conditions' => array('Committee.proyect_id' => $proyect_id))));
    }

    function delete($comite_id, $follow_id) {
        if ($this->Committee->CommitteeBudget->deleteAll(array('CommitteeBudget.committee_id' => $comite_id))) {
            if ($this->Committee->delete($comite_id)) {
                $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Committees', 'action' => 'index', $follow_id));
            }
        }
    }

}

?>