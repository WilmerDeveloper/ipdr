<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#compromisos', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('Typology.observaciones', 'Descripción'); ?></th>
            <th><?php echo $this->Paginator->sort('Typology.ambiental', 'Ambiental'); ?></th>
            <th><?php echo $this->Paginator->sort('Typology.juridico', 'Juridico'); ?></th>
            <th><?php echo $this->Paginator->sort('Typology.social', 'Social'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Typologies as $Typology): ?>
            <tr>
                <td><?php echo $Typology['Typology']['observaciones']; ?></td>
                <td><?php echo $Typology['Typology']['ambiental'] ? "Si" : "No" ?></td>
                <td><?php echo $Typology['Typology']['juridico'] ? "Si" : "No" ?></td>
                <td><?php echo $Typology['Typology']['social'] ? "Si" : "No" ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Typologies', 'action' => 'edit', $Typology["Typology"]["id"]), array('update' => 'tipologias', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Typologies', 'action' => 'delete', $Typology["Typology"]["id"], $plot_poll_id), array('update' => 'tipologias', 'indicator' => 'loading', 'class' => 'acciones'), '¿Desea eliminar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php if (empty($Typologies)): ?>
    <?php echo $this->Ajax->link('Adicionar', array('controller' => 'Typologies', 'action' => 'add', $plot_poll_id), array('update' => 'tipologias', 'indicator' => 'loading', 'class' => 'acciones')); ?>
<?php endif; ?>