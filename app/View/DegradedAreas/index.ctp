<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    $suma_area = 0;
    $suma_porc = 0;
    ?>
</div>
<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('DegradedArea.causa', 'Causa de degradación'); ?></th>
            <th><?php echo $this->Paginator->sort('DegradedArea.area', 'Área'); ?></th>
            <th><?php echo $this->Paginator->sort('DegradedArea.porcentaje', 'Porcentaje'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($DegradedAreas as $DegradedArea): ?>
            <tr>
                <td><?php echo $DegradedArea['DegradedArea']['causa']; ?></td>
                <td>
                    <?php
                    $suma_area = $suma_area + $DegradedArea['DegradedArea']['area'];
                    echo $DegradedArea['DegradedArea']['area'];
                    ?>
                </td>
                <td>
                    <?php
                    $suma_porc = $suma_porc + $DegradedArea['DegradedArea']['porcentaje'];
                    echo $DegradedArea['DegradedArea']['porcentaje'];
                    ?>
                </td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'DegradedAreas', 'action' => 'edit', $DegradedArea["DegradedArea"]["id"]), array('update' => 'area', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'DegradedAreas', 'action' => 'delete', $DegradedArea["DegradedArea"]["id"], $property_id), array('update' => 'area', 'indicator' => 'loading'), '¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td><?php echo 'Total: '; ?></td>
            <td>
                <?php
                echo $suma_area;
                ?>
            </td>
            <td>
                <?php
                echo $suma_porc;
                ?>
            </td>
        </tr>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'DegradedAreas', 'action' => 'add', $property_id), array('update' => 'area', 'indicator' => 'loading')); ?>