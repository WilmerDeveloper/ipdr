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
            <th><?php echo $this->Paginator->sort('Proyect.codigo', 'Proyecto'); ?></th>
            <th><?php echo $this->Paginator->sort('Property.nombre', 'Predio'); ?></th>
            <th><?php echo $this->Paginator->sort('Candidate.primer_nombre', 'Primer nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('Candidate.primer_apellido', 'Primer apellido'); ?></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($Candidates as $Candidate): ?>
            <tr>
                <td><?php echo $Candidate['Proyect']['codigo']; ?></td>
                <td><?php echo $Candidate['Property']['nombre']; ?></td>
                <td><?php echo $Candidate['Candidate']['primer_nombre']; ?></td>
                <td><?php echo $Candidate['Candidate']['primer_apellido']; ?></td>
                <td><?php echo $this->Ajax->link('Seleccionar', array('controller' => 'Candidates', 'action' => 'select', $Candidate["Candidate"]["id"]), array('update' => 'candidate', 'indicator' => 'loading')); ?></td>
                <td><?php echo $this->Ajax->link('Editar', array('controller' => 'Candidates', 'action' => 'edit', $Candidate["Candidate"]["id"]), array('update' => 'content', 'indicator' => 'loading','complete'=>'formularioAjax()')); ?></td>
                <td><?php echo $this->Ajax->link('Eliminar', array('controller' => 'Candidates', 'action' => 'delete', $Candidate["Candidate"]["id"]), array('update' => 'content', 'indicator' => 'loading'), '¿Realmente desea borrar el registro?'); ?></td>
                <td><?php echo $this->Ajax->link('Familiares', array('controller' => 'Relatives', 'action' => 'index', $Candidate["Candidate"]["id"]), array('update' => 'content', 'indicator' => 'loading')); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>

<?php
if (empty($Candidates))
    echo $this->Ajax->link('Adicionar', array('controller' => 'Candidates', 'action' => 'add', $poll_id), array('update' => 'content', 'indicator' => 'loading','complete'=>'formularioAjax()'));
?>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'FamilyPolls', 'action' => 'index', $poll_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>