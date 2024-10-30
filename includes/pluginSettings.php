<?php

add_action('admin_menu', 'blf_add_plugin_page');
function blf_add_plugin_page(){
    add_options_page( 'BlueSnap WordPress Plugin Settings', 'BlueSnap settings', 'manage_options', 'bls-forms', 'blf_options_page_output' );
}

function blf_options_page_output(){
    ?>
    <div class="wrap">
        <h2><?= get_admin_page_title() ?></h2>

        <form action="options.php" method="POST">
            <?php
            settings_fields( 'option_group' );     // скрытые защитные поля
            do_settings_sections( 'bls_page' ); // секции с настройками (опциями). У нас она всего одна 'section_id'
            submit_button();
            ?>
        </form>
        <a href="https://home.bluesnap.com/partners/" target="_blank">Documentation</a>
    </div>
    <?php
}

/**
 * Регистрируем настройки.
 * Настройки будут храниться в массиве, а не одна настройка = одна опция.
 */
add_action('admin_init', 'blf_plugin_settings');
function blf_plugin_settings(){

    register_setting( 'option_group', 'bs_forms', 'blf_sanitize_callback' );

    add_settings_section( 'section_id', '', '', 'bls_page' );
    add_settings_field('primer_field7', 'Mode', 'blf_bsFormsCallback_mode', 'bls_page', 'section_id' );
    add_settings_field('primer_field1', 'Test API Username', 'blf_bsFormsCallback_user_test', 'bls_page', 'section_id' );
    add_settings_field('primer_field2', 'Test API Password', 'blf_bsFormsCallback_pass_test', 'bls_page', 'section_id' );
    add_settings_field('primer_field3', 'Live API Username', 'blf_bsFormsCallback_user_live', 'bls_page', 'section_id' );
    add_settings_field('primer_field4', 'Live API Password', 'blf_bsFormsCallback_pass_live', 'bls_page', 'section_id' );
    add_settings_field('primer_field8', 'Enable payment logging', 'blf_bsFormsCallbackSaveLogs', 'bls_page', 'section_id' );
    add_settings_field('primer_field10', '3-D Secure', 'blf_bsFormsCallback3D', 'bls_page', 'section_id' );
    add_settings_field('primer_field9', 'Delete logs', 'blf_bsFormsCallbackSaveLogs1', 'bls_page', 'section_id' );

}

## Заполняем опцию 1
function blf_bsFormsCallback_user_test(){
    $val = get_option('bs_forms');
    $val = $val ? $val['user_test'] : null;
    ?>
    <input type="text" name="bs_forms[user_test]" value="<?= esc_attr( $val ) ?>" />
    <br><small>Should be the same as the API Settings->Username field in BlueSnap’s Sandbox merchant console</small>
    <?php
}

## Заполняем опцию 1
function blf_bsFormsCallback_pass_test(){
    $val = get_option('bs_forms');
    $val = $val ? $val['pass_test'] : null;
    ?>
    <input type="hidden" name="pass_test_prev" value="<?= esc_attr( $val ) ?>">
    <input class="pass-decode" type="password" name="bs_forms[pass_test]" value="" />
    <br><small>Should be the same as the API Settings->Password field in BlueSnap’s Sandbox merchant console</small>
    <?php
}


function blf_bsFormsCallback_user_live(){
    $val = get_option('bs_forms');
    $val = $val ? $val['user_live'] : null;
    ?>
    <input type="text" name="bs_forms[user_live]" value="<?= esc_attr( $val ) ?>" />
    <br><small>Should be the same as the API Settings->Username field in BlueSnap’s Production merchant console</small>
    <?php
}


function blf_bsFormsCallback_pass_live(){
    $val = get_option('bs_forms');
    $val = $val ? $val['pass_live'] : null;
    ?>
    <input type="hidden" name="pass_live_prev" value="<?= esc_attr( $val ) ?>">
    <input type="password" name="bs_forms[pass_live]" value="" />
    <br><small>Should be the same as the API Settings->Password field in BlueSnap’s Production merchant console</small>
    <?php
}


function blf_bsFormsCallback_pay_success_page(){
    $val = get_option('bs_forms');
    $val = $val ? $val['pay_success_page'] : null;
    echo bsFormsGetPagesInSelect($val,'pay_success_page');
    echo "<br><small>Select the page to display in case of a successful processing of a payment. You can override this setting for each Form</small>";
}

function blf_bsFormsCallback_pay_fail_page(){
    $val = get_option('bs_forms');
    $val = $val ? $val['pay_fail_page'] : null;
    echo bsFormsGetPagesInSelect($val,'pay_fail_page');
    echo "<br><small>Select the page to display in case the user cancels out of the payment page without making a purchase. You can override this setting for each Form</small>";
}

function blf_bsFormsCallback_mode(){
    $val = get_option('bs_forms');
    $val = $val ? $val['mode'] : 0;
    ?>
    <input type="radio" name="bs_forms[mode]" value="1" <?php if ($val) echo 'checked'?>>  Test
    <input type="radio" name="bs_forms[mode]" value="0" <?php if (!$val) echo 'checked'?>> Live
    <br><small>Controls whether you are transacting in the test or live environment at BlueSnap</small>
    <?php
}

function blf_bsFormsCallbackSaveLogs()
{
    $val = get_option('bs_forms');
    $val = $val ? $val['logs'] : 0;
    ?>
    <input type="radio" name="bs_forms[logs]" value="1" <?php if ($val) echo 'checked'?>>  Yes
    <input type="radio" name="bs_forms[logs]" value="0" <?php if (!$val) echo 'checked'?>> No
    <br><small>Enable or disable BlueSnap Plugin logging</small>
    <?php
}

function blf_bsFormsCallback3D()
{
    $val = get_option('bs_forms');
    $val = $val ? $val['3d'] : 0;
    ?>
    <input type="radio" name="bs_forms[3d]" value="1" <?php if ($val) echo 'checked'?>>  Yes
    <input type="radio" name="bs_forms[3d]" value="0" <?php if (!$val) echo 'checked'?>> No
    <br><small>Enable or disable 3-D Secure</small>
    <?php
}

function blf_bsFormsCallbackSaveLogs1()
{?>
    <button id="remove-logs" onclick="return false;">Delete</button>
    <script>
        jQuery(document).ready(function ($) {

            $('#remove-logs').click(function () {
                r = confirm("Are you sure delete logs?");
                if (r == true) {
                    $.ajax({
                        url: '/wp-admin/admin-ajax.php',
                        data: 'action=delete_logs',
                        dataType : 'json',
                        success: function(data) {
                            alert('All logs deleted!')
                        }
                    });
                }
            });

        });
    </script>
    <?php
}

/**
 * @param $pageId
 * @param $optionName
 * @return string
 */
function blf_bsFormsGetPagesInSelect($pageId, $optionName){
    $html = "<select name='bs_forms[$optionName]'>";
    wp_reset_query();
    $team = new WP_Query([
        'post_type' => 'page',
        'showposts' => -1,
    ]);
    if ($team->have_posts()) :
        while ($team->have_posts()) : $team->the_post();
            $pageCurrent = get_the_ID();
            if ($pageCurrent == $pageId) {
                $selectedText = 'selected';
            } else
                $selectedText = '';
            $html .= '<option value="' . get_the_ID() . '" ' . $selectedText . '>' . get_the_title() . '</option>';
        endwhile;
    endif;
    $html .= '</select>';
    wp_reset_query();
    return $html;
}

/**
 * @param $options
 * @return mixed
 */
function blf_sanitize_callback( $options ){

    foreach( $options as $name => & $val ){
        if( $name == 'pass_test' || $name == 'pass_live'){
            if (empty($val))
                $val = ($name == 'pass_test') ? sanitize_text_field($_REQUEST['pass_test_prev']) : sanitize_text_field($_REQUEST['pass_live_prev']);
            else
                $val = blf_encode( $val ,BLF_KEY_ENCODE);
            $v = $val;
        }

    }

    return $options;
}

/**
 * @param $unencoded
 * @param $key
 * @return string
 */
function blf_encode($unencoded,$key){//Шифруем
    $string=base64_encode($unencoded);//Переводим в base64

    $arr=array();//Это массив
    $x=0;
    while ($x++< strlen($string)) {//Цикл
        $arr[$x-1] = md5(md5($key.$string[$x-1]).$key);//Почти чистый md5
        $newstr = $newstr.$arr[$x-1][3].$arr[$x-1][6].$arr[$x-1][1].$arr[$x-1][2];//Склеиваем символы
    }
    return $newstr;//Вертаем строку
}

/**
 * @param $encoded
 * @param $key
 * @return bool|string
 */
function blf_decode($encoded, $key){
    $strofsym="qwertyuiopasdfghjklzxcvbnm1234567890QWERTYUIOPASDFGHJKLZXCVBNM=";
    $x=0;
    while ($x++<= strlen($strofsym)) {
        $tmp = md5(md5($key.$strofsym[$x-1]).$key);
        $encoded = str_replace($tmp[3].$tmp[6].$tmp[1].$tmp[2], $strofsym[$x-1], $encoded);
    }
    return base64_decode($encoded);
}

add_action('wp_ajax_delete_logs', 'blf_delLogs');

function blf_delLogs()
{
    if (is_admin()){
        $amount = count(scandir(BLF_LOGS));

        if ( $amount > 3 ){
            $dirFiles = scandir(BLF_LOGS);
            for ($i = 3; $i < $amount; $i++)
                unlink(BLF_LOGS.$dirFiles[$i]);
        }
    }

    wp_die();
}