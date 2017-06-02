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
$rutaArchivoSoportes = "files" . "/SoportesComites";
$rutaArchivoCotizaciones = "files" . "/Cotizaciones";
$rutaArchivoFacturas = "files" . "/Facturas";
    
echo $this->Form->create('Committee', array('class' => 'form_validate', 'enctype' => 'multipart/form-data', 'type' => 'file', "action" => "edit/" . $this->data['Committee']['id'])); ?>


<?php echo $this->Form->input('Committee.fecha', array('label' => 'fecha', 'class' => 'calendario1', 'type' => 'required', 'type' => 'text', 'required' => 'required')); ?>
<?php echo $this->Form->hidden('Committee.id'); ?>
<?php echo $this->Form->hidden('Committee.proyect_id'); ?>
<?php echo $this->Form->input('Committee.observacion', array('label' => 'Comentario','class' => 'txtarea')); ?>
<?php echo $this->Form->input('Committee.valor', array('label' => 'Valor ejecutado')); ?>
<br><br>

<table id="tabla">
    <thead>
        <tr>
            <th>Tipo de archivo</th>
            <th></th>
            <th>Descargar</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Archivos soporte</td>
            <td><?php echo $this->Form->file("Committee.archivo_soporte", array('accept' => 'pdf')); ?></td>
            <td><?php
    $rutaDocumento = APP . "webroot" . "/" . "files" . "/SoportesComites/SoporteComite-".$this->data['Committee']['id'];
    if (file_exists( $rutaDocumento. ".pdf")):
    ?>
    <a href="<?php echo $rutaArchivoSoportes . "/" . "SoporteComite-".$this->data['Committee']['id'].".pdf" ?>" target="blank" class="actions" >Soportes</a>
    <?php else: echo "Falta F9 y acta" ?> 
    <?php endif; ?></td>
        </tr>
        <tr>
            <td>Cotizaciones</td>
            <td><?php echo $this->Form->file("Committee.archivo_cotizaciones", array('accept' => 'pdf')); ?></td>
            <td><?php
                $rutaDocumento = APP . "webroot" . "/" . "files" . "/Cotizaciones/Cotizacion-".$this->data['Committee']['id'];
                if (file_exists( $rutaDocumento. ".pdf")):
                    ?>
                <a href="<?php echo $rutaArchivoCotizaciones . "/" . "Cotizacion-".$this->data['Committee']['id'].".pdf" ?>" target="blank" class="actions" >Cotizaciones</a>
                <?php else: echo "Falta cotizaciones" ?> 
                <?php endif; ?></td>
        </tr>
        <tr>
            <td>Facturas</td>
            <td><?php echo $this->Form->file("Committee.archivo_facturas", array('accept' => 'pdf')); ?></td>
            <td><?php
                $rutaDocumento = APP . "webroot" . "/" . "files" . "/Facturas/Factura-".$this->data['Committee']['id'];
                if (file_exists( $rutaDocumento. ".pdf")):
                    ?>
                <a href="<?php echo $rutaArchivoFacturas . "/" . "Factura-".$this->data['Committee']['id'].".pdf" ?>" target="blank" class="actions" >Facturas</a>
                <?php else: echo "Falta facturas" ?> 
                <?php endif; ?></td>
        </tr>
    </tbody>
</table>

<br><br>
<?php echo $this->Form->end(array('label' => 'Guardar', 'class' => 'submit_button')) ?>

<br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Committees', 'action' => 'index', $this->data['Committee']['proyect_id']), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>
<br>