<?php ?>

<div class="wrap ex_wrap">
	<?php screen_icon(); ?>
	<h2><?php echo esc_html( $title ); ?></h2>
	
<?php if ( isset($_GET['message']) && isset($messages[$_GET['message']]) ) { ?>
<div id="message" class="updated"><p><?php echo $messages[$_GET['message']]; ?></p></div>
<?php } ?>
<?php if ( isset($_GET['error']) && isset($errors[$_GET['error']]) ) { ?>
<div id="message" class="error"><p><?php echo $errors[$_GET['error']]; ?></p></div>
<?php } ?>
 
<?php if(WP_DEBUG){ ?>
<pre>
<?php print_r($current); ?>
</pre>
<?php } ?>
 
<div class="ex_opts">
<form method="post">
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
 
	case 'open': ?>
 
<?php break;
	
	case 'close': ?>
 
</div>
</div>
<br />

 
<?php break;
	
	case 'text': ?>

<div class="ex_input ex_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( $current[ $value['id'] ] != "") { echo esc_html(stripslashes($current[ $value['id'] ] ) ); } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 
 </div>
<?php
break;
 
case 'textarea':
?>

<div class="ex_input ex_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( $current[ $value['id'] ] != "") { echo stripslashes($current[ $value['id'] ] ); } else { echo $value['std']; } ?></textarea>
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
		<option <?php if ( isset($current[ $value['id'] ]) && $current[ $value['id'] ] == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?>
</select>

	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
 
case "checkbox":
?>

<div class="ex_input ex_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	
<?php if( $current[ $value['id'] ]){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
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

<?php if(!empty($footer_text)){echo $footer_text;} ?>

</div> 