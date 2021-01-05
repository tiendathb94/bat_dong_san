<?php

use Illuminate\Database\Seeder;
use App\Entities\Post;
use App\Entities\Category;

class PostCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->where('destination_entity', Post::class)->delete();
        $sellHouse = Category::create([
            'name' => 'Nhà đất bán',
            'slug' => 'nha-dat-ban',
            'thumbnail' => '',
            'destination_entity' => Post::class,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $leaseHouse = Category::create([
            'name' => 'Nhà đất cho thuê',
            'slug' => 'nha-dat-cho-thue',
            'thumbnail' => '',
            'destination_entity' => Post::class,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $buyHouse = Category::create([
            'name' => 'Nhà đất cần mua',
            'slug' => 'nha-dat-can-mua',
            'thumbnail' => '',
            'destination_entity' => Post::class,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $needEmployHouse = Category::create([
            'name' => 'Nhà đất cần thuê',
            'slug' => 'nha-dat-can-thue',
            'thumbnail' => '',
            'destination_entity' => Post::class,
            'created_at' => now(),
            'updated_at' => now()
        ]);


        $data = [
            [
                'name' => 'Bắn căn hộ chung cư',
                'slug' => 'ban-can-ho-chung-cu',
                'thumbnail' => '',
                'parent_id' => $sellHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán nhà riêng',
                'slug' => 'ban-nha-rieng',
                'parent_id' => $sellHouse->id,
                'thumbnail' => '',
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán nhà biệt thự, liền kề',
                'slug' => 'ban-nha-biet-thu-lien-ke',
                'parent_id' => $sellHouse->id,
                'thumbnail' => '',
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán nhà mặt phố',
                'slug' => 'ban-nha-mat-pho',
                'thumbnail' => '',
                'parent_id' => $sellHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán đất nền dự án',
                'slug' => 'ban-dat-nen-du-an',
                'thumbnail' => '',
                'parent_id' => $sellHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán đất',
                'slug' => 'bat-dat',
                'thumbnail' => '',
                'parent_id' => $sellHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán trang trại, khu nghỉ dưỡng',
                'slug' => 'ban-trang-trai-khu-nghi-duong',
                'thumbnail' => '',
                'parent_id' => $sellHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán kho, nhà xưởng',
                'slug' => 'ban-kho-nha-xuong',
                'thumbnail' => '',
                'parent_id' => $sellHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Bán loại bất động sản khác',
                'slug' => 'ban-loai-bat-dong-san-khac',
                'thumbnail' => '',
                'parent_id' => $sellHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Cho thuê căn hộ chung cư',
                'slug' => 'cho-thue-can-ho-chung-cu',
                'thumbnail' => '',
                'parent_id' => $leaseHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cho thuê nhà riêng',
                'slug' => 'cho-thue-nha-rieng',
                'thumbnail' => '',
                'parent_id' => $leaseHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cho thuê nhà mặt phố',
                'slug' => 'cho-thue-nha-mat-pho',
                'thumbnail' => '',
                'parent_id' => $leaseHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cho thuê nhà trọ, phòng trọ',
                'slug' => 'cho-thue-nha-tro-phong-tro',
                'thumbnail' => '',
                'parent_id' => $leaseHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cho thuê văn phòng',
                'slug' => 'cho-thue-van-phong',
                'thumbnail' => '',
                'parent_id' => $leaseHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cho thuê cửa hàng, ki ốt',
                'slug' => 'cho-thue-cua-hang-ki-ot',
                'thumbnail' => '',
                'parent_id' => $leaseHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cho thuê kho, nhà xưởng, đất',
                'slug' => 'cho-thue-kho-nha-xuong-dat',
                'thumbnail' => '',
                'parent_id' => $leaseHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cho thuê loại bất động sản khác',
                'slug' => 'cho-thue-loai-bat-dong-san-khac',
                'thumbnail' => '',
                'parent_id' => $leaseHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Mua căn hộ chung cư',
                'slug' => 'mua-can-ho-chung-cu',
                'thumbnail' => '',
                'parent_id' => $buyHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mua nhà riêng',
                'slug' => 'mua-nha-rieng',
                'thumbnail' => '',
                'parent_id' => $buyHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mua nhà biệt thự, liền kề',
                'slug' => 'mua-nha-biet-thu-lien-ke',
                'thumbnail' => '',
                'parent_id' => $buyHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mua nhà mặt phố',
                'slug' => 'mua-nha-mat-pho',
                'thumbnail' => '',
                'parent_id' => $buyHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mua đất nền dự án',
                'slug' => 'mua-dat-nen-du-an',
                'thumbnail' => '',
                'parent_id' => $buyHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mua đất',
                'slug' => 'mua-dat',
                'parent_id' => $buyHouse->id,
                'thumbnail' => '',
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mua trang trại, khu nghỉ dưỡng',
                'slug' => 'mua-trang-trai-khu-nghi-duong',
                'thumbnail' => '',
                'parent_id' => $buyHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mua kho, nhà xưởng',
                'slug' => 'mua-kho-nha-xuong',
                'thumbnail' => '',
                'parent_id' => $buyHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mua loại bất động sản khác',
                'slug' => 'mua-loai-bat-dong-san-khac',
                'thumbnail' => '',
                'parent_id' => $buyHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'name' => 'Cần thuê căn hộ chung cư',
                'slug' => 'can-thue-can-ho-chung-cu',
                'thumbnail' => '',
                'parent_id' => $needEmployHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cần thuê nhà riêng',
                'slug' => 'can-thue-nha-rieng',
                'thumbnail' => '',
                'parent_id' => $needEmployHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cần thuê nhà mặt phố',
                'slug' => 'can-thue-nha-mat-pho',
                'thumbnail' => '',
                'parent_id' => $needEmployHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cần thuê nhà trọ, phòng trọ',
                'slug' => 'can-thue-nha-tro-phong-tro',
                'thumbnail' => '',
                'parent_id' => $needEmployHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cần thuê văn phòng',
                'slug' => 'can-thue-van-phong',
                'thumbnail' => '',
                'parent_id' => $needEmployHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cần thuê cửa hàng, ki ốt',
                'slug' => 'can-thue-cua-hang-ki-ot',
                'thumbnail' => '',
                'parent_id' => $needEmployHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cần thuê kho, nhà xưởng, đất',
                'slug' => 'can-thue-kho-nha-xuong-dat',
                'thumbnail' => '',
                'parent_id' => $needEmployHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cần thuê loại bất động sản khác',
                'slug' => 'can-thue-loai-bat-dong-san-khac',
                'thumbnail' => '',
                'parent_id' => $needEmployHouse->id,
                'destination_entity' => Post::class,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];
        DB::table('categories')->insert($data);
    }
}
