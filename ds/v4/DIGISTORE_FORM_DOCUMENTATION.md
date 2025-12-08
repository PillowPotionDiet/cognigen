# Digistore24 Form Structure & Functionality Documentation

## Overview
This document outlines the form structure and functionality for both **Desktop** and **Mobile** versions of the Digistore24 integration forms. These forms are designed to collect customer shipping information and redirect to a package selection page with all necessary data.

---

## Desktop Form Structure
**File:** `index.html`
**Form Location:** Lines 1006-1043

### Form Container
```html
<div class="signup" style="" id="formid">
  <div style="text-align: center;background-color: #1a4573;color: white;padding: 0px 15px;font-weight: bold;font-size: 25px;">
    WHERE SHOULD WE SEND<br />YOUR BOTTLE?
  </div>
  <form class="purchase-form" id="shipping" action="https://triplecognigenplus.com/v2/package" method="get">
    <!-- Form fields here -->
  </form>
</div>
```

### Form Fields (Desktop)

| Field Name | Input Type | Placeholder | Required | HTML Name Attribute |
|------------|------------|-------------|----------|---------------------|
| Full Name | text | "Full Name" | Yes | `creditcards_name` |
| Email | email | "Email" | Yes | `emailaddress` |
| Phone | tel | "Phone Number" | Yes | `phone` |
| Street | text | "Street" | Yes | `creditcards_address` |
| House Number | text | "House No." | Yes | `house_number` |
| City | text | "City" | Yes | `creditcards_city` |
| Zip Code | text | "Zip Code" | Yes | `creditcards_zip` |
| Country | select | - | Yes | `creditcards_country` |

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

### CSS Styling (Desktop)
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

.rush-order {
  background-color: #00efc5;
  width: 100%;
  max-width: 280px;
  text-align: center;
  font-size: 1.5em;
  font-weight: bold;
  padding: 10px 5px;
  border-radius: 5px;
  box-shadow: 5px 5px grey;
  cursor: pointer;
  margin: auto;
}
```

---

## Mobile Form Structure
**File:** `m/v1m_form.html`
**Form Location:** Lines 103-140

### Form Container (Mobile)
```html
<div style="background: #85bdd6; width: 92%; margin: auto; border-radius: 8px; padding: 2% 0 0 0;">
  <form class="form" id="shipping" onsubmit="return false;">
    <!-- Form fields here -->
  </form>
</div>
```

### Form Fields (Mobile)

| Field Name | Input Type | Placeholder | Required | HTML Name Attribute |
|------------|------------|-------------|----------|---------------------|
| Full Name | text | "Full Name" | Yes | `creditcards_name` |
| Email | email | "Email" | Yes | `emailaddress` |
| Phone | tel | "Phone" | Yes | `phone` |
| Street | text | "Street*" | Yes | `creditcards_address` |
| House Number | text | "No.*" | Yes | `house_number` |
| City | text | "City" | Yes | `creditcards_city` |
| Zip Code | tel | "Zip Code" | Yes | `creditcards_zip` |
| Country | select | - | Yes | `creditcards_country` |

### Submit Button (Mobile)
```html
<img src="assets/lander_mobile/sp-btn.png" id="form_submit_btn" style="width: 100%; cursor: pointer;">
```

### CSS Styling (Mobile)
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

---

## JavaScript Functionality

### Common Features (Both Desktop & Mobile)

Both forms use **identical JavaScript logic** to process form submissions:

#### 1. URL Parameter Capture
```javascript
const urlParams = new URLSearchParams(window.location.search);
const entries = urlParams.entries();

for (const entry of entries) {
  var input = document.createElement("input");
  input.setAttribute("type", "hidden");
  input.setAttribute("name", entry[0]);
  input.setAttribute("value", entry[1]);
  document.getElementById("shipping").appendChild(input);
}
```
**Purpose:** Captures all URL parameters and appends them as hidden fields to the form.

---

#### 2. Form Validation
```javascript
if (!form.checkValidity()) {
  form.reportValidity();
  return; // Stop execution if form is invalid
}
```
**Purpose:** Uses HTML5 native validation to ensure all required fields are filled before submission.

---

#### 3. Tracking Parameters Extraction
```javascript
const aff_id = urlParams.get("aff_id") || "";
const subid = urlParams.get("subid") || "";
```
**Purpose:** Extracts affiliate tracking parameters from the URL for Digistore24 tracking.

---

#### 4. Name Splitting Logic
```javascript
const fullName = document.querySelector('[name="creditcards_name"]').value.trim();
const nameParts = fullName.split(" ");
const first_name = nameParts[0] || "";
const last_name = nameParts.slice(1).join(" ") || "";
```
**Purpose:** Splits the full name into first and last name for Digistore24 requirements.

---

#### 5. Data Collection
```javascript
const email = document.querySelector('[name="emailaddress"]').value;
const phone_no = document.querySelector('[name="phone"]').value;
const street = document.querySelector('[name="creditcards_address"]').value;
const street_number = document.querySelector('[name="house_number"]').value;
const city = document.querySelector('[name="creditcards_city"]').value;
const zipcode = document.querySelector('[name="creditcards_zip"]').value;
const country = document.querySelector('[name="creditcards_country"]').value;
```

---

#### 6. Parameter Building
```javascript
const params = new URLSearchParams({
  email: email,
  first_name: first_name,
  last_name: last_name,
  street: street,
  street_number: street_number,
  city: city,
  zipcode: zipcode,
  country: country,
  phone_no: phone_no
});

// Append tracking parameters if they exist
if (aff_id) params.append("aff_id", aff_id);
if (subid) params.append("subid", subid);
```

---

#### 7. Redirect to Package Selection
```javascript
window.location.href = "https://packages.pillowpotion.com/cognigen-plus-ds/?" + params.toString();
```
**Purpose:** Redirects user to the package selection page with all collected data as URL parameters.

---

## Desktop-Specific Responsive Behavior

### Mobile Link Switching
**File:** `index.html` (Lines 1597-1617)

```javascript
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

**Purpose:**
- If viewport width ≤ 880px: Redirect "RUSH MY ORDER" links to mobile form page
- If viewport width > 880px: Scroll to inline form on the same page

---

## Implementation Checklist for Other Offers

### Step 1: HTML Structure
- [ ] Copy the form container structure (desktop or mobile)
- [ ] Ensure form has `id="shipping"`
- [ ] Include all 8 required input fields with exact name attributes
- [ ] Add submit button with `id="form_submit_btn"`

### Step 2: CSS Styling
- [ ] Copy form styling classes (`.form-box`, `.purchase-form` for desktop OR `.frmFlds` for mobile)
- [ ] Copy button styling (`.rush-order` class)
- [ ] Adjust colors/styling to match your offer's branding

### Step 3: JavaScript Integration
- [ ] Include jQuery library: `<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>`
- [ ] Copy the URL parameter capture script
- [ ] Copy the form submission handler script
- [ ] **UPDATE the redirect URL** to your specific Digistore24 package page

### Step 4: Update Redirect URL
**CRITICAL:** Change this line to your offer's package selection URL:
```javascript
window.location.href = "https://packages.pillowpotion.com/YOUR-PRODUCT-NAME/?" + params.toString();
```

### Step 5: Testing Checklist
- [ ] Test form validation (try submitting empty form)
- [ ] Test with affiliate parameters in URL: `?aff_id=123&subid=test`
- [ ] Verify all form data appears in redirect URL
- [ ] Test on mobile devices (< 880px viewport)
- [ ] Test on desktop (> 880px viewport)
- [ ] Verify name splitting works correctly

---

## Key Differences Between Desktop & Mobile

| Feature | Desktop | Mobile |
|---------|---------|--------|
| Form display | Inline on page (scrolls to #formid) | Separate page (m/v1m_form.html) |
| Submit button | Styled div with SVG icon | Image button |
| Background | White form with purple border | Blue/teal rounded container |
| Input font size | 16px | 28px |
| Street & House No. | Separate full-width inputs | Side-by-side flex layout |
| Navigation | Responsive link switching at 880px | Direct link always |

---

## Digistore24 Parameter Reference

### Required Parameters
| Parameter | Source | Example |
|-----------|--------|---------|
| `email` | Form field: emailaddress | john@example.com |
| `first_name` | Derived from creditcards_name | John |
| `last_name` | Derived from creditcards_name | Doe |
| `street` | Form field: creditcards_address | Main Street |
| `street_number` | Form field: house_number | 123 |
| `city` | Form field: creditcards_city | New York |
| `zipcode` | Form field: creditcards_zip | 10001 |
| `country` | Form field: creditcards_country | United States |
| `phone_no` | Form field: phone | +1234567890 |

### Optional Tracking Parameters
| Parameter | Source | Purpose |
|-----------|--------|---------|
| `aff_id` | URL parameter | Affiliate ID for commission tracking |
| `subid` | URL parameter | Sub-affiliate or campaign tracking |

---

## Final Notes

1. **Security:** Forms use SSL 256-bit encryption (as mentioned in disclaimer)
2. **Validation:** All fields are required using HTML5 `required` attribute
3. **Country:** Currently hardcoded to "United States" only
4. **Data Flow:** Landing Page → Form → Package Selection Page → Digistore24 Checkout
5. **Tracking:** Affiliate parameters persist through the entire funnel

---

## Example Implementation

```html
<!-- Minimal implementation for new offer -->
<form id="shipping" onsubmit="return false;">
  <input type="text" name="creditcards_name" placeholder="Full Name" required>
  <input type="email" name="emailaddress" placeholder="Email" required>
  <input type="tel" name="phone" placeholder="Phone" required>
  <input type="text" name="creditcards_address" placeholder="Street" required>
  <input type="text" name="house_number" placeholder="House No." required>
  <input type="text" name="creditcards_city" placeholder="City" required>
  <input type="text" name="creditcards_zip" placeholder="Zip Code" required>
  <select name="creditcards_country" required>
    <option value="United States">United States of America</option>
  </select>

  <button type="button" id="form_submit_btn">SUBMIT ORDER</button>
</form>

<script>
// Copy the JavaScript from either index.html or v1m_form.html
// Remember to update the redirect URL!
</script>
```

---

**Document Version:** 1.0
**Last Updated:** 2025-12-07
**Product:** Cognigen Plus (Digistore24 Integration)
