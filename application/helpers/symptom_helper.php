<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('describe_symptom')) {
    function describe_symptom($attribute, $value)
    {
        $descriptions = [
            'Sex' => [
                '1' => 'Laki-laki',
                '2' => 'Perempuan'
            ],
            'Overweight_Obese_Family' => [
                '1' => 'Ya',
                '2' => 'Tidak'
            ],
            'Consumption_of_Fast_Food' => [
                '1' => 'Ya',
                '2' => 'Tidak'
            ],
            'Frequency_of_Consuming_Vegetables' => [
                '1' => 'Jarang',
                '2' => 'Kadang-kadang',
                '3' => 'Selalu'
            ],
            'Number_of_Main_Meals_Daily' => [
                '1' => '1-2 kali makan',
                '2' => '3 kali makan',
                '3' => 'Lebih dari 3 kali makan'
            ],
            'Food_Intake_Between_Meals' => [
                '1' => 'Jarang',
                '2' => 'Kadang-kadang',
                '3' => 'Biasanya',
                '4' => 'Selalu'
            ],
            'Smoking' => [
                '1' => 'Ya',
                '2' => 'Tidak'
            ],
            'Liquid_Intake_Daily' => [
                '1' => '<1 liter',
                '2' => '1-2 liter',
                '3' => '>2 liter'
            ],
            'Calculation_of_Calorie_Intake' => [
                '1' => 'Ya',
                '2' => 'Tidak'
            ],
            'Physical_Excercise' => [
                '1' => 'Tidak ada aktivitas',
                '2' => '1-2 hari',
                '3' => '3-4 hari',
                '4' => '5-6 hari',
                '5' => 'Lebih dari 6 hari'
            ],
            'Schedule_Dedicated_to_Technology' => [
                '1' => '0-2 jam',
                '2' => '3-5 jam',
                '3' => '>5 jam'
            ],
            'Type_of_Transportation_Used' => [
                '1' => 'Mobil',
                '2' => 'Sepeda motor',
                '3' => 'Sepeda',
                '4' => 'Transportasi umum',
                '5' => 'Berjalan kaki'
            ],
            'Class' => [
                '1' => 'Kurus',
                '2' => 'Normal',
                '3' => 'Kelebihan berat badan',
                '4' => 'Obesitas'
            ]
        ];

        // For numeric attributes that don't need conversion
        $numeric_attributes = ['Age', 'Height'];

        if (in_array($attribute, $numeric_attributes)) {
            return $value;
        }

        if (isset($descriptions[$attribute]) && isset($descriptions[$attribute][$value])) {
            return $descriptions[$attribute][$value];
        }

        // Return original value if no description found
        return $value;
    }
}