<script>


    $(document).ready(function() {
        
        
        jQuery("#formulario").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#lender"
                });
            }
        });  }
        
)
        
</script>
<div id="lender">
<?php echo $this->Form->create("Lender",array("id"=>"formulario",  "action"=>"add/".$productive_poll_id)); ?>
<?php echo $this->Form->input('Lender.nombre',array('label'=>'Entidad','class' =>''   ,'empty'=>'','options'=>array('Banco Agrario' => 'Banco Agrario','ONG microfinanciera' => 'ONG microfinanciera','Cooperativas' => 'Cooperativas','Proveedores de insumos' => 'Proveedores de insumos','Amigos o familiares' => 'Amigos o familiares','Casa de empeño' => 'Casa de empeño','Prestamistas particulares' => 'Prestamistas particulares','Otra institucion' => 'Otra institucion',) ));?>
<?php echo $this->Form->hidden('Lender.productive_poll_id',array('label'=>'','class' =>''  ,'value'=>$productive_poll_id  ));?>
<?php echo $this->Form->end("Guardar")?>
</div>