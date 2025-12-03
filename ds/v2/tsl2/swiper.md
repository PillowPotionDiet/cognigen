# Notification Swiper Setup Guide

## Quick Setup Instructions

### Step 0: Update Logo URLs

**Paste your logo URL here:**

```
https://pillowpotion.com/offers/pillowpotionlogo.webp
Example: https://pillowpotion.com/offers/pillowpotionlogo.webp
```

**Find and replace ALL logo instances in the page:**

#### 1. Navigation Logo (Header)

Located near the top of the page in the `<nav>` section:

```html
<img src="[YOUR LOGO URL]" alt="Pillow Potion Logo" class="nav-logo" />
```

#### 2. Footer Logo

Located at the bottom of the page in the `<footer>` section:

```html
<img
  src="[YOUR LOGO URL]"
  alt="Pillow Potion Logo"
  class="img-fluid mb-4"
  style="max-width: 200px;"
/>
```

#### 3. Notification Swiper Logo (if applicable)

If your notification includes a logo, update it as well.

**Pro Tip:** Use your editor's "Find & Replace" feature to search for the old logo URL and replace all instances at once!

---

### Step 1: Provide the Notification Image URL

**Paste your notification product image URL here:**

```
https://pillowpotion.com/offers/noti/ephoric.webp
Example: https://pillowpotion.com/offers/noti/cognigen.webp
```

---

### Step 2: Apply the Following Changes

Once you have your image URL, make these modifications to your notification swiper:

#### 1. Update Image Source

Find the notification image tag and replace the `src` attribute:

```html
<img class="pn-img" src="[YOUR IMAGE URL]" alt="Product" />
```

#### 2. Resize the Notification Card

Update the `.pn-card` styles:

```css
.pn-card {
  border-radius: 10px;
  padding: 8px 12px;
  margin-top: -85px; /* Controls gap between stacked notifications */
}
```

#### 3. Resize the Product Image

Update the `.pn-img` styles:

```css
.pn-img {
  height: 45px;
  border-radius: 6px;
  margin-right: 12px;
}
```

#### 4. Adjust Text Sizing

Update the `.pn-text` styles:

```css
.pn-text {
  font-size: 0.8rem;
  line-height: 1.1rem;
}
```

---

## Fine-Tuning

### Adjust Gap Between Notifications

Modify `margin-top` in `.pn-card` to control overlap:

- **More overlap** (tighter): `-90px` to `-95px`
- **Less overlap** (looser): `-70px` to `-80px`
- **Current setting**: `-85px`

### Adjust Image Size

Modify `height` in `.pn-img`:

- **Smaller**: `40px` or less
- **Larger**: `50px` or more
- **Current setting**: `45px`

---

## Complete CSS Reference

```css
.pn-card {
  position: relative;
  background: #fff;
  color: #333;
  border-radius: 10px;
  display: flex;
  align-items: center;
  padding: 8px 12px;
  margin-top: -85px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
  opacity: 0;
  transform: translateY(40px);
  transition: transform 0.8s ease, opacity 0.8s ease;
  width: fit-content;
  max-width: 90%;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
}

.pn-img {
  width: auto;
  height: 45px;
  border-radius: 6px;
  object-fit: contain;
  margin-right: 12px;
  flex-shrink: 0;
}

.pn-text {
  display: flex;
  flex-direction: column;
  font-size: 0.8rem;
  line-height: 1.1rem;
}
```

---

## Usage Instructions for Future Projects

1. **Locate the notification swiper section** in your HTML file (usually near the bottom, marked with `<!-- Notification Stack START -->`)

2. **Paste your image URL** in Step 1 above

3. **Find and update the image source** in the HTML

4. **Copy and paste the CSS modifications** or manually edit the existing styles

5. **Test the notifications** to ensure proper display

6. **Fine-tune the gap** using margin-top adjustments if needed

---

**Created:** 2025-11-06
**Last Modified:** 2025-11-06
**Version:** 1.1
