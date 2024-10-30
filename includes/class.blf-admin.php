<?php

class BLF_Admin
{
    /**
     * @var string
     */
    static $post_type   = 'bls-forms';

    /**
     * @var string
     */
    static $meta_key    = 'fields';

    /**
     * @var array
     */
    static $bsKeys      = [
        'currency',
        'user-can-price',
        'success-page',
        'button-text',
        'checkout-text',
        'company-name',
        'error-text',
        'error-text-validation',
    ];

    /**
     * @var array
     */
    static $bsFields   = [
        'email'             => 'optional',
        'number'            => 'optional',
        'phone'             => 'optional',
        'country'           => 'optional',
        'address'           => 'optional',
        'state'             => 'optional',
        'zip'               => 'optional',
        'name'              => 'required',
        'card-number'       => 'bluesnap',
        'expiration-date'   => 'bluesnap',
        'security-code'     => 'bluesnap',
        'price'             => 'required'
    ];

    static $bsBluesnapId = [
        'card-number'       => 'ccn',
        'expiration-date'   => 'exp',
        'security-code'     => 'cvv',
    ];

    /**
     * @var array
     */
    static $bsTypes     = [
        'price'                 => 'number',
        'name'                  => 'text',
        'number'                => 'number',
        'email'                 => 'email',
        'country'               => 'select',
        'address'               => 'text',
        'state'                 => 'select',
        'zip'                   => 'text',
        'phone'                 => 'number',
        'success-page'          => 'select',
        'fail-page'             => 'radio',
        'button-text'           => 'text',
        'checkout-text'         => 'text',
        'company-name'          => 'text',
        'error-text'            => 'text',
        'error-text-validation' => 'text',
        'specific-page-success' => 'none',
        'specific-page-fail'    => 'none',
        'currency'              => 'select',
        'user-can-price'        => 'checkbox',
        'redirect-url-success'  => 'none',
        'redirect-url-fail'     => 'none',
    ];

    static $bsDefaultValues = [
        'button-text'           => BLF_PAYMENT_FORM_BUTTON_TEXT,
        'checkout-text'         => BLF_SUBMIT_PAYMENT_BUTTON_TEXT,
        'error-text'            => BLF_ERROR_MESSAGE,
        'error-text-validation' => BLF_VALIDATE_ERROR_MESSAGE,
    ];

    /**
     * @var array
     */
    static $bsLabels    = [
        'price'                 => 'Amount',
        'phone'                 => 'Phone',
        'number'                => 'Personal Identifcation Number',
        'success-page'          => 'Payment Success Page',
        'fail-page'             => 'Payment Failure Page',
        'specific-page'         => 'Specific Page',
        'redirect-url'          => 'Redirect URL',
        'button-text'           => 'Payment Form Button',
        'checkout-text'         => 'Submit Payment Button',
        'company-name'          => 'Payment Form Title',
        'language'              => 'Checkout Locale',
        'currency'              => 'Currency',
        'error-text'            => 'Payment Processing Error',
        'error-text-validation' => 'Required Field Error',
        'email'                 => 'Email',
        'country'               => 'Country',
        'address'               => 'Address',
        'state'                 => 'State',
        'zip'                   => 'Zip/Postal Сode',
        'user-can-price'        => 'User Can Enter Amount',
        'name'                  => 'Name',
        'card-number'           => 'Card Number',
        'expiration-date'       => 'Expiration Date',
        'security-code'         => 'Security Code',
    ];

    /**
     * @var array
     */
    static $bsFormLabels = [
        'name'              => 'Name',
        'email'             => 'Email',
        'number'            => 'Personal Identifcation Number',
        'price'             => 'Amount',
        'country'           => 'Country',
        'phone'             => 'Phone',
        'address'           => 'Address',
        'state'             => 'State',
        'zip'               => 'Zip/Postal code',
        'card-number'       => 'Card Number',
        'expiration-date'   => 'Expiration date (MM / YY)',
        'security-code'     => 'Security Code',
    ];

    /**
     * @var array
     */
    static $bsLanguage = [
        'en' => 'English (en) (default)',
        'zh' => 'Simplified Chinese (zh',
        'da' => 'Danish (da)',
        'nl' => 'Dutch (nl)',
        'fi' => 'Finnish (fi)',
        'fr' => 'French (fr)',
        'de' => 'German (de)',
        'it' => 'Italian (it)',
        'ja' => 'Japanese (ja)',
        'no' => 'Norwegian (no)',
        'es' => 'Spanish (es)',
        'sv' => 'Swedish (sv)',

    ];

    /**
     * @var array
     */
    static $bsCountries = [
        'ad' => 'Andorra',
        'ae' => 'United Arab Emirates',
        'ag' => 'Antigua and Barbuda',
        'ai' => 'Anguilla',
        'al' => 'Albania',
        'am' => 'Armenia',
        'an' => 'Netherlands Antilles',
        'ao' => 'Angola',
        'aq' => 'Antarctica',
        'ar' => 'Argentina',
        'as' => 'American Samoa',
        'at' => 'Austria',
        'au' => 'Australia',
        'aw' => 'Aruba',
        'az' => 'Azerbaijan',
        'ba' => 'Bosnia-Herzegovina',
        'bb' => 'Barbados',
        'bd' => 'Bangladesh',
        'be' => 'Belgium',
        'bf' => 'Burkina Faso',
        'bg' => 'Bulgaria',
        'bh' => 'Bahrain',
        'bi' => 'Burundi',
        'bj' => 'Benin',
        'bm' => 'Bermuda',
        'bn' => 'Brunei Darussalam',
        'bo' => 'Bolivia',
        'br' => 'Brazil',
        'bs' => 'Bahamas',
        'bt' => 'Bhutan',
        'bv' => 'Bouvet Island',
        'bw' => 'Botswana',
        'by' => 'Belarus',
        'bz' => 'Belize',
        'ca' => 'Canada',
        'cc' => 'Cocos (Keeling) Islands',
        'cd' => 'Congo (Brazzaville)',
        'cf' => 'Central African Republic',
        'cg' => 'Congo',
        'ch' => 'Switzerland',
        'ci' => 'Ivory Coast (Cote D\'Ivoire)',
        'ck' => 'Cook Islands',
        'cl' => 'Chile',
        'cm' => 'Cameroon',
        'cn' => 'China',
        'co' => 'Colombia',
        'cr' => 'Costa Rica',
        'cv' => 'Cape Verde',
        'cx' => 'Christmas Island',
        'cy' => 'Cyprus',
        'cz' => 'Czech Republic',
        'de' => 'Germany',
        'dj' => 'Djibouti',
        'dk' => 'Denmark',
        'dm' => 'Dominica',
        'do' => 'Dominican Republic',
        'dz' => 'Algeria',
        'ec' => 'Ecuador',
        'ee' => 'Estonia',
        'eg' => 'Egypt',
        'eh' => 'Western Sahara',
        'er' => 'Eritrea',
        'es' => 'Spain',
        'et' => 'Ethiopia',
        'fi' => 'Finland',
        'fj' => 'Fiji',
        'fk' => 'Falkland Islands',
        'fm' => 'Micronesia',
        'fo' => 'Faroe Islands',
        'fr' => 'France',
        'fx' => 'France (European Territory)',
        'ga' => 'Gabon',
        'gb' => 'Great Britain',
        'gd' => 'Grenada',
        'ge' => 'Georgia',
        'gf' => 'French Guiana',
        'gg' => 'Guernsey',
        'gi' => 'Gibraltar',
        'gl' => 'Greenland',
        'gm' => 'Gambia',
        'gn' => 'Guinea',
        'gp' => 'Guadeloupe (French)',
        'gq' => 'Equatorial Guinea',
        'gr' => 'Greece',
        'gs' => 'S. Georgia & S. Sandwich Isls.',
        'gt' => 'Guatemala',
        'gu' => 'Guam (USA)',
        'gw' => 'Guinea Bissau',
        'gy' => 'Guyana',
        'hk' => 'Hong Kong',
        'hm' => 'Heard and McDonald Islands',
        'hn' => 'Honduras',
        'hr' => 'Croatia',
        'ht' => 'Haiti',
        'hu' => 'Hungary',
        'id' => 'Indonesia',
        'ie' => 'Ireland',
        'il' => 'Israel',
        'im' => 'Isle of Man',
        'in' => 'India',
        'io' => 'British Indian Ocean Territory',
        'is' => 'Iceland',
        'it' => 'Italy',
        'je' => 'Jersey',
        'jm' => 'Jamaica',
        'jo' => 'Jordan',
        'jp' => 'Japan',
        'ke' => 'Kenya',
        'kg' => 'Kyrgyz Republic (Kyrgyzstan)',
        'kh' => 'Cambodia',
        'ki' => 'Kiribati',
        'km' => 'Comoros',
        'kn' => 'Saint Kitts & Nevis Anguilla',
        'kr' => 'South Korea',
        'kw' => 'Kuwait',
        'ky' => 'Cayman Islands',
        'kz' => 'Kazakhstan',
        'la' => 'Laos',
        'lc' => 'Saint Lucia',
        'li' => 'Liechtenstein',
        'lk' => 'Sri Lanka',
        'lr' => 'Liberia',
        'ls' => 'Lesotho',
        'lt' => 'Lithuania',
        'lu' => 'Luxembourg',
        'lv' => 'Latvia',
        'ma' => 'Morocco',
        'mc' => 'Monaco',
        'md' => 'Moldova',
        'me' => 'Montenegro',
        'mf' => 'Saint Martin',
        'mg' => 'Madagascar',
        'mh' => 'Marshall Islands',
        'mk' => 'Macedonia',
        'ml' => 'Mali',
        'mn' => 'Mongolia',
        'mo' => 'Macao',
        'mp' => 'Northern Mariana Islands',
        'mq' => 'Martinique (French)',
        'mr' => 'Mauritania',
        'ms' => 'Montserrat',
        'mt' => 'Malta',
        'mu' => 'Mauritius',
        'mv' => 'Maldives',
        'mw' => 'Malawi',
        'mx' => 'Mexico',
        'my' => 'Malaysia',
        'mz' => 'Mozambique',
        'na' => 'Namibia',
        'nc' => 'New Caledonia (French)',
        'ne' => 'Niger',
        'nf' => 'Norfolk Island',
        'ng' => 'Nigeria',
        'ni' => 'Nicaragua',
        'nl' => 'Netherlands',
        'no' => 'Norway',
        'np' => 'Nepal',
        'nr' => 'Nauru',
        'nt' => 'Neutral Zone',
        'nu' => 'Niue',
        'nz' => 'New Zealand',
        'om' => 'Oman',
        'pa' => 'Panama',
        'pe' => 'Peru',
        'pf' => 'Polynesia (French)',
        'pg' => 'Papua New Guinea',
        'ph' => 'Philippines',
        'pk' => 'Pakistan',
        'pl' => 'Poland',
        'pm' => 'Saint Pierre and Miquelon',
        'pn' => 'Pitcairn Island',
        'pr' => 'Puerto Rico',
        'pt' => 'Portugal',
        'pw' => 'Palau',
        'py' => 'Paraguay',
        'qa' => 'Qatar',
        're' => 'Reunion (French)',
        'ro' => 'Romania',
        'rs' => 'Serbia',
        'ru' => 'Russian Federation',
        'rw' => 'Rwanda',
        'sa' => 'Saudi Arabia',
        'sb' => 'Solomon Islands',
        'sc' => 'Seychelles',
        'se' => 'Sweden',
        'sg' => 'Singapore',
        'sh' => 'Saint Helena',
        'si' => 'Slovenia',
        'sj' => 'Svalbard and Jan Mayen Islands',
        'sk' => 'Slovak Republic',
        'sl' => 'Sierra Leone',
        'sm' => 'San Marino',
        'sn' => 'Senegal',
        'so' => 'Somalia',
        'st' => 'Saint Tome (Sao Tome) and Principe',
        'su' => 'Former USSR',
        'sv' => 'El Salvador',
        'sx' => 'Sint Maarten',
        'sz' => 'Swaziland',
        'tc' => 'Turks and Caicos Islands',
        'td' => 'Chad',
        'tf' => 'French Southern Territories',
        'tg' => 'Togo',
        'th' => 'Thailand',
        'tj' => 'Tadjikistan',
        'tk' => 'Tokelau',
        'tm' => 'Turkmenistan',
        'tn' => 'Tunisia',
        'to' => 'Tonga',
        'tp' => 'East Timor',
        'tr' => 'Turkey',
        'tt' => 'Trinidad and Tobago',
        'tv' => 'Tuvalu',
        'tw' => 'Taiwan',
        'tz' => 'Tanzania',
        'ua' => 'Ukraine',
        'ug' => 'Uganda',
        'uk' => 'United Kingdom',
        'us' => 'United States',
        'um' => 'USA Minor Outlying Islands',
        'uy' => 'Uruguay',
        'uz' => 'Uzbekistan',
        'va' => 'Holy See (Vatican City State)',
        'vc' => 'Saint Vincent & Grenadines',
        've' => 'Venezuela',
        'vg' => 'Virgin Islands (British)',
        'vi' => 'Virgin Islands (USA)',
        'vn' => 'Vietnam',
        'vu' => 'Vanuatu',
        'wf' => 'Wallis and Futuna Islands',
        'ws' => 'Samoa',
        'yt' => 'Mayotte',
        'za' => 'South Africa',
        'zm' => 'Zambia',
        'zw' => 'Zimbabwe',
    ];

    /**
     * @var array
     */
    static $bsStates = [
        'AA' => [
            'title' => 'Armed Forces Americas',
            'code'  => 'us'
        ],
        'AB' => [
            'title' => 'Alberta',
            'code'  => 'ca'
        ],
        'AE' => [
            'title' => 'Armed Forces (AE)',
            'code'  => 'us'
        ],
        'AL' => [
            'title' => 'Alabama',
            'code'  => 'us'
        ],
        'AP' => [
            'title' => 'Armed Forces Pacific',
            'code'  => 'us'
        ],
        'AR' => [
            'title' => 'Arkansas',
            'code'  => 'us'
        ],
        'AS' => [
            'title' => 'American Samoa',
            'code'  => 'us'
        ],
        'AZ' => [
            'title' => 'Arizona',
            'code'  => 'us'
        ],
        'BC' => [
            'title' => 'British Columbia',
            'code'  => 'ca'
        ],
        'CA' => [
            'title' => 'California',
            'code'  => 'us'
        ],
        'CO' => [
            'title' => 'Colorado',
            'code'  => 'us'
        ],
        'CT' => [
            'title' => 'Connecticut',
            'code'  => 'us'
        ],
        'DC' => [
            'title' => 'District Of Columbia',
            'code'  => 'us'
        ],
        'DE' => [
            'title' => 'Delaware',
            'code'  => 'us'
        ],
        'FL' => [
            'title' => 'Florida',
            'code'  => 'us'
        ],
        'GA' => [
            'title' => 'Georgia',
            'code'  => 'us'
        ],
        'GU' => [
            'title' => 'Guam',
            'code'  => 'us'
        ],
        'HI' => [
            'title' => 'usHawaii',
            'code'  => ''
        ],
        'IA' => [
            'title' => 'Iowa',
            'code'  => 'us'
        ],
        'ID' => [
            'title' => 'Idaho',
            'code'  => 'us'
        ],
        'IL' => [
            'title' => 'Illinois',
            'code'  => 'us'
        ],
        'IN' => [
            'title' => 'Indiana',
            'code'  => 'us'
        ],
        'KS' => [
            'title' => 'Kansas',
            'code'  => 'us'
        ],
        'KY' => [
            'title' => 'Kentucky',
            'code'  => 'us'
        ],
        'LA' => [
            'title' => 'Louisiana',
            'code'  => 'us'
        ],
        'ME' => [
            'title' => 'Maine',
            'code'  => 'us'
        ],
        'MB' => [
            'title' => 'Manitoba',
            'code'  => 'ca'
        ],
        'MD' => [
            'title' => 'Maryland',
            'code'  => 'us'
        ],
        'MI' => [
            'title' => 'Michigan',
            'code'  => 'us'
        ],
        'MA' => [
            'title' => 'Massachusetts',
            'code'  => 'us'
        ],
        'MN' => [
            'title' => 'Minnesota',
            'code'  => 'us'
        ],
        'MO' => [
            'title' => 'Missouri',
            'code'  => 'us'
        ],
        'MS' => [
            'title' => 'Mississippi',
            'code'  => 'us'
        ],
        'NB' => [
            'title' => 'New Brunswick',
            'code'  => 'ca'
        ],
        'NC' => [
            'title' => 'North Carolina',
            'code'  => 'us'
        ],
        'ND' => [
            'title' => 'North Dakota',
            'code'  => 'us'
        ],
        'NE' => [
            'title' => 'Nebraska',
            'code'  => 'us'
        ],
        'NH' => [
            'title' => 'New Hampshire',
            'code'  => 'us'
        ],
        'NJ' => [
            'title' => 'New Jersey',
            'code'  => 'us'
        ],
        'NL' => [
            'title' => 'Newfoundland and Labrador',
            'code'  => 'ca'
        ],
        'NM' => [
            'title' => 'New Mexico',
            'code'  => 'us'
        ],
        'NS' => [
            'title' => 'Nova Scotia',
            'code'  => 'ca'
        ],
        'NT' => [
            'title' => 'Northwest Territories',
            'code'  => 'ca'
        ],
        'NU' => [
            'title' => 'Nunavut',
            'code'  => 'ca'
        ],
        'NV' => [
            'title' => 'Nevada',
            'code'  => 'us'
        ],
        'NY' => [
            'title' => 'New York',
            'code'  => 'us'
        ],
        'OH' => [
            'title' => 'Ohio',
            'code'  => 'us'
        ],
        'OK' => [
            'title' => 'Oklahoma',
            'code'  => 'us'
        ],
        'ON' => [
            'title' => 'Ontario',
            'code'  => 'ca'
        ],
        'OR' => [
            'title' => 'Oregon',
            'code'  => 'us'
        ],
        'PA' => [
            'title' => 'Pennsylvania',
            'code'  => 'us'
        ],
        'PE' => [
            'title' => 'Prince Edward Island',
            'code'  => 'ca'
        ],
        'PR' => [
            'title' => 'Puerto Rico',
            'code'  => 'us'
        ],
        'QC' => [
            'title' => 'Quebec',
            'code'  => 'ca'
        ],
        'RI' => [
            'title' => 'Rhode Island',
            'code'  => 'us'
        ],
        'SC' => [
            'title' => 'South Carolina',
            'code'  => 'us'
        ],
        'SD' => [
            'title' => 'South Dakota',
            'code'  => 'us'
        ],
        'SK' => [
            'title' => 'Saskatchewan',
            'code'  => 'ca'
        ],
        'TN' => [
            'title' => 'Tennessee',
            'code'  => 'us'
        ],
        'TX' => [
            'title' => 'Texas',
            'code'  => 'us'
        ],
        'UT' => [
            'title' => 'Utah',
            'code'  => 'us'
        ],
        'VA' => [
            'title' => 'Virgina',
            'code'  => 'us'
        ],
        'VI' => [
            'title' => 'Virgin Islands',
            'code'  => 'us'
        ],
        'VT' => [
            'title' => 'Vermont',
            'code'  => 'us'
        ],
        'WA' => [
            'title' => 'Washington',
            'code'  => 'us'
        ],
        'WI' => [
            'title' => 'Wisconsin',
            'code'  => 'us'
        ],
        'WV' => [
            'title' => 'West Virginia',
            'code'  => 'us'
        ],
        'WY' => [
            'title' => 'Wyoming',
            'code'  => 'us'
        ],
        'YT' => [
            'title' => 'Yukon Territory',
            'code'  => 'ca'
        ],
    ];



    /**
     * metaboxesBlueSnapForms constructor.
     */
    public function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
        add_action( 'save_post_' . self::$post_type, array( $this, 'save_metabox' ) );
        add_action( 'admin_print_footer_scripts', array( $this, 'show_assets' ), 10, 999 );
    }

    ## Добавляет матабоксы
    public function add_metabox() {
        add_meta_box( 'bs_form_options', 'Form Options', array( $this, 'render_metabox' ), self::$post_type, 'advanced', 'high' );
    }

    ## Отображает метабокс на странице редактирования поста
    public function render_metabox( $post ) {

        ?>
        <table class="form-table company-info">

            <?php foreach (self::$bsKeys as $key):?>
                <tr>
                    <th>
                        <?=self::$bsLabels[$key];?>
                    </th>
                    <td class="company-address-list">
                        <?php
                        if (self::$bsTypes[$key] == 'text' || self::$bsTypes[$key] == 'number'){
                            $input = '
                            <span class="item-address">
                                <input type="text" name="'. self::$meta_key .'['.$key.']" value="%s">
                            </span>
                            ';

                            $value = get_post_meta( $post->ID, $key, true );
                            if (isset(self::$bsDefaultValues[$key])){
                                $value = ($value)? $value : self::$bsDefaultValues[$key];
                            }
                            printf( $input, esc_attr( $value ) );
//                            echo esc_html(sprintf($input, esc_attr($value)));
                        }
                        elseif (self::$bsTypes[$key] == 'radio'){
                            $keyPage    = 'specific-page-'.str_replace('-page','',$key);
                            $keyUrl     = 'redirect-url-'.str_replace('-page','',$key);
                            $value      = get_post_meta( $post->ID, $key, true );
                            $valuePage  = get_post_meta( $post->ID, $keyPage, true );
                            $valueUrl   = get_post_meta( $post->ID, $keyUrl, true );


                            $input      = '
                            
                                <input type="radio" id="'.$key.'1" name="'. self::$meta_key .'['.$key.']" value="1" %s><label for="'.$key.'1">Global Setting</label><br> 
                                <input type="radio" id="'.$key.'2" name="'. self::$meta_key .'['.$key.']" value="2" %s><label for="'.$key.'2">Specific Page</label><br>'.
                                self::getPagesInSelect($keyPage,$valuePage).'<br>
                                <input type="radio" id="'.$key.'3" name="'. self::$meta_key .'['.$key.']" value="3" %s><label for="'.$key.'3">Redirect URL</label><br>
                                <input type="text" name="'. self::$meta_key .'['.$keyUrl.']" value="%s">
                            ';
                            $text1 = $text2 = $text3 = "";
                            switch ($value) {
                                case 1:
                                    $text1 = "checked";
                                    break;
                                case 2:
                                    $text2 = "checked";
                                    break;
                                case 3:
                                    $text3 = "checked";
                                    break;
                                default:
                                    $text1 = "checked";
                            }

                            printf( $input, $text1,$text2,$text3,$valueUrl);
//                            echo esc_html(sprintf( $input, $text1,$text2,$text3,$valueUrl));
                        }elseif (self::$bsTypes[$key] == 'select'){
                            $value = get_post_meta( $post->ID, $key, true );
                            if ($key == 'language')
                                echo self::getSelect(self::$bsLanguage,$key,$value);
                            elseif ($key == 'currency')
                                echo self::getSelect(self::getCurrencyCodes(),$key,$value);
                            elseif ($key == 'success-page'){
                                $keyPage    = 'specific-page-'.str_replace('-page','',$key);
                                $keyUrl     = 'redirect-url-'.str_replace('-page','',$key);
                                $value      = get_post_meta( $post->ID, $key, true );
                                $valuePage  = get_post_meta( $post->ID, $keyPage, true );
                                $valueUrl   = get_post_meta( $post->ID, $keyUrl, true );
                                $text1 = $text2 = $text3 = "";
                                switch ($value) {
                                    case 1:
                                        $classSelect = "bls-hidden";
                                        $classInput  = "bls-hidden";
                                        $text1 = "selected";
                                        break;
                                    case 2:
                                        $classSelect = "";
                                        $classInput  = "bls-hidden";
                                        $text2 = "selected";
                                        break;
                                    case 3:
                                        $classSelect = "bls-hidden";
                                        $classInput  = "";
                                        $text3 = "selected";
                                        break;
                                    default:
                                        $classSelect = "";
                                        $classInput  = "bls-hidden";
                                        $text1 = "selected";
                                }

                                $input      = '
                                <select name="'. self::$meta_key .'['.$key.']" id="success-page-select">
                                    <option '.$text2.' value="2">Specific Page</option>
                                    <option '.$text3.' value="3">Redirect URL</option>
                                </select>
                                '.
                                    self::getPagesInSelect($keyPage, $valuePage, 'bls-sps ' . $classSelect) . '
                                    <br><span class="item-address"><input type="text" class="'.$classInput.' bls-sps" name="'. self::$meta_key .'['.$keyUrl.']" value="%s"></span>';
                                printf( $input, $valueUrl);
//                                echo esc_attr(sprintf( $input, $valueUrl));
                            }
                            else
                                echo self::getPagesInSelect($key,$value);
                        }elseif (self::$bsTypes[$key] == 'checkbox'){
                            $input = '<input type="hidden" name="'. self::$meta_key .'['.$key.']" value=""><input type="checkbox" name="'. self::$meta_key .'['.$key.']" value="1" %s>';
                            $value          = get_post_meta( $post->ID, $key, true );
                            $textChecked    = ($value == 1) ? "checked" : "";
                            printf( $input, $textChecked);
                        }


                        ?>
                    </td>
                </tr>
            <?php endforeach;?>
            <?php foreach (self::$bsFields as $key => $value):?>
                <tr>
                    <th>
                        <?=self::$bsLabels[$key];?>
                    </th>
                    <td class="company-address-list">
                        <?php
                        if ($value == 'optional'){
                            $value = get_post_meta( $post->ID, $key.'-output', true );
                            $text1 = $text2 = $text3 = "";
                            switch ($value) {
                                case 1:
                                    $text1 = "selected";
                                    break;
                                case 2:
                                    $text2 = "selected";
                                    break;
                                case 3:
                                    $text3 = "selected";
                                    break;
                                default:
                                    $text1 = "selected";
                            }
                            echo '
                                <select name="'. self::$meta_key .'['.$key.'-output]">
                                    <option '.$text1.' value="1">Hidden</option>
                                    <option '.$text2.' value="2">Optional</option>
                                    <option '.$text3.' value="3">Required</option>
                                </select>
                            ';
                        }



                        $input          = ' <input type="hidden" name="'. self::$meta_key .'['.$key.'-t]" value=""><input type="checkbox" class="translate-toggle" data-key="translation-'.$key.'" name="'. self::$meta_key .'['.$key.'-t]" id="'.$key.'t" value="1" %s><label for="'.$key.'t">Translate</label>';
                        $value          = get_post_meta( $post->ID, $key.'-t', true );
                        $textChecked    = ($value == 1) ? "checked" : "";
                        printf( $input, $textChecked);
//                        echo esc_html(sprintf( $input, $textChecked));

                        $class = ($textChecked)? '' : 'bls-hidden';
                        $input = '
                            <span class="item-address '.$class.'" id="translation-'.$key.'">
                                <input type="text" name="'. self::$meta_key .'['.$key.'-translation]" value="%s">
                            </span>
                            ';
                        $value          = get_post_meta( $post->ID, $key.'-translation', true );
                        printf( $input, esc_attr( $value ) );
//                        echo esc_html(sprintf( $input, esc_attr( $value ) ));
                        ?>
                    </td>
                </tr>
            <?php endforeach;?>
                <tr>
                    <th>
                        Shortcode form <br><small>This is the code you add to your checkout page to collect payments. You can pass the amount and currency</small>
                    </th>
                    <td>
                        [bluesnapForm idform='<?=$post->ID?>' amount='<?=get_post_meta( $post->ID, 'price', true );?>' currency="<?=get_post_meta( $post->ID, 'currency', true );?>"]
                    </td>
                </tr>
                <tr>
                    <th>
                        <a href="https://home.bluesnap.com/partners/" target="_blank">Documentation</a>
                    </th>
                    <td>

                    </td>
                </tr>
        </table>
        <input type="hidden" name="bs_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />

        <?php
    }

    ## Очищает и сохраняет значения полей
    public function save_metabox( $post_id )
    {

        if( ! wp_verify_nonce($_POST['bs_fields_nonce'], __FILE__) ) return false;

        // Check if it's not an autosave.
        if ( wp_is_post_autosave( $post_id ) )
            return false;

        if( ! current_user_can('edit_post', $post_id) ) return false;

        if ( isset( $_POST[self::$meta_key] ) ) {

            foreach ($_POST[self::$meta_key] as $key => $value) {

                if( empty($value) ){
                    delete_post_meta($post_id, $key);
                    continue;
                }

                update_post_meta($post_id, $key, $value);
            }
        }

    }

    ## Подключает скрипты и стили
    public function show_assets()
    {
        if ( is_admin() && (get_current_screen()->id == self::$post_type) ) {
            $this->show_styles();
            $this->show_scripts();
        }
    }

    ## Выводит на экран стили
    public function show_styles() {
        ?>
        <style>
            .company-address-list .item-address {
                display: flex;
                align-items: center;
            }
            .company-address-list .item-address input {
                width: 100%;
                /*max-width: 400px;*/
            }
            .bls-hidden{
                display: none!important;
            }
        </style>
        <?php
    }

    ## Выводит на экран JS
    public function show_scripts() {
        ?>
        <script>
            jQuery(document).ready(function ($) {


                // Добавляет бокс с вводом адреса фирмы
                $('.translate-toggle').click(function () {
                    if ($(this).prop('checked')){
                        console.log($(this).data('key'));
                        $('#'+$(this).data('key')).removeClass('bls-hidden');
                    } else {
                        console.log($(this).data('key'));
                        $('#'+$(this).data('key')).addClass('bls-hidden');
                    }
                });

                $( "#success-page-select" ).change(function() {
                    $('.bls-sps').addClass('bls-hidden');
                    switch ($(this).val()) {
                        case '2':
                            $('select.bls-sps').removeClass('bls-hidden');
                            break;
                        case '3':
                            $('input.bls-sps').removeClass('bls-hidden');
                            break;
                    }
                });

            });
        </script>
        <?php
    }

    /**
     * @return string
     */
    private function getPagesInSelect($optionName, $pageId, $classAttribute = '')
    {
        $classText = ($classAttribute)? 'class="'.$classAttribute.'"' : "";
        $html = '<select name='.self::$meta_key.'['.$optionName.'] '.$classText.'>';
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
     * @return string
     */
    private function getSelect($options, $keyField, $optionSelect)
    {
         $htmlSelect = '<select name="'.self::$meta_key.'['.$keyField.']">';
         foreach ($options as $key => $value){
             if ($optionSelect == $key)
                 $selected = "selected='selected'";
             else
                 $selected = "";
             $htmlSelect .= "<option value='$key' $selected>$value</option>";
         }
         $htmlSelect .= "</select>";

        return $htmlSelect;
    }

    /**
     * @return array
     */
    public function getCurrencyCodes ()
    {
        $codes = self::$bsCurrencyCodes;
        asort($codes);
        return $codes;
    }

    /**
     * @return array
     */
    public function getStates()
    {
        $states = self::$bsStates;
        asort($states);
        return $states;
    }

    public function getCountries()
    {
        $countries = self::$bsCountries;
        asort($countries);
        return $countries;
    }

    /**
     * @var array
     */
    static $bsCurrencyCodes = [

            'ALL' => 'Albania Leke',
            'AMD' => 'Armenia Dram',
            'ANG' => 'Netherlands Antillean Guilder',
            'ARS' => 'Argentina Peso',
            'AUD' => 'Australia Dollar',
            'BAM' => 'Bosnia and Herzegovina Mark',
            'BMD' => 'Barbados Dollar',
            'BND' => 'Brunei Dollar',
            'BOB' => 'Bolivia Boliviano',
            'BRL' => 'Brazil Real',
            'BWP' => 'Botswana Pula',
            'BYR' => 'Belarus Ruble',
            'CAD' => 'Canada Dollar',
            'CHF' => 'Switzerland Franc ',
            'CLP' => 'Chile Peso',
            'CNY' => 'China Yuan Renminbi',
            'COP' => 'Colombia Peso',
            'CRC' => 'Costa Rica Colon',
            'CZK' => 'Czech Republic Koruna',
            'DKK' => 'Denmark Kroner',
            'DOP' => 'Dominican Republic Peso',
            'DZD' => 'Algeria Dinar',
            'EGP' => 'Egypt Pound',
            'EUR' => 'Euro',
            'FJD' => 'Fiji Dollar',
            'GBP' => 'United Kingdom Pound',
            'GEL' => 'Georgia Lari',
            'GIP' => 'Gibraltar Pound',
            'GTQ' => 'Guatemala Quetzal',
            'HKD' => 'Hong Kong Dollar',
            'HRK' => 'Croatia Kuna',
            'HUF' => 'Hungary Forint',
            'IDR' => 'Indonesia Rupiah',
            'ILS' => 'Israel New Shekel ',
            'INR' => 'India Rupee',
            'ISK' => 'Iceland Kronur',
            'JMD' => 'Jamaica Dollar',
            'JOD' => 'Jordan Dollar',
            'JPY' => 'Japan Yen',
            'KES' => 'Kenya Shilling',
            'KHR' => 'Cambodia Riel',
            'KRW' => 'South Korea Won',
            'KWD' => 'Kuwait Dinar',
            'KYD' => 'Cayman Island Dollar',
            'KZT' => 'Kazakhstan Tenge',
            'LBP' => 'Lebanon Pound',
            'LKR' => 'Sri Lanka Rupee',
            'MAD' => 'Morocco Dirham',
            'MDL' => 'Moldova Leu',
            'MKD' => 'Macedonia Denar',
            'MRO' => 'Mauritania Ouguiya',
            'MUR' => 'Mauritius Rupee',
            'MWK' => 'Malawi Kwacha',
            'MXN' => 'Mexico Peso',
            'MYR' => 'Malaysia Ringgit',
            'NAD' => 'Namibia Dollar',
            'NGN' => 'Nigeria Naira',
            'NOK' => 'Norway Kroner',
            'NPR' => 'Nepal Rupee',
            'NZD' => 'New Zealand Dollar',
            'OMR' => 'Omar Rial',
            'PAB' => 'Panama Balboa',
            'PEN' => 'Peru Nuevo Sol',
            'PGK' => 'Papua New Guinea Kina',
            'PHP' => 'Philippines Peso',
            'PKR' => 'Pakistan Rupee',
            'PLN' => 'Poland Zlotych',
            'QAR' => 'Quatari Ria',
            'RON' => 'Romanian New Lei',
            'RSD' => 'Serbian Dinar',
            'RUB' => 'Russia Rubles',
            'SAR' => 'Saudi Arabia Riyal',
            'SCR' => 'Seychelles Rupee',
            'SDG' => 'Sudan Pound',
            'SEK' => 'Sweden Kronor',
            'SGD' => 'Singapore Dollar',
            'THB' => 'Thailand Baht',
            'TND' => 'Tunisia Dollar',
            'TRY' => 'Turkey New Lira',
            'TTD' => 'Trinidad & Tobago Dollar',
            'TWD' => 'Taiwan New Dollar',
            'TZS' => 'Tanzania Shilling',
            'AED' => 'United Arab Emirates Dirham',
            'USD' => 'United States Dollar',
            'UAH' => 'Ukraine Hryvnia',
            'UYU' => 'Uruguay Peso',
            'UZS' => 'Uzbekistan Som',
            'VEF' => 'Venezuela Bolivar',
            'VND' => 'Vietnam Dong',
            'XCD' => 'East Caribbean Dollar',
            'XOF' => 'CFA Franc BCEAO',
            'ZAR' => 'South Africa Rand',

    ];

}

