
<div class="container">


    <?php $activo = 0; ?>

    <div id="arbol"  class="demo" >
        <ul>
            <?php foreach ($listado as $menu): ?>


                <?php
                if ($activo != $menu['Menu']['id']) {
                    if ($activo != 0) {

                        echo"  </ul></li>";
                    }
                    ?>


                    <li id="shtml_1" class="jstree-open">

                        <a style="font-size: 14px;" href="#"><?php echo $menu['Menu']['nombre'] ?></a>
                        <ul>
                            <?php $activo = $menu['Menu']['id'];
                        } ?>


                        <li style="font-size: 12px;"><?php echo $this->Ajax->link($menu['Item']['nombre'], array('controller' => $menu['Item']['controlador'], 'action' => $menu['Item']['accion']), array('update' => 'content', 'indicator' => 'loading')) ?></li>




<?php endforeach; ?>

                </ul>
                </div>
                <script type="text/javascript" >
                    $(function () {
	
                        $("#arbol").jstree({ 
                            "core" : { "initially_open" : [ "root" ] },
                            "themes" : {
                                "theme" : "apple",
                                "dots" : true,
                                "icons" : true,
                                'url':'<?php echo $this->Html->url('/themes/apple/style.css', true); ?>'
                            },
                            "plugins" : [ "themes", "html_data" ,"sort","crrm"]
               
                        })
            
            
               

                    });
                </script>



                </div>