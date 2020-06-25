<?php

function personalMenuItemsDefinition()
{
    return [
        [
            'heading' => 'Quản lý thông tin cá nhân',
            'items' => [
                [
                    'link' => '',
                    'label' => 'Thay đổi thông tin cá nhân'
                ],
                [
                    'link' => '',
                    'label' => 'Thay đổi mật khẩu'
                ]
            ],
        ],
        [
            'heading' => 'Quản lý tin rao',
            'items' => [
                [
                    'link' => '',
                    'label' => 'Quản lý tin rao bán/cho thuê'
                ],
                [
                    'link' => '',
                    'label' => 'Đăng tin rao bán/cho thuê'
                ],
                [
                    'link' => '',
                    'label' => 'Quản lý tin cần mua/cần thuê'
                ],
                [
                    'link' => '',
                    'label' => 'Đăng tin cần mua/cần thuê'
                ],
                [
                    'link' => '',
                    'label' => 'Quản lý tin nháp'
                ]
            ],
        ],
        [
            'heading' => 'Quản lý dự án',
            'items' => [
                [
                    'link' => route('pages.project.create'),
                    'label' => 'Đăng dự án',
                    'permission' => 'pages.project.create'
                ]
            ],
        ],
        [
            'heading' => 'Quản lý tin tức',
            'items' => [
                [
                    'link' => '',
                    'label' => 'Đăng tin tức'
                ],
                [
                    'link' => '',
                    'label' => 'Xem các tin đã đăng'
                ],
                [
                    'link' => '',
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
