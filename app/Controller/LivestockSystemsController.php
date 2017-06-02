<?php

Class LivestockSystemsController extends AppController {

    public $name = 'LivestockSystems';

    function add($productive_baseline_id) {
        $this->set('productive_baseline_id', $productive_baseline_id);
        if (empty($this->data)) {
            
        } else {

            if ($this->LivestockSystem->save($this->data)) {
                $this->Session->setFlash('Registro Adicionado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'LivestockSystems', 'action' => 'index', $productive_baseline_id));
            } else {
                $this->Session->setFlash('Error Guardando datos');
            }
        }
    }

    function edit($id) {
        $this->LivestockSystem->recursive = -1;
        if (empty($this->data)) {

            $this->data = $this->LivestockSystem->find('first', array('conditions' => array('LivestockSystem.id' => $id), 'fields' => array('LivestockSystem.id', 'LivestockSystem.area_pastos_mejorados', 'LivestockSystem.numero_partos', 'LivestockSystem.area_pastos_corte', 'LivestockSystem.area_pastos_tradicionales', 'LivestockSystem.existe_ganado', 'LivestockSystem.especie_predominante', 'LivestockSystem.machos_menores_doce', 'LivestockSystem.hembras_menores_doce', 'LivestockSystem.machos_menores_23', 'LivestockSystem.hembras_menores_23', 'LivestockSystem.machos_menores_36', 'LivestockSystem.hembras_menores_36', 'LivestockSystem.machos_mayores_36', 'LivestockSystem.hembras_mayores_36', 'LivestockSystem.orientacion_principal', 'LivestockSystem.inseminacion', 'LivestockSystem.monta_natural', 'LivestockSystem.marca_ganado', 'LivestockSystem.vacuna', 'LivestockSystem.aftosa', 'LivestockSystem.brucelosis', 'LivestockSystem.corrales', 'LivestockSystem.equipo_ordeno', 'LivestockSystem.bascula', 'LivestockSystem.brete', 'LivestockSystem.tanque', 'LivestockSystem.otro', 'LivestockSystem.produccion_leche', 'LivestockSystem.cantidad_vacas', 'LivestockSystem.cantidad_leche', 'LivestockSystem.nombre_unidad', 'LivestockSystem.unidad_en_litros', 'LivestockSystem.procesada_en_finca', 'LivestockSystem.consumida_en_finca', 'LivestockSystem.vendida_industria', 'LivestockSystem.vendida_intermediario', 'LivestockSystem.vendida_otro', 'LivestockSystem.promedio_produccion', 'LivestockSystem.litros_vendidos', 'LivestockSystem.productive_baseline_id', 'LivestockSystem.id')));
        } else {

            if ($this->LivestockSystem->save($this->data)) {
                $this->Session->setFlash('Registro editado correctamente', 'flash_custom');
                $this->redirect(array('controller' => 'LivestockSystems', 'action' => 'index', $this->data['LivestockSystem']['productive_baseline_id']));
            } else {
                $this->Session->setFlash('Error editando datos');
            }
        }
    }

    function index($productive_baseline_id) {
        $this->set('productive_baseline_id', $productive_baseline_id);
        $this->paginate = array('LivestockSystem' => array('recursive' => -1, 'maxLimit' => 500, 'limit' => 50, 'fields' => array('LivestockSystem.numero_partos', 'LivestockSystem.id', 'LivestockSystem.area_pastos_mejorados', 'LivestockSystem.area_pastos_corte', 'LivestockSystem.area_pastos_tradicionales', 'LivestockSystem.existe_ganado', 'LivestockSystem.especie_predominante', 'LivestockSystem.machos_menores_doce', 'LivestockSystem.hembras_menores_doce', 'LivestockSystem.machos_menores_23', 'LivestockSystem.hembras_menores_23', 'LivestockSystem.machos_menores_36', 'LivestockSystem.hembras_menores_36', 'LivestockSystem.machos_mayores_36', 'LivestockSystem.hembras_mayores_36', 'LivestockSystem.orientacion_principal', 'LivestockSystem.inseminacion', 'LivestockSystem.monta_natural', 'LivestockSystem.marca_ganado', 'LivestockSystem.vacuna', 'LivestockSystem.aftosa', 'LivestockSystem.brucelosis', 'LivestockSystem.corrales', 'LivestockSystem.equipo_ordeno', 'LivestockSystem.bascula', 'LivestockSystem.brete', 'LivestockSystem.tanque', 'LivestockSystem.otro', 'LivestockSystem.produccion_leche', 'LivestockSystem.cantidad_vacas', 'LivestockSystem.cantidad_leche', 'LivestockSystem.nombre_unidad', 'LivestockSystem.unidad_en_litros', 'LivestockSystem.procesada_en_finca', 'LivestockSystem.consumida_en_finca', 'LivestockSystem.vendida_industria', 'LivestockSystem.vendida_intermediario', 'LivestockSystem.vendida_otro', 'LivestockSystem.promedio_produccion', 'LivestockSystem.litros_vendidos', 'LivestockSystem.id')));
        $this->set('LivestockSystems', $this->paginate(array('LivestockSystem.activo'=>1, 'LivestockSystem.productive_baseline_id' => $productive_baseline_id)));
    }

    function delete($system_id, $productive_baseline_id) {
        $datos = array('LivestockSystem' => array(
                'id' => $system_id,
                'sincronizado' => 0,
                'activo' => 0
        ));
        if ($this->LivestockSystem->save($datos)) {
            $this->Session->setFlash('Registro borrado correctamente', 'flash_custom');
            $this->redirect(array('controller' => 'LivestockSystems', 'action' => 'index', $productive_baseline_id));
        } else {
            $this->Session->setFlash('Error editando datos');
        }
//        if ($this->LivestockSystem->delete($system_id)) {
//            $this->Session->setFlash('Registro borrado correctamente', 'flash_custom');
//            $this->redirect(array('controller' => 'LivestockSystems', 'action' => 'index', $productive_baseline_id));
//        } else {
//            $this->Session->setFlash('Error editando datos');
//        }
    }

}

?>