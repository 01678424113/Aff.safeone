$(document).ready(function () {
    $('input[type=checkbox], input[type=radio]').not('.disallow_icheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });


    $(document).on('ifClicked', '.check_all', function () {
        var CLASS = $(this).attr('data-class');
        if (CLASS != undefined && CLASS != '') {
            if (!this.checked) {
                $('.' + CLASS).iCheck('check');
            } else {
                $('.' + CLASS).iCheck('uncheck');
            }
        }
    });
});