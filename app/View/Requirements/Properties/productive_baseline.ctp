<script>
    $(document).ready(function() {
        $( "#accordion" ).accordion(
        {
            autoHeight: false,
            collapsible: true ,
            active: false
        }
    );
        $(function() {
            $( "#biotabs" ).tabs();
        });
        $(function() {
            $( "#tabs_especies" ).tabs();
        });
        
        jQuery("#form1").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
        });
        jQuery("#form2").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
        });
        jQuery("#form3").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
          
            
        });
        jQuery("#form4").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
            
        });
      
      
     
        $( '#roads' ).load('<?php echo $this->Html->url(array('controller' => 'Roads', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#caracterizacion' ).load('<?php echo $this->Html->url(array('controller' => 'Producers', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#hidricos' ).load('<?php echo $this->Html->url(array('controller' => 'WaterResources', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#usos_suelo' ).load('<?php echo $this->Html->url(array('controller' => 'landUses', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#sistema_agricola' ).load('<?php echo $this->Html->url(array('controller' => 'AgriculturalSystems', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#sistema_pecuario' ).load('<?php echo $this->Html->url(array('controller' => 'LivestockSystems', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#porcinos' ).load('<?php echo $this->Html->url(array('controller' => 'HogInventories', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#avicola' ).load('<?php echo $this->Html->url(array('controller' => 'PoultryInventories', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#especies' ).load('<?php echo $this->Html->url(array('controller' => 'LivestockSpecies', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#peces' ).load('<?php echo $this->Html->url(array('controller' => 'FishInventories', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#abejas' ).load('<?php echo $this->Html->url(array('controller' => 'BeekeepingInventories', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#infrastructura' ).load('<?php echo $this->Html->url(array('controller' => 'AgriculturalInfrastructures', 'action' => 'index', $this->data['Property']['id'])) ?>');
        $( '#asistencia' ).load('<?php echo $this->Html->url(array('controller' => 'TechnicalAids', 'action' => 'index', $this->data['Property']['id'])) ?>');

    }
);

</script>

<div id="accordion">

    <h3><a href="#">I. IDENTIFICACIÓN</a></h3>
    <div >
        <fieldset>
            <?php echo $this->Form->create("Property", array('id' => 'form1', 'url' => array('controller' => 'properties', "action" => "baseline", $this->data['Property']['id']))); ?>
            <?php echo $this->Form->hidden('Property.id') ?>   
            <?php echo $this->Form->input('Property.proyect_id', array('empty' => 0)) ?>   
            <?php
            echo $this->Ajax->observeField('PropertyDepartamentId', array(
                'url' => array('action' => 'select'),
                'frequency' => 0.2,
                'update' => 'ciudades',
                    )
            );
            ?>

            <?php echo $this->Form->input('Property.departament_id', array('label' => '1 Departamento', 'empty' => 'Seleccione departamento', 'class' => 'required')); ?>
            <div id="ciudades">
                <?php
                echo $this->Form->input('Property.city_id', array(
                    'label' => __('1.2 Municipio', true),
                    'empty' => __('Seleccione ciudad', true),
                        )
                );
                ?>
            </div>
            <?php echo $this->Form->input('Property.vereda', array('label' => '1.3 Vereda')); ?>
            <?php echo $this->Form->input('Property.corregimiento', array('label' => '1.4 Corregimiento')); ?>
            <?php echo $this->Form->input('Property.nombre', array('label' => '1.5 Nombre del predio', 'class' => 'required')); ?>
            <?php echo $this->Form->input('Property.extension', array('label' => '1.6 Área del predio (En Hectáreas):', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.matricula', array('label' => '1.7 Número de Matrícula', 'class' => 'required')); ?>
            <br>
            <legend>1.8 Coordenadas GPS:</legend>
            <?php echo $this->Form->input('Property.georeferencia1', array('label' => 'Georeferenciación (escribir coordenada latitud-grado)', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.georeferencia2', array('label' => 'Georeferenciación (escribir coordenadas latitud-minuto)', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.georeferencia3', array('label' => 'Georeferenciación (escribir coordenadas latitud-segundo)', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.georeferencia4', array('label' => 'Georeferenciación (escribir coordenadas longitud-grado)', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.georeferencia5', array('label' => 'Georeferenciación (escribir coordenadas longitud-minuto)', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.georeferencia6', array('label' => 'Georeferenciación (escribir coordenadas longitud-segundo)', 'class' => 'required', 'type' => 'number')); ?>
            <?php echo $this->Form->input('Property.numero_parcelas', array('label' => '1.9 Numero de Parcelas en el predio', 'class' => '')); ?>
            <?php echo $this->Form->input('Property.numero_habitantes', array('label' => '1.10 Numero de Familias Habitantes en el predio:', 'class' => '')); ?>
            <?php echo $this->Form->input('Property.nombre_resguardo', array('label' => '1.11 Nombre del Resguardo:', 'class' => '')); ?>
            <?php echo $this->Form->input('Property.nombre_consejo', array('label' => '1.12 Nombre del Consejo Comunitario:', 'class' => '')); ?>
            <?php
            //echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'properties', 'action' => 'baseline', $this->data['Property']['id']), 'update' => 'content', 'indicator' => 'loading'));
            echo $this->Form->end('Guardar');
            ?>
        </fieldset> 

    </div>
    <h3><a href="#">II. CARACTERIZACIÓN DEL SISTEMA DE PRODUCCIÓN</a></h3>
    <div id="caracterizacion" >


    </div>
    <h3><a href="#">III. CARACTERISTICAS DEL PREDIO</a></h3>

    <div id="biotabs" style="width: 100%">
        <ul>
            <li><a href="#tabs-1">3.1 Diligencie los siguientes aspectos:</a></li>
            <li><a href="#hidricos">Recursos Hídricos </a></li>
            <li><a href="#unidad">3.2 Tipo de suelo:</a></li>
            <li><a href="#roads">3.3 Vías de acceso</a></li>
            <li><a href="#acopio">3.3 Centro de acopio</a></li>
        </ul>
        <div id="tabs-1">
            <fieldset>
                <?php echo $this->Form->create("Property", array('id' => 'form2', "url" => array('controller' => 'Properties', 'action' => "baseline", $this->data['Property']['id']))); ?>
                <?php echo $this->Form->hidden('Property.id') ?>   
                <?php echo $this->Form->hidden('Property.proyect_id') ?>  
                <?php echo $this->Form->input('Property.precipitacion_promedio', array('label' => 'Precipitación promedio anual (mm)', 'class' => '', 'type' => 'number')); ?>
                <?php echo $this->Form->input('Property.luminosidad_promedio', array('label' => 'Luminosidad promedio anual', 'class' => '', 'type' => 'number')); ?>
                <?php echo $this->Form->input('Property.temperatura_promedio', array('label' => 'Temperatura promedio anual (ºC)', 'class' => '', 'type' => 'number')); ?>
                <?php echo $this->Form->input('Property.altura_promedio', array('label' => 'Altura sobre el nivel del mar', 'class' => '', 'type' => 'number')); ?>
                <?php echo $this->Form->input('Property.piso', array('label' => 'Piso Térmico', 'class' => '', 'empty' => '', 'options' => array('Cálido' => 'Cálido', 'Templado' => 'Templado', 'Frío' => 'Frío'))); ?>
                <?php echo $this->Form->input('Property.lluvias', array('label' => 'Distribución de las lluvias', 'class' => '', 'empty' => '', 'options' => array('Bimodal' => 'Bimodal', 'Monomodal' => 'Monomodal'))); ?>
                <?php echo $this->Form->end("Guardar") ?>
            </fieldset>
        </div>
        <div id="hidricos">
        </div>
        <div id="unidad">


        </div>
        <div id="roads">
        </div>
        <div id="acopio">
            <fieldset>
                <?php echo $this->Form->create("Property", array('id' => 'form3', "url" => array('controller' => 'Properties', 'action' => "baseline", $this->data['Property']['id']))); ?>
                <?php echo $this->Form->hidden('Property.id') ?>   
                <?php echo $this->Form->hidden('Property.proyect_id') ?>  
                <?php echo $this->Form->input('Property.centro_acopio', array('label' => '3.4 Centro de acopio: (Municipio)', 'class' => '', 'type' => '')); ?>
                <?php echo $this->Form->input('Property.tiempo_centro_acopio', array('label' => '3.5 Tiempo empleado hacia el centro de acopio', 'class' => '', 'type' => 'number')); ?>
                <?php echo $this->Form->end("Guardar") ?>


            </fieldset>
        </div>
    </div>
    <h3><a href="#">IV. USO ACTUAL DEL SUELO</a></h3>
    <div id="usos_suelo">

    </div>
    <h3><a href="#">V. SISTEMA AGRÍCOLA</a></h3>
    <div id="sistema_agricola">

    </div>
    <h3><a href="#">VI. SISTEMA PECUARIO</a></h3>
    <div id="sistema_pecuario">

    </div>
    <h3><a href="#">VII. ESPECIES MENORES</a></h3>
    <div id="tabs_especies">
            <ul>
                <li><a href="#porcinos">Inventario porcinos</a></li>
                <li><a href="#avicola">Inventario avícola</a></li>
                <li><a href="#especies"> Otras especies pecuarias:</a></li>
                <li><a href="#peces"> Piscicultura:</a></li>
                <li><a href="#abejas"> Apicultura:</a></li>
               
            </ul>
            <div id="porcinos">
 
            </div>
            <div id="avicola">
 
            </div>
            <div id="especies">
 
            </div>
            <div id="peces">
 
            </div>
            <div id="abejas">
 
            </div>
        
    </div>
    
     <h3><a href="#">VIII. INFRAESTRUCTURA AGROPECUARIA</a></h3>
    <div id="infrastructura">

    </div>
     <h3><a href="#">X. ASISTENCIA TÉCNICA</a></h3>
    <div id="asistencia">

    </div>





</div>    
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>