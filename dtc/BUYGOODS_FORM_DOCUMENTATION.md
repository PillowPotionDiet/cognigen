# BuyGoods Form Implementation Guide

This document outlines the form structure and functionality for BuyGoods checkout forms used in PillowPotion offers. Use this as a template for implementing forms in other offers.

---

## Table of Contents
1. [Desktop Form Structure](#desktop-form-structure)
2. [Mobile Form Structure](#mobile-form-structure)
3. [JavaScript Functionality](#javascript-functionality)
4. [URL Parameter Handling](#url-parameter-handling)
5. [Implementation Checklist](#implementation-checklist)

---

## Desktop Form Structure

**File Location:** `index.html` (Lines 807-848)

### Form Container
```html
<div class="signup" id="formid">
    <div style="text-align: center; background-color: #1a4573; color: white; padding: 0px 15px; font-weight: bold; font-size: 25px;">
        WHERE SHOULD WE SEND<br/>YOUR BOTTLE?
    </div>

    <form class="purchase-form" id="shipping" action="https://triplecognigenplus.com/v2/package" method="get">
        <!-- Form fields here -->
    </form>
</div>
```

### Form Fields (Desktop)

| Field Name | Input Type | Placeholder | Name Attribute | Required |
|------------|-----------|-------------|----------------|----------|
| Full Name | text | "Full Name" | `creditcards_name` | Yes |
| Email | email | "Email" | `emailaddress` | Yes |
| Phone | tel | "Phone Number" | `phone` | Yes |
| Street | text | "Street" | `creditcards_address` | Yes |
| House Number | text | "House No." | `house_number` | Yes |
| City | text | "City" | `creditcards_city` | Yes |
| Zip Code | text | "Zip Code" | `creditcards_zip` | Yes |
| Country | select | - | `creditcards_country` | Yes |

### Form Styling (Desktop)
```css
.form-box input, select {
    width: 100%;
    height: 40px;
    font-size: 16px;
    border-radius: 5px;
    padding-left: 15px;
    line-height: 40px;
    margin-bottom: 11px;
    border: 1px solid #1c5f71;
}

.purchase-form {
    padding: 10px;
    background: #fff;
    border: 2px solid #92278f;
    border-top: none;
}
```

### Submit Button (Desktop)
```html
<div class="cta">
    <div class="rush-order pulse" style="white-space: nowrap; min-width:280px" id="form_submit_btn">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10" class="svg-rush-triangle">
            <polygon points="3 1, 9 5, 3 9"></polygon>
        </svg>
        RUSH MY ORDER
    </div>
</div>
```

---

## Mobile Form Structure

**File Location:** `m/v1m_form.html` (Lines 104-140)

### Form Container
```html
<div style="background: #85bdd6; width: 92%; margin: auto; border-radius: 8px; padding: 2% 0 0 0;">
    <form class="form" id="shipping" onsubmit="return false;">
        <!-- Form fields here -->
    </form>
</div>
```

### Form Fields (Mobile)

Same field structure as desktop, with slight styling differences:

```html
<div class="frmFlds" style="padding:0 0 2% 0;">
    <input type="text" name="creditcards_name" id="creditcards_name" placeholder="Full Name" required>
</div>

<div class="frmFlds" style="padding:0 0 2% 0;">
    <input type="email" name="emailaddress" id="emailaddress" placeholder="Email" required>
</div>

<div class="frmFlds" style="padding:0 0 2% 0;">
    <input type="tel" name="phone" id="phone" placeholder="Phone" required>
</div>

<!-- Street and House Number in Flex Container -->
<div id="creditcards_address" class="frmFlds" placeholder="Enter your address (ex: 123 street)">
    <div style="display: flex; gap: 10px;">
        <input type="text" name="creditcards_address" placeholder="Street*" class="form-control" required>
        <input type="text" name="house_number" placeholder="No.*" class="form-control" required>
    </div>
</div>

<div class="frmFlds" style="padding:0 0 2% 0;">
    <input type="text" name="creditcards_city" id="creditcards_city" placeholder="City" required>
</div>

<div class="frmFlds" style="padding:0 0 2% 0;">
    <input type="tel" name="creditcards_zip" id="creditcards_zip" placeholder="Zip Code" required>
</div>

<div class="frmFlds" style="padding:0 0 2% 0;">
    <select name="creditcards_country" id="creditcards_country">
        <option value="United States">United States of America</option>
    </select>
</div>
```

### Form Styling (Mobile)
```css
.frmFlds input, .frmFlds select {
    background: #ffffff;
    border: 1px solid #7e7e7e;
    font-size: 28px;
    margin: 0 0 1% 0;
    padding: 0 1% 0 4.2%;
    width: 94%;
    outline: none;
    color: #000;
    height: 54px;
    line-height: 50px;
}
```

### Submit Button (Mobile)
```html
<img src="assets/lander_mobile/sp-btn.png" id="form_submit_btn" style="width: 100%; cursor: pointer;">
```

---

## JavaScript Functionality

Both desktop and mobile forms use **identical JavaScript logic**.

### Core Functionality

#### 1. URL Parameter Preservation
```javascript
const urlParams = new URLSearchParams(window.location.search);
const entries = urlParams.entries();

for(const entry of entries) {
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", entry[0]);
    input.setAttribute("value", entry[1]);
    document.getElementById("shipping").appendChild(input);
}
```

**Purpose:** Preserves all URL parameters (tracking, affiliate IDs, etc.) by adding them as hidden inputs to the form.

#### 2. Form Submission Handler
```javascript
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("form_submit_btn");

    btn.addEventListener("click", function () {
        // Parse aff_id and subid from current URL
        const urlParams = new URLSearchParams(window.location.search);
        const aff_id = urlParams.get("aff_id") || "";
        const subid = urlParams.get("subid") || "";

        // Get form data
        const fullName = document.querySelector('[name="creditcards_name"]').value.trim();
        const nameParts = fullName.split(" ");
        const first_name = nameParts[0] || "";
        const last_name = nameParts.slice(1).join(" ") || "";

        const email = document.querySelector('[name="emailaddress"]').value;
        const phone = document.querySelector('[name="phone"]').value;
        const street = document.querySelector('[name="creditcards_address"]').value;
        const house = document.querySelector('[name="house_number"]').value;
        const address = `${street} ${house}`;
        const city = document.querySelector('[name="creditcards_city"]').value;
        const zip = document.querySelector('[name="creditcards_zip"]').value;
        const country = document.querySelector('[name="creditcards_country"]').value;

        // Form validation
        if (!fullName || !email || !phone || !street || !house || !city || !zip || !country) {
            alert("Please fill out all required fields before continuing.");
            return; // stop execution
        }

        // Build URL parameters
        const params = new URLSearchParams({
            creditcards_name: fullName,
            emailaddress: email,
            phone: phone,
            creditcards_address: address,
            creditcards_city: city,
            creditcards_country: country,
            creditcards_zip: zip,
        });

        // Append aff_id and subid if they exist
        if (aff_id) params.append("aff_id", aff_id);
        if (subid) params.append("subid", subid);

        // Redirect to packages page (DESKTOP uses HTTPS, MOBILE uses HTTP - should standardize)
        window.location.href = "https://packages.pillowpotion.com/cognigen-plus/?" + params.toString();
    });
});
```

### Key Functions Performed

1. **Name Splitting**: Splits `creditcards_name` (Full Name) into `first_name` and `last_name`
2. **Address Combination**: Combines `creditcards_address` (Street) and `house_number` into single `address` field
3. **Validation**: Ensures all required fields are filled before proceeding
4. **Affiliate Tracking**: Preserves `aff_id` and `subid` from URL parameters
5. **Redirection**: Redirects to BuyGoods package selection page with all data

---

## URL Parameter Handling

### Parameters Captured
- `aff_id` - Affiliate ID
- `subid` - Sub-affiliate ID
- All other URL parameters from landing page

### Parameters Sent to Package Page
- `creditcards_name` - Full name
- `emailaddress` - Email address
- `phone` - Phone number
- `creditcards_address` - Complete address (street + house number combined)
- `creditcards_city` - City
- `creditcards_country` - Country
- `creditcards_zip` - Zip code
- `aff_id` - Affiliate ID (if present)
- `subid` - Sub-affiliate ID (if present)

### Destination URL
```
https://packages.pillowpotion.com/cognigen-plus/?[parameters]
```

**Note:** Desktop uses HTTPS, mobile uses HTTP in the example code. Standardize to HTTPS for security.

---

## Implementation Checklist

When implementing this form in a new offer:

### HTML Setup
- [ ] Create form with ID `shipping`
- [ ] Add all required input fields with correct `name` attributes
- [ ] Create submit button/element with ID `form_submit_btn`
- [ ] Include hidden inputs for URL parameters (via JavaScript)
- [ ] Add appropriate styling for desktop/mobile

### Required Form Fields
- [ ] `creditcards_name` (Full Name)
- [ ] `emailaddress` (Email)
- [ ] `phone` (Phone Number)
- [ ] `creditcards_address` (Street)
- [ ] `house_number` (House Number)
- [ ] `creditcards_city` (City)
- [ ] `creditcards_zip` (Zip Code)
- [ ] `creditcards_country` (Country dropdown)

### JavaScript Implementation
- [ ] Add URL parameter preservation script (runs on page load)
- [ ] Add form submission handler (click event on submit button)
- [ ] Implement field validation
- [ ] Implement name splitting logic
- [ ] Implement address combination logic
- [ ] Add affiliate tracking preservation
- [ ] Update destination URL to correct package page

### Testing
- [ ] Test form validation (all required fields)
- [ ] Test URL parameter preservation
- [ ] Verify affiliate tracking (aff_id, subid)
- [ ] Test on desktop browsers
- [ ] Test on mobile devices
- [ ] Verify redirect to package page with correct parameters
- [ ] Test with various name formats (single name, multiple middle names, etc.)

### Configuration
- [ ] Update package redirect URL: `https://packages.pillowpotion.com/[PRODUCT-NAME]/`
- [ ] Verify BuyGoods tracking script parameters
- [ ] Update product codes in tracking script if needed
- [ ] Ensure consistent HTTPS usage across all redirects

---

## Common Issues & Solutions

### Issue: Form submits but data is lost
**Solution:** Ensure all field `name` attributes match exactly (case-sensitive)

### Issue: Affiliate tracking not working
**Solution:** Verify URL parameters are being captured and appended to redirect URL

### Issue: Validation not working
**Solution:** Check that all fields have `required` attribute and validation logic includes all fields

### Issue: Mobile vs Desktop form switching
**Solution:** Use responsive design or JavaScript to detect screen size and redirect accordingly
```javascript
// Desktop uses this logic (lines 1426-1445 in index.html)
function reportWindowSize() {
    var vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
    var buy_links = document.getElementsByClassName("buy-link-cl");

    if (vw <= 880) {
        // mobile links
        for (var i = 0; i < buy_links.length; i++) {
          buy_links[i].setAttribute('href', "m/v1m_form.html?");
        }
    } else {
        // desktop links
        for (var i = 0; i < buy_links.length; i++) {
          buy_links[i].setAttribute('href', "#formid");
        }
    }
}
```

---

## Additional Notes

1. **BuyGoods Integration**: Both forms include BuyGoods tracking scripts at the top of the page
2. **Security**: Always use HTTPS for form submission and redirects
3. **Country Selection**: Currently hardcoded to "United States" - expand if targeting other countries
4. **Disclaimer**: BuyGoods disclaimer widget is included at the bottom of both forms
5. **Footer Links**: Standard footer with Terms, Privacy Policy, Returns, Contact links

---

## Version History
- **v1.0** - Initial documentation based on Cognigen Plus offer
- Desktop Form: [index.html](index.html) (Lines 807-848)
- Mobile Form: [m/v1m_form.html](m/v1m_form.html) (Lines 104-140)

---

*Last Updated: December 2025*
*Product: Cognigen Plus (PillowPotion Naturals)*
