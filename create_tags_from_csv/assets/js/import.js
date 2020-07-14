$(document).ready(function() {
    $('#form-upload').submit(function() {
        disableButtons()
        getUploadStatus()
    })

    function disableButtons() {
        $('#btn-upload').text('Processing...').prop('disabled', true)
        $('#btn-reset-upload').prop('disabled', true)
    }

    function getUploadStatus() {

        $('#upload-status').show()
        $('#upload-status').html('<span>Starting</span>')

        setInterval(function() {
            $.getJSON('status.json', function(data) {
                const total = data.length
                const email = data[total - 1]
                $('#upload-status').html(`<span>Processed itens: ${total} <br /> Last Processed Email: ${email}</span>`)
            })
        }, 2000)
    }
});