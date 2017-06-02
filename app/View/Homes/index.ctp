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
            <th><?php echo $this->Paginator->sort('Home.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Home.tenencia', 'Tenencia'); ?></th>
            <th><?php echo $this->Paginator->sort('Home.tipo', 'Tipo'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Homes as $Home): ?>
            <tr>
                <td><?php echo $Home['Home']['id']; ?></td>
                <td><?php echo $Home['Home']['tenencia']; ?></td>
                <td><?php echo $Home['Home']['tipo']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Homes', 'action' => 'edit', $Home["Home"]["id"]), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Homes', 'action' => 'delete', $Home["Home"]["id"], $beneficiary_id), array('update' => 'content', 'indicator' => 'loading'), '¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>

<?php
if (empty($Homes))
    echo $this->Ajax->link('Adicionar', array('controller' => 'Homes', 'action' => 'add', $beneficiary_id), array('update' => 'content', 'indicator' => 'loading'), '¿Realmente desea crear el registro?');
?>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Beneficiaries', 'action' => 'poll_index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>