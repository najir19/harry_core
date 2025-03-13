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
class Harry_Experience extends Widget_Base
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
		return 'harry-experience';
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
		return __('Harry experience', 'harry-core');
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
			'harry_experience_section',
			[
				'label' => esc_html__('experience Section', 'harry_core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		//  sub title
		$repeater->add_control(
			'harry_sub_title',
			[
				'label' => esc_html__('Sub Title', 'harry_core'),
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
			'harry_item_url',
			[
				'label' => esc_html__('Item URL', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('#', 'harry_core'),
				'label_block' => true,

			]
		);
		// date
		$repeater->add_control(
			'harry_item_date',
			[
				'label' => esc_html__('Experience Date', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('April 2020 - Present', 'harry_core'),
				'label_block' => true,

			]
		);

		//  image
		$repeater->add_control(
			'harry_experience_image',
			[
				'label' => esc_html__('Choose Image', 'harry_core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'harry_experience_repeater_list',
			[
				'label'  => esc_html__('experience List', 'harry_core'),
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


		<div class="career__wrapper career__style-2 pl-60">
			<h4 class="career__title">Experience</h4>
			<?php foreach ($settings['harry_experience_repeater_list'] as $single_experience_item) :
			?>
				<div class="career__item transition-3 white-bg d-sm-flex align-items-center justify-content-between wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">

					<div class="career__info d-sm-flex align-items-center">
						<div class="career__logo mr-20">
							<span>
								<img src="<?php echo esc_url($single_experience_item['harry_experience_image']['url']) ?>" alt="">
							</span>
						</div>
						<div class="career__info-content">
							<?php if (!empty($single_experience_item['harry_main_title'])): ?>
								<h3 class="career__info-title"><?php echo esc_html($single_experience_item['harry_main_title']) ?></h3>
							<?php endif ?>
							<?php if (!empty($single_experience_item['harry_sub_title'])): ?>
								<span class="career__info-designation"><?php echo esc_html($single_experience_item['harry_sub_title']) ?></span>
							<?php endif ?>
						</div>
					</div>
					<div class="career__year text-sm-end">
						<div class="career__btn">
							<a href="<?php echo esc_url($single_experience_item['harry_item_url']) ?>" class="career-link-btn">
								<span>
									<svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M17.7392 15.2608L18.0502 5.05021L7.83967 5.36134" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M5.32384 17.7797L18.0518 5.05176" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</span>
							</a>
						</div>
						<div class="career__year-info">
							<?php if (!empty($single_experience_item['harry_item_date'])): ?>
								<p><?php echo esc_html($single_experience_item['harry_item_date']) ?></p>
							<?php endif ?>
						</div>
					</div>

				</div>
			<?php endforeach ?>
		</div>
<?php
	}
}
