<script>
    $(document).ready(function() {
        $("#accordion").accordion(
        {
            autoHeight: false,
            collapsible: true,
            active: <?php
if (($this->Session->read('acordeon_id'))) {
    echo $this->Session->read('acordeon_id');
} else {
    echo 0;
};
?>
        }

    );

        jQuery("#form1").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }

        });
        jQuery("#form2").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }

        });
        jQuery("#form3").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }

        });
        jQuery("#form4").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }

        });
        jQuery("#form6").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content"
                });
            }

        });
        
        $('.boton').click(function (){
       
            $(this).hide();
        })

    });
</script>
<div id="accordion">



    <h3><a>DATOS DEL PROYECTO</a>	</h3>
    <div>
        <?php echo $this->Form->create("InitialEvaluation", array("id" => "form4", "action" => "edit/" . $this->data['InitialEvaluation']['id'])); ?>
        <?php echo $this->Form->input('InitialEvaluation.id'); ?>
        <table class="tbl">
            <tbody>
                <?php if ($group_id == 1 or $group_id == 2): ?>
                    <tr>
                        <td>EVALUADOR</td>
                        <td><?php echo $this->Form->input('InitialEvaluation.user_id', array('label' => '', 'class' => '', 'options' => $users)); ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td>Nombre del proyecto</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.nombre_proyecto', array('label' => '', 'class' => '')); ?></td>
                </tr>
                <tr>
                    <td>tipo de proyecto</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.tipo_proyecto', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Agrícola' => 'Agrícola', 'Pecuario' => 'Pecuario', 'Agropecuario' => 'Agropecuario'))); ?></td>
                </tr>
                <tr>
                    <td>Tipo de población</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.tipo_poblacion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Campesinos' => 'Campesinos', 'Campesinos y Desplazados' => 'Campesinos y Desplazados', 'Resguardo indigena' => 'Resguardo indigena', 'Desplazados' => 'Desplazados'))); ?></td>
                </tr>
                <tr>
                    <td>NUMERO DE FAMILIAS BENEFICIARIAS	</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.beneficiarios', array('label' => '', 'class' => '')); ?></td>
                </tr>
                <?php if ($this->Session->read('call_id') == 1): ?>
                    <tr>
                        <td>FAMILIAS ADJUDICATARIAS DEL PREDIO	</td>
                        <td><?php echo $this->Form->input('InitialEvaluation.adjudicatarios', array('label' => '', 'class' => '')); ?></td>
                    </tr>
                    <tr>
                        <td>FAMILIAS ADJUDICATARIAS NO BENEFICIARIAS DE LA COFINANCIACION	</td>
                        <td><?php echo $this->Form->input('InitialEvaluation.no_beneficiarios', array('label' => '', 'class' => '')); ?></td>
                    </tr>
                    <tr>
                        <td>Entidad acompañante</td>
                        <td><?php echo $this->Form->input('InitialEvaluation.nombre_aliado', array('label' => '', 'class' => '')); ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php
        echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'InitialEvaluations', 'action' => 'edit', $this->data['InitialEvaluation']['id']), 'update' => 'content', 'indicator' => 'loading', 'class' => 'boton', 'class' => 'boton'));
        echo $this->Form->end();
        ?> 
    </div>
    <h3><a href="#" >CRITERIOS GENERALES</a></h3>
    <div id="">
        <table class="tbl" >
            <tbody>
                <?php foreach ($requisitos as $requisito): ?>
                    <tr>
                        <td><?php echo $requisito['Requirement']['nombre']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                        <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 1), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <h3><a href="#">GASTOS ELEGIBLES PARA COFINANCIACIÓN POR PARTE DE INCODER EN LA <br>IMPLEMENTACIÓN DEL PROYECTO DE DESARROLLO RURAL:</a></h3>
    <div>
        <table class="tbl" >
            <thead>
                <tr>
                    <td>Requisito</td>
                    <td>Calificación</td>
                    <td>Observaciones</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($economicos as $requisito): ?>
                    <tr>

                        <td><?php echo $requisito['Requirement']['nombre']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                        <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 2), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <h3><a href="#">NO ELEGIBLES DE COFINANCIACION INCODER <br>PERO PUDEN SER ASUMIDOS POR LA CONTRAPARTIDA: 	</a></h3>
    <div>

        <table class="tbl">
            <thead>
                <tr>

                    <td>Requisito</td>

                    <td>Calificación</td>
                    <td>Observaciones</td>
                    <td></td>
                </tr>

            </thead>
            <tbody>
                <?php foreach ($noElegibles as $requisito): ?>
                    <tr>

                        <td><?php echo $requisito['Requirement']['nombre']; ?></td>

                        <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                        <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 3), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <h3><a href="#">RUBROS NO FINANCIABLES. 	</a></h3>
    <div>

        <table class="tbl" >
            <thead>
                <tr>

                    <td>Requisito</td>

                    <td>Calificación</td>
                    <td>Observaciones</td>
                    <td></td>
                </tr>

            </thead>
            <tbody>
                <?php foreach ($noFinanciables as $requisito): ?>
                    <tr>

                        <td><?php echo $requisito['Requirement']['nombre']; ?></td>

                        <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                        <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 4), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <h3><a>FINANCIACIÓN (MODALIDAD Y MONTO DEL APORTE)</a>	</h3>
    <div>
        <?php echo $this->Form->create("InitialEvaluation", array("id" => "form2", "action" => "edit/" . $this->data['InitialEvaluation']['id'])); ?>
        <?php echo $this->Form->input('InitialEvaluation.id'); ?>
        <table class="tbl" >
            <thead>
                <tr>
                    <th> Financiación (Modalidad y monto del aporte)</th>
                    <th>VALOR EN PESOS</th>
                    <th>%</th>
                    <th style="width: 30px">REVISIÓN</th>
                    <th>CALIFICACIÓN</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>VALOR TOTAL DEL PROYECTO</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.valor_total', array('label' => '', 'type' => 'tex')); ?></td>
                    <td><b><?php
        if ($this->data['InitialEvaluation']['valor_total'] != 0) {
            echo number_format($this->data['InitialEvaluation']['valor_total'] * (100 / $this->data['InitialEvaluation']['valor_total']), 2, ',', '.');
        } else {
            echo 0;
        }
        ?></b></td>
                    <td style="width: 30px"><?php echo $this->Form->input('InitialEvaluation.valor_total_revision', array('label' => '', 'class' => '')); ?></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.valor_total_calificacion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></td>
                </tr>
                <tr>
                    <td>MONTO TOTAL SOLICITADO (COFINANCIACIÓN INCODER PARA IMPLEMENTACIÓN DEL PROYECTO DE DESARROLLO RURAL</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.monto_solicitado', array('type' => 'tex', 'label' => '', 'class' => '')); ?></td>
                    <td><b><?php
                            if ($this->data['InitialEvaluation']['valor_total'] != 0) {
                                echo number_format($this->data['InitialEvaluation']['monto_solicitado'] * (100 / $this->data['InitialEvaluation']['valor_total']), 2, ',', '.');
                            } else {
                                echo 0;
                            }
        ?></b></td>


                    <td><?php echo $this->Form->input('InitialEvaluation.monto_solicitado_revision', array('label' => '', 'class' => '')); ?></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.monto_solicitado_calificacion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></td>
                </tr>
                <tr>

                    <td>MONTO CONTRAPARTIDA CERTIFICADA Y VERIFICABLE</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.certificadas', array('type' => 'tex', 'label' => '', 'class' => '')); ?></td>
                    <td><b><?php
                            if ($this->data['InitialEvaluation']['valor_total'] != 0) {
                                echo number_format($this->data['InitialEvaluation']['certificadas'] * (100 / $this->data['InitialEvaluation']['valor_total']), 2, ',', '.');
                            } else {
                                echo 0;
                            }
        ?></b></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.certificadas_concepto', array('label' => '', 'class' => '')); ?></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.certificadas_calificacion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></td>
                </tr>
                <tr>
                    <td>MONTO CONTRAPARTIDA RECUROS PROPIOS MANO DE OBRA NO REMUNERADA</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.contraprtidas_propias', array('type' => 'tex', 'label' => '', 'class' => '')); ?></td>
                    <td><b><?php
                            if ($this->data['InitialEvaluation']['valor_total'] != 0) {
                                echo number_format($this->data['InitialEvaluation']['contraprtidas_propias'] * (100 / $this->data['InitialEvaluation']['valor_total']), 2, ',', '.');
                            } else {
                                echo 0;
                            }
        ?></b></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.contrapartidas_propias_revision', array('label' => '', 'class' => '')); ?></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.contrapartidas_propias_calificacion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></td>

                </tr>
                <tr>
                    <td>MONTO DE RECURSOS SOLICITADOS POR CREDITO ( CREDITO AGROPECUARIO SI EL PROYECTO LO CONSIDERA A PARTIR DEL SEGUNDO AÑO)</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.credito', array('type' => 'tex', 'label' => '', 'class' => '')); ?></td>
                    <td><b><?php
                            if ($this->data['InitialEvaluation']['valor_total'] != 0) {
                                echo number_format($this->data['InitialEvaluation']['credito'] * (100 / $this->data['InitialEvaluation']['valor_total']), 2, ',', '.');
                            } else {
                                echo 0;
                            }
        ?></b></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.credito_revision', array('label' => '', 'class' => '')); ?></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.credito_calificacion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></td>
                </tr>
            </tbody>
        </table>
        <?php
        // echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'InitialEvaluations', 'action' => 'edit',$this->data['InitialEvaluation']['id']), 'update' => 'content', 'indicator' => 'loading','class'=>'boton'));
        echo $this->Form->end(array('label' => 'Guardar', 'class' => 'boton'));
        ?> 

    </div>

    <h3><a>PLAN DE TRANSFERENCIA A CUENTA CONTROLADA</a></h3>
    <div>
        <?php echo $this->Form->create("InitialEvaluation", array("id" => "form1", "action" => "edit/" . $this->data['InitialEvaluation']['id'])); ?>
        <?php echo $this->Form->input('InitialEvaluation.id'); ?>
        <table class="tbl" >
            <thead>
                <tr>
                    <th>PLAN DE TRANSFERENCIA A CUENTA CONTROLADA</th>
                    <th>VALOR EN PESOS</th>
                    <th>%</th>
                    <th>REVISIÓN</th>
                    <th>CUMPLIMIENTO</th>
                </tr>
            </thead>
            <tbody class="tbl">
                <tr>
                    <td>MONTO TOTAL DE LOS RECURSOS DEL INCODER A TRANSFERIR A CUENTA CONTROLADA</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.total_transferir_incoder', array('type' => 'tex', 'readonly' => 'readonly', 'class' => '', 'value' => $this->data['InitialEvaluation']['monto_solicitado'])); ?></td>
                    <td><b><?php
        if ($this->data['InitialEvaluation']['valor_total'] != 0) {
            echo number_format($this->data['InitialEvaluation']['total_transferir_incoder'] * (100 / $this->data['InitialEvaluation']['valor_total']), 2, ',', '.');
        } else {
            echo 0;
        }
        ?></b></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.total_transferir_incoder_revision', array('label' => '', 'class' => '')); ?></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.total_transferir_incoder_calificacion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></td>
                </tr>
                <tr>

                    <td>MONTO TOTAL DE LOS RECURSOS DE CONTRAPARTIDA A TRANSFERIR A CUENTA CONTROLADA</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.total_transferir_contrapartida', array('type' => 'tex', 'label' => '', 'class' => '')); ?></td>
                    <td><b><?php
                            if ($this->data['InitialEvaluation']['valor_total'] != 0) {
                                echo number_format($this->data['InitialEvaluation']['total_transferir_contrapartida'] * (100 / $this->data['InitialEvaluation']['valor_total']), 2, ',', '.');
                            } else {
                                echo 0;
                            }
        ?></b></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.total_transferir_contrapartida_revision', array('label' => '', 'class' => '')); ?></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.total_transferir_contrapartida_calficacion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></td>
                </tr>
                <tr>
                    <td>VALOR TOTAL DE TRANSFERENCIAS A CUENTA CONTROLADA DEL PROYECTO</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.total_transferencia', array('type' => 'tex', 'readonly' => 'readonly', 'class' => '', 'value' => $this->data['InitialEvaluation']['monto_solicitado'])); ?></td>
                    <td><b><?php 
                    if($this->data['InitialEvaluation']['valor_total']!=0){
                        echo number_format($this->data['InitialEvaluation']['total_transferencia'] * (100 / $this->data['InitialEvaluation']['valor_total']), 2, ',', '.');
                    }else{
                        echo 0;
                    }
                     ?></b></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.total_transferencia_revision', array('label' => '', 'class' => '')); ?></td>
                    <td><?php echo $this->Form->input('InitialEvaluation.total_transferencia_calificacion', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Si' => 'Si', 'No' => 'No'))); ?></td>
                </tr>

            </tbody>
        </table>
        <?php
        echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'InitialEvaluations', 'action' => 'edit', $this->data['InitialEvaluation']['id']), 'update' => 'content', 'indicator' => 'loading', 'class' => 'boton'));
        echo $this->Form->end();
        ?> 
    </div>



    <h3><a href="#">LEVANTAMIENTO DE LÍNEA BASE (CARACTERIZACIÓN DE PREDIOS Y FAMILIAS)</a></h3>
    <div>
        <table class="tbl">
            <thead>
                <tr>

                    <th>Requisito</td>
                    <th>Puntaje máximo</th>
                    <th>Puntaje obtenido </th>
                    <th>Calificación</th>
                    <th>Concepto</th>
                    <th>Observaciones</th>
                    <th>Pregunta a extender al proponente</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalEvaluacion = 0;
                $totalObtenidoEvaluacion = 0;
                $maxTotal = 0;
                $maxObtenido = 0;
                ?>
                <?php foreach ($caracterizaciones as $requisito): ?>
                    <tr>
                        <td><?php echo $requisito['Requirement']['nombre']; ?></td>
                        <td><?php echo $requisito['Requirement']['puntaje_maximo']; ?></td>
                        <td>
                            <?php
                            echo $requisito['InitialEvaluationRequirement']['puntaje'];
                            $maxTotal+=$requisito['Requirement']['puntaje_maximo'];
                            $maxObtenido+=$requisito['InitialEvaluationRequirement']['puntaje']
                            ?>
                        </td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['concepto']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['preguntas_proponente']; ?></td>
                        <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 7), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>TOTAL:</td>
                    <td>
                        <?php
                        echo $maxTotal;
                        $totalEvaluacion+=$maxTotal;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $maxObtenido;
                        $totalObtenidoEvaluacion+=$maxObtenido;
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>

                </tr>
            </tbody>
        </table>
    </div>
    <h3><a href="#">FORMULACIÓN PARTICIPATIVA DEL PROYECTO</a></h3>
    <div>
        <table class="tbl">
            <thead>
                <tr>
                    <td>Requisito</td>
                    <td>Puntaje máximo</td>
                    <td>Puntaje Obtenido </td>
                    <td>Calificación</td>
                    <td>Concepto</td>
                    <td>Observaciones</td>
                    <td>Pregunta a extender al proponente</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $maxTotal = 0;
                $maxObtenido = 0;
                ?>
                <?php foreach ($formulacion as $requisito): ?>
                    <tr>
                        <td><?php echo $requisito['Requirement']['nombre']; ?></td>
                        <td><?php echo $requisito['Requirement']['puntaje_maximo']; ?></td>
                        <td>
                            <?php
                            echo $requisito['InitialEvaluationRequirement']['puntaje'];
                            $maxTotal+=$requisito['Requirement']['puntaje_maximo'];
                            $maxObtenido+=$requisito['InitialEvaluationRequirement']['puntaje']
                            ?>
                        </td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['concepto']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['preguntas_proponente']; ?></td>
                        <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 8), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>TOTAL:</td>
                    <td>
                        <?php
                        echo $maxTotal;
                        $totalEvaluacion+=$maxTotal;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $maxObtenido;
                        $totalObtenidoEvaluacion+=$maxObtenido;
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php if ($this->Session->read('call_id') > 1 and $this->Session->read('call_id') <> 3): ?>
        <h3><a href="#">INFORMACIÓN GENERAL - OBJETIVOS- ACTIVIDADES Y METAS</a></h3>
        <div>
            <table class="tbl">
                <thead>
                    <tr>
                        <td>Requisito</td>
                        <td>Puntaje máximo</td>
                        <td>Puntaje Obtenido </td>
                        <td>Calificación</td>
                        <td>Concepto (por favor justifique la viabilización realizada)</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $maxTotal = 0;
                    $maxObtenido = 0;
                    ?>
                    <?php foreach ($generales as $requisito): ?>
                        <tr>
                            <td><?php echo $requisito['Requirement']['nombre']; ?></td>
                            <td><?php echo $requisito['Requirement']['puntaje_maximo']; ?></td>
                            <td>
                                <?php
                                echo $requisito['InitialEvaluationRequirement']['puntaje'];
                                $maxTotal+=$requisito['Requirement']['puntaje_maximo'];
                                $maxObtenido+=$requisito['InitialEvaluationRequirement']['puntaje']
                                ?>
                            </td>
                            <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                            <td><?php echo $requisito['InitialEvaluationRequirement']['concepto']; ?></td>
                            <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 9), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>TOTAL:</td>
                        <td>
                            <?php
                            echo $maxTotal;
                            $totalEvaluacion+=$maxTotal;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $maxObtenido;
                            $totalObtenidoEvaluacion+=$maxObtenido;
                            ?>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <h3><a href="#">CRITERIO T&Eacute;CNICO</a></h3>
    <div>
        <table class="tbl" >
            <thead>
                <tr>
                    <td>Requisito</td>
                    <td>Puntaje máximo</td>
                    <td>Puntaje Obtenido </td>
                    <td>Calificación</td>
                    <td>Concepto</td>
                    <td>Observaciones</td>
                    <td>Pregunta a extender al proponente </td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $maxTotal = 0;
                $maxObtenido = 0;
                ?>
                <?php foreach ($tecnicos as $requisito): ?>
                    <tr>
                        <td><?php echo $requisito['Requirement']['nombre']; ?></td>
                        <td><?php echo $requisito['Requirement']['puntaje_maximo']; ?></td>
                        <td>
                            <?php
                            echo $requisito['InitialEvaluationRequirement']['puntaje'];
                            $maxTotal+=$requisito['Requirement']['puntaje_maximo'];
                            $maxObtenido+=$requisito['InitialEvaluationRequirement']['puntaje']
                            ?>
                        </td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['concepto']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['preguntas_proponente']; ?></td>
                        <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 10), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>TOTAL:</td>
                    <td>
                        <?php
                        echo $maxTotal;
                        $totalEvaluacion+=$maxTotal;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $maxObtenido;
                        $totalObtenidoEvaluacion+=$maxObtenido;
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <h3><a href="#">ANALISIS FINANCIERO  DEL PROYECTO </a></h3>
    <div>
        <table class="tbl">
            <thead>
                <tr>
                    <td>Requisito</td>
                    <td>Puntaje máximo</td>
                    <td>Puntaje Obtenido </td>
                    <td>Calificación</td>
                    <td>Concepto</td>
                    <td>Observaciones</td>
                    <td>Pregunta a extender al proponente </td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $maxTotal = 0;
                $maxObtenido = 0;
                ?>
                <?php foreach ($financieros as $requisito): ?>
                    <tr>
                        <td><?php echo $requisito['Requirement']['nombre']; ?></td>
                        <td><?php echo $requisito['Requirement']['puntaje_maximo']; ?></td>
                        <td>
                            <?php
                            echo $requisito['InitialEvaluationRequirement']['puntaje'];
                            $maxTotal+=$requisito['Requirement']['puntaje_maximo'];
                            $maxObtenido+=$requisito['InitialEvaluationRequirement']['puntaje']
                            ?>
                        </td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['concepto']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['preguntas_proponente']; ?></td>
                        <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 11), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>TOTAL:</td>
                    <td>
                        <?php
                        echo $maxTotal;
                        $totalEvaluacion+=$maxTotal;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $maxObtenido;
                        $totalObtenidoEvaluacion+=$maxObtenido;
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php if ($this->Session->read('call_id') > 2): ?>
        <h3><a href="#">COMPONENTE SOCIAL </a></h3>
        <div>
            <table class="tbl">
                <thead>
                    <tr>
                        <td>Requisito</td>
                        <td>Puntaje máximo</td>
                        <td>Puntaje Obtenido </td>
                        <td>Calificación</td>
                        <td>Concepto</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $maxTotal = 0;
                    $maxObtenido = 0;
                    ?>
                    <?php foreach ($compSociales as $requisito): ?>
                        <tr>
                            <td><?php echo $requisito['Requirement']['nombre']; ?></td>
                            <td><?php echo $requisito['Requirement']['puntaje_maximo']; ?></td>
                            <td>
                                <?php
                                echo $requisito['InitialEvaluationRequirement']['puntaje'];
                                $maxTotal+=$requisito['Requirement']['puntaje_maximo'];
                                $maxObtenido+=$requisito['InitialEvaluationRequirement']['puntaje']
                                ?>
                            </td>
                            <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                            <td><?php echo $requisito['InitialEvaluationRequirement']['concepto']; ?></td>
                            <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 12), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>TOTAL:</td>
                        <td>
                            <?php
                            echo $maxTotal;
                            $totalEvaluacion+=$maxTotal;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $maxObtenido;
                            $totalObtenidoEvaluacion+=$maxObtenido;
                            ?>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <?php if ($this->Session->read('call_id') > 2): ?>
        <h3><a href="#">COMPONENTE COMERCIAL </a></h3>
        <div>
            <table class="tbl">
                <thead>
                    <tr>
                        <td>Requisito</td>
                        <td>Puntaje máximo</td>
                        <td>Puntaje Obtenido </td>
                        <td>Calificación</td>
                        <td>Concepto</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $maxTotal = 0;
                    $maxObtenido = 0;
                    ?>
                    <?php foreach ($compComerciales as $requisito): ?>
                        <tr>
                            <td><?php echo $requisito['Requirement']['nombre']; ?></td>
                            <td><?php echo $requisito['Requirement']['puntaje_maximo']; ?></td>
                            <td>
                                <?php
                                echo $requisito['InitialEvaluationRequirement']['puntaje'];
                                $maxTotal+=$requisito['Requirement']['puntaje_maximo'];
                                $maxObtenido+=$requisito['InitialEvaluationRequirement']['puntaje']
                                ?>
                            </td>
                            <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                            <td><?php echo $requisito['InitialEvaluationRequirement']['concepto']; ?></td>

                            <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 13), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td>TOTAL:</td>
                        <td>
                            <?php
                            echo $maxTotal;
                            $totalEvaluacion+=$maxTotal;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $maxObtenido;
                            $totalObtenidoEvaluacion+=$maxObtenido;
                            ?>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                </tbody>
            </table>


        </div>
    <?php endif; ?>
    <h3><a href="#">AMBIENTALES</a></h3>
    <div>

        <table class="tbl">
            <thead>
                <tr>
                    <td>Requisito</td>
                    <td>Puntaje máximo</td>
                    <td>Puntaje Obtenido </td>
                    <td>Calificación</td>
                    <td>Concepto</td>
                    <td>Observaciones</td>
                    <td>Pregunta a extender al proponente </td>
                    <td></td>
                </tr>

            </thead>
            <tbody>
                <?php
                $maxTotal = 0;
                $maxObtenido = 0;
                ?>
                <?php foreach ($ambientales as $requisito): ?>
                    <tr>

                        <td><?php echo $requisito['Requirement']['nombre']; ?></td>
                        <td><?php echo $requisito['Requirement']['puntaje_maximo']; ?></td>
                        <td>
                            <?php
                            echo $requisito['InitialEvaluationRequirement']['puntaje'];
                            $maxTotal+=$requisito['Requirement']['puntaje_maximo'];
                            $maxObtenido+=$requisito['InitialEvaluationRequirement']['puntaje']
                            ?>
                        </td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['concepto']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                        <td><?php echo $requisito['InitialEvaluationRequirement']['preguntas_proponente']; ?></td>
                        <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 14), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>TOTAL:</td>
                    <td>
                        <?php
                        echo $maxTotal;
                        $totalEvaluacion+=$maxTotal;
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $maxObtenido;
                        $totalObtenidoEvaluacion+=$maxObtenido;
                        ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>


    </div>

    <h3><a>FICHA RESUMEN</a></h3>
    <div>
        <?php echo $this->Form->create("InitialEvaluation", array("id" => "form3", "action" => "edit/" . $this->data['InitialEvaluation']['id'])); ?>
        <?php echo $this->Form->input('InitialEvaluation.id'); ?>
        <table class="tbl" >

            <tbody>
                <tr>
                    <td style="width: 40%">

                        <table border="1">

                            <tbody>
                                <tr>
                                    <td>PUNTAJE MÁXIMO:</td>
                                    <td>
                                        <?php
                                        echo $totalEvaluacion;
                                        ?>
                                    </td>
                                    <td>PUNTAJE OBTENIDO:</td>
                                    <td>  
                                        <?php
                                        $cal = "";
                                        echo $totalObtenidoEvaluacion;
                                        if ($totalObtenidoEvaluacion < 70) {
                                            $cal = "NO VIABLE";
                                        } else {
                                            $cal = "VIABLE";
                                        }
                                        ?>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td><?php echo $this->Form->input('InitialEvaluation.calificacion_integral', array('label' => 'Calificación integral', 'options' => array('empty' => '', 'VIABLE' => 'VIABLE', 'NO VIABLE' => 'NO VIABLE'))); ?></td>
                </tr>
                <tr>
                    <td>Concepto Técnico Final (Por favor escribir su concepto técnico final de evaluación)</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.concepto_tecnico_final', array('label' => '', 'class' => 'txtArea')) ?></td>

                </tr>
                <tr>
                    <td>VERIFICACIÓN ECONÓMICA (Cumple con la totalidad de requerimientos economicos y financieros?)   (Seleccione de la lista desplegable)					 </td>
                    <td><?php echo $this->Form->input('InitialEvaluation.verificacion_economica', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?></td>

                </tr>

                <tr>
                    <td>1.  La propuesta para la implementación de proyectos de desarrollo rural cumple con los topes máximos de cofinanciación establecidos por INCODER.  (Seleccione de la lista desplegable)					 </td>
                    <td><?php echo $this->Form->input('InitialEvaluation.topes_maximos', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?></td>

                </tr>
                <tr>
                    <td>2.  De acuerdo a la evaluación económica realizada, la actual propuesta CUMPLE con los lineamientos :  Rubros financiables, rubros no financiables, recursos de contrapartida, duración máxima.  (Seleccione de la lista desplegable)</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.evaluacion_economica', array('label' => '', 'class' => '', 'empty' => '', 'options' => array('Cumple' => 'Cumple', 'No cumple' => 'No cumple'))); ?></td>

                </tr>
                <tr>
                    <td>Concepto Económico Final (Por favor escribir su concepto económico final de evaluación:</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.concepto_economico', array('label' => '', 'class' => '')); ?></td>

                </tr>
                <tr>
                    <td>Principales riesgos del proyecto (Por favor diligenciar según su evaluación)</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.riesgo', array('label' => '', 'class' => '')); ?></td>

                </tr>
                <tr>
                    <td>Recomendaciones (Por favor diligenciar según su evaluación)</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.recomendaciones', array('label' => '', 'class' => '')); ?></td>

                </tr>




            </tbody>
        </table>
        <?php
        echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'InitialEvaluations', 'action' => 'edit', $this->data['InitialEvaluation']['id']), 'update' => 'content', 'indicator' => 'loading', 'class' => 'boton'));
        echo $this->Form->end();
        ?> 
        <?php echo $this->Html->link('Imprimir', array('controllers' => 'InitialEvaluations', 'action' => 'print_letter', $this->data['InitialEvaluation']['id']), array('target' => 'blank', 'class' => 'acciones')) ?>
    </div>
    <?php if ($this->Session->read('call_id') == 1): ?>
        <h3><a href="#">CAUSALES DE ACLARACIÓN</a></h3>
        <div>
            <span style="text-align: center">TIPO TÉCNICO</span>
            <table class="tbl">
                <thead>
                    <tr>

                        <td>Causa aclaración</td>
                        <td>Calificación</td>
                        <td>Observaciones</td>
                        <td></td>
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($acTecnicos as $requisito): ?>
                        <tr>

                            <td><?php echo $requisito['Requirement']['nombre']; ?></td>

                            <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                            <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                            <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 16), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

            <span style="text-align: center">TIPO SOCIAL</span>
            <table >
                <thead>
                    <tr>

                        <td>Causa aclaración</td>
                        <td>Calificación</td>
                        <td>Observaciones</td>
                        <td></td>
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($acSocial as $requisito): ?>
                        <tr>

                            <td><?php echo $requisito['Requirement']['nombre']; ?></td>

                            <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                            <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                            <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 17), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>

            <span style="text-align: center">TIPO FINANCIERO</span>
            <table class="tbl">
                <thead>
                    <tr>

                        <td>Causa aclaración</td>
                        <td>Calificación</td>
                        <td>Observaciones</td>
                        <td></td>
                    </tr>

                </thead>
                <tbody>
                    <?php foreach ($acFinanciera as $requisito): ?>
                        <tr>

                            <td><?php echo $requisito['Requirement']['nombre']; ?></td>

                            <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                            <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                            <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 18), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <span style="text-align: center">TIPO AMBIENTAL</span>

            <table >
                <thead>
                    <tr>

                        <td>Causa aclaración</td>
                        <td>Calificación</td>
                        <td>Observaciones</td>
                        <td></td>
                    </tr>

                </thead>
                <tbody>

                    <?php foreach ($acAmbiental as $requisito): ?>
                        <tr>

                            <td><?php echo $requisito['Requirement']['nombre']; ?></td>

                            <td><?php echo $requisito['InitialEvaluationRequirement']['calificacion']; ?></td>
                            <td><?php echo $requisito['InitialEvaluationRequirement']['observaciones']; ?></td>
                            <td><?php echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluationRequirements', 'action' => 'edit', $requisito['InitialEvaluationRequirement']['id'], 19), array('update' => 'content', 'indicator' => 'loading')); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    <?php endif; ?>
    <h3><a>FICHA TÉCNICA INCODER</a>	</h3>
    <div>
        <?php echo $this->Form->create("InitialEvaluation", array("id" => "form6", "action" => "edit/" . $this->data['InitialEvaluation']['id'])); ?>
        <?php echo $this->Form->input('InitialEvaluation.id'); ?>
        <table class="tbl">

            <tbody>
                <tr>
                    <td>OBJETIVO (Objetivo general, objetivos específicos) </td>
                    <td><?php echo $this->Form->input('InitialEvaluation.objetivo', array('label' => '', 'class' => '')); ?></td>
                </tr>
                <tr>
                    <td>ORIGEN DEL TEMA	(Síntesis descripción general del proyecto)				 </td>
                    <td><?php echo $this->Form->input('InitialEvaluation.origen_tema', array('label' => '', 'class' => '')); ?></td>

                </tr>

                <tr>
                    <td>JUSTIFICACIÓN				 </td>
                    <td><?php echo $this->Form->input('InitialEvaluation.justificacion', array('label' => '', 'class' => '')); ?></td>

                </tr>
                <tr>
                    <td>POBLACION A BENEFICIAR. Descripcion de los beneficiarios, desplazados, campesinos, etnias, numero de familias, características socio económicas.</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.descripcion_poblacion', array('label' => '', 'class' => '')); ?></td>

                </tr>
                <tr>
                    <td>DIRECCION TERRITORIAL PARTICIPANTE</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.branch_id', array('label' => '', 'class' => '')); ?></td>

                </tr>
                <tr>
                    <td>RESULTADOS ESPERADOS (Descripción de los resultados esperados  proyectados  del proyecto)</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.resultados_esperados', array('label' => '', 'class' => '')); ?></td>

                </tr>
                <tr>
                    <td>COMPONENTES DE INNOVACION Y DESARROLLO TECNOLOGICO DEL PROYECTO (Descripción de los aspectos y/o elementos del proyecto que lo identifican como de innovación y desarrollo tecnológico.)</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.innovacion', array('label' => '', 'class' => '')); ?></td>

                </tr>
                <tr>
                    <td>PERSONAL TECNICO VINCULADO (Descripción  del personal que participa en el proyecto,  nombre del aliado estratégico, numero de profesionales que realizan el acompañamiento, profesión. Otros aliados o cooperantes.)</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.descripcion_personal_tecnico', array('label' => '', 'class' => '')); ?></td>

                </tr>
                <tr>
                    <td>PROGRAMACION DE LAS ACTIVIDADES EN EL TIEMPO.(Describir de manera rápida y concisa, las actividades programadas en el tiempo u horizonte del proyecto. )</td>
                    <td><?php echo $this->Form->input('InitialEvaluation.programacion_actividades', array('label' => '', 'class' => '')); ?></td>

                </tr>
                <?php if ($this->Session->read('call_id') == 1): ?>
                    <tr>
                        <td>SOLICITUD CONCRETA AL INCODER DEL MONTO SOLICITA PARA COFINANCIACION.</td>
                        <td><?php echo $this->Form->input('InitialEvaluation.descripcion_solicitud', array('label' => '', 'class' => '')); ?></td>

                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php
        echo $this->Ajax->submit('Guardar', array('url' => array('controller' => 'InitialEvaluations', 'action' => 'edit', $this->data['InitialEvaluation']['id']), 'update' => 'content', 'indicator' => 'loading', 'class' => 'boton'));
        echo $this->Form->end();
        ?> 
    </div>


</div>
<br/>       
<br/>       

<?php echo $this->Html->link('Imprimir resumen', array('controllers' => 'InitialEvaluations', 'action' => 'print_letter', $this->data['InitialEvaluation']['id']), array('target' => 'blank', 'class' => 'acciones')) ?>
<br/>       
<br/>       
<?php echo $this->Html->link('Imprimir Ficha técnica', array('controllers' => 'InitialEvaluations', 'action' => 'print_card', $this->data['InitialEvaluation']['id']), array('target' => 'blank', 'class' => 'acciones')) ?>

