/**
 * Load image to input
 * @param  object event --- click event
 * @param  object obj --- object
 */
function loadImage(event, obj)
{
	var send_attachment_bkp = wp.media.editor.send.attachment;
	var button = jQuery(obj);
	wp.media.editor.send.attachment = function(props, attachment) {
		jQuery(button).prev().val(attachment.url);
		wp.media.editor.send.attachment = send_attachment_bkp;
	}
	wp.media.editor.open(button);
}