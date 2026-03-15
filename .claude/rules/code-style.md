# PHP & WordPress Coding Standards
- **Security:** Always escape output (`esc_html`, `esc_url`).
- **Enqueuing:** Styles/Scripts must be in `inc/enqueues.php`.
- **No Build Step:** Use Tailwind utility classes directly in PHP files.
- **Naming:** All custom functions must be prefixed with `tail_`.