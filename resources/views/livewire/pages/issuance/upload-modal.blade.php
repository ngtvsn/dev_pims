<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Issuance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="uploadForm">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="recipients">Recipients</label>
                        <select class="form-control" id="recipients" name="recipients[]" multiple="multiple" required>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="file">File</label>
                        <input type="file" class="form-control-file" id="file" name="file" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Upload</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#recipients').select2({
            ajax: {
                url: '/api/document-recipients',
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                text: item.name,
                                id: item.id
                            }
                        })
                    };
                }
            }
        });
    });

    function submitForm() {
        // Get form data
        var formData = new FormData($('#uploadForm')[0]);

        // Send form data to the server
        $.ajax({
            url: '/api/issuances', // Replace with your upload endpoint
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Handle success
                console.log(response);
                $('#uploadModal').modal('hide');
            },
            error: function(error) {
                // Handle error
                console.log(error);
            }
        });
    }
</script>
