$(document).ready(function() {

	configWhatsAppValidator()
	disableSubmitButton(true)

	$('input[name="mauticform[telefone]"]').blur(function(e) {
		const telefone = $('input[name="mauticform[telefone]"]').val()
		if (telefone == '') return
		$.ajax(
		{
			url:'https://api.wsapp.com.br/v1', type:'post', dataType:'json', contentType:'application/json',
			data:JSON.stringify({ srv:'ISWHAVALID', phone:telefone.replace(/\D/g,'').trim() }),
			beforeSend:function()
			{
				loader(true)
			},
			success:function(data)
			{
				if ( data.records[0].status == 'S' )
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
			}
		});
		e.preventDefault();
		return false;
	});

	function configWhatsAppValidator() {
		$('head').append('<link rel="stylesheet" type="text/css" href="loader.css" />')
		$('body').append('<div id="loader"></div>')
	}

	function disableSubmitButton(status) {
		$('button[name="mauticform[submit]"]').prop('disabled', status);
	}

	function setStatusBorder(status) {
		if (status) {
			$('input[name="mauticform[telefone]"]').siblings('.mauticform-errormsg').first().hide()
		} else {
			$('input[name="mauticform[telefone]"]').siblings('.mauticform-errormsg').first().show()
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