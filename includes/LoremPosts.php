<?php 
/**
 * HOW TO USE
 * You need call to thi url
 * {SITE_URL}/{TEMPLATE_URL}/includes/Factory/LoremPosts.php?title=Construction &count=27&post_type=photo&start_index=0&term=7&tax=gallery
 */
require($_SERVER["DOCUMENT_ROOT"].'/wp-blog-header.php');
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);
set_time_limit (6000);

// =========================================================
// LAUNCH
// =========================================================
$lorem = new LoremPosts($_GET);

class LoremPosts{
	//                __  _                 
	//   ____  ____  / /_(_)___  ____  _____
	//  / __ \/ __ \/ __/ / __ \/ __ \/ ___/
	// / /_/ / /_/ / /_/ / /_/ / / / (__  ) 
	// \____/ .___/\__/_/\____/_/ /_/____/  
	//     /_/                              
	private $args;
	private $generated;
	private $images;

	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct($args = array())
	{	
		$defaults = array(
			'action'       => 'generatePosts',
			'post_type'    => 'post',
			'count'        => 'count',
			'start_index'  => 0,
			'term'         => null,
			'tax'     	   => null,
			'force_delete' => true,
			'title'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, unde!',
			'text'         => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, similique, sed, assumenda dolor nulla consequuntur earum id ullam iusto tempora itaque maiores in quod cum accusantium aut nesciunt voluptate pariatur rerum sit. Est, sint, explicabo, facilis a commodi mollitia ex quaerat quo nulla iusto magnam nostrum inventore voluptatum ducimus fugit modi itaque odit ab sed in nobis officiis enim aperiam repellendus provident perspiciatis aliquam reiciendis molestias adipisci quasi repudiandae laudantium natus amet omnis ipsam quam rem. Nemo perferendis mollitia voluptates sint tempora vero fugit architecto velit libero aspernatur! Consequatur, et, dolorum, similique accusamus placeat obcaecati eius facere velit veniam eos quidem natus animi reiciendis fugiat facilis perferendis illo exercitationem! Beatae, unde, labore a molestias consectetur exercitationem in odit quaerat tenetur asperiores totam commodi quas nemo. Quos, libero omnis assumenda facilis aperiam. Sunt, molestias, at quod delectus fuga quibusdam esse ipsum facere ad id velit iusto facilis praesentium quis doloremque. Repudiandae, laborum magnam numquam odit illum eligendi laudantium officia sit inventore dolores quibusdam ullam delectus. Ratione, non, corporis eius amet aliquid animi laudantium enim optio doloremque at nobis porro nostrum sunt. Repellendus, nihil, nemo, exercitationem vitae a eaque omnis aliquid atque ipsa ab enim inventore earum molestiae quasi reiciendis sit suscipit.');
		$this->args = array_merge($defaults, $args);		
		
		$this->images = array(
			'http://www.gurievcreative.com/images/12691403014_97ced52452_o.jpg',
			'http://www.gurievcreative.com/images/12691402574_294daa09e4_o.jpg',
			'http://www.gurievcreative.com/images/9518617096_f0d83777a3_o.jpg',
			'http://www.gurievcreative.com/images/11913618364_065a93cb72_o.jpg',
			'http://www.gurievcreative.com/images/7754554052_86f7c5b0f3_o.jpg',
			'http://www.gurievcreative.com/images/12651759595_2c3bcfb121_o.jpg',
			'http://www.gurievcreative.com/images/12645277355_0b75240740_o.jpg',
			'http://www.gurievcreative.com/images/12645257825_918c5aeb12_o.jpg',
			'http://www.gurievcreative.com/images/12631473634_2c6ec97361_o.jpg',
			'http://www.gurievcreative.com/images/12610853225_2ffd45086d_o.jpg',
			'http://www.gurievcreative.com/images/12583502713_2880eb5973_o.jpg',
			'http://www.gurievcreative.com/images/12585088173_4e13b40eb5_o.jpg',
			'http://www.gurievcreative.com/images/12581396003_021f9daf43_o.jpg',
			'http://www.gurievcreative.com/images/12581175215_394eabc276_o.jpg',
			'http://www.gurievcreative.com/images/12550164974_9f32289f6a_o.jpg',
			'http://www.gurievcreative.com/images/7905792614_fca565171a_o.jpg',
			'http://www.gurievcreative.com/images/12522491823_06aa349bfa_o.jpg',
			'http://www.gurievcreative.com/images/12520854723_36169be449_o.jpg',
			'http://www.gurievcreative.com/images/12521278994_68436bb0c4_o.jpg',
			'http://www.gurievcreative.com/images/12520888345_1166d37a7f_o.jpg',
			'http://www.gurievcreative.com/images/12521042903_004ae3300c_o.jpg',
			'http://www.gurievcreative.com/images/12485844944_ec7aa44f02_o.jpg',
			'http://www.gurievcreative.com/images/12508625194_4952131125_o.jpg',
			'http://www.gurievcreative.com/images/12508568154_209cb5152b_o.jpg',
			'http://www.gurievcreative.com/images/12499614683_1d636dd35a_o.jpg',
			'http://www.gurievcreative.com/images/12454826504_b4cb8a3ff2_o.jpg',
			'http://www.gurievcreative.com/images/10887881664_d38f38044d_o.jpg',
			'http://www.gurievcreative.com/images/6756060589_96426585df_o.jpg',
			'http://www.gurievcreative.com/images/5545129106_941f3df39e_o.jpg',
			'http://www.gurievcreative.com/images/5871189216_f340140c56_o.jpg',
			'http://www.gurievcreative.com/images/12467215715_f6e2dc4257_o.jpg',
			'http://www.gurievcreative.com/images/5562229581_de17ca2663_o.jpg',
			'http://www.gurievcreative.com/images/12383367935_4f173453d8_o.jpg',
			'http://www.gurievcreative.com/images/12383395943_32618fd1d4_o.jpg',
			'http://www.gurievcreative.com/images/12388828773_1902b9f70e_o.jpg',
			'http://www.gurievcreative.com/images/11185962823_8eda956253_o.jpg',
			'http://www.gurievcreative.com/images/12327979433_3c21345eee_o.jpg',
			'http://www.gurievcreative.com/images/12327869755_f28a87affa_o.jpg',
			'http://www.gurievcreative.com/images/12327849935_129cc4546c_o.jpg',
			'http://www.gurievcreative.com/images/12327827425_3279cf4026_o.jpg',
			'http://www.gurievcreative.com/images/12323345183_30eee9bfa4_o.jpg',
			'http://www.gurievcreative.com/images/7981519508_3bd2729421_o.jpg',
			'http://www.gurievcreative.com/images/10377250964_4c66a8f102_o.jpg',
			'http://www.gurievcreative.com/images/8577260282_ff1fe21916_o.jpg',
			'http://www.gurievcreative.com/images/12239468123_3dbe3b5b9d_o.jpg',
			'http://www.gurievcreative.com/images/12239629374_15d3e20637_o.jpg',
			'http://www.gurievcreative.com/images/12239870676_131dc4456a_o.jpg',
			'http://www.gurievcreative.com/images/12239431573_6c92e08083_o.jpg',
			'http://www.gurievcreative.com/images/12209989806_bbf1e79e3a_o.jpg',
			'http://www.gurievcreative.com/images/9523778382_11a89f4f80_o.jpg',
			'http://www.gurievcreative.com/images/9302417628_cf4623d835_o.jpg',
			'http://www.gurievcreative.com/images/8450168775_d3363c7768_o.jpg',
			'http://www.gurievcreative.com/images/8214669537_8391e0ebc4_o.jpg',
			'http://www.gurievcreative.com/images/7630936722_e3869f52dc_o.jpg',
			'http://www.gurievcreative.com/images/12054652674_80925060af_o.jpg',
			'http://www.gurievcreative.com/images/6854215287_e208dce548_o.jpg',
			'http://www.gurievcreative.com/images/12155190734_7d8965ac76_o.png',
			'http://www.gurievcreative.com/images/12155026883_97bcee4fdd_o.png',
			'http://www.gurievcreative.com/images/4528924860_d59dc93089_o.jpg',
			'http://www.gurievcreative.com/images/12129734164_9a2e4a0932_o.jpg',
			'http://www.gurievcreative.com/images/7271916842_8207ea3533_o.jpg',
			'http://www.gurievcreative.com/images/9516938203_fba0a3b77b_o.jpg',
			'http://www.gurievcreative.com/images/12118316984_d75c0323b3_o.jpg',
			'http://www.gurievcreative.com/images/12115772336_d46f52caf5_o.jpg',
			'http://www.gurievcreative.com/images/12115521394_436f05740e_o.jpg',
			'http://www.gurievcreative.com/images/12110777335_af82a5fb34_o.jpg',
			'http://www.gurievcreative.com/images/11504043944_b5673e7992_o.jpg',
			'http://www.gurievcreative.com/images/9387391776_2e67297827_o.jpg',
			'http://www.gurievcreative.com/images/6857347125_1529b46c7a_o.jpg',
			'http://www.gurievcreative.com/images/10612586044_d830976fb4_o.jpg',
			'http://www.gurievcreative.com/images/8643797956_2be599a73f_o.jpg',
			'http://www.gurievcreative.com/images/12054618054_52c31819ef_o.jpg',
			'http://www.gurievcreative.com/images/12105590265_1f837cd3a9_o.jpg',
			'http://www.gurievcreative.com/images/12100113295_5010b6c9bd_o.jpg',
			'http://www.gurievcreative.com/images/12100506274_c2c8ec57e3_o.jpg',
			'http://www.gurievcreative.com/images/12093345293_302b03912c_o.jpg',
			'http://www.gurievcreative.com/images/11712248985_1d19dc2867_o.jpg',
			'http://www.gurievcreative.com/images/9699590901_c225c1a9fe_o.jpg',
			'http://www.gurievcreative.com/images/12089327273_4cc6faf14c_o.jpg',
			'http://www.gurievcreative.com/images/10633796215_45d0f058e0_o.jpg',
			'http://www.gurievcreative.com/images/12085716196_812a71781d_o.jpg',
			'http://www.gurievcreative.com/images/12082691893_b918518a2f_o.jpg',
			'http://www.gurievcreative.com/images/12082699024_c4baffb4e9_o.jpg',
			'http://www.gurievcreative.com/images/7746449190_7582745b3b_o.jpg',
			'http://www.gurievcreative.com/images/7433057570_56918fc8e0_o.jpg',
			'http://www.gurievcreative.com/images/6827238090_cde5cd29a2_o.jpg',
			'http://www.gurievcreative.com/images/10776710303_500696e190_o.jpg',
			'http://www.gurievcreative.com/images/12078858495_f11fe9946c_o.jpg',
			'http://www.gurievcreative.com/images/12077196663_435540e1b2_o.jpg',
			'http://www.gurievcreative.com/images/11889372426_df1d407e61_o.jpg',
			'http://www.gurievcreative.com/images/12076089376_2a61115bda_o.jpg',
			'http://www.gurievcreative.com/images/12075847494_02a7656584_o.jpg',
			'http://www.gurievcreative.com/images/12075449115_14d81c832b_o.jpg',
			'http://www.gurievcreative.com/images/12075245324_80b7ab7fc5_o.jpg');
		extract($this->args);
		$this->$action();
	}

	/**
	 * Generate lorem posts
	 * @param  string  $post_type --- post type
	 */
	public function generatePosts()
	{	
		extract($this->args);
		for ($i=1; $i <= $count; $i++) 
		{ 
			$index = $start_index + $i;
			$p = array(
				'post_title'   => $title." $index",
				'post_content' => $text,
				'post_status'  => 'publish',
				'post_type'    => $post_type);

			$post_id = wp_insert_post($p);
			if($term && $tax)
			{
				wp_set_post_terms($post_id, $term, $tax);
			}			

			if($post_id)
			{
				$image_id  = mt_rand(0, 93);
				$image_url = $this->images[$image_id];
				$this->uploadImage($image_url, $post_id);
			}
		}	
	}

	/**
	 * Delete all post from post type	
	 * @return boolean               --- if succsess, return true else return false.
	 */
	public function deletaAllPosts()
	{
		extract($this->args);
		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'category'         => '',
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => $post_type,
			'post_mime_type'   => '',
			'fields'		   => 'ids',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true );

		$posts = get_posts($args);
		if($posts)
		{
			foreach ($posts as &$post) 
			{
				 wp_delete_post($post, $force_delete);
			}
			return true;
		}
		return false;

	}

	/**
	 * Upload and set featured image
	 * @param  string $image_url --- image url
	 * @param  integer $post_id  --- post id
	 * @return mixed             --- Post meta ID on success, false on failure.
	 */
	public function uploadImage($image_url, $post_id)
	{
		$upload_dir = wp_upload_dir();
		$image_data = file_get_contents($image_url);
		$filename   = basename($image_url);
		if(wp_mkdir_p($upload_dir['path'])) $file = $upload_dir['path'] . '/' . $filename;
		else $file = $upload_dir['basedir'] . '/' . $filename;
		file_put_contents($file, $image_data);

		$wp_filetype = wp_check_filetype($filename, null);
		$attachment = array(
		    'post_mime_type' => $wp_filetype['type'],
		    'post_title'     => sanitize_file_name($filename),
		    'post_content'   => '',
		    'post_status'    => 'inherit');

		$attach_id = wp_insert_attachment( $attachment, $file, $post_id );
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
		wp_update_attachment_metadata( $attach_id, $attach_data );

		return set_post_thumbnail( $post_id, $attach_id );
	}

	/**
	 * Send debug information to email
	 * @param  mixed $args --- debug info
	 * @return boolean     --- return mail function result
	 */
	public function mailDebug($args)
	{
		return mail('tatarinfamily@gmail.com', 'debug', print_r($args, true));
	}
}