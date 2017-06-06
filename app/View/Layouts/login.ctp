<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <?php echo $this->Html->css('home'); ?>
        <?php echo $this->Html->css('redmond/jquery-ui-1.8.18.custom'); ?>
        <?php echo $this->Javascript->link('jquery-1.7.1.min'); ?>
        <?php echo $this->Javascript->link('jquery.validate'); ?>
        <?php echo $this->Javascript->link('messages_es'); ?>
        <?php echo $this->Javascript->link('jquery.form'); ?>
        <?php echo $this->Javascript->link('jquery-ui-1.8.17.custom.min'); ?>
        <?php echo $this->Javascript->link('tooltip'); ?>
        <script>
            function formularioAjax()  {
                
                $(".form").validate({
                    submitHandler: function(form) {
                        $(form).ajaxSubmit({
                            target: "#content"
                        });
                    }
            
            
                });
                
                // create the OUTER LAYOUT
                $(".calendario").datepicker({
                    yearRange: '1900:2050',
                    dateFormat: 'yy-mm-dd',
                    showOn: 'both',
                    buttonImage: './img/calendar.jpg',
                    buttonImageOnly: true,
                    changeYear: true,
                    numberOfMonths: 1

                });    
            }
        </script>
    </head>
    <body>
        <div id="container">
            <div id="banner" align="center" style="padding: 20px"><?php echo $this->Html->image('bandera.png', array('width' => '90%', 'heigth' => '300', 'border' => "0")) ?> </div>



            <div id="content">
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->fetch('content'); ?>
                <?php echo $this->element('sql_dump'); ?>  
            </div>

            <div id="footer"> <p align="center">Políticas de Privacidad y Condiciones de Uso Agencia de Desarrollo Rural, Nit: 900.948.958-4, Avenida el Dorado C.A.N Calle 43 No. 57 - 41 (Bogotá - Colombia) Conmutador: (571) 3830444 Ext 1112 - 1114 Línea de Atención al Ciudadano 018000115121 Horario de Atención: Lunes a Viernes 8.00 a.m. a 5:00 p.m. E-Mail: atencionalciudadano@adr.gov.co www.adr.gov.co</p></div>
        </div>
    </body>
</html>