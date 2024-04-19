jQuery(window).on("load", function () {
    jQuery(".loader").fadeOut("slow");
});
jQuery(document).ready(function () {
    jQuery(".delete").click(function (e) {
        e.preventDefault();
        jQuery('body').addClass('modal-open');
        let url = jQuery(this).attr('href');
        swal({
            title: 'Are You Sure?',
            text: 'You want to delete',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            buttons: ["No", "Yes"],
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.replace(url)
                } else {
                    jQuery('body').removeClass('modal-open');
                }
            });
    });
    // restore
    jQuery(".restore").click(function (e) {
        e.preventDefault();
        jQuery('body').addClass('modal-open');
        let url = jQuery(this).attr('href');
        swal({
            title: 'Are You Sure?',
            text: 'You want to restore',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            buttons: ["No", "Yes"],
        })
            .then((willRestore) => {
                if (willRestore) {
                    window.location.replace(url)
                } else {
                    jQuery('body').removeClass('modal-open');
                }
            });
    });

    /* Center no record message */
    if ($("td.no-record-found").length)
        $("td.no-record-found").attr("colspan", $("td.no-record-found").closest("table").find("tr:first-child th").length)
});


// Jquery custom validations
$.validator.addMethod("imageExtension", function (value, element) {
    // Get file extension
    var extension = value.split('.').pop().toLowerCase();
    // List of allowed extensions
    var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    // Check if the extension is in the list of allowed extensions
    return $.inArray(extension, allowedExtensions) !== -1;
}, "Please choose a valid image file (jpg, jpeg, png)");

jQuery.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');

jQuery.validator.addMethod("validDate", function (value, element) {
    return this.optional(element) || moment(value, "YYYY/MM/DD").isValid();
}, "Please enter a valid date in the format YYYY/MM/DD");

jQuery.validator.addMethod('doclength', function (value, element, param) {
    return this.optional(value) || (value.size <= 30)
}, 'Document name can be max 30 characters');


jQuery.validator.addMethod("regex", function (value, element, regexp) {
    if (regexp.constructor != RegExp) {
        regexp = new RegExp(regexp);
    } else if (regexp.global) {
        regexp.lastIndex = 0;
    }

    return this.optional(element) || regexp.test(value);
}, "Enter a valid value");


function handleValidation(form, rules, messages = {}, submitHandler = false) {
    if (typeof form == "string")
        form = jQuery('form#' + form);
    let valdiationConfiguration = {
        errorClass: "invalid-feedback",
        ignore: [],
        rules: rules,
        messages: messages,
        highlight: function (element) {
            jQuery(element).siblings("span.invalid-feedback").remove();
            if (jQuery(element).hasClass('selectric')) {
                jQuery(element).parents('.selectric-wrapper').addClass("selectric-is-invalid");
            } else {
                jQuery(element).parent().addClass("is-invalid");
            }
            jQuery(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            if (jQuery(element).hasClass('selectric')) {
                jQuery(element).parents('.selectric-wrapper').removeClass("selectric-is-invalid");
            } else {
                jQuery(element).parent().removeClass("is-invalid");
            }
            jQuery(element).removeClass("is-invalid");
        },
        errorPlacement: function (label, element) {
            console.log(element);
            if (jQuery(element).hasClass('selectric')) {
                label.removeClass('invalid-feedback').addClass('cstm-selectric-invalid').insertAfter(jQuery(element).parent().siblings('.selectric'))
            } else if (jQuery(element).hasClass('select2-error')) {
                label.insertAfter($(element).parent())
            } else if (jQuery(element).hasClass('image-input')) {
                $('#errorViewer').html(label);
            } else if (jQuery(element).hasClass('input-industry')) {
                $('#Viewererror').html(label);
            }
            else {
                label.insertAfter(element)
            }
        }
    };
    if (submitHandler)
        valdiationConfiguration.submitHandler = submitHandler;
    form.validate(valdiationConfiguration);
}
jQuery(document).ajaxStart(function (event, request, settings) {
    jQuery("body").addClass("loading");
});
jQuery(document).ajaxStop(function (event, request, settings) {
    jQuery("body").removeClass("loading");
});
jQuery.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content'),
    }
});

function ajaxCall(url, method, params, loader = true) {
    if (loader) {
        return new Promise((resolve, reject) => {
            let requestObject = {
                url: url,
                method: method,
                data: params,
                // processData: false,
                // contentType: false,
                dataType: 'json',
                beforeSend: function () {
                    jQuery(".loader").fadeIn("slow");
                    // jQuery("body").addClass("loading");
                    // jQuery(".loader").addClass("loading");
                },
                complete: function (resp, status) {
                    // jQuery("body").removeClass("loading");
                    jQuery(".loader").fadeOut("slow");
                },
                success: function (response) {
                    resolve(response)
                },
                error: function (error) {
                    reject(error)
                }
            };
            if (params instanceof FormData) {
                requestObject.processData = requestObject.contentType = false;
                delete requestObject.dataType;
            }
            // console.log( requestObject );
            jQuery.ajax(requestObject);
        });
    } else {
        return new Promise((resolve, reject) => {
            jQuery.ajax({
                url: url,
                method: method,
                data: params,
                dataType: 'json',
                success: function (response) {
                    resolve(response)
                },
                error: function (error) {
                    reject(error)
                }
            })
        });
    }
}

function addUserAjaxCall(url, method, params, loader = true) {
    if (loader) {
        return new Promise((resolve, reject) => {
            jQuery(document).find(".ajax-response").html('');
            jQuery.ajax({
                url: url,
                method: method,
                data: params,
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function () {
                    jQuery(".loader").fadeIn("slow");
                    jQuery(".show-loader").show();
                    jQuery(".submit").attr("disabled", true);
                    // jQuery("body").addClass("loading");
                    // jQuery(".loader").addClass("loading");
                },
                complete: function (resp, status) {
                    // jQuery("body").removeClass("loading");
                    jQuery(".loader").fadeOut("slow");
                    jQuery(".show-loader").hide();
                    jQuery(".submit").attr("disabled", false);
                },
                success: function (data) {
                    if (data.success == true) {
                        if (data.url) {
                            window.location.replace(data.url);
                        }
                    } else if (data.success == false) {
                        if ('errortype' in data && data.errortype) {
                            var response_ajax = jQuery(document).find(".ajax-response-" + data.errortype);
                        } else {
                            var response_ajax = jQuery(document).find(".ajax-response");
                            $("html, body").animate({ scrollTop: 0 }, "fast");
                        }
                        response_ajax.html('<div class="alert alert-danger alert-dismissible fade show k" role="alert">' + data.msg + '<button type="button" class="btn-close close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }
                },
                error: function (error) {
                    console.log(error);
                }
            })
        });
    } else {
        return new Promise((resolve, reject) => {
            jQuery.ajax({
                url: url,
                method: method,
                data: params,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    resolve(response)
                },
                error: function (error) {
                    reject(error)
                }
            })
        });
    }
}

function toggleStatus(element, model, id, field = null, message = null) {
    jQuery(element).attr('disabled', true)
    var url = jQuery(element).attr("url");
    let params = { 'id': id, 'model': model, 'field': field, 'message': message };
    console.log(url, "status");
    let response = ajaxCall(url, 'get', params);
    response.then(function (result) {
        toastr.options.closeButton = true;
        toastr.options.closeMethod = 'fadeOut';
        toastr.options.closeDuration = 10;
        jQuery(element).attr('disabled', false)

        if (result.status == 'success') {
            return toastr.success(result.message);
        }
        else {
            return toastr.error(result.message);
        }
    }).catch(function (error) {
        jQuery(element).attr('disabled', false)

        return toastr.error(error.responseJSON.message);
    })
}

function showMessage(message = null) {
    toastr.options.closeButton = true;
    toastr.options.closeMethod = 'fadeOut';
    toastr.options.closeDuration = 10;
    return toastr.success(message);
}

/* 
    Show other Modal
    Close current modal
    Open Modal
*/
function showOtherModal(otherModal = null) {
    let currentOpenModal = $(".modal.show"),
        myModalEl = $("#" + currentOpenModal.attr("id")).get(0),
        currentOpenModalInstance = bootstrap.Modal.getInstance(myModalEl);
    if (otherModal && currentOpenModalInstance) {
        currentOpenModal.on('hidden.bs.modal', function () {
            let myModalEl = $("#" + otherModal).get(0),
                modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
            modal.show();
            $(currentOpenModal).off('hidden.bs.modal');
        });
        currentOpenModalInstance.hide();
    }
    else if (currentOpenModalInstance) {
        currentOpenModalInstance.hide();
    }
    else if (otherModal) {
        let myModalEl = $("#" + otherModal).get(0),
            modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
        modal.show();
    }
}