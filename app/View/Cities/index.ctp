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
		<th><?php echo $this->Paginator->sort('City.name','Nombre'); ?></th>
		<th><?php echo $this->Paginator->sort('City.divipol','Divipol'); ?></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $Cities as $City):?>
		<tr>
		<td><?php echo $City['City']['name']; ?></td>
		<td><?php echo $City['City']['divipol']; ?></td>
		<td><?php echo $this->Ajax->link('editar',array('controller'=>'Cities','action'=>'edit',$City["City"]["id"]),array('update'=>'content','indicator'=>'loading')); ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>
		<?php echo $this->Ajax->link('Adicionar',array('controller'=>'Cities','action'=>'add'),array('update'=>'content','indicator'=>'loading')); ?>
