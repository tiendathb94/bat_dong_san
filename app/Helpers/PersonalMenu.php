<?php

function personalMenuItemsDefinition()
{
    return [
        [
            'heading' => 'Quản lý dự án',
            'items' => [
                [
                    'link' => route('pages.project.create'),
                    'label' => 'Đăng dự án',
                    'permission' => 'pages.project.create'
                ]
            ],
        ]
    ];
}

function getAllItemsHasPermission($items)
{
    $hasPermissionItems = [];

    foreach ($items as $item) {
        if (checkPermission($item['permission'])) {
            $hasPermissionItems[] = $item;
        }
    }

    return $hasPermissionItems;
}
