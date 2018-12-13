
if( !function_exists( 'pagination' ) ){
	function pagination( $custom_query = null, $paged = null ) {
		global $wp_query;
		if($custom_query) $main_query = $custom_query;
		else $main_query = $wp_query;
		$paged = ($paged) ? $paged : get_query_var('paged');
		$big = 999999999;
		$total = isset($main_query->max_num_pages)?$main_query->max_num_pages:'';
		if($total > 1) echo '<div class="page-navigation clearfix" role="navigation">
		<nav class="page-nav">';
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, $paged ),
			'total' => $total,
			'mid_size' => '10', 
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>'
		) );
		if($total > 1) echo '</nav></div>';
	}
}
pagination($the_query); // cach dung

if ( ! function_exists( 'threeus_pagination' ) ) :
	function threeus_pagination( $nav_query = false ) {

		global $wp_query, $wp_rewrite;

		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		// Prepare variables
		$query        = $nav_query ? $nav_query : $wp_query;
		$max          = $query->max_num_pages;
		$current_page = max( 1, get_query_var( 'paged' ) );
		$big          = 999999;

		?>
		<div class="page-navigation clearfix" role="navigation">
			<nav class="page-nav">
				<?php
				echo '' . paginate_links(
					array(
						'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'    => '?paged=%#%',
						'current'   => $current_page,
						'total'     => $max,
						'type'      => 'plain',
						'prev_text' => '<i class="fa fa-angle-left"></i>',
						'next_text' => '<i class="fa fa-angle-right"></i>'
					)
				) . ' ';
				?>
			</nav><!-- .page-nav -->
		</div><!-- .page-navigation -->
		<?php
	}
endif;
// dùng nhiều phân trang ở 1 page hoặc nhiều phân trang ở 1 trang. 

if( !function_exists( 'pagination' ) ){
	function pagination( $custom_query = null, $paged = null  , $param = '' , $page = false ) {
		global $wp_query;
		if($custom_query) $main_query = $custom_query;
		else $main_query = $wp_query;
		$paged = ($paged) ? $paged : get_query_var('$param');
		$big = 999999999;
		$total = isset($main_query->max_num_pages)?$main_query->max_num_pages:'';
		$base = array('');
		if( $page == true ) {
			$base = array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) )
			);
		}
		if($total > 1) echo '<div class="page-navigation clearfix" role="navigation">
		<nav class="page-nav">';
		$config = array(
			'format'  => '?'.$param.'=%#%',
			'current' => $paged,
			'total' => $custom_query->max_num_pages,
			'mid_size' => '10', 
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>'
		);
		$args = array_merge( $config , $base );
		echo paginate_links( $args );
		if($total > 1) echo '</nav></div>';
	}
}

Nhớ truyền biến paged vào query
Khi không hiển thị kiểm tra posts_per_page,đổi tên biến paged thành trang nếu vẫn không hiển thị

					Mẫu

					$args = array(
						'post_type' => 'post',
						'posts_per_page' => 12,
						'cat' => 29,
						'paged'=>$paged
					);
					…
					echo pagination( $the_query , $paged , 'trang', false );
	
Phân trang 1 trang
<?php if (function_exists('pagination')) pagination($the_query, $paged, '' , true ); ?>	

Nhiều phân trang ở một trang
$paged3 = isset( $_GET['paged-3'] ) ? (int) $_GET['paged-3'] : 1;
<?php echo pagination( $the_query3 , $paged3 , 'paged-3' ); ?>





Style navigation
.page-navigation span, .page-navigation a {
  display: inline-block;
  padding: 8px 15px;
  margin-right: 6px;
  border: 1px solid #e5e5e5;
  border-radius: 3px;
}
.page-navigation span.dots{
    background-color: transparent;
    border-color: transparent;
    color: #000;
}
.page-navigation a.active,
.page-navigation a:hover, .page-navigation span {
  background-color: #38a4ff;
  color: #fff;
  border: 1px solid #38a4ff;
}

