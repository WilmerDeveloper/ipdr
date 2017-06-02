<?php echo $this->Form->create("Budget", array("class" => "form",'url'=>array( "action" => "edit_comite",$this->data['Budget']['id']))); ?>
<fieldset>
    <?php echo $this->Form->input('Budget.id'); ?>
    <?php echo $this->Form->hidden('Budget.follow_id'); ?>
    <?php echo $this->Form->hidden('Budget.valor_maximo',array( 'value'=> ($this->data['Budget']['valor_unitario']*$this->data['Budget']['cantidad']) )); ?>
  
    
    <table border="1">
       
        <tbody>
            <tr>
                <td colspan="2"><?php echo $this->Form->input('Budget.monitoring_activity_id', array('label'=>'rubro', 'empty'=>'','disabled'=>1, 'class' => '')); ?>
</td>
            </tr>
            <tr>
            <tr>
                <td><?php echo $this->Form->input('Budget.fecha_comite1', array('label' => 'Fecha primer comité', 'class' => 'calendario','type'=>'text')); ?></td>
                <td><?php echo $this->Form->input('Budget.valor_comite1', array('label' => 'Valor primer comité')); ?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('Budget.fecha_comite2', array('label' => 'Fecha segundo comité', 'class' => 'calendario','type'=>'text')); ?></td>
                <td><?php echo $this->Form->input('Budget.valor_comite2', array('label' => 'Valor segundo comité')); ?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('Budget.fecha_comite3', array('label' => 'Fecha tercer comité', 'class' => 'calendario','type'=>'text')); ?></td>
                <td><?php echo $this->Form->input('Budget.valor_comite3', array('label' => 'Valor tercer comité')); ?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('Budget.fecha_comite4', array('label' => 'Fecha cuarto comité', 'class' => 'calendario','type'=>'text')); ?></td>
                <td><?php echo $this->Form->input('Budget.valor_comite4', array('label' => 'Valor cuarto comité')); ?></td>
            </tr>
            
        </tbody>
    </table>

       <?php echo $this->Form->end("Guardar") ?>
</fieldset>