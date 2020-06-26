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
                    'route_name' => '',
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
                ]
            ],
        ],
        [
            'heading' => 'Quản lý tin tức',
            'items' => [
                [
                    'route_name' => '',
                    'label' => 'Đăng tin tức'
                ],
                [
                    'route_name' => '',
                    'label' => 'Xem các tin đã đăng'
                ],
                [
                    'route_name' => '',
                    'label' => 'Tin tức đang đợi duyệt'
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
