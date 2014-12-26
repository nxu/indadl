// (c) 2014 nXu
$(document).ready(function() {
	// Init
	Downloader.bindButton();
});

// Downloader 'object'
var Downloader = {

	// Bind download event to downloader button
	bindButton : function() {
		$('#getvideo').on('click', function(event) {
			event.preventDefault ? event.preventDefault() : event.returnValue = false;
			Downloader.hideError();
			Downloader.getVideoUrl($('#vidurl').val());
		});
	},
	
	// Get download link
	getVideoUrl : function(url) {
		// Check if it's an Indavideo URL
		if (!Downloader.checkUrlPattern(url)) {
			Downloader.showError('Kérlek adj meg egy érvényes Indavideo URL-t');
			return;
		}

		Downloader.startWaiting();

		$.ajax({
			url      : 'loader.php',
			dataType : 'json', 
			data     : { url: url },
			error    : function() {
				Downloader.showError('Hiba a szerverrel való kommunikáció közben');
				return;
			},
			success  : function(data) {
				if (!data.success) {
					Downloader.showError(data.message);
				} else {
					Downloader.showResult(data.video_url);
				}
			}
		});
	},
	
	// Check if the URL-s have pattern matching Indavideo videos
	checkUrlPattern : function(url) {
		var embedPattern = /^https?:\/\/embed\.indavideo\.hu\/player\/video\/([0-9a-f]+)$/;
		var normalPattern = /^https?:\/\/([a-zA-Z]+\.)?indavideo\.hu\/video\/[a-zA-Z0-9_#\-]+$/;
		
		return embedPattern.test(url) || normalPattern.test(url);
	},
	
	// Shows an error message
	showError : function(msg) {
		$('#error').html(msg);
		$('#error').show();
		Downloader.endWaiting();
	},
	
	// Hide error message
	hideError : function() {
		$('#error').hide();
	},
	
	// Shows the result
	showResult : function(url) {
		$('#getvideo').hide();
		$('#vidurl').hide();
		$('#resultlink').attr('href', url);
		$('#result').show();
	},

        // Show waiting
        startWaiting : function() {
        	$('#getvideo').html('...');
		$('#getvideo').prop('disabled', true);
        },

	// End waiting
	endWaiting : function() {
		$('#getvideo').html('Videó letöltése');
		$('#getvideo').prop('disabled', false);
	}
}
