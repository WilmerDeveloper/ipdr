<script>
    
    $(document).ready(function() {
        
        
        jQuery("#fmop").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#adjuntar",
                     beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        });  

    }
        
)
</script>
<div>
    <fieldset>
        <?php echo $this->Form->create("ProductiveBaseline", array("id" => "fmop",'type'=>'file', 'url' => array('controller' => 'ProductiveBaselines', "action" => "upload_file", $this->data['ProductiveBaseline']['id']))); ?>
        <?php echo $this->Form->input('ProductiveBaseline.id', array('label' => 'id', 'class' => '')); ?>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Adjuntar encuesta en formato pdf</th>
                    <th><?php echo $this->Form->file('ProductiveBaseline.archivo_encuesta', array('label' => '','accept'=>'pdf')); ?></th>
                </tr>
            </thead>
          
        </table>
        
        <?php echo $this->Form->hidden('ProductiveBaseline.property_id', array('label' => 'property_id', 'class' => '')); ?>
        <?php echo $this->Form->end(array('label'=> "Guardar" ,'class'=>'submit_button')) ?>
    </fieldset>