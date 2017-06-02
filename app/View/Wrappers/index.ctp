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
		<th><?php echo $this->Paginator->sort('Wrapper.id','Id'); ?></th>
		<th><?php echo $this->Paginator->sort('Wrapper.tipo','Tipo de Empaque'); ?></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $Wrappers as $Wrapper):?>
		<tr>
		<td><?php echo $Wrapper['Wrapper']['id']; ?></td>
		<td><?php echo $Wrapper['Wrapper']['tipo']; ?></td>
		<td><?php echo $this->Ajax->link('editar',array('controller'=>'Wrappers','action'=>'edit',$Wrapper["Wrapper"]["id"]),array('update'=>'empaques','indicator'=>'loading')); ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>
		<?php echo $this->Ajax->link('Adicionar',array('controller'=>'Wrappers','action'=>'add',$productive_poll_id),array('update'=>'empaques','indicator'=>'loading')); ?>
