<?php
/**
 * The template for displaying 404 pages (Not Found).
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
			         <h1><?php esc_html_e('404 Page not found' , 'starhotel' );?></h1>
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

<!-- 404 -->
<div class="error-404">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 class="fadeIn appear"><?php esc_html_e('404' , 'starhotel' );?></h2>
        <h3 class="fadeIn appear" data-start="700"><?php esc_html_e('Well this is embarrassing... We can&#39;t find your page.' , 'starhotel' );?></h3>
        <a class="btn btn-lg btn-ghost-color mt30 fadeIn appear" data-start="1000" href="<?php echo esc_url(home_url()); ?>"><i class="fa fa-home"></i> <?php esc_html_e('Go back to home' , 'starhotel' );?></a> </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
