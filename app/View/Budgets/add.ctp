<script>


    $(document).ready(function() {
        
        
        jQuery("#budget_add").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }
        });  }
        
)
        
</script>
<?php echo $this->Form->create("Budget", array("id" => "budget_add", "class" => "validacion", 'url' => array("action" => "add", $follow_id))); ?>
<fieldset>
    <?php echo $this->Form->input('Budget.monitoring_activity_id', array('label' => 'rubro', 'empty' => '')); ?>
    <?php echo $this->Form->input('Budget.cantidad', array('label' => 'Cantidad', 'class' => 'required')); ?>
    <?php echo $this->Form->hidden('Budget.follow_id', array('value' => $follow_id)); ?>
    <?php echo $this->Form->input('Budget.valor_unitario', array('label' => 'VALOR UNITARIO EN PESOS', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Budget.cofinanciacion_incoder', array('label' => 'VLR COFINANCIACIÓN INCODER', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Budget.cofinaciacion_comunidad', array('label' => 'VALOR COFINANCIACIÓN COMUNIDAD', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Budget.contapartida_certificada', array('label' => 'VALOR COFINANCIACIÓN CONTRAPARTIDA CERTIFICADA', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Budget.otra_contrapartida', array('label' => 'VALOR COFINANCIACIÓN OTRAS CONTRAPARTIDAS.', 'class' => 'required')); ?>
    <?php echo $this->Form->input('Budget.observaciones', array('label' => 'Observaciones')); ?>

    <?php echo $this->Form->end("Guardar") ?>
</fieldset>

<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Budgets', 'action' => 'index', $follow_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>