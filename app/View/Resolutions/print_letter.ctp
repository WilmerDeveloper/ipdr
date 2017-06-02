<?php

App::import('Vendor', 'tcpdf/tcpdf');
//App::import('Vendor', 'tcpdf/config/lang/eng.php');
App::import('Vendor', 'EnLetras', array('file' => 'EnLetras.class.php'));

class MYPDF extends TCPDF {

    var $resolucion;
    var $flag = 0;

    //Page header
    public function Header() {

        $fecha = $this->resolucion['Resolution']['fecha'];
        $anio = explode("-", $fecha);
        $anio = $anio[0];
        $bMargin = $this->getBreakMargin();
        // get current auto-page-break mode
        $auto_page_break = $this->AutoPageBreak;
        // disable auto-page-break
        $this->SetAutoPageBreak(false, 0);

        $de = str_replace("\n", "", $this->getAliasNbPages());
        $tabla = '<table border="0"><tr><td width="120px">RESOLUCIÓN</td><td width="30px"></td><td>DE ' . $anio . ' </td><td width="100px"></td><td width="150px">HOJA No ' . $this->getAliasNumPage() . ' DE ' . $de . '</td></tr></table>';
        //$this->writeHTML("<br>$tabla", true, false, false, false, '');
        //$this->SetFont('Trebuchet', '', 7);
        $tx = "";
        if ($this->flag == 1) {
                $tx.= '<span style="text-align:center; font-size:smaller" ><br> Continuación de la Resolución "Por medio de la cual se reconoce una cofinanciación para proyecto productivo"</span><br><br>';
        }

        $img_file = '../webroot/img/rectangulo.jpg';
        $this->writeHTML("<br>$tabla", true, false, false, false, '');
        $this->Image($img_file, 10, 10, 200, 300, '', '', '', false, 300, '', false, false, 0);
        $this->writeHTML("<br>$tx", true, false, false, false, '');

        // restore auto-page-break status
        $this->SetAutoPageBreak($auto_page_break, $bMargin);
        // set the starting point for the page content
        $this->setPageMark();
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        // $this->SetY(-20);

        $this->Image('../webroot/img/rectangulo.jpg', 0, 240, 230, 30, 'PNG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 1, false, false, false);
    }

}

$pdf = new MYPDF("P", 'mm', "FOLIO", true, 'UTF-8', false);
//$pdf->setPrintHeader(false);
$pdf->resolucion = $resolucion;
$pdf->setPrintFooter(false);
$pdf->SetMargins(25, 25, 25);

$pdf->setPageOrientation("P", true, 25);
$pdf->AddPage();
$pdf->flag = 1;
$fecha = explode("-", $resolucion['Resolution']['fecha']);
$anio = $fecha[0];
$pdf->SetFont('Trebuchet', '', 12);
$img_file = '../webroot/img/escudoResolucion.jpg';
$pdf->Image($img_file, 98, 0, 30, 30, '', '', '', false, 300, '', false, false, 0);
$EnLetras = new EnLetras();
$valor_total = $EnLetras->ValorEnLetras($evaluacion['InitialEvaluation']['valor_total'], 'PESOS');
$monto_solicitado = $EnLetras->ValorEnLetras($evaluacion['InitialEvaluation']['monto_solicitado'], 'PESOS');
$contrapartida = $EnLetras->ValorEnLetras($evaluacion['InitialEvaluation']['valor_total'] - $evaluacion['InitialEvaluation']['monto_solicitado'], 'PESOS');
$str = '<br><br><span style="text-align:center;" >INSTITUTO COLOMBIANO DE DESARROLLO RURAL-INCODER - EN LIQUIDACIÓN</span><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = 'RESOLUCIÓN NÚMERO                  DE ' . $anio;
$pdf->Cell(0, 0, $str, 0, 1, 'C', 0, '', 0);
$pdf->Cell(0, 0, "(                                         )", 0, 1, 'C', 0, '', 0);
$codigo = strtoupper($resolucion['Proyect']['codigo']);
$pdf->SetFont('Trebuchet', '', 10);


    $str = '<br><br><span style = "text-align:center;" >"Por medio de la cual se reconoce una cofinanciación para proyecto productivo" </span><br><br>';


$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 12);
$str = '<span style = "text-align:center;" >EL DIRECTOR TERRITORIAL ' . strtoupper($resolucion['Departament']['name']) . ' DEL INSTITUTO COLOMBIANO DE DESARROLLO RURAL - INCODER - EN LIQUIDACIÓN, </span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 10);


    $str = '<span style = "text-align:justify;" >En ejercicio de sus facultades legales y en especial las conferidas por la Ley 160 de 1994, Decreto único Reglamentario No. 1071 del 26 de mayo de 2015, Decreto 2365 del 07 de diciembre de 2015, Resolución No. 00007 del 07 de diciembre de 2015, Resolución No. 00015 del 11 de diciembre de 2015, Circular interna No. 005 del 15 de diciembre de 2015 y</span><br><br>';


$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 12);
$str = '<span style = "text-align:center;" >CONSIDERANDO:</span><br><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$pdf->SetFont('Trebuchet', '', 10);


    $str = '<span style = "text-align:justify;font-style:italic" >Que el artículo 2° de la Constitución Política señala que son fines esenciales del Estado el servir a la comunidad, promover la prosperidad general y garantizar la efectividad de los principios, derechos y deberes consagrados en la Constitución. <br><br>Que el artículo 64 superior establece como deber del Estado promover el acceso progresivo a la propiedad de la tierra de los trabajadores agrarios, en forma individual o asociativa, a la comercialización de los productos, asistencia técnica y empresarial, con el fin de mejorar el ingreso y calidad de vida de los campesinos.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que por su parte, el artículo 209 Constitucional establece que la función administrativa está al servicio de los intereses generales y se desarrolla con fundamento en los principios de igualdad, moralidad, eficacia, economía, celeridad, imparcialidad y publicidad, mediante la descentralización, la delegación y la desconcentración de funciones.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que la Constitución Política de 1991 otorga al trabajador del campo y en general al sector agropecuario, un tratamiento particularmente diferente al de otros sectores de la sociedad y de la producción que se encuentra justificación en la necesidad de establecer una igualdad no sólo jurídica si no económica, social y cultural para los protagonistas del agro, partiendo del supuesto de que el fomento de esta actividad trae consigo la prosperidad de los otros sectores económicos y que en función del INCODER buscar mejorar las condiciones de la población campesina.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que artículo 3° de la ley 1437 de 2011 determina que las actuaciones administrativas se desarrollaran especialmente, con arreglo a los principios del debido proceso, igualdad, imparcialidad, buena fe, moralidad, participación, responsabilidad, transparencia, publicidad, coordinación, eficacia, económia, y celeridad.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que dentro de este marco constitucional, la Ley 160 de 1994 tiene entre sus objetivos promover y consolidar la paz, a través de mecanismos encaminados a lograr el bienestar de la población campesina, reformar la estructura social agraria, eliminar y prevenir la inequitativa concentración de la propiedad rústica o su fraccionamiento antieconómico, elevar el nivel de vida de la población campesina, generar empleo productivo en el campo y asegurar la coordinación y cooperación de las diversas entidades del Estado, para el desarrollo integral de los programas respectivos.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que conforme al Decreto 3759 de 2009, el INCODER, tiene por objeto ejecutar la política agropecuaria y de desarrollo rural, facilitar el acceso a los factores productivos, propiciar la articulación de las acciones institucionales en el medio rural, bajo principios de competitividad, equidad, sostenibilidad, multifuncionalidad y descentralización, para contribuir a mejorar la calidad de vida de los pobladores rurales y al desarrollo socioeconómico del país.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que el INCODER, en cumplimiento de sus objetivos y funciones misionales debe promover e impulsar los procesos de formulación, ejecución, evaluación y seguimiento de programas y proyectos encaminados a mejorar los ingresos y las condiciones de vida de los productores rurales, focalizando los esfuerzos en las familias que han sido beneficiarias de acceso a la tierra y/o programas misionales del Instituto, que requieren la complementación de sus factores productivos, mediante el impulso e Implementación de Proyectos Productivos de Desarrollo Rural.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que el INCODER dentro de sus funciones tiene las de cofinanciar planes, programas y proyectos de inversión para la ejecución de programas de desarrollo agropecuario y rural en los territorios en donde se establezcan áreas de actuación, así como la de promover procesos de capacitación a las comunidades rurales y étnicas en asuntos de organización acceso y uso de los factores productivos, asistencia técnica, formación socio-empresarial y gestión de proyectos y prestar asesoría a los aspirantes a las distintas clases de subsidios sin perjuicio de las que presten otras entidades, así como desarrollar programas de apoyo a la gestión empresarial rural y a la integración de las entidades del sector.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que el Consejo Directivo del INCODER profirió el Acuerdo 344 del 16 de diciembre de 2014. "Por el cual se reglamenta el programa de financiación y cofinanciación de proyectos productivos de desarrollo rural con enfoque territorial en la áreas de actuación del INCODER", el cual fue publicado en el Diario Oficial N. 49.415 del 4 de febrero de 2015.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que dicho programa tiene como objetivo Planificar, cofinanciar e implementar proyectos de desarrollo rural con enfoque territorial dentro de las áreas focalizadas y priorizadas por el Instituto, atendiendo principalmente aquellas que defina el Gobierno Nacional para realizar intervenciones integrales, promoviendo el ordenamiento económico, social y ambiental de los territorios rurales, con el fin de contribuir a la reducción de la pobreza rural, fortaleciendo la capacidad de generación de ingresos, insertando a la población en las cadenas productivas, mejorando las condiciones de vida de la población rural, y aumentando la competitividad de la producción regional.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que a través del programa de financiación y cofinanciación de proyectos productivos de desarrollo ruarl con enfoque territorial con las áreas de actuación del INCODER, se pretende garantizar un fortalecimiento e impulso productivo de las familias a beneficiar a través de la cofinanciación de proyectos estratégicos de desarrollo rural y de generación de ingresos que con un acompañamiento integral se logren  formular de manera participativa, y que además garantice también la implementación en rigor de los mismos, su ejercicio operativo, desarrollo productivo e ingreso a cadenas de valor con la respectiva asistencia técnica integral, como es el caso de las 35 cadenas agropecuarias que existen en el Ministerio de Agricultura y Desarrollo Rural, así como la actuación a traves del esquema asociativo.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que la cofinanciación de los proyectos productivos se sustenta en la viabilidad desde el punto de vista técnico, financiero, económico y social, y se soporta en las ventajas comparativas de la región y la competitividad de las actividades emprendidas; enmarcados en líneas de desarrollo agroindustrial, infraestructura productiva, agrícola, pecuaria, piscícola, acuícola, forestal y/o complementarios que respondan de manera estratégica a las dinámicas económicas que se planteen o visualicen en el territorio, de acuerdo a la formulación del proyecto en particular.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que el número de salarios mínimos estimados tiene un carácter de asignación individual por familia, para efectulo del cálculo tanto de cobertura de familias con la vigencia presupuestal como también para guiar la formulación y alcance de los proyectos.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que con base en las disposiciones de los manuales, procedimientos y demas documentos que reglamentan el programa, los aspirantes de la cofinanciación para proyectos de desarrollo rural, surtieron un proceso de verificación, que comprende la acreditación de los requisitos relacionados con las calidades requeridas para los aspirantes.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que así mismo, los aspirantes de la cofinanciación para proyectos de desarrollo rural surtieron un proceso de verificación técnica y jurídica, que comprende la acreditación de los requisitos relacionados con las calidades requeridas para los aspirantes.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que igualmente, se adelantaron las actividades previstas en el acuerdo mencionado, respecto de la verificación de las condiciones jurídicas y técnicas del (los) predio(s) en donde se implementará el proyecto de desarrollo rural.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que para adelantar las actividades propias del procedimiento para el desarrollo del proyecto se realizó la visita al (los) predio (s), posterior a ello se realizó la caracterización y diagnostico tanto de las familias como de los predios, información que reposa en el aplicativo informático desarrollado por el Instituto para el seguimiento, monitoreo y evaluación de la intervención.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que a través de un diagnóstico participativo, los beneficiarios del programa recibieron un acompañamiento permanente para la identificación de su necesidad y la formulación participativa de la iniciativa productiva, logrando de esta manera la construcción de un Proyecto socializado y avalado por todos los beneficiarios con su compromiso de desarrollarlo, lo anterior mediante actas suscritas por los beneficiarios.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que la formulación integral contempló todos los componentes y variables que garantizan la viabilidad técnica, financiera, comercial, ambiental y social de los proyectos productivos.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que de acuerdo al proyecto los beneficiaros del programa referido, deberán aportar una contrapartida presupuestal para el desarrollo y ejecución del mismo, la cual se desprende del proyecto planteado y que se ordenará en la parte resolutiva del presente acto administrativo.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que en cumplimiento de las normas que establecen los parámetros ambientales, se tuvo en cuenta lo siguiente:</span><br><br>';
    $str.='<span style="text-align:justify;" >Concepto de uso del suelo establecido en POT / EOT.<br>En la fase de diagnóstico que comprende el plan operativo, se tuvo en cuenta el componente ambiental para el levantamiento de la línea base de cada predio y en la visita de verificación en campo se tuvo en cuenta que si se encontraba alguna situación ambiental que requiriera de concepto ambiental por parte de la corporación se solicitaría a dicho ente.<br>Cumplimiento de la normativa ambiental en cuanto a ubicación del predio, como son áreas de protección ambiental nacional, regional y local, reservas forestales de ley 2da y características de altitud y pendientes del terreno.<br>Se informó a las Corporaciones Autónomas Regionales involucradas en los departamentos en donde se esta desarrollando la estrategia, a través de oficios que explican la metodología utilizada y la relación de predios a intervenir en la región que administran.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que conforme a lo dispuesto en el artículo 31 del acuerdo 344 de 2014, los proyectos que hayan iniciado en otras vigencias en el programa de cofinanciación e implementación de proyectos de desarrollo rural con enfoque territorial - IPDR en las áreas de actuación del INCODER, continuarán con la normatividad con la cual iniciaron hasta su culminación.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que los proyectos a cofinanciar por el INCODER en el marco del régimen de transición normativa establecido en el artículo 31 del acuerdo citado, fueron debidamente determinados y limitados dentro de las publicaciones efectuadas en el sitio web institucional, cuyos listados detallan las familias beneficiarias.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que para el caso del proyecto denominado '.$codigo.', se determina que las actividades establecidad para su formulación iniciaron antes de la vigencia del acuerdo 344 de 2014 en el marco del programa de cofinanciación e implementación de proyectos de desarrollo rural con enfoque territorail - IPDR, razón por la que conforme por lo dispuesto en el artículo 31 del acuerdo 344 de 2014, el proceso de adjudicación de la cofinanciación se rige por las disposiciones del régimen bajo el cual se formuló, es decir, el establecido en el acuerdo 308 de 2013, modificado por los acuerdos 311 y 325 de 2013, proferidos por el Consejo Directivo del INCODER.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que una vez surtidas las actividades de verificación, formulación y evaluación, se determinó la viabilidad del otorgamiento de la cofinanciación para el proyecto denominado ' . $codigo . '.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que de acuerdo a lo dispuesto en el Acuerdo 308 de 2013, se procede a efectuar la adjudicación de la cofinanciación para el proyecto mencionado.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que el inciso 2° del Artículo 3° del  Decreto 2365 de 2015 “Por el cual se suprime el Instituto Colombiano de Desarrollo Rural Incoder, se ordena su liquidación y se dictan otras disposiciones”, estableció que a partir de su publicación, el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación no podrá iniciar nuevas actividades en desarrollo de su objeto social y conservará su capacidad jurídica únicamente para expedir actos, realizar operaciones, convenios y celebrar los contratos necesarios para su liquidación.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que el citado artículo estableció que el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación conservará su capacidad para seguir adelantando los procesos agrarios, de titulación de baldíos, de adecuación de tierras y riego, gestión y desarrollo productivo, promoción, asuntos étnicos y ordenamiento productivo hasta tanto entren en operación la Agencia Nacional de Tierras y la Agencia de Desarrollo Rural, lo cual deberá ocurrir en un término no mayor a dos (2) meses, contados a partir de la fecha de vigencia del decreto.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que así mismo, el artículo 5º numeral 8 y 27 del Decreto 2365 de 2015 señala que el Liquidador actuará como representante legal del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación y le corresponde adoptar las decisiones y proferir los actos administrativos que sean requeridos para facilitar la preparación y realización de una liquidación rápida y efectiva, así como las demás actividades que sean propias de su cargo como las de proferir los actos administrativos que se relacionen con la organización y funcionamiento, con el ejercicio de la autonomía administrativa y el cumplimiento de los objetivos y funciones de la entidad en liquidación.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que en desarrollo de tal función reglamentada por los artículos 9, 10 y 12 de la Ley 489 de 1998, el Liquidador del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, mediante la Resolución No. 00007 del 07 de diciembre de 2015 delegó en las Direcciones Territoriales del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, la suscripción, expedición y notificación de los actos administrativos relativos a la adjudicación de la financiación y/o cofinanciación para los proyectos productivos, así como el respectivo control y seguimiento a la ejecución integral de los proyectos productivos, de acuerdo a lo dispuesto en los protocolos, manuales y circulares correspondientes.</span><br><br>';
    $str.='<span style="text-align:justify;" >Que en mérito de expuesto el IInstituto Colombiano de Desarrollo Rural – INCODER en Liquidación, dirección territorial '.strtoupper($resolucion['Departament']['name']).'.</span><br><br>';
    $str.='<span style="text-align:center;" ><b>R  E  S  U  E  L  V  E</b></span><br><br>';
    
    $str.='<span style="text-align:justify;" ><b>ARTÍCULO PRIMERO: Reconocimiento de la cofinanciación.-Otorgar<b> una cofinanciación a favor de los beneficiarios y su cónyuge y/o compañera permanente, que a continuación se detallan, como familia (s) beneficiaria (s) de reforma agraria y para apoyar el proyecto de desarrollo rural denominado ' . $codigo . ' </span><br><br>';


$pdf->writeHTML($str, true, false, false, false, '');


    App::Import('model', 'Beneficiary');
    $Beneficiary = new Beneficiary();
    $beneficiarios = $Beneficiary->find('all', array('recursive' => -1, 'conditions' => array('Property.proyect_id' => $resolucion['Resolution']['proyect_id'], 'Beneficiary.calificacion_visita' => 'Cumple', 'Beneficiary.beneficiary_id' => 0), 'joins' => array(array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Beneficiary.property_id=Property.id'))), 'fields' => array('Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo', 'Beneficiary.archivo_cedula', 'Beneficiary.archivo_policia', 'Beneficiary.archivo_contraloria', 'Beneficiary.archivo_procuraduria', 'Beneficiary.tipo_identificacion')));
    $totalFamiilias = $Beneficiary->find('count', array('recursive' => -1, 'conditions' => array('Property.proyect_id' => $resolucion['Resolution']['proyect_id'], 'Beneficiary.calificacion_visita' => 'Cumple', 'Beneficiary.beneficiary_id' => 0), 'joins' => array(array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Beneficiary.property_id=Property.id'))), 'fields' => array('Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo', 'Beneficiary.archivo_cedula', 'Beneficiary.archivo_policia', 'Beneficiary.archivo_contraloria', 'Beneficiary.archivo_procuraduria', 'Beneficiary.tipo_identificacion')));
    $str = '<table border="1" cellpadding="5" style="text-align:justify;width:100%;" ><tr><th style="width:15%;">Familia N°</th><th style="width:25%;">Identificación C.C N°</th><th style="width:45%;">Nombre Completo</th><th style="width:15%;">Población</th></tr>';
    $cont = 1;
    foreach ($beneficiarios as $beneficiario) {

        if ($conyuge = $Beneficiary->find('first', array('recursive' => -1, 'conditions' => array('Beneficiary.beneficiary_id' => $beneficiario['Beneficiary']['id'], 'Beneficiary.calificacion_visita' => 'Cumple'), 'joins' => array(array('table' => 'properties', 'alias' => 'Property', 'type' => 'left', 'conditions' => array('Beneficiary.property_id=Property.id'))), 'fields' => array('Beneficiary.id', 'Beneficiary.nombres', 'Beneficiary.primer_apellido', 'Beneficiary.segundo_apellido', 'Beneficiary.numero_identificacion', 'Beneficiary.tipo', 'Beneficiary.archivo_cedula', 'Beneficiary.archivo_policia', 'Beneficiary.archivo_contraloria', 'Beneficiary.archivo_procuraduria', 'Beneficiary.tipo_identificacion')))) {
            $str.="<tr><td rowspan=\"2\">$cont</td><td>" . $beneficiario['Beneficiary']['tipo_identificacion'] . " " . $beneficiario['Beneficiary']['numero_identificacion'] . " </td><td>" . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " " . $beneficiario['Beneficiary']['segundo_apellido'] . "</td><td>" . $beneficiario['Beneficiary']['tipo'] . "</td></tr>";
            $str.="<tr><td>" . $conyuge['Beneficiary']['tipo_identificacion'] . " " . $conyuge['Beneficiary']['numero_identificacion'] . " </td><td>" . $conyuge['Beneficiary']['nombres'] . " " . $conyuge['Beneficiary']['primer_apellido'] . " " . $conyuge['Beneficiary']['segundo_apellido'] . "</td></tr>";
        } else {
            $str.="<tr><td >$cont</td><td>" . $beneficiario['Beneficiary']['tipo_identificacion'] . " " . $beneficiario['Beneficiary']['numero_identificacion'] . " </td><td>" . $beneficiario['Beneficiary']['nombres'] . " " . $beneficiario['Beneficiary']['primer_apellido'] . " " . $beneficiario['Beneficiary']['segundo_apellido'] . "</td><td>" . $beneficiario['Beneficiary']['tipo'] . "</td></tr>";
        }
        $cont++;
    }
    $str.="</table>";

    $pdf->writeHTML($str, true, false, false, false, '');


$str = '*La condición indicada respecto a los beneficiarios de la cofinanciación, corresponde a pobladores rurales campesinos (C) o desplazados (D).</span><br>';
$pdf->writeHTML($str, true, false, false, false, '');
$str = 'El proyecto denominado “' . $codigo . '”, el cual se desarrollará en el (los) predio (s) rural (es) que se identifica (n) a continuación: </span><br>';
$pdf->writeHTML($str, true, false, false, false, '');


    $str = '<table border="1" cellpadding="2" style="text-align:justify;width:100%;"  nobr="true" ><tr style="text-align:center;"><th>Nombre o dirección</th><th style="">Propietarios/poseedores</th><th>Municipio y departamento</th><th>No. De F.M.I/código catastral</th><th>Oficina de instrumentos públicos/alcaldía municipal</th></tr>';

    foreach ($predios as $predio) {

        $str.="<tr style=\"text-align:justify;\"><td>" . $predio['Property']['nombre'] . " </td>
          <td>" . $predio['Property']['tipo_tenencia'] . "</td>
          <td>" . $predio['Departament']['name'] . " " . $predio['City']['name'] . "</td>
          <td>" . $predio['Property']['matricula'] . "</td>
          <td>" . $predio['Property']['oficina_registro'] . "</td>
          </tr>";
    }
    $str.="</table>";
    $pdf->SetFont('Trebuchet', '', 8);
    $pdf->writeHTML($str, true, false, false, false, '');


$pdf->SetFont('Trebuchet', '', 10);

$str = '<span style="text-align:justify;" >*La anterior descripción se realiza para identificar el predio en el cual se desarrollará la actividad productiva y no constituye título traslaticio del dominio.</span><br><br>';


    $str .= '<span style="text-align:justify;" ><b>PARÁGRAFO PRIMERO.</b>El (los) beneficiario (s) del proyecto que por razones ajenas a la voluntad del INCODER no pueda (n) o no quiera (n) notificarse  personalmente de la presente resolución, podrán ser excluidos de la misma, toda vez que la notificación personal es condición para hacer efectivo el derecho que en el presente acto administrativo se reconoce.</span><br><br>';
    $str.='<span style="text-align:justify;" ><b>PARÁGRAFO SEGUNDO.</b>Los beneficiarios de la cofinanciación tienen la obligación de no enajenar o transferir a cualquier título, los derechos que ostentan sobre el (los) predio (s) en el (los) cual (es) se implementará, parcial o totalmente, el proyecto. Lo anterior, conforme a lo establecido en la reglamentación del programa de cofinanciación del proyectos de desarrollo rural.</span><br><br>';
    $str.='<span style="text-align:justify;" ><b>ARTÍCULO SEGUNDO</b>. Valor del Proyecto y monto de la cofinanciación.- El valor total del proyecto corresponde a la suma de ' . $valor_total . '  ($' . number_format($evaluacion['InitialEvaluation']['valor_total'], 0, ',', '.') . '), de los cuales ' . $monto_solicitado . ' ($' . number_format($evaluacion['InitialEvaluation']['monto_solicitado'], 0, ',', '.') . ') corresponde al valor destinado como cofinanciación del INCODER, dicha suma será entregada por el INCODER a los beneficiarios, de conformidad con lo dispuesto en la presente resolución, y ' . $contrapartida . ' ($' . number_format(( $evaluacion['InitialEvaluation']['valor_total'] - $evaluacion['InitialEvaluation']['monto_solicitado']), 0, ',', '.') . ') corresponden a la contrapartida a cargo de los beneficiarios para el desarrollo del proyecto productivo denominado "' . $codigo . '". </span><br><br>';

    $str.='<span style="text-align:justify;" ><b>ARTÍCULO TERCERO: Obligaciones de los Beneficiarios.</b>Los beneficiarios adquieren las siguientes obligaciones: a) Ejecutar el proyecto productivo objeto de la cofinanciación adjudicado por el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, dentro del marco de los planes de inversión y de compra que establezcan para el proyecto. b) Abstenerse de enajenar o transferir los derechos que ostentan sobre el predio donde se desarrollará el proyecto productivo, hasta tanto su ejecución no concluya. c) Obtener la titularidad de las licencias, concesiones, permisos y/o autorizaciones para el uso, manejo, aprovechamiento y/o disposición de los recursos naturales renovables, necesarios para el desarrollo del proyecto productivo en consonancia con las normas que rijan la materia, y por ende, a cumplir con las obligaciones que dichos instrumentos de manejo y control ambiental impongan, de acuerdo a lo establecido en la parte considerativa del presente acto administrativo. d) Constituir a favor del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, con NIT. 830.122.398-0, una garantía de cumplimiento del proyecto productivo que podrá consistir en una póliza de seguro, la garantía debe cubrir el CUMPLIMIENTO en cuantía equivalente al diez por ciento (10%) del valor del aporte del Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, con una vigencia de veinticuatro (24) meses, garantía que requerirá aprobación por el Director Territorial o por el Coordinador Técnico de la respectiva Dirección Territorial.</span><br><br>';
    
    $str.='<span style="text-align:justify;" ><b>ARTÍCULO CUARTO: Equipo técnico de vigilancia a la inversión.</b>Confórmese en la Dirección Territorial ' . strtoupper($resolucion['Departament']['name']) . ' el Equipo Técnico de Vigilancia de la Inversión para que apoye y vigile la correcta inversión de los recursos destinados para el proyecto ' . $codigo . ', el cual deberá cumplir con las funciones establecidas en la Resolución No. 10177 del 25 de noviembre de 2013 y las demás que la modifiquen o deroguen.</span><br><br>';
    $str.='<span style="text-align:justify;" ><b>ARTÍCULO QUINTO: Supervisión del proyecto.</b>La supervisión de la ejecución del proyecto estará a cargo del Director Territorial o su delegado conforme a lo dispuesto en el numeral 18 del artículo 32 del Decreto 3759 de 2009, quien tendrá además de las funciones establecidas en el manual de interventoría y supervisión de la entidad las siguientes: a) Verificar el cumplimiento de las obligaciones de los beneficiarios, b) Verificar el cumplimiento de las funciones descritas en la Resolución No. 10177 del 25 de noviembre de 2013, c) Verificar el cumplimiento del Protocolo de Desembolso y Seguimiento a la Cofinanciación, d) Verificar que los beneficiarios utilizan el (os) recurso (s) para la implementación del proyecto de desarrollo rural debidamente formulado, e) Declarar el siniestro sobre la póliza constituida en favor del Instituto.</b></span><br><br>';
    $str.='<span style="text-align:justify;" ><b>PARÁGRAFO PRIMERO: </b>La obligación principal a cargo de los beneficiarios de la cofinanciación es implementar y ejecutar el proyecto productivo objeto de la cofinanciación otorgada por el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación. Si se comprueba que el (os) beneficiario (os), no utiliza (n) el (os) recurso (s) para la implementación del proyecto de desarrollo rural, el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación, tomará las medidas necesarias para garantizar el cumplimiento de las obligaciones que se generan del presente otorgamiento de cofinanciación.</span><br><br>';
    $str.='<span style="text-align:justify;" ><b>PARÁGRAFO SEGUNDO: </b>En caso de incumplimiento, el (os) beneficiario (s) del otorgamiento de la cofinanciación tendrá la obligación de restituir hasta la totalidad de los recursos de dicha cofinanciación, recibida bajo tal condición, de conformidad con lo dispuesto en la Ley 160 de 1994.</span><br><br>';
    $str.='<span style="text-align:justify;" ><b>PARÁGRAFO TERCERO: </b>Verificado el incumplimiento de los beneficiarios, el Instituto Colombiano de Desarrollo Rural – INCODER en Liquidación podrá declarar el siniestro sobre la póliza constituida en favor del Instituto.</span><br><br>';
    $str.='<span style="text-align:justify;" ><b>ARTÍCULO SEXTO: Condiciones de inversión.</b>Se procederá a realizar el desembolso correspondiente al valor destinado por el INCODER para el proyecto productivo, de conformidad con los artículos 32 y 33 del Acuerdo No. 308 de 2013 y concordante con el protocolo de inversión denominado, “Protocolo de Desembolso y Seguimiento a la Cofinanciación”,  expedido por la Subgerencia de Gestión y Desarrollo Productivo, el cual hace parte integral de la presente resolución.</span><br><br>';
    $str.='<span style="text-align:justify;" ><b>ARTÍCULO SÉPTIMO: Notificaciones-.</b>Notifíquese a los adjudicatarios en la forma contemplada en los artículos 67 y siguientes del Código de Procedimiento Administrativo y de lo Contencioso Administrativo, y COMUNÍQUESE a la Procuraduría Delegada para Asuntos Agrarios y Ambientales.</span><br><br>';
    $str.='<span style="text-align:justify;" ><b>ARTÍCULO OCTAVO: Recursos-.</b>Contra la presente decisión procede el recurso de reposición, el cual podrá ser interpuesto por escrito ante el Director Territorial correspondiente, en la diligencia de notificación personal, o dentro de los diez (10) días siguientes a ella.</span><br><br>';


$str.='<span style="text-align:center;" ><strong>NOTIFÍQUESE, COMUNÍQUESE y CÚMPLASE.</strong></span><br><br><br><br>';

$str.='<span style="text-align:center;" >' . $resolucion['Branch']['director'] . '</span><br><br>';
$str.='<span style="text-align:center;" >Director Territorial ' . $resolucion['Branch']['nombre'] . '</span><br><br>';
$str.= '<span style="text-align:left;" >Proyectó ' . $resolucion['Resolution']['proyecto'] . '</span><br><br>';
$str.='<span style="text-align:left;" >Revisó ' . $resolucion['Resolution']['reviso'] . '</span></p>';
$pdf->writeHTML($str, true, false, false, false, '');
$pdf->Output('resolucion.pdf', 'D');
?>
