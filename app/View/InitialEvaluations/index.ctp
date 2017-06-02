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
            <th><?php echo $this->Paginator->sort('InitialEvaluation.id', ''); ?></th>
            <th><?php echo $this->Paginator->sort('User.nombre', 'Evaluador'); ?></th>
            <th><?php echo $this->Paginator->sort('InitialEvaluation.fecha_creacion', 'Fecha de creación'); ?></th>
            <th><?php echo $this->Paginator->sort('InitialEvaluation.calificacion_integral', 'Calificación integral'); ?></th>
            <th><?php echo $this->Paginator->sort('InitialEvaluation.concepto_tecnico_final', 'Concepto técnico final'); ?></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $conteo=1;$total=count($InitialEvaluations);?>
        <?php foreach ($InitialEvaluations as $InitialEvaluation): ?>
            <tr>
                <td><?php echo $InitialEvaluation['InitialEvaluation']['id']; ?></td>
                <td><?php echo $InitialEvaluation['User']['nombre'] . " " . $InitialEvaluation['User']['primer_apellido']; ?></td>
                <td><?php echo $InitialEvaluation['InitialEvaluation']['fecha_creacion']; ?></td>
                <td><?php echo $InitialEvaluation['InitialEvaluation']['calificacion_integral']; ?></td>
                <td><?php echo $InitialEvaluation['InitialEvaluation']['concepto_tecnico_final']; ?></td>
                <td></td>
                <td>
                    <br>
                    <?php if ($conteo==1 and $InitialEvaluation['InitialEvaluation']['calificacion_integral']!='VIABLE' ) echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluations', 'action' => 'edit', $InitialEvaluation["InitialEvaluation"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); else if($InitialEvaluation['InitialEvaluation']['calificacion_integral']!='VIABLE')   echo $this->Ajax->link('Editar', array('controller' => 'InitialEvaluations', 'action' => 'edit', $InitialEvaluation["InitialEvaluation"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones')); ?>
                    <br>
                    <br>
                    <?php
                    if ($group_id == 1) {
                        echo $this->Ajax->link('Subir_archivo', array('controller' => 'InitialEvaluations', 'action' => 'uploadFile', $InitialEvaluation["InitialEvaluation"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'));
                        echo"<br>";
                        echo"<br>";
                        echo $this->Ajax->link('Eliminar', array('controller' => 'InitialEvaluations', 'action' => 'delete', $InitialEvaluation["InitialEvaluation"]["id"]), array('update' => 'content', 'indicator' => 'loading', 'class' => 'acciones'),'¿Desea eliminar el registro?');
                        echo"<br>";
                        echo"<br>";
                        
                    }
                    ?>

                    <?php echo $this->Html->link('Imprimir resumen', array('controllers' => 'InitialEvaluations', 'action' => 'print_letter', $InitialEvaluation['InitialEvaluation']['id']), array('target' => 'blank', 'class' => 'acciones')) ?>
                    <br/>       
                    <br/>       
                    <?php echo $this->Html->link('Imprimir_Ficha_técnica', array('controllers' => 'InitialEvaluations', 'action' => 'print_card', $InitialEvaluation['InitialEvaluation']['id']), array('target' => 'blank', 'class' => 'acciones')) ?>

                    <br>
                    <br>
                    <?php echo $this->Html->link("Acta_de_socialización ", array('controller' => 'Beneficiaries', "action" => "representative_letter", $InitialEvaluation["InitialEvaluation"]["id"]), array('target' => 'blank', 'class' => 'acciones', 'complete' => 'formularioAjax()', 'indicator' => 'loading')) ?>


                </td>
            </tr>
            
        <?php $conteo++;  endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
<?php if($this->Session->read('bloqueado')!=1) echo $this->Ajax->link('Adicionar', array('controller' => 'InitialEvaluations', 'action' => 'add', $proyect_id), array('update' => 'content', 'indicator' => 'loading'), '¿Desea crear una nueva evaluación?'); ?>
