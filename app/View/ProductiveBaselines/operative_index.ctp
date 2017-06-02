<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table style="font-size: smaller">
    <thead>
        <tr>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($ProductiveBaselines as $ProductiveBaseline): ?>
            <tr>
                <td>
                    <fieldset>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>6.2 ¿Realiza algún proceso de transformación en la finca?</th>
                                    <th><?php echo $ProductiveBaseline['ProductiveBaseline']['proceso_de_transformacion']; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">   <?php echo $ProductiveBaseline['ProductiveBaseline']['nombre_proceso'] ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>6.3 Principales problemas en la producción, cosecha y post cosecha comercialización:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>   
                                        <?php echo $this->Form->input('ProductiveBaseline.problemas_vias', array('label' => 'Vías','checked'=>$ProductiveBaseline['ProductiveBaseline']['problemas_vias'], 'disabled' => 1)); ?>
                                        <br>
                                        <?php echo $this->Form->input('ProductiveBaseline.problemas_transporte', array('label' => 'Trasporte', 'checked'=>$ProductiveBaseline['ProductiveBaseline']['problemas_transporte'], 'disabled' => 1)); ?>
                                        <br>
                                        <?php echo $this->Form->input('ProductiveBaseline.problemas_precio', array('label' => 'Precio','checked'=>$ProductiveBaseline['ProductiveBaseline']['problemas_precio'], 'disabled' => 1)); ?>
                                        <br>
                                        <?php echo $this->Form->input('ProductiveBaseline.problemas_calidad', array('label' => 'Calidad', 'checked'=>$ProductiveBaseline['ProductiveBaseline']['problemas_calidad'], 'disabled' => 1)); ?>
                                        <br>
                                        <?php echo $this->Form->input('ProductiveBaseline.problemas_competencia', array('label' => 'Competencia', 'checked'=>$ProductiveBaseline['ProductiveBaseline']['problemas_competencia'], 'disabled' => 1)); ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>Observaciones:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>   
                                        <?php echo $ProductiveBaseline['ProductiveBaseline']['observaciones']; ?>   
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table border="1">
                            <thead>
                                <tr>
                                    <th colspan="2">VII. CONTROL OPERATIVO</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Número de formulario</td>
                                    <td><?php echo $ProductiveBaseline['ProductiveBaseline']['formulario']; ?></td>
                                </tr>
                                <tr>
                                    <td>Fecha de la entrevista</td>
                                    <td><?php echo$ProductiveBaseline['ProductiveBaseline']['fecha_entrevista'] ?></td>
                                </tr>

                                <tr>
                                    <td>Número de visitas</td>
                                    <td><?php echo $ProductiveBaseline['ProductiveBaseline']['numero_visitas']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nombre del coordinador</td>
                                    <td>        <?php echo $ProductiveBaseline['ProductiveBaseline']['nombre_coordinador']?></td>
                                </tr>
                                <tr>
                                    <td>Nombre del Encuestador</td>
                                    <td>   <?php echo $ProductiveBaseline['ProductiveBaseline']['encuestador']?></td>
                                </tr>
                            </tbody>
                        </table>



                </td>
                <td>
                    <?php echo $this->Ajax->link('Editar', array('controller' => 'ProductiveBaselines', 'action' => 'operative_edit', $ProductiveBaseline["ProductiveBaseline"]["id"]), array('update' => 'operativo', 'class' => 'acciones', 'indicator' => 'loading')); ?>
                    <br>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
