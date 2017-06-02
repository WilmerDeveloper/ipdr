<div class="paging">
<?php
echo $this->Paginator->options(array('update' => '#content','evalScripts' => false));
echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
<table>
	<thead>
		<tr>
		<th><?php echo $this->Paginator->sort('Departament.name','Nombre'); ?></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $Departaments as $Departament):?>
		<tr>
		<td><?php echo $Departament['Departament']['name']; ?></td>
		<td><?php echo $this->Ajax->link('editar',array('controller'=>'Departaments','action'=>'edit',$Departament["Departament"]["id"]),array('update'=>'content','indicator'=>'loading','complete'=>'formularioAjax()')); ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>
		<?php echo $this->Ajax->link('Adicionar',array('controller'=>'Departaments','action'=>'add'),array('update'=>'content','indicator'=>'loading','complete'=>'formularioAjax()')); ?>
