<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Product Category
 *
 * @since 1.0.0
 */

class Ushop_Product_Category extends Widget_Base {

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
        return 'product_category_tab';
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
        return __( 'Product Tab', 'ushop' );
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
        return 'fa fa-table';
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

        $this->start_controls_section(
            'category_post_section',
            [
                'label' => __( 'Setting', 'ushop' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'ushop' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Title', 'ushop' ),
                'placeholder' => __( 'Title', 'ushop' ),
            ]
        );
        $cat_ID_array = $this->prepare_cats_for_select();
        $this->add_control(
            'categories',
            [
                'label' => __( 'Product categories', 'ushop' ),
                'type' => Controls_Manager::SELECT2,
                'dynamic' => [
                    'active' => true,
                ],
                'options' => $cat_ID_array,
                'multiple' => true
            ]
        );
        $this->add_control(
            'limit',
            [
                'label' => __( 'Limit', 'ushop' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 32,
                'step' => 1,
                'default' => 8,
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'category_STYLE_section',
            [
                'label' => __( 'STYLE', 'ushop' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        // Title & Content
        $this->add_control(
            'title_content',
            [
                'label' => __( 'Color & Typography', 'ushop' ),
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
                    '{{WRAPPER}} .elementor-widget-category-filter .title-heading' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'ushop' ),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-widget-category-filter .title-heading',
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
        $limit = absint( $settings['limit'] );
        $cat_name_val = '';
        $title = $settings['title'];

        $get_cat_val = $settings['categories'];

        ?>
        <div class="widget-category-filter elementor-widget-category-filter woo-img-center add-btn-hover text-center">
            <div class="widgets-heading mb-5">
                <h2 class="title-heading"><?php echo esc_html( $title ); ?></h2>
            </div>
            <?php if( !empty ( $get_cat_val )  ) : ?>
                <div class="category-filter-contents">
                    <ul class="list-inline category-filter-wrap mb-5">
                        <li class="list-inline-item">
                            <a href="#" data-filter="*" class="current"><?php esc_html_e( 'All', 'ushop' ); ?></a>
                        </li>
                        <?php
                        foreach ( $settings['categories'] as $value ) {
                            $cat_name = get_term_by( 'id', $value, 'product_cat' );
                            $cat_name_val .= $cat_name->name.',';
                            ?>
                            <li class="list-inline-item"><a href="#" data-filter=".product_cat-<?php echo esc_attr( $cat_name->slug )?>"><?php echo esc_html( $cat_name->name ); ?></a></li>
                            <?php

                        }
                        $cat_name_val = substr( $cat_name_val, 0, strlen($cat_name_val)-1 );
                        ?>
                    </ul>
                    <?php
                    echo do_shortcode( '[products  limit="' . $limit . '" class="category-filter" columns="4" category="' .$cat_name_val. '"]' );
                    ?>
                </div>
            <?php endif; ?>
        </div>
        <?php

    }

    /**
     * Prepare posts to be used in the SELECT2 field
     */
    private function prepare_cats_for_select() {

        $orderby = 'name';
        $order = 'asc';
        $hide_empty = false;
        $cat_args = array(
            'orderby'    => $orderby,
            'order'      => $order,
            'hide_empty' => $hide_empty,
        );
        $product_categories = get_terms( 'product_cat', $cat_args );
        $options = ['' => ''];
        if( !empty($product_categories) ){
            foreach ($product_categories as $cat) {
                $options[$cat->term_id] = $cat->name;
            }
        }
        return $options;
    }
}

Plugin::instance()->widgets_manager->register( new Ushop_Product_Category() );