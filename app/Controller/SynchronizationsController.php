<?php

Class SynchronizationsController extends AppController {

    public $name = 'Synchronizations';

    function edit($id) {
        $this->Synchronization->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->Synchronization->find('first', array('conditions' => array('Synchronization.id' => $id)));
        } else {

            if ($this->Synchronization->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Synchronizations', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function add() {
        if (empty($this->data)) {
            
        } else {

            if ($this->Synchronization->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Synchronizations', 'action' => 'index'));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function index() {
        $this->paginate = array('Synchronization' => array('maxLimit' => 500, 'limit' => 50));
        $this->set('Synchronizations', $this->paginate());
    }

    function sincronizar() {
        //Se buscan  localmente los proyectos que se encuentren sin sincronizar

        if (empty($this->data)) {
            
        } else {
            $alert = "";
            App::Import('model', 'Proyect');
            App::Import('model', 'Synchronization');
            $Synchronization = new Synchronization();
            $Synchronization->useDbConfig = "remoto";
            $Proyect = new Proyect();
            $ProyectRemoto = new Proyect();
            $ProyectRemoto->useDbConfig = "remoto";


            if ($proyectos = $Proyect->find('all', array('recursive' => -1, 'conditions' => array('Proyect.sincronizado' => 0)))) {

                foreach ($proyectos as $proyecto) {


                    if ($proyecto['Proyect']['remote_id'] == 0) {

                        $id_local = $proyecto['Proyect']['id'];
                        unset($proyecto['Proyect']['id']);
                        unset($proyecto['Proyect']['sincronizado']);
                        $ProyectRemoto->create();
                        if ($ProyectRemoto->save($proyecto)) {
                            $alert.="PROYECTO " . $proyecto['Proyect']['codigo'] . " INSERTADO CORRECTAMENTE <br>";
                            $id_servidor = $ProyectRemoto->getInsertID();
                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Proyect',
                                    'local_id' => $id_local,
                                    'server_id' => $id_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="PROYECTO " . $proyecto['Proyect']['codigo'] . " Sincronizado <br>";
                                $Proyect->query("UPDATE proyects set sincronizado=1,remote_id=$id_servidor WHERE id=$id_local");
                                $ProyectRemoto->query("UPDATE proyects set remote_id=$id_local WHERE id=$id_servidor");
                            } else {
                                $alert.= "PROYECTO " . $proyecto['Proyect']['codigo'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {

                            $alert.= "PROYECTO " . $proyecto['Proyect']['codigo'] . " NO SE PUDO GUARDAR <br>";
                        }
                    } else {

                        $id_local = $proyecto['Proyect']['id'];
                        $id_servidor = $proyecto['Proyect']['remote_id'];
                        $proyecto['Proyect']['id'] = $id_servidor;
                        $proyecto['Proyect']['remote_id'] = $id_local;
                        unset($proyecto['Proyect']['sincronizado']);
                        if ($ProyectRemoto->save($proyecto)) {
                            $alert.="PROYECTO " . $proyecto['Proyect']['codigo'] . " EDITADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Proyect',
                                    'local_id' => $id_local,
                                    'server_id' => $id_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="PROYECTO " . $proyecto['Proyect']['codigo'] . " Sincronizado <br>";
                                $Proyect->query("UPDATE proyects set sincronizado=1 WHERE id=$id_local");
                            } else {
                                $alert.= "PROYECTO " . $proyecto['Proyect']['codigo'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {

                            $alert.= "PROYECTO " . $proyecto['Proyect']['codigo'] . " NO SE PUDO GUARDAR <br>";
                        }
                    }
                }
            } else {
                $alert.= "NO HAY PROYECTOS PARA SINCRONIZAR <br>";
            }
            //Fin de sincronización de proyectos
            //INICIO SINCRONIZACION DE PREDIOS
            App::Import('model', 'Property');
            $PredioLocal = new Property();
            $PredioRemoto = new Property();
            $PredioLocal->useDbConfig = "default";
            $PredioRemoto->useDbConfig = "remoto";
            if ($predios = $PredioLocal->find('all', array('recursive' => -1, 'conditions' => array('Property.sincronizado' => 0)))) {

                foreach ($predios as $predio) {


                    if ($predio['Property']['remote_id'] == 0) {

                        $id_predio_local = $predio['Property']['id'];
                        unset($predio['Property']['id']);
                        unset($predio['Property']['sincronizado']);
                        if ($predio['Property']['proyect_id'] != 0) {
                            $id_proyecto_servidor = $ProyectRemoto->field('Proyect.id', array('Proyect.remote_id' => $predio['Property']['proyect_id']));
                        } else {
                            $id_proyecto_servidor = 0;
                        }
                        $predio['Property']['proyect_id'] = $id_proyecto_servidor;
                        $PredioRemoto->create();
                        if ($PredioRemoto->save($predio)) {
                            $alert.="PREDIO " . $predio['Property']['nombre'] . " INSERTADO CORRECTAMENTE <br>";
                            $id_predio_servidor = $PredioRemoto->getInsertID();
                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Property',
                                    'local_id' => $id_predio_local,
                                    'server_id' => $id_predio_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="PREDIO " . $predio['Property']['nombre'] . " SINCRONIZADO CORRECTAMENTE <br>";
                                $PredioLocal->query("UPDATE properties set sincronizado=1,remote_id=$id_predio_servidor WHERE id=$id_predio_local");
                                $PredioRemoto->query("UPDATE properties set remote_id=$id_predio_local WHERE id=$id_predio_servidor");
                            } else {
                                $alert.= "PREDIO " . $predio['Property']['nombre'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {

                            $alert.= "PREDIO " . $predio['Property']['nombre'] . " NO SE PUDO GUARDAR <br>";
                        }
                    } else {
                        //En el caso de que el registro ya se haya insertado

                        $id_predio_local = $predio['Property']['id'];
                        $id_predio_servidor = $predio['Property']['remote_id'];
                        $predio['Property']['id'] = $id_predio_servidor;
                        $predio['Property']['remote_id'] = $id_predio_local;
                        if ($predio['Property']['proyect_id'] != 0) {
                            $id_proyecto_servidor = $ProyectRemoto->field('Proyect.id', array('Proyect.remote_id' => $predio['Property']['proyect_id']));
                        } else {
                            $id_proyecto_servidor = 0;
                        }
                        $predio['Property']['proyect_id'] = $id_proyecto_servidor;


                        if ($PredioRemoto->save($predio)) {
                            $alert.="PREDIO " . $predio['Property']['nombre'] . " Actualizado CORRECTAMENTE <br>";
                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Property',
                                    'local_id' => $id_predio_local,
                                    'server_id' => $id_predio_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="PREDIO " . $predio['Property']['nombre'] . " SINCRONIZADO CORRECTAMENTE <br>";
                                $PredioLocal->query("UPDATE properties set sincronizado=1 WHERE id=$id_predio_local");
                            } else {
                                $alert.= "PREDIO " . $predio['Property']['nombre'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {

                            $alert.= "PREDIO " . $predio['Property']['nombre'] . " NO SE PUDO GUARDAR <br>";
                        }
                    }
                }
            } else {
                $alert.= "NO HAY PREDIOS PARA SINCRONIZAR <br>";
            }
            //FIN SINCRONIZAION DE PREDIOS
            //INICIO SINCRONIZACION DE FAMILIAS

            App::Import('model', 'Beneficiary');
            $BeneficiaryLocal = new Beneficiary();
            $BeneficiaryRemoto = new Beneficiary();
            $BeneficiaryLocal->useDbConfig = "default";
            $BeneficiaryRemoto->useDbConfig = "remoto";
            if ($beneficiarios = $BeneficiaryLocal->find('all', array('recursive' => -1, 'conditions' => array('Beneficiary.sincronizado' => 0)))) {

                foreach ($beneficiarios as $beneficiario) {


                    if ($beneficiario['Beneficiary']['remote_id'] == 0) {
                        $id_bene_local = $beneficiario['Beneficiary']['id'];
                        unset($beneficiario['Beneficiary']['id']);
                        unset($beneficiario['Beneficiary']['sincronizado']);
                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $beneficiario['Beneficiary']['property_id']));
                        $beneficiario['Beneficiary']['property_id'] = $id_predio_servidor;
                        $BeneficiaryRemoto->create();
                        if ($BeneficiaryRemoto->save($beneficiario)) {
                            $alert.="BENEFICIARIO " . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " INSERTADO CORRECTAMENTE <br>";
                            $id_bene_servidor = $BeneficiaryRemoto->getInsertID();
                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Beneficiary',
                                    'local_id' => $id_bene_local,
                                    'server_id' => $id_bene_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="BENEFICIARIO " . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " SINCRONIZADO CORRECTAMENTE <br>";
                                $BeneficiaryLocal->query("UPDATE beneficiaries set sincronizado=1,remote_id=$id_bene_servidor WHERE id=$id_bene_local");
                                $BeneficiaryRemoto->query("UPDATE beneficiaries set remote_id=$id_bene_local WHERE id=$id_bene_servidor");
                            } else {
                                $alert.= "BENEFICIARIO " . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {

                            $alert.= "Beneficiario " . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " NO SE PUDO GUARDAR <br>";
                        }
                    } else {



                        $id_bene_local = $beneficiario['Beneficiary']['id'];
                        $id_bene_servidor = $beneficiario['Beneficiary']['remote_id'];
                        $beneficiario['Beneficiary']['id'] = $beneficiario['Beneficiary']['remote_id'];
                        $beneficiario['Beneficiary']['remote_id'] = $id_bene_local;
                        $beneficiario['Beneficiary']['sincronizado'] = 1;

                        unset($beneficiario['Beneficiary']['sincronizado']);
                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $beneficiario['Beneficiary']['property_id']));
                        $beneficiario['Beneficiary']['property_id'] = $id_predio_servidor;

                        if ($BeneficiaryRemoto->save($beneficiario)) {
                            $alert.="BENEFICIARIO " . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " EDITADO CORRECTAMENTE <br>";
                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Beneficiary',
                                    'local_id' => $id_bene_local,
                                    'server_id' => $id_bene_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="BENEFICIARIO " . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " SINCRONIZADO CORRECTAMENTE <br>";
                                $BeneficiaryLocal->query("UPDATE beneficiaries set sincronizado=1 WHERE id=$id_bene_local");
                            } else {
                                $alert.= "BENEFICIARIO " . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {

                            $alert.= "Beneficiario " . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " NO SE PUDO GUARDAR <br>";
                        }
                    }
                }
            } else {
                $alert.= "NO HAY BENEFICIARIOS PARA SINCRONIZAR <br>";
            }
            //FIN DE SINCRONIZACION PAR BENEFICIARIOS
            //INICIO SINCRONIZACION TABLA PRODUCERS 

            App::Import('model', 'Producer');
            $ProducerLocal = new Producer();
            $ProducerRemoto = new Producer();
            $ProducerLocal->useDbConfig = "default";
            $ProducerRemoto->useDbConfig = "remoto";
            if ($productores = $ProducerLocal->find('all', array('recursive' => -1, 'conditions' => array('Producer.sincronizado' => 0)))) {

                foreach ($productores as $productor) {


                    if ($productor['Producer']['remote_id'] == 0) {
                        $id_prod_local = $productor['Producer']['id'];
                        unset($productor['Producer']['id']);

                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $productor['Producer']['property_id']));
                        $productor['Producer']['property_id'] = $id_predio_servidor;
                        $ProducerRemoto->create();
                        if ($ProducerRemoto->save($productor)) {
                            $id_prod_servidor = $ProducerRemoto->getInsertID();
                            $alert.="TABLA producers: " . $id_prod_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Producer',
                                    'local_id' => $id_prod_local,
                                    'server_id' => $id_prod_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: producers " . $id_prod_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $ProducerLocal->query("UPDATE producers set sincronizado=1,remote_id=$id_prod_servidor WHERE id=$id_prod_local");
                                $ProducerRemoto->query("UPDATE producers set remote_id=$id_prod_local WHERE id=$id_prod_servidor");
                            } else {
                                $alert.= "Tabla: producers " . $productor['Producer']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: producers " . $productor['Producer']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {

                        $id_prod_local = $productor['Producer']['id'];
                        $id_prod_servidor = $productor['Producer']['remote_id'];
                        $productor['Producer']['remote_id'] = $id_prod_local;
                        $productor['Producer']['id'] = $id_prod_servidor;
                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $productor['Producer']['property_id']));
                        $productor['Producer']['property_id'] = $id_predio_servidor;

                        if ($ProducerRemoto->save($productor)) {
                            $alert.="TABLA producers: " . $id_prod_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Producer',
                                    'local_id' => $id_prod_local,
                                    'server_id' => $id_prod_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: producers " . $id_prod_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $ProducerLocal->query("UPDATE producers set sincronizado=1  WHERE id=$id_prod_local");
                                $ProducerRemoto->query("UPDATE producers set sincronizado=1 WHERE id=$id_prod_servidor");
                            } else {
                                $alert.= "Tabla: producers " . $productor['Producer']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: producers " . $productor['Producer']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }

            //FIN DE PRODUCERS 
            //INICIO DE WATER RESOURCES

            App::Import('model', 'WaterResource');
            $WaterResourceLocal = new WaterResource();
            $WaterResourceRemoto = new WaterResource();
            $WaterResourceLocal->useDbConfig = "default";
            $WaterResourceRemoto->useDbConfig = "remoto";
            if ($recursos = $WaterResourceLocal->find('all', array('recursive' => -1, 'conditions' => array('WaterResource.sincronizado' => 0)))) {

                foreach ($recursos as $recurso) {


                    if ($recurso['WaterResource']['remote_id'] == 0) {
                        $id_rec_local = $recurso['WaterResource']['id'];
                        unset($recurso['WaterResource']['id']);

                        $id_prop_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $recurso['WaterResource']['property_id']));
                        $recurso['WaterResource']['property_id'] = $id_prop_servidor;

                        echo"<br><br><br>";
                        $WaterResourceRemoto->create();
                        if ($WaterResourceRemoto->save($recurso)) {
                            $id_rec_servidor = $WaterResourceRemoto->getInsertID();
                            $alert.="TABLA water_resources: " . $id_rec_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'WaterResource',
                                    'local_id' => $id_rec_local,
                                    'server_id' => $id_rec_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: water_resources " . $id_rec_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $WaterResourceLocal->query("UPDATE water_resources set sincronizado=1,remote_id=$id_rec_servidor WHERE id=$id_rec_local");
                                $WaterResourceRemoto->query("UPDATE water_resources set remote_id=$id_rec_local WHERE id=$id_rec_servidor");
                            } else {
                                $alert.= "Tabla: water_resources " . $recurso['WaterResource']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: water_resources " . $recurso['WaterResource']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_rec_local = $recurso['WaterResource']['id'];
                        $id_rec_servidor = $recurso['WaterResource']['remote_id'];
                        $recurso['WaterResource']['remote_id'] = $id_rec_local;
                        $recurso['WaterResource']['id'] = $id_rec_servidor;
                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $recurso['WaterResource']['property_id']));
                        $recurso['WaterResource']['property_id'] = $id_predio_servidor;

                        if ($WaterResourceRemoto->save($recurso)) {
                            $alert.="TABLA water_resources: " . $id_rec_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'WaterResource',
                                    'local_id' => $id_rec_local,
                                    'server_id' => $id_rec_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: water_resources " . $id_rec_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $WaterResourceLocal->query("UPDATE water_resources set sincronizado=1  WHERE id=$id_rec_local");
                                $WaterResourceRemoto->query("UPDATE water_resources set sincronizado=1 WHERE id=$id_rec_servidor");
                            } else {
                                $alert.= "Tabla: water_resources " . $recurso['WaterResource']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: water_resources " . $recurso['WaterResource']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }

            //FIN RECURSOS DE AGUA
            //
            //INICIO UNIDADES DE SUELO
            App::Import('model', 'FloorUnit');
            $FloorUnitLocal = new FloorUnit();
            $FloorUnitRemoto = new FloorUnit();
            $FloorUnitLocal->useDbConfig = "default";
            $FloorUnitRemoto->useDbConfig = "remoto";
            if ($unidades = $FloorUnitLocal->find('all', array('recursive' => -1, 'conditions' => array('FloorUnit.sincronizado' => 0)))) {

                foreach ($unidades as $unidad) {


                    if ($unidad['FloorUnit']['remote_id'] == 0) {
                        $id_floor_local = $unidad['FloorUnit']['id'];
                        unset($unidad['FloorUnit']['id']);

                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $unidad['FloorUnit']['property_id']));
                        $unidad['FloorUnit']['property_id'] = $id_predio_servidor;
                        $FloorUnitRemoto->create();
                        if ($FloorUnitRemoto->save($unidad)) {
                            $id_floor_servidor = $FloorUnitRemoto->getInsertID();
                            $alert.="TABLA floor_units: " . $id_floor_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'FloorUnit',
                                    'local_id' => $id_floor_local,
                                    'server_id' => $id_floor_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: floor_units " . $id_floor_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $FloorUnitLocal->query("UPDATE floor_units set sincronizado=1,remote_id=$id_floor_servidor WHERE id=$id_floor_local");
                                $FloorUnitRemoto->query("UPDATE floor_units set remote_id=$id_floor_local WHERE id=$id_floor_servidor");
                            } else {
                                $alert.= "Tabla: floor_units " . $unidad['FloorUnit']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: floor_units " . $unidad['FloorUnit']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_floor_local = $unidad['FloorUnit']['id'];
                        $id_floor_servidor = $unidad['FloorUnit']['remote_id'];
                        $unidad['FloorUnit']['remote_id'] = $id_floor_local;
                        $unidad['FloorUnit']['id'] = $id_floor_servidor;
                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $unidad['FloorUnit']['property_id']));
                        $unidad['FloorUnit']['property_id'] = $id_predio_servidor;

                        if ($FloorUnitRemoto->save($unidad)) {
                            $alert.="TABLA floor_units: " . $id_floor_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'FloorUnit',
                                    'local_id' => $id_floor_local,
                                    'server_id' => $id_floor_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: floor_units " . $id_floor_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $FloorUnitLocal->query("UPDATE floor_units set sincronizado=1  WHERE id=$id_floor_local");
                                $FloorUnitRemoto->query("UPDATE floor_units set sincronizado=1 WHERE id=$id_floor_servidor");
                            } else {
                                $alert.= "Tabla: floor_units " . $unidad['FloorUnit']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: floor_units " . $unidad['FloorUnit']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN DE UNIDADES DE SUELO
            ////
            //INICIO VIAS DE ACCESO
            App::Import('model', 'Road');
            $RoadLocal = new Road();
            $RoadRemoto = new Road();
            $RoadLocal->useDbConfig = "default";
            $RoadRemoto->useDbConfig = "remoto";
            if ($vias = $RoadLocal->find('all', array('recursive' => -1, 'conditions' => array('Road.sincronizado' => 0)))) {

                foreach ($vias as $via) {


                    if ($via['Road']['remote_id'] == 0) {
                        $id_road_local = $via['Road']['id'];
                        unset($via['Road']['id']);

                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $via['Road']['property_id']));
                        $via['Road']['property_id'] = $id_predio_servidor;
                        $RoadRemoto->create();
                        if ($RoadRemoto->save($via)) {
                            $id_road_servidor = $RoadRemoto->getInsertID();
                            $alert.="TABLA roads: " . $id_road_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Road',
                                    'local_id' => $id_road_local,
                                    'server_id' => $id_road_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: roads " . $id_road_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $RoadLocal->query("UPDATE roads set sincronizado=1,remote_id=$id_road_servidor WHERE id=$id_road_local");
                                $RoadRemoto->query("UPDATE roads set remote_id=$id_road_local WHERE id=$id_road_servidor");
                            } else {
                                $alert.= "Tabla: roads " . $via['Road']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: roads " . $via['Road']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_road_local = $via['Road']['id'];
                        $id_road_servidor = $via['Road']['remote_id'];
                        $via['Road']['remote_id'] = $id_road_local;
                        $via['Road']['id'] = $id_road_servidor;
                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $via['Road']['property_id']));
                        $via['Road']['property_id'] = $id_predio_servidor;

                        if ($RoadRemoto->save($via)) {
                            $alert.="TABLA roads: " . $id_road_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Road',
                                    'local_id' => $id_road_local,
                                    'server_id' => $id_road_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: roads " . $id_road_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $RoadLocal->query("UPDATE roads set sincronizado=1  WHERE id=$id_road_local");
                                $RoadRemoto->query("UPDATE roads set sincronizado=1 WHERE id=$id_road_servidor");
                            } else {
                                $alert.= "Tabla: roads " . $via['Road']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: roads " . $via['Road']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN DE VIAS
            //
            //
            //Inicio de usos de suelo;
            App::Import('model', 'LandUse');
            $LandUseLocal = new LandUse();
            $LandUseRemoto = new LandUse();
            $LandUseLocal->useDbConfig = "default";
            $LandUseRemoto->useDbConfig = "remoto";
            if ($usos = $LandUseLocal->find('all', array('recursive' => -1, 'conditions' => array('LandUse.sincronizado' => 0)))) {

                foreach ($usos as $uso) {


                    if ($uso['LandUse']['remote_id'] == 0) {
                        $id_uso_local = $uso['LandUse']['id'];
                        unset($uso['LandUse']['id']);

                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $uso['LandUse']['property_id']));
                        $uso['LandUse']['property_id'] = $id_predio_servidor;
                        $LandUseRemoto->create();
                        if ($LandUseRemoto->save($uso)) {
                            $id_uso_servidor = $LandUseRemoto->getInsertID();
                            $alert.="TABLA land_uses: " . $id_uso_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'LandUse',
                                    'local_id' => $id_uso_local,
                                    'server_id' => $id_uso_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: land_uses " . $id_uso_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $LandUseLocal->query("UPDATE land_uses set sincronizado=1,remote_id=$id_uso_servidor WHERE id=$id_uso_local");
                                $LandUseRemoto->query("UPDATE land_uses set remote_id=$id_uso_local WHERE id=$id_uso_servidor");
                            } else {
                                $alert.= "Tabla: land_uses " . $uso['LandUse']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: land_uses " . $uso['LandUse']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_uso_local = $uso['LandUse']['id'];
                        $id_uso_servidor = $uso['LandUse']['remote_id'];
                        $uso['LandUse']['remote_id'] = $id_uso_local;
                        $uso['LandUse']['id'] = $id_uso_servidor;
                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $uso['LandUse']['property_id']));
                        $uso['LandUse']['property_id'] = $id_predio_servidor;

                        if ($LandUseRemoto->save($uso)) {
                            $alert.="TABLA land_uses: " . $id_uso_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'LandUse',
                                    'local_id' => $id_uso_local,
                                    'server_id' => $id_uso_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: land_uses " . $id_uso_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $LandUseLocal->query("UPDATE land_uses set sincronizado=1  WHERE id=$id_uso_local");
                                $LandUseRemoto->query("UPDATE land_uses set sincronizado=1 WHERE id=$id_uso_servidor");
                            } else {
                                $alert.= "Tabla: land_uses " . $uso['LandUse']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: land_uses " . $uso['LandUse']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }

            //FIN DE usos de tierra
            ///
            //
            //INICIO DE Infrastructura agropecuaria

            App::Import('model', 'AgriculturalInfrastructure');
            $AgriculturalInfrastructureLocal = new AgriculturalInfrastructure();
            $AgriculturalInfrastructureRemoto = new AgriculturalInfrastructure();
            $AgriculturalInfrastructureLocal->useDbConfig = "default";
            $AgriculturalInfrastructureRemoto->useDbConfig = "remoto";
            if ($infrastructuras = $AgriculturalInfrastructureLocal->find('all', array('recursive' => -1, 'conditions' => array('AgriculturalInfrastructure.sincronizado' => 0)))) {

                foreach ($infrastructuras as $infrastructura) {


                    if ($infrastructura['AgriculturalInfrastructure']['remote_id'] == 0) {
                        $id_agro_infra_local = $infrastructura['AgriculturalInfrastructure']['id'];
                        unset($infrastructura['AgriculturalInfrastructure']['id']);

                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $infrastructura['AgriculturalInfrastructure']['property_id']));
                        $infrastructura['AgriculturalInfrastructure']['property_id'] = $id_predio_servidor;
                        $AgriculturalInfrastructureRemoto->create();
                        if ($AgriculturalInfrastructureRemoto->save($infrastructura)) {
                            $id_agro_infra_servidor = $AgriculturalInfrastructureRemoto->getInsertID();
                            $alert.="TABLA agricultural_infrastructures: " . $id_agro_infra_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'AgriculturalInfrastructure',
                                    'local_id' => $id_agro_infra_local,
                                    'server_id' => $id_agro_infra_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: agricultural_infrastructures " . $id_agro_infra_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $AgriculturalInfrastructureLocal->query("UPDATE agricultural_infrastructures set sincronizado=1,remote_id=$id_agro_infra_servidor WHERE id=$id_agro_infra_local");
                                $AgriculturalInfrastructureRemoto->query("UPDATE agricultural_infrastructures set remote_id=$id_agro_infra_local WHERE id=$id_agro_infra_servidor");
                            } else {
                                $alert.= "Tabla: agricultural_infrastructures " . $infrastructura['AgriculturalInfrastructure']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: agricultural_infrastructures " . $infrastructura['AgriculturalInfrastructure']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_agro_infra_local = $infrastructura['AgriculturalInfrastructure']['id'];
                        $id_agro_infra_servidor = $infrastructura['AgriculturalInfrastructure']['remote_id'];
                        $infrastructura['AgriculturalInfrastructure']['remote_id'] = $id_agro_infra_local;
                        $infrastructura['AgriculturalInfrastructure']['id'] = $id_agro_infra_servidor;
                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $infrastructura['AgriculturalInfrastructure']['property_id']));
                        $infrastructura['AgriculturalInfrastructure']['property_id'] = $id_predio_servidor;

                        if ($AgriculturalInfrastructureRemoto->save($infrastructura)) {
                            $alert.="TABLA agricultural_infrastructures: " . $id_agro_infra_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'AgriculturalInfrastructure',
                                    'local_id' => $id_agro_infra_local,
                                    'server_id' => $id_agro_infra_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: agricultural_infrastructures " . $id_agro_infra_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $AgriculturalInfrastructureLocal->query("UPDATE agricultural_infrastructures set sincronizado=1  WHERE id=$id_agro_infra_local");
                                $AgriculturalInfrastructureRemoto->query("UPDATE agricultural_infrastructures set sincronizado=1 WHERE id=$id_agro_infra_servidor");
                            } else {
                                $alert.= "Tabla: agricultural_infrastructures " . $infrastructura['AgriculturalInfrastructure']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: agricultural_infrastructures " . $infrastructura['AgriculturalInfrastructure']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }

            //FIN DE AGRICULTAURAL INFRASTRUCTURE

            App::Import('model', 'Risk');
            $RiskLocal = new Risk();
            $RiskRemoto = new Risk();
            $RiskLocal->useDbConfig = "default";
            $RiskRemoto->useDbConfig = "remoto";
            if ($risks = $RiskLocal->find('all', array('recursive' => -1, 'conditions' => array('Risk.sincronizado' => 0)))) {

                foreach ($risks as $risk) {


                    if ($risk['Risk']['remote_id'] == 0) {
                        $id_risk_local = $risk['Risk']['id'];
                        unset($risk['Risk']['id']);

                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $risk['Risk']['property_id']));
                        $risk['Risk']['property_id'] = $id_predio_servidor;
                        $RiskRemoto->create();
                        if ($RiskRemoto->save($risk)) {
                            $id_risk_servidor = $RiskRemoto->getInsertID();
                            $alert.="TABLA risks: " . $id_risk_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Risk',
                                    'local_id' => $id_risk_local,
                                    'server_id' => $id_risk_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: risks " . $id_risk_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $RiskLocal->query("UPDATE risks set sincronizado=1,remote_id=$id_risk_servidor WHERE id=$id_risk_local");
                                $RiskRemoto->query("UPDATE risks set remote_id=$id_risk_local WHERE id=$id_risk_servidor");
                            } else {
                                $alert.= "Tabla: risks " . $risk['Risk']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: risks " . $risk['Risk']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_risk_local = $risk['Risk']['id'];
                        $id_risk_servidor = $risk['Risk']['remote_id'];
                        $risk['Risk']['remote_id'] = $id_risk_local;
                        $risk['Risk']['id'] = $id_risk_servidor;
                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $risk['Risk']['property_id']));
                        $risk['Risk']['property_id'] = $id_predio_servidor;

                        if ($RiskRemoto->save($risk)) {
                            $alert.="TABLA risks: " . $id_risk_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Risk',
                                    'local_id' => $id_risk_local,
                                    'server_id' => $id_risk_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: risks " . $id_risk_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $RiskLocal->query("UPDATE risks set sincronizado=1  WHERE id=$id_risk_local");
                                $RiskRemoto->query("UPDATE risks set sincronizado=1 WHERE id=$id_risk_servidor");
                            } else {
                                $alert.= "Tabla: risks " . $risk['Risk']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: risks " . $risk['Risk']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN DE RISK
            //
            //
            //INICIO DE PRDUCTIVE BASELINE


            App::Import('model', 'ProductiveBaseline');
            $ProductiveBaselineLocal = new ProductiveBaseline();
            $ProductiveBaselineRemoto = new ProductiveBaseline();
            $ProductiveBaselineLocal->useDbConfig = "default";
            $ProductiveBaselineRemoto->useDbConfig = "remoto";
            if ($productive_baselines = $ProductiveBaselineLocal->find('all', array('recursive' => -1, 'conditions' => array('ProductiveBaseline.sincronizado' => 0)))) {

                foreach ($productive_baselines as $baseline) {


                    if ($baseline['ProductiveBaseline']['remote_id'] == 0) {
                        $id_prodBaseline_local = $baseline['ProductiveBaseline']['id'];
                        unset($baseline['ProductiveBaseline']['id']);

                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $baseline['ProductiveBaseline']['property_id']));
                        $baseline['ProductiveBaseline']['property_id'] = $id_predio_servidor;
                        $ProductiveBaselineRemoto->create();
                        if ($ProductiveBaselineRemoto->save($baseline)) {
                            $id_prodBaseline_servidor = $ProductiveBaselineRemoto->getInsertID();
                            $alert.="TABLA productive_baselines: " . $id_prodBaseline_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'ProductiveBaseline',
                                    'local_id' => $id_prodBaseline_local,
                                    'server_id' => $id_prodBaseline_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: productive_baselines " . $id_prodBaseline_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $ProductiveBaselineLocal->query("UPDATE productive_baselines set sincronizado=1,remote_id=$id_prodBaseline_servidor WHERE id=$id_prodBaseline_local");
                                $ProductiveBaselineRemoto->query("UPDATE productive_baselines set remote_id=$id_prodBaseline_local WHERE id=$id_prodBaseline_servidor");
                            } else {
                                $alert.= "Tabla: productive_baselines " . $baseline['ProductiveBaseline']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: productive_baselines " . $baseline['ProductiveBaseline']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_prodBaseline_local = $baseline['ProductiveBaseline']['id'];
                        $id_prodBaseline_servidor = $baseline['ProductiveBaseline']['remote_id'];
                        $baseline['ProductiveBaseline']['remote_id'] = $id_prodBaseline_local;
                        $baseline['ProductiveBaseline']['id'] = $id_prodBaseline_servidor;
                        $id_predio_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $baseline['ProductiveBaseline']['property_id']));
                        $baseline['ProductiveBaseline']['property_id'] = $id_predio_servidor;

                        if ($ProductiveBaselineRemoto->save($baseline)) {
                            $alert.="TABLA productive_baselines: " . $id_prodBaseline_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'ProductiveBaseline',
                                    'local_id' => $id_prodBaseline_local,
                                    'server_id' => $id_prodBaseline_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: productive_baselines " . $id_prodBaseline_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $ProductiveBaselineLocal->query("UPDATE productive_baselines set sincronizado=1  WHERE id=$id_prodBaseline_local");
                                $ProductiveBaselineRemoto->query("UPDATE productive_baselines set sincronizado=1 WHERE id=$id_prodBaseline_servidor");
                            } else {
                                $alert.= "Tabla: productive_baselines " . $baseline['ProductiveBaseline']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: productive_baselines " . $baseline['ProductiveBaseline']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }

            //FIN PRODUCTIVA BASELINES
            //
            //INICIO SYSTEMA AGROPECUARIO

            App::Import('model', 'AgriculturalSystem');
            $AgriculturalSystemLocal = new AgriculturalSystem();
            $AgriculturalSystemRemoto = new AgriculturalSystem();
            $AgriculturalSystemLocal->useDbConfig = "default";
            $AgriculturalSystemRemoto->useDbConfig = "remoto";
            if ($agriculturalsystems = $AgriculturalSystemLocal->find('all', array('recursive' => -1, 'conditions' => array('AgriculturalSystem.sincronizado' => 0)))) {

                foreach ($agriculturalsystems as $agriculturalsystem) {


                    if ($agriculturalsystem['AgriculturalSystem']['remote_id'] == 0) {
                        $id_prodBaseline_local = $agriculturalsystem['AgriculturalSystem']['id'];
                        unset($agriculturalsystem['AgriculturalSystem']['id']);

                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $agriculturalsystem['AgriculturalSystem']['productive_baseline_id']));
                        $agriculturalsystem['AgriculturalSystem']['productive_baseline_id'] = $id_baseline_servidor;
                        $AgriculturalSystemRemoto->create();
                        if ($AgriculturalSystemRemoto->save($agriculturalsystem)) {
                            $id_prodBaseline_servidor = $AgriculturalSystemRemoto->getInsertID();
                            $alert.="TABLA agricultural_systems: " . $id_prodBaseline_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'AgriculturalSystem',
                                    'local_id' => $id_prodBaseline_local,
                                    'server_id' => $id_prodBaseline_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: agricultural_systems " . $id_prodBaseline_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $AgriculturalSystemLocal->query("UPDATE agricultural_systems set sincronizado=1,remote_id=$id_prodBaseline_servidor WHERE id=$id_prodBaseline_local");
                                $AgriculturalSystemRemoto->query("UPDATE agricultural_systems set remote_id=$id_prodBaseline_local WHERE id=$id_prodBaseline_servidor");
                            } else {
                                $alert.= "Tabla: agricultural_systems " . $agriculturalsystem['AgriculturalSystem']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: agricultural_systems " . $agriculturalsystem['AgriculturalSystem']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_prodBaseline_local = $agriculturalsystem['AgriculturalSystem']['id'];
                        $id_prodBaseline_servidor = $agriculturalsystem['AgriculturalSystem']['remote_id'];
                        $agriculturalsystem['AgriculturalSystem']['remote_id'] = $id_prodBaseline_local;
                        $agriculturalsystem['AgriculturalSystem']['id'] = $id_prodBaseline_servidor;
                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $agriculturalsystem['AgriculturalSystem']['productive_baseline_id']));
                        $agriculturalsystem['AgriculturalSystem']['productive_baseline_id'] = $id_baseline_servidor;

                        if ($AgriculturalSystemRemoto->save($agriculturalsystem)) {
                            $alert.="TABLA agricultural_systems: " . $id_prodBaseline_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'AgriculturalSystem',
                                    'local_id' => $id_prodBaseline_local,
                                    'server_id' => $id_prodBaseline_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: agricultural_systems " . $id_prodBaseline_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $AgriculturalSystemLocal->query("UPDATE agricultural_systems set sincronizado=1  WHERE id=$id_prodBaseline_local");
                                $AgriculturalSystemRemoto->query("UPDATE agricultural_systems set sincronizado=1 WHERE id=$id_prodBaseline_servidor");
                            } else {
                                $alert.= "Tabla: agricultural_systems " . $agriculturalsystem['AgriculturalSystem']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: agricultural_systems " . $agriculturalsystem['AgriculturalSystem']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN PRODUCTIVA BASELINES
            //
            //INICIO LivestockSystem

            App::Import('model', 'LivestockSystem');
            $LivestockSystemLocal = new LivestockSystem();
            $LivestockSystemRemoto = new LivestockSystem();
            $LivestockSystemLocal->useDbConfig = "default";
            $LivestockSystemRemoto->useDbConfig = "remoto";
            if ($livestocksystems = $LivestockSystemLocal->find('all', array('recursive' => -1, 'conditions' => array('LivestockSystem.sincronizado' => 0)))) {

                foreach ($livestocksystems as $livestocksystem) {


                    if ($livestocksystem['LivestockSystem']['remote_id'] == 0) {
                        $id_livestock_local = $livestocksystem['LivestockSystem']['id'];
                        unset($livestocksystem['LivestockSystem']['id']);

                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $livestocksystem['LivestockSystem']['productive_baseline_id']));
                        $livestocksystem['LivestockSystem']['productive_baseline_id'] = $id_baseline_servidor;
                        $LivestockSystemRemoto->create();
                        if ($LivestockSystemRemoto->save($livestocksystem)) {
                            $id_livestock_servidor = $LivestockSystemRemoto->getInsertID();
                            $alert.="TABLA livestock_systems: " . $id_livestock_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'LivestockSystem',
                                    'local_id' => $id_livestock_local,
                                    'server_id' => $id_livestock_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: livestock_systems " . $id_livestock_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $LivestockSystemLocal->query("UPDATE livestock_systems set sincronizado=1,remote_id=$id_livestock_servidor WHERE id=$id_livestock_local");
                                $LivestockSystemRemoto->query("UPDATE livestock_systems set remote_id=$id_livestock_local WHERE id=$id_livestock_servidor");
                            } else {
                                $alert.= "Tabla: livestock_systems " . $livestocksystem['LivestockSystem']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: livestock_systems " . $livestocksystem['LivestockSystem']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_livestock_local = $livestocksystem['LivestockSystem']['id'];
                        $id_livestock_servidor = $livestocksystem['LivestockSystem']['remote_id'];
                        $livestocksystem['LivestockSystem']['remote_id'] = $id_livestock_local;
                        $livestocksystem['LivestockSystem']['id'] = $id_livestock_servidor;
                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $livestocksystem['LivestockSystem']['productive_baseline_id']));
                        $livestocksystem['LivestockSystem']['productive_baseline_id'] = $id_baseline_servidor;

                        if ($LivestockSystemRemoto->save($livestocksystem)) {
                            $alert.="TABLA livestock_systems: " . $id_livestock_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'LivestockSystem',
                                    'local_id' => $id_livestock_local,
                                    'server_id' => $id_livestock_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: livestock_systems " . $id_livestock_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $LivestockSystemLocal->query("UPDATE livestock_systems set sincronizado=1  WHERE id=$id_livestock_local");
                                $LivestockSystemRemoto->query("UPDATE livestock_systems set sincronizado=1 WHERE id=$id_livestock_servidor");
                            } else {
                                $alert.= "Tabla: livestock_systems " . $livestocksystem['LivestockSystem']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: livestock_systems " . $livestocksystem['LivestockSystem']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN LivestockSystem
            //
            ///
            //
            //INICIO HogInventory

            App::Import('model', 'HogInventory');
            $HogInventoryLocal = new HogInventory();
            $HogInventoryRemoto = new HogInventory();
            $HogInventoryLocal->useDbConfig = "default";
            $HogInventoryRemoto->useDbConfig = "remoto";
            if ($hogInventorys = $HogInventoryLocal->find('all', array('recursive' => -1, 'conditions' => array('HogInventory.sincronizado' => 0)))) {

                foreach ($hogInventorys as $hogInventory) {


                    if ($hogInventory['HogInventory']['remote_id'] == 0) {
                        $id_hog_local = $hogInventory['HogInventory']['id'];
                        unset($hogInventory['HogInventory']['id']);

                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $hogInventory['HogInventory']['productive_baseline_id']));
                        $hogInventory['HogInventory']['productive_baseline_id'] = $id_baseline_servidor;
                        $HogInventoryRemoto->create();
                        if ($HogInventoryRemoto->save($hogInventory)) {
                            $id_hog_servidor = $HogInventoryRemoto->getInsertID();
                            $alert.="TABLA hog_inventories: " . $id_hog_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'HogInventory',
                                    'local_id' => $id_hog_local,
                                    'server_id' => $id_hog_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: hog_inventories " . $id_hog_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $HogInventoryLocal->query("UPDATE hog_inventories set sincronizado=1,remote_id=$id_hog_servidor WHERE id=$id_hog_local");
                                $HogInventoryRemoto->query("UPDATE hog_inventories set remote_id=$id_hog_local WHERE id=$id_hog_servidor");
                            } else {
                                $alert.= "Tabla: hog_inventories " . $hogInventory['HogInventory']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: hog_inventories " . $hogInventory['HogInventory']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_hog_local = $hogInventory['HogInventory']['id'];
                        $id_hog_servidor = $hogInventory['HogInventory']['remote_id'];
                        $hogInventory['HogInventory']['remote_id'] = $id_hog_local;
                        $hogInventory['HogInventory']['id'] = $id_hog_servidor;
                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $hogInventory['HogInventory']['productive_baseline_id']));
                        $hogInventory['HogInventory']['productive_baseline_id'] = $id_baseline_servidor;

                        if ($HogInventoryRemoto->save($hogInventory)) {
                            $alert.="TABLA hog_inventories: " . $id_hog_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'HogInventory',
                                    'local_id' => $id_hog_local,
                                    'server_id' => $id_hog_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: hog_inventories " . $id_hog_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $HogInventoryLocal->query("UPDATE hog_inventories set sincronizado=1  WHERE id=$id_hog_local");
                                $HogInventoryRemoto->query("UPDATE hog_inventories set sincronizado=1 WHERE id=$id_hog_servidor");
                            } else {
                                $alert.= "Tabla: hog_inventories " . $hogInventory['HogInventory']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: hog_inventories " . $hogInventory['HogInventory']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN HogInventory
            //
            ///
            //
            //INICIO PoultryInventory

            App::Import('model', 'PoultryInventory');
            $PoultryInventoryLocal = new PoultryInventory();
            $PoultryInventoryRemoto = new PoultryInventory();
            $PoultryInventoryLocal->useDbConfig = "default";
            $PoultryInventoryRemoto->useDbConfig = "remoto";
            if ($poultryInventorys = $PoultryInventoryLocal->find('all', array('recursive' => -1, 'conditions' => array('PoultryInventory.sincronizado' => 0)))) {

                foreach ($poultryInventorys as $poultryInventory) {


                    if ($poultryInventory['PoultryInventory']['remote_id'] == 0) {
                        $id_poultry_local = $poultryInventory['PoultryInventory']['id'];
                        unset($poultryInventory['PoultryInventory']['id']);

                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $poultryInventory['PoultryInventory']['productive_baseline_id']));
                        $poultryInventory['PoultryInventory']['productive_baseline_id'] = $id_baseline_servidor;
                        $PoultryInventoryRemoto->create();
                        if ($PoultryInventoryRemoto->save($poultryInventory)) {
                            $id_poultry_servidor = $PoultryInventoryRemoto->getInsertID();
                            $alert.="TABLA poultry_inventories: " . $id_poultry_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'PoultryInventory',
                                    'local_id' => $id_poultry_local,
                                    'server_id' => $id_poultry_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: poultry_inventories " . $id_poultry_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $PoultryInventoryLocal->query("UPDATE poultry_inventories set sincronizado=1,remote_id=$id_poultry_servidor WHERE id=$id_poultry_local");
                                $PoultryInventoryRemoto->query("UPDATE poultry_inventories set remote_id=$id_poultry_local WHERE id=$id_poultry_servidor");
                            } else {
                                $alert.= "Tabla: poultry_inventories " . $poultryInventory['PoultryInventory']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: poultry_inventories " . $poultryInventory['PoultryInventory']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_poultry_local = $poultryInventory['PoultryInventory']['id'];
                        $id_poultry_servidor = $poultryInventory['PoultryInventory']['remote_id'];
                        $poultryInventory['PoultryInventory']['remote_id'] = $id_poultry_local;
                        $poultryInventory['PoultryInventory']['id'] = $id_poultry_servidor;
                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $poultryInventory['PoultryInventory']['productive_baseline_id']));
                        $poultryInventory['PoultryInventory']['productive_baseline_id'] = $id_baseline_servidor;

                        if ($PoultryInventoryRemoto->save($poultryInventory)) {
                            $alert.="TABLA poultry_inventories: " . $id_poultry_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'PoultryInventory',
                                    'local_id' => $id_poultry_local,
                                    'server_id' => $id_poultry_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: poultry_inventories " . $id_poultry_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $PoultryInventoryLocal->query("UPDATE poultry_inventories set sincronizado=1  WHERE id=$id_poultry_local");
                                $PoultryInventoryRemoto->query("UPDATE poultry_inventories set sincronizado=1 WHERE id=$id_poultry_servidor");
                            } else {
                                $alert.= "Tabla: poultry_inventories " . $poultryInventory['PoultryInventory']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: poultry_inventories " . $poultryInventory['PoultryInventory']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN PoultryInventory
            //
            ///
            //
            //INICIO LivestockSpecy

            App::Import('model', 'LivestockSpecy');
            $LivestockSpecyLocal = new LivestockSpecy();
            $LivestockSpecyRemoto = new LivestockSpecy();
            $LivestockSpecyLocal->useDbConfig = "default";
            $LivestockSpecyRemoto->useDbConfig = "remoto";
            if ($ivestockSpecys = $LivestockSpecyLocal->find('all', array('recursive' => -1, 'conditions' => array('LivestockSpecy.sincronizado' => 0)))) {

                foreach ($ivestockSpecys as $ivestockSpecy) {


                    if ($ivestockSpecy['LivestockSpecy']['remote_id'] == 0) {
                        $id_ivestocksp_local = $ivestockSpecy['LivestockSpecy']['id'];
                        unset($ivestockSpecy['LivestockSpecy']['id']);

                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $ivestockSpecy['LivestockSpecy']['productive_baseline_id']));
                        $ivestockSpecy['LivestockSpecy']['productive_baseline_id'] = $id_baseline_servidor;
                        $LivestockSpecyRemoto->create();
                        if ($LivestockSpecyRemoto->save($ivestockSpecy)) {
                            $id_ivestocksp_servidor = $LivestockSpecyRemoto->getInsertID();
                            $alert.="TABLA livestock_species: " . $id_ivestocksp_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'LivestockSpecy',
                                    'local_id' => $id_ivestocksp_local,
                                    'server_id' => $id_ivestocksp_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: livestock_species " . $id_ivestocksp_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $LivestockSpecyLocal->query("UPDATE livestock_species set sincronizado=1,remote_id=$id_ivestocksp_servidor WHERE id=$id_ivestocksp_local");
                                $LivestockSpecyRemoto->query("UPDATE livestock_species set remote_id=$id_ivestocksp_local WHERE id=$id_ivestocksp_servidor");
                            } else {
                                $alert.= "Tabla: livestock_species " . $ivestockSpecy['LivestockSpecy']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: livestock_species " . $ivestockSpecy['LivestockSpecy']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_ivestocksp_local = $ivestockSpecy['LivestockSpecy']['id'];
                        $id_ivestocksp_servidor = $ivestockSpecy['LivestockSpecy']['remote_id'];
                        $ivestockSpecy['LivestockSpecy']['remote_id'] = $id_ivestocksp_local;
                        $ivestockSpecy['LivestockSpecy']['id'] = $id_ivestocksp_servidor;
                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $ivestockSpecy['LivestockSpecy']['productive_baseline_id']));
                        $ivestockSpecy['LivestockSpecy']['productive_baseline_id'] = $id_baseline_servidor;

                        if ($LivestockSpecyRemoto->save($ivestockSpecy)) {
                            $alert.="TABLA livestock_species: " . $id_ivestocksp_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'LivestockSpecy',
                                    'local_id' => $id_ivestocksp_local,
                                    'server_id' => $id_ivestocksp_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: livestock_species " . $id_ivestocksp_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $LivestockSpecyLocal->query("UPDATE livestock_species set sincronizado=1  WHERE id=$id_ivestocksp_local");
                                $LivestockSpecyRemoto->query("UPDATE livestock_species set sincronizado=1 WHERE id=$id_ivestocksp_servidor");
                            } else {
                                $alert.= "Tabla: livestock_species " . $ivestockSpecy['LivestockSpecy']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: livestock_species " . $ivestockSpecy['LivestockSpecy']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN LivestockSpecy
            //
            ///
            //
            //INICIO FishInventory

            App::Import('model', 'FishInventory');
            $FishInventoryLocal = new FishInventory();
            $FishInventoryRemoto = new FishInventory();
            $FishInventoryLocal->useDbConfig = "default";
            $FishInventoryRemoto->useDbConfig = "remoto";
            if ($fishInventorys = $FishInventoryLocal->find('all', array('recursive' => -1, 'conditions' => array('FishInventory.sincronizado' => 0)))) {

                foreach ($fishInventorys as $fishInventory) {


                    if ($fishInventory['FishInventory']['remote_id'] == 0) {
                        $id_fishInventory_local = $fishInventory['FishInventory']['id'];
                        unset($fishInventory['FishInventory']['id']);

                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $fishInventory['FishInventory']['productive_baseline_id']));
                        $fishInventory['FishInventory']['productive_baseline_id'] = $id_baseline_servidor;
                        $FishInventoryRemoto->create();
                        if ($FishInventoryRemoto->save($fishInventory)) {
                            $id_fishInventory_servidor = $FishInventoryRemoto->getInsertID();
                            $alert.="TABLA fish_inventories: " . $id_fishInventory_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'FishInventory',
                                    'local_id' => $id_fishInventory_local,
                                    'server_id' => $id_fishInventory_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: fish_inventories " . $id_fishInventory_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $FishInventoryLocal->query("UPDATE fish_inventories set sincronizado=1,remote_id=$id_fishInventory_servidor WHERE id=$id_fishInventory_local");
                                $FishInventoryRemoto->query("UPDATE fish_inventories set remote_id=$id_fishInventory_local WHERE id=$id_fishInventory_servidor");
                            } else {
                                $alert.= "Tabla: fish_inventories " . $fishInventory['FishInventory']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: fish_inventories " . $fishInventory['FishInventory']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_fishInventory_local = $fishInventory['FishInventory']['id'];
                        $id_fishInventory_servidor = $fishInventory['FishInventory']['remote_id'];
                        $fishInventory['FishInventory']['remote_id'] = $id_fishInventory_local;
                        $fishInventory['FishInventory']['id'] = $id_fishInventory_servidor;
                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $fishInventory['FishInventory']['productive_baseline_id']));
                        $fishInventory['FishInventory']['productive_baseline_id'] = $id_baseline_servidor;

                        if ($FishInventoryRemoto->save($fishInventory)) {
                            $alert.="TABLA fish_inventories: " . $id_fishInventory_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'FishInventory',
                                    'local_id' => $id_fishInventory_local,
                                    'server_id' => $id_fishInventory_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: fish_inventories " . $id_fishInventory_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $FishInventoryLocal->query("UPDATE fish_inventories set sincronizado=1  WHERE id=$id_fishInventory_local");
                                $FishInventoryRemoto->query("UPDATE fish_inventories set sincronizado=1 WHERE id=$id_fishInventory_servidor");
                            } else {
                                $alert.= "Tabla: fish_inventories " . $fishInventory['FishInventory']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: fish_inventories " . $fishInventory['FishInventory']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN FishInventory
            //
            ///
            //
            //INICIO BeekeepingInventory

            App::Import('model', 'BeekeepingInventory');
            $BeekeepingInventoryLocal = new BeekeepingInventory();
            $BeekeepingInventoryRemoto = new BeekeepingInventory();
            $BeekeepingInventoryLocal->useDbConfig = "default";
            $BeekeepingInventoryRemoto->useDbConfig = "remoto";
            if ($beeinventorys = $BeekeepingInventoryLocal->find('all', array('recursive' => -1, 'conditions' => array('BeekeepingInventory.sincronizado' => 0)))) {

                foreach ($beeinventorys as $beeinventory) {


                    if ($beeinventory['BeekeepingInventory']['remote_id'] == 0) {
                        $id_beeinventory_local = $beeinventory['BeekeepingInventory']['id'];
                        unset($beeinventory['BeekeepingInventory']['id']);

                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $beeinventory['BeekeepingInventory']['productive_baseline_id']));
                        $beeinventory['BeekeepingInventory']['productive_baseline_id'] = $id_baseline_servidor;
                        $BeekeepingInventoryRemoto->create();
                        if ($BeekeepingInventoryRemoto->save($beeinventory)) {
                            $id_beeinventory_servidor = $BeekeepingInventoryRemoto->getInsertID();
                            $alert.="TABLA beekeeping_inventories: " . $id_beeinventory_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'BeekeepingInventory',
                                    'local_id' => $id_beeinventory_local,
                                    'server_id' => $id_beeinventory_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: beekeeping_inventories " . $id_beeinventory_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $BeekeepingInventoryLocal->query("UPDATE beekeeping_inventories set sincronizado=1,remote_id=$id_beeinventory_servidor WHERE id=$id_beeinventory_local");
                                $BeekeepingInventoryRemoto->query("UPDATE beekeeping_inventories set remote_id=$id_beeinventory_local WHERE id=$id_beeinventory_servidor");
                            } else {
                                $alert.= "Tabla: beekeeping_inventories " . $beeinventory['BeekeepingInventory']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: beekeeping_inventories " . $beeinventory['BeekeepingInventory']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_beeinventory_local = $beeinventory['BeekeepingInventory']['id'];
                        $id_beeinventory_servidor = $beeinventory['BeekeepingInventory']['remote_id'];
                        $beeinventory['BeekeepingInventory']['remote_id'] = $id_beeinventory_local;
                        $beeinventory['BeekeepingInventory']['id'] = $id_beeinventory_servidor;
                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $beeinventory['BeekeepingInventory']['productive_baseline_id']));
                        $beeinventory['BeekeepingInventory']['productive_baseline_id'] = $id_baseline_servidor;

                        if ($BeekeepingInventoryRemoto->save($beeinventory)) {
                            $alert.="TABLA beekeeping_inventories: " . $id_beeinventory_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'BeekeepingInventory',
                                    'local_id' => $id_beeinventory_local,
                                    'server_id' => $id_beeinventory_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: beekeeping_inventories " . $id_beeinventory_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $BeekeepingInventoryLocal->query("UPDATE beekeeping_inventories set sincronizado=1  WHERE id=$id_beeinventory_local");
                                $BeekeepingInventoryRemoto->query("UPDATE beekeeping_inventories set sincronizado=1 WHERE id=$id_beeinventory_servidor");
                            } else {
                                $alert.= "Tabla: beekeeping_inventories " . $beeinventory['BeekeepingInventory']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: beekeeping_inventories " . $beeinventory['BeekeepingInventory']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN BeekeepingInventory
            //
            ///
            //FIN PRODUCTIVA BASELINES
            //
            //INICIO TechnicalAid

            App::Import('model', 'TechnicalAid');
            $TechnicalAidLocal = new TechnicalAid();
            $TechnicalAidRemoto = new TechnicalAid();
            $TechnicalAidLocal->useDbConfig = "default";
            $TechnicalAidRemoto->useDbConfig = "remoto";
            if ($technicalaids = $TechnicalAidLocal->find('all', array('recursive' => -1, 'conditions' => array('TechnicalAid.sincronizado' => 0)))) {

                foreach ($technicalaids as $technicalaid) {


                    if ($technicalaid['TechnicalAid']['remote_id'] == 0) {
                        $id_technical_local = $technicalaid['TechnicalAid']['id'];
                        unset($technicalaid['TechnicalAid']['id']);

                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $technicalaid['TechnicalAid']['productive_baseline_id']));
                        $technicalaid['TechnicalAid']['productive_baseline_id'] = $id_baseline_servidor;
                        $TechnicalAidRemoto->create();
                        if ($TechnicalAidRemoto->save($technicalaid)) {
                            $id_technical_servidor = $TechnicalAidRemoto->getInsertID();
                            $alert.="TABLA technical_aids: " . $id_technical_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'TechnicalAid',
                                    'local_id' => $id_technical_local,
                                    'server_id' => $id_technical_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: technical_aids " . $id_technical_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $TechnicalAidLocal->query("UPDATE technical_aids set sincronizado=1,remote_id=$id_technical_servidor WHERE id=$id_technical_local");
                                $TechnicalAidRemoto->query("UPDATE technical_aids set remote_id=$id_technical_local WHERE id=$id_technical_servidor");
                            } else {
                                $alert.= "Tabla: technical_aids " . $technicalaid['TechnicalAid']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: technical_aids " . $technicalaid['TechnicalAid']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_technical_local = $technicalaid['TechnicalAid']['id'];
                        $id_technical_servidor = $technicalaid['TechnicalAid']['remote_id'];
                        $technicalaid['TechnicalAid']['remote_id'] = $id_technical_local;
                        $technicalaid['TechnicalAid']['id'] = $id_technical_servidor;
                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $technicalaid['TechnicalAid']['productive_baseline_id']));
                        $technicalaid['TechnicalAid']['productive_baseline_id'] = $id_baseline_servidor;

                        if ($TechnicalAidRemoto->save($technicalaid)) {
                            $alert.="TABLA technical_aids: " . $id_technical_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'TechnicalAid',
                                    'local_id' => $id_technical_local,
                                    'server_id' => $id_technical_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: technical_aids " . $id_technical_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $TechnicalAidLocal->query("UPDATE technical_aids set sincronizado=1  WHERE id=$id_technical_local");
                                $TechnicalAidRemoto->query("UPDATE technical_aids set sincronizado=1 WHERE id=$id_technical_servidor");
                            } else {
                                $alert.= "Tabla: technical_aids " . $technicalaid['TechnicalAid']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: technical_aids " . $technicalaid['TechnicalAid']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN TechnicalAid
            //
            ///
            //
            //INICIO Marketing

            App::Import('model', 'Marketing');
            $MarketingLocal = new Marketing();
            $MarketingRemoto = new Marketing();
            $MarketingLocal->useDbConfig = "default";
            $MarketingRemoto->useDbConfig = "remoto";
            if ($marketings = $MarketingLocal->find('all', array('recursive' => -1, 'conditions' => array('Marketing.sincronizado' => 0)))) {

                foreach ($marketings as $marketing) {


                    if ($marketing['Marketing']['remote_id'] == 0) {
                        $id_marketing_local = $marketing['Marketing']['id'];
                        unset($marketing['Marketing']['id']);

                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $marketing['Marketing']['productive_baseline_id']));
                        $marketing['Marketing']['productive_baseline_id'] = $id_baseline_servidor;
                        $MarketingRemoto->create();
                        if ($MarketingRemoto->save($marketing)) {
                            $id_marketing_servidor = $MarketingRemoto->getInsertID();
                            $alert.="TABLA marketings: " . $id_marketing_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Marketing',
                                    'local_id' => $id_marketing_local,
                                    'server_id' => $id_marketing_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: marketings " . $id_marketing_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $MarketingLocal->query("UPDATE marketings set sincronizado=1,remote_id=$id_marketing_servidor WHERE id=$id_marketing_local");
                                $MarketingRemoto->query("UPDATE marketings set remote_id=$id_marketing_local WHERE id=$id_marketing_servidor");
                            } else {
                                $alert.= "Tabla: marketings " . $marketing['Marketing']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: marketings " . $marketing['Marketing']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_marketing_local = $marketing['Marketing']['id'];
                        $id_marketing_servidor = $marketing['Marketing']['remote_id'];
                        $marketing['Marketing']['remote_id'] = $id_marketing_local;
                        $marketing['Marketing']['id'] = $id_marketing_servidor;
                        $id_baseline_servidor = $ProductiveBaselineRemoto->field('ProductiveBaseline.id', array('ProductiveBaseline.remote_id' => $marketing['Marketing']['productive_baseline_id']));
                        $marketing['Marketing']['productive_baseline_id'] = $id_baseline_servidor;

                        if ($MarketingRemoto->save($marketing)) {
                            $alert.="TABLA marketings: " . $id_marketing_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Marketing',
                                    'local_id' => $id_marketing_local,
                                    'server_id' => $id_marketing_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: marketings " . $id_marketing_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $MarketingLocal->query("UPDATE marketings set sincronizado=1  WHERE id=$id_marketing_local");
                                $MarketingRemoto->query("UPDATE marketings set sincronizado=1 WHERE id=$id_marketing_servidor");
                            } else {
                                $alert.= "Tabla: marketings " . $marketing['Marketing']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: marketings " . $marketing['Marketing']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN Marketing
            //
            ///
            //
            //INICIO FamilyPoll

            App::Import('model', 'FamilyPoll');
            $FamilyPollLocal = new FamilyPoll();
            $FamilyPollRemoto = new FamilyPoll();
            $FamilyPollLocal->useDbConfig = "default";
            $FamilyPollRemoto->useDbConfig = "remoto";
            if ($family_polls = $FamilyPollLocal->find('all', array('recursive' => -1, 'conditions' => array('FamilyPoll.sincronizado' => 0)))) {

                foreach ($family_polls as $familypoll) {


                    if ($familypoll['FamilyPoll']['remote_id'] == 0) {
                        $id_familypoll_local = $familypoll['FamilyPoll']['id'];
                        unset($familypoll['FamilyPoll']['id']);
                        $id_benficiary_servidor = $BeneficiaryRemoto->field('Beneficiary.id', array('Beneficiary.remote_id' => $familypoll['FamilyPoll']['beneficiary_id']));
                        $familypoll['FamilyPoll']['beneficiary_id'] = $id_benficiary_servidor;
                        $FamilyPollRemoto->create();
                        if ($FamilyPollRemoto->save($familypoll)) {
                            $id_familypoll_servidor = $FamilyPollRemoto->getInsertID();
                            $alert.="TABLA family_polls: " . $id_familypoll_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'FamilyPoll',
                                    'local_id' => $id_familypoll_local,
                                    'server_id' => $id_familypoll_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: family_polls " . $id_familypoll_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $FamilyPollLocal->query("UPDATE family_polls set sincronizado=1,remote_id=$id_familypoll_servidor WHERE id=$id_familypoll_local");
                                $FamilyPollRemoto->query("UPDATE family_polls set remote_id=$id_familypoll_local WHERE id=$id_familypoll_servidor");
                            } else {
                                $alert.= "Tabla: family_polls " . $familypoll['FamilyPoll']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: family_polls " . $familypoll['FamilyPoll']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_familypoll_local = $familypoll['FamilyPoll']['id'];
                        $id_familypoll_servidor = $familypoll['FamilyPoll']['remote_id'];
                        $familypoll['FamilyPoll']['remote_id'] = $id_familypoll_local;
                        $familypoll['FamilyPoll']['id'] = $id_familypoll_servidor;
                        $id_benficiary_servidor = $BeneficiaryRemoto->field('Beneficiary.id', array('Beneficiary.remote_id' => $familypoll['FamilyPoll']['beneficiary_id']));
                        $familypoll['FamilyPoll']['beneficiary_id'] = $id_benficiary_servidor;
                        if ($FamilyPollRemoto->save($familypoll)) {
                            $alert.="TABLA family_polls: " . $id_familypoll_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'FamilyPoll',
                                    'local_id' => $id_familypoll_local,
                                    'server_id' => $id_familypoll_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: family_polls " . $id_familypoll_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $FamilyPollLocal->query("UPDATE family_polls set sincronizado=1  WHERE id=$id_familypoll_local");
                                $FamilyPollRemoto->query("UPDATE family_polls set sincronizado=1 WHERE id=$id_familypoll_servidor");
                            } else {
                                $alert.= "Tabla: family_polls " . $familypoll['FamilyPoll']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: family_polls " . $familypoll['FamilyPoll']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN FamilyPoll
            //
            ///
            //
            //INICIO Expense

            App::Import('model', 'Expense');
            $ExpenseLocal = new Expense();
            $ExpenseRemoto = new Expense();
            $ExpenseLocal->useDbConfig = "default";
            $ExpenseRemoto->useDbConfig = "remoto";
            if ($expenses = $ExpenseLocal->find('all', array('recursive' => -1, 'conditions' => array('Expense.sincronizado' => 0)))) {

                foreach ($expenses as $expense) {


                    if ($expense['Expense']['remote_id'] == 0) {
                        $id_expense_local = $expense['Expense']['id'];
                        unset($expense['Expense']['id']);
                        $id_poll_servidor = $FamilyPollRemoto->field('FamilyPoll.id', array('FamilyPoll.remote_id' => $expense['Expense']['family_poll_id']));
                        $expense['Expense']['beneficiary_id'] = $id_poll_servidor;
                        $ExpenseRemoto->create();
                        if ($ExpenseRemoto->save($expense)) {
                            $id_expense_servidor = $ExpenseRemoto->getInsertID();
                            $alert.="TABLA expenses: " . $id_expense_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Expense',
                                    'local_id' => $id_expense_local,
                                    'server_id' => $id_expense_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: expenses " . $id_expense_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $ExpenseLocal->query("UPDATE expenses set sincronizado=1,remote_id=$id_expense_servidor WHERE id=$id_expense_local");
                                $ExpenseRemoto->query("UPDATE expenses set remote_id=$id_expense_local WHERE id=$id_expense_servidor");
                            } else {
                                $alert.= "Tabla: expenses " . $expense['Expense']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: expenses " . $expense['Expense']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_expense_local = $expense['Expense']['id'];
                        $id_expense_servidor = $expense['Expense']['remote_id'];
                        $expense['Expense']['remote_id'] = $id_expense_local;
                        $expense['Expense']['id'] = $id_expense_servidor;
                        $id_poll_servidor = $FamilyPollRemoto->field('FamilyPoll.id', array('FamilyPoll.remote_id' => $expense['Expense']['family_poll_id']));
                        $expense['Expense']['beneficiary_id'] = $id_poll_servidor;
                        if ($ExpenseRemoto->save($expense)) {
                            $alert.="TABLA expenses: " . $id_expense_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Expense',
                                    'local_id' => $id_expense_local,
                                    'server_id' => $id_expense_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: expenses " . $id_expense_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $ExpenseLocal->query("UPDATE expenses set sincronizado=1  WHERE id=$id_expense_local");
                                $ExpenseRemoto->query("UPDATE expenses set sincronizado=1 WHERE id=$id_expense_servidor");
                            } else {
                                $alert.= "Tabla: expenses " . $expense['Expense']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: expenses " . $expense['Expense']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN Expense
            //
            ///
            ///
            //
            //INICIO QualityOfLife

            App::Import('model', 'QualityOfLife');
            $QualityOfLifeLocal = new QualityOfLife();
            $QualityOfLifeRemoto = new QualityOfLife();
            $QualityOfLifeLocal->useDbConfig = "default";
            $QualityOfLifeRemoto->useDbConfig = "remoto";
            if ($qualities = $QualityOfLifeLocal->find('all', array('recursive' => -1, 'conditions' => array('QualityOfLife.sincronizado' => 0)))) {

                foreach ($qualities as $quality) {


                    if ($quality['QualityOfLife']['remote_id'] == 0) {
                        $id_quality_local = $quality['QualityOfLife']['id'];
                        unset($quality['QualityOfLife']['id']);
                        $id_poll_servidor = $FamilyPollRemoto->field('FamilyPoll.id', array('FamilyPoll.remote_id' => $quality['QualityOfLife']['family_poll_id']));
                        $quality['QualityOfLife']['beneficiary_id'] = $id_poll_servidor;
                        $QualityOfLifeRemoto->create();
                        if ($QualityOfLifeRemoto->save($quality)) {
                            $id_quality_servidor = $QualityOfLifeRemoto->getInsertID();
                            $alert.="TABLA quality_of_lives: " . $id_quality_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'QualityOfLife',
                                    'local_id' => $id_quality_local,
                                    'server_id' => $id_quality_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: quality_of_lives " . $id_quality_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $QualityOfLifeLocal->query("UPDATE quality_of_lives set sincronizado=1,remote_id=$id_quality_servidor WHERE id=$id_quality_local");
                                $QualityOfLifeRemoto->query("UPDATE quality_of_lives set remote_id=$id_quality_local WHERE id=$id_quality_servidor");
                            } else {
                                $alert.= "Tabla: quality_of_lives " . $quality['QualityOfLife']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: quality_of_lives " . $quality['QualityOfLife']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_quality_local = $quality['QualityOfLife']['id'];
                        $id_quality_servidor = $quality['QualityOfLife']['remote_id'];
                        $quality['QualityOfLife']['remote_id'] = $id_quality_local;
                        $quality['QualityOfLife']['id'] = $id_quality_servidor;
                        $id_poll_servidor = $FamilyPollRemoto->field('FamilyPoll.id', array('FamilyPoll.remote_id' => $quality['QualityOfLife']['family_poll_id']));
                        $quality['QualityOfLife']['beneficiary_id'] = $id_poll_servidor;
                        if ($QualityOfLifeRemoto->save($quality)) {
                            $alert.="TABLA quality_of_lives: " . $id_quality_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'QualityOfLife',
                                    'local_id' => $id_quality_local,
                                    'server_id' => $id_quality_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: quality_of_lives " . $id_quality_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $QualityOfLifeLocal->query("UPDATE quality_of_lives set sincronizado=1  WHERE id=$id_quality_local");
                                $QualityOfLifeRemoto->query("UPDATE quality_of_lives set sincronizado=1 WHERE id=$id_quality_servidor");
                            } else {
                                $alert.= "Tabla: quality_of_lives " . $quality['QualityOfLife']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: quality_of_lives " . $quality['QualityOfLife']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN QualityOfLife
            //
             ///
            //
            //INICIO GenderInstitutionalSupport

            App::Import('model', 'GenderInstitutionalSupport');
            $GenderInstitutionalSupportLocal = new GenderInstitutionalSupport();
            $GenderInstitutionalSupportRemoto = new GenderInstitutionalSupport();
            $GenderInstitutionalSupportLocal->useDbConfig = "default";
            $GenderInstitutionalSupportRemoto->useDbConfig = "remoto";
            if ($genders = $GenderInstitutionalSupportLocal->find('all', array('recursive' => -1, 'conditions' => array('GenderInstitutionalSupport.sincronizado' => 0)))) {

                foreach ($genders as $gender) {


                    if ($gender['GenderInstitutionalSupport']['remote_id'] == 0) {
                        $id_gender_local = $gender['GenderInstitutionalSupport']['id'];
                        unset($gender['GenderInstitutionalSupport']['id']);
                        $id_poll_servidor = $FamilyPollRemoto->field('FamilyPoll.id', array('FamilyPoll.remote_id' => $gender['GenderInstitutionalSupport']['family_poll_id']));
                        $gender['GenderInstitutionalSupport']['beneficiary_id'] = $id_poll_servidor;
                        $GenderInstitutionalSupportRemoto->create();
                        if ($GenderInstitutionalSupportRemoto->save($gender)) {
                            $id_gender_servidor = $GenderInstitutionalSupportRemoto->getInsertID();
                            $alert.="TABLA gender_institutional_supports: " . $id_gender_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'GenderInstitutionalSupport',
                                    'local_id' => $id_gender_local,
                                    'server_id' => $id_gender_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: gender_institutional_supports " . $id_gender_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $GenderInstitutionalSupportLocal->query("UPDATE gender_institutional_supports set sincronizado=1,remote_id=$id_gender_servidor WHERE id=$id_gender_local");
                                $GenderInstitutionalSupportRemoto->query("UPDATE gender_institutional_supports set remote_id=$id_gender_local WHERE id=$id_gender_servidor");
                            } else {
                                $alert.= "Tabla: gender_institutional_supports " . $gender['GenderInstitutionalSupport']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: gender_institutional_supports " . $gender['GenderInstitutionalSupport']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_gender_local = $gender['GenderInstitutionalSupport']['id'];
                        $id_gender_servidor = $gender['GenderInstitutionalSupport']['remote_id'];
                        $gender['GenderInstitutionalSupport']['remote_id'] = $id_gender_local;
                        $gender['GenderInstitutionalSupport']['id'] = $id_gender_servidor;
                        $id_poll_servidor = $FamilyPollRemoto->field('FamilyPoll.id', array('FamilyPoll.remote_id' => $gender['GenderInstitutionalSupport']['family_poll_id']));
                        $gender['GenderInstitutionalSupport']['beneficiary_id'] = $id_poll_servidor;
                        if ($GenderInstitutionalSupportRemoto->save($gender)) {
                            $alert.="TABLA gender_institutional_supports: " . $id_gender_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'GenderInstitutionalSupport',
                                    'local_id' => $id_gender_local,
                                    'server_id' => $id_gender_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: gender_institutional_supports " . $id_gender_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $GenderInstitutionalSupportLocal->query("UPDATE gender_institutional_supports set sincronizado=1  WHERE id=$id_gender_local");
                                $GenderInstitutionalSupportRemoto->query("UPDATE gender_institutional_supports set sincronizado=1 WHERE id=$id_gender_servidor");
                            } else {
                                $alert.= "Tabla: gender_institutional_supports " . $gender['GenderInstitutionalSupport']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: gender_institutional_supports " . $gender['GenderInstitutionalSupport']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN GenderInstitutionalSupport
            //
            ///
            //
            //INICIO Family

            App::Import('model', 'Family');
            $FamilyLocal = new Family();
            $FamilyRemoto = new Family();
            $FamilyLocal->useDbConfig = "default";
            $FamilyRemoto->useDbConfig = "remoto";
            if ($families = $FamilyLocal->find('all', array('recursive' => -1, 'conditions' => array('Family.sincronizado' => 0)))) {

                foreach ($families as $family) {


                    if ($family['Family']['remote_id'] == 0) {
                        $id_family_local = $family['Family']['id'];
                        unset($family['Family']['id']);
                        $id_benficiary_servidor = $BeneficiaryRemoto->field('Beneficiary.id', array('Beneficiary.remote_id' => $family['Family']['beneficiary_id']));
                        $family['Family']['beneficiary_id'] = $id_benficiary_servidor;
                        $FamilyRemoto->create();
                        if ($FamilyRemoto->save($family)) {
                            $id_family_servidor = $FamilyRemoto->getInsertID();
                            $alert.="TABLA families: " . $id_family_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Family',
                                    'local_id' => $id_family_local,
                                    'server_id' => $id_family_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: families " . $id_family_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $FamilyLocal->query("UPDATE families set sincronizado=1,remote_id=$id_family_servidor WHERE id=$id_family_local");
                                $FamilyRemoto->query("UPDATE families set remote_id=$id_family_local WHERE id=$id_family_servidor");
                            } else {
                                $alert.= "Tabla: families " . $family['Family']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: families " . $family['Family']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_family_local = $family['Family']['id'];
                        $id_family_servidor = $family['Family']['remote_id'];
                        $family['Family']['remote_id'] = $id_family_local;
                        $family['Family']['id'] = $id_family_servidor;
                        $id_benficiary_servidor = $BeneficiaryRemoto->field('Beneficiary.id', array('Beneficiary.remote_id' => $family['Family']['beneficiary_id']));
                        $family['Family']['beneficiary_id'] = $id_benficiary_servidor;
                        if ($FamilyRemoto->save($family)) {
                            $alert.="TABLA families: " . $id_family_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'Family',
                                    'local_id' => $id_family_local,
                                    'server_id' => $id_family_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: families " . $id_family_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $FamilyLocal->query("UPDATE families set sincronizado=1  WHERE id=$id_family_local");
                                $FamilyRemoto->query("UPDATE families set sincronizado=1 WHERE id=$id_family_servidor");
                            } else {
                                $alert.= "Tabla: families " . $family['Family']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: families " . $family['Family']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN Family
            //
            
                //
            //INICIO BeneficiaryRequirement

            App::Import('model', 'BeneficiaryRequirement');
            $BeneficiaryRequirementLocal = new BeneficiaryRequirement();
            $BeneficiaryRequirementRemoto = new BeneficiaryRequirement();
            $BeneficiaryRequirementLocal->useDbConfig = "default";
            $BeneficiaryRequirementRemoto->useDbConfig = "remoto";
            if ($beneficiary_requirements = $BeneficiaryRequirementLocal->find('all', array('recursive' => -1, 'conditions' => array('BeneficiaryRequirement.sincronizado' => 0)))) {

                foreach ($beneficiary_requirements as $beneficiary_requirement) {


                    if ($beneficiary_requirement['BeneficiaryRequirement']['remote_id'] == 0) {
                        $id_brequierment_local = $beneficiary_requirement['BeneficiaryRequirement']['id'];
                        unset($beneficiary_requirement['BeneficiaryRequirement']['id']);
                        $id_benficiary_servidor = $BeneficiaryRemoto->field('Beneficiary.id', array('Beneficiary.remote_id' => $beneficiary_requirement['BeneficiaryRequirement']['beneficiary_id']));
                        $beneficiary_requirement['BeneficiaryRequirement']['beneficiary_id'] = $id_benficiary_servidor;
                        $BeneficiaryRequirementRemoto->create();
                        if ($BeneficiaryRequirementRemoto->save($beneficiary_requirement)) {
                            $id_brequierment_servidor = $BeneficiaryRequirementRemoto->getInsertID();
                            $alert.="TABLA beneficiary_requirements: " . $id_brequierment_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'BeneficiaryRequirement',
                                    'local_id' => $id_brequierment_local,
                                    'server_id' => $id_brequierment_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: beneficiary_requirements " . $id_brequierment_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $BeneficiaryRequirementLocal->query("UPDATE beneficiary_requirements set sincronizado=1,remote_id=$id_brequierment_servidor WHERE id=$id_brequierment_local");
                                $BeneficiaryRequirementRemoto->query("UPDATE beneficiary_requirements set remote_id=$id_brequierment_local WHERE id=$id_brequierment_servidor");
                            } else {
                                $alert.= "Tabla: beneficiary_requirements " . $beneficiary_requirement['BeneficiaryRequirement']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: beneficiary_requirements " . $beneficiary_requirement['BeneficiaryRequirement']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_brequierment_local = $beneficiary_requirement['BeneficiaryRequirement']['id'];
                        $id_brequierment_servidor = $beneficiary_requirement['BeneficiaryRequirement']['remote_id'];
                        $beneficiary_requirement['BeneficiaryRequirement']['remote_id'] = $id_brequierment_local;
                        $beneficiary_requirement['BeneficiaryRequirement']['id'] = $id_brequierment_servidor;
                        $id_benficiary_servidor = $BeneficiaryRemoto->field('Beneficiary.id', array('Beneficiary.remote_id' => $beneficiary_requirement['BeneficiaryRequirement']['beneficiary_id']));
                        $beneficiary_requirement['BeneficiaryRequirement']['beneficiary_id'] = $id_benficiary_servidor;
                        if ($BeneficiaryRequirementRemoto->save($beneficiary_requirement)) {
                            $alert.="TABLA beneficiary_requirements: " . $id_brequierment_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'BeneficiaryRequirement',
                                    'local_id' => $id_brequierment_local,
                                    'server_id' => $id_brequierment_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: beneficiary_requirements " . $id_brequierment_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $BeneficiaryRequirementLocal->query("UPDATE beneficiary_requirements set sincronizado=1  WHERE id=$id_brequierment_local");
                                $BeneficiaryRequirementRemoto->query("UPDATE beneficiary_requirements set sincronizado=1 WHERE id=$id_brequierment_servidor");
                            } else {
                                $alert.= "Tabla: beneficiary_requirements " . $beneficiary_requirement['BeneficiaryRequirement']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: beneficiary_requirements " . $beneficiary_requirement['BeneficiaryRequirement']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN BeneficiaryRequirement
            //
            
            ///
            //
            //INICIO PropertyRequirement

            App::Import('model', 'PropertyRequirement');
            $PropertyRequirementLocal = new PropertyRequirement();
            $PropertyRequirementRemoto = new PropertyRequirement();
            $PropertyRequirementLocal->useDbConfig = "default";
            $PropertyRequirementRemoto->useDbConfig = "remoto";
            if ($property_requirements = $PropertyRequirementLocal->find('all', array('recursive' => -1, 'conditions' => array('PropertyRequirement.sincronizado' => 0)))) {

                foreach ($property_requirements as $property_requirement) {


                    if ($property_requirement['PropertyRequirement']['remote_id'] == 0) {
                        $id_prequierment_local = $property_requirement['PropertyRequirement']['id'];
                        unset($property_requirement['PropertyRequirement']['id']);
                        $id_property_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $property_requirement['PropertyRequirement']['property_id']));
                        $property_requirement['PropertyRequirement']['property_id'] = $id_property_servidor;
                        $PropertyRequirementRemoto->create();
                        if ($PropertyRequirementRemoto->save($property_requirement)) {
                            $id_prequierment_servidor = $PropertyRequirementRemoto->getInsertID();
                            $alert.="TABLA property_requirements: " . $id_prequierment_servidor . " INSERTADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'PropertyRequirement',
                                    'local_id' => $id_prequierment_local,
                                    'server_id' => $id_prequierment_servidor,
                                    'accion' => 'add',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: property_requirements " . $id_prequierment_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $PropertyRequirementLocal->query("UPDATE property_requirements set sincronizado=1,remote_id=$id_prequierment_servidor WHERE id=$id_prequierment_local");
                                $PropertyRequirementRemoto->query("UPDATE property_requirements set remote_id=$id_prequierment_local WHERE id=$id_prequierment_servidor");
                            } else {
                                $alert.= "Tabla: property_requirements " . $property_requirement['PropertyRequirement']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: property_requirements " . $property_requirement['PropertyRequirement']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    } else {
                        $id_prequierment_local = $property_requirement['PropertyRequirement']['id'];
                        $id_prequierment_servidor = $property_requirement['PropertyRequirement']['remote_id'];
                        $property_requirement['PropertyRequirement']['remote_id'] = $id_prequierment_local;
                        $property_requirement['PropertyRequirement']['id'] = $id_prequierment_servidor;
                        $id_property_servidor = $PredioRemoto->field('Property.id', array('Property.remote_id' => $property_requirement['PropertyRequirement']['property_id']));
                        $property_requirement['PropertyRequirement']['property_id'] = $id_property_servidor;
                        if ($PropertyRequirementRemoto->save($property_requirement)) {
                            $alert.="TABLA property_requirements: " . $id_prequierment_servidor . " ACTUALIZADO CORRECTAMENTE <br>";

                            //se guarda el ergistro en la tabla de sincronización.
                            $datos = array('Synchronization' => array(
                                    'tabla' => 'PropertyRequirement',
                                    'local_id' => $id_prequierment_local,
                                    'server_id' => $id_prequierment_servidor,
                                    'accion' => 'edit',
                                    'user_id' => $this->Auth->user('id')
                            ));
                            if ($Synchronization->save($datos)) {
                                $alert.="TABLA: property_requirements " . $id_prequierment_servidor . " SINCRONIZADO CORRECTAMENTE <br>";
                                $PropertyRequirementLocal->query("UPDATE property_requirements set sincronizado=1  WHERE id=$id_prequierment_local");
                                $PropertyRequirementRemoto->query("UPDATE property_requirements set sincronizado=1 WHERE id=$id_prequierment_servidor");
                            } else {
                                $alert.= "Tabla: property_requirements " . $property_requirement['PropertyRequirement']['id'] . " NO SE PUDO SINCRONIZAR <br>";
                            }
                        } else {
                            $alert.= "Tabla: property_requirements " . $property_requirement['PropertyRequirement']['id'] . " NO SE PUDO Guardar <br>";
                        }
                    }
                }
            }
            //FIN PropertyRequirement
            //

            $this->Session->setFlash("$alert");
            $this->Redirect(array('controller' => 'pages', 'action' => 'home'));
        }
    }

}

?>