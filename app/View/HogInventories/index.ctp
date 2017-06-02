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
        <?php foreach ($HogInventories as $HogInventory): ?>
            <tr>

                <td>

                    <div style="border: solid 1px; border-color: #003399">
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Tipo porcinos</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Cerdas madres:</td>
                                    <td> <?php echo $HogInventory['HogInventory']['cerdas_madre'] ?></td>
                                </tr>
                                <tr>
                                    <td>Cerdas para reposición</td>
                                    <td><?php echo $HogInventory['HogInventory']['cerdas_reproduccion']; ?></td>
                                </tr>
                                <tr>
                                    <td>Lechones lactantes y pre-cebo</td>
                                    <td><?php echo $HogInventory['HogInventory']['lechonas_lactantes']; ?></td>
                                </tr>
                                <tr>
                                    <td>Cerdos en levante</td>
                                    <td><?php echo $HogInventory['HogInventory']['cerdos_levante']; ?></td>
                                </tr>
                                <tr>
                                    <td>Cerdos en ceba</td>
                                    <td><?php echo $HogInventory['HogInventory']['cerdos_ceba']; ?></td>
                                </tr>
                                <tr>
                                    <td>Reproductores</td>
                                    <td><?php echo $HogInventory['HogInventory']['reproductores'] ?></td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><?php echo $HogInventory['HogInventory']['cerdas_madre'] + $HogInventory['HogInventory']['reproductores'] + $HogInventory['HogInventory']['cerdas_reproduccion'] + $HogInventory['HogInventory']['cerdos_levante'] + $HogInventory['HogInventory']['cerdos_ceba'] + $HogInventory['HogInventory']['lechonas_lactantes'] ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div style="border: solid 1px; border-color: #003399">

                        <table border="1">

                            <tbody>
                                <tr>
                                    <th colspan="2">Instalaciones (Registre el área en m2 según corresponda):</th>
                                </tr>
                                <tr>
                                    <td>Corrales cubiertos  con secciones  definidas</td>
                                    <td> <?php echo $HogInventory['HogInventory']['corrales_seciones_definidas'] ?></td>
                                </tr>
                                <tr>
                                    <td>Corrales cubiertos  de flujo continuo</td>
                                    <td> <?php echo $HogInventory['HogInventory']['corrales_flujo_continuo'] ?></td>
                                </tr>
                                <tr>
                                    <td>Cochera o corral  tradicional no  tecnificado</td>
                                    <td> <?php echo $HogInventory['HogInventory']['corrales_no_tecnificados'] ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div style="border: solid 1px; border-color: #003399">
                        <fieldset>Material del piso:
                            <br>
                            <?php echo $this->Form->input('HogInventory.cemento', array('label' => 'Cemento', 'class' => '', 'checked' => $HogInventory['HogInventory']['cemento'], 'disabled' => 1)); ?>
                            <?php echo $this->Form->input('HogInventory.cama_profunda', array('label' => 'Cama profunda', 'checked' => $HogInventory['HogInventory']['cama_profunda'], 'disabled' => 1)); ?>
                            <?php echo $this->Form->input('HogInventory.madera', array('label' => 'Madera', 'checked' => $HogInventory['HogInventory']['madera'], 'disabled' => 1)); ?>
                            <?php echo $this->Form->input('HogInventory.plastico', array('label' => 'Plastico', 'checked' => $HogInventory['HogInventory']['plastico'], 'disabled' => 1)); ?>
                            <?php echo $this->Form->input('HogInventory.tierra', array('label' => 'Tierra', 'checked' => $HogInventory['HogInventory']['tierra'], 'disabled' => 1)); ?>
                            <?php echo $this->Form->input('HogInventory.otro', array('label' => 'Otro', 'checked' => $HogInventory['HogInventory']['otro'], 'disabled' => 1)); ?>

                        </fieldset>
                    </div>
                    <div style="border: solid 1px; border-color: #003399">
                        <fieldset>Aspectos sanitarios:<br><br>
                         <table border="1"><tr>
                                    <td>¿En los 12 últimos 12 meses realizó vacunación contra la peste porcina  clásica en la finca?</td>
                                    <td> <?php echo $HogInventory['HogInventory']['vacunacion'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                        </fieldset>
                    </div>


                </td>
                <td>
                    <?php echo $this->Ajax->link('Editar', array('controller' => 'HogInventories', 'action' => 'edit', $HogInventory["HogInventory"]["id"]), array('update' => 'porcinos', 'class' => 'acciones', 'indicator' => 'loading')); ?>
                    <br>
                    <br>
                    <?php echo $this->Ajax->link('Eliminar', array('controller' => 'HogInventories', 'action' => 'delete', $HogInventory["HogInventory"]["id"], $productive_baseline_id), array('update' => 'porcinos', 'class' => 'acciones', 'indicator' => 'loading'), '¿Desea eliminar el registro?'); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php if(count($HogInventories)==0) echo $this->Ajax->link('Adicionar', array('controller' => 'HogInventories', 'action' => 'add', $productive_baseline_id), array('update' => 'porcinos', 'class' => 'acciones', 'indicator' => 'loading')); ?>
