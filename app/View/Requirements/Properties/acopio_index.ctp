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
            <th> </th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Properties as $Property): ?>
            <tr>

                <?php if ($tipo == 1) : ?>
                    <td>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> Centro de acopio: <?php echo $Property['Property']['centro_acopio'] ?></td>
                                    <td>Tiempo empleado hacia el centro de acopio: <?php echo $Property['Property']['tiempo_centro_acopio'] ?></td>

                                </tr>

                            </tbody>
                        </table>
                    </td>
                    <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Properties', 'action' => 'edit_acopio', $Property["Property"]["id"], $tipo), array('update' => 'acopio', 'class' => 'acciones', 'indicator' => 'loading')); ?></td>

                <?php endif; ?>
                <?php if ($tipo == 2) : ?>
                    <td>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Precipitacion_promedio: <?php echo $Property['Property']['precipitacion_promedio'] ?></td>
                                    <td>Luminosidad promedio:<?php echo $Property['Property']['luminosidad_promedio'] ?></td>
                                    <td>Temperatura promedio anual (ºC) <?php echo $Property['Property']['temperatura_promedio'] ?></td>
                                </tr>
                                <tr>
                                    <td>Altura sobre el nivel del  : <?php echo $Property['Property']['altura_promedio'] ?></td>
                                    <td>Piso térmico: <?php echo $Property['Property']['piso'] ?></td>
                                    <td>Distribución de lluvias:  <?php echo $Property['Property']['lluvias'] ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </td>
                    <td><?php echo $this->Ajax->link('Editar', array( 'controller' => 'Properties', 'action' => 'edit_acopio', $Property["Property"]["id"], $tipo), array('update' => 'aspectos', 'indicator' => 'loading')); ?></td>

                <?php endif; ?>
                <?php if ($tipo == 3) : ?>
                     <td>
                        <table border="1">
                           
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>Observaciones: <?php echo $Property['Property']['observacion_linea_base'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td colspan="2"><?php echo $this->Ajax->link('Editar ', array( 'controller' => 'Properties', 'action' => 'edit_acopio', $Property["Property"]["id"], $tipo), array('update' => 'observaciones', 'indicator' => 'loading')); ?></td>

                <?php endif; ?>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
