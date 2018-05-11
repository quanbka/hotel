<?php
/**
 * Content: Content Single
 * @package Starhotel
 */
?>
<!-- Blog -->
<article <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ) {
        echo the_post_thumbnail('wp-post-image', array('class' => 'img-responsive'));
    } ?>
    <div class="row">
        <div class="col-sm-1 col-xs-2 meta">
            <div class="meta-date"><span><?php the_time('M') ?></span><?php the_time('d') ?></div>
        </div>
        <div class="col-sm-11 col-xs-10 meta">
            <?php the_title( '<h2>','</h2>' ); ?>
            <span class="meta-author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
            <span class="meta-category"><i class="fa fa-pencil"></i><?php the_category(', '); ?></span>
            <span class="meta-comments"><i class="fa fa-comment"></i><a href="#">				<?php
    									printf( _n( '1 comment', '%1$s comments', get_comments_number(), 'starhotel' ),
    										number_format_i18n( get_comments_number() ) );
    								?></a></span>
            <?php edit_post_link( __( 'Edit', 'starhotel' ), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>' ); ?>
        </div>
        <div class="col-md-12">
            <?php the_content(); ?>
            <?php           wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'starhotel' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) );
            ?>
        </div>
    </div>
</article>

<?php
if (true == ($GLOBALS['sh_redux']['switch-blog-about-author'])) {
    ?>
<!-- Blog: Author -->
<div class="blog-author clearfix">
    <h3><?php printf( __( 'About the author: ', 'starhotel' )); ?><span><?php the_author_posts_link(); ?></span></h3>
    <?php
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $size = isset($_POST['size']) ? $_POST['size'] : '';
    $default = isset($_POST['default']) ? $_POST['default'] : '';
    $alt = isset($_POST['alt']) ? $_POST['alt'] : '';
    // Get Avatar
    global $current_user;
    get_currentuserinfo();
    echo get_avatar( $current_user->ID, $size, $default, $alt ); ?>
    <p><?php echo get_the_author_meta('description'); ?></p>
</div>
<?php }; ?>
