<script>
    $(document).ready(function() {
        
        
        jQuery("#frm").validate({
            submitHandler: function(form) {
                jQuery(form).ajaxSubmit({
                    target: "#content",
                    beforeSubmit: function() {
                        $(".submit_button").hide();

                    }
                });
            }
        }); 
    }
        
)
</script>
<?php

echo $this->Form->create("User", array('id'=>'frm', 'type'=>'file', 'url' => array('controller' => 'users', 'action' => 'edit', $user_id)));
echo $this->Form->hidden("User.id");
echo $this->Form->input("User.nombre", array('label' => 'Nombres',));
echo $this->Form->input("User.primer_apellido", array('label' => 'Primer Apellido',));
echo $this->Form->input("User.segundo_apellido", array('label' => 'Segundo Apellido',));
echo $this->Form->input("User.email", array('label' => 'Correo electrónico',));
echo $this->Form->input("User.username", array('label' => 'Nombre De Usuario',));
echo $this->Form->input("User.telefono", array('label' => 'Teléfono',));
echo $this->Form->input("User.cedula", array('label' => 'Cédula'));
echo $this->Form->file("User.archivo", array('label' => 'Adjunto firma','accept'=>'png'));
echo $this->Form->input("User.group_id", array('label' => 'Grupo'));
echo $this->Form->input("User.branch_id", array('label' => 'Territorial'));
echo $this->Form->end(array('label' => 'Guardar', 'class' => 'submit_button'))
?>

