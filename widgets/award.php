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
class Harry_Award extends Widget_Base
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
		return 'harry-award';
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
		return __('Harry Award', 'harry-core');
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
			'harry_award_section',
			[
				'label' => esc_html__('award Section', 'harry_core'),
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
			'harry_item_topic',
			[
				'label' => esc_html__('Award Topic', 'harry_core'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Art direction 2021', 'harry_core'),
				'label_block' => true,

			]
		);

		//  image
		$repeater->add_control(
			'harry_award_image',
			[
				'label' => esc_html__('Choose Image', 'harry_core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'harry_award_repeater_list',
			[
				'label'  => esc_html__('award List', 'harry_core'),
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


		<div class="award__item-wrapper-9">
			<?php foreach ($settings['harry_award_repeater_list'] as $single_award_item) :
			?>
				<div class="award__item-9 p-relative wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
					<div class="row align-items-center">
						<div class="col-xl-3 col-lg-3 col-md-3">
							<?php if (!empty($single_award_item['harry_item_topic'])): ?>
								<div class="award__topic">
									<p><?php echo esc_html($single_award_item['harry_item_topic']) ?></p>
								</div>
							<?php endif ?>
						</div>
						<div class="col-xl-7 col-lg-7 col-md-7">
							<div class="award__content-9">
								<h3 class="award__title-9">
									<a href="<?php echo esc_url($single_award_item['harry_item_url']) ?>" class="tp-img-reveal tp-img-reveal-item" data-img="<?php echo esc_url($single_award_item['harry_award_image']['url']) ?>" data-fx="1"><?php echo esc_html($single_award_item['harry_main_title']) ?></a>
								</h3>
								<?php if (!empty($single_award_item['harry_sub_title'])): ?>
									<p><?php echo esc_html($single_award_item['harry_sub_title']) ?></p>
								<?php endif ?>
							</div>
						</div>
						<div class="col-xl-2 col-lg-2 col-md-2">
							<div class="award__btn-9 text-md-end">
								<a href="<?php echo esc_url($single_award_item['harry_item_url']) ?>" class="career-link-btn">
									<svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M12.7334 1L21 9.00007L12.7334 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
										<path d="M0.999999 8.99756H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach ?>
		</div>


<?php
	}
}
