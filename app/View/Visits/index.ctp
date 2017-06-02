<h2>Listado de visitas</h2>
<div class="paging">
    <?php
    $rutaArchivo = "files" . "/InformesVisita";
    $cont = 1;
    ?>
</div>
<table id="tabla">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Visits as $Visit): ?>
            <tr>
                <td><?php
        echo $cont;
        $cont++
            ?></td>
                <td><?php echo $Visit['Visit']['fecha']; ?></td>
                <td><?php echo $this->Ajax->link('Editar encuesta', array('controller' => 'Visits', 'action' => 'edit', $Visit["Visit"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td><?php
                $rutaDocumento = APP . "webroot" . "/" . "files" . "/InformesVisita/InformeVisita-".$Visit['Visit']['id'];
                if (file_exists( $rutaDocumento. ".pdf")):
                    ?>
                <a href="<?php echo $rutaArchivo . "/" . "InformeVisita-".$Visit['Visit']['id'].".pdf" ?>" target="blank" class="acciones" >Informe_visita</a>
                <?php else: echo "Falta informe visita" ?> 
                <?php endif; ?></td>
                <td><?php echo $this->Ajax->link('Productos', array('controller' => 'Products', 'action' => 'index', $Visit["Visit"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Fotografías', array('controller' => 'Photographies', 'action' => 'index', $Visit["Visit"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Visits', 'action' => 'delete', $Visit["Visit"]["id"], $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Desea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br>
<table style="width: 400px" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>  
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Proyects', 'action' => 'seguimiento'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            <td><?php echo $this->Ajax->link('Adicionar_visita', array('controller' => 'Visits', 'action' => 'add', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
        </tr>
    </tbody>
</table>