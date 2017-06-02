<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of groups_controller
 *
 * @author 250-1-405
 */
class GroupsController extends AppController {

    //put your code here
    var $name = "Groups";

    function index() {
        $this->layout = "ajax";
        $this->set('group', $this->Group->find("all", array("fields" => array("Group.id", "Group.name"))));
    }

    function add() {
        $this->layout = "ajax";
        if (!empty($this->data)) {

            if ($this->Group->save($this->data)) {
                $this->Session->setFlash(_("Grupo creado con exito"));
                $this->redirect(array('controller' => 'Groups', 'action' => 'index'));
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        if (!empty($this->data)) {
            if ($this->Group->save($this->data)) {
                $this->Session->setFlash(_("Grupo Editado con exito"));
                $this->redirect(array('controller' => 'Groups', 'action' => 'index'));
            }
        } else {
            $this->data = $this->Group->find('first', array('conditions' => array('Group.id' => $id)));
        }
    }

    function delete($id) {
        $this->layout = "ajax";
        if ($this->Group->delete($id)) {
            $this->Session->setFlash(_("Grupo borrado con exito"));
            $this->redirect(array('controller' => 'Groups', 'action' => 'index'));
        }
    }

}

?>
