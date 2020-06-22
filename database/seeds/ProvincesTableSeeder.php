<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('provinces')->delete();

        \DB::table('provinces')->insert(array(
            0 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 1,
                    'name' => 'Hà Nội',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            1 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 2,
                    'name' => 'Hà Giang',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            2 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 4,
                    'name' => 'Cao Bằng',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            3 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 6,
                    'name' => 'Bắc Kạn',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            4 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 8,
                    'name' => 'Tuyên Quang',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            5 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 10,
                    'name' => 'Lào Cai',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            6 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 11,
                    'name' => 'Điện Biên',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            7 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 12,
                    'name' => 'Lai Châu',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            8 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 14,
                    'name' => 'Sơn La',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            9 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 15,
                    'name' => 'Yên Bái',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            10 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 17,
                    'name' => 'Hòa Bình',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            11 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 19,
                    'name' => 'Thái Nguyên',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            12 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 20,
                    'name' => 'Lạng Sơn',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            13 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 22,
                    'name' => 'Quảng Ninh',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            14 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 24,
                    'name' => 'Bắc Giang',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            15 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 25,
                    'name' => 'Phú Thọ',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            16 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 26,
                    'name' => 'Vĩnh Phúc',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            17 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 27,
                    'name' => 'Bắc Ninh',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            18 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 30,
                    'name' => 'Hải Dương',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            19 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 31,
                    'name' => 'Hải Phòng',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            20 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 33,
                    'name' => 'Hưng Yên',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            21 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 34,
                    'name' => 'Thái Bình',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            22 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 35,
                    'name' => 'Hà Nam',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            23 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 36,
                    'name' => 'Nam Định',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            24 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 37,
                    'name' => 'Ninh Bình',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            25 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 38,
                    'name' => 'Thanh Hóa',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            26 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 40,
                    'name' => 'Nghệ An',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            27 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 42,
                    'name' => 'Hà Tĩnh',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            28 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 44,
                    'name' => 'Quảng Bình',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            29 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 45,
                    'name' => 'Quảng Trị',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            30 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 46,
                    'name' => 'Thừa Thiên Huế',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            31 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 48,
                    'name' => 'Đà Nẵng',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            32 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 49,
                    'name' => 'Quảng Nam',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            33 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 51,
                    'name' => 'Quảng Ngãi',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            34 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 52,
                    'name' => 'Bình Định',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            35 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 54,
                    'name' => 'Phú Yên',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            36 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 56,
                    'name' => 'Khánh Hòa',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            37 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 58,
                    'name' => 'Ninh Thuận',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            38 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 60,
                    'name' => 'Bình Thuận',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            39 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 62,
                    'name' => 'Kon Tum',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            40 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 64,
                    'name' => 'Gia Lai',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            41 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 66,
                    'name' => 'Đắk Lắk',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            42 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 67,
                    'name' => 'Đắk Nông',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            43 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 68,
                    'name' => 'Lâm Đồng',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            44 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 70,
                    'name' => 'Bình Phước',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            45 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 72,
                    'name' => 'Tây Ninh',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            46 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 74,
                    'name' => 'Bình Dương',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            47 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 75,
                    'name' => 'Đồng Nai',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            48 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 77,
                    'name' => 'Bà Rịa - Vũng Tàu',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            49 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 79,
                    'name' => 'Hồ Chí Minh',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            50 =>
                array(
                    'created_at' => '2020-03-23 11:56:47',
                    'id' => 80,
                    'name' => 'Long An',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            51 =>
                array(
                    'created_at' => '2020-03-23 11:56:48',
                    'id' => 82,
                    'name' => 'Tiền Giang',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            52 =>
                array(
                    'created_at' => '2020-03-23 11:56:48',
                    'id' => 83,
                    'name' => 'Bến Tre',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            53 =>
                array(
                    'created_at' => '2020-03-23 11:56:48',
                    'id' => 84,
                    'name' => 'Trà Vinh',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            54 =>
                array(
                    'created_at' => '2020-03-23 11:56:48',
                    'id' => 86,
                    'name' => 'Vĩnh Long',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            55 =>
                array(
                    'created_at' => '2020-03-23 11:56:48',
                    'id' => 87,
                    'name' => 'Đồng Tháp',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            56 =>
                array(
                    'created_at' => '2020-03-23 11:56:48',
                    'id' => 89,
                    'name' => 'An Giang',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            57 =>
                array(
                    'created_at' => '2020-03-23 11:56:48',
                    'id' => 91,
                    'name' => 'Kiên Giang',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            58 =>
                array(
                    'created_at' => '2020-03-23 11:56:48',
                    'id' => 92,
                    'name' => 'Cần Thơ',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            59 =>
                array(
                    'created_at' => '2020-03-23 11:56:48',
                    'id' => 93,
                    'name' => 'Hậu Giang',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            60 =>
                array(
                    'created_at' => '2020-03-23 11:56:48',
                    'id' => 94,
                    'name' => 'Sóc Trăng',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            61 =>
                array(
                    'created_at' => '2020-03-23 11:56:48',
                    'id' => 95,
                    'name' => 'Bạc Liêu',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
            62 =>
                array(
                    'created_at' => '2020-03-23 11:56:48',
                    'id' => 96,
                    'name' => 'Cà Mau',
                    'updated_at' => '2020-04-08 04:26:58',
                ),
        ));
    }
}
