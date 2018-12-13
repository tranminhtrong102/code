<?php
$term = get_term( $term_id , 'admin_course_cat' );  //get term by term id 'admin_course_cat là taxonomy

Lấy categories by id   <?php echo get_the_category_list(' ,' , ' ,' , get_the_ID()); ?>

//get link trang hiện tại
global $wp;
echo home_url( $wp->request )


//Dem record
$count = 0;
	if( $teacher_id ){
		$args = array(
			'post_type'	=>	'lessons',
			'meta_query' => array(
				array(
					'key' => 'teacher_lesson',
					'value' => $teacher_id,
					'compare'	=>	'IN'
				)
			)
		);
		$the_query = New Wp_Query( $args );
		$count = $the_query->post_count;
		return $count;
		
	} else {
		return $count;
	}
	
	
	
	// Change Date format to time ago
	function post_time_ago() {
	    return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '. esc_html__( 'trước', 'threeus' );
	}
	
	
	
	
	// Add Facebook Like to single post
	function add_fb_like_to_posts( )
	{   $html = '';
	    if( is_single() )
	    {
	        $pageName = get_the_permalink();
	        $html .= '<div class="fb-like" data-href="'. $pageName .'" data-width="70" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>';
	    }
	    return $html;
	}
	
Sửa lỗi ký tự bị lỗi
function add_meta_header() {
	  $title = html_entity_decode( get_the_title(), ENT_HTML401, 'UTF-8');
	  $excert = html_entity_decode(get_the_excerpt( get_queried_object_id() ));
   if( is_front_page() ) { ?>
	<meta name="title" content="video bong da, trum video, tvshow, highlight, fullmatch, clip the thao">
	<meta name="description" content="Trùm Video clip bóng đá thể thao Ngoại Hạng Anh, Laliga, Cup C1 mới nhất, nhanh nhất">
   <?php } else if( is_single() ) { ?>
	<meta name="title" content="<?php echo $title; ?>">
	<meta name="description" content="<?php if( $excerpt ) { echo $excerpt; } else { echo esc_html__( $title ); } ?>">
	
   <?php }
}



?>