<?php
/**
 * The main template file, never delete this!
 * @package Starhotel
 */

get_header(); ?>

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
            <?php the_title( '<h1>', '</h1>' ); ?>
            <?php if (false == $sh_redux['switch-header-breadcrumbs']) { ?>
                </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  
<?php 
}; 
?>

<div class="container">
    <div class="row">
        <!-- Blog -->
        <div class="blog mt50">
        <?php if ($sh_redux['blog-archive-layout'] == 'left') {
            get_sidebar(); 
        } ?>     
    <div class="<?php if ($sh_redux['blog-archive-layout'] == 'none') {?>col-md-8 col-sm-offset-2 <?php } else{ ?> col-md-9 <?php } ?>">
                <?php if ( have_posts() ) : ?>
                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php
                        get_template_part( 'content-blog', get_post_format() );
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

<?php get_footer(); ?>
