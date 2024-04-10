<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Blog_Grid extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_blog_grid';
	}

	public function get_title() {
		return esc_html__( 'Blog Grid', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
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
			'orderby' => 'name',
			'order' => 'ASC'
		);

		$categories 	= get_categories($args);
		$cate_array 	= array();
		$arrayCateAll 	= array( 'all' => esc_html__( 'All categories', 'qomfort' ) );
		if ( $categories ) {
			foreach ( $categories as $cate ) {
				$cate_array[$cate->slug] = $cate->cat_name;
			}
		} else {
			$cate_array[ esc_html__( 'No content Category found', 'qomfort' ) ] = 0;
		}

		//SECTION CONTENT
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'qomfort' ),
			]
		);

		$this->add_control(
			'template',
			[
				'label' => esc_html__( 'Template', 'qomfort' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'template_1',
				'options' => [
					'template_1' => esc_html__('Template 1', 'qomfort'),
					'template_2' => esc_html__('Template 2', 'qomfort'),
					'template_3' => esc_html__('Template 3', 'qomfort'),
					'template_4' => esc_html__('Template 4', 'qomfort'),
				]
			]
		);

		$this->add_control(
			'category',
			[
				'label' 	=> esc_html__( 'Category', 'qomfort' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> 'all',
				'options' 	=> array_merge( $arrayCateAll, $cate_array ),
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
			'number_column',
			[
				'label' 	=> esc_html__( 'Columns', 'qomfort' ),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> 'column_3',
				'options' 	=> [
					'column_2' 	=> esc_html__( '2 Columns', 'qomfort' ),
					'column_3' 	=> esc_html__( '3 Columns', 'qomfort' ),
					'column_4' 	=> esc_html__( '4 Columns', 'qomfort' ),
				]
			]
		);

		$this->add_control(
			'order',
			[
				'label' 	=> esc_html__('Order', 'qomfort'),
				'type' 		=> \Elementor\Controls_Manager::SELECT,
				'default' 	=> 'desc',
				'options' 	=> [
					'asc' 	=> esc_html__('Ascending', 'qomfort'),
					'desc' 	=> esc_html__('Descending', 'qomfort'),
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
					'none' => esc_html__('None', 'qomfort'),
					'ID' 	=> esc_html__('ID', 'qomfort'),
					'title' => esc_html__('Title', 'qomfort'),
					'date' 	=> esc_html__('Date', 'qomfort'),
					'modified' => esc_html__('Modified', 'qomfort'),
					'rand' 	=> esc_html__('Rand', 'qomfort'),
				]
			]
		);

		$this->add_control(
			'text_readmore',
			[
				'label' 	=> esc_html__( 'Text Link', 'qomfort' ),
				'type' 		=> \Elementor\Controls_Manager::TEXT,
				'default' 	=> esc_html__('View Post', 'qomfort'),
			]
		);

		$this->add_control(
			'show_category',
			[
				'label' 		=> esc_html__( 'Show Category', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> esc_html__( 'Show', 'qomfort' ),
				'label_off' 	=> esc_html__( 'Hide', 'qomfort' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'no',
			]
		);

		$this->add_control(
			'show_short_desc',
			[
				'label' 		=> esc_html__( 'Show Short Description', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> esc_html__( 'Show', 'qomfort' ),
				'label_off' 	=> esc_html__( 'Hide', 'qomfort' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_date',
			[
				'label' 		=> esc_html__( 'Show Date', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> esc_html__( 'Show', 'qomfort' ),
				'label_off' 	=> esc_html__( 'Hide', 'qomfort' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_author',
			[
				'label' 		=> esc_html__( 'Show Author', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> esc_html__( 'Show', 'qomfort' ),
				'label_off' 	=> esc_html__( 'Hide', 'qomfort' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' 		=> esc_html__( 'Show Title', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> esc_html__( 'Show', 'qomfort' ),
				'label_off' 	=> esc_html__( 'Hide', 'qomfort' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);


		$this->add_control(
			'show_read_more',
			[
				'label' 		=> esc_html__( 'Show Read More', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::SWITCHER,
				'label_on' 		=> esc_html__( 'Show', 'qomfort' ),
				'label_off' 	=> esc_html__( 'Hide', 'qomfort' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);

		$this->end_controls_section();
		//END SECTION CONTENT

		/* General */
		$this->start_controls_section(
			'items_style_section',
			[
				'label' => esc_html__( 'General', 'qomfort' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'items_padding',
			[
				'label' => esc_html__( 'Padding', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'items_box_shadow',
				'selector' => '{{WRAPPER}} .ova-blog .item',
			]
		);

		$this->add_control(
			'items_bg',
			[
				'label' => esc_html__( 'Background', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		//SECTION TAB STYLE TITLE
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'qomfort' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'margin_title',
			[
				'label' 		=> esc_html__( 'Margin', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .ova-blog .post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'title_typography',
				'selector' 	=> '{{WRAPPER}} .ova-blog .post-title a',
			]
		);

		$this->add_control(
			'color_title',
			[
				'label' 	=> esc_html__( 'Color', 'qomfort' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .post-title a' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color_title_hover',
			[
				'label' 	=> esc_html__( 'Color Hover', 'qomfort' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .post-title a:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE

		/* Meta */
		$this->start_controls_section(
			'section_meta',
			[
				'label' => esc_html__( 'Meta', 'qomfort' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'margin_meta',
			[
				'label' 		=> esc_html__( 'Margin', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .ova-blog .item .post-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'meta_icon',
			[
				'label' => esc_html__( 'Icon', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'meta_icon_margin',
			[
				'label' => esc_html__( 'Margin', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .post-meta .item-meta .left' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'meta_icon_size',
			[
				'label' => esc_html__( 'Size', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 40,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .post-meta .item-meta .left i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ova-blog .item .post-meta .item-meta .left svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'meta_text',
			[
				'label' => esc_html__( 'Text', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'meta_text_margin',
			[
				'label' => esc_html__( 'Margin', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .post-meta .item-meta .right' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'meta_text_typography',
				'selector' => '{{WRAPPER}} .ova-blog .item .post-meta .item-meta .right',
			]
		);

		$this->add_control(
			'meta_text_color',
			[
				'label' => esc_html__( 'Color', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .post-meta .item-meta .right' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'meta_text_color_hover',
			[
				'label' => esc_html__( 'Link Hover', 'qomfort' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .post-meta .item-meta .right a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		/* Short Description */
		$this->start_controls_section(
			'section_short_desc',
			[
				'label' => esc_html__( 'Short Description', 'qomfort' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'margin_short_desc',
			[
				'label' 		=> esc_html__( 'Margin', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .ova-blog .short_desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'short_desc_typography',
				'selector' 	=> '{{WRAPPER}} .ova-blog .short_desc p',
			]
		);

		$this->add_control(
			'color_short_desc',
			[
				'label' 	=> esc_html__( 'Color', 'qomfort' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .short_desc p' => 'color : {{VALUE}};',
				],
			]
		);	

		$this->end_controls_section();
		//END SECTION TAB STYLE TITLE

		// CATEGORY TAB
		$this->start_controls_section(
			'cat_section',
			[
				'label' => esc_html__( 'Category', 'qomfort' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'cat_typography',
				'selector' 	=> '{{WRAPPER}} .ova-blog .item .category a',
			]
		);

		$this->add_responsive_control(
			'cat_padding',
			[
				'label' 		=> esc_html__( 'Padding', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .ova-blog .item .category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cat_margin',
			[
				'label' 		=> esc_html__( 'Margin', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .ova-blog .item .category a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cat_color',
			[
				'label' 	=> esc_html__( 'Color', 'qomfort' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .category a' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cat_color_hover',
			[
				'label' 	=> esc_html__( 'Color Hover', 'qomfort' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .category a:hover' => 'color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_cat_color',
			[
				'label' 	=> esc_html__( 'Background', 'qomfort' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .category a' => 'background-color : {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_cat_color_hover',
			[
				'label' 	=> esc_html__( 'Background Hover', 'qomfort' ),
				'type' 		=> \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ova-blog .item .category a:hover' => 'background-color : {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); // END Category Tab

		//SECTION TAB STYLE READMORE
		$this->start_controls_section(
			'section_readmore',
			[
				'label' => esc_html__( 'Text Link', 'qomfort' ),
				'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'margin_readmore',
			[
				'label' 		=> esc_html__( 'Margin', 'qomfort' ),
				'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .ova-blog .item .read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' 		=> 'readmore_typography',
				'selector' 	=> '{{WRAPPER}} .ova-blog .item .read-more',
			]
		);

		$this->start_controls_tabs(
				'readmore_style_tabs'
			);

			$this->start_controls_tab(
					'readmore_style_normal_tab',
					[
						'label' => esc_html__( 'Normal', 'qomfort' ),
					]
				);

				$this->add_control(
					'color_readmore',
					[
						'label' 	=> esc_html__( 'Color', 'qomfort' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-blog .item .read-more' => 'color : {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'bg_readmore',
					[
						'label' 	=> esc_html__( 'Background', 'qomfort' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-blog .item .read-more' => 'background: {{VALUE}};',
						],
					]
				);


			$this->end_controls_tab();

			$this->start_controls_tab(
					'readmore_style_hover_tab',
					[
						'label' => esc_html__( 'Hover', 'qomfort' ),
					]
				);

				$this->add_control(
					'color_readmore_hover',
					[
						'label' 	=> esc_html__( 'Color', 'qomfort' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-blog .item:hover .read-more' => 'color : {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'bg_readmore_hover',
					[
						'label' 	=> esc_html__( 'Background', 'qomfort' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-blog .item:hover .read-more' => 'background: {{VALUE}};',
						],
					]
				);

			$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		//END SECTION TAB STYLE READMORE
	}

	protected function limit_words($string, $word_limit) {
		$string = strip_tags($string);
		$words = explode(' ', strip_tags($string));
		$return = trim(implode(' ', array_slice($words, 0, $word_limit)));
		if(strlen($return) < strlen($string)){
			$return .= '...';
		}
		return $return;
	}

	// Render Template Here
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$template			= $settings['template'];
		$category 			= $settings['category'];
		$total_count 		= $settings['total_count'];
		$order 				= $settings['order'];
		$order_by 			= $settings['order_by'];
		$number_column 		= $settings['number_column'];
		$text_readmore 		= $settings['text_readmore'];
		$show_date 			= $settings['show_date'];
		$show_author 		= $settings['show_author'];
		$show_title 		= $settings['show_title'];
		$show_category 		= $settings['show_category'];
		$show_short_desc 	= $settings['show_short_desc'];
		$show_read_more 	= $settings['show_read_more'];


		$args = [];
		if ( $category == 'all' ) {
			$args = [
				'post_type' 		=> 'post',
				'posts_per_page' 	=> $total_count,
				'order' 			=> $order,
				'orderby' 			=> $order_by,
			];
		} else {
			$args = [
				'post_type' 		=> 'post', 
				'category_name'		=> $category,
				'posts_per_page' 	=> $total_count,
				'order' 			=> $order,
				'orderby' 			=> $order_by,
				'fields'			=> 'ids'
			];
		}

		$blog = new \WP_Query($args);

		?>
		
		<ul class="ova-blog <?php echo esc_attr( $template . ' ' .$number_column ) ?>">
			<?php if( $blog->have_posts() ) : while( $blog->have_posts() ) : $blog->the_post(); 
				$categories = get_the_category();
			?>
				<?php if ( $template == 'template_1' ): ?>
					<li class="item">
						<?php if( has_post_thumbnail() ) { ?>
							<div class="media">
								<?php $thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id() , 'qomfort_thumbnail' ); ?>
								<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php the_title(); ?>">
								<?php if( $show_category == 'yes' && has_category() && is_array($categories) ) { ?>
									<span class="category">
										<?php echo esc_html( $categories[0]->name ); ?> 
									</span>
								<?php } ?>
							</div>
						<?php } ?>
						<div class="info">
							<?php if ( $show_title == 'yes' && get_the_title() ) { ?>
								<h2 class="post-title">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</h2>
							<?php } ?>
							<ul class="post-meta">
								<?php if ( $show_author == 'yes' ) { ?>
									<li class="item-meta wp-author">
										<span class="left author">
											<i class="far fa-user" aria-hidden="true"></i>
										</span>
										<span class="right post-author">
											<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
												<?php the_author_meta( 'display_name' ); ?>
											</a>
										</span>
									</li>
								<?php } ?>
								<?php if ( $show_date == 'yes' ) { ?>
									<li class="item-meta post-date">
										<span class="left date">
											<i class="far fa-calendar-alt" aria-hidden="true"></i>
										</span>
										<span class="right date">
											<?php the_time( get_option( 'date_format' ) ); ?>
										</span>
									</li>
								<?php } ?>
							</ul>
							<?php if ( $show_short_desc == 'yes' && get_the_excerpt() ) { ?>
								<div class="short_desc">
									<?php echo esc_html( $this->limit_words( get_the_excerpt(), 10 ) ); ?>
								</div>
							<?php } ?>
							<?php if ( $show_read_more == 'yes' && $text_readmore ) { ?>
								<a class="read-more" href="<?php the_permalink(); ?>"
									title="<?php echo esc_attr( $text_readmore ); ?>">
									<?php  echo esc_html( $text_readmore ); ?>
									<i class="fas fa-angle-right" aria-hidden="true"></i>
								</a>
							<?php } ?>
						</div>
					</li>
				<?php elseif ( $template == 'template_2' ): ?>
					<li class="item">
						<div class="info">
							<?php if( $show_category == 'yes' && has_category() && is_array($categories) ) { ?>
								<span class="category">
									<?php echo esc_html( $categories[0]->name ); ?> 
								</span>
							<?php } ?>
							<?php if ( $show_title == 'yes' && get_the_title() ) { ?>
								<h2 class="post-title">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</h2>
							<?php } ?>
							<ul class="post-meta">
								<?php if ( $show_author == 'yes' ) { ?>
									<li class="item-meta wp-author">
										<span class="left author">
											<i class="far fa-user" aria-hidden="true"></i>
										</span>
										<span class="right post-author">
											<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
												<?php the_author_meta( 'display_name' ); ?>
											</a>
										</span>
									</li>
								<?php } ?>
								<?php if ( $show_date == 'yes' ) { ?>
									<li class="item-meta post-date">
										<span class="left date">
											<i class="far fa-calendar-alt" aria-hidden="true"></i>
										</span>
										<span class="right date">
											<?php the_time( get_option( 'date_format' ) ); ?>
										</span>
									</li>
								<?php } ?>
							</ul>
							<?php if( has_post_thumbnail() ) { ?>
								<div class="media">
									<?php 
									$thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id() , 'qomfort_thumbnail' );
									?>
									<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php the_title(); ?>">
								</div>
							<?php } ?>
							<?php if ( $show_short_desc == 'yes' && get_the_excerpt() ) { ?>
								<div class="short_desc">
									<?php echo esc_html( $this->limit_words( get_the_excerpt(), 10 ) ); ?>
								</div>
							<?php } ?>
							<?php if ( $show_read_more == 'yes' && $text_readmore ) { ?>
								<a class="read-more" href="<?php the_permalink(); ?>"
									title="<?php echo esc_attr( $text_readmore ); ?>">
									<?php  echo esc_html( $text_readmore ); ?>
									<i class="fas fa-angle-right" aria-hidden="true"></i>
								</a>
							<?php } ?>
						</div>
					</li>
				<?php elseif ( $template == 'template_3' ): ?>
					<li class="item">
						<?php if( has_post_thumbnail() ) { ?>
							<div class="media">
								<?php $thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id() , 'qomfort_thumbnail' ); ?>
								<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php the_title(); ?>">
								<?php if( $show_category == 'yes' && has_category() && is_array($categories) ) { ?>
									<span class="category">
										<?php echo esc_html( $categories[0]->name ); ?> 
									</span>
								<?php } ?>
								<ul class="post-meta">
									<?php if ( $show_author == 'yes' ) { ?>
										<li class="item-meta wp-author">
											<span class="left author">
												<i class="far fa-user" aria-hidden="true"></i>
											</span>
											<span class="right post-author">
												<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
													<?php the_author_meta( 'display_name' ); ?>
												</a>
											</span>
										</li>
									<?php } ?>
									<?php if ( $show_date == 'yes' ) { ?>
										<li class="item-meta post-date">
											<span class="left date">
												<i class="far fa-calendar-alt" aria-hidden="true"></i>
											</span>
											<span class="right date">
												<?php the_time( get_option( 'date_format' ) ); ?>
											</span>
										</li>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>
						<div class="info">
							<?php if ( $show_title == 'yes' && get_the_title() ) { ?>
								<h2 class="post-title">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</h2>
							<?php } ?>
							<?php if ( $show_short_desc == 'yes' && get_the_excerpt() ) { ?>
								<div class="short_desc">
									<?php echo esc_html( $this->limit_words( get_the_excerpt(), 10 ) ); ?>
								</div>
							<?php } ?>
							<?php if ( $show_read_more == 'yes' && $text_readmore ) { ?>
								<a class="read-more" href="<?php the_permalink(); ?>"
									title="<?php echo esc_attr( $text_readmore ); ?>">
									<?php  echo esc_html( $text_readmore ); ?>
									<i class="fas fa-angle-right" aria-hidden="true"></i>
								</a>
							<?php } ?>
						</div>
					</li>
				<?php else: ?>
					<li class="item">
						<?php if( has_post_thumbnail() ) { ?>
							<div class="media">
								<?php $thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id() , 'qomfort_thumbnail' ); ?>
								<img src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php the_title(); ?>">
								<?php if( $show_category == 'yes' && has_category() && is_array($categories) ) { ?>
									<span class="category">
										<?php echo esc_html( $categories[0]->name ); ?> 
									</span>
								<?php } ?>
								<ul class="post-meta">
									<?php if ( $show_author == 'yes' ) { ?>
										<li class="item-meta wp-author">
											<span class="left author">
												<i class="far fa-user" aria-hidden="true"></i>
											</span>
											<span class="right post-author">
												<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
													<?php the_author_meta( 'display_name' ); ?>
												</a>
											</span>
										</li>
									<?php } ?>
									<?php if ( $show_date == 'yes' ) { ?>
										<li class="item-meta post-date">
											<span class="left date">
												<i class="far fa-calendar-alt" aria-hidden="true"></i>
											</span>
											<span class="right date">
												<?php the_time( get_option( 'date_format' ) ); ?>
											</span>
										</li>
									<?php } ?>
								</ul>
							</div>
						<?php } ?>
						<div class="info">
							<?php if ( $show_title == 'yes' && get_the_title() ) { ?>
								<h2 class="post-title">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</h2>
							<?php } ?>
							<?php if ( $show_short_desc == 'yes' && get_the_excerpt() ) { ?>
								<div class="short_desc">
									<?php echo esc_html( $this->limit_words( get_the_excerpt(), 10 ) ); ?>
								</div>
							<?php } ?>
							<?php if ( $show_read_more == 'yes' && $text_readmore ) { ?>
								<a class="read-more" href="<?php the_permalink(); ?>"
									title="<?php echo esc_attr( $text_readmore ); ?>">
									<?php  echo esc_html( $text_readmore ); ?>
									<i class="fas fa-angle-right" aria-hidden="true"></i>
								</a>
							<?php } ?>
						</div>
					</li>
				<?php endif;
			endwhile; endif; wp_reset_postdata(); ?>
		</ul>
		<?php
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Blog_Grid() );