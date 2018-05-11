<?php
/**
 * The template for displaying Comments.
 * @package Starhotel
 */
if ( post_password_required() ) {
    return;
}
?>

<!-- Blog: Comments -->
<div class="comments mt50">
    <?php if ( have_comments() ) : ?>
        <div class="blog-comments">
            <h2 class="lined-heading">
              <span class="meta-comments"><i class="fa fa-comment"></i><a href="#">				<?php
      									printf( _n( '1 comment', '%1$s comments', get_comments_number(), 'starhotel' ),
      										number_format_i18n( get_comments_number() ) );
      								?></a></span>
            </h2>
        </div>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-above" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'starhotel' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'starhotel' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'starhotel' ) ); ?></div>
            </nav><!-- #comment-nav-above -->
        <?php endif; // check for comment navigation ?>

        <?php wp_list_comments( 'type=comment&callback=sh_comment' ); ?>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
            <nav id="comment-nav-below" class="comment-navigation" role="navigation">
                <h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'starhotel' ); ?></h1>
                <div class="nav-previous"><?php previous_comments_link( esc_html__( '&larr; Older Comments', 'starhotel' ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments &rarr;', 'starhotel' ) ); ?></div>
            </nav><!-- #comment-nav-below -->
        <?php endif; // check for comment navigation ?>
    <?php endif; // have_comments() ?>

    <?php
    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'starhotel' ); ?></p>
    <?php endif; ?>

    <?php
    $required_text = isset($_POST['required_text']) ? $_POST['required_text'] : '';

    ob_start();
    comment_form( $args = array(
            'id_form'           => 'commentform',
            'id_submit'         => 'submit',
            'title_reply'       => '<i class="fa fa-comment mt50"></i>'. esc_html__( 'Leave a Reply' , 'starhotel' ),
            'title_reply_to'    => esc_html__( 'Leave a Reply to %s' , 'starhotel' ),
            'cancel_reply_link' => esc_html__( 'Cancel Reply'  , 'starhotel' ),
            'label_submit'      => esc_html__( 'Post Comment'  , 'starhotel' ),
            'comment_field' =>  '<div class="form-group"><label for="comment">' .( $req ? '<span class="required">*</span>' : '' ) . esc_html__( 'Comment', 'starhotel' ) . '</label> ' .
                '<textarea id="comment" name="comment" rows="9" class="form-control" aria-required="true">' .
                '</textarea></div>',

            'must_log_in' => '<p class="must-log-in">' .
                sprintf(
                    __( 'You must be <a href="%s">logged in</a> to post a comment.', 'starhotel' ),
                    wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
                ) . '</p>',

            'logged_in_as' => '<p class="logged-in-as">' .
                sprintf(
                    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'starhotel' ),
                    admin_url( 'profile.php' ),
                    $user_identity,
                    wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
                ) . '</p>',

            'comment_notes_before' => '<p class="comment-notes">' .
                __( '' , 'starhotel' ) . ( $req ? $required_text : '' ) .
                '</p>',

            'comment_notes_after' => '<p class="form-allowed-tags">' .
                sprintf(
                    __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'starhotel' ),
                    ' <code>' . allowed_tags() . '</code>'
                ) . '</p>',

            'fields' => apply_filters( 'comment_form_default_fields', array(

                    'author' =>
                        '<div class="form-group">' .
                        '<label for="author">' .( $req ? '<span class="required">*</span>' : '' ) . __( 'Name', 'starhotel' ) . '</label> ' .
                        '<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) .
                        '" size="30"' . $aria_req = ( $req ? " aria-required='true'" : '' ) . ' /></div>',

                    'email' =>
                        '<div class="form-group"><label for="email">' .( $req ? '<span class="required">*</span>' : '' ) . __( 'Email', 'starhotel' ) . '</label> ' .
                        '<input id="email" name="email" type="text" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                        '" size="30"' . $aria_req . ' ',

                    'url' =>
                        '<div class="form-group"><label for="url">' .
                        __( 'Website', 'starhotel' ) . '</label>' .
                        '<input id="url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) .
                        '" size="30" /></div>'
                )
            ),
        )
    );

    $form = ob_get_clean();
    $form = str_replace('class="comment-form"','class="comment-form mt30"', $form);
	$form = str_replace('id="submit"','', $form);
    echo str_replace('class="submit"','class="submit btn btn-ghost-color btn-lg"', $form);
    ?>
</div>
