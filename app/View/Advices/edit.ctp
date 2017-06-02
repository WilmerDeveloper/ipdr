<script>

    $(".form_validate").validate();

</script>
<script>

    $(document).ready(function () {
        $(".calendario1").datepicker({
            showOn: 'both',
            dateFormat: 'yy-mm-dd',
            maxDate: '<?php echo date('Y-m-d') ?>',
            buttonImage: './img/calendar.jpg',
            buttonImageOnly: true,
            changeYear: true,
            numberOfMonths: 1

        });
    }

    )
</script> 
<?php

echo $this->Form->create('Advice', array('class' => 'form_validate', 'enctype' => 'multipart/form-data', 'type' => 'file', "action" => "edit/" . $this->data['Advice']['id'])); ?>

<fieldset>
    <?php echo $this->Form->hidden('Advice.id'); ?>
    <?php echo $this->Form->hidden('Advice.proyect_id'); ?>
    <?php echo $this->Form->input('Advice.fecha', array('label' => 'fecha', 'class' => 'calendario1', 'type' => 'required', 'type' => 'text', 'required' => 'required')); ?>
    <?php echo $this->Form->input('Advice.observaciones', array('label' => 'Observaciones', 'class' => 'txtarea')); ?><br>
    <br><br>
    <?php echo $this->Form->file("Advice.archivo", array('accept' => 'pdf')); ?>
    <br><br>
    <?php echo $this->Form->end("Guardar") ?>
</fieldset>
<br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Advices', 'action' => 'index', $this->data['Advice']['proyect_id']), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>