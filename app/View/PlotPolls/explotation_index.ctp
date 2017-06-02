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
		<th><?php echo $this->Paginator->sort('PlotPoll.documento_contractual','Documento contractual con el INCODER'); ?></th>
		<th><?php echo $this->Paginator->sort('PlotPoll.numero_documento_contractual','Acuerdo de financiamiento No'); ?></th>
		<th><?php echo $this->Paginator->sort('PlotPoll.acuerdo_financiamiento','Acuerdo de financiamiento No'); ?></th>
		<th><?php echo $this->Paginator->sort('PlotPoll.contrato_operacion','Contrato de operación y funcionamiento No'); ?></th>
		<th><?php echo $this->Paginator->sort('PlotPoll.fecha_inicio','Fecha de inicio'); ?></th>
		<th><?php echo $this->Paginator->sort('PlotPoll.fecha_terminacion','Fecha de terminación'); ?></th>
		
		</tr>
	</thead>
	<tbody>
<?php foreach ( $PlotPolls as $PlotPoll):?>
		<tr>
		<td><?php echo $PlotPoll['PlotPoll']['documento_contractual']; ?></td>
		<td><?php echo $PlotPoll['PlotPoll']['numero_documento_contractual']; ?></td>
		<td><?php echo $PlotPoll['PlotPoll']['acuerdo_financiamiento']; ?></td>
		<td><?php echo $PlotPoll['PlotPoll']['contrato_operacion']; ?></td>
		<td><?php echo $PlotPoll['PlotPoll']['fecha_inicio']; ?></td>
		<td><?php echo $PlotPoll['PlotPoll']['fecha_terminacion']; ?></td>
		
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<table>
	<thead>
		<tr>
		
		<th><?php echo $this->Paginator->sort('PlotPoll.duracion','Duración años'); ?></th>
		<th><?php echo $this->Paginator->sort('PlotPoll.familias_beneficiadas','Número de familias beneficiadas por el Proyecto productivo'); ?></th>
		<th><?php echo $this->Paginator->sort('PlotPoll.tipo_familias','Población Beneficiaria  '); ?></th>
		<th><?php echo $this->Paginator->sort('PlotPoll.fecha_desembolso','Fecha acta autorización desembolso'); ?></th>
		<th><?php echo $this->Paginator->sort('PlotPoll.valor_desembolzado','Valor desembolsado'); ?></th>
		<th><?php echo $this->Paginator->sort('PlotPoll.objeto','Objeto'); ?></th>
		<th><?php echo $this->Paginator->sort('PlotPoll.objeto','Área parcela'); ?></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ( $PlotPolls as $PlotPoll):?>
		<tr>
		
		<td><?php echo $PlotPoll['PlotPoll']['duracion']; ?></td>
		<td><?php echo $PlotPoll['PlotPoll']['familias_beneficiadas']; ?></td>
		<td><?php echo $PlotPoll['PlotPoll']['tipo_familias']; ?></td>
		<td><?php echo $PlotPoll['PlotPoll']['fecha_desembolso']; ?></td>
		<td><?php echo $PlotPoll['PlotPoll']['valor_desembolzado']; ?></td>
		<td><?php echo $PlotPoll['PlotPoll']['objeto']; ?></td>
		<td><?php echo $PlotPoll['PlotPoll']['area_ha'].",".$PlotPoll['PlotPoll']['area_m']."(h)"; ?></td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer();?>
				<?php echo $this->Ajax->link('editar',array('controller'=>'PlotPolls','action'=>'edit_explotation',$PlotPoll["PlotPoll"]["id"]),array('update'=>'explotation','indicator'=>'loading','class'=>'acciones')); ?>
