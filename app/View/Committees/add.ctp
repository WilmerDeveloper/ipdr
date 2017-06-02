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
<?php echo $this->Form->create("Committee", array("class" => "validacion", 'url' => array("action" => "add", $proyect_id))); ?>
<?php echo $this->Form->input('Committee.fecha', array('label' => 'fecha', 'class' => 'calendario1', 'type' => 'text', 'required' => 'required')); ?>
<?php echo $this->Form->hidden('Committee.proyect_id', array('value' => $proyect_id)); ?>
<?php echo $this->Form->hidden('Committee.id'); ?>
<?php echo $this->Form->input('Committee.observacion', array('label' => 'Comentario', 'class' => 'txtarea')); ?>
<?php echo $this->Form->input('Committee.valor', array('label' => 'Valor ejecutado')); ?>
<br><br>
<?php echo $this->Form->end("Guardar") ?>
<br>
<br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Committees', 'action' => 'index', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
<br>