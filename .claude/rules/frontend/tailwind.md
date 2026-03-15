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

## Component Presets
* **Button Default:** `bg-primary text-secondary h-btn px-6 rounded-md inline-flex items-center justify-center font-barlow-condensed font-bold transition-all hover:brightness-105`
* **Button Outline:** `bg-transparent border border-white text-white h-btn px-6 rounded-md inline-flex items-center justify-center font-barlow-condensed font-bold transition-all hover:bg-white hover:text-secondary`