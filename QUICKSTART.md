# Soul Suite Theme - Quick Start Guide

## 🚀 Fast Setup (5 Minutes)

### 1. Install & Activate
```
1. Upload to /wp-content/themes/soul-suite-theme/
2. Activate in Appearance > Themes
3. Database tables created automatically ✓
```

### 2. Configure Essentials
Go to **Appearance > Customize**:

**Contact Information:**
- ✉️ Email: bewell@soulsuitewellness.com
- 📞 Phone: (optional)

**Square Integration:**
- Merchant ID: `0ccyiu9cc0ezt1`
- Location ID: `09TR3SSB0EZ79`
- Individual Service: `GJZY3CEHIIJR6XSGCXQR6D6P`
- Business Service: `HWYWQ6UMI4Q34K3TM27C7EU4`

**Social Media:**
- Add your social media URLs

### 3. Create Your First Form
Go to **Forms > Add New**:

1. **Form Name:** "Intake Form"
2. **Slug:** "intake-form"
3. **Add Fields:**
   - Select: Client Type (Individual, Business)
   - Text: Full Name (required)
   - Email: Email Address (required)
   - Checkbox: Services
   - Radio: Contact Method
4. **Save** and copy shortcode

### 4. Create Pages

**Home Page:**
```
Pages > Add New
Title: Home
Template: Home Page
Publish
Settings > Reading > Set as front page
```

**Services:**
```
Pages > Add New
Title: Services
Template: Services Page
Publish
```

**Schedule:**
```
Pages > Add New
Title: Schedule a Call
Template: Schedule a Call
Content: [soul_suite_form slug="intake-form"]
Publish
```

### 5. Edit Sections
Go to **Sections** in admin menu:

**Hero Section:**
- Title: "Welcome to Soul Suite Wellness"
- Upload background image
- Set button text and URL

**About Section:**
- Add owner name and bio
- Upload profile photo

**Services:**
- Add your services with Square URLs

**Contact:**
- Form shortcode: `[soul_suite_form slug="contact"]`

### 6. Create Menu
```
Appearance > Menus
Create new menu: "Primary Menu"
Add: Home, Services, Schedule a Call, Contact
Set as Primary Menu
Save
```

## ✅ You're Done!

Your site is now live with:
- ✓ Working intake forms
- ✓ Square booking integration
- ✓ Responsive design
- ✓ All sections editable
- ✓ Contact forms

## 🎨 Next Steps

### Customize Colors
Edit `/inc/theme-config.php`:
```php
define('SOUL_SUITE_COLOR_TEAL', '#40e0d0');
define('SOUL_SUITE_COLOR_ORANGE', '#ff5b0c');
```

### Add More Forms
**Contact Form:**
1. Forms > Add New
2. Name: "Contact"
3. Slug: "contact"
4. Add fields: Name, Email, Message
5. Use shortcode: `[soul_suite_form slug="contact"]`

**Newsletter:**
1. Forms > Add New
2. Name: "Newsletter"
3. Slug: "newsletter"
4. Add fields: Email
5. Use in widgets or pages

### Manage Submissions
- Forms > Submissions
- View all form submissions
- Export data as needed

## 📊 Common Tasks

**Add a New Service:**
```
Sections > Services Tab
Click "Add Service"
Fill in:
- Title
- Description
- Price
- Square URL
- Tag
Save
```

**Update Hero Image:**
```
Sections > Hero Tab
Click "Select Image"
Choose your image
Save Changes
```

**Change Button Text:**
```
Sections > Buttons Tab
Update "Primary Button Text"
Save Changes
```

**Add Social Media:**
```
Appearance > Customize > Social Media Links
Enter URLs for each platform
Publish
```

## 🆘 Need Help?

**Forms not working?**
- Check Forms > All Forms
- Verify shortcode is correct
- Test email delivery

**Sections not showing?**
- Verify page template is set
- Check Sections are configured
- Clear cache

**Square links not working?**
- Verify IDs in Customizer
- Test URLs directly

## 📧 Support

Email: bewell@soulsuitewellness.com

See full README.md for detailed documentation.
