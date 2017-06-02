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
                                <td>Depertamento: <?php echo $FamilyPoll['Departament']['name'] ?></td>
                                <td>Municipio: <?php echo $FamilyPoll['City']['name'] ?></td>
                            </tr>
                            <tr>
                                <td>Vereda: <?php echo $FamilyPoll['FamilyPoll']['vereda'] ?></td>
                                <td>Corregimiento: <?php echo $FamilyPoll['FamilyPoll']['corregimiento'] ?></td>
                            </tr>
                            <tr>
                                <td>Predio: <?php echo $FamilyPoll['Property']['nombre'] ?></td>
                                <td>Área del predio: <?php echo $FamilyPoll['FamilyPoll']['area_predio'] ?></td>
                            </tr>
                            <tr>
                                <td>Área de la parcela: <?php echo $FamilyPoll['FamilyPoll']['area_parcela'] ?></td>
                                <td>Nombre del resguardo: <?php echo $FamilyPoll['FamilyPoll']['nombre_resguardo'] ?></td>
                            </tr>
                            <tr>
                                <td>Nombre del consejo comunitario: <?php echo $FamilyPoll['FamilyPoll']['nombre_resguardo'] ?></td>
                                <td></td>
                            </tr>
                          
                    </table>

                </td>

                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'FamilyPolls', 'action' => 'edit_identification', $FamilyPoll["FamilyPoll"]["id"]), array('update' => 'identificacion', "class" => 'acciones', 'indicator' => 'loading', 'complete' => 'formularioAjax()')); ?></td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>

