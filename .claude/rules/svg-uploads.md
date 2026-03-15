# Rule: SVG Upload Support

## When to Apply
Add this code to `functions.php` for every theme that needs SVG uploads in the WordPress Media Library.

## File Placement
Place the snippet in `functions.php`, between the theme setup function and the `// ── Includes` block.

## Code

```php
// ── SVG Upload Support ───────────────────────────────────────────────────────
function tail_allow_svg_uploads( $mimes ) {
    $mimes['svg']  = 'image/svg+xml';
    $mimes['svgz'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'tail_allow_svg_uploads' );

function tail_fix_svg_mime_check( $data, $file, $filename, $mimes ) {
    $ext = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
    if ( in_array( $ext, array( 'svg', 'svgz' ), true ) ) {
        $data['ext']  = $ext;
        $data['type'] = 'image/svg+xml';
    }
    return $data;
}
add_filter( 'wp_check_filetype_and_ext', 'tail_fix_svg_mime_check', 10, 4 );

function tail_svg_media_thumbnail( $response, $attachment ) {
    if ( $response['mime'] === 'image/svg+xml' ) {
        $response['sizes'] = array(
            'full' => array( 'url' => $response['url'] ),
        );
    }
    return $response;
}
add_filter( 'wp_prepare_attachment_for_js', 'tail_svg_media_thumbnail', 10, 2 );
```

## What Each Hook Does
- `upload_mimes` — whitelists `svg`/`svgz` so WordPress accepts the upload.
- `wp_check_filetype_and_ext` — bypasses WordPress's strict MIME sniffing which rejects SVGs even after whitelisting.
- `wp_prepare_attachment_for_js` — makes SVGs render a preview in the Media Library instead of a broken image icon.
