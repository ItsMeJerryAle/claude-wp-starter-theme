# PHP & WordPress Coding Standards

- **Security:** Always escape output (`esc_html`, `esc_url`, `esc_attr`, `wp_kses`).
- **Enqueuing:** Styles/Scripts must be registered in `inc/enqueues.php` — never inside partials.
- **No Build Step:** Use Tailwind utility classes directly in PHP files.
- **Naming:** All custom functions must be prefixed with `tail_`.
- **Echo tags:** Use `<?php echo ... ?>` — never short echo `<?= ?>`.
