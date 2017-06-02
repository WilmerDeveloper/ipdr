<div class="paging">
<?php
echo $this->Paginator->options(array('update' => '#beneficiarios','evalScripts' => false));echo $this->Paginator->prev('< ' . __('Anterior'), array(), null, array('class' => 'prev disabled'));
echo $this->Paginator->numbers(array('separator' => ''));
echo $this->Paginator->next(__('Siguiente') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
<table>
	<thead>
		<tr>
		<th><?php echo $this->Paginator->sort('Beneficiary.tipo_identificacion','Tipo identificación'); ?></th>
		<th><?php echo $this->Paginator->sort('Beneficiary.numero_identificacion','Número'); ?></th>
		<th><?php echo $this->Paginator->sort('Beneficiary.nombres','Nombres '); ?></th>
		<th><?php echo $this->Paginator->sort('Beneficiary.primer_apellido','Primer apellido'); ?></th>
		<th><?php echo $this->Paginator->sort('Beneficiary.telefono','Télefono'); ?></th>
		<th><?php echo $this->Paginator->sort('Beneficiary.direccion','Dirección'); ?></th>
		<th><?php echo $this->Paginator->sort('Beneficiary.celular','Celular'); ?></th>
		<th><?php echo $this->Paginator->sort('Beneficiary.email','Email'); ?></th>
		<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($Beneficiaries as $Beneficiary):?>
		<tr>
		<td><?php echo $Beneficiary['Beneficiary']['tipo_identificacion']; ?></td>
		<td><?php echo $Beneficiary['Beneficiary']['numero_identificacion']; ?></td>
		<td><?php echo $Beneficiary['Beneficiary']['nombres']; ?></td>
		<td><?php echo $Beneficiary['Beneficiary']['primer_apellido']; ?></td>
		<td><?php echo $Beneficiary['Beneficiary']['telefono']; ?></td>
		<td><?php echo $Beneficiary['Beneficiary']['direccion']; ?></td>
		<td><?php echo $Beneficiary['Beneficiary']['celular']; ?></td>
		<td><?php echo $Beneficiary['Beneficiary']['email']; ?></td>
                <td>
                    <?php echo $this->Ajax->link("Editar", array('controller' => 'Beneficiaries', "action" => "follow_edit", $Beneficiary['Beneficiary']['id']), array('update' => 'beneficiarios', 'indicator' => 'loading', 'class' => 'acciones','complete'=>"formularioAjax()")) ?>
                </td>
		</tr>
<?php endforeach;?>
	</tbody>
</table>
<?php echo $this->Js->writeBuffer(); ?>
