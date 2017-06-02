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
            <th><?php echo $this->Paginator->sort('Property.id', 'Id'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.nombre', 'Predio'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.concepto_fase0', 'Concepto'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.calificacion_fase0', 'Calificación'); ?></th>
            <th colspan="4"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Properties as $Property): ?>
            <tr>
                <td><?php echo $Property['Property']['id']; ?></td>
                <td><?php echo $Property['Property']['nombre']; ?></td>
                <td><?php echo $Property['Property']['concepto_fase0']; ?></td>
                <td><?php echo $Property['Property']['calificacion_fase0']; ?></td>
                <td><?php
        if ($mostrar_calificacion == 1 and $Property['Property']['calificacion_fase0'] != 'Cumple')
            echo $this->Ajax->link('Editar', array('controller' => 'Properties', 'action' => 'edit_phase0', $Property["Property"]["id"]), array('update' => 'calificacion', 'indicator' => 'loading', 'complete' => 'formularioAjax()', 'class' => 'acciones'));
        else {
            if ($mostrar_calificacion == 0 and ($Property['Property']['calificacion_fase0'] == "" or $Property['Property']['calificacion_fase0'] == 0 or is_null($Property['Property']['calificacion_fase0'])))
                echo "<h1 style='color:red'>Faltan aspectos de  predios o de beneficiarios por evaluar</h1>";
        }
            ?>
                </td>

                <td><?php echo $this->Html->link('Listado', array('controller' => 'Properties', 'action' => 'print_list', $Property["Property"]["id"]), array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones')); ?></td>
                <td>
                    <?php
                    //echo $this->Ajax->link($this->Html->image('reload.jpg', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'phase0_calification_index', $Property["Property"]["id"], $mostrar_calificacion), array('update' => 'calificacion', 'indicator' => 'loading', 'escape' => false));
                    ?>
                </td>

                <td>
                    <?php
                    if (AuthComponent::user('group_id') == 1)
                        echo $this->Ajax->link('Abrir calificación', array('controller' => 'Properties', 'action' => 'open_phase0', $Property["Property"]["id"]), array('update' => 'calificacion', 'indicator' => 'loading', 'escape' => false));
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>