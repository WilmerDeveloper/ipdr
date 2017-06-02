<?php

class ProductsController extends AppController {

    public $name = 'Products';

    public function index($visit_id) {
        $this->paginate = array('Product' => array('maxLimit' => 500, 'limit' => 50, 'fields' => array('Product.*', 'ProductType.nombre'), 'order'=>array('Product.id' => 'ASC'), 'recursive'=> 1));
        $this->set('Products', $this->paginate(array('Product.visit_id' => $visit_id)));
        
        $this->set("visit_id", $visit_id);
        $this->set('visit_id', $visit_id);
        $this->set('proyect_id', $this->Session->read('proyect_id'));
    }
    
    public function add($visit_id) {
        $this->layout = "ajax";
        $this->loadModel('ProductType');
        $this->set('productTypes', $this->ProductType->find('list', array('order' => array('ProductType.tipo' => 'ASC', 'ProductType.nombre' => 'ASC'), 'fields' => array('ProductType.id', 'ProductType.nombre'))));
        if (empty($this->data)) {
            $this->set('visit_id', $visit_id);
        } else {
            if ($this->Product->saveAll($this->data)) {
                $this->Session->setFlash('Datos guardados correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'Products', 'action' => 'index', $this->data['Product']['visit_id']));
            } else {
                $this->Session->setFlash('Error guardando datos', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        }
    }

    public function edit($id) {
        $this->layout = "ajax";
        $this->loadModel('ProductType');
        $this->set('productTypes', $this->ProductType->find('list', array('order' => array('ProductType.tipo' => 'ASC', 'ProductType.nombre' => 'ASC'), 'fields' => array('ProductType.id', 'ProductType.nombre'))));
        if (empty($this->data)) {
            $this->Product->recursive = -1;
            $this->data = $this->Product->find('first', array('conditions' => array('Product.id' => $id), 'fields' => array('Product.*')));
        } else {
            if ($this->Product->saveAll($this->data)) {
                $this->Session->setFlash('Datos guardados exitosamente', 'flash_custom');
                $this->redirect(array('controller' => 'Products', 'action' => 'index', $this->data['Product']['visit_id']));
            } else {
                $this->Session->setFlash('Error editando datos', 'flash_custom');
                $this->redirect(array('controller' => 'Pages', 'action' => 'display'));
            }
        }
    }

    public function delete($id, $visit_id) {
        if ($this->Product->delete($id)) {
            $this->Session->setFlash('Información del producto borrada con éxito', 'flash_custom');
            $this->redirect(array('controller' => 'Products', 'action' => 'index', $visit_id));
        } else {
            $this->Session->setFlash('No es posible eliminar el registro, intentelo nuevamente.', 'flash_custom');
        }
    }

}

?>
