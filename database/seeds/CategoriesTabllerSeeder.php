<?php

use App\Entities\News;
use Illuminate\Database\Seeder;

class CategoriesTabllerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('news')->delete();
        $data = [
            [
                'name' => 'BĐS & Covid 19',
                'slug' => 'bds-covid-19',
                'thumbnail' => '',
                'destination_entity' => News::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tin thị trường',
                'slug' => 'tin-thi-truong',
                'thumbnail' => '',
                'destination_entity' => News::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Phân tích - Nhận định',
                'slug' => 'phan-tich-nhan-dinh',
                'thumbnail' => '',
                'destination_entity' => News::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Chính sách - Quản lý',
                'slug' => 'chinh-sach-quan-ly',
                'thumbnail' => '',
                'destination_entity' => News::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Thông tin quy hoạch',
                'slug' => 'Thong-tin-quy-hoach',
                'thumbnail' => '',
                'destination_entity' => News::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'BĐS thế giới',
                'slug' => 'bds-the-gioi',
                'thumbnail' => '',
                'destination_entity' => News::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tài chính - Chứng khoán - BDS',
                'slug' => 'tai-chinh-chung-khoan-bds',
                'thumbnail' => '',
                'destination_entity' => News::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tư vấn luật',
                'slug' => 'tu-van-luat',
                'thumbnail' => '',
                'destination_entity' => News::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Lời khuyên',
                'slug' => 'loi-khuyen',
                'thumbnail' => '',
                'destination_entity' => News::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        
        foreach(  $data as $i ) {
            DB::table('categories')->insert($i);
        }

    }
}
