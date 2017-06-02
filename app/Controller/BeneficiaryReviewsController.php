<?php

Class BeneficiaryReviewsController extends AppController {

    public $name = 'BeneficiaryReviews';

    public function index($beneficiary_id) {
        $this->layout = "ajax";

        $this->BeneficiaryReview->Beneficiary->recursive = -1;
        $this->set('codigo', $this->BeneficiaryReview->Beneficiary->find("first", array("conditions" => array("Beneficiary.id" => $beneficiary_id), "fields" => array("Beneficiary.id", "Beneficiary.nombres", "Beneficiary.primer_apellido", "Beneficiary.segundo_apellido"))));

        if ($beneficiary_id == "") {
            $this->Session->setFlash('No ha seleccionado Proyecto');
            $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
        } else {
            $this->set('revisiones', $this->BeneficiaryReview->find('all', array('conditions' => array('BeneficiaryReview.beneficiary_id' => $beneficiary_id), 'order' => array('BeneficiaryReview.id DESC'), 'fields' => array('BeneficiaryReview.*', 'User.id', 'User.nombre', 'User.primer_apellido', 'User.segundo_apellido'))));
        }
    }

    public function add($beneficiary_id) {
        $this->layout = "ajax";
        $this->set('beneficiary_id', $beneficiary_id);
        $this->loadModel('Property');
        $property_id = $this->BeneficiaryReview->Beneficiary->field('Beneficiary.property_id', array('Beneficiary.id' => $beneficiary_id));
        $proyect_id = $this->BeneficiaryReview->Beneficiary->Property->field('Property.proyect_id', array('Property.id' => $property_id));
        if ($proyect_id != 0) {
            $predios = $this->BeneficiaryReview->Beneficiary->Property->find('list', array('conditions' => array('Property.proyect_id' => $proyect_id), 'fields' => array('Property.id', 'Property.nombre')));
        } else {
            $predios = array();
        }
        $this->set('properties', $predios);
        $this->BeneficiaryReview->Beneficiary->virtualFields = array(
            'name' => "Beneficiary.nombres+' '+Beneficiary.primer_apellido"
        );
        $this->BeneficiaryReview->Beneficiary->recursive = -1;

        if (empty($this->data)) {
            $this->data = $this->BeneficiaryReview->Beneficiary->find("first", array("conditions" => array("Beneficiary.id" => $beneficiary_id)));
            $this->set('beneficiaries', $this->BeneficiaryReview->Beneficiary->find('list', array('fields' => array('Beneficiary.id', 'Beneficiary.name'), 'conditions' => array('Beneficiary.property_id' => $this->data['Beneficiary']['property_id'], 'Beneficiary.beneficiary_id' => 0))));
        } else {

            $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Predio-" . $this->data['Beneficiary']['property_id'];
            if (!is_dir($rutaArchivo)) {
                if (!mkdir($rutaArchivo)) {
                    echo "error creando archivo";
                    //redirect
                }
            }
            $rutaArchivo = APP . "webroot" . DS . "files" . DS . "Predio-" . $this->data['Beneficiary']['property_id'] . DS . "Documentos verificacion";

            if (!is_dir($rutaArchivo)) {
                if (!mkdir($rutaArchivo)) {
                    echo "error creando archivo";
                    //redirect
                }
            }


            if (empty($this->data['Beneficiary']['beneficiary_id'])) {
                $this->request->data['Beneficiary']['beneficiary_id'] = 0;
            }

            $this->request->data['BeneficiaryReview']['user_id'] = $this->Auth->user('id');
            date_default_timezone_set("America/Bogota");
            $this->request->data['BeneficiaryReview']['fecha'] = date("Y-m-d h:i:s");

            if ($this->BeneficiaryReview->saveAll($this->data)) {
                $log = $this->BeneficiaryReview->Beneficiary->findLog(array('conditions' => array('Log.action' => 'edit', 'Log.user_id' => $this->Auth->user('id')), 'model' => 'Beneficiary', 'fields' => array('change'), 'order' => 'Log.id DESC ', 'limit' => 1));

                $txt = $log[0]['Log']['change'];

//                echo $this->BeneficiaryReview->getLastInsertID();
//                exit;

                $this->BeneficiaryReview->UpdateAll(array('BeneficiaryReview.cambio' => "'$txt'"), array('BeneficiaryReview.id' => $this->BeneficiaryReview->getLastInsertID()));

                $exito = 1;
                $last_id = $this->data['Beneficiary']['id'];
                $property_id = $this->data['Beneficiary']['property_id'];

                if (!empty($this->data['Beneficiary']['cedula']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Cedula-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['cedula']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_cedula' => $nombrearchivo
                                ));
                        $this->BeneficiaryReview->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando cedula', 'flash_custom');
                    }
                }



                if (!empty($this->data['Beneficiary']['policia']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Policia-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['policia']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_policia' => $nombrearchivo
                                ));
                        $this->BeneficiaryReview->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando policia', 'flash_custom');
                    }
                }

                if (!empty($this->data['Beneficiary']['contraloria']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Contraloria-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['contraloria']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {

                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_contraloria' => $nombrearchivo
                                ));
                        $this->BeneficiaryReview->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando contraloria', 'flash_custom');
                    }
                }

                if (!empty($this->data['Beneficiary']['procuraduria']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Procuraduria-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['procuraduria']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {

                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_procuraduria' => $nombrearchivo
                                ));
                        $this->BeneficiaryReview->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando contraloria', 'flash_custom');
                    }
                }

                if (!empty($this->data['Beneficiary']['sisben']['tmp_name'])) {
                    $nombrearchivo = "$property_id-Sisben-" . $last_id . ".pdf";
                    if (move_uploaded_file($this->data['Beneficiary']['sisben']['tmp_name'], $rutaArchivo . DS . $nombrearchivo)) {
                        $update = array('Beneficiary' => array(
                                'id' => $last_id,
                                'archivo_sisben' => $nombrearchivo
                                ));
                        $this->BeneficiaryReview->Beneficiary->save($update);
                    } else {
                        $exito = 0;
                        $this->Session->setFlash('Eror adjuntando sisben', 'flash_custom');
                    }
                }

                if ($exito == 1) {
                    $this->Session->setFlash('Beneficiario guardado correctamente', 'flash_custom');
                    $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
                }
            } else {
                $this->Session->setFlash('Error guardando datos');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        }
    }

}