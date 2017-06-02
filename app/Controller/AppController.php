<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AppController extends Controller {

    var $name = "App";
    public $components = array(
        'Session',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'RequestHandler',
        'Acl'
    );
    var $helpers = array('Html', 'Form', 'Javascript', "Ajax", 'Session', 'Js');

    function beforeFilter() {

        $this->Auth->allow(array('login', 'send', 'logout'));
        //$this->Auth->allow();
        $this->disableCache();
        //$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'pages', 'action' => 'home');
        $this->Auth->authError = 'Está tratando de entrar a una zona restringida ' . $this->params['controller'] . " " . $this->action;
        if (!$this->RequestHandler->isAjax()) {
            //Se realiza cuando la petición no es ajax. Cuando carga toda la página.

            $this->Session->write('Auth.redirect', null);
            App::import("Model", "Call");
            $Call = new Call();
            $Call->recursive = -1;
            if ($this->Auth->user('group_id') != 13) {
                $this->set('calls', $Call->find('list', array('fields' => array('Call.id', 'Call.nombre'), 'order' => array('Call.id DESC'))));
            } else {
                $this->set('calls', $Call->find('list', array('conditions' => array('Call.id' => 3),'fields' => array('Call.id', 'Call.nombre'), 'order' => array('Call.id DESC'))));
            }
        }
        if (sizeof($this->uses) && $this->{$this->modelClass}->Behaviors->attached('Logable')) {
            $this->{$this->modelClass}->setUserData($this->Session->read('Auth'));
        }
    }

}

?>
