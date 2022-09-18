<?php

namespace Elementor;

/**
 * Service Icon
 *
 * @since 1.0.0
 */

class Ushop_Service_Icon extends \Elementor\Widget_Base {

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
        return 'ushop_service_icon';
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
        return __( 'Service Icons', 'ushop' );
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
        return 'fa fa-cubes';
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
    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'ushop' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'icon',
            [
                'label' => __( 'Social Icons', 'ushop' ),
                'type' => \Elementor\Controls_Manager::ICON,
                'default' => 'fa fa-map-marker'
            ]
        );
        $repeater->add_control(
            'list_title', [
                'label' => __( 'Title', 'ushop' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'List Title' , 'ushop' ),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'list_content', [
                'label' => __( 'Content', 'ushop' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => __( 'List Content' , 'ushop' ),
                'show_label' => false,
            ]
        );
        $this->add_control(
            'list',
            [
                'label' => __( 'Service Content', 'ushop' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'icon' => 'fa fa-map-marker',
                        'list_title' => __( 'Free Delivery', 'ushop' ),
                        'list_content' => __( 'For orders over $59', 'ushop' ),
                    ],
                    [
                        'icon' => 'fa fa-lock',
                        'list_title' => __( 'Secure Payment', 'ushop' ),
                        'list_content' => __( '100% safe payment', 'ushop' ),
                    ],
                    [
                        'icon' => 'fa fa-users',
                        'list_title' => __( '24/7 Support', 'ushop' ),
                        'list_content' => __( 'Dedicated support', 'ushop' ),
                    ],
                ],
                'title_field' => '{{{ list_title }}}',
            ]
        );
        $this->end_controls_section();
        // Style
        $this->start_controls_section(
            'content_style',
            [
                'label' => __( 'STYLE', 'ushop' ),
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
                'default' => 'center',
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-icon' => 'text-align: {{options}};',
                ]
            ]

        );
        // Color
        $this->add_control(
            'title_content',
            [
                'label' => __( 'Color', 'ushop' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Icon Color', 'ushop' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1fc0a0',
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-icon .fa' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'ushop' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#212529',
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-icon h5' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'content_color',
            [
                'label' => __( 'Content Color', 'ushop' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#212529',
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-icon p' => 'color: {{VALUE}}',
                ],
            ]
        );
        // Font Size
        $this->add_control(
            'font_divider',
            [
                'label' => __( 'Font Size', 'ushop' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'icon_font_size',
            [
                'label' => __( 'Icon', 'ushop' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 30,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 4,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-icon .fa' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'title_font_size',
            [
                'label' => __( 'Title', 'ushop' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 30,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 4,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-icon h5' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'content_font_size',
            [
                'label' => __( 'Content', 'ushop' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 30,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 4,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 14,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-service-icon p' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        if ( $settings['list'] ) {
            ?>
            <div class="widget-services elementor-service-icon row">
                <?php
                foreach ( $settings['list'] as $item ) {
                    ?>
                    <div class="col-lg-4 col-md-4 col-12 mt-30 position-relative">
                        <div class="mb-3">
                            <i class="<?php echo esc_attr( $item['icon'] );?>" aria-hidden="true"></i>
                        </div>
                        <div class="services-contents">
                            <div class="widgets-heading">
                                <h5><?php echo esc_html( $item['list_title'] ); ?></h5>
                            </div>
                            <p class="services-text mb-0"><?php echo esc_html( $item['list_title'] ); ?></p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <?php
        }
    }
}
Plugin::instance()->widgets_manager->register( new Ushop_Service_Icon() );