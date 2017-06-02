<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#control', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('PropertyControl.formulario', 'Formulario'); ?></th>
            <th><?php echo $this->Paginator->sort('PropertyControl.nombre_aliado', '1.1 Nombre del Aliado estratégico:'); ?></th>
            <th><?php echo $this->Paginator->sort('PropertyControl.numero_visitas', '1.5 Número de visitas'); ?></th>
            <th><?php echo $this->Paginator->sort('PropertyControl.nombre_encuestador', '1.2 Nombre del encuestador:'); ?></th>
            <th><?php echo $this->Paginator->sort('PropertyControl.documento_encuestador', '1.3 Documento de Identidad:'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($PropertyControls as $PropertyControl): ?>
            <tr>
                <td><?php echo $PropertyControl['PropertyControl']['formulario']; ?></td>
                <td><?php echo $PropertyControl['PropertyControl']['nombre_aliado']; ?></td>
                <td><?php echo $PropertyControl['PropertyControl']['numero_visitas']; ?></td>
                <td><?php echo $PropertyControl['PropertyControl']['nombre_encuestador']; ?></td>
                <td><?php echo $PropertyControl['PropertyControl']['documento_encuestador']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'PropertyControls', 'action' => 'edit', $PropertyControl["PropertyControl"]["id"]), array('update' => 'control', 'indicator' => 'loading')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>

<?php
if (empty($PropertyControls))
    echo $this->Ajax->link('Adicionar', array('controller' => 'PropertyControls', 'action' => 'add', $property_id), array('update' => 'control', 'indicator' => 'loading'));
?>
