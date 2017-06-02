<html >
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />


        <title>IPDR</title>

        <!-- DEMO styles - specific to this page -->

        <?php echo $this->Html->css('complex'); ?>
        <?php echo $this->Html->css('mytabs'); ?>
        <?php echo $this->Html->css('cake.generic'); ?>

        <?php echo $this->Html->css('redmond/jquery-ui-1.8.18.custom'); ?>


        <?php echo $this->Javascript->link('jquery-1.7.1.min'); ?>
        <?php echo $this->Javascript->link('jquery-ui-1.8.17.custom.min'); ?>
        <?php echo $this->Javascript->link('complex'); ?>
        <?php echo $this->Javascript->link('layout'); ?>
        <?php echo $this->Javascript->link('jquery.cookie'); ?>
        <?php echo $this->Javascript->link('jquery.ui.datepicker-es'); ?>
        <?php echo $this->Javascript->link('jquery.validate'); ?>
        <?php echo $this->Javascript->link('messages_es'); ?>
        <?php echo $this->Javascript->link('jquery.form'); ?>



        <!--[if lte IE 7]>
                <style type="text/css"> body { font-size: 85%; } </style>
        <![endif]-->


        <script type="text/javascript">
            /*
             * complex.html
             *
             * This is a demonstration page for the jQuery layout widget
             *
             *	NOTE: For best code readability, view this with a fixed-space font and tabs equal to 4-chars
             */

            var outerLayout, innerLayout;

            /*
             *#######################
             *     ON PAGE LOAD
             *#######################
             */
            $(document).ready(function () {






                outerLayout = $("body").layout(layoutSettings_Outer);

                if ($.cookie('tab_id') != null) {

                    if ($('#' + $.cookie('tab_id') != "")) {
                        $('#' + $.cookie('tab_id')).addClass("active");
                        var tab_id = $.cookie('tab_id').replace("tab_", "");
                        $('#menu').load('<?php echo $this->Html->url(array('controller' => 'menus', 'action' => 'ver')) ?>/' + tab_id);

                    }
                }
                $('#tabs').load('<?php echo $this->Html->url(array('controller' => 'tabs', 'action' => 'view')) ?>');




                /*******************************
                 ***  CUSTOM LAYOUT BUTTONS  ***
                 *******************************
                 *
                 * Add SPANs to the east/west panes for customer "close" and "pin" buttons
                 *
                 * COULD have hard-coded span, div, button, image, or any element to use as a 'button'...
                 * ... but instead am adding SPANs via script - THEN attaching the layout-events to them
                 *
                 * CSS will size and position the spans, as well as set the background-images
                 */



                // save selector strings to vars so we don't have to repeat it
                // must prefix paneClass with "body > " to target ONLY the outerLayout panes
                var westSelector = "body > .ui-layout-west"; // outer-west pane
                var eastSelector = "body > .ui-layout-east"; // outer-east pane

                // CREATE SPANs for pin-buttons - using a generic class as identifiers
                $("<span></span>").addClass("pin-button").prependTo(westSelector);
                $("<span></span>").addClass("pin-button").prependTo(eastSelector);
                // BIND events to pin-buttons to make them functional
                outerLayout.addPinBtn(westSelector + " .pin-button", "west");
                outerLayout.addPinBtn(eastSelector + " .pin-button", "east");

                // CREATE SPANs for close-buttons - using unique IDs as identifiers
                $("<span></span>").attr("id", "west-closer").prependTo(westSelector);
                $("<span></span>").attr("id", "east-closer").prependTo(eastSelector);
                // BIND layout events to close-buttons to make them functional
                outerLayout.addCloseBtn("#west-closer", "west");
                outerLayout.addCloseBtn("#east-closer", "east");


                /* Create the INNER LAYOUT - nested inside the 'center pane' of the outer layout
                 * Inner Layout is create by createInnerLayout() function - on demand
                 *
                 innerLayout = $("div.pane-center").layout( layoutSettings_Inner );
                 *
                 */


                // DEMO HELPER: prevent hyperlinks from reloading page when a 'base.href' is set


            });







            /*
             *#######################
             * INNER LAYOUT SETTINGS
             *#######################
             *
             * These settings are set in 'list format' - no nested data-structures
             * Default settings are specified with just their name, like: fxName:"slide"
             * Pane-specific settings are prefixed with the pane name + 2-underscores: north__fxName:"none"
             */
            layoutSettings_Inner = {
                applyDefaultStyles: true // basic styling for testing & demo purposes
                , minSize: 20 // TESTING ONLY
                , spacing_closed: 14
                , north__spacing_closed: 8
                , south__spacing_closed: 8
                , north__togglerLength_closed: -1 // = 100% - so cannot 'slide open'
                , south__togglerLength_closed: -1
                , fxName: "slide" // do not confuse with "slidable" option!
                , fxSpeed_open: 1000
                , fxSpeed_close: 2500
                , fxSettings_open: {easing: "easeInQuint"}
                , fxSettings_close: {easing: "easeOutQuint"}
                , north__fxName: "none"
                , south__fxName: "drop"
                , south__fxSpeed_open: 500
                , south__fxSpeed_close: 1000
                        //,	initClosed:						true
                , center__minWidth: 200
                , center__minHeight: 200
            };


            /*
             *#######################
             * OUTER LAYOUT SETTINGS
             *#######################
             *
             * This configuration illustrates how extensively the layout can be customized
             * ALL SETTINGS ARE OPTIONAL - and there are more available than shown below
             *
             * These settings are set in 'sub-key format' - ALL data must be in a nested data-structures
             * All default settings (applied to all panes) go inside the defaults:{} key
             * Pane-specific settings go inside their keys: north:{}, south:{}, center:{}, etc
             */
            var layoutSettings_Outer = {
                name: "outerLayout" // NO FUNCTIONAL USE, but could be used by custom code to 'identify' a layout
                        // options.defaults apply to ALL PANES - but overridden by pane-specific settings
                , defaults: {
                    size: "auto"
                    , minSize: 50
                    , paneClass: "pane" 		// default = 'ui-layout-pane'
                    , resizerClass: "resizer"	// default = 'ui-layout-resizer'
                    , togglerClass: "toggler"	// default = 'ui-layout-toggler'
                    , buttonClass: "button"	// default = 'ui-layout-button'
                    , contentSelector: ".content"	// inner div to auto-size so only it scrolls, not the entire pane!
                    , contentIgnoreSelector: "span"		// 'paneSelector' for content to 'ignore' when measuring room for content
                    , togglerLength_open: 35			// WIDTH of toggler on north/south edges - HEIGHT on east/west edges
                    , togglerLength_closed: 35			// "100%" OR -1 = full height
                    , hideTogglerOnSlide: true		// hide the toggler when pane is 'slid open'
                    , togglerTip_open: "Close This Pane"
                    , togglerTip_closed: "Open This Pane"
                    , resizerTip: "Resize This Pane"
                            //	effect defaults - overridden on some panes
                    , fxName: "slide"		// none, slide, drop, scale
                    , fxSpeed_open: 750
                    , fxSpeed_close: 1500
                    , fxSettings_open: {easing: "easeInQuint"}
                    , fxSettings_close: {easing: "easeOutQuint"}
                }
                , north: {
                    spacing_open: 1			// cosmetic spacing
                    , togglerLength_open: 0			// HIDE the toggler button
                    , togglerLength_closed: -1			// "100%" OR -1 = full width of pane
                    , resizable: false
                    , slidable: false
                            //	override default effect
                    , fxName: "none"
                }
                , south: {
                    maxSize: 200
                    , spacing_closed: 0			// HIDE resizer & toggler when 'closed'
                    , slidable: false		// REFERENCE - cannot slide if spacing_closed = 0
                    , initClosed: true
                            //	CALLBACK TESTING...
                    , onhide_start: function () {
                        return confirm("START South pane hide \n\n onhide_start callback \n\n Allow pane to hide?");
                    }
                    , onhide_end: function () {
                        alert("END South pane hide \n\n onhide_end callback");
                    }
                    , onshow_start: function () {
                        return confirm("START South pane show \n\n onshow_start callback \n\n Allow pane to show?");
                    }
                    , onshow_end: function () {
                        alert("END South pane show \n\n onshow_end callback");
                    }
                    , onopen_start: function () {
                        return confirm("START South pane open \n\n onopen_start callback \n\n Allow pane to open?");
                    }
                    , onopen_end: function () {
                        alert("END South pane open \n\n onopen_end callback");
                    }
                    , onclose_start: function () {
                        return confirm("START South pane close \n\n onclose_start callback \n\n Allow pane to close?");
                    }
                    , onclose_end: function () {
                        alert("END South pane close \n\n onclose_end callback");
                    }
                    //,	onresize_start:			function () { return confirm("START South pane resize \n\n onresize_start callback \n\n Allow pane to be resized?)"); }
                    , onresize_end: function () {
                        alert("END South pane resize \n\n onresize_end callback \n\n NOTE: onresize_start event was skipped.");
                    }
                }
                , west: {
                    size: 250
                    , spacing_closed: 21			// wider space when closed
                    , togglerLength_closed: 21			// make toggler 'square' - 21x21
                    , togglerAlign_closed: "top"		// align to top of resizer
                    , togglerLength_open: 0			// NONE - using custom togglers INSIDE west-pane
                    , togglerTip_open: "Close West Pane"
                    , togglerTip_closed: "Open West Pane"
                    , resizerTip_open: "Resize West Pane"
                    , slideTrigger_open: "click" 	// default
                    , initClosed: false
                            //	add 'bounce' option to default 'slide' effect
                    , fxSettings_open: {easing: "easeOutBounce"}
                }
                , east: {
                    size: 250
                    , spacing_closed: 21			// wider space when closed
                    , togglerLength_closed: 21			// make toggler 'square' - 21x21
                    , togglerAlign_closed: "top"		// align to top of resizer
                    , togglerLength_open: 0 			// NONE - using custom togglers INSIDE east-pane
                    , togglerTip_open: "Close East Pane"
                    , togglerTip_closed: "Open East Pane"
                    , resizerTip_open: "Resize East Pane"
                    , slideTrigger_open: "click"
                    , initClosed: true
                            //	override default effect, speed, and settings
                    , fxName: "drop"
                    , fxSpeed: "normal"
                    , fxSettings: {easing: ""} // nullify default easing
                    , spacing_closed:			0
                }
                , center: {
                    paneSelector: "#mainContent" 			// sample: use an ID to select pane instead of a class
                    , minWidth: 200
                    , minHeight: 200
                }
            };



        </script>


        <script>
            function formularioAjax() {

                $(".form").validate({
                    submitHandler: function (form) {
                        $(form).ajaxSubmit({
                            target: "#content",
                            beforeSubmit: function () {
                                $(".submit_button").hide();

                            }

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

        <div class="ui-layout-west">

            <div class="header" >Menú</div>

            <div  id="menu">

            </div>



        </div>

        <div  class="ui-layout-east">



        </div>

        <?php
        App::import('Model', 'Group');
        $gr = new Group();
        $grupo = $gr->find('first', array('conditions' => array('Group.id' => AuthComponent::User('group_id'))))
        ?>
        <div class="ui-layout-north">

            <div class="header" >
                <div style="float: right">
                    <table>
                        <tr>
                            <td  style="padding-top: 0" >
                                <?php
                                echo $this->Ajax->link($this->Html->image('icon-user-profile.png', array('border' => "0", 'width' => "30", 'height' => "30")), array('controller' => 'users', 'action' => 'edit_user', AuthComponent::User('id')), array('escape' => FALSE, 'update' => 'content', 'indicator' => 'loading'));
                                ?>
                            </td>
                            <td style=" color: #ffffff;font-size:11 ">
                                <?php
                                echo AuthComponent::User('nombre') . " " . AuthComponent::User('primer_apellido') . " (" . $grupo['Group']['name'] . ")"
                                ?>
                            </td>
                            <td style=" color: #ffffff">
                                <?php
                                echo $this->Html->link("SALIR", array('controller' => 'users', 'action' => 'logout'), array('class' => 'logout', 'escape' => FALSE, 'update' => 'content', 'indicator' => 'loading'));
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div style="height: 55px">
                <div id="tabs" style="margin-top: 2px; float: left;width: 70%" >


                </div>
                <div  style="float: right;border: solid 2px; height: 55px;margin-top: 0px">
                    <form style="padding-top: 0px;margin:solid 2px;margin-top: 0px" class="frmbuscar" >
                        <table border="0" cellspacing="0" cellpaddding="0" style="width: 200px;height: 20px; ">
                            <tr>
                                <td ><input class='txtbuscar' type="text"  name="data[Proyect][busqueda]"  ></td>
                                <td ><?php echo $this->Ajax->submit('Buscar', array('url' => array('controller' => 'Proyects', 'action' => 'search', 0), 'update' => 'content', 'indicator' => 'loading')); ?></td>
                            </tr>
                        </table>
                    </form>

                </div>

            </div>






        </div>
        <div class="ui-layout-south">
            <div class="header">Outer - South</div>
            <div class="content">
                <p>I only have a resizer/toggler when 'open'</p>
            </div>
        </div>


        <div id="mainContent"  >
            <!-- DIVs for the INNER LAYOUT -->

            <div id="selector"  >
                <?php
                echo $this->Form->create('Proyect');
                ?>

                <table  cellpadding="0" border="0"  cellspacing="0"style="width: 300px;" >

                    <tr>

                        <td>
                            <input type="text" name="data[Proyect][codigo]" id="usr"  />
                        </td>
                        <td>

                            <select name="data[Proyect][call_id]">
                                <?php
                                foreach ($calls as $key => $value) {
                                    echo "<option value='$key'>" . $value . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <?php echo $this->Ajax->submit('Seleccionar Proyecto', array('url' => array('controller' => 'Proyects', 'action' => 'select_proyect'), 'update' => 'current', 'indicator' => 'loading', 'class' => 'not_hidden', 'complete' => '$("#content").html("");$("#candidate").html("");')); ?>
                        </td>
                    </tr>
                </table>

                <?php echo $this->Form->end(); ?>
            </div>

            <div id="current"  >

                <?php
                if ($this->Session->read('codigo') == "") {
                    echo"<h1>  NO HA SELECCIONADO<br> PROYECTO </h1>";
                } else {
                    echo"<h1>  PROYECTO ACTIVO:<br> " . $this->Session->read('call_nombre') . " " . strtoupper($this->Session->read('codigo')) . "</h1>";
                }
                ?> 

            </div>



            <div id="loading" style="display: none;">
                <?php echo $this->Html->image('loading.gif', array('border' => "0", 'align' => 'center')); ?>
            </div>
            <div id="content">

                <?php 
                $rutaArchivoSoportes = "files";
                
                ?>
                <br><br><br>
                <a href="<?php echo $rutaArchivoSoportes . "/" . "SoportePBA2012.pdf" ?>" target="blank" class="acciones" >SOPORTE CALIFICACIÓN IPDR - 2012</a>


                <?php
                echo $this->Session->flash('auth');
                echo $this->Session->flash();
                ?>
                <?php echo $content_for_layout; ?>
                <?php echo $this->element('sql_dump'); ?>  
            </div>




        </div>


    </body>
</html> 