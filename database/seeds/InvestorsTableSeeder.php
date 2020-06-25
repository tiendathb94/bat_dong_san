<?php

use Illuminate\Database\Seeder;

class InvestorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('investors')->delete();

        \DB::table('districts')->insert([
            [
                'id' => 1,
                'created_at' => '2020-06-25 07:05:45',
                'updated_at' => '2020-06-25 07:05:45',
                'name' => 'TẬP ĐOÀN VÀNG BẠC ĐÁ QUÝ DOJI 1',
                'phone' => '(04) 22206688',
                'email' => 'contact@batdongsan.com.vn',
                'website' => 'www.doji.vn',
                'user_id' => '1',
                'logo' => 'https://file4.batdongsan.com.vn/images/no-photo.jpg',
                'overview' => 'Tập đoàn Vàng bạc Đá quý DOJI đã trải qua 15 năm phát triển với tiền thân là Công ty Phát triển Công nghệ và Thương Mại TTD, hoạt động trong các lĩnh vực khai thác, chế tác và kinh doanh các sản phẩm đá quý thiên nhiên của Việt Nam.',
            ],
            [
                'id' => 2,
                'created_at' => '2020-06-25 07:05:45',
                'updated_at' => '2020-06-25 07:05:45',
                'name' => 'TẬP ĐOÀN VÀNG BẠC ĐÁ QUÝ DOJI 2',
                'phone' => '(04) 22206688',
                'email' => 'contact@batdongsan.com.vn',
                'website' => 'www.doji.vn',
                'user_id' => '1',
                'logo' => 'https://file4.batdongsan.com.vn/images/no-photo.jpg',
                'overview' => 'Tập đoàn Vàng bạc Đá quý DOJI đã trải qua 15 năm phát triển với tiền thân là Công ty Phát triển Công nghệ và Thương Mại TTD, hoạt động trong các lĩnh vực khai thác, chế tác và kinh doanh các sản phẩm đá quý thiên nhiên của Việt Nam.',
            ],
            [
                'id' => 3,
                'created_at' => '2020-06-25 07:05:45',
                'updated_at' => '2020-06-25 07:05:45',
                'name' => 'TẬP ĐOÀN VÀNG BẠC ĐÁ QUÝ DOJI 3',
                'phone' => '(04) 22206688',
                'email' => 'contact@batdongsan.com.vn',
                'website' => 'www.doji.vn',
                'user_id' => '1',
                'logo' => 'https://file4.batdongsan.com.vn/images/no-photo.jpg',
                'overview' => 'Tập đoàn Vàng bạc Đá quý DOJI đã trải qua 15 năm phát triển với tiền thân là Công ty Phát triển Công nghệ và Thương Mại TTD, hoạt động trong các lĩnh vực khai thác, chế tác và kinh doanh các sản phẩm đá quý thiên nhiên của Việt Nam.',
            ],
            [
                'id' => 4,
                'created_at' => '2020-06-25 07:05:45',
                'updated_at' => '2020-06-25 07:05:45',
                'name' => 'TẬP ĐOÀN VÀNG BẠC ĐÁ QUÝ DOJI 4',
                'phone' => '(04) 22206688',
                'email' => 'contact@batdongsan.com.vn',
                'website' => 'www.doji.vn',
                'user_id' => '1',
                'logo' => 'https://file4.batdongsan.com.vn/images/no-photo.jpg',
                'overview' => 'Tập đoàn Vàng bạc Đá quý DOJI đã trải qua 15 năm phát triển với tiền thân là Công ty Phát triển Công nghệ và Thương Mại TTD, hoạt động trong các lĩnh vực khai thác, chế tác và kinh doanh các sản phẩm đá quý thiên nhiên của Việt Nam.',
            ],
            [
                'id' => 5,
                'created_at' => '2020-06-25 07:05:45',
                'updated_at' => '2020-06-25 07:05:45',
                'name' => 'TẬP ĐOÀN VÀNG BẠC ĐÁ QUÝ DOJI 5',
                'phone' => '(04) 22206688',
                'email' => 'contact@batdongsan.com.vn',
                'website' => 'www.doji.vn',
                'user_id' => '1',
                'logo' => 'https://file4.batdongsan.com.vn/images/no-photo.jpg',
                'overview' => 'Tập đoàn Vàng bạc Đá quý DOJI đã trải qua 15 năm phát triển với tiền thân là Công ty Phát triển Công nghệ và Thương Mại TTD, hoạt động trong các lĩnh vực khai thác, chế tác và kinh doanh các sản phẩm đá quý thiên nhiên của Việt Nam.',
            ]
        ]);
    }
}
