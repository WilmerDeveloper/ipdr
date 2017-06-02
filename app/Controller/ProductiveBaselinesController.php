<?php

Class ProductiveBaselinesController extends AppController {

    public $name = 'ProductiveBaselines';

    function add($property_id) {

        $this->request->data['ProductiveBaseline']['user_id'] = $this->Auth->user('id');
        $this->request->data['ProductiveBaseline']['property_id'] = $property_id;
        $this->request->data['ProductiveBaseline']['sincronizado'] = 0;

        if ($this->ProductiveBaseline->save($this->data)) {
            $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'ProductiveBaselines', 'action' => 'index', $property_id));
        } else {
            $this->Session->setFlash('Error Guardando datos');
        }
    }

    function edit($id) {
        $this->ProductiveBaseline->recursive = -1;
        $this->data = $this->ProductiveBaseline->find('first', array('conditions' => array('ProductiveBaseline.id' => $id), 'fields' => array('ProductiveBaseline.id', 'ProductiveBaseline.property_id', 'ProductiveBaseline.adjunto_encuesta')));
        $this->loadModel('Proyect');
        $this->loadModel('Property');
        $proyect_id = $this->Property->field('proyect_id', array('Property.id' => $this->data['ProductiveBaseline']['property_id']));
        $codigo = $this->Proyect->field('codigo', array('Proyect.id' => $proyect_id));

        $this->set('codigo', $codigo);
        $this->set('proyect_id', $proyect_id);
    }

    function index($property_id) {

        $this->set('property_id', $property_id);
        $this->loadModel('Proyect');
        $this->loadModel('Property');
        $this->paginate = array('ProductiveBaseline' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('ProductiveBaseline.adjunto_encuesta', 'ProductiveBaseline.observaciones', 'ProductiveBaseline.fecha_entrevista', 'ProductiveBaseline.numero_visitas', 'ProductiveBaseline.nombre_coordinador', 'ProductiveBaseline.id')));
        $this->set('ProductiveBaselines', $this->paginate(array('ProductiveBaseline.property_id' => $property_id)));
        $proyect_id = $this->Property->field('proyect_id', array('Property.id' => $property_id));
        $codigo = $this->Proyect->field('codigo', array('Proyect.id' => $proyect_id));

        $this->set('codigo', $codigo);
        $this->set('proyect_id', $proyect_id);
    }

    function operative_index($productive_baseline_id) {
        $this->set('productive_baseline_id', $productive_baseline_id);
        $this->paginate = array('ProductiveBaseline' => array('recursive' => 0, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('User.primer_apellido', 'User.nombre', 'ProductiveBaseline.*')));
        $this->set('ProductiveBaselines', $this->paginate(array('ProductiveBaseline.id' => $productive_baseline_id)));
    }

    function operative_edit($id) {
        $this->ProductiveBaseline->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->ProductiveBaseline->find('first', array('conditions' => array('ProductiveBaseline.id' => $id), 'fields' => array('ProductiveBaseline.*')));
        } else {
            if ($this->ProductiveBaseline->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'ProductiveBaselines', 'action' => 'operative_index', $id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function upload_file($baseline_id) {
        if (empty($this->data)) {
            $this->data = $this->ProductiveBaseline->find('first', array('conditions' => array('ProductiveBaseline.id' => $baseline_id), 'fields' => array('ProductiveBaseline.property_id', 'ProductiveBaseline.id')));
        } else {
            if ($this->ProductiveBaseline->save($this->data)) {

                $this->loadModel('Proyect');
                $this->loadModel('Property');
                $proyect_id = $this->Property->field('proyect_id', array('Property.id' => $this->data['ProductiveBaseline']['property_id']));
                $codigo = $this->Proyect->field('codigo', array('Proyect.id' => $proyect_id));

                $rutaArchivo = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }

                $nombreArchivo = "Encuesta_productiva_$baseline_id.pdf";
                $rutaArchivo.= "/" . $nombreArchivo;
                $exito = 1;
                if (isset($this->data['ProductiveBaseline']['archivo_encuesta']['tmp_name'])) {
                    if (move_uploaded_file($this->data['ProductiveBaseline']['archivo_encuesta']['tmp_name'], $rutaArchivo)) {
                        $this->ProductiveBaseline->id = $baseline_id;
                        $this->ProductiveBaseline->saveField('adjunto_encuesta', $nombreArchivo);
                    } else {
                        $exito = 0;
                    }
                }

                if ($exito) {
                    $this->Session->setFlash('Registro Editado correctamente con archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'ProductiveBaselines', 'action' => 'edit', $baseline_id));
                } else {
                    $this->Session->setFlash('error adjuntando archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'ProductiveBaselines', 'action' => 'edit', $baseline_id));
                }
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

}

?>