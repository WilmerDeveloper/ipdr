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
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($PoultryInventories as $PoultryInventory): ?>
            <tr>
                <td>
                    <table border="1">
                        <thead>
                            <tr>
                                <th colspan="2">Inventario de aves de corral y traspatio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tipo de ave</td>
                                <td>Cantidad</td>
                            </tr>
                            <tr>
                                <td>Pollos de engorde:</td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['pollos_engorde']; ?></td>
                            </tr>
                            <tr>
                                <td>Gallinas de postura</td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['gallinas_de_postura'];  ?></td>
                            </tr>
                            <tr>
                                <td>Aves de traspatio (Pollos, Gallos,  Gallinas)</td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['aves_de_traspatio'];?></td>
                            </tr>
                            <tr>
                                <td>Patos</td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['patos']; ?></td>
                            </tr>
                            <tr>
                                <td>Piscos (Pavos, Bimbos)</td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['piscos'];?></td>
                            </tr>
                            <tr>
                                <td>Codornices</td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['codornices']; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table border="1">
                        <thead>
                            <tr>
                                <th colspan="3">Producción de huevos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Items</td>
                                <td>Gallinas de postura</td>
                                <td>Gallinas de traspatio</td>
                            </tr>
                            <tr>
                                <td>¿Hubo producción de huevos la semana anterior a la de la visita?</td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['producion_postura'];?></td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['producion_traspatio'];; ?></td>
                            </tr>
                            <tr>
                                <td>¿Cuántos huevos se produjeron la semana anterior?</td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['huevos_galinas_postura']; ?></td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['huevos_galinas_traspatio']; ?></td>
                            </tr>
                            <tr>
                                <td>¿Cuántos de estos huevos se destinaron para autoconsumo?</td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['autoconsumo_postura']; ?></td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['autoconsumo_traspatio'];?></td>
                            </tr>
                            <tr>
                                <td>¿Cuántos de estos huevos se destinaron para la venta?</td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['venta_postura'];?></td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['venta_traspatio']; ?></td>
                            </tr>

                        </tbody>
                    </table>
                    <table border="1">
                        <thead>
                            <tr>
                                <th colspan="2">Instalaciones (Registre el área en m2según corresponda)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Galpón</td>
                                <td>
                                    Corral
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $PoultryInventory['PoultryInventory']['area_galpon'];?></td>
                                <td><?php echo $PoultryInventory['PoultryInventory']['area_corral']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Material del piso</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php echo $this->Form->input('PoultryInventory.piso_cemento', array('label' => 'Cemento', 'checked' => $PoultryInventory['PoultryInventory']['piso_cemento'],'disabled'=>1)); ?>
                                    <br>               
                                    <?php echo $this->Form->input('PoultryInventory.piso_madera', array('label' => 'Madera',  'checked' => $PoultryInventory['PoultryInventory']['piso_madera'],'disabled'=>1)); ?>
                                    <br>           
                                    <?php echo $this->Form->input('PoultryInventory.piso_tierra', array('label' => 'Tierra', 'checked' => $PoultryInventory['PoultryInventory']['piso_tierra'],'disabled'=>1)); ?>
                                    <br>     
                                    <?php echo $this->Form->input('PoultryInventory.piso_otro', array('label' => 'Otro', 'checked' => $PoultryInventory['PoultryInventory']['piso_otro'],'disabled'=>1)); ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table border="1">
                        <thead>
                            <tr>
                                <th colspan="2">Aspectos sanitarios</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    ¿Realizó desinfección de las instalaciones antes del ingreso de las aves?
                                </td>
                                <td>
                                    <?php echo $PoultryInventory['PoultryInventory']['desinfeccion'];; ?>
                                </td>

                            </tr>
                            <tr>
                                <td>
                                    Durante el año 2012 vacunó contra:
                                </td>
                                <td>
                                    <?php echo $this->Form->input('PoultryInventory.vacuna_newcastle', array('label' => 'Newcastle', 'checked' => $PoultryInventory['PoultryInventory']['vacuna_newcastle'],'disabled'=>1)); ?>
                                    <?php echo $this->Form->input('PoultryInventory.vacuna_gumboro', array('label' => 'Gumboro', 'checked' => $PoultryInventory['PoultryInventory']['vacuna_gumboro'],'disabled'=>1)); ?>
                                    <?php echo $this->Form->input('PoultryInventory.vacuna_salomonella', array('label' => 'Salomonella', 'checked' => $PoultryInventory['PoultryInventory']['vacuna_salomonella'],'disabled'=>1)); ?>
                                    <?php echo $this->Form->input('PoultryInventory.vacuna_bronquitis', array('label' => 'Bronquitis', 'checked' => $PoultryInventory['PoultryInventory']['vacuna_bronquitis'],'disabled'=>1)); ?>
                                    <?php echo $this->Form->hidden('PoultryInventory.productive_baseline_id', array('label' => 'properties_id', 'value' => $productive_baseline_id)); ?>

                                </td>



                            </tr>
                        </tbody>
                    </table>


                </td>
                <td>
                    <?php echo $this->Ajax->link('Editar', array('controller' => 'PoultryInventories', 'action' => 'edit', $PoultryInventory["PoultryInventory"]["id"]), array('update' => 'avicola', 'class' => 'acciones', 'indicator' => 'loading')); ?><br><br>
                    <?php echo $this->Ajax->link('Eliminar', array('controller' => 'PoultryInventories', 'action' => 'delete', $PoultryInventory["PoultryInventory"]["id"], $productive_baseline_id), array('update' => 'avicola', 'class' => 'acciones', 'indicator' => 'loading'), '¿Desea eliminar el registro?'); ?><br><br>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php  if(count($PoultryInventories)==0)echo $this->Ajax->link('Adicionar', array('controller' => 'PoultryInventories', 'action' => 'add', $productive_baseline_id), array('update' => 'avicola', 'class' => 'acciones', 'indicator' => 'loading')); ?>
