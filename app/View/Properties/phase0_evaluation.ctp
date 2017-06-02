<script>
    $(document).ready(function() {
        $( "#accordion" ).accordion(
        {
            autoHeight: false,
            collapsible: true ,
            active: false
        }
    );
        $( '#predios' ).load('<?php echo $this->Html->url(array('controller' => 'PropertyRequirements', 'action' => 'index', $property_id)) ?>');
        $( '#aspirantes' ).load('<?php echo $this->Html->url(array('controller' => 'Beneficiaries', 'action' => 'review_index', $property_id)) ?>');
        $( '#calificacion' ).load('<?php echo $this->Html->url(array('controller' => 'Properties', 'action' => 'phase0_calification_index', $property_id,$mostrar_calificacion)) ?>');
    }
);
</script>
<div id="accordion">
    <h3><a href="#">EVALUACIÓN DE PREDIOS</a></h3>
    <div id="predios" >

    </div>
    <h3><a href="#">EVALUACIÓN DE ASPIRANTES</a></h3>
    <div id="aspirantes">

    </div>

   
        <h3><a href="#">EVALUACIÓN FASE 0</a></h3>
        <div id="calificacion" >
        </div>
    


</div> 
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td>
                <?php
                
                if ($redirect == 0)
                    echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'property_index', $property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false));
                else
                    echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'resolution_index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false));
                ?>
            </td>
        </tr>
    </tbody>
</table>