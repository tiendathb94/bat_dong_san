<?php

use Illuminate\Database\Seeder;
use App\Entities\Project;

class ProjectCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!\DB::table('categories')->where('destination_entity', Project::class)->get()) {
            \DB::table('categories')->insert([
                ['created_at' => '2020-06-23 16:33:02', 'updated_at' => '2020-06-23 16:33:02', 'name' => 'Căn hộ, Chung cư', 'slug' => 'can-ho-chung-cu', 'destination_entity' => Project::class],
                ['created_at' => '2020-06-23 16:33:02', 'updated_at' => '2020-06-23 16:33:02', 'name' => 'Cao ốc văn phòng', 'slug' => 'cao-oc-van-phong', 'destination_entity' => Project::class],
                ['created_at' => '2020-06-23 16:33:02', 'updated_at' => '2020-06-23 16:33:02', 'name' => 'Trung tâm thương mại', 'slug' => 'trung-tam-thuong-mai', 'destination_entity' => Project::class],
                ['created_at' => '2020-06-23 16:33:02', 'updated_at' => '2020-06-23 16:33:02', 'name' => 'Khu đô thị mới', 'slug' => 'khu-do-thi-moi', 'destination_entity' => Project::class],
                ['created_at' => '2020-06-23 16:33:02', 'updated_at' => '2020-06-23 16:33:02', 'name' => 'Khu phức hợp', 'slug' => 'khu-phuc-hop', 'destination_entity' => Project::class],
                ['created_at' => '2020-06-23 16:33:02', 'updated_at' => '2020-06-23 16:33:02', 'name' => 'Nhà ở xã hội', 'slug' => 'nha-o-xa-hoi', 'destination_entity' => Project::class],
                ['created_at' => '2020-06-23 16:33:02', 'updated_at' => '2020-06-23 16:33:02', 'name' => 'Khu nghỉ dưỡng, Sinh thái', 'slug' => 'khu-nghi-duong-sinh-thai', 'destination_entity' => Project::class],
                ['created_at' => '2020-06-23 16:33:02', 'updated_at' => '2020-06-23 16:33:02', 'name' => 'Khu công nghiệp', 'slug' => 'khu-cong-nghiep', 'destination_entity' => Project::class],
                ['created_at' => '2020-06-23 16:33:02', 'updated_at' => '2020-06-23 16:33:02', 'name' => 'Dự án khác', 'slug' => 'du-an-khac', 'destination_entity' => Project::class],
                ['created_at' => '2020-06-23 16:33:02', 'updated_at' => '2020-06-23 16:33:02', 'name' => 'Biệt thự, liền kề', 'slug' => 'biet-thu-lien-ke', 'destination_entity' => Project::class],
            ]);
        }
    }
}
