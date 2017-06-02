<?php

Class PropertyReviewsController extends AppController {

    public $name = 'PropertyReviews';

    public function index($property_id) {
        $this->layout = "ajax";

        $this->PropertyReview->Property->recursive = -1;
        $this->set('codigo', $this->PropertyReview->Property->find("first", array("conditions" => array("Property.id" => $property_id), "fields" => array("Property.id", "Property.matricula", "Property.nombre"))));

        if ($property_id == "") {
            $this->Session->setFlash('No ha seleccionado Proyecto');
            $this->redirect(array('controller' => 'Proyects', 'action' => 'index'));
        } else {
            $this->set('revisiones', $this->PropertyReview->find('all', array('conditions' => array('PropertyReview.property_id' => $property_id), 'order' => array('PropertyReview.id DESC'), 'fields' => array('PropertyReview.*', 'User.id', 'User.nombre', 'User.primer_apellido', 'User.segundo_apellido'))));
        }
    }

    public function add($property_id) {
        $this->layout = "ajax";
        $this->PropertyReview->Property->recursive = -1;
        $this->set('departaments', $this->PropertyReview->Property->Departament->find('list'));
        if (empty($this->data)) {
            $this->data = $this->PropertyReview->Property->find('first', array('conditions' => array('Property.id' => $property_id),));
            $this->set('cities', $this->PropertyReview->Property->City->find('list', array('conditions' => array('City.departament_id' => $this->data['Property']['departament_id']))));
        } else {
            $this->request->data['PropertyReview']['user_id'] = $this->Auth->user('id');
            date_default_timezone_set("America/Bogota");
            $this->request->data['PropertyReview']['fecha'] = date("Y-m-d h:i:s");
            
            if ($this->PropertyReview->saveAll($this->data)) {
                $log = $this->PropertyReview->Property->findLog(array('conditions' => array('Log.action' => 'edit', 'Log.user_id' => $this->Auth->user('id')), 'model' => 'Property', 'fields' => array('change'), 'order' => 'Log.id DESC ', 'limit' => 1));
                $txt = $log[0]['Log']['change'];
                
                $this->PropertyReview->UpdateAll(array('PropertyReview.cambio' => "'$txt'"), array('PropertyReview.id' => $this->PropertyReview->getLastInsertID()));
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Properties', 'action' => 'property_index', $property_id));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_custom');
            }
        }
    }

}