/* Defining helper functions/objects */
// changeImpactedElement: function that removes the provided class(es) and adds the provided class(es) to Hosted Payment Fields element
function changeImpactedElement(tagId, removeClass, addClass) {
    removeClass = removeClass || "";
    addClass = addClass || "";
    $("[data-bluesnap=" + tagId + "]")
        .removeClass(removeClass)
        .addClass(addClass);
}
// getErrorText: function that takes error code (received from BlueSnap) and gets associated help text
function getErrorText(errorCode) {
    switch (errorCode) {
        case "001":
            return "Please enter a valid card number";
        case "002":
            return "Please enter the CVV/CVC of your card";
        case "003":
            return "Please enter your cards expiration date";
        case "22013":
            return "Card type is not supported by merchant";
        case "400":
            return "Session expired please refresh page to continue";
        case "403":
        case "404":
        case "500":
            return "Internal server error please try again later";
        default:
            break;
    }
}

var imgUrl = blsform.assets + "img/";
// cardUrl: object that stores card type code (received from BlueSnap) and associated card image URL
var cardUrl = {
    "AmericanExpress"   : imgUrl + "AmericanExpress.png",
    "CarteBleau"        : imgUrl + "CarteBleau.png",
    "DinersClub"        : imgUrl + "DinersClub.png",
    "Discover"          : imgUrl + "Discover.png",
    "JCB"               : imgUrl + "JCB.png",
    "MaestroUK"         : imgUrl + "Maestro.png",
    "MasterCard"        : imgUrl + "Mastercard.png",
    "Solo"              : imgUrl + "solo.png",
    "Visa"              : imgUrl + "Visa.png"
};

/* Defining bsObj: object that stores Hosted Payment Fields
event handlers, styling, placeholder text, etc. */
var bsObj = {
    '3DS': blsform.secure3D == 1 ? true : false,
    onFieldEventHandler: {

        onFocus: function(tagId) {
            // Handle focus
            changeImpactedElement(tagId, "", "hosted-field-focus");
        },
        onBlur: function(tagId) {
            // Handle blur
            changeImpactedElement(tagId, "hosted-field-focus");
            console.log($("#" + tagId + "-help").val());
        },
        onError: function(tagId, errorCode) {
            console.log(tagId);
            console.log(getErrorText(errorCode));
            // Handle a change in validation by displaying help text

            //bs-block-
            $("#" + tagId + "-help").text(getErrorText(errorCode));
            $(".bs-block-" + tagId + "").addClass('validate-error');
            $("#card-logo > img").attr("src", imgUrl + 'generic-card.png');
            switch (errorCode) {
                case '14100':
                    $('#error-message').removeClass('hidden-xs-up');
                    $('#error-3d-message').text('Enable 3-D Secure');
                    break;
                case '14101':
                    $('#error-message').removeClass('hidden-xs-up');
                    $('#error-3d-message').text('Inform the shopper to try a different payment method');
                    break;
                case '14102':
                    $('#error-message').removeClass('hidden-xs-up');
                    $('#error-3d-message').text('Make sure 3-D Secure object has both transaction amount and currency');
                    break;
                case '14103':
                    $('#error-message').removeClass('hidden-xs-up');
                    $('#error-3d-message').text('Continue without 3DS');
                    break;
            }
            jQuery('#bls-preloader').addClass('hidden-xs-up');
            $('#submit-button').removeClass('pressButton');
            $('#submit-button').removeAttr('disabled');
        },
        onType: function(tagId, cardType) {
            // get card type from cardType and display card image
            $("#card-logo > img").attr("src", cardUrl[cardType]);
        },
        onValid: function(tagId) {
            // Handle a change in validation by removing any help text
            console.log(tagId);
            $("#" + tagId + "-help").text("");
            $("#bs-block-" + tagId + "").removeClass('validate-error');
            $(".bs-block-" + tagId + "").removeClass('validate-error');
            // console.log(document.getElementById(tagId).value);
        },
    },
    style: {
        // Styling all inputs
        "input": {
            "font-size": "14px",
            "font-family":
                "RobotoDraft,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif",
            "line-height": "1.42857143",
            "color": "#555"
        },
        // Styling input state
        ":focus": {
            "color": "#555"
        }
    },

    ccnPlaceHolder: "",
    cvvPlaceHolder: "",
    expPlaceHolder: "",
    expDropDownSelector: false //set to true for exp date dropdown
};
$ = jQuery;
/* After DOM is loaded, calling bluesnap.hostedPaymentFieldsCreation: function that takes token and bsObj as inputs and initiates Hosted Payment Fields */
$(document).ready(function() {

    bluesnap.hostedPaymentFieldsCreation(
        blsform.token,
        bsObj
    ); //insert your Hosted Payment Fields token

    jQuery('#show-user-info').click(function () {
        jQuery('#card-info').hide();
        jQuery('#user-info').show();
    });

    jQuery( ".required-field" ).blur(function() {
        if (jQuery(this).val()){
            jQuery(this).removeClass('validate-error');
            // $('#error-validate-message').addClass('hidden-xs-up');
        }else{
            jQuery(this).addClass('validate-error');
            isError = true;
            // $('#error-validate-message').removeClass('hidden-xs-up');
        }

        if ($('#email-name').length && jQuery('#email-name').val()) {
            console.log(1);
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i
            item =jQuery('#email-name');

            if(pattern.test(item.val())){
                item.removeClass('validate-error');
            }
            else{
                item.addClass('validate-error');
                isError = true;
            }
        }

    });

    jQuery('#submit-button').click(function () {

        jQuery('#error-validate-message').addClass('hidden-xs-up');
        jQuery('#error-message').addClass('hidden-xs-up');
        var isError = false;
        jQuery( ".required-field" ).each(function() {
            if (jQuery(this).val()){
                jQuery(this).removeClass('validate-error');
                // $('#error-validate-message').hide();
            }else{
                jQuery(this).addClass('validate-error');
                isError = true;
                // $('#error-validate-message').show();
            }

        });

        if ($('#email-name').length && jQuery('#email-name').val()) {
            var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i
                item =jQuery('#email-name');

            if(pattern.test(item.val())){
                item.removeClass('validate-error');
            }
            else{
                item.addClass('validate-error');
                isError = true;
            }
        }

        console.log(isError);

        if (!isError) {
            jQuery('#bls-preloader').removeClass('hidden-xs-up');
            $('#submit-button').addClass('pressButton');
            $('#submit-button').attr('disabled','disabled');
            jQuery('#error-validate-message').addClass('hidden-xs-up');
            jQuery('#error-3d-message').addClass('hidden-xs-up');

            var threeDSecureObj = {
                amount: parseFloat($("input[name=price]").val()),
                currency: $("input[name=currency]").val()
            };
            console.log(threeDSecureObj);
            console.log(blsform.secure3D);

            if (blsform.secure3D == 1){
                bluesnap.submitCredentials(function(callback) {
                    console.log(callback);

                    if (null != callback.threeDSecure ) {

                        if (callback.threeDSecure.authResult == "AUTHENTICATION_SUCCEEDED" ||
                            callback.threeDSecure.authResult == "AUTHENTICATION_UNAVAILABLE" ){
                            jQuery.ajax({
                                url: blsform.url,
                                method: 'post',
                                data: jQuery('#bls-checkout-form').serialize(),
                                dataType : 'json',
                                success: function (data) {
                                    console.log(data);
                                    if (data.payment == 'fail'){
                                        jQuery('#error-message').removeClass('hidden-xs-up');
                                        if (data.name) {
                                            $('#name-name').addClass('validate-error');
                                        }
                                    } else {
                                        document.location.href = data.url;
                                    }
                                },
                                complete: function (data) {
                                    jQuery('#bls-preloader').addClass('hidden-xs-up');
                                    $('#submit-button').removeClass('pressButton');
                                    $('#submit-button').removeAttr('disabled');
                                }
                            });
                        }else{
                            $('#error-3d-message').removeClass('hidden-xs-up');
                            $('#error-3d-message').text(callback.threeDSecure.authResult);
                        }

                        // submit form to server & process transaction
                    } else {
                        console.log('karamba');
                        jQuery('#bls-preloader').addClass('hidden-xs-up');
                        $('#submit-button').removeClass('pressButton');
                        $('#submit-button').removeAttr('disabled');
                    }

                }, threeDSecureObj);
            } else {
                bluesnap.submitCredentials(function(callback) {
                    console.log(callback);
                    jQuery.ajax({
                        url: blsform.url,
                        method: 'post',
                        data: jQuery('#bls-checkout-form').serialize(),
                        dataType : 'json',
                        success: function (data) {
                            console.log(data);
                            console.log(data.resp.response.message);
                            if (data.payment == 'fail'){
                                jQuery('#error-message').removeClass('hidden-xs-up');
                                if (data.name) {
                                    $('#name-name').addClass('validate-error');
                                }
                            } else {
                                document.location.href = data.url;
                            }
                        },
                        complete: function (data) {
                            jQuery('#bls-preloader').addClass('hidden-xs-up');
                            $('#submit-button').removeClass('pressButton');
                            $('#submit-button').removeAttr('disabled');
                        }
                    });
                });
            }

        }else{
            jQuery('#error-validate-message').removeClass('hidden-xs-up');
        }

    });

    $('#state-div').hide();

    $('#country-name').change(function () {
        code = $(this).val();
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            data: 'action=bls_get_states&code=' + code  ,
            dataType : 'json',
            success: function(data) {
                if (data.show){
                    $('#state-div').show();
                    $('#state-name').html(data.options);
                }else {
                    $('#state-div').hide();
                }
            }
        });
    });

    // $('.only-number').bind("change keyup input click", function() {
    //     if (this.value.match(/[^0-9]/g)) {
    //         this.value = this.value.replace(/[^0-9]/g, '');
    //     }
    // });

    $('.only-number').on("keypress", function (e) {
        return (e.which !== 8 && e.which !== 0 && (e.which !== 46 || $(this).val().indexOf(".") !== -1) && (e.which < 48 || e.which > 57)) ? false : true;
    });
    
});

$(document).on('click', '.vertical-align-helper', function (e) {
    if ($(e.target).is('.modal-dialog')) {
        $('.modal.show').modal('hide');
    }

});