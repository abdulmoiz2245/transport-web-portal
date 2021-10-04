$(document).ready(function () {
    $('.select2').select2({theme: "bootstrap"});
    $(".yes-radio").change(function () {
        var checked = $(this).val();
        if (checked === 'Fail') {
            $(this).closest('.checkbox_values').find('.display-none').hide();
            $(this).closest('.checkbox_values').find('.display-none').find('input').removeAttr('required');
        } else {
            $(this).closest('.checkbox_values').find('.display-none').css({"display": "flex"});
            $(this).closest('.checkbox_values').find('.display-none').find('input').prop('required', true);
        }
    });
    $(".consent-radio").change(function () {
        var checked = $(this).val();
        if (checked === 'No') {
            $(this).closest('.row').find('.display-none').hide();
            $(this).closest('.row').find('.display-none').find('input').removeAttr('required');
        } else {
            $(this).closest('.row').find('.display-none').css({"display": "flex"});
            $(this).closest('.row').find('.display-none').find('input').prop('required', true);
        }
    });
    $(".checkbox_input").change(function () {
        var ischecked = $(this).is(':checked');
        if (!ischecked) {
            $(this).closest('label').next('.checkbox_values').hide();
            $(this).closest('label').next('.checkbox_values').find('input').removeAttr('required');
        } else {
            $(this).closest('label').next('.checkbox_values').css({"display": "flex"});
            $(this).closest('label').next('.checkbox_values').find('input').prop('required', true);
        }
    });

    $(".checkbox_input:checked").each(function () {
        $(this).closest('label').next('.checkbox_values').css({"display": "flex"});
    });

    $(".yes-radio:checked").each(function () {
        var checked = $(this).val();
        if (checked !== 'Fail') {
            $(this).closest('.row').find('.yes-details').parent('div').css({"display": "flex"});
        }
    });

    $(".consent-radio:checked").each(function () {
        var checked = $(this).val();
        if (checked !== 'No') {
            $(this).closest('.row').find('.display-none').css({"display": "flex"});
        }
    });

    $("#fixed-term").change(function () {
        var ischecked = $(this).is(':checked');
        if (!ischecked) {
            $('#fixed-term-end').val('');
            $('#fixed-term-end').prop('disabled', true);
            $('#fixed-term-end').removeAttr('required');
        } else {
            $('#fixed-term-end').removeAttr('disabled');
            $('#fixed-term-end').prop('required', true);
        }
    });
    $(document).on("change", '.cutomer_branches', function () {
        var url = $(this).attr('post_action');
        var branch_id = $(this).children("option:selected").val();
        var html_data = '<option value="">Select Customer</option>';
        var val = $('select#Customer').attr('val');
        if (branch_id !== '' && branch_id !== undefined) {
            jQuery("#ajax-preloader").show();
            $.post(url,
                    {branch_id: branch_id},
                    function (data) {
                        data = JSON.parse(data);
                        $.each(data, function (i, item) {
                            if (val === item.customer_id) {
                                var selected = 'selected';
                            } else {
                                var selected = '';
                            }
                            html_data = html_data + '<option value="' + item.customer_id + '" ' + selected + '>' + item.customer_name + ' - ' + item.customer_code + '</option>';
                        });
                        $('#Customer').html(html_data);
                        $('select#Customer').trigger('change');
                        jQuery("#ajax-preloader").delay(500).fadeOut("slow");
                    });
        }
    });
    $(document).on("change", '.branches', function () {
        var url = $(this).attr('post_action');
        var branch_id = $(this).children("option:selected").val();
        var html_data = '<option value="">Select Site</option>';
        if (branch_id !== '' && branch_id !== undefined) {
            jQuery("#ajax-preloader").show();
            $.post(url,
                    {branch_id: branch_id},
                    function (data) {
                        data = JSON.parse(data);
                        $.each(data, function (i, item) {
                            html_data = html_data + '<option value="' + item.site_id + '">' + item.site_name + '</option>';
                        });
                        $('#Site').html(html_data);
                        $('#Site').find('option[value="' + $('#Site').attr('val') + '"]').prop('selected', 'true');
                        $('#Site').trigger('change');
                        jQuery("#ajax-preloader").delay(500).fadeOut("slow");
                    });
        }
    });
    $(document).on("click", '.employment_status', function () {
        var url = $(this).attr('post_action');
        var id = $(this).attr('employee_id');
        var btn = $(this);
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#0CC27E",
            cancelButtonColor: "#FF586B",
            confirmButtonText: "Yes, change it!",
            cancelButtonText: "No, cancel!",
            confirmButtonClass: "btn btn-success mr-5",
            cancelButtonClass: "btn btn-danger",
            buttonsStyling: !1
        }).then(function () {
            $.post(url,
                    {employee_id: id},
                    function (data) {
                        btn.replaceWith(data);
                        swal("Success!", "Employment status is changed.", "success")
                    });
        }, function (t) {
            "cancel" === t && swal("Cancelled", "Employment status is not changed.", "error")
        });
    });
    $(document).on("click", '.employee_account', function () {
        var url = $(this).attr('post_action');
        var id = $(this).attr('employee_id');
        var e_status = $(this).attr('status');
        var btn = $(this);
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#0CC27E",
            cancelButtonColor: "#FF586B",
            confirmButtonText: "Yes, " + e_status + " it!",
            cancelButtonText: "No, cancel!",
            confirmButtonClass: "btn btn-success mr-5",
            cancelButtonClass: "btn btn-danger",
            buttonsStyling: !1
        }).then(function () {
            $.post(url,
                    {employee_id: id},
                    function (data) {
                        btn.replaceWith(data);
                        swal("Success!", "Employee account is " + e_status + "ed.", "success")
                    });
        }, function (t) {
            "cancel" === t && swal("Cancelled", "Employee account is not  " + e_status + "ed.", "error")
        });
    });
});

$(document).on('change', 'input[type="file"]', function (e) {

    var displayArea = $(this).attr("data");
    var src = URL.createObjectURL(e.target.files[0]);
      var url = $(this).attr('post_action');
    f = e.target.files[0].type;

    f = f.replace(/.*[\/\\]/, '');


    var Mysrc = '<img src="' + url + '/file_icons/fileicon.ico" style="width:20px; height:20px; margin-top:-5px;">';
    if (f == 'jpeg' || f == 'jpg' || f == 'png' || f == 'gif' || f == 'jfif') {
        Mysrc = '<img src="' + src + '"  style="width:20px; height:20px; margin-top:-5px; border:2px solid #ccc;">';
    } else if (f == 'vnd.openxmlformats-officedocument.wordprocessingml.document') {
        Mysrc = '<img src="' + url + '/file_icons/wordicon.png"  style="width:20px; height:20px; margin-top:-5px;">';
    } else if (f == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
        Mysrc = '<img src="' + url + '/file_icons/excelicon.png"  style="width:20px; height:20px; margin-top:-5px;">';
    } else if (f == 'vnd.openxmlformats-officedocument.presentationml.presentation') {
        Mysrc = '<img src="' + url + '/file_icons/ppicon.png"  style="width:20px; height:20px; margin-top:-5px;">';
    } else if (f == 'x-zip-compressed') {
        Mysrc = '<img src="' + url + '/file_icons/zipicon.png"  style="width:20px; height:20px; margin-top:-5px;">';
    } else if (f == 'pdf') {
        Mysrc = '<img src="' + url + '/file_icons/pdficon.png" style="width:20px; height:20px; margin-top:-5px;">';
    }
    fileName = e.target.files[0].name;
//	if(fileName.length > 40){
//		fileName =  fileName.substring(0, 40);
//		fileName = fileName+'...';
//	}

    $(this).next('label').attr("title", e.target.files[0].name).html(Mysrc + " " + fileName);
});


$(document).ready(function () {
    $("#zero_configuration_table").DataTable(), $("#feature_disable_table").DataTable({
        paging: !1,
        ordering: !1,
        info: !1
    }), $("#deafult_ordering_table").DataTable({
        order: [
            [3, "desc"]
        ]
    }), $("#multicolumn_ordering_table").DataTable({
        columnDefs: [{
                targets: [0],
                orderData: [0, 1]
            }, {
                targets: [1],
                orderData: [1, 0]
            }, {
                targets: [4],
                orderData: [4, 0]
            }]
    }), $("#hidden_column_table").DataTable({
        responsive: !0,
        columnDefs: [{
                targets: [2],
                visible: !1,
                searchable: !1
            }, {
                targets: [3],
                visible: !1
            }]
    }), $("#complex_header_table").DataTable(), $("#dom_positioning_table").DataTable({
        dom: '<"top"i>rt<"bottom"flp><"clear">'
    }), $("#alternative_pagination_table").DataTable({
        pagingType: "full_numbers"
    }), $("#scroll_vertical_table").DataTable({
        scrollY: "200px",
        scrollCollapse: !0,
        paging: !1
    }), $("#scroll_horizontal_table").DataTable({
        scrollX: !0
    }), $("#scroll_vertical_dynamic_height_table").DataTable({
        scrollY: "50vh",
        scrollCollapse: !0,
        paging: !1
    }), $("#scroll_horizontal_vertical_table").DataTable({
        scrollY: 200,
        scrollX: !0
    }), $("#comma_decimal_table").DataTable({
        language: {
            decimal: ",",
            thousands: "."
        }
    }), $("#language_option_table").DataTable({
        language: {
            lengthMenu: "Display _MENU_ records per page",
            zeroRecords: "Nothing found - sorry",
            info: "Showing page _PAGE_ of _PAGES_",
            infoEmpty: "No records available",
            infoFiltered: "(filtered from _MAX_ total records)"
        }
    })
});

$(document).ready(function () {
//    $(".picker2, #picker3").pickadate({
//        selectMonths: true,
//        selectYears: true,
//        format: 'yyyy-mm-dd',
//        selectYears: 30,
//    });
    $(".picker2, #picker3").datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
    });
});

$(document).ready(function () {
    $("form :input").each(function () {
        var label = $(this).prev("label");
        var placeholder = $(this).attr("placeholder");
        if (label.length === 1 && placeholder === undefined) {
            $(this).attr("placeholder", "Enter " + $(label).html());
            $(this).attr("id", $(label).html().replace(/ /g, "_"));
            label.attr("for", $(label).html().replace(/ /g, "_"));
        }
    });
    $('.phone').mask('0000-000-0000');
    $('.cnic').mask('00000-0000000-0');
    $("select").each(function () {
        $("select").each(function () {
            $(this).find('option[value="' + $(this).attr('val') + '"]').prop('selected', 'true');
            $(this).trigger('change');
        });
    });

    $('.select2-site-ajax').select2({
        placeholder: 'Assign Sites',
        theme: "bootstrap",
        allowClear: true,
        minimumInputLength: 3,
        ajax: {
            url: base_url + 'admin/search-sites',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.site_name,
                            id: item.site_id
                        }
                    })
                };
            },
            cache: true
        }
    });
});


