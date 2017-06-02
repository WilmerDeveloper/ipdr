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
            <th><?php echo $this->Paginator->sort('Expense.id', ''); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Expenses as $Expense): ?>
            <tr>
                <td>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Actividades</th>
                                <th>Ingresos</th>
                                <th>Porcentaje</th>
                            </tr>
                            <tr>
                                <th colspan="3">Ingresos propios</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Agrícolas:</td>
                                <td><?php echo $Expense['Expense']['ingreso_agricola'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Pecuarios :</td>
                                <td><?php echo $Expense['Expense']['ingreso_pecuario'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Otros ingresos:</td>
                                <td><?php echo $Expense['Expense']['ingreso_otras_actividades'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Subtotal:</td>
                                <td><?php echo $propios = $Expense['Expense']['ingreso_agricola'] + $Expense['Expense']['ingreso_otras_actividades'] + $Expense['Expense']['ingreso_pecuario'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="3">Otras fuentes:</th>
                            </tr>
                            <tr>
                                <td>Mano de obra alquilada</td>
                                <td><?php echo $Expense['Expense']['mano_obra_alquilada'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Subsidios:</td>
                                <td><?php echo $Expense['Expense']['subsidios'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>remesas familiares::</td>
                                <td><?php echo $Expense['Expense']['remesas'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Otros ingresos:</td>
                                <td><?php echo $Expense['Expense']['otros_ingresos'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Subtotal:</td>
                                <td><?php echo $noPropios = $Expense['Expense']['remesas'] + $Expense['Expense']['otros_ingresos'] + $Expense['Expense']['subsidios'] + $Expense['Expense']['mano_obra_alquilada'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Total:</td>
                                <td><?php echo $propios + $noPropios ?></td>
                                <td></td>
                            </tr>


                            <tr>
                                <td  >De donde provienen los ingresos:</td>
                                <td colspan="2"><?php echo $Expense['Expense']['provienen'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Items</th>
                                <th>Monto gasto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Alimentación:</td>
                                <td><?php echo $Expense['Expense']['gasto_alimentacion'] ?></td>
                            </tr>
                            <tr>
                                <td>Servicios:</td>
                                <td><?php echo $Expense['Expense']['gasto_servicios'] ?></td>
                            </tr>
                            <tr>
                                <td>Educación:</td>
                                <td><?php echo $Expense['Expense']['gasto_educacion'] ?></td>
                            </tr>
                            <tr>
                                <td>Transporte</td>
                                <td><?php echo $Expense['Expense']['gasto_transporte'] ?></td>
                            </tr>
                            <tr>
                                <td>Salud:</td>
                                <td><?php echo $Expense['Expense']['gasto_salud'] ?></td>
                            </tr>
                            <tr>
                                <td>Arriendo:</td>
                                <td><?php echo $Expense['Expense']['gasto_arriendo'] ?></td>
                            </tr>
                            <tr>
                                <td>Entretenimiento:</td>
                                <td><?php echo $Expense['Expense']['gasto_entretenimiento'] ?></td>
                            </tr>
                            <tr>
                                <td>Comunicaciones:</td>
                                <td><?php echo $Expense['Expense']['gasto_comunicaciones'] ?></td>
                            </tr>
                            <tr>
                                <td>Pago deudas:</td>
                                <td><?php echo $Expense['Expense']['gasto_deudas'] ?></td>
                            </tr>
                            <tr>
                                <td>Otro: <?php echo $Expense['Expense']['nombre_gasto_otros'] ?></td>
                                <td><?php echo $Expense['Expense']['gasto_otro'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                    6.3   De acuerdo con las siguientes actividades económicas  identifique las tres que generan más ingresos para usted y su familia.   (Ordene de 1 a 3,  siendo 1 el más importante)
                    <br>

                    <div>
                        <fieldset>
                            <?php echo $this->Form->input('Expense.agricultura', array('disabled' => 1, 'value' => $Expense['Expense']['agricultura'], 'label' => 'Agricultura', 'class' => '')); ?>
                            <?php echo $this->Form->input('Expense.pesca', array('disabled' => 1, 'value' => $Expense['Expense']['pesca'], 'label' => 'Pesca', 'class' => '')); ?>
                            <?php echo $this->Form->input('Expense.ganaderia', array('disabled' => 1, 'value' => $Expense['Expense']['ganaderia'], 'label' => 'Ganaderia', 'class' => '')); ?>
                            <?php echo $this->Form->input('Expense.comercio', array('disabled' => 1, 'value' => $Expense['Expense']['comercio'], 'label' => 'Comercio', 'class' => '')); ?>
                            <?php echo $this->Form->input('Expense.transporte', array('disabled' => 1, 'value' => $Expense['Expense']['transporte'], 'label' => 'Transporte', 'class' => '')); ?>
                            <?php echo $this->Form->input('Expense.mano_obra', array('disabled' => 1, 'value' => $Expense['Expense']['mano_obra'], 'label' => 'Mano de obra fuera de la comunidad', 'class' => '')); ?>
                            <?php echo $this->Form->input('Expense.artesanias', array('disabled' => 1, 'value' => $Expense['Expense']['artesanias'], 'label' => 'Artesanias', 'class' => '')); ?>
                            <?php echo $this->Form->input('Expense.bares', array('disabled' => 1, 'value' => $Expense['Expense']['bares'], 'label' => 'Bares y restaurantes', 'class' => '')); ?>
                            <?php echo $this->Form->input('Expense.servicio_domestico', array('disabled' => 1, 'value' => $Expense['Expense']['servicio_domestico'], 'label' => 'Servicio domestico', 'class' => '')); ?>
                            <?php echo $this->Form->input('Expense.jornalero', array('disabled' => 1, 'value' => $Expense['Expense']['jornalero'], 'label' => 'Jornalero', 'class' => '')); ?>
                            <?php echo $this->Form->input('Expense.otra_actividad', array('disabled' => 1, 'value' => $Expense['Expense']['otra_actividad'], 'label' => 'Otra', 'class' => '')); ?>
                        </fieldset>
                    </div>

                    <table border="1">
                        <thead>
                            <tr>
                                <th>¿Sus ingresos son suficientes para cubrir sus necesidades básicas? (Alimentación, Educación, Vivienda, Salud)</th>
                                <th><?php echo $Expense['Expense']['ingresos_suficientes'] ?></th>
                            </tr>
                        </thead>
                    </table>

                    <table border="1">
                        <thead>
                            <tr>
                                <th>¿Usted o algún miembro de su familia ha recibido amenazas o ha sido objeto de algún hecho violento en el último año?</th>
                                <th><?php echo $Expense['Expense']['amenazas'] ?></th>
                            </tr>
                            <tr>
                                <td colspan="2"> ¿Cuáles han sido las consecuencias de estos hechos violentos?</td>

                            </tr>
                            <tr>
                                <td colspan="2"> 

                                    <fieldset>
                                        <?php echo $this->Form->input('Expense.desplazamiento', array('disabled' => 1, 'checked' => $Expense['Expense']['desplazamiento'], 'label' => 'Desplazamiento', 'class' => '')); ?>
                                        <br>                       
                                        <?php echo $this->Form->input('Expense.perdida_familiares', array('disabled' => 1, 'checked' => $Expense['Expense']['perdida_familiares'], 'label' => 'Perdida defamiliares', 'class' => '')); ?>
                                        <br> 
                                        <?php echo $this->Form->input('Expense.perdida_propiedad', array('disabled' => 1, 'checked' => $Expense['Expense']['perdida_propiedad'], 'label' => 'Perdida de propiedad', 'class' => '')); ?>
                                    </fieldset>
                                </td>
                            </tr>
                        </thead>
                    </table>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>¿Ha tenido condición de vulnerabilidad?          </th>
                                <th><?php echo $Expense['Expense']['vulnerabilidad'] ?></th>
                            </tr>

                            <tr>
                                <td colspan="2"> 

                                    <fieldset>
                                        <?php echo $this->Form->input('Expense.vulnerabilidad_desplazamiento', array('disabled' => 1, 'checked' => $Expense['Expense']['vulnerabilidad_desplazamiento'], 'label' => 'Desplazamiento', 'class' => '')); ?>
                                        <br>
                                        <?php echo $this->Form->input('Expense.vulnerabilidad_clima', array('disabled' => 1, 'checked' => $Expense['Expense']['vulnerabilidad_clima'], 'label' => 'Clima', 'class' => '')); ?>
                                        <br>
                                        <?php echo $this->Form->input('Expense.vulnerabilidad_orden_publico', array('disabled' => 1, 'checked' => $Expense['Expense']['vulnerabilidad_orden_publico'], 'label' => 'Orden publico', 'class' => '')); ?>
                                    </fieldset>
                                </td>
                            </tr>
                        </thead>
                    </table>



                </td>
                <td>
                    <?php echo $this->Ajax->link('Editar', array('controller' => 'Expenses', 'action' => 'edit', $Expense["Expense"]["id"]), array('update' => 'gastos', 'class' => 'acciones', 'indicator' => 'loading')); ?>
                    <br>                
                    <br>                
                    <?php echo $this->Ajax->link('Eliminar', array('controller' => 'Expenses', 'action' => 'delete', $Expense["Expense"]["id"], $family_poll_id), array('update' => 'gastos', 'class' => 'acciones', 'indicator' => 'loading'), '¿Desea eliminar el registro?'); ?>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<tr>


    <?php echo $this->Js->writeBuffer(); ?>
    <?php if (count($Expenses) == 0) echo $this->Ajax->link('Adicionar', array('update' => 'gastos', 'class' => 'acciones', $family_poll_id, 'controller' => 'Expenses', 'action' => 'add'), array('update' => 'gastos', 'indicator' => 'loading')); ?>
