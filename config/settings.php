<?php

return [
    'image_system' => '/user/images/',
    'image_user_default' => '/templates/survey/images/default_user.png',
    'background_profile' => '/templates/survey/images/background_profile.jpg',
    'image_default' => 'questionDefault.png',
    'image_path' => '/image/',
    'image_question_path' => '/user/uploads/question/',
    'image_answer_path' => '/user/uploads/answer/',
    'image_path_system' => '/user/images/',
    'path_upload' => 'public/uploads/',
    'path_upload_image' => 'public/uploads/images',
    'path_upload_avatar' => 'public/uploads/avatars',
    'cover-profile' => [
        'default' => 'templates/survey/images/cover-profile.jpg',
        '1' => 'templates/survey/images/cover-profile1.jpg',
        '2' => 'templates/survey/images/cover-profile2.jpg',
        '3' => 'templates/survey/images/cover-profile3.jpg',
        '4' => 'templates/survey/images/cover-profile4.jpg',
        '5' => 'templates/survey/images/cover-profile5.jpg',
        '6' => 'templates/survey/images/cover-profile6.jpg',
        '7' => 'templates/survey/images/cover-profile7.jpg',
        '8' => 'templates/survey/images/cover-profile8.jpg',
    ],
    'choose-cover-profile' => [
        'default' => 'templates/survey/images/choose-cover-profile.jpg',
        '1' => 'templates/survey/images/choose-cover-profile1.jpg',
        '2' => 'templates/survey/images/choose-cover-profile2.jpg',
        '3' => 'templates/survey/images/choose-cover-profile3.jpg',
        '4' => 'templates/survey/images/choose-cover-profile4.jpg',
        '5' => 'templates/survey/images/choose-cover-profile5.jpg',
        '6' => 'templates/survey/images/choose-cover-profile6.jpg',
        '7' => 'templates/survey/images/choose-cover-profile7.jpg',
        '8' => 'templates/survey/images/choose-cover-profile8.jpg',
    ],
    'question' => [
        'not_required' => 0,
        'required' => 1,
    ],
    'paginate' => 9,
    'type_answer' => [
        'radiobutton' => '1',
        'checkbox' => '2',
        'textfield' => '3',
        'selectbox' => '4',
    ],
    'result' => [
        'success' => 'true',
        'fail' => 'false',
    ],
    'feature' => 1,
    'not_feature' => 0,
    'mark' => 1,
    'unmark' => 0,
    'google' => 'google',
    'facebook' => 'facebook',
    'twitter' => 'twitter',
    'framgia' => 'framgia',
    'replace' => 'survey/result/',
    'required' => [
        'true' => 1,
        'false' => 0,
    ],
    'return' => [
        'bool' => 0,
        'view' => 1,
    ],
    'locale' => [
        'en',
        'vn',
        'jp',
    ],
    'language' => [
        'en' => 'English',
        'vn' => 'Việt Nam',
        'jp' => '日本語',
    ],
    'options' => [
        1,
        2,
        3,
    ],
    'key' => [
        'requireAnswer' => 1,
        'limitAnswer' => 2,
        'hideResult' => 3,
        'requireOnce' => 4,
        'tailMail' => 5,
        'reminder' => 6,
    ],
    'require' => [
        'email' => 1,
        'name' => 2,
        'both' => 3,
        'loginWsm' => 4,
    ],
    'reminder' => [
        'week' => 1,
        'month' => 2,
        'quarter' => 3,
    ],
    'listKey' => [
        1,
        2,
        3,
        4,
        5,
        6,
    ],
    'email_unidentified' => 0,
    'name_unidentified' => 0,
    'content_length_default' => 50,
    'name_length_default' => 10,
    'sameFormatDateTime' => [
        'en',
        'jp',
    ],
    'title_length_default' => 20,
    'max_limit' => 10,
    'cookie' => [
        'timeout' => [
            'one_day' => 1440,
        ],
    ],
    'company' => [
        'fb_company' => 'https://www.facebook.com/FramgiaVietnam/?fref=ts',
        'github_company' => 'https://github.com/framgia',
        'linkedin_company' => 'https://www.linkedin.com/company/framgia-vietnam',
        'tools_company' => 'http://wsm.framgia.vn/all-tools',
        'hr_email_company' => 'hr_team@framgia.com',
    ],
    'public_template' => '/templates/survey/',
    'plugins' => '/plugins/',
    'logo_content' => '<span class="highlight">F</span>Survey',
    'counter_default_value' => 0,
    'feature_icon' => [
        'icon_1' => '/templates/survey/images/icon/about1.png',
        'icon_2' => '/templates/survey/images/icon/about2.png',
        'icon_3' => '/templates/survey/images/icon/about3.jpg',
    ],
    'blank_icon' => '/templates/survey/images/icon/blank.gif',
    'page_profile_active' => [
        'information' => '1',
        'list_survey' => '2',
    ],
    'vn' => 'vn',
    'fsurvey' => 'FSurvey',
    'max_size_image' => 5120,
    'quantity_answer' => [
        'default' => 1,
        'min' => 1,
        'max' => 10,
    ],

    /**
     * Survey settings
     */

    'survey' => [
        'status' => [
            'block' => 0,
            'public' => 1,
            'private' => 2,
            'draft' => 3,
        ],
        'feature' => [
            'default' => 1,
        ],
        'invite_status' => [
            'not_finish' => 0,
            'finished' => 1,
        ],
        'section_update' => [
            'default' => 0,
        ],
        'question_update' => [
            'default' => 0,
        ],
        'answer_update' => [
            'default' => 0,
        ],
        'option' => [
            'first' => 1,
        ],
    ],
    'question_type' => [
        'short_answer' => 1,
        'long_answer' => 2,
        'multiple_choice' => 3,
        'checkboxes' => 4,
        'date' => 5,
        'time' => 6,
        'title' => 7,
        'image' => 8,
        'video' => 9,
    ],
    'survey_setting' => [
        'answer_required' => [
            'none' => 0,
            'login' => 1,
            'login_with_wsm' => 2,
        ],
        'answer_unlimited' => 0,
        'reminder_email' => [
            'none' => 0,
            'by_week' => 1,
            'by_month' => 2,
            'by_quarter' => 3,
        ],
        'privacy' => [
            'public' => 0,
            'private' => 1,
        ],
    ],
    'answer_type' => [
        'option' => 1,
        'other_option' => 2,
    ],
    'question_require' => [
        'no_require' => 0,
        'require' => 1,
    ],

    /**
     * Media settings
     */

    'media_type' => [
        'image' => 1,
        'video' => 2,
    ],

    /**
     * Settings type
     */

    'setting_type' => [
        'answer_required' => [
            'content' => 'answer_required',
            'key' => 1,
        ],
        'answer_limited' => [
            'content' => 'answer_limited',
            'key' => 2,
        ],
        'reminder_email' => [
            'content' => 'reminder_email',
            'key' => 3,
        ],
        'privacy' => [
            'content' => 'privacy',
            'key' => 4,
        ],
        'question_type' => [
            'content' => 'question_type',
            'key' => 5,
        ],
        'answer_type' => [
            'content' => 'answer_type',
            'key' => 6,
        ],
    ],
];
