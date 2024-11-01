<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class simplevote_widget extends WP_Widget {

	const FS_TEXTDOMAIN = simplevote_class::FS_TEXTDOMAIN;

	var $iconsets = array(
						array('name' => 'plus/minus',			'hot' => 'icon-plus',		'not' => 'icon-minus'),
						array('name' => 'ok/cancel',			'hot' => 'icon-ok',			'not' => 'icon-cancel'),
						array('name' => 'sunny/rain',			'hot' => 'icon-sun',		'not' => 'icon-rain'),
						array('name' => 'happy/unhappy',		'hot' => 'icon-emo-happy',	'not' => 'icon-emo-unhappy'),
						array('name' => 'thumbs up/thumbs down','hot' => 'icon-thumbs-up',	'not' => 'icon-thumbs-down'),
					);



	// constructor
	public function __construct() {
		parent::WP_Widget(false,
			$name = __('Simplevote', self::FS_TEXTDOMAIN),
			array('description' => __('Implements a simple voting system.',self::FS_TEXTDOMAIN))
		);
	}


	// widget form creation
	function form($instance) {
	    // Check values
	    if( $instance) {
			$title			= esc_attr($instance['title']);
			$description	= esc_textarea($instance['description']);
			$icons			= esc_attr($instance['icons']);
			$hottext		= esc_attr($instance['hottext']);
			$nottext		= esc_attr($instance['nottext']);
			$hotcolor		= esc_attr($instance['hotcolor']);
			$notcolor		= esc_attr($instance['notcolor']);
	    } else {
			$title			= __('Simplevote',self::FS_TEXTDOMAIN);
			$description	= __('Do you like what you see on this page?',self::FS_TEXTDOMAIN);
			$icons			= 0;
			$hottext		= __('Yeah, great!',self::FS_TEXTDOMAIN);
			$nottext		= __('No, not really',self::FS_TEXTDOMAIN);
			$hotcolor		= '#333'; // dark
			$notcolor		= '#aaa'; // light
		}
	    ?>
	    <p>
	    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', self::FS_TEXTDOMAIN); ?></label>
	    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>

	    <p>
		<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description', self::FS_TEXTDOMAIN); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>"><?php echo $description; ?></textarea>
	    </p>

	    <p>
		<label for="<?php echo $this->get_field_id('icons'); ?>"><?php _e('Iconset', self::FS_TEXTDOMAIN); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('icons'); ?>" name="<?php echo $this->get_field_name('icons'); ?>">
		<?php
			foreach ($this->iconsets as $nr=>$set):
				echo '<option value="'.$nr.'" '.($nr==$icons?'selected':'').'>'.$set['name'].'</option>';
			endforeach;
		?></select>
	    </p>

	    <p>
	    <label for="<?php echo $this->get_field_id('hottext'); ?>"><?php _e('HOT title text', self::FS_TEXTDOMAIN); ?></label>
	    <input class="widefat" id="<?php echo $this->get_field_id('hottext'); ?>" name="<?php echo $this->get_field_name('hottext'); ?>" type="text" value="<?php echo $hottext; ?>" />
	    </p>

   	    <p>
	    <label for="<?php echo $this->get_field_id('hotcolor'); ?>"><?php _e('HOT color', self::FS_TEXTDOMAIN); ?></label>
	    <input class="widefat" id="<?php echo $this->get_field_id('hotcolor'); ?>" name="<?php echo $this->get_field_name('hotcolor'); ?>" type="text" value="<?php echo $hotcolor; ?>" />
	    </p>


   	    <p>
	    <label for="<?php echo $this->get_field_id('nottext'); ?>"><?php _e('NOT title text', self::FS_TEXTDOMAIN); ?></label>
	    <input class="widefat" id="<?php echo $this->get_field_id('nottext'); ?>" name="<?php echo $this->get_field_name('nottext'); ?>" type="text" value="<?php echo $nottext; ?>" />
	    </p>

   	    <p>
	    <label for="<?php echo $this->get_field_id('notcolor'); ?>"><?php _e('NOT color', self::FS_TEXTDOMAIN); ?></label>
	    <input class="widefat" id="<?php echo $this->get_field_id('notcolor'); ?>" name="<?php echo $this->get_field_name('notcolor'); ?>" type="text" value="<?php echo $notcolor; ?>" />
	    </p>

	    <?php
	}

	// widget update
	function update($new_instance, $old_instance) {
	    $instance = $old_instance;
	    // Fields
	    $instance['title']			= strip_tags($new_instance['title']);
		$instance['description']	= strip_tags($new_instance['description']);
		$instance['icons']			= strip_tags($new_instance['icons']);
	    $instance['hottext']		= strip_tags($new_instance['hottext']);
	    $instance['nottext']		= strip_tags($new_instance['nottext']);
	    $instance['hotcolor']		= strip_tags($new_instance['hotcolor']);
	    $instance['notcolor']		= strip_tags($new_instance['notcolor']);
	    return $instance;
	}

	// widget display
	function widget($args, $instance) {
		extract( $args );

		// these are the widget options
		$title			= apply_filters('widget_title', $instance['title']);
		$description	= apply_filters('widget_text', $instance['description']);

		$icons 			= $instance['icons'];
		$hottext 		= $instance['hottext'];
		$nottext		= $instance['nottext'];
		$hotcolor 		= $instance['hotcolor'];
		$notcolor 		= $instance['notcolor'];

		echo $before_widget;

		// Display the widget
		echo '<div class="widget-text wp_widget_plugin_box simplevote">';

		// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		$nonce = wp_create_nonce("simplevote_nonce");
//		$link = admin_url('admin-ajax.php?action=my_user_vote&post_id='.$GLOBALS['post']->ID.'&nonce='.$nonce);

		print '<p class="description">'.nl2br($description).'</p>';
		print '<p class="icons">';
		print '	<a class="hot button" data-nonce="'.$nonce.'" data-post_id="'.$GLOBALS['post']->ID.'" data-value="+1" style="color:'.$hotcolor.';"><i class="'.$this->iconsets[$icons]['hot'].'"></i></a>';
		print '	<a class="not button" data-nonce="'.$nonce.'" data-post_id="'.$GLOBALS['post']->ID.'" data-value="-1" style="color:'.$notcolor.';"><i class="'.$this->iconsets[$icons]['not'].'"></i></a>';
		print "</p>";

		print '<p class="icons">';
		print '	<div class="hottext">'.$hottext.'</div>';
		print '	<div class="nottext">'.$nottext.'</div>';
		print "</p>";
		echo '</div>';

		echo $after_widget;
	}
}


class simplevote_class extends basic_plugin_class {
	var $currentPlugin = __FILE__;

	function getPluginBaseName() { return plugin_basename($this->currentPlugin); }
	function getChildClassName() { return get_class($this); }

    public function __construct() {
   		parent::__construct();

		add_action( 'wp_enqueue_scripts', array($this,'simplevote_headers') );
		add_action('admin_init', array($this,'simplevote_admin_headers'),false,false,true);

		add_filter('manage_posts_columns', array($this,'simplevote_columns'));
		add_filter('manage_pages_columns', array($this,'simplevote_columns'));
		add_action('manage_posts_custom_column',  array($this,'simplevote_show_columns'));
		add_action('manage_pages_custom_column',  array($this,'simplevote_show_columns'));

		add_action("wp_ajax_my_user_vote", array($this,"my_user_vote"));
		add_action("wp_ajax_nopriv_my_user_vote", array($this,"my_user_vote"));

		add_action('widgets_init', create_function('', 'return register_widget("simplevote_widget");'));

		add_action( 'admin_menu', array($this,'create_meta_box' ));
		add_action( 'save_post', array($this,'save_meta_box'), 10, 2 );
	}


	function pluginInfoRight($info,$added = false) {
			parent::pluginInfoRight($info,$added);
	}

	const FS_TEXTDOMAIN = 'simplevote';
	const FS_PLUGINNAME = 'simplevote';
	const FS_PLUGINTITLE = 'Simplevote';

	/*	Tools -------------------------------------------------------------------------------------------------------------------
	*/

	function array_insert_after($key, &$array, $new_key, $new_value) {
	if (array_key_exists($key, $array)) {
		$new = array();
		foreach ($array as $k => $value) {
		$new[$k] = $value;
		if ($k === $key) {
			$new[$new_key] = $new_value;
		}
		}
		return $new;
	}
	return FALSE;
	}

	/*	Columns in the posts/pages overview -------------------------------------------------------------------------------------
	*/

	function simplevote_columns($columns) {
		$columns = $this->array_insert_after('date',$columns,'votes','<div class="simplevote_noscore">Votes</div>');
		return $columns;
	}


	function simplevote_show_columns($name) {
		global $post;
		switch ($name) {
			case 'votes':
					$votes = get_post_meta($post->ID, 'simplevotes',true);
					if (is_array($votes)) {
						$score = $votes['hot']-$votes['not'];
						$info = '+ '.(int)$votes['hot'].' / - '.(int)$votes['not'].' = '.$score;
/*
						if ($score==0) { echo '<div class="simplevote_equal" title="'.$info.'"><i class="icon-thumbs-up"></i><i class="icon-thumbs-down"></i></div>'; }
						if ($score>0) { echo  '<div class="simplevote_hot" title="'.$info.'"><i class="icon-thumbs-up"></i></div>';  }
						if ($score<0) { echo '<div class="simplevote_not" title="'.$info.'"><i class="icon-thumbs-down"></i></div>'; }
*/
						if ($score==0) { echo '<div class="simplevote_equal" title="'.$info.'">0</i></div>'; }
						if ($score>0) { echo  '<div class="simplevote_hot" title="'.$info.'">+'.$score.'</i></div>';  }
						if ($score<0) { echo '<div class="simplevote_not" title="'.$info.'">'.$score.'</i></div>'; }
						} else {
						echo '<div class="simplevote_noscore" title="'.__('No scores yet',self::FS_TEXTDOMAIN).'">--</div>';
					}


		}
	}


	/*	Ajax call ---------------------------------------------------------------------------------------------------------------
	*/

	function my_user_vote() {
		if ( !wp_verify_nonce( $_REQUEST['nonce'], "simplevote_nonce")) {
			exit("No naughty business please");
		}
		$votes = get_post_meta($_REQUEST["post_id"], 'simplevotes',true);

		// The original values in case things go wrong
		$result['hotvotes'] = $votes['hot'];
		$result['notvotes'] = $votes['not'];

		// add a point to hot or not
		switch ($_REQUEST['value']) {
		case '+1' : $votes['hot']++; break;
		case '-1' : $votes['not']++; break;
		}
		$votes['lastvote']=time();
		// save the result.
		$voted = update_post_meta($_REQUEST["post_id"], 'simplevotes', $votes);

		// if updated the new results will be returned
		if ($voted) {
			$result['type'] = "success";
			$result['hotvotes'] = $votes['hot'];
			$result['notvotes'] = $votes['not'];
		} else {
			$result['type'] = "error";
		}

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$result = json_encode($result);
			echo $result;
		} else {
			header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
	die();
	}


	/*	Add headers -------------------------------------------------------------------------------------------------------------
	*/
	function simplevote_headers() {
		wp_enqueue_style( "simplevote_font",plugins_url('css/fontello.css', __FILE__));
		wp_enqueue_style( "simplevote_css",plugins_url('css/simplevote.css', __FILE__));


		wp_register_script( "simplevote_js", WP_PLUGIN_URL.'/simplevote/js/simplevote.js', array('jquery') );
		wp_localize_script( 'simplevote_js', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php')));
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'simplevote_js' );
	}

	function simplevote_admin_headers () {
		wp_enqueue_style( "simplevote_font",plugins_url('css/fontello.css', __FILE__));
		wp_enqueue_style('simplevote_admin_css', plugins_url('/css/simplevote.css', __FILE__ ));
	}


	/*	metabox with score ---- -------------------------------------------------------------------------------------------------
	*/
	function create_meta_box() {
		add_meta_box( self::FS_PLUGINNAME.'_meta_box', self::FS_PLUGINTITLE, array($this,'meta_box_content'), 'post', 'side', 'default' );
		add_meta_box( self::FS_PLUGINNAME.'_meta_box', self::FS_PLUGINTITLE, array($this,'meta_box_content'), 'page', 'side', 'default' );
	}


	function save_meta_box( $post_id, $post ) {

	}

	function meta_box_content( $object, $box ) {
		$res = 'test';

		$votes = get_post_meta($GLOBALS['post']->ID, 'simplevotes',true);
		$res = '<div class="simplevote_center">';
		if (is_array($votes)) {
			$score = $votes['hot']-$votes['not'];
			if ($score==0) { $res .= '<div class="simplevote_equal simplevote_admin"><i class="icon-thumbs-up"></i><i class="icon-thumbs-down"></i></div>'; }
			if ($score>0) { $res .= '<div class="simplevote_hot simplevote_admin"><i class="icon-thumbs-up"></i></div>';  }
			if ($score<0) { $res .= '<div class="simplevote_not simplevote_admin"><i class="icon-thumbs-down"></i></div>'; }
			$res .= '<div>+ '.(int)$votes['hot'].' - '.(int)$votes['not'].' = '.$score.'</div>';
		} else {
			$res .= '<div class="simplevote_noscore" title="'.__('No scores yet',self::FS_TEXTDOMAIN).'">--</div>';
		}
		$res .= '</div>';
		echo $res;
	}

}
?>