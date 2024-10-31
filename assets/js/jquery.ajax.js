/*
* @Author: sanjay
* @Date:   2019-11-29 17:58:49
* @Last Modified by:   sanjay
* @Last Modified time: 2019-12-02 12:35:31
*/

jQuery(function($){
	$('body.post-type-post .row-actions .trash a').click(function( event ){
 
		event.preventDefault();
 
		var url = new URL( $(this).attr('href') ),
		    nonce = url.searchParams.get('_wpnonce'), // MUST for security checks
		    row = $(this).closest('tr'),
		    postID = url.searchParams.get('post'),
		    postTitle = row.find('.row-title').text();
 
 
		row.css('background-color','#ffafaf').fadeOut(300, function(){
			row.removeAttr('style').html('<td colspan="5">Post <strong>' + postTitle + '</strong> moved to the Trash.</td>').show();
		});
 
		$.ajax({
			method:'POST',
			url: ajax_object.ajaxurl,
			data: {
				'action' : 'rpuaa_remove_post',
				'post_id' : postID,
				'_wpnonce' : nonce
			}
		});
 
	});
});