<?php

Class MarketingLinesController extends AppController {

    public $name = 'MarketingLines';

    function add($productive_poll_id) {
        $this->layout = "ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        $this->set('productiveActivities', $this->MarketingLine->ProductiveActivity->find('list', array('fields' => array('id', 'nombre'))));
        if (empty($this->data)) {
            
        } else {

            if ($this->MarketingLine->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'MarketingLines', 'action' => 'index',$productive_poll_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->layout = "ajax";
        $this->set('productiveActivities', $this->MarketingLine->ProductiveActivity->find('list', array('fields' => array('id', 'nombre'))));
        $this->MarketingLine->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->MarketingLine->find('first', array('conditions' => array('MarketingLine.id' => $id), 'fields' => array('MarketingLine.nombre_canal', 'MarketingLine.variedad', 'MarketingLine.calidad', 'MarketingLine.unidad', 'MarketingLine.unidades_anio', 'MarketingLine.precio_promedio_unidad', 'MarketingLine.entrega', 'MarketingLine.enero', 'MarketingLine.febrero', 'MarketingLine.marzo', 'MarketingLine.abril', 'MarketingLine.mayo', 'MarketingLine.junio', 'MarketingLine.julio', 'MarketingLine.agosto', 'MarketingLine.septiembre', 'MarketingLine.octubre', 'MarketingLine.noviembre', 'MarketingLine.diciembre', 'MarketingLine.productive_poll_id', 'MarketingLine.productive_activity_id', 'MarketingLine.id', 'MarketingLine.tipo_canal', 'MarketingLine.precio_cosecha')));
        } else {

            if ($this->MarketingLine->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'MarketingLines', 'action' => 'index',$this->data['MarketingLine']['productive_poll_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($productive_poll_id) {
        $this->layout = "ajax";
        $this->set('productive_poll_id', $productive_poll_id);
        $this->paginate = array('MarketingLine' => array('recursive' =>1,'maxLimit' => 500, 'limit' => 50, 'fields' => array('ProductiveActivity.nombre', 'MarketingLine.nombre_canal', 'MarketingLine.variedad', 'MarketingLine.calidad', 'MarketingLine.unidad', 'MarketingLine.unidades_anio', 'MarketingLine.precio_promedio_unidad', 'MarketingLine.entrega', 'MarketingLine.enero', 'MarketingLine.febrero', 'MarketingLine.marzo', 'MarketingLine.abril', 'MarketingLine.mayo', 'MarketingLine.junio', 'MarketingLine.julio', 'MarketingLine.agosto', 'MarketingLine.septiembre', 'MarketingLine.octubre', 'MarketingLine.noviembre', 'MarketingLine.diciembre', 'MarketingLine.productive_poll_id', 'MarketingLine.productive_activity_id', 'MarketingLine.id', 'MarketingLine.tipo_canal', 'MarketingLine.precio_cosecha')));
        $this->set('MarketingLines', $this->paginate(array('MarketingLine.productive_poll_id' => $productive_poll_id)));
    }

}

?>