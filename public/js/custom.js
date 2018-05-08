/**
 * Created by shuvr on 5/7/2018.
 */

$(document).ready(function () {
    $('.form-delete-btn').on('click', function () {
        $('.delete-watch').data('id', $(this).data('id'));
    });

    $('.delete-watch').on('click', function () {
        $('form#'+$(this).data('id')).submit();
    });

    $('.cancel-selection').on('click', function () {
        $('#functionalities option:selected').prop('selected', false);
    });
});