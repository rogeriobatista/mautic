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
            $.get('controllers/status.php', function(response) {
                const status = JSON.parse(response)
                updateStatus(status)
            })
        }, 2000)
    }

    function updateStatus(status) {
        $('#upload-status').html(`<span>Processed itens: ${status.total} <br /> Last Processed Email: ${status.email}</span>`)
    }
});