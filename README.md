# Raouf Ecommerce — WordPress WooCommerce Theme

A clean, custom WordPress theme built for WooCommerce stores. It includes a full homepage with hero and lookbook sections, an AJAX slide-out mini cart, custom shop and product templates, and a simplified checkout tailored to stores selling in Egypt.

![Theme screenshot](screenshot.jpg)

## Features

### Homepage (`front-page.php`)
- **Hero**: an eyebrow line, heading, intro text and two call-to-action buttons, plus four circular images you set in the Customizer.
- **About**: a short brand intro with its own image.
- **Why Shop With Us**: a row of value highlights.
- **Shop by Category**: a grid of WooCommerce product categories.
- **Lookbook banner**: a full-width image with a heading and subtext you can edit.
- **Featured Products**: shows the products marked as *featured* in WooCommerce.

### Shop & product
- Custom shop/archive page (`archive-product.php`): 3 columns, 12 products per page.
- Custom single product page (`single-product.php`) with gallery zoom, lightbox and slider. It also loads [GLightbox](https://github.com/biati-digital/glightbox) for full-screen images.
- **Sale** and **Sold Out** badges on product cards.
- **Quick add** button on product cards that adds the item to the cart over AJAX without reloading the page. Variable products send the shopper to the product page to pick options.

### Cart
- **Slide-out mini cart** (`woocommerce/mini-cart-sidebar.php`) that updates live through WooCommerce cart fragments: item count, line items, subtotal, and View Cart / Checkout buttons.
- Custom cart page template (`page-cart.php`).

### Checkout (Egypt-focused)
- First and last name are merged into a single **Full Name** field. It's split back into first and last name when the order is saved.
- The country is fixed to **Egypt** and shown as a read-only field.
- The address field is relabelled **Full Address**. Company, Address 2, City and Postcode are removed.
- Phone is required.
- Two-column checkout layout, plus a custom thank-you page (`woocommerce/checkout/thankyou.php`).

### Pages
Ready-made templates for **Contact**, **My Account**, **Privacy Policy**, **Returns Policy**, a generic page and **404**.

## Requirements

| | Version |
|---|---|
| WordPress | 6.0+ (tested up to 6.5) |
| PHP | 8.0+ |
| WooCommerce | required |

## Installation

1. Download or clone this repo into `wp-content/themes/`:
   ```bash
   git clone https://github.com/Muhammedraouf92/raouf-ecom.git wp-content/themes/raouf
   ```
2. In the WordPress admin, go to **Appearance → Themes** and activate **Raouf Ecommerce**.
3. Install and activate **WooCommerce** and run its setup wizard.
4. Go to **Settings → Reading** and set a static front page so the custom homepage appears.

## Configuration

**Appearance → Customize**
- **Site Identity**: upload your logo. Any size works; the suggested size is 200×60.
- **Hero Circle Images**: the four hero circle images and the About image.
- **Lookbook Banner**: the background image, a heading (HTML allowed, e.g. `<em>`) and subtext.

**Appearance → Menus**
- `Primary Menu`: the header navigation.
- `Footer Menu`: the footer links.

**Appearance → Widgets**
- `Shop Sidebar`: the widget area for shop pages.

**Products → mark as Featured** (the ★ in the product list) to show a product in the homepage *Featured Products* section.

### Page templates
The theme uses WordPress's slug-based templates, so these load automatically when a page has the matching slug:

| Page slug | Template |
|---|---|
| `cart` | `page-cart.php` |
| `checkout` | `page-checkout.php` |
| `my-account` | `page-my-account.php` |
| `contact` | `page-contact.php` |
| `privacy-policy` | `page-privacy-policy.php` |
| `returns-policy` | `page-returns-policy.php` |

## Theme structure

```
raouf/
├── assets/js/
│   ├── main.js            # General UI (menu, interactions)
│   ├── mini-cart.js       # Slide-out cart open/close & updates
│   └── add-to-cart.js     # AJAX quick-add
├── inc/
│   └── icons.php          # mystore_icon() inline SVG helper
├── woocommerce/
│   ├── mini-cart-sidebar.php
│   └── checkout/thankyou.php
├── front-page.php         # Homepage
├── archive-product.php    # Shop / category pages
├── single-product.php     # Product page
├── page-*.php             # Page templates
├── header.php / footer.php
├── functions.php          # Setup, assets, WooCommerce hooks, Customizer, checkout tweaks
└── style.css              # Theme header + all styles
```

## Customizing styles

The colours and fonts are CSS variables at the top of `style.css`:

```css
:root {
  --color-bg: #f9f9f9;
  --color-accent: #d6ab14;      /* gold accent */
  --color-text: #272727;
  --font-display: "Playfair Display", Georgia, serif;
  --font-body: "DM Sans", sans-serif;
  --radius: 6px;
}
```

Change these to re-skin the whole theme. The fonts load from Google Fonts.

## Developer notes

- PHP functions use the `mystore_` prefix and the text domain is `mystore`.
- Custom image sizes: `mystore-hero` (1600×900), `mystore-product` (600×900), `mystore-card` (400×400), `mystore-category` (400×600). If you add the theme to a site that already has products, run a thumbnail regeneration plugin so these sizes get created.
- AJAX add-to-cart endpoint: `wp_ajax(_nopriv)_mystore_add_to_cart`. It's protected by the `mystore_nonce` nonce.

## License

GNU General Public License v2 or later. See [gpl-2.0](https://www.gnu.org/licenses/gpl-2.0.html).
