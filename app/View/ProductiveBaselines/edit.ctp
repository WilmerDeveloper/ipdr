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
            $( "#tabs_especies" ).tabs();
        });
        
       
     
      
        $( '#identificacion' ).load('<?php echo $this->Html->url(array('controller' => 'properties', 'action' => 'identification_index', $this->data['ProductiveBaseline']['property_id'])) ?>');
        $( '#sistema_agricola' ).load('<?php echo $this->Html->url(array('controller' => 'AgriculturalSystems', 'action' => 'index', $this->data['ProductiveBaseline']['id'])) ?>');
        $( '#sistema_pecuario' ).load('<?php echo $this->Html->url(array('controller' => 'LivestockSystems', 'action' => 'index', $this->data['ProductiveBaseline']['id'])) ?>');
        $( '#porcinos' ).load('<?php echo $this->Html->url(array('controller' => 'HogInventories', 'action' => 'index', $this->data['ProductiveBaseline']['id'])) ?>');
        $( '#avicola' ).load('<?php echo $this->Html->url(array('controller' => 'PoultryInventories', 'action' => 'index', $this->data['ProductiveBaseline']['id'])) ?>');
        $( '#especies' ).load('<?php echo $this->Html->url(array('controller' => 'LivestockSpecies', 'action' => 'index', $this->data['ProductiveBaseline']['id'])) ?>');
        $( '#peces' ).load('<?php echo $this->Html->url(array('controller' => 'FishInventories', 'action' => 'index', $this->data['ProductiveBaseline']['id'])) ?>');
        $( '#abejas' ).load('<?php echo $this->Html->url(array('controller' => 'BeekeepingInventories', 'action' => 'index', $this->data['ProductiveBaseline']['id'])) ?>');
         $( '#infrastructura' ).load('<?php echo $this->Html->url(array('controller' => 'AgriculturalInfrastructures', 'action' => 'index', $this->data['ProductiveBaseline']['id'])) ?>');
        $( '#asistencia' ).load('<?php echo $this->Html->url(array('controller' => 'TechnicalAids', 'action' => 'index',$this->data['ProductiveBaseline']['id'])) ?>');
        $( '#comercializacion' ).load('<?php echo $this->Html->url(array('controller' => 'Marketings', 'action' => 'index',$this->data['ProductiveBaseline']['id'])) ?>');
        $( '#operativo' ).load('<?php echo $this->Html->url(array('controller' => 'ProductiveBaselines', 'action' => 'operative_index',$this->data['ProductiveBaseline']['id'])) ?>');
        $( '#adjuntar' ).load('<?php echo $this->Html->url(array('controller' => 'ProductiveBaselines', 'action' => 'upload_file',$this->data['ProductiveBaseline']['id'])) ?>');
    

    }
);

</script>

<div style="width: 100%; text-align: center" >
    <?php
    if (file_exists("../webroot/files/" . $proyect_id . "-" . $codigo . "/" . $this->data['ProductiveBaseline']['adjunto_encuesta']) and $this->data['ProductiveBaseline']['adjunto_encuesta'] != "") {
        echo"<br>";
        echo"<br>";
        echo $this->Html->link('Descargar encuesta', "../files/" . $proyect_id . "-" . $codigo . "/" . $this->data['ProductiveBaseline']['adjunto_encuesta'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
        echo"<br>";
        echo"<br>";
    }
    ?>
</div>
<div id="accordion">

    <h3><a href="#">I. IDENTIFICACIÓN</a></h3>
    <div id="identificacion" >


    </div>

    <h3><a href="#">II. SISTEMA AGRÍCOLA</a></h3>
    <div id="sistema_agricola">

    </div>
    <h3><a href="#">II. SISTEMA PECUARIO</a></h3>
    <div id="sistema_pecuario">

    </div>
    <h3><a href="#">IV. ESPECIES MENORES</a></h3>
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

    <h3><a href="#">V. ASISTENCIA TÉCNICA</a></h3>
    <div id="asistencia">

    </div>
    <h3><a href="#">VI. COMERCIALIZACIÓN</a></h3>
    <div id="comercializacion">

    </div>
    <h3><a href="#">GENERAL</a></h3>
    <div id="operativo">

    </div>
    <h3><a href="#">ADJUNTAR ENCUESTA</a></h3>
    <div id="adjuntar">

    </div>





</div>  
<div style="width: 100%; text-align: center" >
    <?php
    if (file_exists("../webroot/files/" . $proyect_id . "-" . $codigo . "/" . $this->data['ProductiveBaseline']['adjunto_encuesta']) and $this->data['ProductiveBaseline']['adjunto_encuesta'] != "") {
        echo"<br>";
        echo $this->Html->link('Descargar encuesta', "../files/" . $proyect_id . "-" . $codigo . "/" . $this->data['ProductiveBaseline']['adjunto_encuesta'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
        echo"<br>";
        echo"<br>";
    }
    ?>
</div>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'ProductiveBaselines', 'action' => 'index', $this->data['ProductiveBaseline']['property_id'] ), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>










