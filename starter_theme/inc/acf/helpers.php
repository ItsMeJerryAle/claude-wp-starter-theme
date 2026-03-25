<?php
/**
 * ACF Field Helper Functions
 *
 * Shared by all ACF group files in inc/acf/.
 * Do not register field groups here — only define helpers.
 */

function _tab( $key, $label ) {
    return [ 'key' => $key, 'label' => $label, 'type' => 'tab', 'placement' => 'top' ];
}
function _text( $key, $label, $name, $w = 50, $default = null, $hint = '' ) {
    $f = [ 'key' => $key, 'label' => $label, 'name' => $name, 'type' => 'text', 'wrapper' => [ 'width' => $w ] ];
    if ( $default !== null ) $f['default_value'] = $default;
    if ( $hint )             $f['instructions']  = $hint;
    return $f;
}
function _textarea( $key, $label, $name, $w = 100, $default = null, $rows = 3, $hint = '' ) {
    $f = [ 'key' => $key, 'label' => $label, 'name' => $name, 'type' => 'textarea', 'rows' => $rows, 'new_lines' => '', 'wrapper' => [ 'width' => $w ] ];
    if ( $default !== null ) $f['default_value'] = $default;
    if ( $hint )             $f['instructions']  = $hint;
    return $f;
}
function _url( $key, $label, $name, $w = 50, $hint = '' ) {
    $f = [ 'key' => $key, 'label' => $label, 'name' => $name, 'type' => 'url', 'wrapper' => [ 'width' => $w ] ];
    if ( $hint ) $f['instructions'] = $hint;
    return $f;
}
function _image( $key, $label, $name, $w = 100, $preview = 'medium' ) {
    return [ 'key' => $key, 'label' => $label, 'name' => $name, 'type' => 'image', 'return_format' => 'url', 'preview_size' => $preview, 'wrapper' => [ 'width' => $w ] ];
}
function _toggle( $key, $label, $name, $w = 50, $default = 1 ) {
    return [ 'key' => $key, 'label' => $label, 'name' => $name, 'type' => 'true_false', 'default_value' => $default, 'ui' => 1, 'wrapper' => [ 'width' => $w ] ];
}
function _color( $key, $label, $name, $default = '', $w = 50 ) {
    return [ 'key' => $key, 'label' => $label, 'name' => $name, 'type' => 'color_picker', 'default_value' => $default, 'wrapper' => [ 'width' => $w ] ];
}
function _msg( $key, $text ) {
    return [ 'key' => $key, 'label' => '', 'type' => 'message', 'message' => "<strong>$text</strong>", 'wrapper' => [ 'width' => '100' ] ];
}
function _post_obj( $key, $label, $name, $post_type ) {
    return [ 'key' => $key, 'label' => $label, 'name' => $name, 'type' => 'post_object', 'post_type' => [ $post_type ], 'return_format' => 'id', 'allow_null' => 1, 'ui' => 1, 'wrapper' => [ 'width' => '100' ] ];
}

// Composite helpers — use spread operator: ..._btn(...), ..._stat(...)
function _btn( $prefix, $text_label = 'Button Text', $url_label = 'Button URL', $default_text = '' ) {
    return [
        _text( "field_{$prefix}_btn_text", $text_label, "{$prefix}_btn_text", 50, $default_text ?: null ),
        _url(  "field_{$prefix}_btn_url",  $url_label,  "{$prefix}_btn_url" ),
    ];
}
function _stat( $prefix, $n, $num = '', $lbl = '', $desc = '' ) {
    return [
        _msg(  "field_{$prefix}_stat{$n}_header", "Stat $n" ),
        _text( "field_{$prefix}_stat{$n}_number", 'Number',      "{$prefix}_stat{$n}_number", 33, $num  ?: null ),
        _text( "field_{$prefix}_stat{$n}_label",  'Label',       "{$prefix}_stat{$n}_label",  33, $lbl  ?: null ),
        _text( "field_{$prefix}_stat{$n}_desc",   'Description', "{$prefix}_stat{$n}_desc",   33, $desc ?: null ),
    ];
}

// Location builder — pass 'options', 'front_page', or a template slug (without path/extension).
// Note: options groups are rendered via acf_form() in inc/theme-settings-page.php, so
// location rules are not used for display — they are kept here for reference only.
function _loc( ...$slugs ) {
    return array_map( function( $s ) {
        if ( $s === 'options' )    return [ [ 'param' => 'options_page', 'operator' => '==', 'value' => 'theme-settings' ] ];
        if ( $s === 'front_page' ) return [ [ 'param' => 'page_type',    'operator' => '==', 'value' => 'front_page' ] ];
        return [ [ 'param' => 'page_template', 'operator' => '==', 'value' => "page-templates/{$s}.php" ] ];
    }, $slugs );
}

function _group( $key, $title, $fields, $location ) {
    acf_add_local_field_group( [ 'key' => $key, 'title' => $title, 'fields' => $fields, 'location' => $location ] );
}
