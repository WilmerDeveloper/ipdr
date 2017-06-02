<script>
    $(document).ready(function() {
        $("#accordion").accordion(
                {
                    autoHeight: false,
                    collapsible: true,
                    active: false
                }
        );
        $(function() {
            $("#biotabs").tabs();
        });
        $(function() {
            $("#tabs_especies").tabs();
        });
        $('#roads').load('<?php echo $this->Html->url(array('controller' => 'Roads', 'action' => 'index', $property_id)) ?>');
        $('#identificacion').load('<?php echo $this->Html->url(array('controller' => 'properties', 'action' => 'identification_index', $property_id)) ?>');
        $('#acopio').load('<?php echo $this->Html->url(array('controller' => 'properties', 'action' => 'acopio_index', $property_id, 1)) ?>');
        $('#aspectos').load('<?php echo $this->Html->url(array('controller' => 'properties', 'action' => 'acopio_index', $property_id, 2)) ?>');
        $('#observaciones').load('<?php echo $this->Html->url(array('controller' => 'properties', 'action' => 'acopio_index', $property_id, 3)) ?>');
        $('#caracterizacion').load('<?php echo $this->Html->url(array('controller' => 'Producers', 'action' => 'index', $property_id)) ?>');
        $('#hidricos').load('<?php echo $this->Html->url(array('controller' => 'WaterResources', 'action' => 'index', $property_id)) ?>');
        $('#usos_suelo').load('<?php echo $this->Html->url(array('controller' => 'landUses', 'action' => 'index', $property_id)) ?>');
        $('#unidad').load('<?php echo $this->Html->url(array('controller' => 'FloorUnits', 'action' => 'baseline_index', $property_id)) ?>');
        $('#infrastructura').load('<?php echo $this->Html->url(array('controller' => 'AgriculturalInfrastructures', 'action' => 'index', $property_id)) ?>');
        $('#riego').load('<?php echo $this->Html->url(array('controller' => 'risks', 'action' => 'index', $property_id)) ?>');
    }
    );

</script>
<div style="width: 100%; text-align: center" >
    <?php
    if (file_exists("../webroot/files/" . $proyect_id . "-" . $codigo . "/" . $adjunto) and $adjunto != "") {
        echo"<br>";
        echo"<br>";
        echo $this->Html->link('Descargar encuesta', "../files/" . $proyect_id . "-" . $codigo . "/" . $adjunto, array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
        echo"<br>";
        echo"<br>";
    }
    ?>
</div>

<div id="accordion">

    <h3><a href="#">I. IDENTIFICACIÓN</a></h3>
    <div id="identificacion" >

        </fieldset> 

    </div>
    <h3><a href="#">II. CARACTERIZACIÓN DEL SISTEMA DE PRODUCCIÓN</a></h3>
    <div id="caracterizacion" >


    </div>
    <h3><a href="#">III. CARACTERISTICAS DEL PREDIO</a></h3>

    <div id="biotabs" style="width: 100%">
        <ul>
            <li><a href="#aspectos">3.1 Diligencie los siguientes aspectos:</a></li>
            <li><a href="#hidricos">Recursos Hídricos </a></li>
            <li><a href="#unidad">3.2 Tipo de suelo:</a></li>
            <li><a href="#roads">3.3 Vías de acceso</a></li>
            <li><a href="#acopio">3.3 Centro de acopio</a></li>
        </ul>
        <div id="aspectos">

        </div>
        <div id="hidricos">
        </div>
        <div id="unidad">


        </div>
        <div id="roads">
        </div>
        <div id="acopio">

        </div>
    </div>
    <h3><a href="#">IV. USO ACTUAL DEL SUELO</a></h3>
    <div id="usos_suelo">

    </div>


    <h3><a href="#">V. INFRAESTRUCTURA AGROPECUARIA</a></h3>
    <div id="infrastructura">

    </div>
    <h3><a href="#">VI. RIEGO Y VIVIENDA EN EL PREDIO</a></h3>
    <div id="riego">

    </div>

    <h3><a href="#">OBSERVACIONES</a></h3>
    <div id="observaciones">
        <fieldset>
            <?php echo $this->Form->create("Property", array('id' => 'formf4')); ?>
            <?php echo $this->Form->hidden('Property.id') ?>   
            <?php echo $this->Form->hidden('Property.proyect_id') ?>  
            <?php echo $this->Form->input('Property.observacion_linea_base', array('label' => 'Observaciones')); ?>
            <?php echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'properties', 'action' => 'baseline', $property_id), 'update' => 'content', 'indicator' => 'loading')) ?>
            <?php echo $this->Form->end() ?>
        </fieldset>
    </div>
</div>    
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'baselines_index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>

<div style="width: 100%; text-align: center" >
    <?php
    if (file_exists("../webroot/files/" . $proyect_id . "-" . $codigo . "/" . $adjunto) and $adjunto != "") {
       
        echo $this->Html->link('Descargar encuesta', "../files/" . $proyect_id . "-" . $codigo . "/" . $adjunto, array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
        echo"<br>";
        echo"<br>";
    }
    ?>
</div>