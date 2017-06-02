
<table border="1">

    <tbody>
        <tr>
            <td>Ocupación:<?php echo $beneficiario['Beneficiary']['ocupacion']  ?> </td>
            <td>Escolaridad: <?php echo $beneficiario['Beneficiary']['escolaridad'] ?></td>
            <td>Enfermedad  o Discapacidad:  <?php echo $beneficiario['Beneficiary']['discapacidad'] ?></td>
            <td><?php  echo $this->Ajax->link('Editar',array('controller'=>'Beneficiaries','action'=>'social_edit',$beneficiario['Beneficiary']['id'] ),array('update'=>'social','class'=>'acciones','indicator'=>'loading','complete'=>'')); ?></td>
        </tr>
        <tr>
            <td>Afiliación en salud:   <?php echo $beneficiario['Beneficiary']['seguridad_social'] ?></td>
            <td>Nivel sisben: <?php echo $beneficiario['Beneficiary']['nivel_sisben'] ?></td>
            <td> </td>
            <td></td>
        </tr>
       
        
    </tbody>
</table>
