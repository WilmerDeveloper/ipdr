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
		<th><?php echo $this->Paginator->sort('Certification.id','ID'); ?></th>
		<th><?php echo $this->Paginator->sort('Certification.entidad','Entidad'); ?></th>
		<th><?php echo $this->Paginator->sort('Certification.nombre_certificacion','Nombre de la certificación'); ?></th>
		<th><?php echo $this->Paginator->sort('Certification.fecha_inicio','Fecha  de la certificación'); ?></th>
		<th><?php echo $this->Paginator->sort('Certification.fecha_fin','Fecha de vencimiento de la certificación'); ?></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $Certifications as $Certification):?>
		<tr>
		<td><?php echo $Certification['Certification']['id']; ?></td>
		<td><?php echo $Certification['Certification']['entidad']; ?></td>
		<td><?php echo $Certification['Certification']['nombre_certificacion']; ?></td>
		<td><?php echo $Certification['Certification']['fecha_inicio']; ?></td>
		<td><?php echo $Certification['Certification']['fecha_fin']; ?></td>
		<td><?php echo $this->Ajax->link('editar',array('controller'=>'Certifications','action'=>'edit',$Certification["Certification"]["id"]),array('update'=>'certificaciones','indicator'=>'loading')); ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>
		<?php echo $this->Ajax->link('Adicionar',array('controller'=>'Certifications','action'=>'add',$productive_poll_id),array('update'=>'certificaciones','indicator'=>'loading')); ?>
