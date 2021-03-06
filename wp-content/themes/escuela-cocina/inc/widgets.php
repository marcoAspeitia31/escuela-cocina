<?php
/**
 * Adds Class_Widget widget.
 */
class Class_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'class_widget', // Base ID
			esc_html__( 'Classes', 'text_domain' ), // Name
			array( 'description' => esc_html__( 'Add the classes that you have created', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        if ( ! empty( $instance['numberOfClasses'] ) ) {
			$numberOfClasses = $instance['numberOfClasses'];
		}
        /* Creating a customized query to obtain the last classes */
        $args = array(
            'post_type'      => 'clases_cocina',
            'posts_per_page' => $numberOfClasses,
        );
        $classesList = new WP_Query($args);
        while($classesList->have_posts()): $classesList->the_post();
        ?>
<div class="card mb-4">
    <?php the_post_thumbnail( 'mediano', array('class' => 'img-fluid') ); ?>
    <div class="card-body">
        <h3 class="card-title">
            <?php the_title(); ?>
        </h3>
        <p class="card-subtitle m-0">
            <?php echo get_post_meta( get_the_ID() ,'edc_classes_class_subtittle' , true); ?>
        </p>
    </div>
    <!-- card-body -->
    <div class="card-footer">
        <a href="<?php the_permalink(); ?>">Más información</a>
    </div>
    <!-- card-footer -->
</div>
<!-- main card -->

<?php
    endwhile; wp_reset_postdata();
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
        $numberOfClasses = ! empty( $instance['numberOfClasses'] ) ? $instance['numberOfClasses'] : esc_html__( 'New numberOfClasses', 'text_domain' );
		?>
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
        <?php esc_attr_e( 'Title:', 'text_domain' ); ?>
    </label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
        value="<?php echo esc_attr( $title ); ?>">
</p>
<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'numberOfClasses' ) ); ?>">
        <?php esc_attr_e( 'Number of classes to display:', 'text_domain' ); ?>
    </label>
    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'numberOfClasses' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'numberOfClasses' ) ); ?>" type="number"
        value="<?php echo esc_attr( $numberOfClasses ); ?>">
</p>
<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['numberOfClasses'] = ( ! empty( $new_instance['numberOfClasses'] ) ) ? sanitize_text_field( $new_instance['numberOfClasses'] ) : '';
		return $instance;
	}

} // class Class_Widget

// register class_Widget widget
function register_class_widget() {
    register_widget( 'Class_Widget' );
}
add_action( 'widgets_init', 'register_class_widget' );