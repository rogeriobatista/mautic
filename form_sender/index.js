$(document).ready(function() {
    const mautic_url = getUrlParameter('mauticUrl')
    const email = getUrlParameter('email')
    const formId = getUrlParameter('formId')

    const url = `https://${mautic_url}/form/submit?formId=${formId}`

    let values = { mauticform: { 'f_email': email, 'formId': formId } }

    $.ajax({
        url: url,
        data: $.param(values),
        type: 'POST',
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        success: (content, status, xhr) => {
            console.log('The submission was successful.');
        },
        error: (xhr) => {
            console.log('An error occured when submitting the form');
        },
    });
})

const getUrlParameter = function(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=')

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1])
        }
    }
}