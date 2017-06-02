<script>

    $(document).ready(function() {


        jQuery("#gen_edit").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#general",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });
    }

    )
</script>
<fieldset>
<?php echo $this->Form->create("Marketing",array('id'=>'gen_edit','url'=>array('controller'=>'plotPolls','action'=>'general_edit',$this->data['PlotPoll']['id']))); ?>

<?php echo $this->Form->hidden('PlotPoll.id' );?>
<?php echo $this->Form->input('PlotPoll.adjudicatarios_habitan',array('label'=>'¿Los adjudicatarios viven actualmente en ella?','class' =>'required'  ,'empty'=>'','options'=>array('Si' => 'Si','No'=>'No') ));?>
<?php echo $this->Form->input('PlotPoll.lugar_adjudiicatarios',array('label'=>'En caso contrario indicar donde viven','class' =>''   ));?>
<?php echo $this->Form->input('PlotPoll.costo_desplazamiento',array('label'=>'Costo desplazamiento ida y regreso al predio','class' =>''   ));?>
<?php echo $this->Form->input('PlotPoll.intetrvalo_visitas',array('label'=>'¿Cada cuanto van al predio? (dias)','class' =>''   ));?>
 <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</fieldset>