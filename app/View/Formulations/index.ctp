<div class="paging">
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table style="border: solid 1px;">
    <thead>
        <tr>
            <th></th>
            <th><?php echo $this->Paginator->sort('Formulation.calificacion_evaluador', 'Calificacion evaluador'); ?></th>
            <th><?php echo $this->Paginator->sort('Formulation.concepto_evaluador', 'concepto evaluador'); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Formulations as $Formulation): ?>
        <tr >
            <td style=" border: solid 1px;">
                <table style="border: solid 1px;border-color: #003E98;">

                    <tbody>
                        <tr>
                            <td>Formulador:</td>
                            <td><?php echo $Formulation['User']['nombre'] . " " . $Formulation['User']['primer_apellido']; ?></td>

                            <td>Fecha creación:</td>
                            <td><?php echo $Formulation['Formulation']['fecha_creacion']; ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Familias desplazadas</td>
                            <td><?php echo $Formulation['Formulation']['familias_desplazadas']; ?>&nbsp;</td>

                            <td>Familias campesinas</td>
                            <td><?php echo $Formulation['Formulation']['familias_campesinas']; ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Familias indigenas</td>
                            <td><?php echo $Formulation['Formulation']['familias_indigenas']; ?>&nbsp;</td>

                            <td>Familias negritudes</td>
                            <td><?php echo $Formulation['Formulation']['familias_negritudes']; ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Familias mujeres desplazadas</td>
                            <td><?php echo $Formulation['Formulation']['familias_mujer_cabeza']; ?>&nbsp;</td>

                            <td>Familias rom</td>
                            <td><?php echo $Formulation['Formulation']['familias_rom']; ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Linea productiva</td>
                            <td><?php echo $Formulation['Formulation']['seguridad_alimentaria']; ?>&nbsp;</td>

                            <td>Costo seguridad alimentaria</td>
                            <td><?php echo "$" . number_format($Formulation['Formulation']['costo_seguridad'], 0, ',', '.'); ?>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Observaciones</td>
                            <td colspan="3"><?php echo $Formulation['Formulation']['observaciones']; ?>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>



            </td>

            <td style=" border: solid 1px;"><?php echo $Formulation['Formulation']['calificacion_evaluador']; ?></td>
            <td style=" border: solid 1px;"><?php echo $Formulation['Formulation']['concepto_evaluador']; ?></td>
            <td style=" border: solid 1px;">
                    <?php //echo $this->Ajax->link('Editar', array('controller' => 'Formulations', 'action' => 'edit', $Formulation["Formulation"]["id"]), array('class' => 'acciones', 'update' => 'content', 'indicator' => 'loading')); ?>
                <br>
                <br>
                    <?php //if($this->Session->read('cerrado')!=1)
                    if($this->Session->read('bloqueado')!=1)
                    echo $this->Ajax->link('Revisión', array('controller' => 'Formulations', 'action' => 'review', $Formulation["Formulation"]["id"]), array('class' => 'acciones', 'update' => 'content', 'indicator' => 'loading', 'complete' => 'formularioAjax()'));
                    ?>
                    <?php
                    if (file_exists("../webroot/files/" . $Formulation['Formulation']['proyect_id'] . "-" . $Formulation['Proyect']['codigo'] . "/" . $Formulation['Formulation']['adjunto'])) {
                        echo"<br>";
                        echo"<br>";
                        echo $this->Html->link('Descargar_muf', "../files/" . $Formulation['Formulation']['proyect_id'] . "-" . $Formulation['Proyect']['codigo'] . "/" . $Formulation['Formulation']['adjunto'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    }
                    echo"<br>";
                    echo"<br>";
                    if (file_exists("../webroot/files/" . $Formulation['Formulation']['proyect_id'] . "-" . $Formulation['Proyect']['codigo'] . "/" . $Formulation['Formulation']['adjunto_resumen']) and $Formulation['Formulation']['adjunto_resumen'] != "") {
                        echo"<br>";
                        echo"<br>";
                        echo $this->Html->link('Descargar_resumen', "../files/" . $Formulation['Formulation']['proyect_id'] . "-" . $Formulation['Proyect']['codigo'] . "/" . $Formulation['Formulation']['adjunto_resumen'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                    }
                    ?>
                <br>
                <br>
    <?php if ($this->Session->read('cerrado') != 1) echo $this->Ajax->link('Eliminar', array('controller' => 'Formulations', 'action' => 'delete', $Formulation["Formulation"]["id"]), array('class' => 'acciones', 'update' => 'content', 'indicator' => 'loading'), "¿Desea eliminar el registro?"); ?>

            </td>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php //if($this->Session->read('cerrado')!=1):
if($this->Session->read('bloqueado')!=1):?>
<?php echo $this->Ajax->link('Adicionar', array('controller' => 'Formulations', 'action' => 'add', $proyect_id), array('update' => 'content', 'indicator' => 'loading')); ?>
<?php
         endif;?>