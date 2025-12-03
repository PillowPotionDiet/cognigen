# Upsell/Downsell Page Modifications Guide

This document contains all the CSS modifications to be applied to upsell and downsell pages for consistent styling across desktop and mobile versions.

## Table of Contents
1. [White Space Removal](#white-space-removal)
2. [Step Images Sizing](#step-images-sizing)
3. [Order Confirmed Image (Upsell1 Only)](#order-confirmed-image-upsell1-only)
4. [Notification Swiper Mobile Modifications](#notification-swiper-mobile-modifications)

---

## 1. White Space Removal

### For Upsell1 (Has Order Confirmed Image)
Add this CSS in the `<style>` section, BEFORE the mobile adjustments section:

```css
/* Order Confirmed image - reduce top and bottom spacing */
.order_confirmed {
  margin-top: 0;
  margin-bottom: 0;
  display: block;
}
```

### For Upsell2, Upsell3...UpsellN and Downsell (No Order Confirmed Image)
Add this CSS in the `<style>` section, BEFORE the mobile adjustments section:

```css
/* Remove white space between top banner and step image */
.bonus-bg {
  margin-top: 0;
  padding-top: 0;
}

.step-container {
  margin-top: 0;
  padding-top: 0;
}
```

---

## 2. Step Images Sizing

### Mobile Version (320px)
Add this CSS INSIDE the existing mobile adjustments section `@media (max-width: 600px) { ... }`:

```css
/* Step image mobile styles */
.step-image {
  max-width: 320px;
  height: auto;
  margin-top: 0;
  display: block;
  margin-left: auto;
  margin-right: auto;
}
```

**Location:** Add this after the `.top-banner span:not(.caution-icon)` block, but BEFORE the closing `}` of the media query.

---

## 3. Order Confirmed Image (Upsell1 Only)

### Mobile Version (180px, no bottom space)
Add this CSS INSIDE the existing mobile adjustments section `@media (max-width: 600px) { ... }`:

```css
/* Order Confirmed image mobile styles */
.order_confirmed {
  max-width: 180px;
  /* reduced size */
  height: auto;
  margin-bottom: 0;
  /* remove bottom space */
  display: block;
  margin-left: auto;
  margin-right: auto;
}
```

**Location:** Add this after the `.top-banner span:not(.caution-icon)` block, but BEFORE the `.step-image` block.

---

## 4. Notification Swiper Mobile Modifications

### Mobile Version Adjustments (Reduced Size)
REPLACE the existing notification swiper mobile code with this:

**Find this code:**
```css
/* For mobile devices, increase bottom spacing */
@media (max-width: 600px) {
    .pn-container {
        bottom: 100px; /* increased from 20px */
    }
}
```

**Replace with:**
```css
/* For mobile devices, increase bottom spacing */
@media (max-width: 600px) {
      .pn-container {
        bottom: 20px;
        /* reduced bottom spacing */
        width: 240px;
        /* reduced width for mobile */
      }

      .pn-card {
        margin-bottom: -10px;
        padding: 8px 10px;
        /* reduced padding */
        margin-top: -60px;
        /* reduced overlap */
      }

      .pn-img {
        height: 45px;
        /* smaller image */
        margin-right: 12px;
        /* reduced spacing */
      }

      .pn-text {
        font-size: 0.75rem;
        /* smaller text */
        line-height: 1rem;
      }

      .pn-name {
        font-size: 0.8rem;
      }

      .pn-buy {
        font-size: 0.75rem;
      }

      .pn-time {
        font-size: 0.65rem;
      }
    }
```

**Changes Applied:**
- Container width: `320px` → `240px` (25% reduction)
- Card padding: `12px 16px` → `8px 10px`
- Card overlap: `-88px` → `-60px` (more compact stacking)
- Product image height: `64px` → `45px` (30% reduction)
- Image spacing: `20px` → `12px`
- Base text size: `0.9rem` → `0.75rem`
- Line height: `1.2rem` → `1rem`
- Time text: `0.75rem` → `0.65rem`

---

## Complete Example for Upsell1

```css
/* Order Confirmed image - reduce top and bottom spacing */
.order_confirmed {
  margin-top: 0;
  margin-bottom: 0;
  display: block;
}

/* MOBILE ADJUSTMENTS */
@media (max-width: 600px) {
  .top-banner {
    flex-direction: column;
    text-align: center;
    font-size: 14px;
    padding: 6px 5px;
    gap: 4px;
  }

  .caution-icon {
    display: block;
    margin-bottom: 4px;
  }

  .top-banner span:not(.caution-icon) {
    display: inline;
  }

  /* Order Confirmed image mobile styles */
  .order_confirmed {
    max-width: 180px;
    /* reduced size */
    height: auto;
    margin-bottom: 0;
    /* remove bottom space */
    display: block;
    margin-left: auto;
    margin-right: auto;
  }

  /* Step image mobile styles */
  .step-image {
    max-width: 320px;
    height: auto;
    margin-top: 0;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
}
```

---

## Complete Example for Upsell2/UpsellN/Downsell

```css
/* Remove white space between top banner and step image */
.bonus-bg {
  margin-top: 0;
  padding-top: 0;
}

.step-container {
  margin-top: 0;
  padding-top: 0;
}

/* MOBILE ADJUSTMENTS */
@media (max-width: 600px) {
  .top-banner {
    flex-direction: column;
    text-align: center;
    font-size: 14px;
    padding: 6px 5px;
    gap: 4px;
  }

  .caution-icon {
    display: block;
    margin-bottom: 4px;
  }

  .top-banner span:not(.caution-icon) {
    display: inline;
  }

  /* Step image mobile styles */
  .step-image {
    max-width: 320px;
    height: auto;
    margin-top: 0;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
}
```

---

## Notification Swiper Section

Find the notification swiper styles section (usually near the bottom of the file) and update the mobile code:

```css
/* For mobile devices, increase bottom spacing */
@media (max-width: 600px) {
      .pn-container {
        bottom: 20px;
        /* reduced bottom spacing */
        width: 240px;
        /* reduced width for mobile */
      }

      .pn-card {
        margin-bottom: -10px;
        padding: 8px 10px;
        /* reduced padding */
        margin-top: -60px;
        /* reduced overlap */
      }

      .pn-img {
        height: 45px;
        /* smaller image */
        margin-right: 12px;
        /* reduced spacing */
      }

      .pn-text {
        font-size: 0.75rem;
        /* smaller text */
        line-height: 1rem;
      }

      .pn-name {
        font-size: 0.8rem;
      }

      .pn-buy {
        font-size: 0.75rem;
      }

      .pn-time {
        font-size: 0.65rem;
      }
    }
```

---

## Summary of Changes

### All Upsell/Downsell Pages:
- ✅ White space removed between Product Qty banner and images
- ✅ Step images: 320px on mobile, centered, no top margin
- ✅ Notification swiper mobile optimizations:
  - Container width reduced to 240px (from 320px)
  - Card padding reduced to 8px 10px
  - Product image height reduced to 45px (from 64px)
  - Text sizes reduced (0.75rem base, 0.8rem name, 0.65rem time)
  - Card overlap reduced to -60px for more compact stacking
  - Bottom position: 20px with -10px card margin

### Upsell1 Only:
- ✅ Order Confirmed image: 180px on mobile, no bottom space
- ✅ Order Confirmed image: no top/bottom margins on desktop

### Upsell2/UpsellN/Downsell:
- ✅ bonus-bg and step-container: no top margins/padding

---

## Quick Reference Command

When starting a new project, provide this instruction:

> "Apply all modifications from UPSELL_DOWNSELL_MODIFICATIONS.md file to all upsell and downsell pages. Use Upsell1 template for pages with Order Confirmed image, and Upsell2/Downsell template for pages without Order Confirmed image."

---

**Version:** 1.1
**Last Updated:** November 1, 2025
**Project:** Slimming DTC for Upsells-Downsells
**Changelog v1.1:** Added notification swiper size reduction for mobile devices
