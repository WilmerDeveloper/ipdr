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
            <th><?php echo $this->Paginator->sort('Coverage.cobertura', 'Cobertura'); ?></th>
            <th><?php echo $this->Paginator->sort('Coverage.area', 'Área'); ?></th>
            <th><?php echo $this->Paginator->sort('Coverage.porcentaje', 'Porcentaje'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Coverages as $Coverage): ?>
            <tr>
                <td><?php echo $Coverage['Coverage']['cobertura']; ?></td>
                <td>
                    <?php
                    $suma_area = $suma_area + $Coverage['Coverage']['area'];
                    echo $Coverage['Coverage']['area'];
                    ?>
                </td>
                <td>
                    <?php
                    $suma_porc = $suma_porc + $Coverage['Coverage']['porcentaje'];
                    echo $Coverage['Coverage']['porcentaje'];
                    ?>
                </td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Coverages', 'action' => 'edit', $Coverage["Coverage"]["id"]), array('update' => 'cobertura', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Coverages', 'action' => 'delete', $Coverage["Coverage"]["id"], $property_id), array('update' => 'cobertura', 'indicator' => 'loading'), '¿Realmente desea borrar el registro?'); ?></td>
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
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Coverages', 'action' => 'add', $property_id), array('update' => 'cobertura', 'indicator' => 'loading')); ?>