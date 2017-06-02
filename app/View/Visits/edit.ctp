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

echo $this->Form->create('Visit', array('class' => 'form_validate', 'enctype' => 'multipart/form-data', 'type' => 'file', "action" => "edit/" . $this->data['Visit']['id'])); ?>

<fieldset>
    <?php echo $this->Form->input('Visit.fecha', array('label' => 'fecha', 'class' => 'calendario1', 'type' => 'required', 'type' => 'text', 'required' => 'required')); ?>
    <?php echo $this->Form->input('Visit.observacion', array('label' => 'Observaciones generales del proyecto', 'class' => 'txtarea')); ?><br>
    <?php echo $this->Form->input('Visit.problemas_ambientales', array('label' => 'Problemas ambientales', 'class' => 'txtarea')); ?><br>
    <?php echo $this->Form->input('Visit.problemas_juridicos', array('label' => 'Problemas jurídicos', 'class' => 'txtarea')); ?><br>
    <?php echo $this->Form->input('Visit.problemas_sociales', array('label' => 'Problemas sociales', 'class' => 'txtarea')); ?><br>
    <?php echo $this->Form->input('Visit.problemas_comercializacion', array('label' => 'Problemas comercialización', 'class' => 'txtarea')); ?><br>
    <?php echo $this->Form->input('Visit.recomendaciones', array('label' => 'Recomendaciones generales del proyecto', 'class' => 'txtarea')); ?><br>
    <?php echo $this->Form->input('Visit.porcentaje_ejecucion', array('label' => 'Porcentaje ejecución', 'class' => 'required number', 'min' => 0, 'max' => 100)); ?><br>
    <?php echo $this->Form->hidden('Visit.id'); ?>
    <?php echo $this->Form->hidden('Visit.proyect_id'); ?>
    <br><br>
    <?php echo $this->Form->file("Visit.archivo", array('accept' => 'pdf')); ?>
    <br><br>
    <?php echo $this->Form->end("Guardar") ?>
</fieldset>
<br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Visits', 'action' => 'index', $this->data['Visit']['proyect_id']), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>