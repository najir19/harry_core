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
class Harry_Heading extends Widget_Base
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
		return 'harry-heading';
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
		return __('Harry Heading', 'harry-core');
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
			'harry_heading_section',
			[
				'label' => esc_html__('Heading Content', 'harry_core'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		//  sub title
		$this->add_control(
			'harry_sub_title',
			[
				'label' => esc_html__('Sub Title', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Past Projects', 'harry_core'),
				'placeholder' => esc_html__('Past Projects', 'harry_core'),
				'label_block' => true,

			]
		);
		//  main tittle
		$this->add_control(
			'harry_main_title',
			[
				'label' => esc_html__('Main Title', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('The work I did for client.', 'harry_core'),
				'placeholder' => esc_html__('The work I did for client.', 'harry_core'),
				'label_block' => true,

			]
		);

		// switch for active item 
		$this->add_control(
			'is_center',
			[
				'label' => esc_html__('Is Center ?', 'harry-core'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'harry-core'),
				'label_off' => esc_html__('Hide', 'harry-core'),
				'return_value' => 'no',
				'default' => '',
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
		$is_center = $settings['is_center'] ? 'is-center' : '';

?>

		<div class="section__title-wrapper-9 mb-65 <?php echo esc_attr($is_center); ?>">
			<?php if (!empty($settings['harry_sub_title'])): ?>
				<span class="section__title-pre-9"><?php echo esc_html($settings['harry_sub_title']); ?></span>
			<?php endif; ?>

			<?php if (!empty($settings['harry_main_title'])): ?>
				<h3 class="section__title-9"><?php echo esc_html($settings['harry_main_title']); ?></h3>
			<?php endif; ?>
		</div>

<?php
	}
}
