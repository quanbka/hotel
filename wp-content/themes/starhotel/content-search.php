<?php
/**
 * The template part for displaying results in search pages.
 * @package Starhotel
 */
?>

<article>
    <?php if ( has_post_thumbnail() ) {
        echo '<a class="mask" href="' . esc_url(get_permalink($post->ID)) . '" >';
        the_post_thumbnail('wp-post-image', array('class' => 'img-responsive, zoom-img'));
        echo '</a>';
    } ?>
    <div class="row">
        <div class="col-sm-1 col-xs-2 meta">
            <div class="meta-date"><span><?php the_time('M') ?></span><?php the_time('d') ?></div>
        </div>
        <div class="col-sm-11 col-xs-10 meta">
            <?php the_title( sprintf( '<h2><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            <span class="meta-author"><i class="fa fa-user"></i><?php the_author_posts_link(); ?></span>
            <span class="meta-category"><i class="fa fa-pencil"></i><?php the_category(', '); ?></span>
            <span class="meta-comments"><i class="fa fa-comment"></i><a href="#">				<?php
    									printf( _n( '1 comment', '%1$s comments', get_comments_number(), 'starhotel' ),
    										number_format_i18n( get_comments_number() ) );
    								?></a></span>
            <?php edit_post_link( esc_html__( 'Edit', 'starhotel' ), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>' ); ?>
        </div>
        <div class="col-md-12">
            <div class="intro"><?php the_content( '<span class="btn btn-lg btn-primary pull-right">'.esc_html__( 'Continue reading', 'starhotel' ) . '</span>' ); ?></div>
       <?php wp_link_pages( array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'starhotel' ) . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
            ) ); ?>
        </div>
    </div>
</article>
