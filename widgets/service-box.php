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
class Harry_Service_Section extends Widget_Base
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
		return 'service-box';
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
		return __('Service Box', 'harry-core');
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
			'harry_service_box_section',
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
				'default' => esc_html__('86 Project', 'harry_core'),
				'placeholder' => esc_html__('86 Project', 'harry_core'),
				'label_block' => true,

			]
		);
		//  main tittle
		$this->add_control(
			'harry_main_title',
			[
				'label' => esc_html__('Main Title', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Website design', 'harry_core'),
				'placeholder' => esc_html__('Website design', 'harry_core'),
				'label_block' => true,

			]
		);

		// select field
		$this->add_control(
			'select_your_icon_method',
			[
				'label' => esc_html__('Select Your Icon Method', 'harry-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'svg_code' => esc_html__('Svg', 'harry-core'),
					'icon' => esc_html__('Icon', 'harry-core'),
				],
			]
		);

		// harry services icons
		$this->add_control(
			'harry_services_icon',
			[
				'label' => esc_html__('Icon', 'harry-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-smile',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
				'condition' => [
					'select_your_icon_method' => 'icon',
				],
			]
		);

		// svg code 	
		$this->add_control(
			'harry_svg_code',
			[
				'label' => esc_html__('SVG', 'harry-core'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__('Put Your SVG Code here', 'harry-core'),
				'placeholder' => esc_html__('Put Your SVG Code here', 'harry-core'),
				'condition' => [
					'select_your_icon_method' => 'svg_code',
				],
			]

		);


		//  icon url 
		$this->add_control(
			'harry_icon_url',
			[
				'label' => esc_html__('URL', 'harry_core'),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => ['url', 'is_external', 'nofollow'],
				'default' => [
					'url' => '#',
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
		if (! empty($settings['harry_icon_url']['url'])) {
			$this->add_link_attributes('harry_icon_url', $settings['harry_icon_url']);
		}

?>

		<!-- services area start -->
		<div class="services__item-9 mb-30 transition-3">
			<div class="services__item-9-top d-flex align-items-start justify-content-between">
				<div class="services__icon-9">
					<span>
						<?php if (!empty($settings['select_your_icon_method'] == 'icon')): ?>
							<?php \Elementor\Icons_Manager::render_icon($settings['harry_services_icon'], ['aria-hidden' => 'true']); ?>
						<?php else: ?>
							<?php echo $settings['harry_svg_code']; ?>
						<?php endif; ?>

						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/services/9/services-icon-shape.png" alt="">
					</span>
				</div>
				<?php if (!empty($settings['harry_icon_url']['url'])): ?>
					<div class="services__btn-9">
						<a <?php $this->print_render_attribute_string('harry_icon_url'); ?>><i class="fa-light fa-arrow-up-right"></i></a>
					</div>
				<?php endif; ?>
			</div>
			<div class="services__content-9">
				<?php if (!empty($settings['harry_sub_title'])): ?>
					<span class="services-project"><?php echo esc_html($settings['harry_sub_title']); ?></span>
				<?php endif ?>

				<?php if (!empty($settings['harry_main_title'])): ?>
					<h3 class="services__title-9">
						<?php if (!empty($settings['harry_icon_url']['url'])): ?>
							<a <?php $this->print_render_attribute_string('harry_icon_url'); ?>><?php echo wp_kses_post($settings['harry_main_title']); ?></a>
						<?php else: ?>
							<?php echo wp_kses_post($settings['harry_main_title']); ?>
						<?php endif ?>
					</h3>
				<?php endif; ?>
			</div>
		</div>
		<!-- services area end -->


<?php
	}
}
