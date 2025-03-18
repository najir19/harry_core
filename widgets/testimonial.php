<?php

namespace HarryCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (! defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Harry Core
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Harry_Testimonial extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'harry-testimonial';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return __('Harry Testimonial', 'harry-core');
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-posts-ticker';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['harry-category'];
	}

	/**
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends()
	{
		return ['harry-core'];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls()
	{
		$repeater = new \Elementor\Repeater();
		// Progress section
		$this->start_controls_section(
			'harry_testimonial_section',
			[
				'label' => esc_html__('testimonial Section', 'harry_core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		//  sub title
		$repeater->add_control(
			'harry_client_name',
			[
				'label' => esc_html__('Client Name', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Strategy', 'harry_core'),
				'placeholder' => esc_html__('Strategy', 'harry_core'),
				'label_block' => true,

			]
		);
		//  main tittle
		$repeater->add_control(
			'harry_main_title',
			[
				'label' => esc_html__('Main Title', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('We Create Great Things', 'harry_core'),
				'placeholder' => esc_html__('We Create Great Things', 'harry_core'),
				'label_block' => true,

			]
		);

		// url
		$repeater->add_control(
			'harry_description',
			[
				'label' => esc_html__('Description', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Put Description here...', 'harry_core'),
				'label_block' => true,

			]
		);

		//  image
		$repeater->add_control(
			'harry_testimonial_image',
			[
				'label' => esc_html__('Choose Image', 'harry_core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'harry_testimonial_repeater_list',
			[
				'label'  => esc_html__('testimonial List', 'harry_core'),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
			]
		);
		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

?>
		<section class="tstimonial_are pt-130 pb-135">
			<div class="container">
				<div class="testimonial__slider-9 p-relative">

					<div class="testimonial__slider-active-9">
						<?php foreach ($settings['harry_testimonial_repeater_list'] as $single_testimonial_item) :
						?>
							<div class="testimonial__item-9">
								<div class="testimonial__content-9 text-center">
									<div class="testimonial__shape-quote-9">
										<img src="<?php echo get_template_directory_uri() ?>/assets/img/testimonial/9/testimonial-quote-1.png" alt="">
									</div>
									<?php if (!empty($single_testimonial_item['harry_main_title'])): ?>
										<h4 class="testimonial-heading"><?php echo esc_html($single_testimonial_item['harry_main_title']) ?></h4>
									<?php endif ?>
									<?php if (!empty($single_testimonial_item['harry_description'])): ?>
										<p>“ <?php echo esc_html($single_testimonial_item['harry_description']) ?> ” </p>
									<?php endif ?>
									<div class="testimonial__avater-info-9">
										<?php if (!empty($single_testimonial_item['harry_client_name'])): ?>
											<h3 class="testimonial__avater-title-9"><?php echo esc_html($single_testimonial_item['harry_client_name']) ?></h3>
										<?php endif ?>
									</div>
								</div>
							</div>

						<?php endforeach ?>
					</div>

					<div class="row justify-content-center">
						<div class="col-xxl-6 col-xl-6 col-lg-7 col-md-10 col-sm-8">
							<div class="testimonial__slider-nav-9 mt-35 mb-15 ml-25 mr-25">
								<?php foreach ($settings['harry_testimonial_repeater_list'] as $single_testimonial_item) :
								?>
									<div class="testimonial__slider-9-thumb-nav">
										<div class="tp-border-loader">
											<svg width="116" height="116" viewBox="0 0 116 116" fill="none" xmlns="http://www.w3.org/2000/svg">
												<circle cx="58" cy="58" r="56.5" stroke-width="0"></circle>
												<circle cx="58" cy="58" r="56.5" stroke-width="3" stroke-linecap="round" style="stroke-dashoffset: -356px; stroke-dasharray: 0px, 366px;"></circle>
											</svg>
										</div>
										<img src="<?php echo esc_url($single_testimonial_item['harry_testimonial_image']['url']) ?>" alt="">
									</div>
								<?php endforeach ?>
							</div>

						</div>
					</div>
					<div class="testimonial__slider-arrow-9 d-none d-md-block"><button type="button" class="slick-prev testimonial-9-button-prev slick-arrow" style=""><i class="fa-regular fa-arrow-left"></i><span>Preview</span></button>

						<button type="button" class="slick-next testimonial-9-button-next slick-arrow" style=""><span>Next</span><i class="fa-regular fa-arrow-right"></i></button>
					</div>
				</div>
			</div>
		</section>
<?php
	}
}
