<?php
/**
 * Displays Feature Box
 *
 */

class uShop_Widget_Feature_Box extends WP_Widget {

    public function __construct() {
        $widget_ops = array(
            'classname' => 'ushop-widget-feature-box',
            'description' => __( 'Displays Feature Box', 'ushop' ),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'ushop-widget-feature-box', __( 'uShop : Feature Box', 'ushop' ), $widget_ops );
        $this->alt_option_name = 'ushop_widget_feature_box';
    }
    public function widget( $args, $instance )
    {
        if ( !isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $image_uri = ( !empty($instance['image_uri']) ) ? $instance['image_uri'] : '';
        $title = ( !empty($instance['title']) ) ? $instance['title'] : '';
        $content = ( !empty($instance['content']) ) ? $instance['content'] : '';
        $content2 = ( !empty($instance['content2']) ) ? $instance['content2'] : '';

        echo $args['before_widget']; ?>
        <div class="widget-feature-box row">
            <div class="feature-box-contents col-lg-6 col-md-6 col-12 align-self-center">
                <?php if( $title != '' ) { ?>
                    <div class="widgets-heading mb-3">
                        <h3><?php echo esc_html( $title ); ?></h3>
                    </div>
                <?php }
                if( $content != '' ) { ?>
                    <p class="feature-box-text"><?php echo esc_html( $content ); ?></p>
                <?php }
                if( $content2 != '' ) { ?>
                    <p class="feature-box-text"><?php echo esc_html( $content2 ); ?></p>
                <?php }
                ?>
            </div>
            <?php if( $image_uri != '' ) { ?>
                <div class="feature-box-contents-img mb-3 col-lg-6 col-md-6 col-12 align-self-center">
                   <?php echo '<img src="' . esc_url( $image_uri ) . '" class="img-fluid" />'; ?>
                </div>
            <?php } ?>
        </div>
        <?php echo $args['after_widget'];
    }
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['image_uri'] = esc_url_raw( $new_instance['image_uri'] );
        $instance['content'] = sanitize_text_field( $new_instance['content'] );
        $instance['content2'] = sanitize_text_field( $new_instance['content2'] );
        return $instance;
    }
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $content     = isset( $instance['content'] ) ? esc_attr( $instance['content'] ) : '';
        $content2     = isset( $instance['content2'] ) ? esc_attr( $instance['content2'] ) : '';
        $image_uri     = isset( $instance['image_uri'] ) ? esc_url( $instance['image_uri'] ) : '';
        ?>
        <div class="ushop-wrap">
            <div class="full-width">
                <div class="col-12">
                    <h2>
                        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'ushop' ); ?></label>
                        <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
                    </h2>
                    <h2>
                        <label for="<?php echo $this->get_field_id( 'content' ); ?>"><?php _e( 'Content', 'ushop' ); ?></label>
                        <textarea  class="widefat" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" ><?php echo $content; ?></textarea>
                    </h2>
                    <h2>
                        <label for="<?php echo $this->get_field_id( 'content2' ); ?>"><?php _e( 'Content 2', 'ushop' ); ?></label>
                        <textarea  class="widefat" id="<?php echo $this->get_field_id( 'content2' ); ?>" name="<?php echo $this->get_field_name( 'content2' ); ?>" ><?php echo $content2; ?></textarea>
                    </h2>
                    <h2>
                        <label for="<?php echo $this->get_field_id('image_uri'); ?>"><?php _e( 'Upload Image', 'ushop' ); ?></label>
                        <?php if ( $image_uri ) : ?>
                            <img class="custom_media_image ushop-custom_media_image" src="<?php echo $image_uri; ?>" /><br />
                        <?php endif; ?>
                        <input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $image_uri; ?>"><br />
                        <input type="button" class="button button-primary custom_media_button ushop_image_btn" id="custom_media_button" value="<?php _e( 'Upload Image', 'ushop' ) ?>" />
                    </h2>
                </div>

            </div>
        </div>
        <?php
    }
}