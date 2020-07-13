<?php

use Illuminate\Database\Seeder;
use App\Entities\Post;

class PostCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Bắn căn hộ chung cư',
                'slug' => 'bds-covid-19',
                'thumbnail' => '',
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán nhà riêng',
                'slug' => 'tin-thi-truong',
                'thumbnail' => '',
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán nhà biệt thự, liền kề',
                'slug' => 'phan-tich-nhan-dinh',
                'thumbnail' => '',
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán nhà mặt phố',
                'slug' => 'chinh-sach-quan-ly',
                'thumbnail' => '',
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán đất nền dự án',
                'slug' => 'thong-tin-quy-hoach',
                'thumbnail' => '',
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán đất',
                'slug' => 'bds-the-gioi',
                'thumbnail' => '',
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán trang trại, khu nghỉ dưỡng',
                'slug' => 'tai-chinh-chung-khoan-bds',
                'thumbnail' => '',
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán kho, nhà xưởng',
                'slug' => 'tu-van-luat',
                'thumbnail' => '',
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán loại bất động sản khác',
                'slug' => 'loi-khuyen',
                'thumbnail' => '',
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('categories')->insert($data);
    }
}
