<?php
/**
 * Displays Trending Products
 *
 */

class uShop_Widget_Trending_Products extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'ushop-widget-trending-products',
            'description' => __( 'Displays Trending Products', 'ushop' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'ushop-widget-trending-products', __( 'uShop : Trending Products', 'ushop' ), $widget_ops );
        $this->alt_option_name = 'ushop_widget_trending_products';
    }
    public function widget( $args, $instance )
    {
        if ( !isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }
        $title = ( !empty($instance['title']) ) ? $instance['title'] : '';
        $view_all = ( !empty($instance['view_all']) ) ? $instance['view_all'] : '';
        $limit = ( ! empty( $instance['limit'] ) ) ? absint( $instance['limit'] ) : 3;
        $enable_slider = ! empty( $instance[ 'slider' ] ) ? 1 : 0;

        $slider_class = '';
        if ( $enable_slider == true ){
            $slider_class = '-products';
        }

        echo $args['before_widget']; ?>
        <div class="widget-trending-products woo-img-center add-btn-hover text-center">
            <?php if( $title != '' ) { ?>
                <div class="widgets-heading mb-5">
                    <?php echo $args['before_title'] . esc_html( $title ) . $args['after_title']; ?>
                </div>
            <?php } ?>
            <div class="trending-products-contents">
                <?php echo do_shortcode( '[products limit="' . $limit . '" class="treading'. $slider_class .'" best_selling="true" ]' );  ?>
                <?php if ( $view_all != '' ) : ?>
                    <a href="<?php echo esc_url( $view_all ); ?>" class="view-all text-uppercase"><?php esc_html_e( 'View All', 'ushop' ); ?></a>
                <?php endif; ?>
            </div>
        </div>
        <?php echo $args['after_widget'];
    }
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['view_all'] = esc_url_raw( $new_instance['view_all'] );;
        $instance['limit'] = absint( $new_instance['limit'] );
        $instance[ 'slider' ] = absint( $new_instance[ 'slider' ] );
        return $instance;
    }
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $view_all     = isset( $instance['view_all'] ) ? esc_url( $instance['view_all'] ) : '';
        $limit     = isset( $instance['limit'] ) ? absint( $instance['limit'] ) : 3;
        $slider = !empty( $instance['slider'] ) ? $instance['slider'] : '' ;
        ?>
        <div class="ushop-wrap">
            <div class="full-width">
                <div class="col-12">
                    <h2>
                        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'ushop' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
                    </h2>
                </div>
                <div class="col-12">
                    <h2>
                        <label for="<?php echo $this->get_field_id( 'view_all' ); ?>"><?php _e( 'View All URL', 'ushop' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'view_all' ); ?>" name="<?php echo $this->get_field_name( 'view_all' ); ?>" type="text" value="<?php echo $view_all; ?>" />
                    </h2>
                </div>
                <div class="col-3">
                    <h5>
                        <label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Number of products to show.', 'ushop' ); ?></label>
                        <input class="tiny-text" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" step="1" min="1" value="<?php echo $limit; ?>" size="3" />
                    </h5>
                </div>
                <div class="col-3">
                    <h5>
                        <label>
                            <input class="checkbox" type="checkbox" name="<?php echo $this->get_field_name( 'slider' ); ?>" id="<?php echo $this->get_field_id( 'slider' ); ?>" value="1" <?php checked( $slider, '1' ); ?>>
                            <span><?php _e( 'Enable Slider', 'ushop' ); ?></span>
                        </label>
                    </h5>
                </div>
            </div>
        </div>
        <?php
    }
}