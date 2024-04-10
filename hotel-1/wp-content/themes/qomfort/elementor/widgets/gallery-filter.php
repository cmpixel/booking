<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Qomfort_Elementor_Gallery_Filter extends Widget_Base {

	public function get_name() {
		return 'qomfort_elementor_gallery_filter';
	}

	public function get_title() {
		return esc_html__( 'Gallery Filter', 'qomfort' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'qomfort' ];
	}

	public function get_script_depends() {
		wp_enqueue_script( 'isotope', get_template_directory_uri().'/assets/libs/isotope/isotope.pkgd.min.js', array('jquery'), false, true );
		wp_enqueue_style('fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.css');
		wp_enqueue_script('fancybox', get_template_directory_uri().'/assets/libs/fancybox/fancybox.umd.js', array('jquery'), false, true);
		return [ 'qomfort-elementor-gallery-filter' ];
	}
	
	// Add Your Controll In This Function
	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'qomfort' ),
			]
		);

			// Add Class control
			$this->add_control(
				'number_column',
				[
					'label' => esc_html__( 'Layout', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'three_column',
					'options' => [
						'three_column' => esc_html__( '3 Columns', 'qomfort' ),
						'four_column'  => esc_html__( '4 Columns', 'qomfort' ),
					],
				]
			);

			$this->add_control(
				'cateAll',
				[
					'label' => esc_html__( 'Text Show All', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__('Show all','qomfort'),
				]
			);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'link',
				[
					'label' => esc_html__( 'Link', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'qomfort' ),
					'options' => [ 'url', 'is_external', 'nofollow' ],
					'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
					],
					'description' => esc_html__('( If you enter the link, it will redirect to the link instead of Fancybox popup )','qomfort'),
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'video_link',
				[
					'label' => esc_html__( 'Embed Video Link', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => esc_html__( 'https://your-link.com', 'qomfort' ),
					'options' => [ 'url', 'is_external', 'nofollow' ],
					'default' => [
						'url' => '',
						'is_external' => false,
						'nofollow' => false,
					],
					'description' => 'https://www.youtube.com/watch?v=MLpWrANjFbI',
					'dynamic' => [
						'active' => true,
					],
				]
			);

			$repeater->add_control(
				'icon',
				[
					'label' => esc_html__( 'Icon', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'ovaicon ovaicon-next-4',
						'library' => 'all',
					],
				]
			);

			$repeater->add_control(
				'category',
				[
					'label'   => esc_html__( 'Category', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( 'Hotel', 'qomfort' ),
				]
			);

			$repeater->add_control(
				'title',
				[
					'label'   => esc_html__( 'Title', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'rows' => 3,
					'default' =>  esc_html__( 'Swimming Pool', 'qomfort' ),
				]
			);

			$repeater->add_control(
				'image',
				[
					'label'   => esc_html__( 'Image Gallery', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'image_popup',
				[
					'label'   => esc_html__( 'Image Popup', 'qomfort' ),
					'type'    => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'tab_item',
				[
					'label'		=> esc_html__( 'Items Gallery', 'qomfort' ),
					'type'		=> \Elementor\Controls_Manager::REPEATER,
					'fields'  	=> $repeater->get_controls(),
					'default' 	=> [
						[
							'category' => esc_html__('Hotel', 'qomfort'),
						],
						[
							'category' => esc_html__('Beach', 'qomfort'),
						],
						[
							'category' => esc_html__('Restaurant', 'qomfort'),
						],
						[
							'category' => esc_html__('Room', 'qomfort'),
						],
						[
							'category' => esc_html__('Restaurant', 'qomfort'),
						],
						[
							'category' => esc_html__('Room', 'qomfort'),
						],
						[
							'category' => esc_html__('Restaurant', 'qomfort'),
						],
						[
							'category' => esc_html__('Hotel', 'qomfort'),
						],
						[
							'category' => esc_html__('Beach', 'qomfort'),
						],
					],
					'title_field' => '{{{ title }}}',
				]
			);

		$this->end_controls_section();

		/* BEGIN WRAP CATEGORY STYLE */
		$this->start_controls_section(
            'wrap_category_style',
            [
                'label' => esc_html__( 'Wrap Category', 'qomfort' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'wrap_category_border',
					'label' => esc_html__( 'Border', 'qomfort' ),
					'selector' => '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper',
				]
			);

			$this->add_responsive_control(
	            'wrap_category_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'qomfort' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'wrap_category_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'qomfort' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* END WRAP CATEGORY STYLE */

		/* BEGIN CATEGORY FILTER STYLE */
		$this->start_controls_section(
            'filter_style',
            [
                'label' => esc_html__( 'Filter', 'qomfort' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 	=> 'filter_typography',
					'selector' 	=> '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn',	
				]
			);

			$this->add_control(
	            'filter_color_normal',
	            [
	                'label' 	=> esc_html__( 'Color', 'qomfort' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn' => 'color: {{VALUE}}',
	                ],
	            ]
	        );

			$this->add_control(
	            'filter_color_active',
	            [
	                'label' 	=> esc_html__( 'Color Active', 'qomfort' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn.active-category' => 'color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'border_filter',
					'label' => esc_html__( 'Border', 'qomfort' ),
					'selector' => '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn',
				]
			);

			$this->add_control(
	            'filter_border_color_active',
	            [
	                'label' 	=> esc_html__( 'Border Color Active', 'qomfort' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn.active-category' => 'border-color: {{VALUE}}',
	                ],
	            ]
	        );

			$this->add_responsive_control(
	            'filter_padding',
	            [
	                'label' 		=> esc_html__( 'Padding', 'qomfort' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'filter_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'qomfort' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-gallery-filter .filter-btn-wrapper li.filter-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* END CATEGORY FILTER STYLE */

		/* BEGIN IMAGE STYLE */
		$this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'qomfort' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'image_height',
				[
					'label' 		=> esc_html__( 'Height', 'qomfort' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> ['px'],
					'range' => [
						'px' => [
							'min' => 300,
							'max' => 500,
							'step' => 10,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img img' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
	            'overlay_bgcolor',
	            [
	                'label' 	=> esc_html__( 'Overlay Color', 'qomfort' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .mask' => 'background-color: {{VALUE}}',
	                ],
	            ]
	        );

		$this->end_controls_section();
		/* END IMAGE STYLE */

		/* BEGIN ICON STYLE */
		$this->start_controls_section(
			'section_icon_style',
			[
				'label' => esc_html__( 'Icon', 'qomfort' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		    $this->add_responsive_control(
				'icon_size',
				[
					'label' 		=> esc_html__( 'Size', 'qomfort' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px'],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 40,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
				'icon_bgsize',
				[
					'label' 		=> esc_html__( 'Background Size', 'qomfort' ),
					'type' 			=> Controls_Manager::SLIDER,
					'size_units' 	=> [ 'px'],
					'range' => [
						'px' => [
							'min' => 48,
							'max' => 130,
							'step' => 1,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'icon_rotate',
				[
					'label' => esc_html__( 'Rotate', 'qomfort' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
					'default' => [
						'unit' => 'deg',
						'size' => -45,
					],
					'tablet_default' => [
						'unit' => 'deg',
					],
					'mobile_default' => [
						'unit' => 'deg',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					],
				]
			);

			$this->add_responsive_control(
				'icon_rotate_hover',
				[
					'label' => esc_html__( 'Rotate Hover', 'qomfort' ),
					'type' => Controls_Manager::SLIDER,
					'size_units' => [ 'deg', 'grad', 'rad', 'turn', 'custom' ],
					'default' => [
						'unit' => 'deg',
						'size' => -135,
					],
					'tablet_default' => [
						'unit' => 'deg',
					],
					'mobile_default' => [
						'unit' => 'deg',
					],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon:hover i' => 'transform: rotate({{SIZE}}{{UNIT}});',
					],
				]
			);


			$this->add_control(
				'bg_border_radius_icon',
				[
					'label' => esc_html__( 'Border Radius', 'qomfort' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->start_controls_tabs( 'tabs_icons_style' );
				
				$this->start_controls_tab(
		            'tab_icon_normal',
		            [
		                'label' => esc_html__( 'Normal', 'qomfort' ),
		            ]
		        );

		            $this->add_control(
						'color_icon',
						[
							'label' => esc_html__( 'Color', 'qomfort' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon i' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'bgcolor_icon',
						[
							'label' => esc_html__( 'Background Color', 'qomfort' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon' => 'background-color : {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();

		        $this->start_controls_tab(
		            'tab_icon_hover',
		            [
		                'label' => esc_html__( 'Hover', 'qomfort' ),
		            ]
		        );

		            $this->add_control(
						'color_icon_hover',
						[
							'label' => esc_html__( 'Color Hover', 'qomfort' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon:hover i' => 'color : {{VALUE}};',
							],
						]
					);

					$this->add_control(
						'bgcolor_icon_hover',
						[
							'label' => esc_html__( 'Background Color Hover', 'qomfort' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .ova-gallery-filter .gallery-item .gallery-img .icon-box .icon:hover' => 'background-color : {{VALUE}};',
							],
						]
					);

		        $this->end_controls_tab();

		     $this->end_controls_tabs();

        $this->end_controls_section();
        /* END ICON STYLE */

		/* BEGIN TITLE STYLE */
		$this->start_controls_section(
	            'title_style',
	            [
	                'label' => esc_html__( 'Title', 'qomfort' ),
	                'tab' 	=> Controls_Manager::TAB_STYLE,
	            ]
	        );

        	$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 	=> 'name_typography',
					'selector' 	=> '{{WRAPPER}} .ova-gallery-filter .gallery-item .title',	
				]
			);

			$this->add_control(
	            'name_color',
	            [
	                'label' 	=> esc_html__( 'Color', 'qomfort' ),
	                'type' 		=> Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .ova-gallery-filter .gallery-item .title' => 'color: {{VALUE}}',
	                ],
	            ]
	        );

	        $this->add_responsive_control(
	            'name_margin',
	            [
	                'label' 		=> esc_html__( 'Margin', 'qomfort' ),
	                'type' 			=> Controls_Manager::DIMENSIONS,
	                'size_units' 	=> [ 'px', '%', 'em' ],
	                'selectors' 	=> [
	                    '{{WRAPPER}} .ova-gallery-filter .gallery-item .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

        $this->end_controls_section();
        /* END TITLE STYLE */
	}

	protected function slugify($text, string $divider = '-') {

	  	// replace non letter or digits by divider
	  	$text = preg_replace('~[^\pL\d]+~u', $divider, $text);

	  	// remove unwanted characters
	  	$text = preg_replace('~[^-\w]+~', '', $text);

	  	// trim
	  	$text = trim($text, $divider);

	  	// remove duplicate divider
	  	$text = preg_replace('~-+~', $divider, $text);

	  	// lowercase
	  	$text = strtolower($text);

	  	if (empty($text)) {
	    	return '';
	  	}

	  	return $text;

	}

	// Render Template Here
	protected function render() {
		$settings = $this->get_settings();

		$tabs 	  = $settings['tab_item'];
		$cateAll  = $settings['cateAll'];

		$number_column = $settings['number_column'];

		$cate_array = array();

		?>

		<?php if ( $tabs && is_array( $tabs ) ): ?>

		<div class="ova-gallery-filter">

			<?php foreach ( $tabs as $key => $items ):

            	$category = $items['category'];

            	array_push($cate_array,$category);
            	$cate_array = array_unique($cate_array);

			endforeach; ?>
            
            <ul class="filter-btn-wrapper">

                <li class="filter-btn active-category" data-filter="*">
                    <?php echo esc_html( $cateAll ); ?>
                </li>

                <?php if ( $cate_array ) : foreach ( $cate_array as $cate) :
                	$slug = $this->slugify($cate); 
                ?>

                    <?php if( $cate != '' ) { ?>
	                	<li class="filter-btn" data-slug=".<?php echo esc_attr($slug);?>">
		                    <?php echo esc_html( $cate ); ?>
		                </li>
		            <?php } ?>

	            <?php endforeach; endif; ?>

            </ul> 

            <div class="gallery-row">

            	<div class="gallery-column <?php echo esc_attr( $number_column ) ?>">

            		<?php foreach ( $tabs as $key => $items ):
                        
                        $category2  	= $items['category'];
                        $slug2 			= $this->slugify($category2);
	  					$title 			= $items['title'];

	  					$img_id 		= $items['image']['id']; 
                        $img_url 		= $items['image']['url'];

                        $img_popup_id 	= $items['image_popup']['id'];
                        $img_popup_url 	= $items['image_popup']['url'];

                        $thumbnail_url  = isset(wp_get_attachment_image_src( $img_id, 'qomfort_thumbnail' )[0]) ? wp_get_attachment_image_src( $img_id, 'qomfort_thumbnail' )[0] : '';
                        if( $thumbnail_url == '') {
                        	$thumbnail_url = $img_url;
                        }
                        if ( ! $img_popup_url ) {
                        	$img_popup_url = $img_url;
                        }
                        
                        // alt and caption
	  					$img_alt 		= ( isset($items['image']['alt']) && $items['image']['alt'] != '' ) ? $items['image']['alt'] : $title;
	  					$caption        = wp_get_attachment_caption( $img_id );

	  					if ( $caption == '' ) {
	  						$caption = $img_alt;
	  					}

	  					// link
	  					$video_link = $items['video_link']['url'];
                        $link 		= $items['link']['url'];
						$target 	= $items['link']['is_external'] ? 'target="_blank"' : '';
	  				?>

		            	<div class="gallery-item <?php echo esc_attr($slug2);?>">
                            <?php if( $video_link ) { ?>
                            	<a class="gallery-fancybox" data-src="<?php echo esc_url( $video_link ); ?>" 
                            		href="<?php echo esc_attr($video_link); ?>"
	  								data-fancybox="gallery-filter" 
	  								data-caption="<?php echo esc_attr( $caption ); ?>">
	  						<?php } elseif ( $link ) { ?>
	  							<a href="<?php echo esc_attr($link); ?>" <?php printf( $target ); ?>>
                            <?php } else { ?>
                            	<a href="#" class="gallery-fancybox" data-src="<?php echo esc_url( $img_popup_url ); ?>" 
	  								data-fancybox="gallery-filter" 
	  								data-caption="<?php echo esc_attr( $caption ); ?>">
                            <?php } ?>
								<div class="gallery-img">
							    	<img src="<?php echo esc_url( $thumbnail_url ) ?>" alt="<?php echo esc_attr($img_alt); ?>">
							    	<div class="icon-box">
							    		<div class="icon">
							    			<?php \Elementor\Icons_Manager::render_icon( $items['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							    		</div>
							    		<h2 class="title"><?php echo esc_html( $title ); ?></h2>
									</div>
									<div class="mask"></div>
								</div>
							</a>
						</div>
	                
	                <?php endforeach; ?>

	            </div>

            </div>

        </div>

        <?php endif;
	}

	
}
$widgets_manager->register( new Qomfort_Elementor_Gallery_Filter() );