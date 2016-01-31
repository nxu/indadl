// (c) 2014-2016 nXu
$(document).ready(function () {
    // Init
    Downloader.bindButton();
});

// Downloader 'object'
var Downloader = {

    // Bind download event to downloader button
    bindButton: function () {
        $('body').on('click', '#getvideo', function (event) {
            event.preventDefault ? event.preventDefault() : event.returnValue = false;
            Downloader.buttonClickedEvent();
        });
        $('body').on('keypress', '#vidurl', function (event) {
            if (event.which == 13 || event.keyCode == 13) {
                Downloader.buttonClickedEvent();
            }
        });

        // Also bind back event
        $('body').on('click', '#back_link', function (event) {
            event.preventDefault ? event.preventDefault() : event.returnValue = false;
            Downloader.hideResult();
        });
    },

    // Handler to be called when the button has been clicked
    buttonClickedEvent: function () {
        Downloader.hideError();
        Downloader.getVideoUrl($('#vidurl').val());
    },

    // Get download link
    getVideoUrl: function (url) {
        // Check if it's an Indavideo URL
        if (!Downloader.checkUrlPattern(url)) {
            Downloader.showError('Kérlek adj meg egy érvényes Indavideo URL-t');
            return;
        }

        Downloader.startWaiting();

        $.ajax({
            url: 'downloader.php',
            dataType: 'json',
            data: {url: url},
            error: function () {
                Downloader.showError('Hiba a szerverrel való kommunikáció közben');
                return;
            },
            success: function (data) {
                if (!data.success) {
                    Downloader.showError(data.message);
                } else {
                    Downloader.showResult(data.video_url);
                }
            }
        });
    },

    // Check if the URL-s have pattern matching Indavideo videos
    checkUrlPattern: function (url) {
        var embedPattern = /(https?:\/\/)?embed\.indavideo\.hu\/player\/video\/([0-9a-f]+)(\?(.*))?$/i;
        var normalPattern = /(https?:\/\/)?([a-zA-Z]+\.)?indavideo\.hu\/video\/([a-zA-Z0-9_#\-]+)(\?(.*))?$/i;

        return embedPattern.test(url) || normalPattern.test(url);
    },

    // Shows an error message
    showError: function (msg) {
        $('#error').html(msg);
        $('#error').show();
        Downloader.endWaiting();
    },

    // Hide error message
    hideError: function () {
        $('#error').hide();
    },

    // Shows the result
    showResult: function (url) {
        $('#getvideo').hide();
        $('#vidurl').hide();
        $('#resultlink').attr('href', url);
        $('#result').show();
        $("#back").show();
    },

    // Hides the result and shows form again
    hideResult: function() {
        $("#result").hide();
        $("#back").hide();
        Downloader.endWaiting();
        $("#getvideo").show();
        $("#vidurl").val("").show().focus();
    },

    // Show waiting
    startWaiting: function () {
        $('#getvideo').html('...');
        $('#getvideo').prop('disabled', true);
    },

    // End waiting
    endWaiting: function () {
        $('#getvideo').html('Videó letöltése');
        $('#getvideo').prop('disabled', false);
    }
}
