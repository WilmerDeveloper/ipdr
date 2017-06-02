<?php

echo $this->Javascript->link('excanvas'); ?>
<?php echo $this->Javascript->link('jquery.jqplot.min'); ?>
<?php echo $this->Javascript->link('jqplot.categoryAxisRenderer.min'); ?>
<?php echo $this->Javascript->link('jqplot.highlighter.min'); ?>
<?php echo $this->Javascript->link('jqplot.canvasAxisTickRenderer.min'); ?>
<?php echo $this->Javascript->link('jqplot.canvasTextRenderer.min'); ?>
<?php echo $this->Javascript->link('jqplot.logAxisRenderer.min'); ?>
<?php echo $this->Html->css('jquery.jqplot'); ?>
<script>
    $("#tbs").tabs();
</script>
<div id="tbs">
    <ul>
        <li><a href="#fragment-1"><span>FASE 0</span></a></li>
        <li><a href="#fragment-2"><span>FASE 1</span></a></li>
        <li><a href="#fragment-3"><span>SEGUIMIENTO</span></a></li>
    </ul>
    <div id="fragment-1">
        <table border="0">

            <tbody>
                <tr>
                    <td>Evaluación de requisitos Beneficiarios</td>
                    <td><?php echo $this->Html->link('Descargar',array('controller'=>'Beneficiaries','action'=>'requirements_report'),array('target'=>'_blank','class'=>'acciones'))?></td>
                </tr>
                <tr>
                    <td>Evaluación de requisitos de predios</td>
                    <td><?php echo $this->Html->link('Descargar',array('controller'=>'Properties','action'=>'requirements_report'),array('target'=>'_blank','class'=>'acciones'))?></td>
                </tr>
                <tr>
                    <td>Calificación global fase 0</td>
                    <td><?php echo $this->Html->link('Descargar',array('controller'=>'Properties','action'=>'total_report'),array('target'=>'_blank','class'=>'acciones'))?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="fragment-2">
        <table border="0">
            <tbody>
                <tr>
                    <td>Maestro Consolidado</td>
                    <td><?php echo $this->Html->link('Descargar',array('controller'=>'proyects','action'=>'total_report'),array('target'=>'_blank','class'=>'acciones'))?></td>
                </tr>
                <tr>
                    <td>Detalle Consolidado</td>
                    <td><?php echo $this->Html->link('Descargar',array('controller'=>'proyects','action'=>'detalle_report'),array('target'=>'_blank','class'=>'acciones'))?></td>
                </tr>
                <tr>
                    <td>Desembolsos</td>
                    <td><?php echo $this->Html->link('Descargar',array('controller'=>'payments','action'=>'total_report'),array('target'=>'_blank','class'=>'acciones'))?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="fragment-3">
        <table border="0">
            <tbody>
                <tr>
                    <td>Reporte general seguimiento</td>
                    <td><?php echo $this->Html->link('Descargar',array('controller'=>'follows','action'=>'report'),array('target'=>'_blank','class'=>'acciones'))?></td>
                </tr>
                <tr>
                    <td>Reporte extractos bancarios</td>
                    <td><?php echo $this->Html->link('Descargar',array('controller'=>'extracts','action'=>'report'),array('target'=>'_blank','class'=>'acciones'))?></td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
<?php echo $this->Form->create("Payment"); ?>
<table border="0" style="width: 50px" cellspacing="0" cellpadding="1">
    <tr>
        <td><label>Vigencia:</label></td>
        <td ><?php echo $this->Form->input('Payment.call_id',array('id'=>'convocatoria', 'label' => false,'empty' =>'Todas','options'=>$calls ));?></td>
        <td><?php echo $this->Ajax->submit('Filtrar',array('url'=>array('controller'=> 'Payments','action' =>'reports'),'update'=>'content' ,'indicator'=>'loading' ));?></td>
    </tr>

</table>
<?php echo $this->Form->end()?>
<?php if (!empty($datos)):?>
<script>
    $(document).ready(function () {
        var cal = $("#convocatoria option:selected").text();

        var line1 = [<?php echo $datos?>];
        var plot1 = $.jqplot('chart1', [line1], {
            title: 'Desembolsos por departamento ( ' + cal + ')<br>',
            axes: {
                xaxis: {
                    renderer: $.jqplot.CategoryAxisRenderer,
                    tickRenderer: $.jqplot.CanvasAxisTickRenderer,
                    tickOptions: {
                        angle: -90
                    }

                },
                yaxis: {
                    pad: 0,
                    tickOptions: {
                        formatString: "$%'d",
                    }
                }
            },
            highlighter: {
                show: true,
                tooltipAxes: 'y',
                sizeAdjust: 4.5,
            },
            cursor: {
                show: false
            }
        });
    });


</script>
<div id="chart1" style="height:350px;width:60%;margin: 0 auto "></div>
<?php endif;?>