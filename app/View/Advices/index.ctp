<h2>Listado de acompañamientos</h2>
<div class="paging">
    <?php
    $rutaArchivo = "files" . "/Acompanamientos";
    $cont = 1;
    ?>
</div>
<table id="tabla">
    <thead>
        <tr>
            <th>No.</th>
            <th>Fecha</th>
            <th>Soporte</th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Advices as $Advice): ?>
            <tr>
                <td><?php
        echo $cont;
        $cont++
            ?></td>
                <td><?php echo $Advice['Advice']['fecha']; ?></td>
                <td><?php echo $this->Ajax->link('Modificar', array('controller' => 'Advices', 'action' => 'edit', $Advice["Advice"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td><?php
                $rutaDocumento = APP . "webroot" . "/" . "files" . "/Acompanamientos/Acompanamiento-".$Advice['Advice']['id'];
                if (file_exists( $rutaDocumento. ".pdf")):
                    ?>
                <a href="<?php echo $rutaArchivo . "/" . "Acompanamiento-".$Advice['Advice']['id'].".pdf" ?>" target="blank" class="acciones" >Soporte</a>
                <?php else: echo "Soporte acompañamiento" ?> 
                <?php endif; ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Advices', 'action' => 'delete', $Advice["Advice"]["id"], $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'), '¿Desea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br>
<table style="width: 400px" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>  
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Proyects', 'action' => 'seguimiento'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            <td><?php echo $this->Ajax->link('Adicionar_acompañamiento', array('controller' => 'Advices', 'action' => 'add', $proyect_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
        </tr>
    </tbody>
</table>