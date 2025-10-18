<?php
/**
 * The template part for displaying landing page content
 * 
 * Template Name: Landing Page
 * description: The template for displaying landing page content
 *
 * @package Monalisa
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/landing-page.css">
</head>

<body <?php body_class(); ?>>
    <!-- Hero Section -->
<section class="hero-section" style="background-image: url('https://soulsuitewellness.com/wp-content/uploads/2025/07/Home-page.png');">
        <div class="container">
            <div class="hero-content">
                <div class="hero-logo">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/cropped-logo-e1752929960469.png" alt="Soul Suite Wellness Logo" class="logo">
                </div>
                <h1 class="hero-title">Wellness Suite Recovery Portal™ (WellSR Portal)</h1>
                <h2 class="hero-subtitle">Decode. Disrupt. Heal. Exit.</h2>
                <p class="hero-description">A transformational portal for healthcare and wellness leaders—and their teams—ready to break free from exhaustion and reclaim sustainable power.</p>
                <div class="hero-buttons">
                    <a href="https://soulsuitewellness.com/intake-form/" class="hero-btn primary-btn">Book a Clarity Call</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Burnout Cycle Section -->
    <section class="burnout-section">
        <div class="container">
            <h2 class="section-title">Breaking the Cycle</h2>
            
            <div class="burnout-content">
                <div class="burnout-image">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/AdobeStock_187293579_Preview.webp" alt="Wellness candles representing peace and transformation">
                </div>
                
                <div class="burnout-text">
                    <div class="burnout-highlight">
                        <h3> ARE YOU CAUGHT IN A CYCLE OF BURNOUT?</h3>
                    </div>
                    
                    <p>If you're a healthcare executive, wellness leader, provider, or purpose-driven organization constantly pushing through stress, high turnover, and silent suffering—you're not alone.</p>
                    
                    <p>The cycle of burnout is an invisible system of over-functioning, people-pleasing, emotional suppression, and energetic depletion.</p>
                    
                    <p>This isn't about managing stress. It's about <strong>dismantling the system</strong> that's keeping your team stuck in survival mode.</p>
                    
                    <div class="burnout-cta">
                        <a href="https://soulsuitewellness.com/intake-form/" class="hero-btn primary-btn">Book a Clarity Call</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="soul-services">
        <div class="container">
            <h1>PRODUCTS</h1>

            <div class="services-grid">
                <!-- Individual Strategy Call -->
                <div class="service-card free-service">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/individual.png" alt="Individual Strategy Call" class="service-image">
                    <div class="service-header">
                        <h2>𝗦𝗼𝘂𝗹𝗳𝘂𝗹 𝗦𝘁𝗿𝗮𝘁𝗲𝗴𝘆 𝗖𝗮𝗹𝗹</h2>
                        <span class="service-tag">Individuals ONLY</span>
                    </div>
                    <div class="service-content">
                        <p>𝗡𝗼𝘁𝗵𝗶𝗻𝗴 𝗵𝗮𝗽𝗽𝗲𝗻𝘀 𝗯𝘆 𝗮𝗰𝗰𝗶𝗱𝗲𝗻𝘁—our paths have crossed for a reason, guided by energy and alignment.</p>
                        <p>This free 15-minute call is a sacred space for individuals ready to release stress, realign emotionally, and explore their deeper purpose in a supportive, soulful way.</p>
                        <p> Ready to be seen, heard, and supported on your wellness journey? Let's begin.</p>
                    </div>
                    <div class="service-footer">
                        <div class="service-price">$0.00</div>
                        <a href="https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/GJZY3CEHIIJR6XSGCXQR6D6P" class="service-btn">Book Now - 15 mins</a>
                    </div>
                </div>

                <!-- Business Strategy Call -->
                <div class="service-card free-service">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/business_call.png" alt="Business Strategy Call" class="service-image">
                    <div class="service-header">
                        <h2>𝗦𝗼𝘂𝗹𝗳𝘂𝗹 𝗦𝘁𝗿𝗮𝘁𝗲𝗴𝘆 𝗖𝗮𝗹𝗹</h2>
                        <span class="service-tag">Businesses ONLY</span>
                    </div>
                    <div class="service-content">
                        <p>This 30-minute call is a chance to align your wellness goals with Soul Reiki's holistic offerings for teams and organizations.</p>
                        <p>Explore services like energy healing, resilience training, and workplace wellness support.</p>
                        <p> Let's co-create a more balanced, empowered culture—book today.</p>
                    </div>
                    <div class="service-footer">
                        <div class="service-price">$0.00</div>
                        <a href="https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/HWYWQ6UMI4Q34K3TM27C7EU4" class="service-btn">Book Now - 30 mins</a>
                    </div>
                </div>

                <!-- Virtual Reiki -->
                <div class="service-card">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/𝗩𝗶𝗿𝘁𝘂𝗮𝗹-𝗥𝗲𝗶𝗸𝗶-𝗦𝗲𝘀𝘀𝗶𝗼𝗻.png" alt="Virtual Reiki" class="service-image">
                    <div class="service-header">
                        <h2>𝗩𝗶𝗿𝘁𝘂𝗮𝗹 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝘀𝘀𝗶𝗼𝗻</h2>
                    </div>
                    <div class="service-content">
                        <p>Experience the healing power of Reiki—virtually. This gentle energy practice works across distance to help release blockages and restore mind-body-spirit balance.</p>
                        <p>Relax in your own space as healing energy, intuitive channeling, and optional crystal support guide you toward clarity and renewal.</p>
                        <p> Ready to receive deep healing from wherever you are? Book your session today.</p>
                    </div>
                    <div class="service-footer">
                        <div class="service-price">$111.00</div>
                        <a href="https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/U43Y7M73OO622DHKS3CUD42L" class="service-btn">Book Now - 1 hr</a>
                    </div>
                </div>

                <!-- Mobile Reiki South Atlanta -->
                <div class="service-card">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/mobile-rekii.png" alt="Mobile Reiki South Atlanta" class="service-image">
                    <div class="service-header">
                        <h2>𝗠𝗼𝗯𝗶𝗹𝗲 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝗿𝘃𝗶𝗰𝗲</h2>
                        <span class="service-tag">South Atlanta</span>
                    </div>
                    <div class="service-content">
                        <p>Experience the healing power of in-person Reiki—a gentle energy practice that helps restore balance in your body, mind, and spirit.</p>
                        <p>Each session may include intuitive channeling and crystal healing to help you feel clear, centered, and renewed.</p>
                        <p> Based in Metro Atlanta. Ready to reconnect and realign? Book your session today.</p>
                    </div>
                    <div class="service-footer">
                        <div class="service-price">$111.00</div>
                        <a href="https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/YXCE5X5HUZRMBOBURHCYPYGS" class="service-btn">Book Now - 1 hr</a>
                    </div>
                </div>

                <!-- Mobile Reiki Metro Atlanta -->
                <div class="service-card">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/Mobile-Rei.png" alt="Mobile Reiki Metro Atlanta" class="service-image">
                    <div class="service-header">
                        <h2>𝗠𝗼𝗯𝗶𝗹𝗲 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝗿𝘃𝗶𝗰𝗲</h2>
                        <span class="service-tag">Metro Atlanta</span>
                    </div>
                    <div class="service-content">
                        <p>In-person Reiki offers a powerful way to restore balance in your body, mind, and spirit through gentle energy healing.</p>
                        <p>Sessions may include intuitive channeling and crystal healing to help you release blockages and reconnect with your true self.</p>
                        <p> Serving Metro Atlanta. Ready to feel clear, aligned, and renewed? Book today.</p>
                    </div>
                    <div class="service-footer">
                        <div class="service-price">$144.00</div>
                        <a href="https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/2OIBU3CYV3YAZ47L2YXJTAVP" class="service-btn">Book Now - 1 hr</a>
                    </div>
                </div>

                <!-- Extended Mobile Reiki -->
                <div class="service-card">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/30mile.png" alt="Extended Mobile Reiki" class="service-image">
                    <div class="service-header">
                        <h2>𝗠𝗼𝗯𝗶𝗹𝗲 𝗥𝗲𝗶𝗸𝗶 𝗦𝗲𝗿𝘃𝗶𝗰𝗲</h2>
                        <span class="service-tag">Up to 30 Miles Outside Metro Atlanta</span>
                    </div>
                    <div class="service-content">
                        <p>Discover the healing power of in-person Reiki—a gentle, energy-based practice designed to clear blockages and restore balance in your body, mind, and spirit.</p>
                        <p> Ready to reconnect with your center? Book now and take the first step toward clarity and peace.</p>
                    </div>
                    <div class="service-footer">
                        <div class="service-price">$222.00</div>
                        <a href="https://book.squareup.com/appointments/0ccyiu9cc0ezt1/location/09TR3SSB0EZ79/services/GISRJASPYOZGFQIPTRV35KZO" class="service-btn">Book Now - 1 hr</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- System Reset Section -->
<section class="system-reset-section">
    <div class="container">
        <div class="system-reset-content">
            <h2 class="reset-title">BURNOUT ISN'T JUST STRESS. IT'S A WHOLE-SYSTEM BREAKDOWN</h2>
            
            <div class="system-matrix">
                <p class="system-matrix-intro">
                    Burnout isn't a personal failure—it's a predictable outcome of environments that ignore human sustainability.
                </p>
                
                <div class="system-matrix-points">
                    <div class="system-matrix-point">
                        <div class="system-matrix-point-text">
                            <strong>Toxic Productivity & "Hero Culture"</strong> that reward overextension and silence real needs
                        </div>
                    </div>
                    <div class="system-matrix-point">
                        <div class="system-matrix-point-text">
                            <strong>Emotional Exhaustion, Empathic Overload & Values Misalignment</strong> that erode purpose and connection
                        </div>
                    </div>
                    <div class="system-matrix-point">
                        <div class="system-matrix-point-text">
                            <strong>Outdated Organizational Models</strong> that treat people as output instead of whole humans
                        </div>
                    </div>
                    <div class="system-matrix-point">
                        <div class="system-matrix-point-text">
                            <strong>Chronic Stress Patterns</strong> imprinted in the body, nervous system, and workplace culture—individually and collectively
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="system-reset-conclusion">
                <p class="reset-note">This isn't something a day off or a meditation app can fix.</p>
                <p class="reset-conclusion-text">Your people need a deep recalibration—a strategic, emotional, and physiological reset that restores well-being at the root.</p>
            </div>
            
            <div class="system-reset-cta">
                <a href="https://soulsuitewellness.com/intake-form/" class="hero-btn primary-btn">Let's Have a Conversation</a>
            </div>
        </div>
    </div>
</section>

    <!-- About Owner Section -->
    <section class="about-owner">
        <div class="container">
            <h2 class="section-title">About the Owner</h2>
            
            <div class="owner-content">
                <div class="owner-image">
                    <img src="https://soulsuitewellness.com/wp-content/uploads/2025/07/IMG-BTM.jpg" alt="Soulara Sevier - Founder & CEO of Soul Suite Wellness">
                </div>
                
                <div class="owner-info">
                    <div class="owner-credentials">
                        <h3 class="owner-name">Soulara Sevier</h3>
                        <p class="owner-title">Founder & CEO | Soul Suite Wellness</p>
                    </div>
                    
                    <div class="owner-bio">
                        <p>Welcome to Soul Suite Wellness, where transformation meets intention. I'm Soulara Sevier, and I'm passionate about guiding individuals on their journey to holistic wellness and personal empowerment.</p>
                        
                        <p>With years of experience in wellness coaching and a deep commitment to helping others discover their authentic selves, I created Soul Suite Wellness as a sanctuary for those seeking meaningful change in their lives.</p>
                        
                        <p>My approach combines traditional wellness practices with modern techniques, creating a unique experience tailored to each individual's needs. I believe that true wellness encompasses mind, body, and spirit, and I'm here to support you every step of the way on your transformative journey.</p>
                        
                        <p>At Soul Suite Wellness, we don't just focus on temporary fixes – we work together to create lasting, sustainable changes that align with your deepest values and aspirations.</p>
                    </div>
                    
                    <div class="cta-section">
                        <a href="https://soulsuitewellness.com/intake-form/" class="hero-btn primary-btn">Book a Clarity Call</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="section-title">
                <h2>Get in <span>Touch</span></h2>
                <div class="line"></div>
                <p>We're here to support your wellness journey. Reach out to explore how Soul Suite Wellness can serve you or your organization with intention and care.</p>
            </div>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="info-box">
                        <div class="icon"><i class="fa fa-map-marker"></i></div>
                        <div class="text">
                            <h4>OUR OFFICE</h4>
                            <p>Atlanta, Georgia, USA</p>
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="icon"><i class="fa fa-phone"></i></div>
                        <div class="text">
                            <h4>CALL OR TEXT</h4>
                            <p><a href="tel:678-744-3723">(678) 744-3723</a></p>
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="icon"><i class="fa fa-envelope"></i></div>
                        <div class="text">
                            <h4>EMAIL US</h4>
                            <p><a href="mailto:bewell@soulsuitewellness.com">bewell@soulsuitewellness.com</a></p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <?php echo do_shortcode('[contact-form-7 id="YOUR_FORM_ID" title="Contact form 1"]'); ?>
                </div>
            </div>
        </div>
    </section>

    <?php wp_footer(); ?>
</body>
</html>
