if( !function_exists( 'convertUrlYoutube' ) ) {
	function convertUrlYoutube( $url ) {
		preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
		$id = $matches[1];
		$width = '800px';
		$height = '450px';
		echo'<iframe id="ytplayer" type="text/html" width="'.$width.'" height="'.$height.'"
		src="https://www.youtube.com/embed/'.$id.'?rel=0&showinfo=0&color=white&iv_load_policy=3"
		frameborder="0" allowfullscreen></iframe> ';
	}

}