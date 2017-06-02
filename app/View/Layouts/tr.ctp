<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <title>Complex Layout Demo</title>

        <!-- DEMO styles - specific to this page -->
        <?php echo $this->Html->css('complex'); ?>
        <?php echo $this->Javascript->link('jquery-1.7.1.min'); ?>
        <?php echo $this->Javascript->link('jquery-ui-1.8.17.custom.min'); ?>
        <?php echo $this->Javascript->link('complex'); ?>
        <?php echo $this->Javascript->link('layout'); ?>
        <?php echo $this->Javascript->link('lastest'); ?>
        <!--[if lte IE 7]>
                <style type="text/css"> body { font-size: 85%; } </style>
        <![endif]-->

        <script type="text/javascript" src="/lib/js/jquery-latest.js"></script>
        <script type="text/javascript" src="/lib/js/jquery-ui-latest.js"></script>
        <script type="text/javascript" src="/lib/js/jquery.layout-latest.js"></script>
        <script type="text/javascript" src="js/complex.js"></script>
        <script type="text/javascript" src="/lib/js/debug.js"></script>

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
            $(document).ready( function() {
                // create the OUTER LAYOUT
                outerLayout = $("body").layout( layoutSettings_Outer );

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

                // BIND events to hard-coded buttons in the NORTH toolbar
                outerLayout.addToggleBtn( "#tbarToggleNorth", "north" );
                outerLayout.addOpenBtn( "#tbarOpenSouth", "south" );
                outerLayout.addCloseBtn( "#tbarCloseSouth", "south" );
                outerLayout.addPinBtn( "#tbarPinWest", "west" );
                outerLayout.addPinBtn( "#tbarPinEast", "east" );

                // save selector strings to vars so we don't have to repeat it
                // must prefix paneClass with "body > " to target ONLY the outerLayout panes
                var westSelector = "body > .ui-layout-west"; // outer-west pane
                var eastSelector = "body > .ui-layout-east"; // outer-east pane

                // CREATE SPANs for pin-buttons - using a generic class as identifiers
                $("<span></span>").addClass("pin-button").prependTo( westSelector );
                $("<span></span>").addClass("pin-button").prependTo( eastSelector );
                // BIND events to pin-buttons to make them functional
                outerLayout.addPinBtn( westSelector +" .pin-button", "west");
                outerLayout.addPinBtn( eastSelector +" .pin-button", "east" );

                // CREATE SPANs for close-buttons - using unique IDs as identifiers
                $("<span></span>").attr("id", "west-closer" ).prependTo( westSelector );
                $("<span></span>").attr("id", "east-closer").prependTo( eastSelector );
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
                $("a").each(function () {
                    var path = document.location.href;
                    if (path.substr(path.length-1)=="#") path = path.substr(0,path.length-1);
                    if (this.href.substr(this.href.length-1) == "#") this.href = path +"#";
                });

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
                applyDefaultStyles:				true // basic styling for testing & demo purposes
                ,	minSize:						20 // TESTING ONLY
                ,	spacing_closed:					14
                ,	north__spacing_closed:			8
                ,	south__spacing_closed:			8
                ,	north__togglerLength_closed:	-1 // = 100% - so cannot 'slide open'
                ,	south__togglerLength_closed:	-1
                ,	fxName:							"slide" // do not confuse with "slidable" option!
                ,	fxSpeed_open:					1000
                ,	fxSpeed_close:					2500
                ,	fxSettings_open:				{ easing: "easeInQuint" }
                ,	fxSettings_close:				{ easing: "easeOutQuint" }
                ,	north__fxName:					"none"
                ,	south__fxName:					"drop"
                ,	south__fxSpeed_open:			500
                ,	south__fxSpeed_close:			1000
                //,	initClosed:						true
                ,	center__minWidth:				200
                ,	center__minHeight:				200
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
                ,	defaults: {
                    size:					"auto"
                    ,	minSize:				50
                    ,	paneClass:				"pane" 		// default = 'ui-layout-pane'
                    ,	resizerClass:			"resizer"	// default = 'ui-layout-resizer'
                    ,	togglerClass:			"toggler"	// default = 'ui-layout-toggler'
                    ,	buttonClass:			"button"	// default = 'ui-layout-button'
                    ,	contentSelector:		".content"	// inner div to auto-size so only it scrolls, not the entire pane!
                    ,	contentIgnoreSelector:	"span"		// 'paneSelector' for content to 'ignore' when measuring room for content
                    ,	togglerLength_open:		35			// WIDTH of toggler on north/south edges - HEIGHT on east/west edges
                    ,	togglerLength_closed:	35			// "100%" OR -1 = full height
                    ,	hideTogglerOnSlide:		true		// hide the toggler when pane is 'slid open'
                    ,	togglerTip_open:		"Close This Pane"
                    ,	togglerTip_closed:		"Open This Pane"
                    ,	resizerTip:				"Resize This Pane"
                    //	effect defaults - overridden on some panes
                    ,	fxName:					"slide"		// none, slide, drop, scale
                    ,	fxSpeed_open:			750
                    ,	fxSpeed_close:			1500
                    ,	fxSettings_open:		{ easing: "easeInQuint" }
                    ,	fxSettings_close:		{ easing: "easeOutQuint" }
                }
                ,	north: {
                    spacing_open:			1			// cosmetic spacing
                    ,	togglerLength_open:		0			// HIDE the toggler button
                    ,	togglerLength_closed:	-1			// "100%" OR -1 = full width of pane
                    ,	resizable: 				false
                    ,	slidable:				false
                    //	override default effect
                    ,	fxName:					"none"
                }
                ,	south: {
                    maxSize:				200
                    ,	spacing_closed:			0			// HIDE resizer & toggler when 'closed'
                    ,	slidable:				false		// REFERENCE - cannot slide if spacing_closed = 0
                    ,	initClosed:				true
                    //	CALLBACK TESTING...
                    ,	onhide_start:			function () { return confirm("START South pane hide \n\n onhide_start callback \n\n Allow pane to hide?"); }
                    ,	onhide_end:				function () { alert("END South pane hide \n\n onhide_end callback"); }
                    ,	onshow_start:			function () { return confirm("START South pane show \n\n onshow_start callback \n\n Allow pane to show?"); }
                    ,	onshow_end:				function () { alert("END South pane show \n\n onshow_end callback"); }
                    ,	onopen_start:			function () { return confirm("START South pane open \n\n onopen_start callback \n\n Allow pane to open?"); }
                    ,	onopen_end:				function () { alert("END South pane open \n\n onopen_end callback"); }
                    ,	onclose_start:			function () { return confirm("START South pane close \n\n onclose_start callback \n\n Allow pane to close?"); }
                    ,	onclose_end:			function () { alert("END South pane close \n\n onclose_end callback"); }
                    //,	onresize_start:			function () { return confirm("START South pane resize \n\n onresize_start callback \n\n Allow pane to be resized?)"); }
                    ,	onresize_end:			function () { alert("END South pane resize \n\n onresize_end callback \n\n NOTE: onresize_start event was skipped."); }
                }
                ,	west: {
                    size:					250
                    ,	spacing_closed:			21			// wider space when closed
                    ,	togglerLength_closed:	21			// make toggler 'square' - 21x21
                    ,	togglerAlign_closed:	"top"		// align to top of resizer
                    ,	togglerLength_open:		0			// NONE - using custom togglers INSIDE west-pane
                    ,	togglerTip_open:		"Close West Pane"
                    ,	togglerTip_closed:		"Open West Pane"
                    ,	resizerTip_open:		"Resize West Pane"
                    ,	slideTrigger_open:		"click" 	// default
                    ,	initClosed:				true
                    //	add 'bounce' option to default 'slide' effect
                    ,	fxSettings_open:		{ easing: "easeOutBounce" }
                }
                ,	east: {
                    size:					250
                    ,	spacing_closed:			21			// wider space when closed
                    ,	togglerLength_closed:	21			// make toggler 'square' - 21x21
                    ,	togglerAlign_closed:	"top"		// align to top of resizer
                    ,	togglerLength_open:		0 			// NONE - using custom togglers INSIDE east-pane
                    ,	togglerTip_open:		"Close East Pane"
                    ,	togglerTip_closed:		"Open East Pane"
                    ,	resizerTip_open:		"Resize East Pane"
                    ,	slideTrigger_open:		"mouseover"
                    ,	initClosed:				true
                    //	override default effect, speed, and settings
                    ,	fxName:					"drop"
                    ,	fxSpeed:				"normal"
                    ,	fxSettings:				{ easing: "" } // nullify default easing
                }
                ,	center: {
                    paneSelector:			"#mainContent" 			// sample: use an ID to select pane instead of a class
                    ,	minWidth:				200
                    ,	minHeight:				200
                }
            };

        </script>

    </head>
    <body>

        <div class="ui-layout-west">

            <div class="header">Outer - West</div>

            <div class="content">
                <h3><b>Outer Layout</b></h3>
                <ul>
                    <li><a href="#" onClick="outerLayout.toggle('north')">Toggle North</a></li>
                    <li><a href="#" onClick="outerLayout.toggle('south')">Toggle South</a></li>
                    <li><a href="#" onClick="outerLayout.toggle('west')"> Toggle West</a></li>
                    <li><a href="#" onClick="outerLayout.toggle('east')"> Toggle East</a></li>
                    <li><a href="#" onClick="outerLayout.hide('north')">Hide North</a></li>
                    <li><a href="#" onClick="outerLayout.hide('south')">Hide South</a></li>
                    <li><a href="#" onClick="outerLayout.show('south', false)">Unhide South</a></li>
                    <li><a href="#" onClick="outerLayout.hide('east')"> Hide East</a></li>
                    <li><a href="#" onClick="outerLayout.show('east', false)">Unhide East</a></li>
                    <li><a href="#" onClick="outerLayout.open('east')"> Open East</a></li>
                    <li><a href="#" onClick="outerLayout.open('north'); outerLayout.sizePane('north', 'auto')">  Resize North="auto"</a></li>
                    <li><a href="#" onClick="outerLayout.sizePane('north', 100); outerLayout.open('north')">  Resize North=100</a></li>
                    <li><a href="#" onClick="outerLayout.sizePane('north', 300); outerLayout.open('north')">  Resize North=300</a></li>
                    <li><a href="#" onClick="outerLayout.sizePane('north', 10000); outerLayout.open('north')">Resize North=10000</a></li>
                    <li><a href="#" onClick="outerLayout.open('south'); outerLayout.sizePane('south', 'auto')">  Resize South="auto"</a></li>
                    <li><a href="#" onClick="outerLayout.sizePane('south', 100); outerLayout.open('south')">  Resize South=100</a></li>
                    <li><a href="#" onClick="outerLayout.sizePane('south', 300); outerLayout.open('south')">  Resize South=300</a></li>
                    <li><a href="#" onClick="outerLayout.sizePane('south', 10000); outerLayout.open('south')">Resize South=10000</a></li>
                    <li><a href="#" onClick="outerLayout.panes.north.css('backgroundColor','#FCC')">North Color = Red</a></li>
                    <li><a href="#" onClick="outerLayout.panes.north.css('backgroundColor','#CFC')">North Color = Green</a></li>
                    <li><a href="#" onClick="outerLayout.panes.north.css('backgroundColor','')">    North Color = Default</a></li>
                    <li><a href="#" onClick="alert('outerLayout.name = \''+outerLayout.options.name+'\'')">Show Layout Name</a></li>
                    <li><a href="#" onClick="showOptions(outerLayout,'defaults')">Show Options.Defaults</a></li>
                    <li><a href="#" onClick="showOptions(outerLayout,'north')">   Show Options.North</a></li>
                    <li><a href="#" onClick="showOptions(outerLayout,'south')">   Show Options.South</a></li>
                    <li><a href="#" onClick="showOptions(outerLayout,'west')">    Show Options.West</a></li>
                    <li><a href="#" onClick="showOptions(outerLayout,'east')">    Show Options.East</a></li>
                    <li><a href="#" onClick="showOptions(outerLayout,'center')">  Show Options.Center</a></li>
                    <li><a href="#" onClick="showState(outerLayout,'container')"> Show State.Container</a></li>
                    <li><a href="#" onClick="showState(outerLayout,'north')">     Show State.North</a></li>
                    <li><a href="#" onClick="showState(outerLayout,'south')">     Show State.South</a></li>
                    <li><a href="#" onClick="showState(outerLayout,'west')">      Show State.West</a></li>
                    <li><a href="#" onClick="showState(outerLayout,'east')">      Show State.East</a></li>
                    <li><a href="#" onClick="showState(outerLayout,'center')">    Show State.Center</a></li>
                </ul>
            </div>

            <div class="footer">Automatically positioned footer</div>

        </div>

        <div class="ui-layout-east">

            <div class="header">Outer - East</div>

            <div class="subhead">I'm a subheader</div>

            <div class="content" id="content">

            </div>

            <div class="footer">I'm a footer</div>
            <div class="footer">I'm another footer</div>
            <div class="footer">Unlimited headers &amp; footers</div>

        </div>


        <div class="ui-layout-north">
            <div class="header">Outer - North</div>
            <div class="content">
                I only have toggler when 'closed' - I cannot be resized - and I do not 'slide open'
            </div>
            <ul class="toolbar">
                <li id="tbarToggleNorth" class="first"><span></span>Toggle NORTH</li>
                <li id="tbarOpenSouth"><span></span>Open SOUTH</li>
                <li id="tbarCloseSouth"><span></span>Close SOUTH</li>
                <li id="tbarPinWest"><span></span>Pin/Unpin WEST</li>
                <li id="tbarPinEast" class="last"><span></span>Pin/Unpin EAST</li>
            </ul>
        </div>


        <div class="ui-layout-south">
            <div class="header">Outer - South</div>
            <div class="content">
                <p>I only have a resizer/toggler when 'open'</p>
            </div>
        </div>


        <div id="mainContent">
            <!-- DIVs for the INNER LAYOUT -->

            <div class="ui-layout-center">
                <?php echo $this->Session->flash(); ?>
                <?php echo $content_for_layout; ?>
                <?php echo $this->element('sql_dump'); ?>
            </div>

            <div class="ui-layout-north"> Inner - North</div>
            <div class="ui-layout-south"> Inner - South</div>
            <div class="ui-layout-west">  Inner - West</div>
            <div class="ui-layout-east">  Inner - East
                <p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p>
                <p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p>
                <p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p>
                <p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p><p>...</p>
            </div>

        </div>


    </body>
</html> 