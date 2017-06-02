<?php

App::uses('CakeEmail', 'Network/Email');

Class FormulationsController extends AppController {

    public $name = 'Formulations';

    function add($proyect_id) {
        $this->set('proyect_id', $proyect_id);
        if (empty($this->data)) {
            
        } else {

            $this->request->data['Formulation']['user_id'] = $this->Auth->user('id');
            $this->request->data['Formulation']['fecha_creacion'] = date("Y.m.d");
            if ($this->Formulation->save($this->data)) {
                $last_id = $this->Formulation->getLastInsertId();
                $this->Formulation->Proyect->recursive = -1;
                $codigo = $this->Formulation->Proyect->field('codigo', array('Proyect.id' => $proyect_id));
                $proyect_id = $this->data['Formulation']['proyect_id'];
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                $rutaArchivo1 = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $adjuntado=true;
                $ext = explode(".", $this->data['Formulation']['archivo']['name']);
                $conteo = count($ext);
                $nombreArchivo = "Formulacion-$last_id." . $ext[$conteo - 1];
                $rutaArchivo.= "/" . $nombreArchivo;
                
                if (move_uploaded_file($this->data['Formulation']['archivo']['tmp_name'], $rutaArchivo)) {
                    $this->Formulation->id = $last_id;
                    $this->Formulation->saveField('adjunto', $nombreArchivo);
                    
                } else {
                    $this->Session->setFlash('Error adjuntando archivo', 'flash_custom');
                    $adjuntado=false;
                }
                $ext1 = explode(".", $this->data['Formulation']['archivo_resumen']['name']);
                $conteo = count($ext1);
                $nombreArchivo1 = "Resumen-$last_id." . $ext1[$conteo - 1];
                $rutaArchivo1.= "/" . $nombreArchivo1;
                
                if (move_uploaded_file($this->data['Formulation']['archivo_resumen']['tmp_name'], $rutaArchivo1)) {
                    $this->Formulation->id = $last_id;
                    $this->Formulation->saveField('adjunto_resumen', $nombreArchivo1);
                    
                } else {
                    $this->Session->setFlash('Error adjuntando archivo', 'flash_custom');
                    $adjuntado=false;
                }
                
                if($adjuntado){
                    
                   
                    $Email = new CakeEmail('gmail');
                    $Email->from(array('ipdr.soporte@gmail.com' => 'Apicativo IPDR'));
                    $formulador = $this->Formulation->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->Auth->user('id')), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido')));
                    $proyecto = $this->Formulation->Proyect->find('first', array('recursive' => -1, 'conditions' => array('Proyect.id' => $this->data['Formulation']['proyect_id']), 'fields' => array('Proyect.codigo')));

                    App::Import('model', 'InitialEvaluation');
                    $InitialEvaluation = new InitialEvaluation();
                    $evaluacion = $InitialEvaluation->find('first', array('conditions' => array('InitialEvaluation.proyect_id' => $proyect_id), 'fields' => array('User.email'), 'order' => array('InitialEvaluation.id DESC')));
                    $Email->addTo($formulador['User']['email']);
                    $Email->addTo('ipdr.soporte@gmail.com');
                    $Email->addTo('elopez@incoder.gov.co');

                    $Email->subject("Formulación proyecto productivo  " . $proyecto['Proyect']['codigo']);
                    $Email->emailFormat('html');
                    $body = " <strong>La formulación del proyecto productivo  " . $proyecto['Proyect']['codigo'] . ", ha sido subida" . "</strong><br>";
                    $body .= " <strong>Observaciones: " . $this->data['Formulation']['observaciones'] . "</strong><br>";
                    $body .= " <strong>subida por: " . $formulador['User']['nombre'] . " " . $formulador['User']['primer_apellido'] . "</strong><br>";

                    $Email->send($body);
                    $this->Session->setFlash('Registro Adicionado correctamente con archivos', 'flash_custom');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }
                
            }
        }
    }

    function edit($id) {
        $this->Formulation->recursive = -1;
        if (empty($this->data)) {
            $this->data = $this->Formulation->find('first', array('conditions' => array('Formulation.id' => $id), 'fields' => array('Formulation.*')));
        } else {



            if ($this->Formulation->save($this->data)) {
                $last_id = $this->data['Formulation']['id'];
                $this->Formulation->Proyect->recursive = -1;
                $codigo = $this->Formulation->Proyect->field('codigo', array('Proyect.id' => $this->data['Formulation']['proyect_id']));
                $proyect_id = $this->data['Formulation']['proyect_id'];
                $rutaArchivo = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                $rutaArchivo1 = APP . "webroot" . "/" . "files" . "/$proyect_id-$codigo";
                if (!is_dir($rutaArchivo)) {
                    if (!mkdir($rutaArchivo)) {
                        echo "error creando archivo";
                        //redirect
                    }
                }
                $ext = explode(".", $this->data['Formulation']['archivo']['name']);
                $conteo = count($ext);
                $nombreArchivo = "Formulacion-$last_id." . $ext[$conteo - 1];
                $rutaArchivo.= "/" . $nombreArchivo;
                $adjuntado = true;
                if (move_uploaded_file($this->data['Formulation']['archivo']['tmp_name'], $rutaArchivo)) {
                    $this->Formulation->id = $last_id;
                    $this->Formulation->saveField('adjunto', $nombreArchivo);
                } else {
                    $this->Session->setFlash('Error adjuntando archivo', 'flash_custom');
                    $adjuntado = false;
                }

                $ext1 = explode(".", $this->data['Formulation']['archivo_resumen']['name']);
                $conteo = count($ext);
                $nombreArchivo = "Resumen-$last_id." . $ext[$conteo - 1];
                $rutaArchivo1.= "/" . $nombreArchivo;
                if (move_uploaded_file($this->data['Formulation']['archivo_resumen']['tmp_name'], $rutaArchivo)) {
                    $this->Formulation->id = $last_id;
                    $this->Formulation->saveField('adjunto_resumen', $nombreArchivo1);
                } else {
                    $this->Session->setFlash('Error adjuntando archivo', 'flash_custom');
                    $adjuntado = false;
                }
                if ($adjuntado) {
                    $Email = new CakeEmail('gmail');
                    $Email->from(array('ipdr.soporte@gmail.com' => 'Apicativo IPDR'));

                    App::Import('model', 'InitialEvaluation');
                    $InitialEvaluation = new InitialEvaluation();
                    $evaluacion = $InitialEvaluation->find('first', array('conditions' => array('InitialEvaluation.proyect_id' => $proyect_id), 'fields' => array('User.email'), 'order' => array('InitialEvaluation.id DESC')));

                    $formulador = $this->Formulation->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->Auth->user('id')), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido')));
                    $proyecto = $this->Formulation->Proyect->find('first', array('recursive' => -1, 'conditions' => array('Proyect.id' => $this->data['Formulation']['proyect_id']), 'fields' => array('Proyect.codigo')));
                    $Email->addTo($formulador['User']['email']);
                    $Email->addTo('ipdr.soporte@gmail.com');
                    $Email->addTo('elopez@incoder.gov.co');

                    $Email->subject("Formulación proyecto productivo  " . $proyecto['Proyect']['codigo']);
                    $Email->emailFormat('html');
                    $body = " <strong>La formulación del proyecto productivo  " . $proyecto['Proyect']['codigo'] . ", ha sido subida" . "</strong><br>";
                    $body .= " <strong>Observaciones: " . $this->data['Formulation']['observaciones'] . "</strong><br>";
                    $body .= " <strong>subida por: " . $formulador['User']['nombre'] . " " . $formulador['User']['primer_apellido'] . "</strong><br>";
                    $Email->send($body);
                    $this->Session->setFlash('Registro Editado correctamente con archivo', 'flash_custom');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                } else {
                    $this->redirect(array('controller' => 'Formulations', 'action' => 'index', $proyect_id));
                }
            }
        }
    }

    function review($id) {
        $this->Formulation->recursive = -1;
        $this->layout = "ajax";
        if (empty($this->data)) {

            $this->data = $this->Formulation->find('first', array('conditions' => array('Formulation.id' => $id), 'fields' => array('Formulation.id', 'Formulation.calificacion_evaluador', 'Formulation.concepto_evaluador', 'Formulation.user_id', 'Formulation.proyect_id', 'Formulation.id')));
        } else {


            if ($this->Formulation->save($this->data)) {

                $Email = new CakeEmail('gmail');
                $Email->from(array('ipdr.soporte@gmail.com' => 'Soporte aplicativo INCODER-IPDR  '));
                $formulador = $this->Formulation->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->data['Formulation']['user_id']), 'fields' => array('User.email')));
                $evaluador = $this->Formulation->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->Auth->user('id')), 'fields' => array('User.email', 'User.nombre', 'User.primer_apellido')));
                $proyecto = $this->Formulation->Proyect->find('first', array('recursive' => -1, 'conditions' => array('Proyect.id' => $this->data['Formulation']['proyect_id']), 'fields' => array('Proyect.codigo')));
                $Email->addTo($formulador['User']['email']);
                $Email->addTo('ipdr.soporte@gmail.com');
                $Email->addTo('elopez@incoder.gov.co');
                $Email->emailFormat('html');
                $Email->subject("Revisión de proyecto productivo " . $proyecto['Proyect']['codigo']);
                $body = " <strong>El proyecto productivo  " . $proyecto['Proyect']['codigo'] . ", ha sido revisado obteniendo los siguientes resultados: " . "</strong><br>";
                $body .= " <strong>Calificación: " . $this->data['Formulation']['calificacion_evaluador'] . "</strong><br>";
                $body .= " <strong>Concepto: " . $this->data['Formulation']['concepto_evaluador'] . "</strong><br>";
                $body .= " <strong>Revisado por: " . $evaluador['User']['nombre'] . " " . $evaluador['User']['primer_apellido'] . "</strong><br>";
                $Email->send($body);
               
                $this->Session->setFlash('Registro Editado correctamente ', 'flash_custom');
                $this->redirect(array('controller' => 'Formulations', 'action' => 'index'));
            }
        }
    }

    function index() {
        $this->layout = "ajax";
        $proyect_id = $this->Session->read('proyect_id');
        $this->set('proyect_id', $proyect_id);

        if ($proyect_id != "") {
            $this->paginate = array('Formulation' => array('order' => array('Formulation.fecha_creacion' => 'DESC', 'Formulation.id' => 'DESC'), 'maxLimit' => 500, 'limit' => 50, 'recursive' => 0, 'fields' => array('Formulation.*', 'User.nombre', 'User.primer_apellido', 'Proyect.codigo')));
            $this->set('Formulations', $this->paginate(array('Formulation.proyect_id' => $proyect_id)));
        } else {
            $this->Session->setFlash('No ha seleccionado proyecto', 'flash_custom');
            $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
        }
    }

    function delete($formulation_id) {
        if ($this->Formulation->delete($formulation_id)) {
            $this->Session->setFlash('Registro borrado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'Formulations', 'action' => 'index'));
        }
    }

}

?>