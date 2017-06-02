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
            <th><?php echo $this->Paginator->sort('PublicService.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('PublicService.name', 'Servicio'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($PublicServices as $PublicService): ?>
            <tr>
                <td><?php echo $PublicService['PublicService']['id']; ?></td>
                <td><?php echo $PublicService['PublicService']['name']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'PublicServices', 'action' => 'edit', $PublicService["PublicService"]["id"]), array('update' => 'homes', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'PublicServices', 'action' => 'delete', $PublicService["PublicService"]["id"],$home_id), array('update' => 'homes', 'indicator' => 'loading'),'¿Ralmente desea borrar el registro?'); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'PublicServices', 'action' => 'add',$home_id), array('update' => 'homes', 'indicator' => 'loading')); ?>
