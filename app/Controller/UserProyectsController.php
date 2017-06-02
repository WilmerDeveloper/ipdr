<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_proyects_controller
 *
 * @author root
 */
App::uses('CakeEmail', 'Network/Email');

class UserProyectsController extends AppController {

    //put your code here
    var $name = "UserProyects";

    function index($user = null) {
        if (is_null($user)) {
            $user = $this->Auth->user('id');
        }
        $this->set('user_id', $user);
        $this->UserProyect->recursive = -1;
        $this->set('user', $this->UserProyect->find('all', array('conditions' => array('UserProyect.user_id' => $user), 'fields' => array('User.username', 'Proyect.codigo', 'UserProyect.*', 'Call.nombre'),
                    'joins' => array(
                        array('table' => 'users', 'type' => 'left', 'alias' => 'User', 'conditions' => array('User.id=UserProyect.user_id')),
                        array('table' => 'proyects', 'type' => 'left', 'alias' => 'Proyect', 'conditions' => array('Proyect.id=UserProyect.proyect_id')),
                        array('table' => 'calls', 'type' => 'left', 'alias' => 'Call', 'conditions' => array('Call.id=Proyect.call_id')),
        ))));
    }

    function add($user) {
        $this->set('user', $user);
        App::Import('model', 'Call');
        if (!empty($this->data)) {
            if ($ide = $this->UserProyect->Proyect->field('id', array('Proyect.codigo' => $this->data['UserProyect']['codigo'], 'Proyect.call_id' => $this->data['UserProyect']['convocatoria']))) {
                $this->request->data['UserProyect']['proyect_id'] = $ide;

                if (!$this->UserProyect->find('first', array('conditions' => array('UserProyect.proyect_id' => $ide, 'UserProyect.user_id' => $user)))) {

                    if ($this->UserProyect->saveAll($this->data)) {

                        $usuario = $this->UserProyect->User->find('first', array('recursive' => -1, 'conditions' => array('User.id' => $this->data['UserProyect']['user_id']), 'fields' => array('User.email', 'User.branch_id', 'User.nombre', 'User.primer_apellido')));
                        $Email = new CakeEmail('gmail');
                        $Email->from(array('ipdr.soporte@gmail.com' => 'Apicativo IPDR'));
                        $body = "<p>Se le ha asignado el proyecto " . $this->data['UserProyect']['codigo'] . " para ser  evaluado, Por favor ingrese al apicativo y diligencie la respectiva evaluación </p>";
                        $Email->addTo($usuario['User']['email']);
                        $Email->subject("ASIGNACIÓN  PROYECTO  " . $this->data['UserProyect']['codigo']);
                        $Email->emailFormat('html');
                       

                        $exito = $Email->send($body);// Envía el correo. 
                        if ($exito) {

                            $this->Session->setFlash('Proyecto adicionado con éxito');
                            $this->redirect(array('controller' => 'UserProyects', 'action' => 'index', $user));
                        } else {
                            $this->Session->setFlash("Error :  " . $mail->ErrorInfo) . "XXX";
                            $this->redirect(array('controller' => 'UserProyects', 'action' => 'index', $user));
                        }
                    } else {
                        $this->Session->setFlash('ERROR');
                    }
                } else {
                    $this->Session->setFlash('El usuario ya tiene asignado el proyecto ' . $this->data['UserProyect']['codigo']);
                    $this->redirect(array('controller' => 'UserProyects', 'action' => 'index', $user));
                }
            } else {
                $this->Session->setFlash('No existe el proyecto');
                $call = new Call();
                $call->recursive = -1;
                $convocatorias = $call->find('all', array('fields' => array('Call.id', 'Call.nombre')));
                $this->set('convocatorias', $convocatorias);
            }
        } else {
            $call = new Call();
            $call->recursive = -1;
            $convocatorias = $call->find('all', array('fields' => array('Call.id', 'Call.nombre')));
            $this->set('convocatorias', $convocatorias);

            $this->request->data['UserProyect']['user_id'] = $user;
        }
    }

    function delete($id, $user_id = null) {
        if ($this->UserProyect->delete($id)) {
            $this->Session->setFlash('Proyecto eliminado con éxito', 'flash_custom');
            if (isset($user_id)) {
                $this->redirect(array('controller' => 'UserProyects', 'action' => 'index', $user_id));
            } else {
                $this->redirect(array('controller' => 'Proyects', 'action' => 'allocations'));
            }
        }
    }

}

?>
