$(document).ready(function() {

	configWhatsAppValidator()
	disableSubmitButton(true)

	const whatsapp = $('input[name="mauticform[whatsapp]"]')

	whatsapp.keyup(function(e) {

		console.log(whatsapp.val().length)

		if (whatsapp.val().length < 11) {
			disableSubmitButton(true)
			return;
		}

		$.ajax(
		{
			url:'https://api.wsapp.com.br/v1', type:'post', dataType:'json', contentType:'application/json',
			data:JSON.stringify({ srv:'ISWHAVALID', phone:whatsapp.val().replace(/\D/g,'').trim() }),
			beforeSend:function()
			{
				loader(true)
			},
			success:function(data)
			{
				if (data.resultado == 1) {
					if ( data.records[0].status == 'P' ) {
						setTimeout(function() {
							whatsapp.blur()
						}, 5000);
					}
					else if ( data.records[0].status == 'S' )
					{
						loader(false)
						setStatusBorder(true)
						disableSubmitButton(false)
					}
					else if ( data.records[0].status == 'N' || data.records[0].status == 'P' )
					{
						loader(false)
						setStatusBorder(false)
						disableSubmitButton(true)
					}
				} else {
					loader(false)
					setStatusBorder(false)
					disableSubmitButton(true)
				}
			}
		});
		e.preventDefault();
		return false;
	});

	function configWhatsAppValidator() {
		$('body').append('<div id="loader"></div>')
	}

	function disableSubmitButton(status) {
		$('button[name="mauticform[submit]"]').prop('disabled', status);
	}

	function setStatusBorder(status) {
		if (status) {
			whatsapp.siblings('.mauticform-errormsg').first().hide()
		} else {
			whatsapp.siblings('.mauticform-errormsg').first().show()
		}
	}

	function loader(status) {
		if (status) {
			$('#loader').show()
			$('form').hide()
		} else {
			$('#loader').hide()
			$('form').show()
		}
	}
})