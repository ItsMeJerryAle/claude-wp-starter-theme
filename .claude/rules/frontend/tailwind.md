# Tailwind Standards & Design Tokens

## Configuration (Play CDN)
- Use `tailwind.config` script in `header.php`.
- **Fonts:** - `font-vollkorn`: ['"Vollkorn"', 'serif']
  - `font-barlow-condensed`: ['"Barlow Condensed"', 'sans-serif']
- **Max Widths:**
  - `max-w-default`: 1400px

## Brand Colors
- Primary: #C2D432
- Secondary: #203942
- Accent: #F16A46
- Surface: #FBEBBF
- Forest: #4E612C
- Leaf: #879B3B
- Moss: #6D8237

## Color Usage Rules
- **Always use token names** (`text-primary`, `bg-secondary`, `border-surface`, etc.) instead of raw hex values (`text-[#C2D432]`, `bg-[#203942]`).
- Only use raw hex/rgba when the value is **not in the token map** — e.g. gradient stops in inline `style` attributes where Tailwind opacity modifiers won't work at runtime.

## Entrance Animation

All sections (except the hero) use a unified **fade slide-up** entrance animation on scroll.

### How it works
- **CSS** lives in `header.php` — `[data-animate]` starts hidden (`opacity: 0; transform: translateY(28px)`) and transitions to visible (`.is-visible`) in `0.6s ease-out`
- **JS** lives in `assets/js/animations.js` — a single `IntersectionObserver` (threshold `0.12`) watches all `[data-animate]` elements and adds `.is-visible` when in view. Enqueued via `inc/enqueues.php` in the footer.
- **Stagger** is controlled per-element via `data-delay="150"` (ms)

### Usage pattern
```html
<!-- Section header — no delay -->
<div data-animate data-delay="0" class="...">

<!-- Cards — staggered -->
<div data-animate data-delay="0" class="...">   <!-- col 1 -->
<div data-animate data-delay="100" class="..."> <!-- col 2 -->
<div data-animate data-delay="200" class="..."> <!-- col 3 -->
```

### Rules
- Every new section **must** add `data-animate` to its header row and each major card/block.
- Hero section is **exempt** — it is always visible on load.
- Do **not** add inline `<script>` blocks for animation in section files — the shared JS handles everything.
- Do **not** repeat the CSS in section or component files — it is declared once in `header.php`.

## Component Presets
* **Button Default:** `bg-primary text-secondary h-btn px-6 rounded-md inline-flex items-center justify-center font-barlow-condensed font-bold transition-all hover:brightness-105 text-lg`
* **Button Outline:** `bg-transparent border border-white text-white h-btn px-6 rounded-md inline-flex items-center justify-center font-barlow-condensed font-bold transition-all hover:bg-white hover:text-secondary text-lg`