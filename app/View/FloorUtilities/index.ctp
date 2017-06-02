<div class="paging">

    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    $suma_agricultura = 0;
    $suma_pecuaria = 0;
    $suma_forestal_productiva = 0;
    $suma_otros_usos = 0;
    $suma_area_no_explotada = 0;
    $suma_forestal_protectora = 0;
    $suma_no_productiva = 0;
    ?>

</div>

<table>
    <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('FloorUtility.clase', 'Clase Agrológica'); ?></th>
            <th><?php echo $this->Paginator->sort('FloorUtility.agricultura', 'Agricultura (%)'); ?></th>
            <th><?php echo $this->Paginator->sort('FloorUtility.pecuaria', 'Pecuaria (%)'); ?></th>
            <th><?php echo $this->Paginator->sort('FloorUtility.forestal_productiva', 'Forestal Productiva (%)'); ?></th>
            <th><?php echo $this->Paginator->sort('FloorUtility.otros_usos', 'Otros usos agroeconómicos (%)'); ?></th>
            <th><?php echo $this->Paginator->sort('FloorUtility.area_no_explotada', 'Área no explotada (%)'); ?></th>
            <th><?php echo $this->Paginator->sort('FloorUtility.forestal_protectora', 'Forestal Protectora (%)'); ?></th>
            <th><?php echo $this->Paginator->sort('FloorUtility.no_productiva', 'No Productiva (%)'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($FloorUtilities as $FloorUtility): ?>
            <tr>
                <td><?php echo $FloorUtility['FloorUtility']['clase']; ?></td>
                <td>
                    <?php
                    $suma_agricultura = $suma_agricultura + $FloorUtility['FloorUtility']['agricultura'];
                    echo $FloorUtility['FloorUtility']['agricultura'];
                    ?>
                </td>
                <td>
                    <?php
                    $suma_pecuaria = $suma_pecuaria + $FloorUtility['FloorUtility']['pecuaria'];
                    echo $FloorUtility['FloorUtility']['pecuaria'];
                    ?>
                </td>
                <td>
                    <?php
                    $suma_forestal_productiva = $suma_forestal_productiva + $FloorUtility['FloorUtility']['forestal_productiva'];
                    echo $FloorUtility['FloorUtility']['forestal_productiva'];
                    ?>
                </td>
                <td>
                    <?php
                    $suma_otros_usos = $suma_otros_usos + $FloorUtility['FloorUtility']['otros_usos'];
                    echo $FloorUtility['FloorUtility']['otros_usos'];
                    ?>
                </td>
                <td>
                    <?php
                    $suma_area_no_explotada = $suma_area_no_explotada + $FloorUtility['FloorUtility']['area_no_explotada'];
                    echo $FloorUtility['FloorUtility']['area_no_explotada'];
                    ?>
                </td>
                <td>
                    <?php
                    $suma_forestal_protectora = $suma_forestal_protectora + $FloorUtility['FloorUtility']['forestal_protectora'];
                    echo $FloorUtility['FloorUtility']['forestal_protectora'];
                    ?>
                </td>
                <td>
                    <?php
                    $suma_no_productiva = $suma_no_productiva + $FloorUtility['FloorUtility']['no_productiva'];
                    echo $FloorUtility['FloorUtility']['no_productiva'];
                    ?>
                </td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'FloorUtilities', 'action' => 'edit', $FloorUtility["FloorUtility"]["id"]), array('update' => 'actual', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'FloorUtilities', 'action' => 'delete', $FloorUtility["FloorUtility"]["id"], $property_id), array('update' => 'actual', 'indicator' => 'loading'),'¿Realmente desea borrar el registro?'); ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td><?php echo 'Total: '; ?></td>
            <td>
                <?php
                echo $suma_agricultura;
                ?>
            </td>
            <td>
                <?php
                echo $suma_pecuaria;
                ?>
            </td>
            <td>
                <?php
                echo $suma_forestal_productiva;
                ?>
            </td>
            <td>
                <?php
                echo $suma_otros_usos;
                ?>
            </td>
            <td>
                <?php
                echo $suma_area_no_explotada;
                ?>
            </td>
            <td>
                <?php
                echo $suma_forestal_protectora;
                ?>
            </td>
            <td>
                <?php
                echo $suma_no_productiva;
                ?>
            </td>
        </tr>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'FloorUtilities', 'action' => 'add', $property_id), array('update' => 'actual', 'indicator' => 'loading')); ?>
