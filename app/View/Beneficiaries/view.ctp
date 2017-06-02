<table border=1 width="4">

    <tbody>
        <td colspan="5"><center>
            <h1>INFORMACION DE BENEFICIARIOS</h1>
        </center></td>
        
        <tr>
           <td>
            Identificacion:
            <?php echo  $beneficiary['Beneficiary']['tipo_identificacion']?>
            <?php echo $beneficiary['Beneficiary']['numero_identificacion'] ?>
            </td> 
            
            <td>
            Nombres:
            <?php echo  $beneficiary['Beneficiary']['nombres']?>
            </td> 
            <td>
            Primer apellido:
            <?php echo  $beneficiary['Beneficiary']['primer_apellido']?>
            </td> 
            <td>
            Segundo apellido:
            <?php echo  $beneficiary['Beneficiary']['segundo_apellido']?>
            </td>
            
            
        </tr>
        
         <tr>
            <td>
            Fecha de nacimiento:
            <?php echo  $beneficiary['Beneficiary']['fecha_nacimiento']?>
            </td> 
            <td>
            Genero:
            <?php echo  $beneficiary['Beneficiary']['genero']?>
            </td> 
            <td>
            Tipo de beneficiario:
            <?php echo  $beneficiary['Beneficiary']['tipo']?>
            </td> 
            <td>
            Telefono:
            <?php echo  $beneficiary['Beneficiary']['telefono']?>
            </td> 
         <tr>
             <td colspan="4">
            Direccion:
            <?php echo  $beneficiary['Beneficiary']['direccion']?>
            </td> 
         </tr>
            
            <tr>
            <td colspan="2">
            Numero de resolucion:
            <?php echo  $beneficiary['Beneficiary']['numero_resolucion']?>
            </td> 
            <td colspan="2">
            Fecha de resolucion:
            <?php echo  $beneficiary['Beneficiary']['fecha_resolucion']?>
            </td> 
            </tr>
        
        
        
         </tr>
        
         </tbody>
</table>


<table width="100%" border="0"  CellSpacing=10  align="center" >
        <tbody>
            <tr>          
                <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Beneficiaries', 'action' => 'total_index',$beneficiary['Beneficiary']['property_id']), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
            </tr>
        </tbody>
    </table>