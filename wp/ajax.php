<script>
	var domain_url = '<?php echo get_template_directory_uri(); ?>';
</script>




$( document ).on( 'click' , '.btn-registration-c' , function( e ) {
		e.preventDefault();
		var id = $( this ).attr( 'data-id' );
		$.ajax({
			type : 'POST',
			url : ajaxUrl,
			dataType: 'json',
			data: {
				action:"RegistrationLessonCourse",
				id: id,
			},
		}).success(function( data ){
			// alert(JSON.stringify(data));
			if( data.limit == false){
				$( '.table-res.notice ' ).slideDown( 'fast' ).addClass( 'notice-error' ).text( 'Lớp học đã đủ sĩ số, vui lòng đăng ký lớp học khác.' );
			} else if( data.checkHour == false  ){
				$( '.table-res.notice ' ).slideDown( 'fast' ).addClass( 'notice-error' ).text( 'Vui lòng kiếm tra lại ngày, giờ theo đúng quy định.' );
			} else if( data.success == true ) {
				$( '.table-res.notice ' ).slideDown( 'fast' ).addClass( 'notice-success' ).text( 'Bạn đã đăng ký thành công' ) ;
			}
			setTimeout( function(  ) {
				location.reload();
			} , 2000 );
		});
	} );
	
	
	
	if( !function_exists( 'RegistrationLessonCourse' ) ){
		function RegistrationLessonCourse(){
			$lessonid = isset($_POST['id']) ? $_POST['id'] : 0 ;
			$userid = get_current_user_id();
			$message = array();
			if( is_numeric( $userid ) && is_numeric( $lessonid ) ) {
				if( CheckHourLesson( $lessonid , $posttype) == true) {
					if( CheckLimitMember( $lessonid ) ){
						if( Registration( $userid , $lessonid ) ) {
							$message['success'] = true;
						}
					} else {
						$message[ 'limit' ] = false;
					}
				} else {
					$message['checkHour'] = false;
				} 
			}
			echo json_encode( $message );
			exit();
		}
		add_action('wp_ajax_nopriv_RegistrationLessonCourse', 'RegistrationLessonCourse');
		add_action('wp_ajax_RegistrationLessonCourse', 'RegistrationLessonCourse');
	}
