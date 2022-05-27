<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CommonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {            

        $directions = [
            [
                'name' => 'Direction Commerciale',
            ],
            [
                'name' => 'Direction Admimistrative et Financière',
            ],
            [
                'name' => 'Direction Technique',
            ],
            [
                'name' => 'Direction des Ressources Humaines',
            ],
            [
                'name' => 'Direction Génerale',
            ]
        ];

        $filiales = [
            [
                'name' => 'Holding',
            ],
            [
                'name' => 'Bénin',
            ],
            [
                'name' => 'Burkina',
            ],
            [
                'name' => 'Côte d\'ivoire',
            ],
            [
                'name' => 'Gabon',
            ],
            [
                'name' => 'Guinée',
            ],
            [
                'name' => 'Guinée Bissau',
            ],
            [
                'name' => 'Mali',
            ],
            [
                'name' => 'Mauritanie',
            ],
            [
                'name' => 'Niger',
            ],
            [
                'name' => 'Senegal',
            ],
            [
                'name' => 'Tchad',
            ],
            [
                'name' => 'Togo',
            ],
            [
                'name' => 'Maroc',
            ],
            [
                'name' => 'Egypte',
            ],
            [
                'name' => 'Tunisie',
            ],
            [
                'name' => 'Somalie',
            ],
            [
                'name' => 'Lesotho',
            ],
            [
                'name' => 'Rwanda',
            ],
            [
                'name' => 'Serra Leone',
            ],
            [
                'name' => 'Angola',
            ],
            [
                'name' => 'Afrique du Sud',
            ],
            [
                'name' => 'Zimbabwe',
            ],
            [
                'name' => 'Soudan du Sud',
            ],
            [
                'name' => 'Kenya',
            ],
            [
                'name' => 'Burundi',
            ],
            [
                'name' => 'Comores',
            ],
            [
                'name' => 'Tanzanie',
            ],
            [
                'name' => 'Namibie',
            ],
            [
                'name' => 'Soudan du Nord',
            ]
        ];

        $settings = [
            [
                'slug' => 'currency',
                'data' => 'XAF'
            ],
            [
                'slug' => 'platform',
                'data' => 1
            ],
            [
                'slug' => 'delay',
                'data' => 3
            ],
            [
                'slug' => 'date',
                'data' => '2033-01-01'
            ]
        ];

        $countries = [["code"=> "AF"],["code"=> "AL"],["code"=> "DZ"],["code"=> "AS"],["code"=> "AD"],["code"=> "AO"],["code"=> "AI"],["code"=> "AQ"],["code"=> "AG"],["code"=> "AR"],["code"=> "AM"],["code"=> "AW"],["code"=> "AU"],["code"=> "AT"],["code"=> "AZ"],["code"=> "BS"],["code"=> "BH"],["code"=> "BD"],["code"=> "BB"],["code"=> "BY"],["code"=> "BE"],["code"=> "BZ"],["code"=> "BJ"],["code"=> "BM"],["code"=> "BT"],["code"=> "BO"],["code"=> "BA"],["code"=> "BW"],["code"=> "BR"],["code"=> "BN"],["code"=> "BG"],["code"=> "BF"],["code"=> "BI"],["code"=> "KH"],["code"=> "CM"],["code"=> "CA"],["code"=> "CV"],["code"=> "KY"],["code"=> "CF"],["code"=> "TD"],["code"=> "CL"],["code"=> "CN"],["code"=> "CX"],["code"=> "CC"],["code"=> "CO"],["code"=> "KM"],["code"=> "CG"],["code"=> "CD"],["code"=> "CK"],["code"=> "CR"],["code"=> "CI"],["code"=> "HR"],["code"=> "CU"],["code"=> "CW"],["code"=> "CY"],["code"=> "CZ"],["code"=> "DK"],["code"=> "DJ"],["code"=> "DM"],["code"=> "DO"],["code"=> "EC"],["code"=> "EG"],["code"=> "SV"],["code"=> "GQ"],["code"=> "ER"],["code"=> "EE"],["code"=> "ET"],["code"=> "FK"],["code"=> "FO"],["code"=> "FJ"],["code"=> "FI"],["code"=> "FR"],["code"=> "GF"],["code"=> "PF"],["code"=> "TF"],["code"=> "GA"],["code"=> "GM"],["code"=> "GE"],["code"=> "DE"],["code"=> "GH"],["code"=> "GI"],["code"=> "GR"],["code"=> "GL"],["code"=> "GD"],["code"=> "GP"],["code"=> "GU"],["code"=> "GT"],["code"=> "GG"],["code"=> "GN"],["code"=> "GW"],["code"=> "GY"],["code"=> "HT"],["code"=> "HM"],["code"=> "VA"],["code"=> "HN"],["code"=> "HK"],["code"=> "HU"],["code"=> "IS"],["code"=> "IN"],["code"=> "ID"],["code"=> "IR"],["code"=> "IQ"],["code"=> "IE"],["code"=> "IM"],["code"=> "IL"],["code"=> "IT"],["code"=> "JM"],["code"=> "JP"],["code"=> "JE"],["code"=> "JO"],["code"=> "KZ"],["code"=> "KE"],["code"=> "KI"],["code"=> "KP"],["code"=> "KR"],["code"=> "KW"],["code"=> "KG"],["code"=> "LA"],["code"=> "LV"],["code"=> "LB"],["code"=> "LS"],["code"=> "LR"],["code"=> "LY"],["code"=> "LI"],["code"=> "LT"],["code"=> "LU"],["code"=> "MO"],["code"=> "MK"],["code"=> "MG"],["code"=> "MW"],["code"=> "MY"],["code"=> "MV"],["code"=> "ML"],["code"=> "MT"],["code"=> "MH"],["code"=> "MQ"],["code"=> "MR"],["code"=> "MU"],["code"=> "YT"],["code"=> "MX"],["code"=> "FM"],["code"=> "MD"],["code"=> "MC"],["code"=> "MN"],["code"=> "ME"],["code"=> "MS"],["code"=> "MA"],["code"=> "MZ"],["code"=> "MM"],["code"=> "NA"],["code"=> "NR"],["code"=> "NP"],["code"=> "NL"],["code"=> "NC"],["code"=> "NZ"],["code"=> "NI"],["code"=> "NE"],["code"=> "NG"],["code"=> "NU"],["code"=> "NF"],["code"=> "MP"],["code"=> "NO"],["code"=> "OM"],["code"=> "PK"],["code"=> "PW"],["code"=> "PS"],["code"=> "PA"],["code"=> "PG"],["code"=> "PY"],["code"=> "PE"],["code"=> "PH"],["code"=> "PN"],["code"=> "PL"],["code"=> "PT"],["code"=> "PR"],["code"=> "QA"],["code"=> "RE"],["code"=> "RO"],["code"=> "RU"],["code"=> "RW"],["code"=> "BL"],["code"=> "SH"],["code"=> "KN"],["code"=> "LC"],["code"=> "MF"],["code"=> "PM"],["code"=> "VC"],["code"=> "WS"],["code"=> "SM"],["code"=> "ST"],["code"=> "SA"],["code"=> "SN"],["code"=> "RS"],["code"=> "SC"],["code"=> "SL"],["code"=> "SG"],["code"=> "SX"],["code"=> "SK"],["code"=> "SI"],["code"=> "SB"],["code"=> "SO"],["code"=> "ZA"],["code"=> "GS"],["code"=> "SS"],["code"=> "ES"],["code"=> "LK"],["code"=> "SD"],["code"=> "SR"],["code"=> "SJ"],["code"=> "SZ"],["code"=> "SE"],["code"=> "CH"],["code"=> "SY"],["code"=> "TW"],["code"=> "TJ"],["code"=> "TZ"],["code"=> "TH"],["code"=> "TL"],["code"=> "TG"],["code"=> "TK"],["code"=> "TO"],["code"=> "TT"],["code"=> "TN"],["code"=> "TR"],["code"=> "TM"],["code"=> "TC"],["code"=> "TV"],["code"=> "UG"],["code"=> "UA"],["code"=> "AE"],["code"=> "GB"],["code"=> "US"],["code"=> "UM"],["code"=> "UY"],["code"=> "UZ"],["code"=> "VU"],["code"=> "VE"],["code"=> "VN"],["code"=> "VG"],["code"=> "VI"],["code"=> "WF"],["code"=> "EH"],["code"=> "YE"],["code"=> "ZM"],["code"=> "ZW"]];


        DB::table('directions')->insert($directions);
        DB::table('filiales')->insert($filiales);
        DB::table('settings')->insert($settings);
        DB::table('countries')->insert($countries);

    }
}
