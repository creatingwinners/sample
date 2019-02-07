$(document).ready(function() {
    $('#form input').on('keyup, click', function(e) {
        $(this).removeClass('is-invalid');
    });
    if($('#form').length > 0) {
        $('#form').on('submit', function(e) {
            e.preventDefault();
            $('#form input').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $('#submitButton').text('Processing');
            $.ajax({
                dataType: 'json',
                url: $(this).attr('action'),
                data: $(this).serializeArray(),
                method: 'post',
                statusCode: {
                    422: function(data) {
                        $.each(data.responseJSON.errors, function(index, value) {
                            if($('#'+index).length > 0) {
                                $('#'+index).addClass('is-invalid').closest('.form-group').find('.invalid-feedback').text(value[0]);
                            }
                        });
                        $('#submitButton').text('Submit');
                    },
                    200: function(data) {
                        document.location.href=data.responseText;
                        $('#submitButton').text('Submit');
                    }
                }
            });
        });
    }

    $('#addressForm input').on('keyup, click', function(e) {
        $(this).removeClass('is-invalid');
    });
    if($('#addressForm').length > 0) {
        $('#addressForm').on('submit', function(e) {
            e.preventDefault();
            $('#addressForm input').removeClass('is-invalid');
            $('.invalid-feedback').text('');
            $.ajax({
                dataType: 'json',
                url: $(this).attr('action'),
                data: $(this).serializeArray(),
                method: 'post',
                statusCode: {
                    422: function(data) {
                        $.each(data.responseJSON.errors, function(index, value) {
                            if($('#'+index).length > 0) {
                                $('#'+index).addClass('is-invalid').closest('.form-group').find('.invalid-feedback').text(value[0]);
                            }
                        });
                    },
                    200: function(data) {
                        // alert(data.responseText)
                        document.location.href=data.responseText;
                    }
                }
            });
        });
    }

});
// JavaScript Document
