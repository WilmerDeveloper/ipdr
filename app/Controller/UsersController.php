<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {

    var $name = 'Users';

    public function send() {

        // $this->layout = "ajax";
        if (empty($this->data)) {
            
        } else {
            $this->User->recursive = 0;
            if ($users = $this->User->find('all', array('conditions' => array('User.email' => $this->data['User']['correo']), 'fields' => array('User.email', 'User.username', 'User.nombre', 'User.primer_apellido', 'User.segundo_apellido', 'User.id', 'User.group_id')))) {
                foreach ($users as $user) {

                    //Generamos la nueva clave de forma aleatorea

                    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
                    $clave = "";
                    for ($i = 0; $i < 8; $i++) {
                        $clave .= substr($str, rand(0, 62), 1);
                    }

                    $this->request->data['User']['password'] = $this->Auth->password($clave);
                    $this->request->data['User']['id'] = $user['User']['id'];
                    if ($this->request->data['User']['group_id'] == 1) {
                        $this->request->data['User']['group_id'] = 6;
                    } else {
                        $this->request->data['User']['group_id'] = 1;
                    }
                    if ($this->User->save($this->data)) {
                        $this->request->data['User']['group_id'] = $user['User']['group_id'];
                        $this->User->save($this->data);
                        $Email = new CakeEmail('gmail');
                        $Email->from(array('ipdr.soporte@gmail.com' => 'Apicativo IPDR'));
                        $Email->addTo($user['User']['email']);
                        $Email->subject("Cambio de clave aplicativo INCODER-IPDR");
                        $Email->emailFormat('html');


                        $body = "Se ha cambiado exitosamente su clave,los datos de su cuenta son: <br>";
                        $body .= " <strong>Usuario: " . $user['User']['nombre'] . " " . $user['User']['primer_apellido'] . " " . $user['User']['segundo_apellido'] . "</strong><br>";
                        $body .= " <strong>Username: " . $user['User']['username'] . "</strong><br>";
                        $body .= " <strong>Nueva Clave: " . $clave . "</strong><br>";
                        $exito = $Email->send($body);

                        if ($exito) {
                            $this->Session->setFlash("Sus datos fueron enviados al correo  " . $user['User']['email']);
                        } else {
                            $this->Session->setFlash("Error :  " . $user['User']['email'] . " ");
                        }
                        $this->redirect(array('controller' => 'Users', 'action' => "send"));
                    } else {
                        $this->Session->setFlash("Error Guardando Datos");
                    }
                }
            } else {
                $this->Session->setFlash("No existe un usuario asociado a este correo");
                $this->redirect(array('controller' => 'Users', 'action' => "send"));
            }
        }
    }

    function login() {
        $this->pageTitle = 'Inicio';
        $this->layout = "login";
        $this->User->recursive = -1;
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->write("convocatoria", $this->data['User']['call_id']);
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('Su usuario o contraseña no son correctos.');
            }
        }
    }

    function admin_login() {
        $this->layout = "login";

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                //$this->Auth->loginRedirect = array('controller' => 'pages', 'action' => 'admin_index');
                $this->redirect(array('controller' => 'pages', 'action' => 'admin_index'));
            } else {
                $this->Session->setFlash('Su usuario o contraseña no son correctos.', 'flash_custom');
            }
        }
    }

    function logout() {
        $this->Session->setFlash('Su sesión ha expirado.');
        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }

    function index() {

        // $this->User->recursive = 0;
        if (empty($this->data) or empty($this->data['User']['busqueda'])) {

            $this->set('User', $this->User->find('all', array('fields' => array('User.username', 'User.id', 'User.email', 'User.primer_apellido', 'User.nombre', 'Group.name', 'Branch.nombre'))));
        } else {

            $this->set('User', $this->User->find('all', array(
                        'conditions' => array(
                            'or' => array('Branch.nombre LIKE' => "%" . $this->data['User']['busqueda'] . "%", 'User.username LIKE' => "%" . $this->data['User']['busqueda'] . "%", 'User.primer_apellido LIKE ' => "%" . $this->data['User']['busqueda'] . "%", 'User.nombre LIKE ' => "%" . $this->data['User']['busqueda'] . "%")
                        ),
                        'fields' => array('User.username', 'User.nombre', 'User.primer_apellido', 'User.id', 'Branch.nombre', 'User.email', 'Group.name')
            )));
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->set('user_id', $id);
        if (empty($this->data)) {
            $this->data = $this->User->find("first", array("conditions" => array("User.id" => $id)));
            if (AuthComponent::User('group_id') == 1) {
                $this->set('groups', $this->User->Group->find('list', array('order' => 'name ASC')));
            } else {
                $this->set('groups', $this->User->Group->find('list', array('order' => 'name ASC','conditions' => array(
        "NOT" => array( "Group.id" => array(1,7,10) )
    ))));
            }
            $this->set('branches', $this->User->Branch->find('list', array('order' => 'nombre ASC', 'fields' => array('id', 'nombre'))));
        } else {
            if ($this->User->save($this->data)) {
                $path = WWW_ROOT . DS . 'files' . DS . 'Users';
                if (!file_exists($path)) {
                    App::uses('Folder', 'Utility');
                    App::uses('File', 'Utility');
                    $folder = new Folder();
                    $folder->create($path, 0777);
                }
                $fileName = "Usuario_firma_$id.png";
                $exito = 1;
                if (isset($this->data['User']['archivo']['tmp_name'])) {
                    if (move_uploaded_file($this->data['User']['archivo']['tmp_name'], $path . DS . $fileName)) {
                        $this->User->id = $id;
                        $this->User->saveField('adjunto_firma', $fileName);
                    } else {
                        $exito = 0;
                    }
                }

                if ($exito) {
                    $this->Session->setFlash("Usuario editado con exito", 'flash_custom');
                    $this->redirect(array("controller" => 'users', 'action' => 'index'));
                } else {
                    $this->Session->setFlash("error adjuntando archivo", 'flash_custom');
                    $this->redirect(array("controller" => 'users', 'action' => 'index'));
                }
            } else {
                $this->Session->setFlash("Error Guardando Datos", 'flash_custom');
                $this->set('groups', $this->User->Group->find('list', array('order' => 'name ASC')));
                $this->set('branches', $this->User->Branch->find('list', array('order' => 'nombre ASC', 'fields' => array('id', 'nombre'))));
            }
        }
    }

    function edit_user() {
        $this->layout = "ajax";
        if (empty($this->data)) {
            $id = $this->Auth->user('id');
            $this->data = $this->User->find("first", array("conditions" => array("User.id" => $id)));
        } else {
            if ($this->Auth->password($this->data['User']['password']) != $this->Auth->password($this->data['User']['password_confirm'])) {
                $this->set('branches', $this->User->Branch->find('list', array('order' => 'nombre ASC', 'fields' => array('id', 'nombre'))));
                $this->set('groups', $this->User->Group->find('list', array('order' => 'name ASC')));
                echo "<script>alert('Las contraseñas no coinciden')</script>";
            } else {
                $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
                $this->request->data['User']['id'] = $this->Auth->user('id');
                $grupo = $this->request->data['User']['group_id'];
                if ($this->request->data['User']['group_id'] == 1) {
                    $this->request->data['User']['group_id'] = 6;
                } else {
                    $this->request->data['User']['group_id'] = 1;
                }
                if ($this->User->save($this->data)) {
                    $this->request->data['User']['group_id'] = $grupo;
                    $this->User->save($this->data);
                    $this->Session->setFlash("Usuario editado con exito", 'flash_custom');
                    $this->redirect(array('controller' => 'Pages', 'action' => "display"));
                } else {
                    $this->Session->setFlash("Error Guardando Datos", 'flash_custom');
                }
            }
        }
    }

    function add() {
        $this->layout = "ajax";
        if (!empty($this->data)) {

            if ($this->Auth->password($this->data['User']['password']) != $this->Auth->password($this->data['User']['password_confirm'])) {
                $this->set('branches', $this->User->Branch->find('list', array('order' => 'nombre ASC', 'fields' => array('id', 'nombre'))));
                $this->set('groups', $this->User->Group->find('list', array('order' => 'name ASC')));
                echo "<script>alert('Las contraseñas no coinciden')</script>";
            } else {
                $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
                if ($this->User->saveAll($this->data)) {
                    $this->Session->setFlash("Usuario creado con exito", 'flash_custom');
                    $this->redirect(array("controller" => 'users', 'action' => 'index'));
                } else {
                    $this->Session->setFlash("Error guardando datos", 'flash_custom');
                    $this->set('branches', $this->User->Branch->find('list', array('order' => 'nombre ASC', 'fields' => array('id', 'nombre'))));
                    $this->set('groups', $this->User->Group->find('list', array('order' => 'name ASC')));
                }
            }
        } else {

            $this->set('branches', $this->User->Branch->find('list', array('order' => 'nombre ASC', 'fields' => array('id', 'nombre'))));
            $this->set('groups', $this->User->Group->find('list', array('order' => 'name ASC')));
        }
    }

    function delete($id) {

        if ($this->User->delete($id)) {
            $this->Session->setFlash('Usuario Borrado con exito', 'flash_custom');
            $this->redirect(array('controller' => 'Users', 'action' => 'index'));
        }
    }

    function add_users() {
        $this->layout = "ajax";
        if (!empty($this->data)) {
            if ($this->Auth->password($this->data['User']['password']) == $this->Auth->password($this->data['User']['password_confirm'])) {
                $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash("Usuario creado con éxito", "flash_custom");
                    $this->redirect(array("controller" => 'Users', 'action' => 'list_users'));
                } else {
                    $this->Session->setFlash(__('El usuario no se pudo guardar, por favor intentelo de nuevo.'), 'flash_custom');
                    $group_id = $this->Auth->user('group_id');
                    if ($group_id == 13) {
                        $this->set('groups', $this->User->Group->find('list', array('conditions' => array('id' => array(13, 19, 20)))));
                        $this->set('mostrar_regionales', false);
                    } else {
                        $this->set('groups', $this->User->Group->find('list'));
                        $this->set('branches', $this->User->Branch->find('list', array('fields' => array('Branch.id', 'Branch.nombre'))));
                        $this->set('mostrar_regionales', true);
                    }
                }
            } else {
                
            }
        } else {
            $group_id = $this->Auth->user('group_id');
            if ($group_id == 134) {
                $this->set('groups', $this->User->Group->find('list', array('conditions' => array('id' => array(13, 19, 20)))));
                $this->set('mostrar_regionales', false);
            } else {
                $this->set('groups', $this->User->Group->find('list'));
                $this->set('branches', $this->User->Branch->find('list', array('fields' => array('Branch.id', 'Branch.nombre'))));
                $this->set('mostrar_regionales', true);
            }
        }
    }

    public function list_users() {
        $this->User->recursive = -1;

        if (empty($this->data) or $this->data['User']['busqueda'] == "") {

            $this->set('User', $this->User->find('all', array(
                        'fields' => array('User.username', 'User.nombre', 'User.primer_apellido', 'User.id')
            )));
        } else {

            $this->set('User', $this->User->find('all', array(
                        'conditions' => array(
                            'or' => array('User.username LIKE' => "%" . $this->data['User']['busqueda'] . "%", 'User.primer_apellido LIKE ' => "%" . $this->data['User']['busqueda'] . "%", 'User.nombre LIKE ' => "%" . $this->data['User']['busqueda'] . "%")
                        ),
                        'fields' => array('User.username', 'User.nombre', 'User.primer_apellido', 'User.id')
            )));
        }
    }

}

?>