$(function () {

    /**
     * -------------------------------------------------------------------------
     * DEBUG
     * -------------------------------------------------------------------------
     *
     *
     */

    var debug = true;

    /**
     * -------------------------------------------------------------------------
     * Login logo
     * -------------------------------------------------------------------------
     *
     *
     */

    setTimeout(function () {
        $('.avatar').css('visibility', 'visible').addClass('bounceInDown');
    }, 500);

    /**
     * -------------------------------------------------------------------------
     * metisMenu
     * -------------------------------------------------------------------------
     *
     *
     */

    $('.sidebar-menu').metisMenu();

    /**
     * -------------------------------------------------------------------------
     * Summernote
     * -------------------------------------------------------------------------
     *
     *
     */

    $('#summernote-textarea').summernote({
        height: 300,
        lang: 'hu-HU'
    });


    /**
     * -------------------------------------------------------------------------
     * Ckeditor
     * -------------------------------------------------------------------------
     *
     *
     */

    $('.ckeditor').ckeditor({
        //'filebrowserBrowseUrl': '/elfinder/ckeditor4',
        'contentsCss': '/ckeditor/css/bootstrap.css',
        'removePlugins': 'scayt',
        'skin': 'bootstrapck',
        'allowedContent':true
    });


    /**
     * -------------------------------------------------------------------------
     * BootstrapSwitch
     * -------------------------------------------------------------------------
     *
     *
     */

    $('.btn-switch').bootstrapSwitch({
        onText: 'Igen',
        offText: 'Nem',
        onColor: 'success'
    });

    /**
     * -------------------------------------------------------------------------
     * DateTimePicker
     * -------------------------------------------------------------------------
     *
     *
     */


    $('#dateTimeStart').datetimepicker({
        format: 'Y.m.d H:i',
        lang: 'hu'
    });
    $('#dateTimeEnd').datetimepicker({
        format: 'Y.m.d H:i',
        lang: 'hu'
    });


    /**
     * -------------------------------------------------------------------------
     * TagsInput
     * -------------------------------------------------------------------------
     *
     *
     */

    $("[name='tags']").tagsinput({
        freeInput: true
    });

    /**
     * -------------------------------------------------------------------------
     * TableSorter
     * -------------------------------------------------------------------------
     *
     *
     */

    $.extend($.tablesorter.themes.bootstrap, {
        table: 'table table-bordered table-condensed',
        caption: 'caption',
        header: '',
        footerRow: '',
        footerCells: '',
        icons: '',
        sortNone: 'fa fa-sort',
        sortAsc: 'fa fa-sort-asc',
        sortDesc: 'fa fa-sort-desc',
        active: '',
        hover: '',
        filterRow: '',
        even: '',
        odd: ''
    });

    $('.table-sortable').tablesorter({
        theme: 'bootstrap',
        widthFixed: false,
        emptyTo: 'bottom',
        headerTemplate: '{content} {icon}',
        widgets: ["uitheme", "filter", "zebra", "saveSort"],
        widgetOptions: {
            zebra: ["even", "odd"],
            filter_reset: ".reset",
            filter_cssFilter: 'form-control input-sm'
        }
    })
        .tablesorterPager({
            container: $(".ts-pager"),
            cssGoto: ".pagenum",
            savePages: true,
            removeRows: false,
            output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'

        });

    $('.sorter-false').find('i').remove().end().find('.tablesorter-header-inner').css('padding', '0');


    /**
     * -------------------------------------------------------------------------
     * Kijelölés
     * -------------------------------------------------------------------------
     *
     *
     */

    $('#checkAll').on('click', this, function () {
        if ($(this).is(':checked')) {
            $('input[name="delete"]').prop('checked', true);
        } else {
            $('input[name="delete"]').prop('checked', false);
        }
    });

    /**
     * -------------------------------------------------------------------------
     * Törlés
     * -------------------------------------------------------------------------
     *
     *
     */


    $('#deleteButton').on('click', this, function () {

        if (confirm('Biztos, hogy törlöd a kijelölt elemeket?')) {
            $('[name=delete]:checked').each(function () {
                var $this = $(this);
                $.ajax({
                    url: $this.data('url'),
                    type: 'post',
                    data: {_method: 'delete'},
                    dataType: 'json',
                    success: function (data, textStatus, jqXHR) {

                        if (debug) {
                            console.log(data);
                            console.log(textStatus);
                            console.log(jqXHR);
                        }

                        if (data.status) {
                            alertify.success('<i class="fa fa-check"></i> ' + data.message);
                            $this.closest('tr').remove();
                        } else {
                            alertify.error('<i class="fa fa-times"></i> ' + data.message);
                        }

                    },
                    error: function (data, textStatus, jqXHR) {
                        if (debug) {
                            console.log(data);
                            console.log(textStatus);
                            console.log(jqXHR);
                        }
                    }
                });
            });

        }

    });


    /**
     * -------------------------------------------------------------------------
     * Ajax
     * -------------------------------------------------------------------------
     *
     *
     */

    $('.btn-ajax').on('click', this, function (e) {
        e.preventDefault();

        var formAjax = $(this).closest('.form-ajax');

        $.ajax({
            url: formAjax.attr('action'),
            method: formAjax.attr('method'),
            data: formAjax.serialize(),
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {

                if (debug) {
                    console.log(data);
                    console.log(textStatus);
                    console.log(jqXHR);
                }

                if (data.status) {
                    alertify.success('<i class="fa fa-check"></i> ' + data.message);
                } else {
                    alertify.error('<i class="fa fa-times"></i> ' + data.message);
                }

            },
            error: function (data, textStatus, jqXHR) {
                if (debug) {
                    console.log(data);
                    console.log(textStatus);
                    console.log(jqXHR);
                }
            }
        });

    });

    /**
     * -------------------------------------------------------------------------
     * Képfeltöltés gomb
     * -------------------------------------------------------------------------
     *
     *
     */


    var btnUpload = $('.btn-upload');
    var inputUpload = $('.input-upload');
    var btnUploadText = btnUpload.text();

    btnUpload.click(function (e) {
        e.preventDefault();

        inputUpload.click();
    });

    inputUpload.change(function () {

        var uploadValue = $(this).get(0).files.length;

        if (uploadValue > 0) {
            btnUpload.text(btnUploadText + ': ' + uploadValue + " fájl kiválasztva");
        } else {
            btnUpload.text(btnUploadText);
        }

    });

    /**
     * -------------------------------------------------------------------------
     * Képfeltöltés
     * -------------------------------------------------------------------------
     *
     *
     */


    $('.form-ajax-upload').each(function () {
        var form = $(this);

        $(this).fileupload({
            url: form.attr('action'),
            type: form.attr('method'),
            autoUpload: true,
            dataType: 'json',
            add: function (event, data) {
                data.submit();
                $('.btn-upload').addClass('disabled').html('<i class="fa fa-refresh fa-spin"></i> Töltés');
            },
            send: function (e, data) {
            },
            progress: function (e, data) {
                var percent = Math.round((e.loaded / e.total) * 100);
                $('.progress-bar').css('width', percent + '%');
                $('.progress-bar').text(percent + '%');
            },
            fail: function (e, data) {
                $('.progress').addClass('progress-danger');
            },
            success: function (data) {
            },
            done: function (event, data) {

                $.each(data.result, function (index, file) {
                    var tr = $('<tr />');
                    tr.append('<td><a href="' + file.url + '" target="_blank"><img src="' + file.thumbnailUrl + '" width="100"/></a></td>');
                    tr.append('<td>' + file.name + '</td>');
                    tr.append('<td><a class="btn btn-sm btn-danger btn-ajax-delete" href="' + file.deleteUrl + '"><i class="fa fa-times"></i> Törlés</a></td>');

                    $('.table').find('tbody').append(tr);
                    $('.table').find('tbody').find('.table-empty').remove();
                });

                $('.progress-bar').css('width', 0);
                $('.progress-bar').text('');
                $('.btn-upload').removeClass('disabled').html('Feltöltés');

                $('.btn-ajax-delete').off('click').on('click', this, function (e) {
                    e.preventDefault();

                    var $this = $(this);

                    $.ajax({
                        url: $this.attr('href'),
                        method: 'post',
                        dataType: 'json',
                        success: function (data, textStatus, jqXHR) {

                            if (data.status) {
                                alertify.success('<i class="fa fa-check"></i> ' + data.message);
                                $this.closest('tr').remove();
                            } else {
                                alertify.error('<i class="fa fa-ban"></i> ' + data.message);
                            }

                        },
                        error: function (data, textStatus, jqXHR) {
                            if (debug) {
                                console.log(data);
                                console.log(textStatus);
                                console.log(jqXHR);
                            }
                        }
                    });
                });


            },
        })
    });

    /**
     * -------------------------------------------------------------------------
     * Képtörlés
     * -------------------------------------------------------------------------
     *
     *
     */


    $('.btn-ajax-delete').on('click', this, function (e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            url: $this.attr('href'),
            method: 'post',
            dataType: 'json',
            success: function (data, textStatus, jqXHR) {

                if (data.status) {
                    alertify.success('<i class="fa fa-check"></i> ' + data.message);
                    $this.closest('tr').remove();
                } else {
                    alertify.error('<i class="fa fa-ban"></i> ' + data.message);
                }

            },
            error: function (data, textStatus, jqXHR) {
                if (debug) {
                    console.log(data);
                    console.log(textStatus);
                    console.log(jqXHR);
                }
            }
        });
    });

    /**
     * Menütípus tab váltás
     */

    $('select[name=type]').change(function () {
        $('a[href="#' + $(this).val() + '"]').tab('show');
    });

    /**
     * Oldal menü
     */

    $('.treeview').children('ul').addClass('treeview-menu');


});

