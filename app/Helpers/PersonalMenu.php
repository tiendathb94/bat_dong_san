<?php

function personalMenuItemsDefinition()
{
    return [
        [
            'heading' => 'Quản lý thông tin cá nhân',
            'items' => [
                [
                    'route_name' => '',
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
                    'route_name' => '',
                    'label' => 'Quản lý tin rao bán/cho thuê'
                ],
                [
                    'route_name' => '',
                    'label' => 'Đăng tin rao bán/cho thuê'
                ],
                [
                    'route_name' => '',
                    'label' => 'Quản lý tin cần mua/cần thuê'
                ],
                [
                    'route_name' => '',
                    'label' => 'Đăng tin cần mua/cần thuê'
                ],
                [
                    'route_name' => '',
                    'label' => 'Quản lý tin nháp'
                ]
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
