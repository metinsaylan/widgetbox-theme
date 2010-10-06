<?php 

$themename = $this->name;
$options = $this->options;
$shortname = $this->shortname;

?>

<div class="wrap ex_wrap">
<h2><?php echo $this->name; ?> Theme Settings</h2>
 
<div class="ex_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
case "open":
?>
 
<?php break;
 
case "close":
?>
 
</div>
</div>
<br />

 
<?php break;
 
case "title":
?>
<p>To easily use the <?php echo $themename;?> theme, you can use the menu below.</p>

 
<?php break;
 
case 'text':
?>

<div class="ex_input ex_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="ex_input ex_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
  
<?php
break;
 
case 'select':
?>

<div class="ex_input ex_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option <?php if (get_option( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="ex_input ex_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":

?>

<div class="ex_section">
<div class="ex_title"><h3><?php echo $value['name']; ?></h3><span class="submit">
</span><div class="clearfix"></div></div>
<div class="ex_options">

 
<?php break;
 
}
}
?>
 
<p class="submit">
<input name="save" type="submit" class="button-primary" value="Save changes" />
<input type="hidden" name="action" value="save" />
</p>

</form>

<div style="font-size:9px; margin-bottom:10px;">
Powered by <a href="http://shailan.com/wordpress/themes/exhibit">Exhibit</a> by <a href="http://shailan.com">shailan</a>
</div>

</div> 