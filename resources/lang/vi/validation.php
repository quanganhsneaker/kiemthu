<?php

return [
    'required' => ':attribute không được để trống.',
    'email' => ':attribute phải là một địa chỉ email hợp lệ.',
    'min' => [
        'string' => ':attribute phải có ít nhất :min ký tự.',
    ],
    'max' => [
        'string' => ':attribute không được vượt quá :max ký tự.',
    ],
    'confirmed' => ':attribute xác nhận không khớp.',
    'same' => ':attribute và :other phải giống nhau.',
    'unique' => ':attribute đã được sử dụng.',

    'attributes' => [
        'name' => 'Tên',
        'email' => 'Email',
        'password' => 'Mật khẩu',
        'password_confirmation' => 'Xác nhận mật khẩu',
    ],
];
