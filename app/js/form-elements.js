var FormElements = function () {
    //function to initiate jquery.inputlimiter
    var runInputLimiter = function () {
        $('.limited').inputlimiter({
            remText: '%n Character%s Remaining...',
            remFullText: 'Error ! You\'re Not Allowed to Enter More Than 10 Characters !',
            limitText: ''
        });
    };
    //function to initiate query.autosize    
    var runAutosize = function () {
        $("textarea.autosize").autosize();
    };
    //function to initiate Select2
    var runSelect2 = function () {
        $(".search-select").select2({
            placeholder: "Select...",
            allowClear: true
        });
    };
    //function to initiate jquery.maskedinput
    var runMaskInput = function () {
        $.mask.definitions['~'] = '[+-]';
        $('.input-mask-date').mask('99/99/9999');
        $('.input-mask-phone').mask('(999) 999-9999');
        $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
        $(".input-mask-product").mask("a*-999-a999", {
            placeholder: " ",
            completed: function () {
                alert("You typed the following: " + this.val());
            }
        });
    };
    var runMaskMoney = function () {
        $(".currency").maskMoney();
    };
    //function to initiate bootstrap-datepicker
    var runDatePicker = function () {
        $('.date-picker').datepicker({
            autoclose: true
        });
    };
    //function to initiate bootstrap-timepicker
    var runTimePicker = function () {
        $('.time-picker').timepicker();
    };
    //function to initiate daterangepicker
    var runDateRangePicker = function () {
        $('.date-range').daterangepicker();
        $('.date-time-range').daterangepicker({
            timePicker: true,
            timePickerIncrement: 15,
            format: 'MM/DD/YYYY h:mm A'
        });
    };
    //function to initiate bootstrap-colorpicker
    var runColorPicker = function () {
        $('.color-picker').colorpicker({
            format: 'hex'
        });
        $('.color-picker-rgba').colorpicker({
            format: 'rgba'
        });
        $('.colorpicker-component').colorpicker();
    };
    //function to initiate bootstrap-colorpalette
    var runColorPalette = function () {
        $('.color-palette').colorPalette()
            .on('selectColor', function (e) {
                $('#selected-color1').val(e.color);
            });
    };
    //function to initiate jquery.tagsinput
    var runTagsInput = function () {
        $('#tags_1').tagsInput({
            width: 'auto'
        });
    };
    //function to initiate summernote
    var runSummerNote = function () {
        $('.summernote').summernote({
            height: 300,
            tabsize: 2
        });
    };
    //function to initiate ckeditor
    var runCKEditor = function () {
        CKEDITOR.disableAutoInline = true;
        $('textarea.ckeditor').ckeditor();
    };
    return {
        //main function to initiate template pages
        init: function () {
            runInputLimiter();
            runAutosize();
            runSelect2();
            runMaskInput();
            runMaskMoney();
            runDatePicker();
            runTimePicker();
            runDateRangePicker();
            runColorPicker();
            runColorPalette();
            runTagsInput();
            runSummerNote();
            runCKEditor();
        }
    };
}();