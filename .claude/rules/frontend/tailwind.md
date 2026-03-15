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

## Component Presets
* **Button Default:** `bg-primary text-secondary h-btn px-6 rounded-md inline-flex items-center justify-center font-barlow-condensed font-bold transition-all hover:brightness-105`
* **Button Outline:** `bg-transparent border border-white text-white h-btn px-6 rounded-md inline-flex items-center justify-center font-barlow-condensed font-bold transition-all hover:bg-white hover:text-secondary`