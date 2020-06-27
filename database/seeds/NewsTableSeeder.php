<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('news')->delete();

        \DB::table('news')->insert([
            [
                'title' => 'Trải nghiệm du lịch hoàn hảo tại "trái tim" TP.Phan Thiết', 
                'slug' => 'trai-nghiem-du-lich-hoan-hao-tai-trai-tim-tp-phan-thiet',
                'meta_content' => 'Với cảnh quan thiên nhiên tuyệt đẹp, khí hậu trong lành, hạ tầng giao thông hoàn thiện, Phan Thiết hứa hẹn trở thành điểm đến du lịch hàng đầu Châu Á.',
                'content' => 'Với cảnh quan thiên nhiên tuyệt đẹp, khí hậu trong lành, hạ tầng giao thông hoàn thiện, Phan Thiết hứa hẹn trở thành điểm đến du lịch hàng đầu Châu Á.',
                'thumbnail' => 'https://file4.batdongsan.com.vn/2020/06/25/b9sp0zUm/20200625161704-a87b.jpg',
                'status' => 3,
                'category_id' => 1,
                'user_id' => 1,
                'created_at' => '2020-06-25 07:05:45',
                'updated_at' => '2020-06-25 07:05:45',
            ],
            [
                'title' => 'Thiết lập "sân chơi" minh bạch, chuyên nghiệp, an toàn cho nhân viên môi giới', 
                'slug' => 'thiet-lap-san-choi-minh-bach-chuyen-nghiep-an-toan-cho-nhan-vien-moi-gioi',
                'meta_content' => 'Thiết lập "sân chơi" minh bạch, chuyên nghiệp, an toàn cho nhân viên môi giới',
                'content' => 'Hơn 80% giao dịch bất động sản trên thị trường được thực hiện thông qua các nhà môi giới. Đây là con số cho thấy sự đóng góp quan trọng của đội ngũ môi giới với thị trường bất động sản. Vì thế để có một thị trường chuyên nghiệp, cần phải tạo ra một "sân chơi" minh bạch, an toàn cho nhân viên môi giới.',
                'thumbnail' => 'https://file4.batdongsan.com.vn/2020/06/24/b9sp0zUm/20200624110900-8a8e.jpg',
                'status' => 2,
                'category_id' => 2,
                'user_id' => 1,
                'created_at' => '2020-06-25 07:05:45',
                'updated_at' => '2020-06-25 07:05:45',
            ],
            [
                'title' => 'Nhà đầu tư bất động sản đặc biệt quan tâm tới thị trường Hà Nội', 
                'slug' => 'nha-dau-tu-bat-dong-san-dac-biet-quan-tam-toi-thi-truong-ha-noi',
                'meta_content' => 'Nhà đầu tư bất động sản đặc biệt quan tâm tới thị trường Hà Nội',
                'content' => 'Trong con mắt các nhà đầu tư bất động sản, thị trường Hà Nội có sức hút riêng biệt nhờ sự phát triển nhanh chóng của cơ sở hạ tầng với hệ thống tàu điện ngầm, cầu, và đường sá xung quanh thành phố. Nguồn cung các dự án bất động sản hiện đại của thủ đô đang tăng lên và nhiều chủ đầu tư trong nước tích cực tập trung cung cấp ra thị trường các bất động sản tiêu chuẩn quốc tế.',
                'thumbnail' => 'https://file4.batdongsan.com.vn/2020/06/22/wxbwknn6/20200622091744-c6a0.jpg',
                'status' => 1,
                'category_id' => 3,
                'user_id' => 1,
                'created_at' => '2020-06-25 07:05:45',
                'updated_at' => '2020-06-25 07:05:45',
            ],
            [
                'title' => 'Phê duyệt nhiệm vụ lập quy hoạch tỉnh Hưng Yên', 
                'slug' => 'phe-duyet-nhiem-vu-lap-quy-hoach-tinh-hung-yen',
                'meta_content' => 'Phê duyệt nhiệm vụ lập quy hoạch tỉnh Hưng Yên',
                'content' => 'Nhiệm vụ lập Quy hoạch tỉnh Hưng Yên thời kỳ 2021-2030, tầm nhìn đến năm 2050 vừa được Phó Thủ tướng Trịnh Đình Dũng phê duyệt.',
                'thumbnail' => 'https://file4.batdongsan.com.vn/2020/06/25/zk7ggeWN/20200625090039-2f01.jpg',
                'status' => 3,
                'category_id' => 4,
                'user_id' => 1,
                'created_at' => '2020-06-25 07:05:45',
                'updated_at' => '2020-06-25 07:05:45',
            ],
            [
                'title' => 'Bản đồ những tỷ phú bất động sản giàu nhất hành tinh', 
                'slug' => 'ban-do-nhung-ty-phu-bat-dong-san-giau-nhat-hanh-tinh',
                'meta_content' => 'Bản đồ những tỷ phú bất động sản giàu nhất hành tinh',
                'content' => 'Mới đây, trang tin tức bất động sản propertywire của Anh đã tổng hợp và công bố danh sách 10 tỷ phú bất động sản thành công nhất cùng thông tin về danh mục đầu tư của họ trên bản đồ thế giới.',
                'thumbnail' => 'https://file4.batdongsan.com.vn/2020/06/24/akCJKkFO/20200624114305-b036.jpg',
                'status' => 2,
                'category_id' => 5,
                'user_id' => 1,
                'created_at' => '2020-06-25 07:05:45',
                'updated_at' => '2020-06-25 07:05:45',
            ]
        ]);
    }
}
