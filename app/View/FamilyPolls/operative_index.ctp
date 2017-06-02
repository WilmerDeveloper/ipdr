<div class="paging">
    <br>    
    <?php
    echo $this->Paginator->counter(array(
        'format' => 'Página %page% de %pages%, Mostrando %current% registros de %count% totales, empezando en %start%, terminando en %end%'
            )
    );
    ?>
    <br>
    <?php
    echo $this->Paginator->options(array('update' => '#content', 'evalScripts' => false));
    echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
    echo $this->Paginator->numbers(array('separator' => ''));
    echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
</div>
<table>

    <tbody>
<?php foreach ($FamilyPolls as $FamilyPoll): ?>
            <tr>
                <td>
                    <table border="1">
                           
                            <tr>
                                 <td>Número del formulario:</td>
                                <td><?php echo $FamilyPoll['FamilyPoll']['codigo_formulario'] ?></td>
                               
                            </tr>
                            <tr>
                                <td>Fecha de la Entrevista: <?php echo $FamilyPoll['FamilyPoll']['fecha_entrevista'] ?></td>
                                <td>Número de visitas <?php echo $FamilyPoll['FamilyPoll']['numero_visitas'] ?></td>
                            </tr>
                            <tr>
                                <td>Encuestador: <?php echo $FamilyPoll['FamilyPoll']['nombre_encuestador'] ?></td>
                                <td>Institución: <?php echo $FamilyPoll['FamilyPoll']['nombre_aliado'] ?></td>
                            </tr>
                            
                            
                    </table>

                </td>

                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'FamilyPolls', 'action' => 'edit_operative', $FamilyPoll["FamilyPoll"]["id"]), array('update' => 'control_operativo', "class" => 'acciones', 'indicator' => 'loading', 'complete' => 'formularioAjax()')); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>

