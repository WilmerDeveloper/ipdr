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

echo $this->Form->create('FinalReport', array('class' => 'form_validate', 'enctype' => 'multipart/form-data', 'type' => 'file', "action" => "edit/" . $this->data['FinalReport']['id'])); 
?>

<fieldset>
    <?php echo $this->Form->hidden('FinalReport.id'); ?>
    <?php echo $this->Form->hidden('FinalReport.proyect_id'); ?>
    <?php echo $this->Form->input('FinalReport.ubicacion', array('label' => 'UBICACIÓN DEL PROYECTO OBSERVACIONES', 'class' => 'txtarea')); ?>
    <?php echo $this->Form->input('FinalReport.financiera', array('label' => 'PLAN DE INVERSIÓN INICIAL OBSERVACIONES', 'class' => 'txtarea')); ?>
    <?php echo $this->Form->input('FinalReport.control_saldo', array('label' => 'OBSERVACIONES DE LA EJECUCIÓN FINANCIERA', 'class' => 'txtarea')); ?>
    <?php echo $this->Form->input('FinalReport.tecnica', array('label' => 'DESCRIPCIÓN TÉCNICA DEL ESTADO DEL PROYECTO', 'class' => 'txtarea')); ?>
    <?php echo $this->Form->input('FinalReport.cumplimiento_obligaciones', array('label' => 'CUMPLIMIENTO DE OBLIGACIONES POR PARTE DE LOS BENEFICIARIOS', 'class' => 'txtarea')); ?>
    <?php echo $this->Form->input('FinalReport.inconvenientes', array('label' => 'INCONVENIENTES PRESENTADOS Y/O PROCESOS DESARROLLADOS POR INCUMPLIMIENTO DE OBLIGACIONES', 'class' => 'txtarea')); ?>
    <?php echo $this->Form->input('FinalReport.generales', array('label' => 'OBSERVACIONES GENERALES Y RECOMENDACIONES', 'class' => 'txtarea')); ?>
    <hr>
    <?php echo $this->Form->input('FinalReport.deposito_inicial', array('label' => 'DEPOSITO INICIAL')); ?>
    <?php echo $this->Form->input('FinalReport.otros_depositos', array('label' => 'OTROS DEPOSITOS')); ?>
    <?php echo $this->Form->input('FinalReport.intereses_ganados', array('label' => 'INTERESES GANADOS')); ?>
    <?php echo $this->Form->input('FinalReport.costos_financieros', array('label' => 'COSTOS FINANCIEROS')); ?>
    <?php echo $this->Form->input('FinalReport.fecha_cierre', array('label' => 'Fecha de cierre de la cuenta de manejo controlado', 'class' => 'calendario1', 'type' => 'required', 'type' => 'text', 'required' => 'required')); ?>
    <hr>
    <?php echo $this->Form->input('FinalReport.nombre_representante', array('label' => 'NOMBRE REPRESENTANTE')); ?>
    <?php echo $this->Form->input('FinalReport.direccion_representante', array('label' => 'DIRECCIÓN REPRESENTANTE')); ?>
    <?php echo $this->Form->input('FinalReport.telefono_contacto', array('label' => 'TELÉFONO REPRESENTANTE')); ?>
    <?php echo $this->Form->input('FinalReport.tipo_proyecto', array('label' => 'TIPO PROYECTO', 'options'=>array('empty'=>'Seleccione un tipo','Agrícola'=>'Agrícola', 'Pecuario'=>'Pecuario', 'Agropecuario'=>'Agropecuario', 'Forestal'=>'Forestal', 'Pesca'=>'Pesca'))); ?>
    <?php echo $this->Form->input('FinalReport.fecha_expedicion', array('label' => 'Fecha de expedición del documento', 'class' => 'calendario1', 'type' => 'required', 'type' => 'text')); ?>
    <hr>
    <?php echo 'Archivo formato F21-GI-IPDR '. $this->Form->file("FinalReport.archivo_formato", array('accept' => 'pdf')); ?>
    <br>
    <?php echo 'Archivo certificado cierre de cuenta' . $this->Form->file("FinalReport.archivo_cierre_cuenta", array('accept' => 'pdf')); ?>
    <?php echo $this->Form->end(array('label' => 'Guardar', 'class' => 'submit_button')) ?>
</fieldset>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>   
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'FinalReports', 'action' => 'index', ), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>