<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Qomfort_Elementor_Latest_Posts extends Widget_Base {

	
	public function get_name() {
		return 'qomfort_elementor_latest_posts';
	}

	
	public function get_title() {
		return esc_html__( 'Latest Posts', 'qomfort' );
	}

	
	public function get_icon() {
		return 'eicon-post-list';
	}

	
	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		return [ '' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$args = array(
			'orderby' 	=> 'name',
			'order' 	=> 'ASC'
		);

		$categories 	= get_categories($args);
		$cate_array 	= array();
		$arrayCateAll 	= array( 'all' => esc_html__( 'All categories', 'qomfort' ) );

		if ($categories) {
		 	foreach ( $categories as $cate ) {
				$cate_array[$cate->slug] = $cate->cat_name;
		  }
		} else {
		  	$cate_array[ esc_html__( 'No content Category found', 'qomfort' ) ] = 0;
		}

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'qomfort' ),
			]
		);	
			
			
			$this->add_control(
				'total_count',
				[
					'label' 	=> esc_html__( 'Post Total', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::NUMBER,
					'default' 	=> 3,
				]
			);

			$this->add_control(
			  	'category',
			  	[
				  	'label' 	=> esc_html__( 'Category', 'qomfort' ),
				  	'type' 		=> Controls_Manager::SELECT,
				  	'default' 	=> 'all',
				  	'options' 	=> array_merge($arrayCateAll,$cate_array),
			  	]
			);

			$this->add_control(
				'order',
				[
					'label' 	=> esc_html__('Order', 'qomfort'),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'desc',
					'options' 	=> [
						'asc' => esc_html__('Ascending', 'qomfort'),
						'desc' => esc_html__('Descending', 'qomfort'),
					]
				]
			);

			$this->add_control(
				'order_by',
				[
					'label' 	=> esc_html__('Order By', 'qomfort'),
					'type' 		=> \Elementor\Controls_Manager::SELECT,
					'default' 	=> 'ID',
					'options' 	=> [
						'none' 		=> esc_html__('None', 'qomfort'),
						'ID' 		=> esc_html__('ID', 'qomfort'),
						'title' 	=> esc_html__('Title', 'qomfort'),
						'date' 		=> esc_html__('Date', 'qomfort'),
						'modified' 	=> esc_html__('Modified', 'qomfort'),
						'rand' 		=> esc_html__('Rand', 'qomfort'),
					]
				]
			);

			$this->add_control(
				'text_readmore',
				[
					'label' 	=> esc_html__( 'Text Link', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::TEXT,
					'default' 	=> esc_html__( 'View Post', 'qomfort' ),
				]
			);

		$this->end_controls_section();

		//SECTION TAB STYLE GENERAL
		$this->start_controls_section(
			'section_general_style',
			[
				'label' => esc_html__( 'General', 'qomfort' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'item_gap',
				[
					'label' 	=> esc_html__( 'Column Gap', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::SLIDER,
					'range' 	=> [
						'px' 	=> [
							'min' => 0,
							'max' => 50,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-latest-posts .item' => 'gap: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->add_responsive_control(
				'margin_item',
				[
					'label' 		=> esc_html__( 'Margin', 'qomfort' ),
					'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-latest-posts .item ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();
		// END SECTION TAB STYLE General

		//  Image
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'qomfort' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
 			$this->add_responsive_control(
				'img_width',
				[
					'label' 		=> esc_html__( 'Width', 'qomfort' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 80,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-latest-posts .item .media a img' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'img_height',
				[
					'label' 		=> esc_html__( 'Height', 'qomfort' ),
					'type' 			=> \Elementor\Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px' ],
					'range' => [
						'px' => [
							'min' 	=> 0,
							'max' 	=> 80,
							'step' 	=> 1,
						]
					],
					'selectors' 	=> [
						'{{WRAPPER}} .ova-latest-posts .item .media a img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

 		$this->end_controls_section();
		// END SECTION TAB STYLE Image
		 
		//SECTION TAB STYLE TITLE
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'qomfort' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' 		=> 'title_typography',
					'selector' 	=> '{{WRAPPER}} .ova-latest-posts .item .info .post-title',
				]
			);

			$this->add_control(
				'color_title',
				[
					'label' 	=> esc_html__( 'Color', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-latest-posts .item .info .post-title a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'color_title_hover',
				[
					'label' 	=> esc_html__( 'Color Hover', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .ova-latest-posts .item:hover .info .post-title a' => 'color : {{VALUE}};',
					],
				]
			);

			$this->add_responsive_control(
				'margin_title',
				[
					'label' 	=> esc_html__( 'Margin', 'qomfort' ),
					'type' 		=> \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', 'em', '%' ],
					'selectors' => [
						'{{WRAPPER}} .ova-latest-posts .item .info .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);


		$this->end_controls_section();
		// END SECTION TAB STYLE TITLE
		
		
	}

	// Render Template Here
	protected function render() {

		$settings 		= 	$this->get_settings();

		$category 		= 	$settings['category'];
		$total_count 	= 	$settings['total_count'];
		$order 			= 	$settings['order'];
		$order_by 		= 	$settings['order_by'];

		$text_readmore	= 	$settings['text_readmore'];

		$args 	= [];
		$postid = get_the_ID(); 

		if ($category == 'all') {
		  	$args	=[
			  	'post_type' 		=> 'post',
			  	'post_status' 		=> 'publish',
			  	'posts_per_page' 	=> $total_count,
			  	'order' 			=> $order,
	  		    'orderby' 			=> $order_by,
	  		    'post__not_in' 		=> array( $postid ),
		  	];
		} else {
		  	$args=[
			  	'post_type' 		=> 'post', 
			  	'post_status' 		=> 'publish',
			  	'category_name'		=>	$category,
			  	'posts_per_page' 	=> 	$total_count,
			  	'order' 			=> 	$order,
	  		    'orderby' 			=>  $order_by,
	  		    'post__not_in' 		=>  array( $postid ),
			  	'fields'			=> 	'ids'
		  	];
		}

		$query = new WP_Query( $args );

		?>

		<div class="ova-latest-posts">
			<?php
				if($query->have_posts()) : while($query->have_posts()) : $query->the_post();
			?>
				<div class="item">
					<div class="media">
			        	<?php 
			        		$thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id() , 'thumbnail' );
			        		$url_thumb = $thumbnail ? $thumbnail : \Elementor\Utils::get_placeholder_image_src();

			        	?>
			        	<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
			        		<img src="<?php echo esc_url( $url_thumb ) ?>" alt="<?php the_title(); ?>">
			        	</a>
			        </div>

			        <div class="info">

			            <h4 class="post-title">
					        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					          <?php the_title(); ?>
					        </a>
					    </h4>

					    <a href="<?php the_permalink(); ?>" class="post-readmore">
					    	<?php echo esc_html($text_readmore);?>
					    	<i aria-hidden="true" class="ovaicon ovaicon-next"></i>
					    </a>

			        </div>
				</div>
			<?php
				endwhile; endif; wp_reset_postdata();
			?>
		</div>

		 	
		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Latest_Posts() );