document.addEventListener( 'wpcf7mailsent', function( event ) {
    console.log(event.detail);
    var redirectInput = event.detail.inputs.find(function(item) {
        return item.name === 'redirect-page';
    });

    if (redirectInput && redirectInput.value) {
        window.location = redirectInput.value;
    }
}, false );