<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table id="tabla">
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Nombre', 'Linea productiva'); ?></th>
            <th><?php echo $this->Paginator->sort('Cantidad', 'Cantidad programada'); ?></th>
            <th><?php echo $this->Paginator->sort('Cantidad real', 'Cantidad real'); ?></th>
            <th colspan="2"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($FollowProducts as $FollowProduct): ?>
            <tr>
                <td><?php echo $FollowProduct['ProductiveActivity']['nombre']; ?></td>
                <td><?php echo $FollowProduct['FollowProduct']['cantidad']; ?></td>
                <td><?php echo $FollowProduct['FollowProduct']['cantidad_real']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'FollowProducts', 'action' => 'edit', $FollowProduct["FollowProduct"]["id"]), array('class' => 'acciones', 'update' => 'content')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'FollowProducts', 'action' => 'delete', $FollowProduct["FollowProduct"]["id"], $proyect_id2), array('class' => 'acciones', 'update' => 'content'), '¿Desea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<br><br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>   
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Proyects', 'action' => 'seguimiento'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            <td><?php echo $this->Ajax->link('Adicionar', array('controller' => 'FollowProducts', 'action' => 'add', $proyect_id2), array('class' => 'acciones', 'update' => 'content')); ?></td>
        </tr>
    </tbody>
</table>
<br/>
<br/>