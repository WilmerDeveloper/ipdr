<div>
    <div class="paging">
        <?php
        echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
        echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
    <table style="font-size: small">
        <thead>
            <tr>
                <th>Nombre cultivo</th>
                <th>Tipo</th>
                <th></th>
                <th></th>
                <th>Rendimiento</th>
                <th>Prácticas Cultivo</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($AgriculturalSystems as $AgriculturalSystem): ?>
            <tr  >
                    <td><?php echo $AgriculturalSystem['ProductiveActivity']['nombre']; ?></td>
                    <td><?php echo $AgriculturalSystem['AgriculturalSystem']['tipo']; ?></td>
                    <td>
                        Variedad:<?php echo $AgriculturalSystem['AgriculturalSystem']['variedad']; ?><br><br>
                        Extensión (ha):<?php echo $AgriculturalSystem['AgriculturalSystem']['extension']; ?><br><br>
                        Densidad de siembra (N° plantas/ha):<?php echo $AgriculturalSystem['AgriculturalSystem']['densidad']; ?><br><br>
                    </td>
                    <td>
                        Distancia Surcos (m):<?php echo $AgriculturalSystem['AgriculturalSystem']['distancia_surcos']; ?><br><br>
                        Distancia Plantas (m):<?php echo $AgriculturalSystem['AgriculturalSystem']['distancia_plantas']; ?><br><br>
                        Edad cultivo (meses/años):<?php echo $AgriculturalSystem['AgriculturalSystem']['edad_cultivo']; ?><br><br>
                        Estado fitosanitario:<?php echo $AgriculturalSystem['AgriculturalSystem']['estado']; ?><br><br>
                    </td>
                    <td>
                        Producción(kg):<?php echo $AgriculturalSystem['AgriculturalSystem']['produccion']; ?><br><br>
                        autoconsumo (kg):<?php echo $AgriculturalSystem['AgriculturalSystem']['autoconsumo']; ?><br><br>
                        venta(kg):<?php echo $AgriculturalSystem['AgriculturalSystem']['venta']; ?><br><br>
                    </td>
                    <td>
                        Fertilización: <?php echo $AgriculturalSystem['AgriculturalSystem']['fertilizacion']; ?><br><br>
                        Control fitosanitario:<?php echo $AgriculturalSystem['AgriculturalSystem']['control_fito_sanitario']; ?><br><br>
                        Labores culturales:<?php echo $AgriculturalSystem['AgriculturalSystem']['labores_culturales']; ?><br><br>
                    </td>
                    <td>
                        <?php echo $this->Ajax->link('Editar', array('controller' => 'AgriculturalSystems', 'action' => 'edit', $AgriculturalSystem["AgriculturalSystem"]["id"]), array('update' => 'sistema_agricola', 'indicator' => 'loading', 'class' => 'acciones')); ?>
                        <br>
                        <br>
                        <?php echo $this->Ajax->link('Eliminar', array('controller' => 'AgriculturalSystems', 'action' => 'delete', $AgriculturalSystem["AgriculturalSystem"]["id"],$baseline_id), array('update' => 'sistema_agricola', 'indicator' => 'loading', 'class' => 'acciones'),'¿Desea eliminar el registro?'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $this->Js->writeBuffer(); ?>
    <?php echo $this->Ajax->link('Adicionar', array('controller' => 'AgriculturalSystems', 'action' => 'add', $baseline_id), array('update' => 'sistema_agricola', 'indicator' => 'loading', 'class' => 'acciones')); ?>
</div>