<div class="paging">
<?php
echo $this->Paginator->options(array('update' => '#content','evalScripts' => false));echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
<table>
	<thead>
		<tr>
		<th><?php echo $this->Paginator->sort('Synchronization.user_id',''); ?></th>
		<th><?php echo $this->Paginator->sort('Synchronization.server_id',''); ?></th>
		<th><?php echo $this->Paginator->sort('Synchronization.local_id',''); ?></th>
		<th><?php echo $this->Paginator->sort('Synchronization.tabla',''); ?></th>
		<th><?php echo $this->Paginator->sort('Synchronization.id',''); ?></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $Synchronizations as $Synchronization):?>
		<tr>
		<td><?php echo $Synchronization['Synchronization']['user_id']; ?></td>
		<td><?php echo $Synchronization['Synchronization']['server_id']; ?></td>
		<td><?php echo $Synchronization['Synchronization']['local_id']; ?></td>
		<td><?php echo $Synchronization['Synchronization']['tabla']; ?></td>
		<td><?php echo $Synchronization['Synchronization']['id']; ?></td>
		<td><?php echo $this->Ajax->link('editar',array('controller'=>'Synchronizations','action'=>'edit',$Synchronization["Synchronization"]["id"]),array('update'=>'content','indicator'=>'loading')); ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>
		<?php echo $this->Ajax->link('Adicionar',array('controller'=>'Synchronizations','action'=>'add'),array('update'=>'content','indicator'=>'loading')); ?>
