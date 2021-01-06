<?php

function personalMenuItemsDefinition()
{
    return [
        [
            'heading' => 'Quản lý thông tin cá nhân',
            'items' => [
                [
                    'route_name' => 'pages.user.info',
                    'label' => 'Thay đổi thông tin cá nhân'
                ],
                [
                    'route_name' => 'pages.user.change_password',
                    'label' => 'Thay đổi mật khẩu'
                ]
            ],
        ],
        [
            'heading' => 'Quản lý tin rao',
            'items' => [
                [
                    'route_name' => 'posts.list_sell',
                    'label' => 'Quản lý tin rao bán/cho thuê'
                ],
                [
                    'route_name' => 'posts.create_sell',
                    'label' => 'Đăng tin rao bán/cho thuê'
                ],
                [
                    'route_name' => 'posts.list_buy',
                    'label' => 'Quản lý tin cần mua/cần thuê'
                ],
                [
                    'route_name' => 'posts.create_buy',
                    'label' => 'Đăng tin cần mua/cần thuê'
                ],
            ],
        ],
        [
            'heading' => 'Quản lý dự án',
            'items' => [
                [
                    'route_name' => 'pages.project.create',
                    'label' => 'Đăng dự án',
                    'permission' => 'pages.project.create'
                ],
                [
                    'route_name' => 'pages.project.show_posted',
                    'label' => 'Quản lý dự án đã đăng',
                    'permission' => 'pages.project.show_posted'
                ],
                [
                    'route_name' => 'pages.project.awaiting_review',
                    'label' => 'Xem dự án đang đợi duyệt',
                    'permission' => 'pages.project.awaiting_review'
                ],
                [
                    'route_name' => 'pages.investor.create',
                    'label' => 'Đăng thông tin chủ đầu tư',
                    'permission' => 'pages.investor.create'
                ],
                [
                    'route_name' => 'pages.investor.posted',
                    'label' => 'Quản lý chủ đầu tư đã đăng',
                    'permission' => 'pages.investor.posted'
                ]
            ],
        ],
        [
            'heading' => 'Quản lý tin tức',
            'items' => [
                [
                    'route_name' => 'news.create',
                    'label' => 'Đăng tin tức',
                    'permission' => 'news.create'
                ],
                [
                    'route_name' => 'pages.user.news',
                    'label' => 'Tin tức đã đăng',
                    'permission' => 'pages.user.news'
                ],
                [
                    'route_name' => 'pages.user.approve_news',
                    'label' => 'Tin tức đang đợi duyệt',
                    'permission' => 'pages.user.approve_news'
                ]
            ],
        ],
        // [
        //     'heading' => 'Quản lý sản phẩm',
        //     'items' => [
        //         [
        //             'route_name' => 'news.create',
        //             'label' => 'Đăng sản phẩm',
        //             'permission' => 'news.create'
        //         ],
        //         [
        //             'route_name' => 'pages.user.news',
        //             'label' => 'Quản lý sản phẩm đã đăng',
        //             'permission' => 'pages.user.news'
        //         ]
        //     ],
        // ],
        [
            'heading' => 'Quản lý thành viên',
            'items' => [
                [
                    'route_name' => 'admin.index',
                    'label' => 'Danh sách thành viên',
                    'permission' => 'admin.index'
                ]
            ],
        ]
    ];
}

function getAllItemsHasPermission($items)
{
    $hasPermissionItems = [];

    foreach ($items as $item) {
        if (!isset($item['permission']) || checkPermission($item['permission'])) {
            $hasPermissionItems[] = $item;
        }
    }

    return $hasPermissionItems;
}
