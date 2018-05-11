<?php
/**
 * The template for displaying Archive pages.
 * @package Starhotel
 */
?>

<?php get_header(); ?>

<!-- Parallax Effect -->
<?php
if (true == $sh_redux['switch-header-parallax']) {
    $parallax_header = isset($GLOBALS['sh_redux']['header-parallax-img']['url']) ? $GLOBALS['sh_redux']['header-parallax-img']['url'] : '';
?>
<script type="text/javascript">jQuery(document).ready(function(){jQuery('#parallax-pagetitle').parallax("50%", -0.55);});</script>
<div class="parallax-effect">
  <div id="parallax-pagetitle" style="background-image: url(<?php echo esc_url($parallax_header); ?>);">
    <div class="color-overlay"> 
      <!-- Page title -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <?php if (true == $sh_redux['switch-header-breadcrumbs']) { ?>                          
			    <?php the_breadcrumb(); ?>
            <?php } ?>  
                <?php if (false == $sh_redux['switch-header-breadcrumbs']) { ?>
                    <div class="mt50">
                <?php } ?>    
					<?php if ( have_posts() ) : ?>
				<h1 class="page-title">
                    <?php
                    if (is_category()) :
                        single_cat_title();
                    elseif (is_tag()) :
                        single_tag_title();
                    elseif (is_author()) :
                        printf(esc_html__('Author: %s', 'starhotel'), '<span class="vcard">' . get_the_author() . '</span>');
                    elseif (is_day()) :
                        printf(esc_html__('Day: %s', 'starhotel'), '<span>' . get_the_date() . '</span>');
                    elseif (is_month()) :
                        printf(esc_html__('Month: %s', 'starhotel'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'starhotel')) . '</span>');
                    elseif (is_year()) :
                        printf(esc_html__('Year: %s', 'starhotel'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'starhotel')) . '</span>');
                    elseif (is_tax('post_format', 'post-format-aside')) :
                        esc_html_e('Asides', 'starhotel');
                    elseif (is_tax('post_format', 'post-format-gallery')) :
                        esc_html_e('Galleries', 'starhotel');
                    elseif (is_tax('post_format', 'post-format-image')) :
                        esc_html_e('Images', 'starhotel');
                    elseif (is_tax('post_format', 'post-format-video')) :
                        esc_html_e('Videos', 'starhotel');
                    elseif (is_tax('post_format', 'post-format-quote')) :
                        esc_html_e('Quotes', 'starhotel');
                    elseif (is_tax('post_format', 'post-format-link')) :
                        esc_html_e('Links', 'starhotel');
                    elseif (is_tax('post_format', 'post-format-status')) :
                        esc_html_e('Statuses', 'starhotel');
                    elseif (is_tax('post_format', 'post-format-audio')) :
                        esc_html_e('Audios', 'starhotel');
                    elseif (is_tax('post_format', 'post-format-chat')) :
                        esc_html_e('Chats', 'starhotel');
                    else :
                        esc_html_e('Archives', 'starhotel');
                    endif;
					?>
				</h1>		
                <?php if (false == $sh_redux['switch-header-breadcrumbs']) { ?>
                    </div>
                <?php } ?>  	
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
			</div>
        </div>
      </div>
    </div>
  </div>
</div>  
<?php 
}; 
?>

<!-- Archive -->
<div class="archive">
  <div class="container">
    <div class="row">
	<div class="blog mt50">
        <?php if ($sh_redux['blog-archive-layout'] == 'left') {
            get_sidebar(); 
        } ?>   


		<div class="<?php if (($GLOBALS['$sh_redux']['blog-archive-layout'] == none)) {?>col-md-8 col-sm-offset-2 <?php } else{ ?> col-md-9 <?php } ?>">
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>
			<?php endwhile; ?>
            <?php starhotel_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		</div>
	  </div>
      <?php if ($sh_redux['blog-archive-layout'] == 'right') {
	            get_sidebar(); 
            } ?>  
    </div>
  </div>
</div>
<?php get_footer(); ?>