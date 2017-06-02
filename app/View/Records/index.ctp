<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<form style="clear: both" >
    <table border="0" cellspacing="0" cellpaddding="0" style="width: 200px;height: 20px; padding: 0px 0px 0px 0px">
        <tr>
            <td >Id del módelo</td>
            <td >Módelo</td>
            <td ></td>
        </tr>
        <tr>
            <td ><input type="text"  name="data[Record][busqueda]" style="width: 130px" ></td>
            <td ><?php echo $this->Form->input('Record.objeto', array('options' => $objetos,'div'=>false,'label'=>false)); ?></td>
            <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Records', 'action' => 'index'), 'update' => 'content', 'indicator' => 'loading')); ?></td>
        </tr>
    </table>
</form>

<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('User.username', 'Usuario'); ?></th>
            <th><?php echo $this->Paginator->sort('User.nombre', 'Nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('Record.created', 'Fecha'); ?></th>
            <th><?php echo $this->Paginator->sort('Record.model', 'Modelo'); ?></th>
            <th><?php echo $this->Paginator->sort('Record.action', 'Acción'); ?></th>
            <th><?php echo $this->Paginator->sort('Record.change', 'Cambio'); ?></th>
            <th colspan="2">

            </th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($Records as $Record): ?>
            <tr>
                <td><?php echo $Record['User']['username']; ?></td>
                <td><?php echo $Record['User']['nombre'] . " " . $Record['User']['primer_apellido']; ?></td>
                <td><?php echo $Record['Record']['created']; ?></td>
                <td><?php echo $Record['Record']['model']; ?></td>
                <td><?php echo $Record['Record']['action']; ?></td>
                <td><?php echo $Record['Record']['change']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
