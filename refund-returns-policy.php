<?php
/**
 * Template Name: Refund and Returns Policy
 *
 * @package SoulSuite
 */
get_header();
?>
<div class="refund-policy-container">
  <div class="container">
    <h1 class="section-title">Refund & Returns Policy</h1>
    <div class="refund-policy-content">
      <?php echo wp_kses_post( get_theme_mod('refund_policy_content', '<p>Please enter your refund and returns policy here.</p>') ); ?>
    </div>
  </div>
</div>

<?php
/**
 * Template Name: Refund & Returns Policy
 * 
 * @package SoulSuite
 */

get_header();
?>

<div id="primary" class="content-area policy-page">
  <main id="main" class="site-main">
        
    <div class="page-header">
      <div class="container">
        <h1><?php the_title(); ?></h1>
      </div>
    </div>
        
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <article class="policy-content">
            <?php
            while (have_posts()) :
              the_post();
              the_content();
            endwhile;
            ?>
          </article>
                    
          <div class="policy-footer">
            <p><strong>Last Updated:</strong> <?php echo get_the_modified_date(); ?></p>
                        
            <div class="policy-cta">
              <h3>Have Questions?</h3>
              <p>If you have any questions about our refund and returns policy, please contact us.</p>
              <a href="<?php echo get_permalink(get_page_by_path('contact')); ?>" class="hero-btn primary-btn">
                Contact Us
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
        
  </main>
</div>

<?php
get_footer();
