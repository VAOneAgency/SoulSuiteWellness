# Soul Suite WordPress Theme

A modern, fully-featured WordPress theme for Soul Suite Wellness, built without dependencies on King Composer or WooCommerce.

## Features

✨ **Visual Form Builder** - Create and manage intake forms with a drag-and-drop interface
🎨 **Section Editor** - Edit all website sections from the WordPress admin
📱 **Fully Responsive** - Mobile-first design that looks great on all devices
🔗 **Square Integration** - Direct booking links to Square appointments
📅 **Calendly Integration** - Embedded calendar scheduling
🎯 **Modular Sections** - Reusable template parts for hero, about, services, contact, and more
🌈 **Custom Color Palette** - Teal, brown, and orange gradient theme
⚡ **Performance Optimized** - Clean, efficient code with minimal dependencies

## Requirements

- WordPress 5.8 or higher
- PHP 7.4 or higher
- MySQL 5.6 or higher

## Installation

### New Installation

1. **Upload Theme Files**
   ```
   wp-content/themes/soul-suite-theme/
   ```

2. **Activate the Theme**
   - Go to Appearance > Themes
   - Find "Soul Suite" and click Activate

3. **Database Tables Created Automatically**
   - Form builder tables
   - Submission tracking tables

4. **Configure Settings**
   - Go to Appearance > Customize
   - Set up:
     - Contact Information
     - Social Media Links
     - Square Integration
     - Calendly Integration
     - Footer Settings

5. **Create Pages**
   - Create pages and assign templates:
     - Home (Template: Home Page)
     - Services (Template: Services Page)
     - Schedule a Call (Template: Schedule a Call)
     - Refund Policy (Template: Refund & Returns Policy)

6. **Edit Sections**
   - Go to Sections in the WordPress admin
   - Edit content for each section:
     - Hero
     - About
     - Services
     - Matrix/System Reset
     - Contact
     - Buttons

7. **Create Forms**
   - Go to Forms > Add New
   - Build your intake form
   - Get the shortcode and place it on your pages

## Migration from Old Theme

### Pre-Migration Checklist

1. **Backup Everything**
   ```bash
   # Database backup
   wp db export backup.sql
   
   # Files backup
   tar -czf uploads-backup.tar.gz wp-content/uploads/
   ```

2. **Export Current Content**
   - Export all posts/pages via Tools > Export
   - Take screenshots of current forms
   - Note all King Composer layouts
   - Document all WooCommerce products (if any)

### Step-by-Step Migration

#### 1. Deactivate King Composer

```sql
-- Remove King Composer settings from database
DELETE FROM wp_options WHERE option_name LIKE '%kc%';
DELETE FROM wp_postmeta WHERE meta_key LIKE '%kc%';
```

#### 2. Remove WooCommerce (if installed)

- Go to Plugins > Installed Plugins
- Deactivate WooCommerce
- Delete WooCommerce (optional, but recommended)

#### 3. Install Soul Suite Theme

- Upload theme to `/wp-content/themes/`
- Do NOT activate yet

#### 4. Recreate Forms

The old intake forms need to be rebuilt:

**Old Form (template-intake-form.php):**
- Client Type (individual/business)
- Full Name
- Email
- Services checkboxes
- Contact method (phone/zoom)
- Individual: focus textarea
- Business: company, goals, team size, attendees

**To Recreate:**

1. Go to Forms > Add New
2. Create "Intake Form" with slug "intake-form"
3. Add fields:
   - Select: client_type (Individual, Business)
   - Text: fullname (required)
   - Email: email (required)
   - Checkbox: services[] (Wellness Coaching, Meditation, Corporate Wellness, Stress Management, Mindfulness, Other)
   - Radio: contact_method (Phone, Zoom)
   - Textarea: focus
   - Text: company
   - Textarea: goals
   - Hidden fields for conditional logic

4. Configure form actions:
   - Send email to: bewell@soulsuitewellness.com
   - Redirect URL: Leave empty (handled by Square URLs)
   - Success message: "Thank you! Redirecting to booking calendar..."

#### 5. Update Pages

**Home Page:**
```
1. Create new page "Home"
2. Assign template: "Home Page"
3. Set as front page: Settings > Reading
```

**Services Page:**
```
1. Create "Services"
2. Assign template: "Services Page"
3. Add to menu
```

**Schedule Page:**
```
1. Create "Schedule a Call"
2. Assign template: "Schedule a Call"
3. Add shortcode: [soul_suite_form slug="intake-form"]
```

**Policy Pages:**
```
1. Create "Refund & Returns"
2. Assign template: "Refund & Returns Policy"
3. Add your policy content
```

#### 6. Configure Sections

Go to **Sections** in admin and fill in:

**Hero Section:**
- Title: "Welcome to Soul Suite Wellness"
- Subtitle: "Empowering Your Journey to Wellness"
- Background Image: Upload your hero image
- Button Text: "Book Your Session"
- Button URL: (auto-populated from Square)

**About Section:**
- Owner Name: "Soulara"
- Owner Title: "Wellness Coach & Reiki Master"
- Owner Bio: (paste biography)
- Owner Image: Upload professional photo

**Services:**
- Add each service with:
  - Title
  - Description
  - Price
  - Square booking URL
  - Tag (Individual/Business)

**Matrix Section:**
- Title: "Your System Reset"
- Content: (paste the matrix content)
- Add bullet points

**Contact:**
- Contact Form: `[soul_suite_form slug="contact"]`

#### 7. Update Menus

- Go to Appearance > Menus
- Create Primary Menu
- Add: Home, Services, About, Schedule a Call, Contact

#### 8. Configure Integrations

**Square:**
- Go to Appearance > Customize > Square Integration
- Enter your Square IDs:
  - Merchant ID: `0ccyiu9cc0ezt1`
  - Location ID: `09TR3SSB0EZ79`
  - Individual Service: `GJZY3CEHIIJR6XSGCXQR6D6P`
  - Business Service: `HWYWQ6UMI4Q34K3TM27C7EU4`

**Calendly:**
- Go to Appearance > Customize > Calendly Integration
- Username: `soulsuitewellness`
- Events: Set up event slugs

#### 9. Activate New Theme

- Go to Appearance > Themes
- Activate "Soul Suite"
- Test all pages thoroughly

#### 10. Clean Up Old Data

```sql
-- After confirming everything works
DELETE FROM wp_options WHERE option_name LIKE '%woocommerce%';
DELETE FROM wp_postmeta WHERE meta_key LIKE '%_product%';
```

## Customization

### Adding Custom CSS

Add to Appearance > Customize > Additional CSS:

```css
/* Your custom styles */
.hero-section {
    /* Override hero styles */
}
```

### Modifying Color Palette

Edit `/inc/theme-config.php`:

```php
define('SOUL_SUITE_COLOR_TEAL', '#40e0d0');
define('SOUL_SUITE_COLOR_BROWN', '#8c756a');
define('SOUL_SUITE_COLOR_ORANGE', '#ff5b0c');
```

### Creating New Template Parts

1. Create file in `/template-parts/`
2. Name it: `section-[name].php`
3. Add to page templates:
   ```php
   get_template_part('template-parts/section', 'name');
   ```

## Form Shortcodes

Basic usage:
```
[soul_suite_form slug="contact"]
```

## Troubleshooting

### Forms Not Submitting

1. Check that AJAX URL is correct
2. Verify nonce is being generated
3. Check PHP error logs
4. Ensure database tables exist

### Sections Not Displaying

1. Clear WordPress cache
2. Check template assignment
3. Verify options are saved in database

### Square Links Not Working

1. Verify IDs in Customizer > Square Integration
2. Check that links are properly formatted
3. Test URLs directly in browser

## Support

For issues or questions:
- Email: bewell@soulsuitewellness.com
- Review documentation in `/docs/` folder

## Changelog

### Version 2.0.0 (Current)
- Complete rebuild without King Composer
- Removed WooCommerce dependency
- Added visual form builder
- Added section editor
- Square and Calendly integration
- Responsive design improvements
- Performance optimizations

### Version 1.0.0 (Legacy)
- Original theme with King Composer
- WooCommerce integration

## Credits

Built by [Your Name] for Soul Suite Wellness
Theme based on modern WordPress best practices
