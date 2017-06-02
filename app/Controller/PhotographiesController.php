<?php

Class PhotographiesController extends AppController {

    public $name = 'Photographies';

    public function add($visit_id) {
        $this->layout = "ajax";
        $this->set('visit_id', $visit_id);
        if (!empty($this->data)) {
            if ($this->Photography->saveAll($this->data)) {

                $last_id = $this->Photography->getLastInsertId();
                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Fotografias";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                    }
                }

                $exito = 1;

                if (!empty($this->data['Photography']['fotografia']['tmp_name'])) {
                    $nombrearchivo = "Fotografia-" . $visit_id . "-" . $last_id . ".jpg";
                    if (move_uploaded_file($this->data['Photography']['fotografia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Photography->query("update photographies set archivo='" . $nombrearchivo . "' WHERE id= $last_id");
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando el archivo', 'flash_custom');
                    }
                }

                if ($exito == 1) {
                    $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'Photographies', 'action' => 'index', $visit_id));
                } else {
                    $this->Session->setFlash('Error guardando el archivo por favor intentelo nuevamente', 'flash_custom');
                    $this->redirect(array('controller' => 'Photographies', 'action' => 'index', $visit_id));
                }
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->Photography->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Photography->find('first', array('conditions' => array('Photography.id' => $id)));
        } else {
            if ($this->Photography->save($this->data)) {

                $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Fotografias";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                    }
                }

                $exito = 1;

                if (!empty($this->data['Photography']['fotografia']['tmp_name'])) {
                    $nombrearchivo = "Fotografia-" . $this->request->data['Photography']['visit_id'] . "-" . $this->request->data['Photography']['id'] . ".jpg";
                    if (move_uploaded_file($this->data['Photography']['fotografia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $this->Photography->query("update photographies set archivo='" . $nombrearchivo . "' WHERE id=" . $this->data['Photography']['id']);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando el archivo', 'flash_custom');
                    }
                }

                if ($exito == 1) {
                    $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'Photographies', 'action' => 'index', $this->data['Photography']['visit_id']));
                } else {
                    $this->Session->setFlash('Error guardando el archivo por favor intentelo nuevamente', 'flash_custom');
                    $this->redirect(array('controller' => 'Photographies', 'action' => 'index', $this->data['Photography']['visit_id']));
                }
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    public function index($visit_id) {
        $this->set('visit_id', $visit_id);
        //$this->set('follow_id', $this->Photography->Visit->field('follow_id', array('Visit.id' => $visit_id)));
        $this->paginate = array('Photographies' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Photography.*')));
        $this->set('Photographies', $this->paginate(array('Photography.visit_id' => $visit_id)));
    }

    public function delete($id, $visit_id) {
        if ($this->Photography->delete($id)) {
            $this->Session->setFlash('Registro eliminado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Photographies', 'action' => 'index', $visit_id));
        } else {
            $this->Session->setFlash('Error eliminando registro, por favor intentelo nuevamente.', 'flash_custom');
        }
    }

}

?>