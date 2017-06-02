<?php

Class AdvicesController extends AppController {

    public $name = 'Advices';

    public function add($proyect_id) {
        $this->set('proyect_id', $proyect_id);
        if (!empty($this->data)) {
            if ($this->Advice->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Advices', 'action' => 'index', $proyect_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {
        $this->Advice->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Advice->find('first', array('conditions' => array('Advice.id' => $id)));
        } else {

            if ($this->Advice->save($this->data)) {
                if (!empty($this->data['Advice']['archivo']['tmp_name'])) {

                    try {
                        $rutaArchivo = APP . "webroot" . "/" . "files" . "/" . "Acompanamientos/";

                        if (!is_dir($rutaArchivo)) {
                            if (!mkdir($rutaArchivo)) {
                                echo "error creando archivo";
                                //redirect
                            }
                        }

                        $nombreArchivo = "Acompanamiento-$id.pdf";
                        $rutaArchivo.= "/" . $nombreArchivo;

                        if (move_uploaded_file($this->data['Advice']['archivo']['tmp_name'], $rutaArchivo)) {
                            $this->Session->setFlash('Se ha cargado el soporte del acompañamiento', 'flash_custom');
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

    public function index($proyect_id) {
        $this->set('proyect_id', $proyect_id);
        $this->set('Advices', $this->Advice->find('all', array('conditions' => array('Advice.proyect_id' => $proyect_id))));

    }

    public function delete($id, $proyect_id) {
        if ($this->Advice->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Advices', 'action' => 'index', $proyect_id));
        } else {
            $this->Session->setFlash('Error eliminando registro, por favor intentelo nuevamente.', 'flash_custom');
        }
    }

}

?>