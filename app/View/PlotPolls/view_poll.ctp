<script>
    $(document).ready(function() {
        $("#accordion").accordion(
        {
            autoHeight: false,
            collapsible: true,
            active: false
        }
    );
        $('#general').load('<?php echo $this->Html->url(array('controller' => 'PlotPolls', 'action' => 'general_index', $poll_id)) ?>');
        
        $('#beneficiarios').load('<?php echo $this->Html->url(array('controller' => 'Beneficiaries', 'action' => 'plot_index', $beneficiary_id)) ?>');
        $('#ocupantes').load('<?php echo $this->Html->url(array('controller' => 'Occupants', 'action' => 'index', $poll_id)) ?>');
        
        $('#areas').load('<?php echo $this->Html->url(array('controller' => 'FollowAreas', 'action' => 'index', $poll_id)) ?>');
        $('#forestal').load('<?php echo $this->Html->url(array('controller' => 'ForestPolls', 'action' => 'index', $poll_id)) ?>');
        $('#pecuario').load('<?php echo $this->Html->url(array('controller' => 'LivestockPolls', 'action' => 'index', $poll_id)) ?>');
        $('#producto').load('<?php echo $this->Html->url(array('controller' => 'PlotProductions', 'action' => 'index', $poll_id)) ?>');
       
        $('#obra').load('<?php echo $this->Html->url(array('controller' => 'PlotPolls', 'action' => 'work_index', $poll_id)) ?>');
        $('#asistencia').load('<?php echo $this->Html->url(array('controller' => 'PlotPolls', 'action' => 'tecnical_index', $poll_id)) ?>');
        $('#ambiental').load('<?php echo $this->Html->url(array('controller' => 'PlotPolls', 'action' => 'ambiental_index', $poll_id)) ?>');
        
        $('#compromisos').load('<?php echo $this->Html->url(array('controller' => 'Liabilities', 'action' => 'index', $poll_id)) ?>');
        $('#tipologias').load('<?php echo $this->Html->url(array('controller' => 'Typologies', 'action' => 'index', $poll_id)) ?>');
        

    });
</script>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'visits', 'action' => 'beneficiary_index', $visit_id,$follow_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
<div id="accordion">

    <h3><a>INFORMACIÓN GENERAL DE LA FAMILIA</a></h3>
    <div id="general">
    </div>

    <h3><a>ADJUDICATARIOS</a></h3>
    <div id="beneficiarios">
    </div>

    <h3><a>OCUPANTES (No beneficiarios)</a></h3>
    <div id="ocupantes">
    </div>

    <h3><a>USO DE SUELO AGRICOLA</a></h3>
    <div id="areas">
    </div>

    <h3><a>INVENTARIO PECUARIO DE LA PARCELA</a></h3>
    <div id="pecuario">
    </div>

    <h3><a>USO DE SUELO FORESTAL</a></h3>
    <div id="forestal"></div>

    <h3><a>PRODUCCIÓN DE LA PARCELA</a></h3>
    <div id="producto">
    </div>

    <h3><a>MANO DE OBRA USADA EN  LA PARCELA</a></h3>
    <div id="obra">
    </div>

    <h3><a>ASISTENCIA TÉCNICA, RECOMENDACIONES</a></h3>
    <div id="asistencia">
    </div>
    <h3><a>COMPONENTE AMBIENTAL</a></h3>
    <div id="ambiental">
    </div>

    <h3><a>COMPROMISOS</a></h3>
    <div id="compromisos">
    </div>

    <h3><a>TIPOLOGIAS (PAS)</a></h3>
    <div id="tipologias">
    </div>

</div>
<br/>       
<br/>       

<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'visits', 'action' => 'beneficiary_index', $visit_id,$follow_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>