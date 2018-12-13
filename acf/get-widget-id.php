$id = explode("-", $this->get_field_id("widget_id")); lấy widget id

$galleries = get_field( 'gallery' ,'widget_'.$id[1] . "-" . $id[2] );
