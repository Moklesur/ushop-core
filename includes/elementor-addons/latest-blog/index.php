<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Blog
 *
 * @since 1.0.0
 */

class Ushop_Latest_Blog extends Widget_Base {

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
        return 'latest_blog';
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
        return __( 'Recent Blog', 'ushop' );
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
        return 'fa fa-rss';
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
            'latest_blog_section',
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
                'default' => __( 'Latest Blog', 'ushop' ),
                'placeholder' => __( 'Title', 'ushop' ),
            ]
        );
        $this->add_control(
            'limit',
            [
                'label' => __( 'Limit', 'ushop' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 15,
                'step' => 1,
                'default' => 3,
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
                'default' => '#212529',
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-latest-blog .title-heading' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'ushop' ),
                'selector' => '{{WRAPPER}} .elementor-widget-latest-blog .title-heading',
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
        $limit = $settings['limit'];
        $title = $settings['title'];

        $recent_posts = new \WP_Query( array(
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'posts_per_page'	  => absint( $limit ),
            'ignore_sticky_posts' => true
        ) );

        if ( $recent_posts->have_posts() ) :
        ?>
        <div class="widget-recent-blog row elementor-widget-latest-blog">

            <?php if( esc_html( $title ) != '' ) { ?>
            <div class="col-lg-12 col-12 text-center">
                <h2 class="title-heading"><?php echo esc_html( $title ); ?></h2>
            </div>
            <?php }

            while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                <div class="col-lg-4 col-sm-6 col-12">
                    <div class="recent-post-wrap">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="entry-thumbnail mb-3 mt-30">
                                <?php ushop_post_thumbnail(); ?>
                            </div>
                        <?php endif; ?>
                        <div class="recent-post-contents">
                            <?php
                            the_title( '<h4 class="entry-title mb-2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
                            if ( 'post' === get_post_type() ) : ?>
                                <div class="entry-meta">
                                    <?php ushop_posted_on(); ?>
                                </div><!-- .entry-meta -->
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php
            wp_reset_postdata();
        endif;
    }
}
Plugin::instance()->widgets_manager->register( new Ushop_Latest_Blog() );