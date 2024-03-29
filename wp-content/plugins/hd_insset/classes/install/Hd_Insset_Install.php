<?php

class Hd_Insset_Install 
{

    public function __construct() 
    {

        add_action( 'admin_init', array( $this, 'setup' ));
        return;

    }


    public function setup() 
    {

        global $wpdb;

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        $charset_collate = $wpdb->get_charset_collate();
        $table_name_config = $wpdb->prefix . 'hd_insset_config';
        $table_name_prospects = $wpdb->prefix . 'hd_insset_prospects';
        $table_name_pays = $wpdb->prefix . 'hd_insset_pays';

        if ($this->isTableBaseAlreadyCreated($table_name_config, $table_name_prospects, $table_name_pays))
        {    
            return;
        }

        $sql_create_hd_insset_config = "CREATE TABLE IF NOT EXISTS $table_name_config (
	     `id` mediumint(9) NOT NULL AUTO_INCREMENT,
            `iso` varchar(3) NOT NULL,
            `pays` varchar(255) NOT NULL,
            `note` int(1) NOT NULL DEFAULT 0,
            `accessible` int(1) NOT NULL DEFAULT 0,
            `actif` boolean NOT NULL DEFAULT 0,
            PRIMARY KEY  (id)
        ) $charset_collate;";

          if (dbDelta( $sql_create_hd_insset_config ) )
          {
           //appel de fonction creerPays Hd_Insset_Install.php
           $this->creerPays($table_name_config);

            $sql_create_hd_insset_prospects = "CREATE TABLE IF NOT EXISTS $table_name_prospects (
                `id` mediumint(9) NOT NULL AUTO_INCREMENT,
                `nom` VARCHAR(255) NOT NULL,
                `prenom` VARCHAR(255) NOT NULL,
                `sexe` VARCHAR(255) NOT NULL,
                `email` VARCHAR(255) NOT NULL,
                `date_naissance` DATETIME NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";

            if (dbDelta( $sql_create_hd_insset_prospects ))
            {

                $sql_create_hd_insset_pays = "CREATE TABLE IF NOT EXISTS $table_name_pays (
                    `id_prospects` mediumint(9) NOT NULL,
                    `id_config` mediumint(9) NOT NULL,
                    FOREIGN KEY (`id_prospects`) REFERENCES `$table_name_prospects`(`id`),
                    FOREIGN KEY (`id_config`) REFERENCES `$table_name_config`(`id`)
                ) $charset_collate;";
                dbDelta( $sql_create_hd_insset_pays );
                return;
            }

        }
    }
    
            
    public function isTableBaseAlreadyCreated($table_name_config, $table_name_prospects, $table_name_pays)
    {
        global $wpdb;

        $sql_Config = 'SHOW TABLES LIKE \'%' . $table_name_config . '%\'';
        $sql_Prospects = 'SHOW TABLES LIKE \'%' . $table_name_prospects . '%\'';
        $sql_Pays = 'SHOW TABLES LIKE \'%' . $table_name_pays . '%\'';

      return $wpdb->get_var($sql_Config) && $wpdb->get_var($sql_Prospects) && $wpdb->get_var($sql_Pays);
    } 
   
    public function creerPays($table_name_config)
        {
            global $wpdb;

            $iso_array = array(
                'ABW'=>'Aruba',
                'AFG'=>'Afghanistan',
                'AGO'=>'Angola',
                'AIA'=>'Anguilla',
                'ALA'=>'Åland Islands',
                'ALB'=>'Albania',
                'AND'=>'Andorra',
                'ARE'=>'United Arab Emirates',
                'ARG'=>'Argentina',
                'ARM'=>'Armenia',
                'ASM'=>'American Samoa',
                'ATA'=>'Antarctica',
                'ATF'=>'French Southern Territories',
                'ATG'=>'Antigua and Barbuda',
                'AUS'=>'Australia',
                'AUT'=>'Austria',
                'AZE'=>'Azerbaijan',
                'BDI'=>'Burundi',
                'BEL'=>'Belgium',
                'BEN'=>'Benin',
                'BES'=>'Bonaire, Sint Eustatius and Saba',
                'BFA'=>'Burkina Faso',
                'BGD'=>'Bangladesh',
                'BGR'=>'Bulgaria',
                'BHR'=>'Bahrain',
                'BHS'=>'Bahamas',
                'BIH'=>'Bosnia and Herzegovina',
                'BLM'=>'Saint Barthélemy',
                'BLR'=>'Belarus',
                'BLZ'=>'Belize',
                'BMU'=>'Bermuda',
                'BOL'=>'Bolivia, Plurinational State of',
                'BRA'=>'Brazil',
                'BRB'=>'Barbados',
                'BRN'=>'Brunei Darussalam',
                'BTN'=>'Bhutan',
                'BVT'=>'Bouvet Island',
                'BWA'=>'Botswana',
                'CAF'=>'Central African Republic',
                'CAN'=>'Canada',
                'CCK'=>'Cocos (Keeling) Islands',
                'CHE'=>'Switzerland',
                'CHL'=>'Chile',
                'CHN'=>'China',
                'CIV'=>'Côte d\'Ivoire',
                'CMR'=>'Cameroon',
                'COD'=>'Congo, the Democratic Republic of the',
                'COG'=>'Congo',
                'COK'=>'Cook Islands',
                'COL'=>'Colombia',
                'COM'=>'Comoros',
                'CPV'=>'Cape Verde',
                'CRI'=>'Costa Rica',
                'CUB'=>'Cuba',
                'CUW'=>'Curaçao',
                'CXR'=>'Christmas Island',
                'CYM'=>'Cayman Islands',
                'CYP'=>'Cyprus',
                'CZE'=>'Czech Republic',
                'DEU'=>'Germany',
                'DJI'=>'Djibouti',
                'DMA'=>'Dominica',
                'DNK'=>'Denmark',
                'DOM'=>'Dominican Republic',
                'DZA'=>'Algeria',
                'ECU'=>'Ecuador',
                'EGY'=>'Egypt',
                'ERI'=>'Eritrea',
                'ESH'=>'Western Sahara',
                'ESP'=>'Spain',
                'EST'=>'Estonia',
                'ETH'=>'Ethiopia',
                'FIN'=>'Finland',
                'FJI'=>'Fiji',
                'FLK'=>'Falkland Islands (Malvinas)',
                'FRA'=>'France',
                'FRO'=>'Faroe Islands',
                'FSM'=>'Micronesia, Federated States of',
                'GAB'=>'Gabon',
                'GBR'=>'United Kingdom',
                'GEO'=>'Georgia',
                'GGY'=>'Guernsey',
                'GHA'=>'Ghana',
                'GIB'=>'Gibraltar',
                'GIN'=>'Guinea',
                'GLP'=>'Guadeloupe',
                'GMB'=>'Gambia',
                'GNB'=>'Guinea-Bissau',
                'GNQ'=>'Equatorial Guinea',
                'GRC'=>'Greece',
                'GRD'=>'Grenada',
                'GRL'=>'Greenland',
                'GTM'=>'Guatemala',
                'GUF'=>'French Guiana',
                'GUM'=>'Guam',
                'GUY'=>'Guyana',
                'HKG'=>'Hong Kong',
                'HMD'=>'Heard Island and McDonald Islands',
                'HND'=>'Honduras',
                'HRV'=>'Croatia',
                'HTI'=>'Haiti',
                'HUN'=>'Hungary',
                'IDN'=>'Indonesia',
                'IMN'=>'Isle of Man',
                'IND'=>'India',
                'IOT'=>'British Indian Ocean Territory',
                'IRL'=>'Ireland',
                'IRN'=>'Iran, Islamic Republic of',
                'IRQ'=>'Iraq',
                'ISL'=>'Iceland',
                'ISR'=>'Israel',
                'ITA'=>'Italy',
                'JAM'=>'Jamaica',
                'JEY'=>'Jersey',
                'JOR'=>'Jordan',
                'JPN'=>'Japan',
                'KAZ'=>'Kazakhstan',
                'KEN'=>'Kenya',
                'KGZ'=>'Kyrgyzstan',
                'KHM'=>'Cambodia',
                'KIR'=>'Kiribati',
                'KNA'=>'Saint Kitts and Nevis',
                'KOR'=>'Korea, Republic of',
                'KWT'=>'Kuwait',
                'LAO'=>'Lao People\'s Democratic Republic',
                'LBN'=>'Lebanon',
                'LBR'=>'Liberia',
                'LBY'=>'Libya',
                'LCA'=>'Saint Lucia',
                'LIE'=>'Liechtenstein',
                'LKA'=>'Sri Lanka',
                'LSO'=>'Lesotho',
                'LTU'=>'Lithuania',
                'LUX'=>'Luxembourg',
                'LVA'=>'Latvia',
                'MAC'=>'Macao',
                'MAF'=>'Saint Martin (French part)',
                'MAR'=>'Morocco',
                'MCO'=>'Monaco',
                'MDA'=>'Moldova, Republic of',
                'MDG'=>'Madagascar',
                'MDV'=>'Maldives',
                'MEX'=>'Mexico',
                'MHL'=>'Marshall Islands',
                'MKD'=>'Macedonia, the former Yugoslav Republic of',
                'MLI'=>'Mali',
                'MLT'=>'Malta',
                'MMR'=>'Myanmar',
                'MNE'=>'Montenegro',
                'MNG'=>'Mongolia',
                'MNP'=>'Northern Mariana Islands',
                'MOZ'=>'Mozambique',
                'MRT'=>'Mauritania',
                'MSR'=>'Montserrat',
                'MTQ'=>'Martinique',
                'MUS'=>'Mauritius',
                'MWI'=>'Malawi',
                'MYS'=>'Malaysia',
                'MYT'=>'Mayotte',
                'NAM'=>'Namibia',
                'NCL'=>'New Caledonia',
                'NER'=>'Niger',
                'NFK'=>'Norfolk Island',
                'NGA'=>'Nigeria',
                'NIC'=>'Nicaragua',
                'NIU'=>'Niue',
                'NLD'=>'Netherlands',
                'NOR'=>'Norway',
                'NPL'=>'Nepal',
                'NRU'=>'Nauru',
                'NZL'=>'New Zealand',
                'OMN'=>'Oman',
                'PAK'=>'Pakistan',
                'PAN'=>'Panama',
                'PCN'=>'Pitcairn',
                'PER'=>'Peru',
                'PHL'=>'Philippines',
                'PLW'=>'Palau',
                'PNG'=>'Papua New Guinea',
                'POL'=>'Poland',
                'PRI'=>'Puerto Rico',
                'PRK'=>'Korea, Democratic People\'s Republic of',
                'PRT'=>'Portugal',
                'PRY'=>'Paraguay',
                'PSE'=>'Palestinian Territory, Occupied',
                'PYF'=>'French Polynesia',
                'QAT'=>'Qatar',
                'REU'=>'Réunion',
                'ROU'=>'Romania',
                'RUS'=>'Russian Federation',
                'RWA'=>'Rwanda',
                'SAU'=>'Saudi Arabia',
                'SDN'=>'Sudan',
                'SEN'=>'Senegal',
                'SGP'=>'Singapore',
                'SGS'=>'South Georgia and the South Sandwich Islands',
                'SHN'=>'Saint Helena, Ascension and Tristan da Cunha',
                'SJM'=>'Svalbard and Jan Mayen',
                'SLB'=>'Solomon Islands',
                'SLE'=>'Sierra Leone',
                'SLV'=>'El Salvador',
                'SMR'=>'San Marino',
                'SOM'=>'Somalia',
                'SPM'=>'Saint Pierre and Miquelon',
                'SRB'=>'Serbia',
                'SSD'=>'South Sudan',
                'STP'=>'Sao Tome and Principe',
                'SUR'=>'Suriname',
                'SVK'=>'Slovakia',
                'SVN'=>'Slovenia',
                'SWE'=>'Sweden',
                'SWZ'=>'Swaziland',
                'SXM'=>'Sint Maarten (Dutch part)',
                'SYC'=>'Seychelles',
                'SYR'=>'Syrian Arab Republic',
                'TCA'=>'Turks and Caicos Islands',
                'TCD'=>'Chad',
                'TGO'=>'Togo',
                'THA'=>'Thailand',
                'TJK'=>'Tajikistan',
                'TKL'=>'Tokelau',
                'TKM'=>'Turkmenistan',
                'TLS'=>'Timor-Leste',
                'TON'=>'Tonga',
                'TTO'=>'Trinidad and Tobago',
                'TUN'=>'Tunisia',
                'TUR'=>'Turkey',
                'TUV'=>'Tuvalu',
                'TWN'=>'Taiwan, Province of China',
                'TZA'=>'Tanzania, United Republic of',
                'UGA'=>'Uganda',
                'UKR'=>'Ukraine',
                'UMI'=>'United States Minor Outlying Islands',
                'URY'=>'Uruguay',
                'USA'=>'United States',
                'UZB'=>'Uzbekistan',
                'VAT'=>'Holy See (Vatican City State)',
                'VCT'=>'Saint Vincent and the Grenadines',
                'VEN'=>'Venezuela, Bolivarian Republic of',
                'VGB'=>'Virgin Islands, British',
                'VIR'=>'Virgin Islands, U.S.',
                'VNM'=>'Viet Nam',
                'VUT'=>'Vanuatu',
                'WLF'=>'Wallis and Futuna',
                'WSM'=>'Samoa',
                'YEM'=>'Yemen',
                'ZAF'=>'South Africa',
                'ZMB'=>'Zambia',
                'ZWE'=>'Zimbabwe'
            );
            
            foreach ($iso_array as $iso=> $pays) 
            {
                $wpdb->insert($table_name_config, array('iso' => $iso, 'pays' => $pays, 'note' => '0', 'accessible' => 0, 'actif' => 1));
            }
        }
    
}


