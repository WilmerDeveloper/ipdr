
<table border="1">

    <tbody>
        <tr>
            <td>Nombre del Propietario Cabeza de Familia o Jefe:<?php echo $beneficiario['Beneficiary']['nombres'] . ' ' . $beneficiario['Beneficiary']['primer_apellido'] ?> </td>
            <td>Tipo de identificación: <?php echo $beneficiario['Beneficiary']['tipo_identificacion'] ?></td>
            <td>Número de identificaion: <?php echo $beneficiario['Beneficiary']['numero_identificacion'] ?></td>
            <td><?php  echo $this->Ajax->link('Editar',array('controller'=>'Beneficiaries','action'=>'edit_generalidades',$beneficiario['Beneficiary']['id'] ),array('update'=>'generalidades','class'=>'acciones','indicator'=>'loading','complete'=>'')); ?></td>
        </tr>
        <tr>
            <td>Sexo: <?php echo $beneficiario['Beneficiary']['genero'] ?></td>
            <td>Edad: <?php echo $beneficiario['Beneficiary']['edad'] ?></td>
            <td> Teléfono fijo :<?php echo $beneficiario['Beneficiary']['telefono'] ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Celular: <?php echo $beneficiario['Beneficiary']['celular'] ?></td>
            <td>Correo electrónico: <?php echo $beneficiario['Beneficiary']['email'] ?></td>
            <td>Lugar de residencia del propietario del predio: <?php echo $beneficiario['Beneficiary']['lugar_residencia'] ?></td>
            <td></td>
        </tr>
        <tr>
            <td>Tiempo de residencia en el predio: <?php echo $beneficiario['Beneficiary']['tiempo_residencia'] ?></td>
            <td>Número de personas que conforman el hogar:<?php echo $beneficiario['Beneficiary']['numero_personas'] ?></td>

            <td></td>
            <td></td>
        </tr>
        
    </tbody>
</table>
