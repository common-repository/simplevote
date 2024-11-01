/*
 http://www.smashingmagazine.com/2011/10/18/how-to-use-ajax-in-wordpress
*/
jQuery(document).ready(function($) {
	$(".simplevote .button").on('click',function ( event ) {
		event.preventDefault();
		post_id = jQuery(this).attr("data-post_id")
		nonce = jQuery(this).attr("data-nonce")
		value = jQuery(this).attr("data-value")
		jQuery.ajax({
			type : "post",
			dataType : "json",
			url : myAjax.ajaxurl,
			data : {action: "my_user_vote", post_id : post_id, nonce: nonce, value: value},
			success: function(response) {
				if(response.type == "success") {
					// all ok.
//					$(".simplevote .button").removeAttr('href','');
					$(".simplevote .button").off('click');
					$(".simplevote .hottext").html((response.hotvotes?response.hotvotes:'0')+'x');
					$(".simplevote .nottext").html((response.notvotes?response.notvotes:'0')+'x');
					
				}
				else {
					alert("Your vote could not be added")
				}
			},
			error: function( response ) {
				alert('ajax error');
			}
		})   

	});
	
});
