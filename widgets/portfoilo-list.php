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
class Harry_Portfolio_List extends Widget_Base
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
		return 'harry-portfolio-list';
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
		return __('Harry Portfolio', 'harry-core');
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
			'harry_portfolio_section',
			[
				'label' => esc_html__('Portfolio Section', 'harry_core'),
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

		//  image
		$repeater->add_control(
			'harry_portfolio_bg_image',
			[
				'label' => esc_html__('Choose Image', 'harry_core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'harry_portfolio_repeater_list',
			[
				'label'  => esc_html__('Portfolio List', 'harry_core'),
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

		<!-- portfolio area start -->
		<section class="portfolio__area portfolio__overlay-9 fix">
			<div class="container-fluid gx-0">
				<div class="row gx-0">
					<div class="col-xxl-12">
						<div class="portfolio__slider-9 has-scrollbar p-relative">
							<div class="portfolio__slider-active-9 swiper-container">
								<div class="swiper-wrapper">
									<?php foreach ($settings['harry_portfolio_repeater_list'] as $single_portfolio_item) :
									?>
										<div class="portfolio__item-9 w-img swiper-slide wow fadeInUp" data-wow-delay=".3s" data-wow-duration="1s">
											<div class="portfolio__thumb-9" style="background-image:url(<?php echo esc_url($single_portfolio_item['harry_portfolio_bg_image']['url']) ?>)"></div>
											<div class="portfolio__content-9">
												<?php if (!empty($single_portfolio_item['harry_sub_title'])): ?>
													<div class="portfolio__tag-9">
														<span>
															<a href="<?php echo esc_url($single_portfolio_item['harry_item_url']) ?>"><?php echo esc_html($single_portfolio_item['harry_sub_title']) ?></a>
														</span>
													</div>
												<?php endif ?>
												<?php if (!empty($single_portfolio_item['harry_main_title'])): ?>
													<h3 class="portfolio__title-9">
														<a href="<?php echo esc_url($single_portfolio_item['harry_item_url']) ?>"><?php echo esc_html($single_portfolio_item['harry_main_title']) ?></a>
													</h3>
												<?php endif ?>
											</div>
										</div>
									<?php endforeach ?>
								</div>
							</div>
							<div class="portfolio__nav-9 d-none d-sm-block">
								<button type="button" class="portfolio-button-prev-9"><i class="fa-regular fa-chevron-left"></i></button>
								<button type="button" class="portfolio-button-next-9"><i class="fa-regular fa-chevron-right"></i></button>
							</div>
							<div class="tp-scrollbar mt-70 mb-50 grey-bg-12"></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- portfolio area end -->
<?php
	}
}
