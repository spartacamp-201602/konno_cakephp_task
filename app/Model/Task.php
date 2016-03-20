<?php

class Task extends AppModel {

    // アソシエーション設定
    public $hasMany = ['Note'];

    public $validate = [
        'name' => [
                    'rule' => ['between', 5, 30],
                    'message' => 'タスクは5文字以上30文字以内で入力してください。'
                  ],
        'body' => [
                    'rule' => ['maxLength', 255],
                    'message' => '詳細は255文字以内で入力してください。'
                  ]
        ];
}