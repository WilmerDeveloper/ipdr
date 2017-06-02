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
        </tr>
    </thead>
    <tbody>
        <?php foreach ($LivestockSystems as $LivestockSystem): ?>
            <tr>
        <table>
            <tr><td>Pastos mejorados</td><td><?php echo $LivestockSystem['LivestockSystem']['area_pastos_mejorados']; ?></td></tr>
            <tr><td>Pastos de corte</td><td><?php echo $LivestockSystem['LivestockSystem']['area_pastos_corte']; ?></td></tr>
            <tr><td>Pastos tradicionales</td><td><?php echo $LivestockSystem['LivestockSystem']['area_pastos_tradicionales']; ?></td></tr>
            <tr><td>Total</td><td><?php echo $LivestockSystem['LivestockSystem']['area_pastos_mejorados'] + $LivestockSystem['LivestockSystem']['area_pastos_corte'] + $LivestockSystem['LivestockSystem']['area_pastos_tradicionales']; ?></td></tr>
        </table>
        <br/>
        <br/>

        <table border="1">
            <tr><td>Raza o cruce de ganado predominante:</td><td><?php echo $LivestockSystem['LivestockSystem']['especie_predominante']; ?></td></tr>
            <tr><td>No. de partos en el último año:</td><td><?php echo $LivestockSystem['LivestockSystem']['numero_partos']; ?></td></tr>
        </table> 
        <br/>
        <table border="1">
            <tr><th>Grupos de edad</th><th>Cantidad de machos</th><th>Cantidad de hembras</th><th>Total</th></tr>
            <tr><td>Menores de 12 meses:</td><td><?php echo $LivestockSystem['LivestockSystem']['machos_menores_doce']; ?></td><td><?php echo $LivestockSystem['LivestockSystem']['hembras_menores_doce']; ?></td><td><?php echo $LivestockSystem['LivestockSystem']['machos_menores_doce'] + $LivestockSystem['LivestockSystem']['hembras_menores_doce']; ?></td></tr>
            <tr><td>De 12 a 23  meses:</td><td><?php echo $LivestockSystem['LivestockSystem']['machos_menores_23']; ?></td><td><?php echo $LivestockSystem['LivestockSystem']['hembras_menores_23']; ?></td><td><?php echo $LivestockSystem['LivestockSystem']['machos_menores_23'] + $LivestockSystem['LivestockSystem']['hembras_menores_23']; ?></td></tr>
            <tr><td>De 23 a 36 meses:</td><td><?php echo $LivestockSystem['LivestockSystem']['machos_menores_36']; ?></td><td><?php echo $LivestockSystem['LivestockSystem']['hembras_menores_36']; ?></td><td><?php echo $LivestockSystem['LivestockSystem']['machos_menores_36'] + $LivestockSystem['LivestockSystem']['hembras_menores_36']; ?></td></tr>
            <tr><td>Mayores de 36 meses:</td><td><?php echo $LivestockSystem['LivestockSystem']['machos_mayores_36']; ?></td><td><?php echo $LivestockSystem['LivestockSystem']['hembras_mayores_36']; ?></td><td><?php echo $LivestockSystem['LivestockSystem']['machos_mayores_36'] + $LivestockSystem['LivestockSystem']['hembras_mayores_36']; ?></td></tr>
            <tr><td>Total:</td><td><?php echo $LivestockSystem['LivestockSystem']['machos_menores_doce'] + $LivestockSystem['LivestockSystem']['machos_menores_23'] + $LivestockSystem['LivestockSystem']['machos_menores_36'] + $LivestockSystem['LivestockSystem']['machos_mayores_36']; ?></td><td><?php echo $LivestockSystem['LivestockSystem']['hembras_menores_doce'] + $LivestockSystem['LivestockSystem']['hembras_menores_23'] + $LivestockSystem['LivestockSystem']['hembras_menores_36'] + $LivestockSystem['LivestockSystem']['hembras_mayores_36']; ?></td><td><?php echo $LivestockSystem['LivestockSystem']['machos_menores_doce'] + $LivestockSystem['LivestockSystem']['hembras_menores_doce'] + $LivestockSystem['LivestockSystem']['machos_menores_23'] + $LivestockSystem['LivestockSystem']['hembras_menores_23'] + $LivestockSystem['LivestockSystem']['machos_menores_36'] + $LivestockSystem['LivestockSystem']['hembras_menores_36'] + $LivestockSystem['LivestockSystem']['machos_mayores_36'] + $LivestockSystem['LivestockSystem']['hembras_mayores_36']; ?></td></tr>
        </table>
        <br/>

        

        <table border="1">
            <tr><td>Orientación principal del hato:</td><td><?php echo $LivestockSystem['LivestockSystem']['orientacion_principal']; ?></td></tr>
            <tr>
                <td>¿Cuál de las siguientes tecnologías reproductivas utilizó durante el año 2012?</td>
                <td>  
            <fielset>
                <?php echo $this->Form->input('', array('label' => 'Inseminación artificial', 'checked' => $LivestockSystem['LivestockSystem']['inseminacion'], 'disabled' => 1)); ?>
                <?php echo $this->Form->input('', array('label' => 'Monta Natural', 'checked' => $LivestockSystem['LivestockSystem']['monta_natural'], 'disabled' => 1)); ?>
            </fielset>
            </td>
            </tr>
        </table> 
        <br/>
        <br/>

        <table border="1">
            <tr>
                <td>6.3 ¿Marca el ganado?</td>
                <td>  
            <fielset>
                <?php echo $LivestockSystem['LivestockSystem']['marca_ganado']; ?>
            </fielset>
            </td>
            </tr>
        </table> 
        <table border="1">
            <tr>
                <td>6.4 ¿Vacuna sus animales?:                 <?php echo $LivestockSystem['LivestockSystem']['vacuna'] ?></td>
                <td>  
            <fielset>
                Aftosa: <?php echo $LivestockSystem['LivestockSystem']['aftosa'] ?>
                <br>
                Brucelosis: <?php echo $LivestockSystem['LivestockSystem']['brucelosis'] ?>
            </fielset>
            </td>
            </tr>
        </table> 
        <br/>
        <table border="1">
            <tr>
                <td>6.5 ¿Con qué instalaciones cuenta el Predio?</td>
            </tr>
            <tr>

                <td>  

                    <?php echo $this->Form->input('', array('label' => 'Corrales de manejo', 'checked' => $LivestockSystem['LivestockSystem']['corrales'], 'disabled' => 1)); ?>
                    <br>
                    <?php echo $this->Form->input('', array('label' => 'Equipo de ordeño macanizado', 'checked' => $LivestockSystem['LivestockSystem']['equipo_ordeno'], 'disabled' => 1)); ?>
                    <br>
                    <?php echo $this->Form->input('', array('label' => 'Báscula', 'checked' => $LivestockSystem['LivestockSystem']['bascula'], 'disabled' => 1)); ?>
                    <br>
                    <?php echo $this->Form->input('', array('label' => 'Brete', 'checked' => $LivestockSystem['LivestockSystem']['brete'], 'disabled' => 1)); ?>
                    <br>
                    <?php echo $this->Form->input('', array('label' => 'Tanque de frío', 'checked' => $LivestockSystem['LivestockSystem']['tanque'], 'disabled' => 1)); ?>
                    <br>
                    <?php echo $this->Form->input('', array('label' => 'Otro,¿Cual?', 'checked' => $LivestockSystem['LivestockSystem']['otro'], 'disabled' => 1)); ?>


                </td>
            </tr>
        </table> 
        <br/>
        <table border="1">
            <tr>
                <td>6.6 ¿Hubo producción de leche en el Predio al día anterior a la entrevista?   </td>
                <td>  
                    <?php echo $LivestockSystem['LivestockSystem']['produccion_leche'] ?>
                </td>
            </tr>
            <tr>
                <td>Cantidad de vacas en ordeño</td>
                <td>  
                    <?php echo $LivestockSystem['LivestockSystem']['cantidad_vacas'] ?>
                </td>
            </tr>
            <tr>
                <td>Cantidad de leche (Total)</td>
                <td>  
                    <?php echo $LivestockSystem['LivestockSystem']['cantidad_leche'] ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center"><b>Unidad de medida</b></td>
            </tr>



            <tr>
                <td>Nombre</td>
                <td>  
                    <?php echo $LivestockSystem['LivestockSystem']['nombre_unidad'] ?>
                </td>
            </tr>
            <tr>
                <td>Equivalencia en litros</td>
                <td>  
                    <?php echo $LivestockSystem['LivestockSystem']['unidad_en_litros'] ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center"><b>Destino de la producción de leche (Cantidad de leche)</b></td>
            </tr>
            <tr>
                <td>Procesada en finca</td>
                <td>  
                    <?php echo $LivestockSystem['LivestockSystem']['procesada_en_finca'] ?>
                </td>
            </tr>
            <tr>
                <td>Consumida en finca</td>
                <td>  
                    <?php echo $LivestockSystem['LivestockSystem']['consumida_en_finca'] ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center"><b>Vendida a:</b></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center">

                    <?php echo $this->Form->input('', array('label' => 'Industria', 'checked' => $LivestockSystem['LivestockSystem']['corrales'], 'disabled' => 1)); ?>
                    <br>
                    <?php echo $this->Form->input('', array('label' => 'Intermediario', 'checked' => $LivestockSystem['LivestockSystem']['equipo_ordeno'], 'disabled' => 1)); ?>
                    <br>
                    <?php echo $this->Form->input('', array('label' => 'Otro', 'checked' => $LivestockSystem['LivestockSystem']['bascula'], 'disabled' => 1)); ?>


                </td>
            </tr>
            <tr>
                <td>Número de días promedio en producción lechera por vaca (Periodo de lactancia)</td>
                <td>  
                    <?php echo $LivestockSystem['LivestockSystem']['promedio_produccion'] ?>
                </td>
            </tr>
            <tr>
                <td>Litros Vendidos/año: </td>
                <td>  
                    <?php echo $LivestockSystem['LivestockSystem']['litros_vendidos'] ?>
                </td>
            </tr>
        </table>


    </tr>    
    <tr>

        <td>
            <?php echo $this->Ajax->link('Editar', array('controller' => 'LivestockSystems', 'action' => 'edit', $LivestockSystem["LivestockSystem"]["id"]), array('update' => 'sistema_pecuario', 'indicator' => 'loading', 'class' => 'acciones')); ?>
        </td>
        <td>
            <?php echo $this->Ajax->link('Eliminar', array('controller' => 'LivestockSystems', 'action' => 'delete', $LivestockSystem["LivestockSystem"]["id"], $productive_baseline_id), array('update' => 'sistema_pecuario', 'indicator' => 'loading', 'class' => 'acciones'), '¿Desea eliminar el registro?'); ?>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php if (count($LivestockSystems) == 0) echo $this->Ajax->link('Adicionar', array('controller' => 'LivestockSystems', 'action' => 'add', $productive_baseline_id), array('update' => 'sistema_pecuario', 'indicator' => 'loading', 'class' => 'acciones')); ?>
