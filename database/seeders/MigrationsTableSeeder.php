<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 297,
                'migration' => '2019_12_14_000001_create_personal_access_tokens_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 298,
                'migration' => '2023_06_13_000751_create_ac_enterprise_rels_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'id' => 299,
                'migration' => '2023_06_13_000752_create_categories_table',
                'batch' => 1,
            ),
            3 => 
            array (
                'id' => 300,
                'migration' => '2023_06_13_000753_create_configs_table',
                'batch' => 1,
            ),
            4 => 
            array (
                'id' => 301,
                'migration' => '2023_06_13_000754_create_contracts_table',
                'batch' => 1,
            ),
            5 => 
            array (
                'id' => 302,
                'migration' => '2023_06_13_000755_create_contracts_items_table',
                'batch' => 1,
            ),
            6 => 
            array (
                'id' => 303,
                'migration' => '2023_06_13_000756_create_diversos_table',
                'batch' => 1,
            ),
            7 => 
            array (
                'id' => 304,
                'migration' => '2023_06_13_000757_create_equipments_table',
                'batch' => 1,
            ),
            8 => 
            array (
                'id' => 305,
                'migration' => '2023_06_13_000758_create_equipmentssub_table',
                'batch' => 1,
            ),
            9 => 
            array (
                'id' => 306,
                'migration' => '2023_06_13_000759_create_failed_jobs_table',
                'batch' => 1,
            ),
            10 => 
            array (
                'id' => 307,
                'migration' => '2023_06_13_000800_create_items_table',
                'batch' => 1,
            ),
            11 => 
            array (
                'id' => 308,
                'migration' => '2023_06_13_000801_create_jobs_table',
                'batch' => 1,
            ),
            12 => 
            array (
                'id' => 309,
                'migration' => '2023_06_13_000802_create_listopctions_table',
                'batch' => 1,
            ),
            13 => 
            array (
                'id' => 310,
                'migration' => '2023_06_13_000803_create_log_actions_table',
                'batch' => 1,
            ),
            14 => 
            array (
                'id' => 311,
                'migration' => '2023_06_13_000804_create_log_logins_table',
                'batch' => 1,
            ),
            15 => 
            array (
                'id' => 312,
                'migration' => '2023_06_13_000805_create_logs_send_mail_table',
                'batch' => 1,
            ),
            16 => 
            array (
                'id' => 313,
                'migration' => '2023_06_13_000806_create_materials_table',
                'batch' => 1,
            ),
            17 => 
            array (
                'id' => 314,
                'migration' => '2023_06_13_000807_create_measures_table',
                'batch' => 1,
            ),
            18 => 
            array (
                'id' => 315,
                'migration' => '2023_06_13_000808_create_modulesapps_table',
                'batch' => 1,
            ),
            19 => 
            array (
                'id' => 316,
                'migration' => '2023_06_13_000809_create_password_resets_table',
                'batch' => 1,
            ),
            20 => 
            array (
                'id' => 317,
                'migration' => '2023_06_13_000810_create_permissions_table',
                'batch' => 1,
            ),
            21 => 
            array (
                'id' => 318,
                'migration' => '2023_06_13_000812_create_pptoeqhe_table',
                'batch' => 1,
            ),
            22 => 
            array (
                'id' => 319,
                'migration' => '2023_06_13_000813_create_pptomdo_table',
                'batch' => 1,
            ),
            23 => 
            array (
                'id' => 320,
                'migration' => '2023_06_13_000814_create_pptotec_table',
                'batch' => 1,
            ),
            24 => 
            array (
                'id' => 321,
                'migration' => '2023_06_13_000815_create_pptovarios_table',
                'batch' => 1,
            ),
            25 => 
            array (
                'id' => 322,
                'migration' => '2023_06_13_000816_create_profiles_table',
                'batch' => 1,
            ),
            26 => 
            array (
                'id' => 323,
                'migration' => '2023_06_13_000817_create_profpermissions_table',
                'batch' => 1,
            ),
            27 => 
            array (
                'id' => 324,
                'migration' => '2023_06_13_000818_create_prueba_table',
                'batch' => 1,
            ),
            28 => 
            array (
                'id' => 325,
                'migration' => '2023_06_13_000819_create_quotes_table',
                'batch' => 1,
            ),
            29 => 
            array (
                'id' => 326,
                'migration' => '2023_06_13_000820_create_quotes_items_table',
                'batch' => 1,
            ),
            30 => 
            array (
                'id' => 327,
                'migration' => '2023_06_13_000821_create_quotes_states_table',
                'batch' => 1,
            ),
            31 => 
            array (
                'id' => 328,
                'migration' => '2023_06_13_000822_create_salarys_table',
                'batch' => 1,
            ),
            32 => 
            array (
                'id' => 329,
                'migration' => '2023_06_13_000823_create_taxes_table',
                'batch' => 1,
            ),
            33 => 
            array (
                'id' => 330,
                'migration' => '2023_06_13_000824_create_users_table',
                'batch' => 1,
            ),
            34 => 
            array (
                'id' => 331,
                'migration' => '2023_06_13_000825_create_usuarios_table',
                'batch' => 1,
            ),
            35 => 
            array (
                'id' => 332,
                'migration' => '2023_06_16_011353_create_ie_account_statuses_table',
                'batch' => 1,
            ),
            36 => 
            array (
                'id' => 333,
                'migration' => '2023_06_16_011354_create_ie_account_types_table',
                'batch' => 1,
            ),
            37 => 
            array (
                'id' => 334,
                'migration' => '2023_06_16_011355_create_ie_accounting_documents_table',
                'batch' => 1,
            ),
            38 => 
            array (
                'id' => 335,
                'migration' => '2023_06_16_011356_create_ie_accounts_table',
                'batch' => 1,
            ),
            39 => 
            array (
                'id' => 336,
                'migration' => '2023_06_16_011357_create_ie_aprobation_documents_table',
                'batch' => 1,
            ),
            40 => 
            array (
                'id' => 337,
                'migration' => '2023_06_16_011358_create_ie_bank_movement_types_table',
                'batch' => 1,
            ),
            41 => 
            array (
                'id' => 338,
                'migration' => '2023_06_16_011359_create_ie_banks_table',
                'batch' => 1,
            ),
            42 => 
            array (
                'id' => 339,
                'migration' => '2023_06_16_011400_create_ie_classifications_table',
                'batch' => 1,
            ),
            43 => 
            array (
                'id' => 340,
                'migration' => '2023_06_16_011401_create_ie_companies_table',
                'batch' => 1,
            ),
            44 => 
            array (
                'id' => 341,
                'migration' => '2023_06_16_011402_create_ie_company_bank_accounts_table',
                'batch' => 1,
            ),
            45 => 
            array (
                'id' => 342,
                'migration' => '2023_06_16_011403_create_ie_company_costcenters_table',
                'batch' => 1,
            ),
            46 => 
            array (
                'id' => 343,
                'migration' => '2023_06_16_011404_create_ie_concepts_table',
                'batch' => 1,
            ),
            47 => 
            array (
                'id' => 344,
                'migration' => '2023_06_16_011405_create_ie_cost_center_type_classifications_table',
                'batch' => 1,
            ),
            48 => 
            array (
                'id' => 345,
                'migration' => '2023_06_16_011406_create_ie_cost_centers_table',
                'batch' => 1,
            ),
            49 => 
            array (
                'id' => 346,
                'migration' => '2023_06_16_011407_create_ie_income_expenses_table',
                'batch' => 1,
            ),
            50 => 
            array (
                'id' => 347,
                'migration' => '2023_06_16_011408_create_ie_movement_type_classifications_table',
                'batch' => 1,
            ),
            51 => 
            array (
                'id' => 348,
                'migration' => '2023_06_16_011409_create_ie_movement_types_table',
                'batch' => 1,
            ),
            52 => 
            array (
                'id' => 349,
                'migration' => '2023_06_16_011410_create_ie_sub_c2_cost_centers_table',
                'batch' => 1,
            ),
            53 => 
            array (
                'id' => 350,
                'migration' => '2023_06_16_011411_create_ie_sub_costcenters_table',
                'batch' => 1,
            ),
            54 => 
            array (
                'id' => 351,
                'migration' => '2023_06_16_011412_create_ie_third_clasifications_table',
                'batch' => 1,
            ),
            55 => 
            array (
                'id' => 352,
                'migration' => '2023_06_16_011413_create_ie_thirdparties_table',
                'batch' => 1,
            ),
            56 => 
            array (
                'id' => 353,
                'migration' => '2023_06_16_014204_create_states_table',
                'batch' => 1,
            ),
            57 => 
            array (
                'id' => 354,
                'migration' => '2023_06_16_014535_add_parent_id_to_modulesapps',
                'batch' => 1,
            ),
            58 => 
            array (
                'id' => 355,
                'migration' => '2023_06_16_031720_create_activity_log_table',
                'batch' => 1,
            ),
            59 => 
            array (
                'id' => 356,
                'migration' => '2023_06_16_031721_add_event_column_to_activity_log_table',
                'batch' => 1,
            ),
            60 => 
            array (
                'id' => 357,
                'migration' => '2023_06_16_031722_add_batch_uuid_column_to_activity_log_table',
                'batch' => 1,
            ),
            61 => 
            array (
                'id' => 358,
                'migration' => '2023_06_16_032416_create_media_table',
                'batch' => 1,
            ),
            62 => 
            array (
                'id' => 359,
                'migration' => '2023_06_16_044920_add_state_to_modulesapps',
                'batch' => 1,
            ),
            63 => 
            array (
                'id' => 360,
                'migration' => '2023_06_16_150027_set_unique_urlapp_to_modulesapps',
                'batch' => 1,
            ),
            64 => 
            array (
                'id' => 361,
                'migration' => '2023_06_16_213509_create_listas_table',
                'batch' => 1,
            ),
        ));
        
        
    }
}