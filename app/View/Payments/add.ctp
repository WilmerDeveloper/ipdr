
<?php echo $this->Form->create("Payment", array('class' => 'form', "action" => "add/" . $proyect_id)); ?>
<?php echo $this->Form->hidden('Payment.proyect_id', array('type' => 'text', 'value' => $proyect_id)); ?>

<h1><center>INGRESO DEL DESEMBOLSO</center></h1>
<table border="0" width="100%">
    <tbody>
        <?php if ($group_id == 1 or $group_id == 6): ?>
        <tr>
            <td><?php echo $this->Form->input('Payment.fecha_radicacion', array('class' => 'calendario', 'type' => 'text')); ?></td>
            <td><?php echo $this->Form->input('Payment.fecha_desembolso', array('class' => 'calendario', 'type' => 'text')); ?></td>
        </tr>

        <tr>
            <td>
                    <?php echo $this->Form->input('Payment.tipo', array('empty' => '', 
                        'options' => array(
                        'Campesinos' => 'Campesinos',
                        'Desplazados' => 'Desplazados', 
                            'Contrato plan' => 'Contrato plan', 
                            'Contrato plan cadena de valor' => 'Contrato plan cadena de valor', 
                            'Desplazados Cadena de valor' => 'Desplazados Cadena de valor',
                            'Campesinos PDRET cadena de valor' => 'Campesinos PDRET cadena de valor',
                            'Desplazados PDRET cadena de valor' => 'Desplazados PDRET cadena de valor',
                            'Campesinos 2015' => 'Campesinos 2015',
                            'Desplazados 2015' => 'Desplazados 2015'
                            ))); ?>
            </td>
            <td><?php echo $this->Form->input('Payment.beneficiary_id', array('label' => 'Beneficiario', 'empty' => '', 'class' => 'required')); ?></td> 


        </tr>
        <tr>
            <td><?php echo $this->Form->input('Payment.valor_desembolsado', array('type' => 'number', 'class' => 'required')); ?></td> 
            <td><?php echo $this->Form->input('Payment.cuenta_beneficiario'); ?></td> 
        </tr>
        <tr>
            <td><?php echo $this->Form->input('Payment.tipo_cuenta_beneficiario', array('label' => 'Tipo de cuente del beneficiario', 'empty' => '', 'options' => array('Ahorros' => 'Ahorros', 'Corriente' => 'Corriente'))); ?></td> 
            <td><?php echo $this->Form->input('Payment.banco_beneficiario', array('label' => 'Banco del beneficiario')); ?></td> 
        </tr>
        <?php endif; ?>

        <tr>

            <td colspan="2"><?php echo $this->Form->input('Payment.observaciones'); ?></td>
        </tr>



    </tbody>

</table>



<?php echo $this->Form->end(array('label' => 'Guardar', 'class' => 'submit_button')); ?>

<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Payments', 'action' => 'index'), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>