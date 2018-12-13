
/*
* 	Disable Field Post id
*/
function disable_acf_load_field_post_id( $field ) {

	$field['disabled'] = 1;
	return $field;

}
add_filter('acf/load_field/name=post_id_default', 'disable_acf_load_field_post_id');
