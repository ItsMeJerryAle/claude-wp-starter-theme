document.addEventListener( 'DOMContentLoaded', function () {
    var btn     = document.getElementById( 'ways-copy-btn' );
    var alertEl = document.getElementById( 'ways-copy-alert' );

    if ( ! btn || ! alertEl ) return;

    function showCopied() {
        alertEl.style.opacity = '1';
        setTimeout( function () {
            alertEl.style.opacity = '0';
        }, 2000 );
    }

    function fallbackCopy( text ) {
        var ta = document.createElement( 'textarea' );
        ta.value = text;
        ta.style.cssText = 'position:fixed;top:-9999px;left:-9999px;opacity:0;';
        document.body.appendChild( ta );
        ta.focus();
        ta.select();
        try {
            document.execCommand( 'copy' );
            showCopied();
        } catch ( e ) {
            window.alert( 'Could not copy. Please copy manually.' );
        }
        document.body.removeChild( ta );
    }

    btn.addEventListener( 'click', function () {
        var text = btn.getAttribute( 'data-copy' );

        if ( navigator.clipboard && window.isSecureContext ) {
            navigator.clipboard.writeText( text ).then( showCopied ).catch( function () {
                fallbackCopy( text );
            } );
        } else {
            fallbackCopy( text );
        }
    } );
} );
