<?php
/**
 * Displays Recent Blog
 *
 */

class uShop_Widget_Recent_Blog extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'ushop-widget-recent-blog',
            'description' => __( 'Displays Recent Blog', 'ushop' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'ushop-widget-recent-blog', __( 'uShop : Recent Blog', 'ushop' ), $widget_ops );
        $this->alt_option_name = 'ushop_widget_recent_blog';
    }
    public function widget( $args, $instance )
    {
        if ( !isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 3;
        if ( ! $number )
            $number = 3;

        $recent_posts = new WP_Query( array(
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'posts_per_page'	  => $number,
            'ignore_sticky_posts' => true
        ) );


        echo $args['before_widget'];
        if ($recent_posts->have_posts()) :
            ?>
            <div class="widget-recent-blog row">
                <div class="col-lg-12 col-12 text-center">
                    <?php if ( $title ) echo $args['before_title'] . $title . $args['after_title']; ?>
                </div>
                <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
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
            <?php wp_reset_postdata();
        endif;
        echo $args['after_widget'];
    }
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] 			= sanitize_text_field($new_instance['title']);
        $instance['number'] 		= (int) $new_instance['number'];
        return $instance;
    }
    public function form( $instance ) {
        $title     			= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number   			= isset( $instance['number'] ) ? absint( $instance['number'] ) : 3;

        ?>
        <div class="ushop-wrap">
            <div class="full-width">
                <h2>
                    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'ushop' ); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
                </h2>
                <h2>
                    <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'ushop' ); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" />
                </h2>
            </div>
        </div>
        <?php
    }
}