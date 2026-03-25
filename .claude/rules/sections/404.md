# 404 Page Rule

When creating a 404 page for a theme, always generate `404.php` in the theme root using the hero section layout with the specifications below.

## File
`404.php` (theme root)

## Structure
Wrap in `get_header()` / `get_footer()`. No ACF fields — pull the background image from the existing `hero_bg_image` options field as a fallback:
```php
$bg_image = get_field( 'hero_bg_image', 'option' ) ?: '/wp-content/uploads/2026/03/bridgewell-hero.png';
```

## Layout
Identical to the hero section:
- `<section>` with Ken Burns background image, `min-h-screen`, `bg-secondary`
- Same CSS keyframes (`tail-kenburns`, `tail-hero-in`) declared inline in a `<style>` block
- Mobile: bottom gradient overlay (`linear-gradient to top, #203942 30%, ...`)
- Desktop: left 50% `bg-secondary/80 backdrop-blur-sm` overlay
- Desktop: bottom `h-32` gradient fade
- Content: `max-w-default mx-auto px-4`, inner `max-w-xl`
- All elements use `.hero-animate` with staggered `animation-delay`

## Fixed Texts
| Element    | Text |
|------------|------|
| Eyebrow    | `404 Error` — `font-barlow-condensed font-semibold uppercase text-accent text-[22px]` |
| Heading    | `Oops!<br>That page<br>can't be found.` — same heading classes as hero, `text-[2.75rem] md:text-[4rem] xl:text-[5rem]` |
| Description | `It looks like nothing was found at this location.` — `font-vollkorn text-white text-base leading-relaxed` |
| Button     | `Go Back to Homepage` → `home_url('/')` — primary solid button style with `rounded-lg` |

## Notes
- No ACF group needed — all text is hardcoded.
- Do NOT exempt this section from `data-animate`; it uses the hero animation system instead.
- The Ken Burns CSS can be omitted if it is already declared in `header.php` for the theme.
