<?php

function blf_bluesnapForm( $atts ) {

    $val = get_option('bs_forms');

    $shortcodeValues = shortcode_atts( array(
        'idform'    => '-1',
        'amount'    => '',
        'currency'  => 'USD',
    ), $atts );

    $meta  = new BLF_Admin();

    $blsForm = get_post($shortcodeValues['idform'],ARRAY_A);
    if ( is_null($blsForm) ){
        return "Form not exist!";
    }elseif ($blsForm['post_type'] != $meta::$post_type){
        return "Form not exist!";
    }

    $blsPrice       = ($shortcodeValues['amount'] != '') ? $shortcodeValues['amount'] : get_post_meta( $shortcodeValues['idform'], 'price', true );
    $blsPriceEdit   = get_post_meta( $shortcodeValues['idform'], 'user-can-price', true );

//    $shortcodeValues['price'] = 50;
    if ($blsPrice== '' && $blsPriceEdit == false)
        return "Form must have amount";

    if ($val['mode']){

        $url = BLF_SANDBOX_BLUESNAPDOMAINPATH;
        $authorization = base64_encode($val['user_test'].":".blf_decode($val['pass_test'],BLF_KEY_ENCODE));

    }else{

        $url = BLF_PRODUCTION_BLUESNAPDOMAINPATH;
        $authorization = base64_encode($val['user_live'].":".blf_decode($val['pass_live'],BLF_KEY_ENCODE));

    }

    $urlPaymantFieldsTokens = '/services/2/payment-fields-tokens';

    $args = [
        'timeout'     => 3,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking'    => true,
        'headers'     => [
            'Content-Type' => 'application/json',
            'Accept'=>'application/json',
            'Authorization'=>'Basic '.$authorization
        ],
        'body'        => [],
        'cookies'     => array()
    ];
//    $u = "https://sandbox.bluesnap.com/services/2/payment-fields-tokens/c73097c12c6735879f09077d7691ecc180d8b82383ca4012396644ec29996ebe_";

    $response = wp_remote_post( $url.$urlPaymantFieldsTokens, $args );
//    var_dump($response);


    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        return "Oops, something went wrong: $error_message";
    } else {
        $response_headers = wp_remote_retrieve_headers( $response );
        $u = $response_headers->offsetGet('location');
    }

//    echo $u.'<br>';


    $blsCurrencyAll = $meta->getCurrencyCodes();

    $blsCurrency = ($blsCurrencyAll[$shortcodeValues['currency']])? $shortcodeValues['currency'] : 'USD';

    $thumb_id = get_post_thumbnail_id($shortcodeValues['idform']);
    $companyName = get_post_meta( $shortcodeValues['idform'], 'company-name', true );

    $errorMessage = get_post_meta( $shortcodeValues['idform'], 'error-text', true );
    $errorMessage = ($errorMessage)? $errorMessage : BLF_ERROR_MESSAGE;

    $errorValidateMessage = get_post_meta( $shortcodeValues['idform'], 'error-text-validation', true );
    $errorValidateMessage = ($errorValidateMessage)? $errorValidateMessage : BLF_VALIDATE_ERROR_MESSAGE;

    $bt = get_post_meta( $shortcodeValues['idform'], 'button-text', true );
    $buttonText = ($bt)? $bt : BLF_PAYMENT_FORM_BUTTON_TEXT;
    unset($bt);
    $bt = get_post_meta( $shortcodeValues['idform'], 'checkout-text', true );
    $buttonCheckout = ($bt)? $bt : BLF_SUBMIT_PAYMENT_BUTTON_TEXT;

    $imgHtml = "";
    if ($thumb_id!=0){
        $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
        $imgHtml = '<img src="'.$thumb_url[0].'" class="rounded mx-auto d-block" alt="'.$companyName.'">';
    }

    $nonceBlsForm = wp_create_nonce('blsform-nonce');

    $deviceDataCheck = hash('md5', time());
    $time = time();
    $htmlBlsForm = '
<iframe width="1" height="1" frameborder="0" scrolling="no" src="https://www.bluesnap.com/servlet/logo.htm?s='.$deviceDataCheck.'">
     <img width="1" height="1" src="https://www.bluesnap.com/servlet/logo.gif?s='.$deviceDataCheck.'">
</iframe>
<button class="btn btn-info btn-lg" type="button" id="getBlsForm" data-toggle="modal" data-target="#blsModal-'.$shortcodeValues['idform'].'-'.$time.'">'.$buttonText.'</button>
<div id="blsModal-'.$shortcodeValues['idform'].'-'.$time.'" class="modal fade popup-pay">
<div class="vertical-align-helper">
    <div class="modal-dialog vertical-align-center">
    <div class="modal-content panel">
        <div class="panel-heading">';
    $htmlBlsForm .= ($companyName)?'<h3 class="panel-title">'.$companyName.'</h3>':'';
    $htmlBlsForm .=
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            '.$imgHtml.'
            
        </div>
        <form class="panel-body" id="bls-checkout-form" onsubmit="return false;" >
        <div class="row" id="user-info">';
    $bsLabels   = $meta::$bsFormLabels;
    $bsId       = $meta::$bsBluesnapId;
    $bsTypes    = $meta::$bsTypes;
    foreach ($meta::$bsFields as $key => $value){

        if ($value == 'optional'){
            //output
            $value = get_post_meta( $shortcodeValues['idform'], $key.'-output', true );
            switch ($value) {
                case 1:
                    $visible    = false;
                    $required   = false;
                    break;
                case 2:
                    $visible    = true;
                    $required   = false;
                    break;
                case 3:
                    $visible    = true;
                    $required   = true;
                    break;
                default:
                    $visible    = false;
                    $required   = false;
            }
        } else {
            $visible        = true;
            $required       = true;
        }

        $translate      = get_post_meta( $shortcodeValues['idform'], $key.'-t', true );
        $label          = ($translate) ? get_post_meta( $shortcodeValues['idform'], $key.'-translation', true ) : $bsLabels[$key];

        $label          = ($required) ? $label.' *' : $label;

        if ($visible){

//            $rText  = ($required)? 'required' : '';
            $rText  = '';
            $rClass = ($required)? 'required-field' : '';

            if($value=='bluesnap'){

                if ($bsId[$key] == 'ccn') {
                    $htmlBlsForm .= '
                    <div class="form-group col-xs-9">
                        <label for="card-number">' . $label . '</label>
                        <div class="input-group bs-block-'.$bsId[$key].'" id="bs-block-'.$bsId[$key].'">
                            <div class="form-control card-number-block" id="card-number" data-bluesnap="ccn"></div>
                            <div id="card-logo" class="input-group-addon"><img src="'.BLF_ASSETS.'img/generic-card.png" height="20p" alt=""></div>
                        </div>
                        <span class="helper-text" id="ccn-help"></span>
                    </div>';
                } elseif ($bsId[$key] == 'exp') {
                    $htmlBlsExpLabel    = '
                            <div class="form-group col-7 expiration" id="bs-block-'.$bsId[$key].'">
                                <label for="'.$bsId[$key].'">'.$label.'</label>                       
                            </div>';
                    $htmlBlsExpDiv      = '
                            <div class="form-group col-7 expiration" id="bs-block-'.$bsId[$key].'">                        
                                <div class="form-control exp-block bs-block-'.$bsId[$key].'" id="'.$bsId[$key].'" data-bluesnap="'.$bsId[$key].'"></div>
                                <span class="helper-text" id="'.$bsId[$key].'-help"></span>
                            </div>
                    ';
                } elseif ($bsId[$key] == 'cvv') {
                    $htmlBlsCvvLabel    = '
                            <div class="bs-block-field form-group col-5" id="bs-block-'.$bsId[$key].'">
                                <label for="'.$bsId[$key].'">'.$label.'</label>                       
                            </div>';
                    $htmlBlsCvvDiv      = '
                            <div class="bs-block-field form-group col-5" id="bs-block-'.$bsId[$key].'">                        
                                <div class="form-control exp-block bs-block-'.$bsId[$key].'" id="'.$bsId[$key].'" data-bluesnap="'.$bsId[$key].'"></div>
                                <span class="helper-text" id="'.$bsId[$key].'-help"></span>
                            </div>
                    ';
                   $htmlBlsForm .= $htmlBlsExpLabel.$htmlBlsCvvLabel.$htmlBlsExpDiv.$htmlBlsCvvDiv;
                }


            } else {

                if ($bsTypes[$key] == 'text' || $bsTypes[$key] == 'email' || $bsTypes[$key] == 'number'){

                    $attrValue  = ($key == 'price')? 'value="'.$blsPrice.'"' : "";
//                    $attrValue .= ($blsPriceEdit)? "" : "readonly";
//                    $blsPriceEdit
                    if ($key == 'price' && $blsPriceEdit == false){
                        $htmlBlsForm .= '<input type="hidden" name="price" value="'.$blsPrice.'">';
                        continue;
                    }

                    if ($bsTypes[$key] == 'number'){
                        $bsTypes[$key] = 'text';
                        $rClass .= ' only-number ';
                    }
                    if ($key == 'price'){
                        $label  = str_replace("*","",$label);
                        $label .= "($blsCurrency) *";
                    }

                    $htmlBlsForm    .= '        
                    <div class="form-group col-md-12">
                        <label for="'.$key.'-name">'.$label.'</label>
                        <input type="'.$bsTypes[$key].'" maxlength="100" name="'.$key.'" class="form-control '.$rClass.'" id="'.$key.'-name" '.$rText.' '.$attrValue.'>
                        <span class="helper-text"></span>
                    </div>';
                }else {
                    if ($key == 'country'){
                        $options = $meta->getCountries();
                    } else {
                        $options = $meta::$bsStates;
                    }//hidden-xs-up
                    $htmlBlsForm    .= '
                    <div class="form-group col-md-12" id="'.$key.'-div">
                        <label for="'.$key.'-name">'.$label.'</label>
                        '.blf_getSelect($options,$key).'
                    </div>';
                }

            }

        }

    }

    $resArr = explode( '/', $u );
    blf_enqueueBls($url,$resArr[6],$val['3d']);
    if ($blsPriceEdit == false)
        $buttonText = $buttonCheckout.' '.$blsPrice.' ('.$blsCurrency.')';
    else
        $buttonText = $buttonCheckout;
    $htmlBlsForm .= '
            <div class="form-group col-xs-12 ">
                <div class="alert alert-danger hidden-xs-up" id="error-message">
                    '.$errorMessage.'
                </div>
            </div>
            <div class="form-group col-xs-12 ">
                <div class="alert alert-danger hidden-xs-up" id="error-validate-message">
                    '.$errorValidateMessage.'
                </div>
                <div class="alert alert-danger hidden-xs-up" id="error-3d-message">
                </div>
            </div>
            <button data-bluesnap="submitButton" class="btn btn-raised btn-next btn-info btn-lg col-md-4" type="submit" id="submit-button" >'.$buttonText.'</button>
            <input type="hidden" name="nonce" value="'.$nonceBlsForm.'">
            <input type="hidden" name="device" value="'.$deviceDataCheck.'">
            <input type="hidden" name="action" value="bls_form_action">
            <input type="hidden" name="token" value="'.$resArr[6].'">
            <input type="hidden" name="currency" value="'.$blsCurrency.'">
            <input type="hidden" name="idform" value="'.$shortcodeValues['idform'].'">
            
            <div class="transition-loader col-sm-12 hidden-xs-up" id="bls-preloader">
                <div class="transition-loader-inner">
                    <label></label>
                    <label></label>
                    <label></label>
                </div>
            </div>
            
            </div>
    
        </form>
        
    </div>
    </div>
</div>
</div>';
    /**
     * end
     */
    return $htmlBlsForm;
}
add_shortcode('bluesnapForm', 'blf_bluesnapForm');

add_action('wp_ajax_bls_form_action', 'blf_FormAction');
add_action('wp_ajax_nopriv_bls_form_action', 'blf_FormAction');

/**
 * @return false|mixed|string
 */

function blf_FormAction() {
    check_ajax_referer( 'blsform-nonce', 'nonce' );

    $val = get_option('bs_forms');

    if ($val['mode']){

        $url = BLF_SANDBOX_BLUESNAPDOMAINPATH;
        $authorization = base64_encode($val['user_test'].":".blf_decode($val['pass_test'],BLF_KEY_ENCODE));

    }else{

        $url = BLF_PRODUCTION_BLUESNAPDOMAINPATH;
        $authorization = base64_encode($val['user_live'].":".blf_decode($val['pass_live'],BLF_KEY_ENCODE));

    }

    $names = blf_getFirstLastName(sanitize_text_field($_POST['name']));

    $keyAnswer  = "fail";
    $urlAnswer  = '';
    $response   = '';
    $args       = [];

    if ($names == true || sanitize_text_field($_POST['zip']) != ''){
        $holderInfo = [
            'firstName' => $names['first'],
            'lastName'  => $names['last'],
            'zip'       => sanitize_text_field($_POST['zip']),
        ];
//
        if (isset($_POST['email']))
            $holderInfo['email'] = sanitize_email($_POST['email']);
        if (isset($_POST['number']))
            $holderInfo['personalIdentifcationNumber'] = sanitize_text_field($_POST['number']);
        if (isset($_POST['country']))
            $holderInfo['country'] = sanitize_text_field($_POST['country']);
        if (isset($_POST['state']))
            $holderInfo['state'] = sanitize_text_field($_POST['state']);
        if (isset($_POST['address']))
            $holderInfo['address'] = sanitize_text_field($_POST['address']);
        if (isset($_POST['phone']))
            $holderInfo['phone'] = sanitize_text_field($_POST['phone']);

        $body = [
            'pfToken'   => sanitize_text_field($_POST['token']),
            'amount'    => sanitize_text_field($_POST['price']),
            'currency'  => sanitize_text_field($_POST['currency']),
            'recurringTransaction'  => 'ECOMMERCE',
            'cardTransactionType'   => 'AUTH_CAPTURE',
            'cardHolderInfo'        => $holderInfo,
            'transactionFraudInfo'  => [
                'fraudSessionId' => sanitize_text_field($_POST['device'])
            ]

        ];

        $args = [
            'timeout'     => 30,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true,
            'headers'     => [
                'Content-Type'  => 'application/json',
                'Accept'        => 'application/json',
                'Authorization' => 'Basic '.$authorization
            ],
            'body'        => json_encode($body),
            'cookies'     => []
        ];

        $urlPaymentFieldsTokens = '/services/2/transactions';

        $response = wp_remote_post( $url.$urlPaymentFieldsTokens, $args );

        $keyAnswer = ($response['response']['code'] == '200') ? 'success' : "fail";


        $idForm = sanitize_text_field($_POST['idform']);
        $redirectPage = get_post_meta( $idForm, $keyAnswer.'-page', true );

        switch ($redirectPage) {
            case 1:
                $urlAnswer = get_permalink($val['pay_'.$keyAnswer.'_page']);
                break;
            case 2:
                $urlAnswer = get_permalink(get_post_meta( $idForm, 'specific-page-'.$keyAnswer, true ));
                break;
            case 3:
                $urlAnswer = get_post_meta( $idForm, 'redirect-url-'.$keyAnswer, true );
                break;
            default:
                $urlAnswer = get_permalink($val['pay_'.$keyAnswer.'_page']);
        }
    }

    if ($val['logs']){

        blf_saveLog($body,$response['body']);

    }

    echo(json_encode([
        'payment'   => $keyAnswer,
        'url'       => blf_addParametersToSuccessUrl($urlAnswer,$response['body'],sanitize_text_field($_POST['name'])),
        'name'      => ($names)? false : true,
        'args'      => $args,
        'body'      => $args['body'],
        'resp'      => $response
    ]));

    wp_die();
}

/**
 * @param $options
 * @param $keyField
 * @param string $code
 * @return string
 */
function blf_getSelect($options, $keyField, $code = 'us')
{
    $htmlSelect = '<select class="form-control" name="'.$keyField.'" id="'.$keyField.'-name">';

    foreach ($options as $key => $value){
        if (is_array($value)){
            if ($value['code'] == $code)
                $htmlSelect .= "<option value='$key'>{$value['title']}</option>";
        }else{
            $htmlSelect .= "<option value='$key'>$value</option>";
        }

    }
    $htmlSelect .= "</select>";

    return $htmlSelect;
}

add_action('wp_ajax_bls_get_states', 'blf_getStates');
add_action('wp_ajax_nopriv_bls_get_states', 'blf_getStates');

function blf_getStates()
{
    $blfObj  = new BLF_Admin();

    $options        = $blfObj::$bsStates;
    $htmlOptions    = "";

    foreach ($options as $key => $value){
        if (is_array($value)){
            if ($value['code'] == sanitize_text_field($_REQUEST['code']))
                $htmlOptions .= "<option value='$key'>{$value['title']}</option>";
        }else{
            $htmlOptions .= "<option value='$key'>$value</option>";
        }

    }

    $show = ($htmlOptions)? true : false;

    echo (json_encode(['show'=>$show,'options'=>$htmlOptions]));
    wp_die();
}

/**
 * @param $lognName
 * @return bool
 */
function blf_getFirstLastName($lognName)
{
    $items = explode(" ",$lognName);

    if (count($items) < 1) {
        return false;
    } else {
        $answer['first']    = $items[0];
        unset($items[0]);
        $answer['last']     = (count($items) >= 1) ? implode(" ",$items) : '.';
        return $answer;
    }

}

/**
 * @param $url
 * @param $token
 * @param $secure3D
 * @return bool
 */
function blf_enqueueBls($url, $token, $secure3D)
{
    if (!$url) return false;

    wp_enqueue_style( 'style_BLF_bootstrap4', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css' );
    wp_enqueue_style( 'style_BLF', BLF_ASSETS . 'css/style.css' );

    wp_enqueue_script('js_BLF_jquery', 'https://code.jquery.com/jquery-3.1.1.min.js','','',true);
    wp_enqueue_script('js_BLF_tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js','','',true);
    wp_enqueue_script('js_BLF_api_bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js','','',true);
    wp_enqueue_script('js_BLF_api', $url.'/source/web-sdk/bluesnap.js','','',true);
    wp_enqueue_script('js_BLF-script', BLF_ASSETS.'js/common.js','','',true);

    wp_localize_script('js_BLF-script', 'blsform',
        [
            'url'       => admin_url('admin-ajax.php'),
            'token'     => $token,
            'assets'    => BLF_ASSETS,
            'secure3D'  => $secure3D ? 1 : 0
        ]
    );
}

function blf_saveLog($args ,$response)
{
    $fileName = BLF_LOGS.'bls-log-'.date("Ymd").'.txt';
    if (file_exists($fileName)) {
        $fp = fopen($fileName, 'a');
    } else {
        $fp = fopen($fileName, 'w+');
    }
    $mytext = "\r\n************************* - ".date("Y-m-d H:i:s")."\r\n";
    if (isset($args)){
        unset($args['cardHolderInfo']);
        $mytext .= "Request:\r\n".json_encode($args)."\r\n";
    }
    if (isset($response)){
        $response = json_decode($response);
        unset($response->cardHolderInfo);
        $mytext .= "Response:\r\n".json_encode($response)."\r\n";
    }
    $mytext .= "*************************\r\n";
    fwrite($fp,$mytext);
    fclose($fp); //Закрытие файла
    $del = bls_cleanOldlog();

}

function bls_cleanOldlog()
{
    if ( count(scandir(BLF_LOGS)) > 13 ){
        $dirFiles = scandir(BLF_LOGS);
        return unlink(BLF_LOGS.$dirFiles[3]);
    }else
        return false;
}

//http://www.xyz-abc.kz/index.php?title=apocalypse.php

function blf_addParametersToSuccessUrl($url, $response, $name)
{
    $response = json_decode($response);
    $u = 'transactionId='.$response->transactionId."&amount=".$response->amount.'&cname='.$name ;
    return $url . ((count(explode('?', $url)) == 1) ? '?' . $u : '&' . $u);
}