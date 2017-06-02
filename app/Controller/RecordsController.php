<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RecordsController
 *
 * @author wavelino
 */
class RecordsController extends AppController {

    //put your code here
    public $name = "Records";

    function index() {
        $objetos = App::objects('model');
        $arrayobj = array();
        foreach ($objetos as $obj) {
            $arrayobj[$obj] = $obj;
        }

        $this->set('objetos', $arrayobj);
        $this->paginate = array('Record' => array('fields' => array('Record.*', 'User.username', 'User.nombre', 'User.primer_apellido'), 'recursive' => 0, 'maxLimit' => 100, 'limit' => 50, 'order' => array('Record.created' => 'DESC'), 'joins' => array(array('table' => 'users', 'alias' => 'User', 'type' => 'left', 'conditions' => 'User.id=Record.user_id'))));

        if (empty($this->data)) {
            $this->set('Records', $this->paginate());
        } else {
            if ($this->data['Record']['busqueda'] == "") {
                $this->set('Records', $this->paginate());
            } else {
                $this->set('Records', $this->paginate(array('Record.model_id' => $this->data['Record']['busqueda'], 'Record.model' => $this->data['Record']['objeto'])));
            }
        }
    }

}
