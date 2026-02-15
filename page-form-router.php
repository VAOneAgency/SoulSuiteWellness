<?php
/**
 * Template Name: Soul Suite Form Router
 *
 * Simple routing page that directs users to appropriate intake forms
 *
 * @package SoulSuite
 */

get_header();
?>

<div id="primary" class="content-area">
    <div id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <?php
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile;
                    ?>

                    <div id="form-router-container">
                        <div class="router-content">
                            <h2>Book Your Strategy Call</h2>
                            <p>Please select the type of consultation you're interested in:</p>
                            
                            <div class="form-type-selection">
                                <div class="form-option" data-type="individual">
                                    <div class="option-icon">👤</div>
                                    <h3>Individual Strategy Call</h3>
                                    <p>Personal wellness coaching and support for your individual healing journey.</p>
                                    <button class="select-btn" onclick="redirectToForm('individual')">
                                        Book Individual Call
                                    </button>
                                </div>
                                
                                <div class="form-option" data-type="business">
                                    <div class="option-icon">🏢</div>
                                    <h3>Business Strategy Call</h3>
                                    <p>Corporate wellness programs and team support solutions for your organization.</p>
                                    <button class="select-btn" onclick="redirectToForm('business')">
                                        Book Business Call
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Fallback notice -->
                            <div class="fallback-notice">
                                <p><small>Having trouble with the forms? Contact us directly at <a href="mailto:bewell@soulsuitewellness.com">bewell@soulsuitewellness.com</a></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Import Google Fonts */
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600;700&display=swap');

#form-router-container {
    max-width: 800px;
    margin: 40px auto;
    padding: 40px;
    background: linear-gradient(135deg, #F7F7F7 0%, rgba(83, 222, 212, 0.05) 100%);
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(36, 92, 82, 0.15);
    font-family: 'Poppins', sans-serif;
    border: 1px solid rgba(83, 222, 212, 0.2);
    position: relative;
    overflow: hidden;
}

#form-router-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #53DED4 0%, #EBA958 50%, #DF6E46 100%);
}

.router-content h2 {
    font-family: 'Playfair Display', serif;
    color: #245C52;
    font-size: 2.2rem;
    margin-bottom: 15px;
    text-align: center;
    font-weight: 700;
}

.router-content p {
    text-align: center;
    color: #245C52;
    font-size: 1.1rem;
    margin-bottom: 40px;
    font-weight: 400;
}

.form-type-selection {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.form-option {
    background: #fff;
    padding: 35px 25px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 10px 30px rgba(36, 92, 82, 0.08);
    border: 2px solid rgba(83, 222, 212, 0.1);
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.form-option:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(36, 92, 82, 0.15);
    border-color: #53DED4;
}

.form-option::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #53DED4 0%, #EBA958 100%);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.form-option:hover::before {
    transform: scaleX(1);
}

.option-icon {
    font-size: 3rem;
    margin-bottom: 20px;
    filter: grayscale(20%);
    transition: filter 0.3s ease;
}

.form-option:hover .option-icon {
    filter: grayscale(0%);
}

.form-option h3 {
    font-family: 'Playfair Display', serif;
    color: #245C52;
    font-size: 1.5rem;
    margin-bottom: 15px;
    font-weight: 600;
}

.form-option p {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.5;
    margin-bottom: 25px;
    text-align: center;
}

.select-btn {
    background: linear-gradient(135deg, #53DED4 0%, #245C52 100%);
    color: #F7F7F7;
    border: none;
    padding: 15px 30px;
    border-radius: 50px;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(83, 222, 212, 0.3);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    width: 100%;
    max-width: 250px;
}

.select-btn:hover {
    background: linear-gradient(135deg, #DF6E46 0%, #EBA958 100%);
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(223, 110, 70, 0.4);
}

.select-btn:active {
    transform: translateY(0);
}

.fallback-notice {
    text-align: center;
    padding: 20px;
    background: rgba(235, 169, 88, 0.1);
    border-radius: 10px;
    border-left: 4px solid #EBA958;
    margin-top: 30px;
}

.fallback-notice p {
    margin: 0;
    font-size: 0.9rem;
    color: #666;
}

.fallback-notice a {
    color: #245C52;
    text-decoration: none;
    font-weight: 600;
}

.fallback-notice a:hover {
    color: #53DED4;
    text-decoration: underline;
}

/* Loading state */
.select-btn.loading {
    background: linear-gradient(135deg, #999 0%, #666 100%);
    cursor: not-allowed;
    position: relative;
    color: transparent;
}

.select-btn.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -10px 0 0 -10px;
    width: 20px;
    height: 20px;
    border: 2px solid transparent;
    border-top: 2px solid #F7F7F7;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    #form-router-container {
        margin: 20px;
        padding: 30px 20px;
    }
    
    .router-content h2 {
        font-size: 1.8rem;
    }
    
    .form-type-selection {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .form-option {
        padding: 30px 20px;
    }
    
    .option-icon {
        font-size: 2.5rem;
    }
    
    .form-option h3 {
        font-size: 1.3rem;
    }
    
    .select-btn {
        padding: 14px 25px;
        font-size: 0.9rem;
    }
}

@media (max-width: 480px) {
    .router-content h2 {
        font-size: 1.6rem;
    }
    
    .form-option {
        padding: 25px 15px;
    }
    
    .option-icon {
        font-size: 2rem;
    }
}
</style>

<script>
function redirectToForm(type) {
    const button = event.target;
    button.classList.add('loading');
    button.innerHTML = '';
    
    // Define your form URLs
    const formUrls = {
        individual: 'https://soulsuitewellness.com/individual-intake-form/',
        business: 'https://soulsuitewellness.com/business-intake-form/'
    };
    
    // Add a small delay for better UX, then redirect
    setTimeout(function() {
        if (formUrls[type]) {
            window.location.href = formUrls[type];
        } else {
            // Fallback to email contact
            window.location.href = 'mailto:bewell@soulsuitewellness.com?subject=Strategy Call Request - ' + type.charAt(0).toUpperCase() + type.slice(1);
        }
    }, 1000);
}

// Add click handlers to form option cards as well
document.addEventListener('DOMContentLoaded', function() {
    const formOptions = document.querySelectorAll('.form-option');
    
    formOptions.forEach(function(option) {
        option.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            const button = this.querySelector('.select-btn');
            
            if (button && !button.classList.contains('loading')) {
                button.click();
            }
        });
    });
});
</script>

<?php
get_footer();
?>