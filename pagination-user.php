<?php

$title =  $number =  $orderby = $style = '';

extract( $atts );
$paged 		= (get_query_var('paged')) ? get_query_var('paged') : 1;
$offset 	= ($paged - 1) * $number;


$args = array(
	'role'	=>	'teacher',
	'orderby' => 'registered',
	'order' => $orderby,
	'number'=> $number,
	'offset'	=>	$offset
);
$teacherAll = new WP_User_Query( $args );

$users 		= get_users();
$total_users = count($users);

$teachers = $teacherAll->get_results();
$total_query = count($teachers);
$total_pages = ceil($total_query / $number) + 1;

if( !empty( $teachers ) ) :
	if( $style == 'slide' ) : ?>
		<section class="our-teacher">
			<div class="container">
				<div class="our-teacher-content">
					<h2 class="section-title text-center"><?php if( $title ) { echo $title; } ?></h2>
					<div class="owl-carousel owl-theme">
						<?php foreach ( $teachers  as $teacher ) : ?>
							<div class="item">
								<div class="avatar">
									<a href="<?php echo get_author_posts_url( $teacher->ID ); ?>"><?php echo get_avatar( $teacher->ID , 140 ) ?></a>
								</div><!--.avatar-->
								<div class="info">
									<h3><a href="<?php echo get_author_posts_url( $teacher->ID ); ?>"><?php echo $teacher->display_name; ?></a></h3>
									<?php
									$job = get_field( 'job' , 'user_' . $teacher->ID );
									if( $job ):
										?>
										<span><?php echo $job; ?></span>
									<?php endif;?>
									<p><?php echo get_the_author_meta( 'user_description' , $teacher->ID ); ?></p>
									<a href="<?php echo get_author_posts_url( $teacher->ID ); ?>"><?php echo __( 'Xem chi tiết' , 'threeus' ); ?></a>
								</div><!--.info-->
							</div><!--.item-->
						<?php endforeach ;?>
					</div><!--.owl-carousel-->
				</div><!--.our-teacher-content-->
			</div><!--.container-->
		</section><!--.our-teacher-->
		<?php else: ?>
			<section class="lists-teacher">
				<div class="container">
					<div class="row">
						<?php foreach ( $teachers  as $teacher ) : ?>
							<div class="col-md-3 col-sm-6">
								<div class="item-teacher">
									<div class="info">
										<div class="thumbnail">
											<a href="<?php echo get_author_posts_url( $teacher->ID ); ?>"><?php echo get_avatar( $teacher->ID , 70 ) ?></a>
										</div><!--.thumbnail-->
										<div class="name-country">
											<h3><a href="<?php echo get_author_posts_url( $teacher->ID ); ?>"><?php echo $teacher->display_name; ?></a></h3>
											<?php getCountry( $teacher->ID ); ?>
										</div><!--.name-->
									</div><!--.info-->
									<div class="desc">
										<p><?php echo get_the_author_meta( 'user_description' , $teacher->ID ); ?></p>
										<a href="<?php echo get_author_posts_url( $teacher->ID ); ?>"  class="btn-primary"><?php echo __( 'Đăng ký học' , 'threeus' ); ?></a>
									</div><!--.desc-->
								</div><!--.item-teacher-->
							</div><!--.col-md-3-->
						<?php endforeach;?>
					</div><!--.row-->
					<div class="row justify-content-center">
						<div class="page-navigation clearfix" role="navigation">
							<nav class="page-nav">
								<?php
									$big          = 999999;
									echo '' . paginate_links(
										array(
											'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
											'format'    => '?paged=%#%',
											'current'   => max( 1, get_query_var( 'paged' ) ),
											'total'     => $total_pages,
											'type'      => 'plain',
											'prev_text' => '<i class="fa fa-angle-left"></i>',
											'next_text' => '<i class="fa fa-angle-right"></i>'
										)
									) . ' ';
								?>
							</nav><!-- .page-nav -->
						</div><!-- .page-navigation -->
					</div><!--.row-->
				</div><!--.container-->
			</section><!--.lists-teacher-->
		<?php endif; ?>
		<?php endif;?>
