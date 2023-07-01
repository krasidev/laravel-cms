<?php

return [
    'choose-file' => 'Choose file',
    'backend' => [
        'profile' => [
            'labels' => [
                'name' => 'Name',
                'email' => 'E-Mail Address',
                'current_password' => 'Current Password',
                'password' => 'Password',
                'password_confirmation' => 'Confirm Password'
            ],
            'buttons' => [
                'update' => 'Update',
                'update-password' => 'Update Password'
            ]
        ],
        'google-analytics' => [
            'highchart' => [
                'title' => 'Summary by date',
                'series' => [
                    'visitors' => 'Visitors',
                    'pageviews' => 'Page Views'
                ]
            ],
            'table' => [
                'title' => 'Total data',
                'filters' => [
                    'options' => [
                        'path' => 'All URLs',
                        'continent' => 'All Continents',
                        'language' => 'All Languages',
                        'browser' => 'All Browsers',
                        'device-category' => 'All Device Categories',
                        'operating-system' => 'All Operating Systems'
                    ],
                    'placeholders' => [
                        'start_date' => 'Start Date',
                        'end_date' => 'End Date'
                    ],
                ],
                'headers' => [
                    'id' => 'ID',
                    'date' => 'Date',
                    'path' => 'Path',
                    'title' => 'Title',
                    'continent' => 'Continent',
                    'country' => 'Country',
                    'city' => 'City',
                    'language' => 'Language',
                    'browser' => 'Browser',
                    'device-category' => 'Device Category',
                    'operating-system' => 'Operating System',
                    'version' => 'Version',
                    'visitors' => 'Visitors',
                    'pageviews' => 'Page Views',
                    'created_at' => 'Created At',
                    'updated_at' => 'Updated At'
                ]
            ]
        ],
        'projects' => [
            'table' => [
                'filters' => [
                    'trashed' => [
                        'options' => [
                            'all' => 'All Projects',
                            'deleted' => 'Deleted Projects'
                        ]
                    ]
                ],
                'headers' => [
                    'id' => 'ID',
                    'order' => 'Order',
                    'name' => 'Name',
                    'slug' => 'Slug',
                    'created_at' => 'Created At',
                    'updated_at' => 'Updated At',
                    'deleted_at' => 'Deleted At',
                    'actions' => 'Actions'
                ]
            ],
            'labels' => [
                'name' => 'Name',
                'slug' => 'Slug',
                'url' => 'URL',
                'image' => 'Image',
                'short_description' => 'Short description',
                'description' => 'Description'
            ],
            'buttons' => [
                'store' => 'Create',
                'update' => 'Update',
                'destroy' => 'Delete',
                'restore' => 'Restore'
            ]
        ],
        'users' => [
            'table' => [
                'filters' => [
                    'trashed' => [
                        'options' => [
                            'all' => 'All Users',
                            'deleted' => 'Deleted Users'
                        ]
                    ]
                ],
                'headers' => [
                    'id' => 'ID',
                    'name' => 'Name',
                    'email' => 'E-Mail Address',
                    'created_at' => 'Created At',
                    'updated_at' => 'Updated At',
                    'deleted_at' => 'Deleted At',
                    'actions' => 'Actions'
                ]
            ],
            'labels' => [
                'name' => 'Name',
                'email' => 'E-Mail Address',
                'password' => 'Password',
                'password_confirmation' => 'Confirm Password'
            ],
            'buttons' => [
                'store' => 'Create',
                'update' => 'Update',
                'destroy' => 'Delete',
                'restore' => 'Restore'
            ]
        ]
    ],
    'frontend' => [
        'projects' => [
            'emptyData' => 'No Projects Uploaded'
        ]
    ]
];
