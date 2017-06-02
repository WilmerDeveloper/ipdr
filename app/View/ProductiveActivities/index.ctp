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
		<th><?php echo $this->Paginator->sort('ProductiveActivity.nombre','Nombre '); ?></th>
		<th><?php echo $this->Paginator->sort('ProductiveActivity.tipo','Tipo'); ?></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $ProductiveActivities as $ProductiveActivity):?>
		<tr>
		<td><?php echo $ProductiveActivity['ProductiveActivity']['nombre']; ?></td>
		<td><?php echo $ProductiveActivity['ProductiveActivity']['tipo']; ?></td>
		<td><?php echo $this->Ajax->link('editar',array('controller'=>'ProductiveActivities','action'=>'edit',$ProductiveActivity["ProductiveActivity"]["id"]),array('update'=>'content','indicator'=>'loading','complete'=>'formularioAjax()')); ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>
		<?php echo $this->Ajax->link('Adicionar',array('controller'=>'ProductiveActivities','action'=>'add'),array('update'=>'content','indicator'=>'loading','complete'=>'formularioAjax()')); ?>
