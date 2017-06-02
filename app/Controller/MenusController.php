<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MenusController extends AppController {

    var $name = 'Menus';

    function index() {
        $this->layout = 'ajax';
        $this->Menu->recursive = 0;
        $menus = $this->Menu->find("all", array('order'=>array('Menu.tab_id ASC','Menu.orden ASC'),"fields" => array("Menu.id", "Tab.titulo","Menu.nombre", "Menu.url", "Menu.icono",'Menu.alias','Menu.orden')));
        $this->set('menus', $menus);
    }

    function add() {
        $this->layout = 'ajax';
        $this->set('tabs', $this->Menu->Tab->find('list', array('order' => 'titulo ASC', 'fields' => array('Tab.id', 'Tab.titulo'))));
        if (!empty($this->data)) {
            if ($this->Menu->save($this->data)) {
                $this->Session->setFlash("Menú Creado con exito");
                $this->redirect(array('controller' => 'Menus', 'action' => 'index'));
            };
        }
    }

    function ver($id) {
        error_reporting(0);
        $this->layout = 'ajax';
        //$this->set('cod', $this->Session->read('cod'));
        $grupo = $this->Auth->user('group_id');

        $options['conditions'] = array('Menu.tab_id' => $id, 'GroupsItem.group_id' => $grupo);
        $options['fields'] = array('Menu.id', 'Menu.icono', 'Menu.nombre', 'Item.nombre', 'Item.controlador', 'Item.accion');
        $options['joins'] =
                array(
                    array('table' => 'items',
                        'alias' => 'Item',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Menu.id = Item.menu_id',
                        )
                    ),
                    array('table' => 'groups_items',
                        'alias' => 'GroupsItem',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Item.id = GroupsItem.item_id',
                        )
                    )
        );
        $options['order'] = array('Menu.orden ASC', 'Item.orden ASC');

        $lista = $this->Menu->find('all', $options);
        $this->set('listado', $lista);
    }

    function admin_ver($id) {
        $this->layout = 'ajax';
        $this->set('cod', $this->Session->read('cod'));
        $grupo = $this->Auth->user('group_id');

        $options['conditions'] = array('Menu.tab_id' => $id, 'GroupsItem.group_id' => $grupo);
        $options['fields'] = array('Menu.id', 'Menu.nombre', 'Item.nombre', 'Item.controlador', 'Item.accion');
        $options['joins'] =
                array(
                    array('table' => 'items',
                        'alias' => 'Item',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Menu.id = Item.menu_id',
                        )
                    ),
                    array('table' => 'groups_items',
                        'alias' => 'GroupsItem',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Item.id = GroupsItem.item_id',
                        )
                    )
        );


        $lista = $this->Menu->find('all', $options);
        $this->set('listado', $lista);
    }

    function edit($id = null) {
        if (empty($this->data)) {

            $this->data = $this->Menu->find("first", array("conditions" => array("Menu.id" => $id)));
            $this->set('tabs', $this->Menu->Tab->find('list', array('order' => 'titulo ASC', 'fields' => array('Tab.id', 'Tab.titulo'))));
        } else {
            if ($this->Menu->save($this->data)) {
                $this->Session->setFlash('Menu Editado con éxito');
                $this->redirect(array('controller' => 'Menus', 'action' => 'index'));
            }
        }
    }

    function delete($id) {
        if ($this->Menu->delete($id)) {
            $this->Session->setFlash('Menú Borrado con exito');
            $this->redirect(array('controller' => 'Menus', 'action' => 'index'));
        }
    }

    function logout() {
        $this->Session->setFlash('Su sesión ha expirado.');
        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }

}

?>