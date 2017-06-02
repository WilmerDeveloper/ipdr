<div id="myCustomFlash" style="text-align: center;font-size: 14;color: #0063DC" >
    <?php echo $message ?> 
</div>

<script>
	$(function() {
		// a workaround for a flaw in the demo system (http://dev.jqueryui.com/ticket/4375), ignore!
		$( "#myCustomFlash" ).dialog( "destroy" );
	
		$( "#myCustomFlash" ).dialog({
			modal: true,
			show: "blind",
			hide: "explode",
			buttons: {
				Ok: function() {
					$( this ).dialog( "close" );
				}
			}
		});
	});
	</script>