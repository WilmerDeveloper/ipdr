<script>

    $(document).ready(function() {


        jQuery("#tp").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#ambiental",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

    )
</script>


<?php echo $this->Form->create("PlotPoll", array("id" => "tp", 'url' => array("action" => "edit_ambiental", $this->data['PlotPoll']['id']))); ?>

<fieldset>
    <h2>COMPONENTE AMBIENTAL</h2>
    <?php echo $this->Form->input('PlotPoll.deforestacion', array('label' => 'Existe Deforestación', 'empty' => '', 'class' => 'required', 'options' => array('1' => 'Si', '0' => 'No'))) ?><br>
    <?php echo $this->Form->input('PlotPoll.concesion_agua', array('label' => 'Cuenta con concesión de aguas superficiales o subterráneas', 'empty' => '', 'class' => 'required', 'options' => array('1' => 'Si', '0' => 'No'))) ?><br><br><br>
    <?php echo $this->Form->input('PlotPoll.erosion', array('label' => 'Se evidencian procesos Erosivos ', 'empty' => '', 'class' => 'required', 'options' => array('1' => 'Si', '0' => 'No'))) ?><br>
    <?php echo $this->Form->input('PlotPoll.remocion_en_masa', array('label' => 'Se evidencian procesos de remoción en masa ', 'empty' => '', 'class' => 'required', 'options' => array('1' => 'Si', '0' => 'No'))) ?><br><br>
    <?php echo $this->Form->input('PlotPoll.contaminacion_agua', array('label' => 'Existe contaminación de recurso hídrico', 'empty' => '', 'class' => 'required', 'options' => array('1' => 'Si', '0' => 'No'))) ?><br><br>
    <?php echo $this->Form->input('PlotPoll.invasion_zonas_protecion', array('label' => 'Se evidencia Invasión de zonas de protección hídrica o reserva', 'empty' => '', 'class' => 'required', 'options' => array('1' => 'Si', '0' => 'No'))) ?><br><br><br>
    <?php echo $this->Form->input('PlotPoll.residuos_solidos', array('label' => '¿Donde deposita los residuos sólidos?', 'class' => '')); ?><br>
    <div class="btn-group">
        <?php echo $this->Form->input('PlotPoll.acueducto_veredal', array('label' => 'Acueducto veredal', 'empty' => '', )) ?>
        <?php echo $this->Form->input('PlotPoll.quebrada', array('label' => 'Quebrada', 'empty' => '', )) ?>
        <?php echo $this->Form->input('PlotPoll.rio', array('label' => 'Rio', 'empty' => '', )) ?>
        <?php echo $this->Form->input('PlotPoll.pozo', array('label' => 'Pozo', 'empty' => '', )) ?>
        <?php echo $this->Form->input('PlotPoll.aljibe', array('label' => 'Aljibe', 'empty' => '', )) ?>
    </div>
</fieldset>
<fieldset>
    <?php echo $this->Form->input('PlotPoll.observacion_ambiental', array('label' => 'Observaciones', 'class' => '')); ?><br>
    
    <?php echo $this->Form->hidden('PlotPoll.id'); ?>
    <?php echo $this->Form->end("Guardar") ?>
</fieldset>
<br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'PlotPolls', 'action' => 'ambiental_index', $this->data['PlotPoll']['id']), array('update' => 'ambiental', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>