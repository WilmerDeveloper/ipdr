<script>
    
    $(document).ready(function() {
        
        
        jQuery("#fmop").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content",
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
        <?php echo $this->Form->create("FamilyPoll", array("id" => "fmop",'type'=>'file', 'url' => array('controller' => 'FamilyPolls', "action" => "upload_file", $this->data['FamilyPoll']['id'],$beneficiary_id))); ?>
        <?php echo $this->Form->input('FamilyPoll.id', array('label' => 'id', 'class' => '')); ?>
        
        <table border="1">
            <thead>
                <tr>
                    <th>Adjuntar encuesta en formato pdf</th>
                    <th><?php echo $this->Form->file('FamilyPoll.archivo_encuesta', array('label' => '','accept'=>'pdf')); ?></th>
                </tr>
            </thead>
          
        </table>
        
        <?php echo $this->Form->hidden('FamilyPoll.beneficiary_id', array('label' => 'property_id', 'class' => '')); ?>
        <?php echo $this->Form->end(array('label'=> "Guardar" ,'class'=>'submit_button')) ?>
    </fieldset>
    <table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'FamilyPolls', 'action' => 'baseline_index',$beneficiary_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>