<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Proyect.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Proyect.codigo', 'Código'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.nombre', 'Predio'); ?></th>
            <th><?php echo $this->Paginator->sort('Call.nombre', 'Convocatoria'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Proyects as $Proyect): ?>
            <tr>
                <td><?php echo $Proyect['Proyect']['id']; ?></td>
                <td><?php echo $Proyect['Proyect']['codigo']; ?></td>
                <td><?php echo $Proyect['Property']['nombre']; ?></td>
                <td><?php echo $Proyect['Call']['nombre']; ?></td>
                <td>

                    <?php echo $this->Ajax->link('Editar', array('controller' => 'Proyects', 'action' => 'edit_proyect', $Proyect["Proyect"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()', 'class' => 'acciones')); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Proyects', 'action' => 'add_proyect'), array('update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()')); ?>
