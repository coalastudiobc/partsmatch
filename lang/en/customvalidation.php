<?php

use Symfony\Contracts\Service\Attribute\Required;

return [
    'login' => [
        'email' => [
            'required' => 'Please enter email',
            'email' => 'This is not a valid email address',
            'regex' => 'Please enter the valid email address',
        ],
        'password' => [
            'required' => 'Please enter the password',
            'min' => 'Password can be :min - :max characters',
            'max' => 'Password can be :min - :max characters',
            'regex' => 'Password can be alphanumeric and (@#$%^&*) these special characters *At least one uppercase *One lowercase *One numeric',

        ],
        'password_confirmation' => [
            'required' => 'Please enter the confirmation password',
            'equalTo' => 'confoirm password does not match'
        ]
    ],

    'change_password' => [
        'old_password' => [
            'required' => 'Please enter the old password',
            'min' => 'Password can be :min - :max characters',
            'max' => 'Password can be :min - :max characters',
            'regex' => 'Enter a valid password',

        ],
        'password' => [
            'required' => 'Please enter the new password',
            'min' => 'Password can be :min - :max characters',
            'max' => 'Password can be :min - :max characters',
            'regex' => 'Password can be alphanumeric and (@#$%^&*) these special characters *At least one uppercase *One lowercase *One numeric',

        ],
        'confirm_password' => [
            'required' => 'Please enter the confirm password',
            'equal' => 'Confirm password not match',

        ],
    ],
    'stripe_settings' => [
        'stripe_key' => [
            'required' => 'Please enter the stripe id',
        ],
        'secret_key' => [
            'required' => 'Please enter the secret key',
        ],
        'webhook_secret' => [
            'required' => 'Please enter the webhook secret',
        ],
    ],
    'advertisement' => [
        'name' => [
            'required' => 'Please enter the name',
            'min' => 'Name can be :min - :max characters',
            'max' => 'Name can be :min - :max characters',
            'regex' => 'Only alphabets and in between space are allowed',
        ],
        'advertisement' => [
            'required' => 'Please enter the Advertisement',
        ],
    ],

    'admin' => [
        'name' => [
            'required' => 'Please enter the name',
            'min' => 'Name can be :min - :max characters',
            'max' => 'Name can be :min - :max characters',
            'regex' => 'Only alphabets and in between space are allowed',
        ],
        'phone_number' => [
            'required' => 'Please enter the phone number',
            'digits' => 'Phone number must be of :digits',
            'phoneUS' => 'Phone number must be of :digits digits',
        ],
        'email' => [
            'required' => 'Please enter your email',
            'email' => 'This is not a valid email address',
            'regex' => 'Please enter the valid email address',
        ],
        'profile_pic' => [
            'required' => 'Please upload your profile picture',
            'size' => 'File size should not be greater than 2 MB',
            'mimes' => 'Supported only JPEG, JPG, PNG file type'
        ],
    ],
    'admin_setting' => [
        'amount' => [
            'required' => 'Please enter the Amount',
            'min' => 'Amount can be :min - :max characters',
            'max' => 'Amount can be :min - :max characters',
            'numeric' => 'Only numerics are allowed',
        ],
        'commission_amount' => [
            'required' => 'Please enter the Amount',
            'min' => 'Amount can be :min - :max characters',
            'max' => 'Amount can be :min - :max characters',
            'numeric' => 'Only numerics are allowed',
        ],
    ],
    'profile' => [
        'name' => [
            'required' => 'Please enter the name',
            'min' => 'Name can be :min - :max characters',
            'max' => 'Name can be :min - :max characters',
            'regex' => 'Only alphabets and in between space are allowed',
        ],
        'email' => [
            'required' => 'Please enter your email',
            'email' => 'This is not a valid email address',
            'regex' => 'Please enter the valid email address',
        ],
        'profile_pic' => [
            'required' => 'Please upload your profile picture',
            'size' => 'File size should not be greater than 2 MB',
            'mimes' => 'Supported only JPEG, JPG, PNG file type'
        ],
    ],

    'category' => [
        'title' => [
            'required' => 'Please enter the category Title',
            'unique' => 'Title is already taken',
            'min' => 'Title can be :min - :max characters',
            'max' => 'Title can be :min - :max characters',
            'regex' => 'Only alphabets and in between space are allowed',
            'string' => 'Only alphabets in between space are allowed',
        ],
        'description' => [
            'required' => 'Please enter the description',
            'string' => 'Only alphabets, numbers and in between space are allowed',
        ],
    ],
    'commission' => [
        'ordercommission_type' => [
            'required' => 'Please select the order commission type',
        ],
        'ordercommission' => [
            'required' => 'Please enter the oder commission',
        ],
    ],
    'hashtags' => [
        'title' => [
            'required' => 'Please enter the hashtag Title',
            'unique' => 'Title is already taken',
            'min' => 'Title can be :min - :max characters',
            'max' => 'Title can be :min - :max characters',
            'regex' => 'Only alphabets and in between space are allowed',
            'string' => 'Only alphabets in between space are allowed',
        ],
        'description' => [
            'required' => 'Please enter the description',
            'string' => 'Only alphabets, numbers and in between space are allowed',
        ],
    ],
    'cms' => [
        'name' => [
            'required' => 'Please enter the name',
            'min' => 'Name can be :min - :max characters',
            'max' => 'Name can be :min - :max characters',
        ],
        'slug' => [
            'required' => 'Please enter the slug',
            'min' => 'Slug can be :min - :max characters',
            'max' => 'Slug can be :min - :max characters',
        ],
        'content' => [
            'required' => 'Please enter the content',
            'min' => 'Content can be :min - :max characters',
        ],
        'short_content' => [
            'min' => 'Short content can be :min - :max characters',
            'max' => 'Short content can be :min - :max characters',
        ],
        'page_title' => [
            'min' => 'Page title can be :min - :max characters',
            'max' => 'Page title can be :min - :max characters',
        ],
        'meta_title' => [
            'min' => 'Meta title can be :min - :max characters',
            'max' => 'Meta title can be :min - :max characters',
        ],
        'meta_description' => [
            'min' => 'Meta description can be :min - :max characters',
        ],
        'status' => [
            'required' => 'Status field is required',
        ],
        'image' => [
            'size' => 'Image size should not be greater than :min MB',
            'mimes' => 'Supported only JPEG, JPG, PNG image type'
        ],
    ],

    'user' => [
        'name' => [
            'required' => 'Please enter the name',
            'min' => 'Name can be :min - :max characters',
            'max' => 'Name can be :min - :max characters',
            'string' => 'Only alphabets and in between space are allowed in Name ',
            'regex' => 'Only alphabets and in between space are allowed in Name',

        ],
        'email' => [
            'required' => 'Please enter your email',
            'email' => 'This is not a valid email address',
            'regex' => 'Please enter the valid email address',
            'unique' => 'Please enter the unique email',
        ],
        'address' => [
            'required' => 'Please enter your address',
        ],
        'phone_number' => [
            'required' => 'Please enter the phone number',
            'digits' => 'Phone number must be of :digits',
            'phoneUS' => 'Phone number must be of :digits digits',
        ],
        'industry_type' => [
            'required' => 'Please enter the industry type',
        ],
        'bio' => [
            'min' => 'Bio can be :min - :max characters',
            'max' => 'Bio can be :min - :max characters',
            'string' => 'Enter a valid String in Bio',
        ],
        'username' => [
            'required' => 'Please enter the username',
            'unique' => 'This username is not avaliable',
            'min' => 'Username can be :min - :max characters',
            'max' => 'Username can be :min - :max characters',
            'string' => 'Only alphabets,numbers and in between space are allowed',
            'regex' => 'Only alphabets, numbers and in between space are not allowed',

        ],
        'password' => [
            'required' => 'Please enter the password',
            'min' => 'Password can be :min - :max characters',
            'max' => 'Password can be :min - :max characters',
            'regex' => "Password can be alphanumeric and (@#$%^&*) these special characters *At least one uppercase *One lowercase *One numeric",

        ],
        'confirm_password' => [
            'required' => 'Please enter the confirm password',
            'equal' => 'Password and confirm password must be same',

        ],
        'profile_pic' => [
            'size' => 'File size should not be greater than :min MB',
            'mimes' => 'Supported only JPEG, JPG, PNG file type',
            'file' => 'filenot supported',
        ],
        'cover_pic' => [
            'size' => 'File size should not be greater than :min MB',
            'mimes' => 'Supported only JPEG, JPG, PNG file type',
            'file' => 'filenot supported',
        ],
        'country' => [
            'required' => 'Please select country',
        ],
        'terms' => [
            'required' => 'Please check terms & condition',
        ],

    ],

    'media' => [
        'name' => [
            'required' => 'Please enter the name',
            'string' => 'name must be a valid string',
            'min' => 'Name can be :min - :max characters',
            'max' => 'Name can be :min - :max characters',
        ],
        'media_file' => [
            'required' => 'Please upload  media file',
            'size' => 'File size should not be greater than :min MB',
            'mimes' => 'Supported only JPEG, JPG, PNG ,WMV,AVI,MOV,3GP,MP4 file type'
        ],
        'type' => [
            'required' => 'Please enter the rejection reason',
            'string' => 'Only alphabets and in between space are allowed',
        ],
    ],

    'package' => [
        'timeduration' => [
            'required' => 'Please enter the time duration',
        ],
        'timetype' => [
            'required' => 'Please select the time type',
        ],
        'description' => [
            'min' => 'Description can be :min - :max characters',
            'max' => 'Description can be :min - :max characters',
        ],
    ],

    'packageprice' => [
        'category' => [
            'required' => 'Please select any category',
        ],
        'price' => [
            'required' => 'Please enter price',
        ],
    ],

    'creator_post' => [
        'user' => [
            'required' => 'Please select creator',
        ],
        'post_title' => [
            'required' => 'Please enter post title',
            'min' => 'Post title should be :min - :max characters',
            'max' => 'Post title should be :min - :max characters',
        ],
        'dropzone_medias'   =>  "Please upload post's media",
        'group_id'          =>  [
            'required'  =>  'Please select group'
        ]
    ],

    'content_creator' => [
        'price' => [
            'required' => 'Please enter price',
            'number' => 'Please enter number only',
        ],
        'stripe_country' => [
            'required' => 'Please select stripe account country'
        ],
        'category' => [
            'required' => 'Please select category'
        ],
        'account_name' => [
            'required' => 'Please enter first name'
        ],
        'account_lname' => [
            'required' => 'Please enter last name'
        ],
        'dob' => [
            'required' => 'Please enter date of birth'
        ],
        'address' => [
            'required' => 'Please enter address'
        ],
        'city' => [
            'required' => 'Please enter city'
        ],
        'postalcode' => [
            'required' => 'Please enter postal code'
        ],
        'state' => [
            'required' => 'Please enter state'
        ],
        'accountnumber' => [
            'required' => 'Please enter account number',
            'min' => 'account number should be :min - :max digits',
            'max' => 'account number should be :min - :max digits',
        ],
        'routingnumber' => [
            'required' => 'Please enter routing number',
            'min' => 'routing number should be :min - :max digits',
            'max' => 'routing number should be :min - :max digits',
        ],
    ],
    'approve_creator'   =>  [
        'price' =>  [
            'required'  =>  'Price is required',
            'numeric'   =>  'Invalid devotee price'
        ],
        'category_id' =>  [
            'required'  =>  'Category is required'
        ]
    ],
    'comment' => [
        'commentfield' => [
            'required' => 'Please enter the comment',
            'regex' => 'please enter a valid string'
        ]
    ],
    'group' => [
        'group_image' => [
            'required' => 'Please upload your group picture',
        ],
        'group_name' => [
            'required' => 'Please enter group name',
        ]
    ],

    'index' => [
        'uploadFile' => [
            'required' => 'Please upload pdf file',
            'mimes' => 'Supported only pdf file type',
            'size' => 'File size should not be greater than :max MB',
        ],
    ],
    'blog' => [
        'title' => [
            'required' => 'Please enter the Title',
            'min' => 'Title can be :min - :max characters',
            'max' => 'Title can be :min - :max characters',
        ],
        'description' => [
            'required' => 'Please enter the Description',
            'min' => 'Content can be :min - :max characters',
        ],
        'short_content' => [
            'required' => 'Please enter the Short content',
            'min' => 'Content can be :min - :max characters',
        ],
        'media_url' => [
            'required' => 'Image is required',
            'size' => 'Image size should not be greater than :min MB',
            'mimes' => 'Supported only JPEG, JPG, PNG image type'
        ],
        'banner_url' => [
            'required' => 'Banner image is required',
            'size' => 'Banner image size should not be greater than :min MB',
            'mimes' => 'Supported only JPEG, JPG, PNG image type'
        ],

    ]
];
