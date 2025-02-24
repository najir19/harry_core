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
class Harry_about_me_Section extends Widget_Base
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
		return 'about-me';
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
		return __('About Me', 'harry-core');
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
		// Title and content section
		$this->start_controls_section(
			'harry_title_section',
			[
				'label' => esc_html__('Title and content', 'harry_core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		//  sub title
		$this->add_control(
			'harry_sub_title',
			[
				'label' => esc_html__('Sub Title', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('About Me', 'harry_core'),
				'placeholder' => esc_html__('About Me', 'harry_core'),
				'label_block' => true,

			]
		);
		//  main tittle
		$this->add_control(
			'harry_main_title',
			[
				'label' => esc_html__('Main Title', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('My name is micael,', 'harry_core'),
				'placeholder' => esc_html__('My name is micael,', 'harry_core'),
				'label_block' => true,

			]
		);
		//  descritpion 
		$this->add_control(
			'harry_description',
			[
				'label' => esc_html__('Description', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__('Over the past 12 years, I"ve worked with a diverse range of clients, from startups to fortune 500 companies.', 'harry_core'),
				'placeholder' => esc_html__('Over the past 12 years, I"ve worked with a diverse range of clients, from startups to fortune 500 companies.', 'harry_core'),
				'label_block' => true,

			]
		);
		$this->end_controls_section();


		// BUTTON section 
		$this->start_controls_section(
			'harry_button_section',
			[
				'label' => esc_html__('Button', 'harry_core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		//  button 
		$this->add_control(
			'harry_button',
			[
				'label' => esc_html__('Button Text', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Download CV', 'harry_core'),
				'placeholder' => esc_html__('Download CV', 'harry_core'),
				'label_block' => true,

			]
		);
		//  button url 
		$this->add_control(
			'harry_button_url',
			[
				'label' => esc_html__('Button URL', 'harry_core'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
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
		if (! empty($settings['harry_button_url']['url'])) {
			$this->add_link_attributes('harry_button_url', $settings['harry_button_url']);
		}

?>


		<!-- about area start -->
		<section class="about__area about__space-145">
			<div class="about__inner-9 black-bg wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-xxl-10 col-xl-10 col-lg-11 col-md-10">
							<div class="about__wrapper-9">
								<?php if (!empty($settings['harry_sub_title'])): ?>
									<span class="about-subtitle"><?php echo esc_html($settings['harry_sub_title']); ?></span>
								<?php endif ?>
								<?php if (!empty($settings['harry_main_title'])): ?>
									<h3 class="about-title"><?php echo wp_kses_post($settings['harry_main_title']); ?></h3>
								<?php endif ?>
								<?php if (!empty($settings['harry_description'])): ?>
									<p><?php echo esc_html($settings['harry_description']); ?></p>
								<?php endif ?>
								<?php if (!empty($settings['harry_button'])): ?>
									<div class="about__btn-9">
										<a <?php $this->print_render_attribute_string('harry_button_url'); ?> target="_blank" class="tp-btn-5 tp-btn-5-white"><?php echo esc_html($settings['harry_button']); ?></a>
									</div>
								<?php endif ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- about area end -->
<?php
	}
}
