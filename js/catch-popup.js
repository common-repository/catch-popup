jQuery(function($){
	$(window).on('load', function(){
		$('#popup-' + data.id ).css({'min-width': data.min_width + '%', 'max-width': data.max_width+'%','top': data.top + 'px', 'left': parseInt($(window).width()/2) + 'px','opacity': '1',});
		$('.catch-popup-trigger').on('click', function(){
			$('#catch-popup-' + data.id).show();
		});

		setTimeout(function(){ $('#catch-popup-' + data.id ).show(); }, data.delay);

		$('#catch-popup-' + data.id + ' .catchup-close' ).hide();

		setTimeout(function(){ $('#catch-popup-' + data.id + ' .catchup-close' ).show();

			$(document).keyup(function(e) {
				if(1 == data.esc_close) {
				    if (27 == e.which) $('#catch-popup-' + data.id ).hide(); // esc   (fires when esc is released)
				}
				if(1 == data.f4_close) {
					    if ( 115 == e.which ) $('#catch-popup-' + data.id ).hide(); // f4   (fires when f4 is released)
				}
			});

			if( 1 == data.overlay_close ) {
				$('.catch-popup-overlay').on('click', function(event){
					//console.log( event.target.className );
					if('catch-popup-' + data.id == event.target.id){
						$('#catch-popup-' + data.id ).hide();
					}
				});
			}

		}, data.button_delay);

		$('.popup-close').on('click', function(){
			$('#catch-popup-' + data.id ).hide();
		});
	});
});
