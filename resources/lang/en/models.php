<?php

return [
    'common'           => [
        'order'          => 'Order',
        'id'             => 'ID',
        'actions'        => 'Actions',
        'create'         => 'Create',
        'edit'           => 'Edit',
        'show'           => 'Detail',
        'update'         => 'Update',
        'delete'         => 'Delete',
        'delete-confirm' => 'Are you sure?',
        'cancel'         => 'Cancel',
        'yes'            => 'Yes',
        'no'             => 'No',
        'all'            => 'All',
        'add'            => 'Add',
        'key'            => 'Key',
        'value'          => 'Value',
        'created_at'     => 'Created At',
        'image'          => 'Image',
        'import'         => 'Import',
        'no_answer'      => 'N/A',
    ],
    'admin'            => [
        'email'        => 'E-mail',
        'password'     => 'Password',
        'new_password' => 'New Password',
    ],
    'user'             => [
        'username'             => 'Username',
        'email'                => 'E-mail',
        'password'             => 'Password',
        'new_password'         => 'New Password',
        'name'                 => 'Name',
        'last_login'           => 'Last Login',
        'birthday'             => 'Birthday',
        'thinks_pregnancy'     => 'Thinks Pregnancy',
        'period_reminder'      => 'Period Reminder',
        'sweet_notification'   => 'Sweet Notification',
        'period_length'        => 'Period Length',
        'period_reminder_time' => 'Period Reminder Time',
        'cycle_length'         => 'Cycle Length',
        'weight'               => 'Weight',
        'height'               => 'Height',
        'language'             => 'Language',
        'first_name '          => 'First name',
    ],
    'advice'           => [
        'text'          => 'Text',
        'category'      => 'Category',
    ],
    'category'         => [
        'name'      => 'Name',
        'online'    => 'Online',
        'is_online' => 'Is Online',
        'priority'  => 'Priority',
        'image'     => 'Image',
    ],

    'post'             => [
        'image'       => 'Image',
        'title'       => 'Title',
        'summary'     => 'Summary',
        'content'     => 'Content',
        'public_link' => 'Public link',
        'featured'    => 'Featured',

        'categories' => 'Categories',
    ],
    'question'         => [
        'type'        => 'Type',
        'title'       => 'Title',
        'image'       => 'Image',
        'yes'         => 'Yes',
        'no'          => 'No',
        'expire_date' => 'Expire Date',

        'enum' => [
            'type' => [
                'single_choice'   => 'Single Choice',
                'multiple_choice' => 'Multiple Choice',
                'text'            => 'Text',
                'slider'          => 'Slider',
                'date'            => 'Date',
            ],
        ],
    ],
    'answer'           => [
        'image'   => 'Image',
        'title'   => 'Title',
        'answer'  => 'Answer',
        'message' => 'Message',
    ],
    'pushnotification' => [
        'notification'      => 'Notification',
        'publish_time'      => 'Publish Time',
        'publish_at'        => 'Publish at',
        'notification_type' => 'Notification Type',
        'post'              => 'Post',
        'filter'            => 'Filter',
        'devices'           => 'Devices',
    ],
    'device'           => [
        'device_id'   => 'Device ID',
        'device_type' => 'Device Type',
        'token'       => 'Token',
    ],

    'social'           => [
        'provider'    => 'Provider',
        'provider_id' => 'Provider ID',
    ],
    'questionanswer'   => [
        'question_id'   => 'Question ID',
        'question'      => 'Question',
        'question_type' => 'Question Type',
        'answer'        => 'Answer',
    ],
    'setting'          => [
        'last_version_android'   => 'Android Last Version',
        'update_version_android' => 'Android Update Required Version',
        'last_version_ios'       => 'iOS Last Version',
        'update_version_ios'     => 'iOS Update Required Version',
        'morning_header'         => 'Morning Header',
        'noon_header'            => 'Noon Header',
        'evening_header'         => 'Evening Header',
        'night_header'           => 'Night Header',
    ],
    'language'         => [
        'locale'      => 'Locale',
        'native'      => 'Native',
        'english'     => 'English',
        'is_required' => 'Is Required',
    ],
    'country'          => [
        'name' => 'Name',
        'city' => 'Cities',
    ],
    'city'             => [
        'name' => 'Name',
    ],
    'project'             => [
        'name' => 'Name',
        'description' => 'Description',
    ],
    'permission'             => [
        'name' => 'Name',
    ],
    'feed'             => [
        'project' => 'Project',
        'club' => 'Club',
        'profile' => 'Profile',
    ],
    'classroom'             => [
        'category' => 'Category',
        'name' => 'Name',
        'label' => 'Label',
    ],
];
