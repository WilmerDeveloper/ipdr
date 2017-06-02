<table border=1 width="4">
    <tbody>
    <td colspan="5"><center>
        <h1>INFORMACION DEL PREDIO</h1>
    </center></td>
<tr>
    <td>
        Nombre del predio:
        <?php echo $property['Property']['nombre'] ?>
    </td>
    <td>
        Matricula catastral:
        <?php echo $property['Property']['matricula'] ?>
    </td>
    <td>
        Codigo catastral:
        <?php echo $property['Property']['cedula_catastral'] ?>
    </td>
    <td>
        Departamento:
        <?php echo $property['Departament']['name'] ?>
    </td>
    <td>
        Municipio:
        <?php echo $property['City']['name'] ?>
    </td>
</tr> 
<tr>
    <td>
        Vereda:
        <?php echo $property['Property']['vereda'] ?>
    </td>
    <td>
        Corregimiento:
        <?php echo $property['Property']['corregimiento'] ?>
    </td>
    <td colspan="2">
        Oficina de registro:
        <?php echo $property['Property']['oficina_registro'] ?>
    </td>
    <td>
        Origen:
        <?php echo $property['Property']['origen'] ?>
    </td>
</tr>
<tr>
    <td>
        Total area en hectareas:
        <?php echo $property['Property']['area_total_ha'] ?>
    </td>
    <td>
        Total area en metros:
        <?php echo $property['Property']['area_total_m'] ?>
    </td>
    <td>
        Uaf:
        <?php echo $property['Property']['uaf'] ?>
    </td>

    <td>
        Familias campesinas:
        <?php echo $property['Property']['familias_campesinas'] ?>
    </td>

    <td>
        Madres cabeza de familia:
        <?php echo $property['Property']['madres_cabeza'] ?>
    </td>
</tr>
<tr>
    <td>
        Familias desplazadas:
        <?php echo $property['Property']['familias_desplazadas'] ?>
    </td>
    <td>
        Familias negritudes:
        <?php echo $property['Property']['familias_negritudes'] ?>
    </td>
    <td>
        Familias indigenas:
        <?php echo $property['Property']['familias_indigenas'] ?>
    </td>
    <td colspan="2">
        Otras familias:
        <?php echo $property['Property']['otras_familias'] ?>
    </td>
</tr>
<tr>
    <td colspan="5">
        Actividad productiva actual:
        <?php echo $property['Property']['actividad_productiva'] ?>
    </td>
</tr>   
<tr>
    <td colspan="3">  
        Nombre de la organizacion:
        <?php echo $property['Property']['nombre_organizacion'] ?>
    </td>
    <td colspan="2">  
        Total familias beneficiarios:
        <?php echo $property['Property']['total_familias_beneficiarios'] ?>
    </td>
</tr>   
<td colspan="5"><center>
    <h1>COORDENADAS GEOGRAFICAS DEL PREDIO</h1>
</center></td>
<tr>
    <td colspan="2"> 
        Georeferenciación 
        <br>
        (latitud-grado):
        <?php echo $property['Property']['georeferencia1'] ?>
        <br>
        (latitud-minuto):
        <?php echo $property['Property']['georeferencia2'] ?>
        <br>
        (latitud-segundo):
        <?php echo $property['Property']['georeferencia3'] ?>
        <br>
    </td>
    <td colspan="2">  
        Georeferenciación 
        <br>
        (longitud-grado):
        <?php echo $property['Property']['georeferencia3'] ?>
        <br>
        (longitud-minuto):
        <?php echo $property['Property']['georeferencia4'] ?>
        <br>
        (longitud-segundo):
        <?php echo $property['Property']['georeferencia5'] ?>
        <br>
    </td>
    <td> 
        Dato de origen:
        <?php echo $property['Property']['dato_origen'] ?>
    </td>
</tr>   
</tbody>
</table>
<table class="index">
    <thead>
        <tr>
            <th>ARCHIVOS PARA DESCARGAR</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <?php
                if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['ruta_resolucion']) and $property['Property']['ruta_resolucion'] != "")
                    echo $this->Html->link('Resolución', "../files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['ruta_resolucion'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['ruta_matricula']) and $property['Property']['ruta_matricula'] != "")
                    echo $this->Html->link('Matrícula inmobiliaria', "../files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['ruta_matricula'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br><br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_distrito']) and $property['Property']['archivo_distrito'] != "")
                    echo $this->Html->link('Certificación_distrito_de_riego.', "../files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_distrito'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_uso_suelo']) and $property['Property']['archivo_uso_suelo'] != "")
                    echo $this->Html->link('Uso del suelo.', "../files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_uso_suelo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_resguardo']) and $property['Property']['archivo_resguardo'] != "")
                    echo $this->Html->link('Certificación resguardo indígena.', "../files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_resguardo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
                <br>
                <br>
                <?php
                if (file_exists("../webroot/files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_consejo']) and $property['Property']['archivo_consejo'] != "")
                    echo $this->Html->link('Certificación consejo comunitario.', "../files/Predio-" . $property["Property"]["id"] . "/" . $property['Property']['archivo_consejo'], array('target' => 'blank', 'indicator' => 'loading', 'class' => 'acciones'));
                ?>
            </td>
        </tr>
    </tbody>
</table>
<table width="100%" border="0"  CellSpacing=10  align="center" >
    <tbody>
        <tr>          
            <td><?php echo $this->Ajax->link($this->Html->image('regresar.gif', array('width' => '30', 'heigth' => '30', 'alt' => 'Regresar', 'title' => 'Regresar')), array('controller' => 'Properties', 'action' => 'property_index', $property_id), array('update' => 'content', 'indicator' => 'loading', 'escape' => false)); ?></td>
        </tr>
    </tbody>
</table>