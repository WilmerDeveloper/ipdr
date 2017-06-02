<script>
    $(document).ready(function() {
        jQuery("#ideF").validate({
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
    <?php echo $this->Form->create("Execution", array("id" => "ideF", 'url' => array('controller' => 'executions', "action" => "edit", $this->data['Execution']['id'], $follow_id))); ?>
    <?php echo $this->Form->input('Execution.id', array('label' => 'id', 'class' => '')); ?>
    <?php echo $this->Form->hidden('Execution.visit_id', array('label' => 'id')); ?>
    <?php echo $this->Form->hidden('Execution.acumulado'); ?>
    <table border="0">
        <tbody>
            <tr >
                <td colspan="2"> 
                    <h1>Acumulado a la fecha :<?php echo str_replace(".0000", "", $this->data['Execution']['acumulado']) ?></h1>
                </td>
            </tr>
            <tr>
                <td>Ejecutado:</td>
                <td><?php echo $this->Form->input('Execution.ejecutado', array('label' => '', 'class' => 'required', 'type' => 'number', 'div' => false)); ?></td>
            </tr>
        </tbody>
    </table>
    <?php echo $this->Form->end(array('label' => "Guardar", 'class' => 'submit_button')) ?>
</div>
<br>
<table style="width: 400px" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>  
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Executions', 'action' => 'index', $follow_id, $this->data['Execution']['visit_id']), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
<br>