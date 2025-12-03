# Digistore24 Form Conversion Guide

## Overview
This guide documents how to convert form submission code from BuyGoods to Digistore24 parameters.

---

## Parameter Mapping: BuyGoods → Digistore24

| BuyGoods Parameter | Digistore24 Parameter | Description |
|-------------------|----------------------|-------------|
| `creditcards_name` | `first_name` + `last_name` | Full name split into two fields |
| `emailaddress` | `email` | Customer's email address |
| `phone` | `phone_no` | Customer's phone number |
| `creditcards_address` | `street` | Street address (without house number) |
| `house_number` | `street_number` | House/apartment number |
| `creditcards_city` | `city` | City name |
| `creditcards_zip` | `zipcode` | Postal/ZIP code |
| `creditcards_country` | `country` | Country name |

**Important:** Digistore24 requires `first_name` and `last_name` separately, while BuyGoods uses a single `creditcards_name` field.

---

## Form HTML Structure

The HTML form itself **does NOT need to change**. Keep the original field names:

```html
<form class="prospect-form has-validation-callback" id="shipping" onsubmit="return false;">

    <div class="field-first_name fields floating-labels">
        <input type="text" name="creditcards_name" id="creditcards_name_input"
            placeholder="Full Name" required class="form-control">
        <label for="first_name">Full Name</label>
    </div>

    <div class="field-email fields floating-labels">
        <input type="email" name="emailaddress" id="emailaddress_input"
            placeholder="Email Address" required class="form-control">
        <label for="email">Email</label>
    </div>

    <div class="field-phone fields floating-labels">
        <input type="tel" name="phone" id="phone_input"
            placeholder="Phone Number" required maxlength="14" class="form-control">
        <label for="phone">Phone</label>
    </div>

    <div class="field-address fields floating-labels">
        <input type="text" name="creditcards_address"
            placeholder="Street Address" required class="form-control">
        <label for="address">Street Address</label>
    </div>

    <div class="field-house fields floating-labels">
        <input type="text" name="house_number"
            placeholder="House No." required class="form-control">
        <label for="house">House No.</label>
    </div>

    <div class="field-city fields floating-labels">
        <input type="text" name="creditcards_city"
            placeholder="City" required class="form-control">
        <label for="city">City</label>
    </div>

    <div class="field-zip fields floating-labels">
        <input type="text" name="creditcards_zip"
            placeholder="Zip / Postal" required pattern="^[0-9]{5}"
            maxlength="5" class="form-control">
        <label for="zip">Zip</label>
    </div>

    <div class="field-country fields floating-labels">
        <select name="creditcards_country" class="form-control" required>
            <option value="United States">United States</option>
        </select>
        <label for="country">Country</label>
    </div>

    <button type="submit" id="form_submit_btn"
        class="btn btn-custom btn-lg btn-block animated infinite pulse">
        Rush my order
        <div>Order your package today!</div>
    </button>
</form>
```

---

## JavaScript Conversion Script

### Complete Form Submission Script (Digistore24)

Replace the old BuyGoods form submission script with this:

```javascript
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const btn = document.getElementById("form_submit_btn");
        const form = document.getElementById("shipping");

        btn.addEventListener("click", function (e) {
            e.preventDefault();

            // ✅ STEP 1: Validate form before submission
            if (!form.checkValidity()) {
                // Trigger HTML5 validation messages
                form.reportValidity();
                return; // Stop execution if form is invalid
            }

            // ✅ STEP 2: Parse tracking parameters from URL
            const urlParams = new URLSearchParams(window.location.search);
            const aff_id = urlParams.get("aff_id") || "";
            const subid = urlParams.get("subid") || "";

            // ✅ STEP 3: Get form values
            const fullName = document.querySelector('[name="creditcards_name"]').value.trim();
            const nameParts = fullName.split(" ");
            const first_name = nameParts[0] || "";
            const last_name = nameParts.slice(1).join(" ") || "";

            const email = document.querySelector('[name="emailaddress"]').value;
            const phone_no = document.querySelector('[name="phone"]').value;
            const street = document.querySelector('[name="creditcards_address"]').value;
            const street_number = document.querySelector('[name="house_number"]').value;
            const city = document.querySelector('[name="creditcards_city"]').value;
            const zipcode = document.querySelector('[name="creditcards_zip"]').value;
            const country = document.querySelector('[name="creditcards_country"]').value;

            // ✅ STEP 4: Build Digistore24 parameters
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

            // ✅ STEP 5: Append tracking parameters if they exist
            if (aff_id) params.append("aff_id", aff_id);
            if (subid) params.append("subid", subid);

            // ✅ STEP 6: Redirect to package selector page
            window.location.href = "YOUR_PACKAGE_SELECTOR_URL?" + params.toString();
        });
    });
</script>
```

---

## Key Changes Explained

### 1. **Form Validation**
```javascript
// Check if form is valid
if (!form.checkValidity()) {
    form.reportValidity();
    return; // Stop execution if form is invalid
}
```
- Prevents redirect if form fields are empty or invalid
- Shows HTML5 validation messages to user
- Uses native browser validation

### 2. **Name Splitting**
```javascript
const fullName = document.querySelector('[name="creditcards_name"]').value.trim();
const nameParts = fullName.split(" ");
const first_name = nameParts[0] || "";
const last_name = nameParts.slice(1).join(" ") || "";
```
- Digistore24 requires separate first/last name
- Splits on first space
- Everything after first space becomes last name

### 3. **Address Field Separation**
```javascript
const street = document.querySelector('[name="creditcards_address"]').value;
const street_number = document.querySelector('[name="house_number"]').value;
```
- BuyGoods combined these into one field
- Digistore24 keeps them separate
- **Do NOT combine** these fields

### 4. **Parameter Object**
```javascript
const params = new URLSearchParams({
    email: email,                    // ← Changed from emailaddress
    first_name: first_name,          // ← New (split from full name)
    last_name: last_name,            // ← New (split from full name)
    street: street,                  // ← Changed from creditcards_address
    street_number: street_number,    // ← Kept separate
    city: city,                      // ← Changed from creditcards_city
    zipcode: zipcode,                // ← Changed from creditcards_zip
    country: country,                // ← Changed from creditcards_country
    phone_no: phone_no              // ← Changed from phone
});
```

---

## Example Output URL

**Input:**
- Full Name: John Smith
- Email: john@email.com
- Phone: 555-1234
- Street: Main Street
- House No: 123
- City: New York
- Zip: 10001
- Country: United States

**Output URL:**
```
https://packages.pillowpotion.com/keto-ds/?email=john%40email.com&first_name=John&last_name=Smith&street=Main+Street&street_number=123&city=New+York&zipcode=10001&country=United+States&phone_no=555-1234
```

---

## Mobile Form (m/v1m_form.html)

The mobile form uses **identical JavaScript logic**:

```javascript
<script>
document.addEventListener("DOMContentLoaded", function () {
    const btn = document.getElementById("form_submit_btn");
    const form = document.getElementById("shipping");

    btn.addEventListener("click", function (e) {
        e.preventDefault();

        // Check if form is valid
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        // Parse tracking parameters
        const urlParams = new URLSearchParams(window.location.search);
        const aff_id = urlParams.get("aff_id") || "";
        const subid = urlParams.get("subid") || "";

        // Get and split name
        const fullName = document.querySelector('[name="creditcards_name"]').value.trim();
        const nameParts = fullName.split(" ");
        const first_name = nameParts[0] || "";
        const last_name = nameParts.slice(1).join(" ") || "";

        // Get all form values
        const email = document.querySelector('[name="emailaddress"]').value;
        const phone_no = document.querySelector('[name="phone"]').value;
        const street = document.querySelector('[name="creditcards_address"]').value;
        const street_number = document.querySelector('[name="house_number"]').value;
        const city = document.querySelector('[name="creditcards_city"]').value;
        const zipcode = document.querySelector('[name="creditcards_zip"]').value;
        const country = document.querySelector('[name="creditcards_country"]').value;

        // Build Digistore24 parameters
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

        // Append tracking
        if (aff_id) params.append("aff_id", aff_id);
        if (subid) params.append("subid", subid);

        // Redirect
        window.location.href = "YOUR_PACKAGE_SELECTOR_URL?" + params.toString();
    });
});
</script>
```

---

## Responsive Buy Links Script

Add this script to handle mobile/desktop navigation:

```javascript
<script>
    const urlParams = new URLSearchParams(window.location.search);
    const entries = urlParams.entries();

    for (const entry of entries) {
        var input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", entry[0]);
        input.setAttribute("value", entry[1]);
        document.getElementById("shipping").appendChild(input);
    }

    reportWindowSize();
    window.addEventListener('resize', reportWindowSize);

    function reportWindowSize() {
        var vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
        var buy_links = document.getElementsByClassName("buy-link-cl");

        if (vw <= 992) {
            // Mobile links
            for (var i = 0; i < buy_links.length; i++) {
                buy_links[i].setAttribute('href', "m/v1m_form.html");
            }
        } else {
            // Desktop links
            for (var i = 0; i < buy_links.length; i++) {
                buy_links[i].setAttribute('href', "#formid");
            }
        }
    }
</script>
```

---

## Checklist for Conversion

### ✅ Before Starting
- [ ] Backup original files
- [ ] Identify all forms (desktop + mobile)
- [ ] Note the package selector URL

### ✅ Form Conversion Steps
1. [ ] Keep HTML form structure unchanged
2. [ ] Replace form submission script
3. [ ] Add form validation (`checkValidity()` + `reportValidity()`)
4. [ ] Split full name into `first_name` and `last_name`
5. [ ] Update parameter names to Digistore24 format
6. [ ] Keep `street` and `street_number` separate
7. [ ] Update redirect URL to package selector page
8. [ ] Preserve tracking parameters (`aff_id`, `subid`)

### ✅ Testing
- [ ] Test with empty form (should show validation errors)
- [ ] Test with valid data (should redirect with correct parameters)
- [ ] Test name splitting (e.g., "John Smith" → first: "John", last: "Smith")
- [ ] Test name with multiple words (e.g., "John David Smith" → first: "John", last: "David Smith")
- [ ] Test tracking parameters are preserved in URL

---

## Common Mistakes to Avoid

### ❌ DON'T DO THIS:
```javascript
// ❌ Combining address fields
const address = `${street} ${house}`;
params.append("address", address);

// ❌ Using old BuyGoods parameter names
params.append("creditcards_name", fullName);
params.append("emailaddress", email);

// ❌ Redirecting without validation
window.location.href = url; // Missing form.checkValidity()
```

### ✅ DO THIS:
```javascript
// ✅ Keep address fields separate
params.append("street", street);
params.append("street_number", street_number);

// ✅ Use Digistore24 parameter names
params.append("first_name", first_name);
params.append("last_name", last_name);
params.append("email", email);

// ✅ Validate before redirecting
if (!form.checkValidity()) {
    form.reportValidity();
    return;
}
window.location.href = url;
```

---

## Files Modified in This Project

1. **index.html** - Desktop landing page form (lines 1051-1103)
2. **m/v1m_form.html** - Mobile form page (lines 309-361)

---

## Configuration Required

Update these URLs in your converted scripts:

```javascript
// In both index.html and m/v1m_form.html
window.location.href = "https://packages.pillowpotion.com/keto-ds/?" + params.toString();
//                      ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
//                      Replace with your actual package selector URL
```

---

## Support & Reference

- **Digistore24 Documentation**: https://www.digistore24.com/
- **Parameter Reference**: See the table at the top of this guide
- **This Project**: Keto v4 DTC conversion completed on 2025

---

## Quick Reference Card

```
BuyGoods → Digistore24 Parameter Quick Reference
================================================

creditcards_name     → first_name + last_name (split)
emailaddress         → email
phone                → phone_no
creditcards_address  → street (keep separate)
house_number         → street_number (keep separate)
creditcards_city     → city
creditcards_zip      → zipcode
creditcards_country  → country

Always include:
- Form validation (checkValidity + reportValidity)
- Name splitting logic
- Tracking parameter preservation (aff_id, subid)
```

---

**Last Updated:** 2025-11-18
**Project:** Keto v4 DTC - BuyGoods to Digistore24 Conversion
