<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Treading Product
 *
 * @since 1.0.0
 */

class Ushop_Trading_Products extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'Ushop_Trading_Products';
    }

    /**
     * Get widget title.
     *
     * Retrieve oEmbed widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return __( 'Trading Product', 'ushop' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve oEmbed widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */

    public function get_icon() {
        return 'fa fa-product-hunt';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the oEmbed widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */

    public function get_categories() {
        return [ 'ushop' ];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function _register_controls() {
        // Content
        $this->start_controls_section(
            'ushop_trading_product_Content',
            [
                'label' => __( 'Content', 'ushop' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'ushop' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Trading Products', 'ushop' )
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'ushop' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'VIEW ALL', 'ushop' )
            ]
        );
        $this->add_control(
            'button_url',
            [
                'label' => __( 'Button URL', 'ushop' ),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'ushop' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        // Product Settings
        $this->add_control(
            'ushop_trading_product_settings',
            [
                'label' => __( 'Product Settings', 'ushop' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'product_limit',
            [
                'label' => __( 'Product Limit', 'ushop' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 3,
                'max' => 30,
                'step' => 1,
                'default' => 6,
            ]
        );
        $this->add_control(
            'enable_slider',
            [
                'label' => __( 'Enable Slider', 'ushop' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'ushop' ),
                'label_off' => __( 'No', 'ushop' ),
                'return_value' => 'off'
            ]
        );
        $this->end_controls_section();
        // Content Alignment
        $this->start_controls_section(
            'ushop_trading_product_style',
            [
                'label' => __( 'Style', 'ushop' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'trading_product_content_align',
            [
                'label' => __( 'Alignment', 'ushop' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'ushop' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'ushop' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'ushop' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'center',
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-trending-products' => 'text-align: {{options}};',
                ]
            ]

        );
        // Title & Content
        $this->add_control(
            'title_content',
            [
                'label' => __( 'Color', 'ushop' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'ushop' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#212529',
                'selectors' => [
                    '{{WRAPPER}} .elementor-trending-products h2' => 'color: {{VALUE}}',
                ],
            ]
        );
        // Button
        $this->add_control(
            'button',
            [
                'label' => __( 'BUTTON', 'ushop' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Text Color', 'ushop' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .view-all' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'button_text_bg',
            [
                'label' => __( 'Background Color', 'ushop' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#1fc0a0',
                'selectors' => [
                    '{{WRAPPER}} .view-all' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function render() {
        $settings = $this->get_settings_for_display();

        $target = $settings['button_url']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['button_url']['nofollow'] ? ' rel="nofollow"' : '';
        $limit = $settings['product_limit'];

        $slider_class = '';
        if ( 'off' === $settings['enable_slider'] ) {
            $slider_class = '-products';
        }

        ?>
        <div class="widget-trending-products elementor-trending-products woo-img-center add-btn-hover">
            <h2><?php echo esc_html( $settings['title'] ); ?></h2>
            <div class="trending-products-contents">
                <?php
                echo do_shortcode( '[products limit="' . $limit . '" class="treading'. $slider_class .'" best_selling="true" ]' );
                ?>
                <a href="<?php echo esc_url( $settings['button_url']['url'] ); ?>" <?php echo esc_attr( $target ) .' '. esc_attr( $nofollow ); ?> class="view-all text-uppercase"><?php echo esc_html( $settings['button_text'] ); ?></a>
            </div>
        </div>
        <?php
    }
    protected function _content_template() {}
}

Plugin::instance()->widgets_manager->register( new Ushop_Trading_Products() );