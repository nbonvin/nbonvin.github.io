$(document).ready(function(){
	$("#contactForm").submit(function(){
		var str = $(this).serialize();
		$.ajax({
			type: "POST",
			url: "contact.php",
			data: str,
			success: function(msg){
				$("#note").ajaxComplete(function(event, request, settings){
					if(msg == 'OK')
					{
						result = '<div id="notification" class="ok"><p>Your message has been sent. Thank you!</p></div>';
						$('#contactForm').each (function(){
							this.reset();
						});
					}
					else
					{
						result = msg;
					}
					$(this).html(result);
				});
			}
		});
		return false;
	});
});