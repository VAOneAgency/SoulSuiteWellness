<?php
/**
 * Template Part: Services Section
 * 
 * @package SoulSuite
 */

$services_title = get_option('soul_suite_services_title', 'Soul Services');
$services_subtitle = get_option('soul_suite_services_subtitle');
$services = get_option('soul_suite_services', array());

// Default services if none configured
if (empty($services)) {
  $services = array(
    array(
      'title' => 'Individual Wellness Coaching',
      'description' => 'One-on-one sessions focused on your personal wellness journey',
      'price' => 'Starting at $150',
      'tag' => 'Individual',
      'image' => '',
      'square_url' => function_exists('soul_suite_get_square_url') ? soul_suite_get_square_url('individual') : '#',
    ),
    array(
      'title' => 'Business Wellness Programs',
      'description' => 'Comprehensive wellness solutions for your team',
      'price' => 'Custom Pricing',
      'tag' => 'Business',
      'image' => '',
      'square_url' => function_exists('soul_suite_get_square_url') ? soul_suite_get_square_url('business') : '#',
    ),
  );
}
?>

<section class="soul-services">
  <div class="container">
    <?php if ($services_title): ?>
      <h1><?php echo esc_html($services_title); ?></h1>
    <?php endif; ?>
        
    <?php if ($services_subtitle): ?>
      <p class="services-subtitle"><?php echo esc_html($services_subtitle); ?></p>
    <?php endif; ?>
        
    <div class="services-grid">
      <?php foreach ($services as $service): ?>
        <div class="service-card">
          <div class="service-header">
            <?php if (!empty($service['image'])): ?>
              <img src="<?php echo esc_url($service['image']); ?>" alt="<?php echo esc_attr($service['title']); ?>" class="service-image">
            <?php endif; ?>
                        
            <h2><?php echo esc_html($service['title']); ?></h2>
                        
            <?php if (!empty($service['tag'])): ?>
              <span class="service-tag"><?php echo esc_html($service['tag']); ?></span>
            <?php endif; ?>
          </div>
                    
          <div class="service-content">
            <?php if (!empty($service['description'])): ?>
              <p><?php echo esc_html($service['description']); ?></p>
            <?php endif; ?>
                        
            <?php if (!empty($service['features']) && is_array($service['features'])): ?>
              <ul>
                <?php foreach ($service['features'] as $feature): ?>
                  <li><?php echo esc_html($feature); ?></li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
          </div>
                    
          <div class="service-footer">
            <?php if (!empty($service['price'])): ?>
              <div class="service-price <?php echo (strtolower($service['price']) === 'free') ? 'free-service' : ''; ?>">
                <?php echo esc_html($service['price']); ?>
              </div>
            <?php endif; ?>
                        
            <?php if (!empty($service['square_url'])): ?>
              <a href="<?php echo esc_url($service['square_url']); ?>" class="service-btn" target="_blank">
                Book Now
              </a>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
</h2>
          <span class="service-tag">Metro Atlanta</span>
        </div>
        <div class="service-content">
  <p>In-person Reiki offers a powerful way to restore balance in your body, mind, and spirit through gentle energy healing.</p>
  <p>Sessions may include intuitive channeling and crystal healing to help you release blockages and reconnect with your true self.</p>
  <p>✨ Serving Metro Atlanta. Ready to feel clear, aligned, and renewed? Book your 𝟰 𝘀𝗲𝘀𝘀𝗶𝗼𝗻 𝗽𝗮𝗰𝗸𝗮𝗴𝗲 𝘁𝗼𝗱𝗮𝘆. If you you'd like to explore the option of adding coaching support through the 𝗪𝗲𝗹𝗹𝗦𝗥™ 𝗣𝗼𝗿𝘁𝗮𝗹, schedule a Wellness Suite Clarity Call for either an 𝗶𝗻𝗱𝗶𝘃𝗶𝗱𝘂𝗮𝗹 or 𝗯𝘂𝘀𝗶𝗻𝗲𝘀𝘀 𝘀𝘁𝗮𝗸𝗲𝗵𝗼𝗹𝗱𝗲𝗿.</p>
</div>
        <div class="service-footer">
          <div class="service-price">$555.00</div>
          <a href="https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/2OIBU3CYV3YAZ47L2YXJTAVP" class="service-btn">Book Now - 1 hr</a>
        </div>
      </div>

      <!-- Extended Mobile Reiki -->
      <div class="service-card">
        <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/30mile.png" alt="Extended Mobile Reiki" class="service-image">
        <div class="service-header">
          <h2>(𝗡𝗼𝗻-𝗖𝗼𝗮𝗰𝗵𝗶𝗻𝗴) 𝗠𝗼𝗯𝗶𝗹𝗲 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝗿𝘃𝗶𝗰𝗲 - 𝗠𝗲𝘁𝗿𝗼 𝗔𝘁𝗹𝗮𝗻𝘁𝗮 | 𝗣𝗮𝗰𝗸𝗮𝗴𝗲 𝗼𝗳 𝟰
</h2>
          <span class="service-tag">Up to 30 Miles Outside Metro Atlanta</span>
        </div>
  <div class="service-content">
    <p>Discover the healing power of in-person Reiki—a gentle, energy-based practice designed to clear blockages and restore balance in your body, mind, and spirit. Sessions may include intuitive channeling and crystal healing to help you release blockages and reconnect with your true self.</p>
    <p>✨ Ready to reconnect with your center? Book your 𝟰 𝘀𝗲𝘀𝘀𝗶𝗼𝗻 𝗽𝗮𝗰𝗸𝗮𝗴𝗲 now and take the first step toward clarity and peace. If you you'd like to explore the option of adding coaching support through the 𝗪𝗲𝗹𝗹𝗦𝗥™ 𝗣𝗼𝗿𝘁𝗮𝗹, schedule a Wellness Suite Clarity Call for either an 𝗶𝗻𝗱𝗶𝘃𝗶𝗱𝘂𝗮𝗹 or 𝗯𝘂𝘀𝗶𝗻𝗲𝘀𝘀 𝘀𝘁𝗮𝗸𝗲𝗵𝗼𝗹𝗱𝗲𝗿.</p>
  </div>
        <div class="service-footer">
  <div class="service-price">$888.00</div>
  <a href="https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/GISRJASPYOZGFQIPTRV35KZO" class="service-btn">Book Now - 1 hr</a>
</div>

    </div>
  </div>
</section>
