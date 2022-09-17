<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Hero Banner
 *
 * @since 1.0.0
 */

class Ushop_Hero_Banner extends Widget_Base {

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
        return 'ushop_hero_banner';
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
        return __( 'Hero Banner', 'ushop' );
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
        return 'fa fa-picture-o';
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
            'ushop_hero_Content',
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
                'default' => __( 'Summer Collection 2020', 'ushop' )
            ]
        );
        $this->add_control(
            'paragraph',
            [
                'label' => __( 'Paragraph', 'ushop' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'The most famous ecommerce theme', 'ushop' )
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'ushop' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'BUY PRO', 'ushop' )
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

        $this->end_controls_section();

        // Banner
        $this->start_controls_section(
            'ushop_hero_banner',
            [
                'label' => __( 'Banner', 'ushop' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'banner',
            [
                'label' => __( 'Choose Image', 'ushop' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->end_controls_section();
        // Content Alignment
        $this->start_controls_section(
            'ushop_style',
            [
                'label' => __( 'Style', 'ushop' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        // Alignment
        $this->add_responsive_control(
            'content_align',
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
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .hero-content' => 'text-align: {{options}};',
                ]
            ]

        );
        // Title & Content
        $this->add_control(
            'title_content',
            [
                'label' => __( 'Title & Content', 'ushop' ),
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
                    '{{WRAPPER}} .hero-content h2' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => __( 'Content Color', 'ushop' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Scheme_Color::get_type(),
                    'value' => \Elementor\Scheme_Color::COLOR_1,
                ],
                'default' => '#212529',
                'selectors' => [
                    '{{WRAPPER}} .hero-content p' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .hero-content a' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .hero-content a' => 'background: {{VALUE}}',
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
        ?>
        <section class="hero-area position-relative elementor-hero-area">
            <div class="container-fluid">
                <div class="hero-content">
                    <div class="container-fluid">
                        <h2><?php echo esc_html( $settings['title'] ); ?></h2>
                        <p>
                            <?php echo esc_html( $settings['paragraph'] );  ?>
                        </p>
                        <a href="<?php echo esc_url( $settings['button_url']['url'] ); ?>" <?php echo esc_attr( $target ) .' '. esc_attr( $nofollow ); ?> class="text-uppercase"><?php echo esc_html( $settings['button_text'] ); ?></a>
                    </div>
                </div>
            </div>
            <img src="<?php echo esc_url( $settings['banner']['url'] ); ?>" class="img-fluid">
        </section>
        <?php
    }

    protected function _content_template() {
        ?>
        <#
        var target = settings.button_url.is_external ? ' target="_blank"' : '';
        var nofollow = settings.button_url.nofollow ? ' rel="nofollow"' : '';
        #>
        <section class="hero-area position-relative">
            <div class="container-fluid">
                <div class="hero-content">
                    <div class="container-fluid">
                    <h2>{{{ settings.title }}}</h2>
                    <p>{{{ settings.paragraph }}}</p>
                    <a href="{{ settings.button_url.url }}"{{ target }}{{ nofollow }}>{{{ settings.button_text }}}</a>
                    <img src="{{ settings.banner.url }}">
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}

Plugin::instance()->widgets_manager->register( new Ushop_Hero_Banner() );