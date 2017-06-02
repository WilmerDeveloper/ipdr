<script>
    $(document).ready(function() {
        $( "#accordion" ).accordion(
        {
            autoHeight: false,
            collapsible: true           
        }
    )
    });
</script>
<?php
$totalCantidad = 0;
$totalIncoder = 0;
$totalComunidad = 0;
$totalCertificada = 0;
$totalOtrasContrapartidas = 0;
$totalUnidad = 0;
$valor_total = 0;
$tipo = "";
$totalCantidadtmp = 0;
$totalUnitatmp = 0;
$incotmp = 0;
$comtmp = 0;
$totaltmp = 0;
$certftmp = 0;
$otratmp = 0;

App::Import('model', 'Proyect');
$Proyect = new Proyect();
$Proyect->recursive = -1;

$proyecto = $Proyect->field("Proyect.codigo", array('Proyect.id' => $proyect_id));
$predios = $Proyect->Property->find("all", array('recursive' => -1, 'conditions' => array('Property.proyect_id' => $proyect_id), 'fields' => array('Property.nombre')));
App::Import('model', 'Resolution');
$Resolution = new Resolution();
$Resolution->recursive = -1;
$resolucion = $Resolution->find('first', array('conditions' => array('Resolution.proyect_id' => $proyect_id), 'order' => array('Resolution.id DESC')));
App::Import('model', 'InitialEvaluation');
$initialEvaluation = new InitialEvaluation();
$initialEvaluation->recursive = -1;
$evaluacion = $initialEvaluation->find('first', array('conditions' => array('Follow.id' => $follow_id), 'order' => array('InitialEvaluation.id DESC'), 'fields' => array('InitialEvaluation.id', 'InitialEvaluation.valor_total', 'InitialEvaluation.monto_solicitado', 'InitialEvaluation.certificadas', 'InitialEvaluation.contraprtidas_propias'), 'joins' => array(array('table' => 'follows', 'type' => 'left', 'alias' => 'Follow', 'conditions' => 'InitialEvaluation.id=Follow.initial_evaluation_id'))));
$strPredios = "";
foreach ($predios as $predio) {
    $strPredios.=$predio['Property']['nombre'] . " ";
}
$str = "<table border=\"1\" style=\"width:70%;font-size:11; text-alige:center\">";
$str.="<tr><td>CÓDIGO DEL PROYECTO:</td><td>" . $proyecto . "</td> ";
$str.="<td>NOMBRE DEL PREDIO:</td><td>$strPredios</td></tr>";
$str.="<tr><td>NÚMERO DE LA RESOLUCIÓN:</td><td>" . $resolucion['Resolution']['numero'] . "</td>";
$str.="<td>FECHA DE LA RESOLUCIÓN:</td><td>" . $resolucion['Resolution']['fecha'] . "</td></tr>";
$str.="<tr><td colspan=\"4\" ><b>DISTRIBUCIÓN VALORES DE COFINANCIACIÓN Y CONTRAPARTIDAS</b></td></tr>";
$str.="<tr><td>Valor proyecto:</td><td> $ " . number_format($evaluacion['InitialEvaluation']['valor_total'], 0, ',', '.') . "</td>";
$str.="<td>Valor Cofinanciación INCODER:</td><td>$ " . number_format($evaluacion['InitialEvaluation']['monto_solicitado'], 0, ',', '.') . "</td></tr>";
$str.="<tr><td>Valor cofinanciación contrapartidas certificadas :</td><td>$ " . number_format($evaluacion['InitialEvaluation']['certificadas'], 0, ',', '.') . "</td>";
$str.="<td>Valor cofinanciación otras contrapartidas  :</td><td>$" . number_format($evaluacion['InitialEvaluation']['contraprtidas_propias'], 0, ',', '.') . "</td></tr>";
$str.="</table>";
?>

<div id="accordion">

    <h3><a href="#">I. PRESUPUESTO</a></h3>
    <div>
        <?php echo $str; ?>
        <br>
        <br>
        <br>
        <table border="1" >
            <thead>
                <tr style="font-size: 10">
                    <th><?php echo ('Actividad'); ?></th>
                    <th><?php echo ('Cantidad'); ?></th>
                    <th><?php echo ('Valor unitario en pesos'); ?></th>
                    <th>Valor total</th>
                    <th><?php echo ('Valor cofinanciación INCODER'); ?></th>
                    <th><?php echo ('Valor cofinanciación comunidad'); ?></th>
                    <th><?php echo ('Valor cofinanciación contrapartida certificada'); ?></th>
                    <th><?php echo ('Valor cofinanciación otras contrapartidas'); ?></th>
                    <th><?php echo ('Observaciones'); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($Budgets as $Budget): ?>
                    <?php if ($tipo != "" and $tipo != $Budget['MonitoringActivity']['tipo']): ?>
                        <tr style="font-size: 10">
                            <td ><b>Subtotal <?php echo($tipo) ?>:</b></td>

                            <td>
                                <b>
                                    <?php
                                    echo number_format($totalCantidadtmp, 0, ',', '.');
                                    $totalCantidadtmp = 0;
                                    ?>
                                </b>
                            </td>
                            <td>
                                <b>
                                    <?php
                                    echo number_format($totalUnitatmp, 0, ',', '.');
                                    $totalUnitatmp = 0;
                                    ?>
                                </b>
                            </td>
                            <td>
                                <b><?php
                            echo number_format($totaltmp, 0, ',', '.');
                            $totaltmp = 0;
                                    ?>
                                </b>
                            </td>
                            <td>
                                <b>
                                    <?php
                                    echo number_format($incotmp, 0, ',', '.');
                                    $incotmp = 0;
                                    ?>
                                </b>
                            </td>
                            <td>
                                <b>
                                    <?php
                                    echo number_format($comtmp, 0, ',', '.');
                                    $comtmp = 0;
                                    ?>
                                </b>
                            </td>
                            <td>
                                <b>
                                    <?php
                                    echo number_format($certftmp, 0, ',', '.');
                                    $certftmp = 0;
                                    ?></b>
                            </td>
                            <td>
                                <b>
                                    <?php
                                    echo number_format($otratmp, 0, ',', '.');
                                    $otratmp = 0;
                                    ?>
                                </b>
                            </td>
                            <td></td>
                            <td></td>

                        </tr>
                    <?php endif; ?>
                    <tr style="font-size: 10"><?php echo $Budget['MonitoringActivity']['tipo']; ?></td>

                        <td   ><?php echo $Budget['MonitoringActivity']['nombre']; ?></td>
                        <td>
                            <?php
                            echo $Budget['Budget']['cantidad'];
                            $totalCantidadtmp+=$Budget['Budget']['cantidad'];
                            $totalCantidad+=$Budget['Budget']['cantidad'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo number_format($Budget['Budget']['valor_unitario'], 0, ',', '.');
                            $totalUnitatmp+=$Budget['Budget']['valor_unitario'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo number_format($Budget['Budget']['valor_unitario'] * $Budget['Budget']['cantidad'], 0, ',', '.');
                            $totaltmp+=$Budget['Budget']['valor_unitario'] * $Budget['Budget']['cantidad'];
                            $valor_total+=$Budget['Budget']['valor_unitario'] * $Budget['Budget']['cantidad'];
                            ;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo number_format($Budget['Budget']['cofinanciacion_incoder'], 0, ',', '.');
                            $incotmp+=$Budget['Budget']['cofinanciacion_incoder'];
                            $totalIncoder+=$Budget['Budget']['cofinanciacion_incoder'];
                            ?>
                        </td>
                        <td>

                            <?php
                            echo number_format($Budget['Budget']['cofinaciacion_comunidad'], 0, ',', '.');
                            $comtmp+=$Budget['Budget']['cofinaciacion_comunidad'];
                            $totalComunidad+=$Budget['Budget']['cofinaciacion_comunidad'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo number_format($Budget['Budget']['contapartida_certificada'], 0, ',', '.');
                            $certftmp+=$Budget['Budget']['contapartida_certificada'];
                            $totalCertificada+=$Budget['Budget']['contapartida_certificada'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo number_format($Budget['Budget']['otra_contrapartida'], 0, ',', '.');
                            $otratmp+=$Budget['Budget']['otra_contrapartida'];
                            $totalOtrasContrapartidas+=$Budget['Budget']['otra_contrapartida'];
                            ?>
                        </td>
                        <td><?php echo $Budget['Budget']['observaciones']; ?></td>
                        <td>
                            <?php if ($Budget['Budget']['cerrado'] == 0) echo $this->Ajax->link('Editar', array('controller' => 'Budgets', 'action' => 'edit', $Budget["Budget"]["id"]), array('update' => 'content', 'class' => 'acciones', 'indicator' => 'loading', 'complete' => 'formularioAjax()')); ?>
                            <br>
                            <br>
                            <?php if ($Budget['Budget']['cerrado'] == 0) echo $this->Ajax->link('Eliminar', array('controller' => 'Budgets', 'action' => 'delete', $Budget["Budget"]["id"], $follow_id), array('update' => 'content', 'class' => 'acciones', 'indicator' => 'loading', 'complete' => 'formularioAjax()'), '¿Dsea eliminar el registro ?'); ?>

                        </td>
                    </tr>
                    <?php $tipo = $Budget['MonitoringActivity']['tipo']; ?>
                <?php endforeach; ?>

                <?php if ($tipo != ""): ?>
                    <tr style="font-size: 10">
                        <td ><b>Subtotal <?php echo($tipo) ?>:</b></td>

                        <td>
                            <b>
                                <?php
                                echo number_format($totalCantidadtmp, 0, ',', '.');
                                $totalCantidadtmp = 0;
                                ?>
                            </b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo number_format($totalUnitatmp, 0, ',', '.');
                                $totalUnitatmp = 0;
                                ?></b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo number_format($totaltmp, 0, ',', '.');
                                $totaltmp = 0;
                                ?></b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo number_format($incotmp, 0, ',', '.');
                                $incotmp = 0;
                                ?></b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo number_format($comtmp, 0, ',', '.');
                                $comtmp = 0;
                                ?>
                            </b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo number_format($certftmp, 0, ',', '.');
                                $certftmp = 0;
                                ?>
                            </b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo number_format($otratmp, 0, ',', '.');
                                $otratmp = 0;
                                ?>
                            </b>
                        </td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr style="font-size: 10">
                        <td><b>Total:</b></td>
                        <td>
                            <b>
                                <?php
                                echo number_format($totalCantidad, 0, ',', '.');
                                ?>
                            </b>
                        </td>
                        <td>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo number_format($valor_total, 0, ',', '.');
                                ?></b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo number_format($totalIncoder, 0, ',', '.');
                                ?></b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo number_format($totalComunidad, 0, ',', '.');
                                ?>
                            </b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo number_format($totalCertificada, 0, ',', '.');
                                ?>
                            </b>
                        </td>
                        <td>
                            <b>
                                <?php
                                echo number_format($totalOtrasContrapartidas, 0, ',', '.');
                                ?>
                            </b>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php
        if ($totalIncoder > $evaluacion['InitialEvaluation']['monto_solicitado'] * 1000) {
            echo"<br><h1 style='color:red;'>El valor de la suma de la cofinanciación Incoder ($ " . number_format($totalIncoder, 0) . ") es mayor que el de la resolución ( $" . number_format($evaluacion['InitialEvaluation']['monto_solicitado'] * 1000, 0) . ")</h1>";
        }
        ?>
        <?php if ($cerrado == 0) echo $this->Ajax->link('Adicionar', array('controller' => 'Budgets', 'action' => 'add', $follow_id), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => 'formularioAjax()')); ?>
        <?php echo $this->Html->link('Imprimir presupuesto', array('controller' => 'Budgets', 'action' => 'print_budget', $follow_id), array('target' => '_blank', 'indicator' => 'loading', 'class' => 'acciones')); ?>
    </div>
    <h3><a href="#">II. CRONOGRAMA</a></h3>
    <div>
        <table border="1" >
            <thead>
                <tr>
                    <th></th>
                    <th><?php echo ('Actividad'); ?></th>
                    <th><?php echo ('Mes 1'); ?></th>
                    <th><?php echo ('Mes 2'); ?></th>
                    <th><?php echo ('Mes 3'); ?></th>
                    <th><?php echo ('Mes 4'); ?></th>
                    <th><?php echo ('Mes 5'); ?></th>
                    <th><?php echo ('Mes 6'); ?></th>
                    <th><?php echo ('Mes 7'); ?></th>
                    <th><?php echo ('Mes 8'); ?></th>
                    <th><?php echo ('Mes 9'); ?></th>
                    <th><?php echo ('Mes 10'); ?></th>
                    <th><?php echo ('Mes 11'); ?></th>
                    <th><?php echo ('Mes 12'); ?></th>
                    <th><?php echo ('observaciones'); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totM1 = 0;
                $totM2 = 0;
                $totM3 = 0;
                $totM4 = 0;
                $totM5 = 0;
                $totM6 = 0;
                $totM7 = 0;
                $totM8 = 0;
                $totM9 = 0;
                $totM10 = 0;
                $totM11 = 0;
                $totM12 = 0;
                ?>
                <?php foreach ($Budgets as $Budget): ?>
                    <tr>
                        <td><?php echo $Budget['MonitoringActivity']['tipo']; ?></td>
                        <td><?php echo $Budget['MonitoringActivity']['nombre']; ?></td>
                        <td><?php
                echo number_format($Budget['Budget']['mes1'], 0, ',', '.');
                $totM1+= $Budget['Budget']['mes1']
                    ?></td>
                        <td><?php
                        echo number_format($Budget['Budget']['mes2'], 0, ',', '.');
                        $totM2+= $Budget['Budget']['mes2']
                    ?></td>
                        <td><?php
                        echo number_format($Budget['Budget']['mes3'], 0, ',', '.');
                        $totM3+= $Budget['Budget']['mes3']
                    ?></td>
                        <td><?php
                        echo number_format($Budget['Budget']['mes4'], 0, ',', '.');
                        $totM4+= $Budget['Budget']['mes4']
                    ?></td>
                        <td><?php
                        echo number_format($Budget['Budget']['mes5'], 0, ',', '.');
                        $totM5+= $Budget['Budget']['mes5']
                    ?></td>
                        <td>
                            <?php
                            echo number_format($Budget['Budget']['mes6'], 0, ',', '.');
                            $totM6+= $Budget['Budget']['mes6']
                            ?>
                        </td>
                        <td>
                            <?php
                            echo number_format($Budget['Budget']['mes7'], 0, ',', '.');
                            $totM7+= $Budget['Budget']['mes7']
                            ?>
                        </td>
                        <td>
                            <?php
                            echo number_format($Budget['Budget']['mes8'], 0, ',', '.');
                            $totM8+= $Budget['Budget']['mes8']
                            ?>
                        </td>
                        <td>
                            <?php
                            echo number_format($Budget['Budget']['mes9'], 0, ',', '.');
                            $totM9+= $Budget['Budget']['mes9']
                            ?>
                        </td>
                        <td>
                            <?php
                            echo number_format($Budget['Budget']['mes10'], 0, ',', '.');
                            $totM10+= $Budget['Budget']['mes10']
                            ?>
                        </td>
                        <td>
                            <?php
                            echo number_format($Budget['Budget']['mes11'], 0, ',', '.');
                            $totM11+= $Budget['Budget']['mes11']
                            ?>
                        </td>
                        <td>
                            <?php
                            echo number_format($Budget['Budget']['mes12'], 0, ',', '.');
                            $totM12+= $Budget['Budget']['mes12']
                            ?>
                        </td>
                        <td><?php echo $Budget['Budget']['observaciones_mes']; ?></td>
                        <td><?php if ($cerrado == 0) echo $this->Ajax->link('Editar', array('controller' => 'Budgets', 'action' => 'edit_calendario', $Budget["Budget"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones', 'complete' => 'formularioAjax()')); ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td>TOTAL:</td>
                    <td></td>
                    <td><b><?php echo number_format($totM1, 0, ',', '.'); ?></b></td>
                    <td><b><?php echo number_format($totM2, 0, ',', '.'); ?></b></td>
                    <td><b><?php echo number_format($totM3, 0, ',', '.'); ?></b></td>
                    <td><b><?php echo number_format($totM4, 0, ',', '.'); ?></b></td>
                    <td><b><?php echo number_format($totM5, 0, ',', '.'); ?></b></td>
                    <td><b><?php echo number_format($totM6, 0, ',', '.'); ?></b></td>
                    <td><b><?php echo number_format($totM7, 0, ',', '.'); ?></b></td>
                    <td><b><?php echo number_format($totM8, 0, ',', '.'); ?></b></td>
                    <td><b><?php echo number_format($totM9, 0, ',', '.'); ?></b></td>
                    <td><b><?php echo number_format($totM10, 0, ',', '.'); ?></b></td>
                    <td><b><?php echo number_format($totM11, 0, ',', '.'); ?></b></td>
                    <td><b><?php echo number_format($totM12, 0, ',', '.'); ?></b></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <br>
        <?php echo $this->Html->link('Imprimir calendario', array('controller' => 'Budgets', 'action' => 'print_calendar', $follow_id), array('target' => '_blank', 'indicator' => 'loading', 'class' => 'acciones', 'class' => 'acciones')); ?>
    </div>
</div>
<br>
<br>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Follows', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            <td><?php
        if ($cerrado == 0) {
            echo $this->Ajax->link("Cerrar", array('controller' => 'Follows', 'action' => 'close', $follow_id), array('class' => 'acciones', 'update' => 'content', 'indicator' => 'loading', 'escape' => false));
        } else {
            echo $this->Ajax->link("Abrir", array('controller' => 'Follows', 'action' => 'close', $follow_id), array('class' => 'acciones', 'update' => 'content', 'indicator' => 'loading', 'escape' => false));
        }
        ?></td>
        </tr>
    </tbody>
</table>
<br>