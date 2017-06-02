<h1>Listado de comités de compras </h1>
<div class="paging">
    <?php
    $rutaArchivoSoportes = "files" . "/SoportesComites";
    $rutaArchivoCotizaciones = "files" . "/Cotizaciones";
    $rutaArchivoFacturas = "files" . "/Facturas";
    $cont = 1;
    ?>
</div>
<table id="tabla">
    <thead>
        <tr>
            <th>No.</th>
            <th>Valor</th>
            <th colspan="6"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Committees as $Committee): ?>
        <tr>
            <td><?php echo $cont;
        $cont++
            ?></td>
            <td><?php echo '$ '. number_format($Committee['Committee']['valor'] ,0 , ',', '.'); ?></td>
            <td><?php
                $rutaDocumento = APP . "webroot" . "/" . "files" . "/SoportesComites/SoporteComite-".$Committee['Committee']['id'];
                if (file_exists( $rutaDocumento. ".pdf")):
                    ?>
                <a href="<?php echo $rutaArchivoSoportes . "/" . "SoporteComite-".$Committee['Committee']['id'].".pdf" ?>" target="blank" class="acciones" >Soportes</a>
                <?php else: echo "Falta F9 y acta" ?> 
                <?php endif; ?></td>
            <td><?php
                $rutaDocumento = APP . "webroot" . "/" . "files" . "/Cotizaciones/Cotizacion-".$Committee['Committee']['id'];
                if (file_exists( $rutaDocumento. ".pdf")):
                    ?>
                <a href="<?php echo $rutaArchivoCotizaciones . "/" . "Cotizacion-".$Committee['Committee']['id'].".pdf" ?>" target="blank" class="acciones" >Cotizaciones</a>
                <?php else: echo "Falta cotizaciones" ?> 
                <?php endif; ?></td>


            <td><?php
                $rutaDocumento = APP . "webroot" . "/" . "files" . "/Facturas/Factura-".$Committee['Committee']['id'];
                if (file_exists( $rutaDocumento. ".pdf")):
                    ?>
                <a href="<?php echo $rutaArchivoFacturas . "/" . "Factura-".$Committee['Committee']['id'].".pdf" ?>" target="blank" class="acciones" >Facturas</a>
                <?php else: echo "Falta facturas" ?> 
                <?php endif; ?></td>

            <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Committees', 'action' => 'edit', $Committee["Committee"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => 'cargar()')); ?><br></td>
            <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Committees', 'action' => 'delete', $Committee["Committee"]["id"], $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Desea eliminar el registro?'); ?><br></td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>

<br>
<table style="width: 400px" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>  
            <td><br><br><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Proyects', 'action' => 'seguimiento'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?><br></td>
            <td><br><br><?php echo $this->Ajax->link('Adicionar comité', array('controller' => 'Committees', 'action' => 'add', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => 'cargar()')); ?><br></td>
        </tr>
    </tbody>
</table>
<br>