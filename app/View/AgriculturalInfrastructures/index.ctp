<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    $total = 0;
    ?>
</div>
<table border="1">
    <thead>
        <tr>
            <th colspan="4">Infraestructura</th>
        </tr>
        <tr>
            <th>Tipo de instalación</th>
            <th>Área (m2)</th>
            <th></th>
            <th></th>
        </tr>
        <?php foreach ($AgriculturalInfrastructures as $AgriculturalInfrastructure): ?>
            <tr>
                <td><?php echo $AgriculturalInfrastructure['AgriculturalInfrastructure']['tipo']; ?></td>
                <td><?php echo $AgriculturalInfrastructure['AgriculturalInfrastructure']['area'];
        $total+=$AgriculturalInfrastructure['AgriculturalInfrastructure']['area']; ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'AgriculturalInfrastructures', 'action' => 'edit', $AgriculturalInfrastructure["AgriculturalInfrastructure"]["id"]), array('update' => 'infrastructura', 'class' => 'acciones', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'AgriculturalInfrastructures', 'action' => 'delete', $AgriculturalInfrastructure["AgriculturalInfrastructure"]["id"],$property_id), array('update' => 'infrastructura', 'class' => 'acciones', 'indicator' => 'loading'),'¿Desea eliminar el registro?'); ?></td>
            </tr>
<?php endforeach; ?>
        <tr>
            <th>Área Total Agrícola y Pecuaria</th>
            <th><?php echo $total?></th>
            <th></th>
            <th></th>
        </tr>
        </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php  echo $this->Ajax->link('Adicionar', array('controller' => 'AgriculturalInfrastructures', 'action' => 'add', $property_id), array('update' => 'infrastructura', 'class' => 'acciones', 'indicator' => 'loading')); ?>
