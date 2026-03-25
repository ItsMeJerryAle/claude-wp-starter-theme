document.addEventListener( 'DOMContentLoaded', function () {
    var widget   = document.getElementById( 'donate-widget' );
    if ( ! widget ) return;

    var virtuousUrl  = widget.getAttribute( 'data-virtuous-url' ) || '';
    var tabs         = widget.querySelectorAll( '.donate-tab' );
    var amountBtns   = widget.querySelectorAll( '.donate-amount' );
    var customWrap   = document.getElementById( 'donate-custom-wrap' );
    var customInput  = document.getElementById( 'donate-custom-input' );
    var donateBtn    = document.getElementById( 'donate-btn' );

    var modal        = document.getElementById( 'donate-modal' );
    var modalIframe  = document.getElementById( 'donate-modal-iframe' );
    var modalTitle   = document.getElementById( 'donate-modal-title' );
    var modalClose   = document.getElementById( 'donate-modal-close' );
    var modalBackdrop = document.getElementById( 'donate-modal-backdrop' );

    var activeTab    = 'monthly';
    var activeAmount = '$100';

    // ── UI state ──────────────────────────────────────────────────────────────

    function updateTabs() {
        tabs.forEach( function ( tab ) {
            var active = tab.getAttribute( 'data-tab' ) === activeTab;
            tab.classList.toggle( 'bg-primary',    active );
            tab.classList.toggle( 'text-secondary', active );
            tab.classList.toggle( 'text-white',    ! active );
        } );
    }

    function updateAmounts() {
        amountBtns.forEach( function ( btn ) {
            var active = btn.getAttribute( 'data-amount' ) === activeAmount;
            btn.classList.toggle( 'bg-primary',       active );
            btn.classList.toggle( 'text-secondary',   active );
            btn.classList.toggle( 'border-primary',   active );
            btn.classList.toggle( 'text-white',       ! active );
            btn.classList.toggle( 'border-white\/30', ! active );
        } );
        customWrap.classList.toggle( 'hidden', activeAmount !== 'Custom' );
    }

    function updateBtn() {
        donateBtn.textContent = activeTab === 'monthly' ? 'Donate Monthly' : 'Donate Now';
    }

    // ── Modal ─────────────────────────────────────────────────────────────────

    function buildIframeSrc() {
        if ( ! virtuousUrl ) return '';

        var amt  = activeAmount === 'Custom'
            ? ( customInput.value || '' )
            : activeAmount.replace( '$', '' );

        var freq = activeTab === 'monthly' ? 'Recurring' : 'One-Time';

        var sep = virtuousUrl.indexOf( '?' ) !== -1 ? '&' : '?';
        var src = virtuousUrl + sep + 'frequency=' + encodeURIComponent( freq );
        if ( amt ) src += '&amount=' + encodeURIComponent( amt );

        return src;
    }

    function openModal() {
        if ( ! virtuousUrl ) {
            window.alert( 'Donation form URL is not configured.' );
            return;
        }

        var freq = activeTab === 'monthly' ? 'Monthly' : 'One-Time';
        var amt  = activeAmount === 'Custom'
            ? ( customInput.value ? '$' + customInput.value : '' )
            : activeAmount;

        modalTitle.textContent = 'Complete Your ' + freq + ' Gift' + ( amt ? ' — ' + amt : '' );
        modalIframe.src = buildIframeSrc();

        document.body.style.overflow = 'hidden';
        modal.classList.add( 'is-open' );
    }

    function closeModal() {
        modal.classList.remove( 'is-open' );
        document.body.style.overflow = '';
        // Clear iframe after transition to stop loading
        setTimeout( function () {
            modalIframe.src = '';
        }, 300 );
    }

    // ── Events ────────────────────────────────────────────────────────────────

    tabs.forEach( function ( tab ) {
        tab.addEventListener( 'click', function () {
            activeTab = tab.getAttribute( 'data-tab' );
            updateTabs();
            updateBtn();
        } );
    } );

    amountBtns.forEach( function ( btn ) {
        btn.addEventListener( 'click', function () {
            activeAmount = btn.getAttribute( 'data-amount' );
            updateAmounts();
            updateBtn();
        } );
    } );

    customInput.addEventListener( 'input', updateBtn );

    donateBtn.addEventListener( 'click', openModal );
    modalClose.addEventListener( 'click', closeModal );
    modalBackdrop.addEventListener( 'click', closeModal );

    document.addEventListener( 'keydown', function ( e ) {
        if ( e.key === 'Escape' && modal.classList.contains( 'is-open' ) ) {
            closeModal();
        }
    } );

    // ── Init ──────────────────────────────────────────────────────────────────

    updateTabs();
    updateAmounts();
    updateBtn();
} );
