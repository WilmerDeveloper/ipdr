<?php

Class AccompanimentsController extends AppController {

    public $name = 'Accompaniments';

    function edit($id) {
        $this->Accompaniment->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Accompaniment->find('first', array('conditions' => array('Accompaniment.id' => $id), 'fields' => array('Accompaniment.id', 'Accompaniment.user_id', 'Accompaniment.proyect_id', 'Accompaniment.adjunto', 'Accompaniment.observaciones', 'Accompaniment.id', 'Accompaniment.fecha')));
        } else {

            if ($this->Accompaniment->save($this->data)) {

                $last_id = $this->data['Accompaniment']['id'];
                $this->Accompaniment->Proyect->recursive = -1;
                $codigo = $this->Accompaniment->Proyect->field('codigo', array('Proyect.id' => $this->data['Accompaniment']['proyect_id']));
                $proyect_id = $this->data['Accompaniment']['proyect_id'];
               echo  $rutaArchivo = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                $nombreArchivo = "Acompanamiento-$last_id.pdf";
                $rutaArchivo.= "/" . $nombreArchivo;

                if (move_uploaded_file($this->data['Accompaniment']['archivo']['tmp_name'], $rutaArchivo)) {
                    $this->Accompaniment->id = $last_id;
                    $this->Accompaniment->saveField('adjunto', $nombreArchivo);
                    $this->Session->setFlash('Registro Adicionado correctamente con archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                } else {
                    $this->Session->setFlash('Error adjuntando archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'Accompaniments', 'action' => 'index', $this->data['Accompaniment']['proyect_id']));
                }
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add($proyect_id) {
        $this->layout = "ajax";
        $this->set('proyect_id', $proyect_id);
        if (empty($this->data)) {
            
        } else {
            $this->request->data['Accompaniment']['user_id'] = $this->Auth->user('id');
            if ($this->Accompaniment->save($this->data)) {
                $last_id = $this->Accompaniment->getLastInsertId();
                $this->Accompaniment->Proyect->recursive = -1;
                $codigo = $this->Accompaniment->Proyect->field('codigo', array('Proyect.id' => $proyect_id));
                $proyect_id = $this->data['Accompaniment']['proyect_id'];
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                $nombreArchivo = "Acompanamiento-$last_id.pdf";
                $rutaArchivo.= "/" . $nombreArchivo;
                var_dump($this->data['Accompaniment']['archivo']);
                if (move_uploaded_file($this->data['Accompaniment']['archivo']['tmp_name'], $rutaArchivo)) {
                    $this->Accompaniment->id = $last_id;
                    $this->Accompaniment->saveField('adjunto', $nombreArchivo);
                    $this->Session->setFlash('Registro Adicionado correctamente con archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                } else {
                    $this->Session->setFlash('Error adjuntando archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'Accompaniments', 'action' => 'index', $proyect_id));
                }
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index() {

        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);
        $this->Accompaniment->Proyect->recursive = -1;
        $codigo = $this->Accompaniment->Proyect->field('codigo', array('Proyect.id' => $proyect_id));
        $this->set('codigo', $codigo);

        if ($proyect_id != "") {

            $this->paginate = array('Accompaniment' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Accompaniment.id', 'Accompaniment.user_id', 'Accompaniment.proyect_id', 'Accompaniment.adjunto', 'Accompaniment.observaciones', 'Accompaniment.id')));
            $this->set('Accompaniments', $this->paginate(array('Accompaniment.proyect_id' => $proyect_id)));
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    function delete($accompaniment_id) {
        if ($this->Accompaniment->delete($accompaniment_id)) {
            $this->Session->setFlash('Registro borrado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Accompaniments', 'action' => 'index', $this->Session->read('proyect_id')));
        }
    }

}

?>