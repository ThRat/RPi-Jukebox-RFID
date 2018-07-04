<div class="row">
	<div class="col-xs-3">
		<div class="form-group">
		<form name='idletime' method='post' action='<?php print $_SERVER['PHP_SELF']; ?>'>
			<select name='idletime' id="sel4" class="form-control">
				<option value='0'>Disable</option>
				<option value='10'>10 min</option>
				<option value='15'>15 min</option>
				<option value='20'>20 min</option>
				<option value='30'>30 min</option>
				<option value='45'>45 min</option>
				<option value='60'>60 min</option>
			</select>
		</div><!-- / .form-group -->
	</div><!-- / .col-xs-3 -->
				<div class="col-xs-2">
					<input type='submit' class="btn btn-primary" name='submit' value='Set'/>
				</div><!-- / .col-xs-2 -->
		</form>

	<div class="col-xs-7">
		<div class="progress">
			<?php
			$idletimevalue = exec("/usr/bin/sudo ".$conf['scripts_abs']."/playout_controls.sh -c=getidletime");
			if ($idletimevalue == 0) {
				print '<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="width:100%">';
    				print 'Disabled';
			}
			else {
				print '<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="'.$idletimevalue.'" aria-valuemin="0" aria-valuemax="60" style="width:'.($idletimevalue*100/60).'%">';
	    			print $idletimevalue.' min';
			}
			?>
			</div><!-- / .progress-bar -->
  		</div><!-- / .progress -->
	</div><!-- / .col-xs-7 -->
</div><!-- / .row -->
<?php

if ($idletimevalue != "0") {
	$shutdowntime = exec("sudo atq -q i | awk '{print $5}'");
	$remainingtime = (strtotime($shutdowntime)-time())/60;



print '<div class="row">';	
print '	<div class="col-xs-5">';
print '	</div>';

print '	<div class="col-xs-7">';
print '		<div class="progress">';
			if ($shutdowntime != "") {
				print '<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="'.$remainingtime.'" aria-valuemin="0" aria-valuemax="60" style="width:'.$remainingtime.'%">';
    				print round($remainingtime).' min';
			}
			else {
				print '<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="60" style="width:100%">';
	    			print 'Box is not idling';
			}
			
print '			</div><!-- / .progress-bar -->';
print '  		</div><!-- / .progress -->';
print '	</div><!-- / .col-xs-7 -->';
print '</div><!-- / .row -->';
}
?>
