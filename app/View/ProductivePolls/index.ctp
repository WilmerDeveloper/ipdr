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
            <th><?php echo $this->Paginator->sort('ProductivePoll.dominio_parcela', 'Parcela'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductivePoll.volumen_cultivo_primario', 'Volumen cultivo primario'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductivePoll.concepto_cultivo_primario', 'Concepto cultivo primario'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductivePoll.volumen_cultivo_secundario', 'Volumen cultivo secundario'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductivePoll.concepto_cultivo_secundario', 'Concepto cultivo secundario'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductivePoll.asistencia_tecnica', 'Asistencia técnica'); ?></th>
            <th><?php echo $this->Paginator->sort('ProductivePoll.perdidas', 'Perdidas'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ProductivePolls as $ProductivePoll): ?>
            <tr>
                <td><?php echo $ProductivePoll['ProductivePoll']['dominio_parcela']; ?></td>
                <td><?php echo $ProductivePoll['ProductivePoll']['volumen_cultivo_primario']; ?></td>
                <td><?php echo $ProductivePoll['ProductivePoll']['concepto_cultivo_primario']; ?></td>
                <td><?php echo $ProductivePoll['ProductivePoll']['volumen_cultivo_secundario']; ?></td>
                <td><?php echo $ProductivePoll['ProductivePoll']['concepto_cultivo_secundario']; ?></td>
                <td><?php echo $ProductivePoll['ProductivePoll']['asistencia_tecnica']; ?></td>
                <td><?php echo $ProductivePoll['ProductivePoll']['perdidas']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'ProductivePolls', 'action' => 'edit', $ProductivePoll["ProductivePoll"]["id"]), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'ProductivePolls', 'action' => 'delete', $ProductivePoll["ProductivePoll"]["id"], $beneficiary_id), array('update' => 'content', 'indicator' => 'loading'),'¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>

<?php
if (empty($ProductivePolls))
    echo $this->Ajax->link('Adicionar', array('controller' => 'ProductivePolls', 'action' => 'add', $beneficiary_id), array('update' => 'content', 'indicator' => 'loading'), '¿Esta seguro de agregar un nuevo registro?');
?>
