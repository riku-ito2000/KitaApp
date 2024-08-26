<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attributeを承認してください。',
    'active_url' => ':attributeが有効なURLではありません。',
    'after' => ':attributeには、:date以降の日付を指定してください。',
    'after_or_equal' => ':attributeには、:date以降の日付を指定してください。',
    'alpha' => ':attributeには、アルファベッドのみ使用できます。',
    'alpha_dash' => ':attributeには、英数字とダッシュ(-)及び下線(_)が使用できます。',
    'alpha_num' => ':attributeには、英数字が使用できます。',
    'array' => ':attributeには、配列を指定してください。',
    'before' => ':attributeには、:date以前の日付を指定してください。',
    'before_or_equal' => ':attributeには、:date以前の日付を指定してください。',
    'between' => [
        'numeric' => ':attributeは、:minから:maxの間で指定してください。',
        'file' => ':attributeは、:min KBから:max KBの間で指定してください。',
        'string' => ':attributeは、:min文字から:max文字の間で指定してください。',
        'array' => ':attributeは、:min個から:max個の間で指定してください。',
    ],
    'boolean' => ':attributeには、trueかfalseを指定してください。',
    'confirmed' => ':attributeと:attribute確認が一致しません。',
    'date' => ':attributeは、正しい日付ではありません。',
    'date_format' => ':attributeの形式は、:formatと一致しません。',
    'different' => ':attributeと:otherには、異なるものを指定してください。',
    'digits' => ':attributeは、:digits桁で指定してください。',
    'digits_between' => ':attributeは、:min桁から:max桁の間で指定してください。',
    'dimensions' => ':attributeの画像サイズが無効です。',
    'distinct' => ':attributeには、異なる値を指定してください。',
    'email' => ':attributeは、有効なメールアドレス形式で指定してください。',
    'ends_with' => ':attributeは、次のいずれかで終わらなければなりません: :values',
    'exists' => '選択された:attributeは、有効ではありません。',
    'failed' => '認証情報が記録と一致しません。',
    'file' => ':attributeは、ファイルでなければなりません。',
    'filled' => ':attributeは、必須です。',
    'gt' => [
        'numeric' => ':attributeは、:valueより大きくなければなりません。',
        'file' => ':attributeは、:value KBより大きくなければなりません。',
        'string' => ':attributeは、:value文字より大きくなければなりません。',
        'array' => ':attributeは、:value個より多くなければなりません。',
    ],
    'gte' => [
        'numeric' => ':attributeは、:value以上でなければなりません。',
        'file' => ':attributeは、:value KB以上でなければなりません。',
        'string' => ':attributeは、:value文字以上でなければなりません。',
        'array' => ':attributeは、:value個以上でなければなりません。',
    ],
    'image' => ':attributeは、画像でなければなりません。',
    'in' => '選択された:attributeは、有効ではありません。',
    'in_array' => ':attributeは、:otherに存在しません。',
    'integer' => ':attributeは、整数でなければなりません。',
    'ip' => ':attributeは、有効なIPアドレスでなければなりません。',
    'ipv4' => ':attributeは、有効なIPv4アドレスでなければなりません。',
    'ipv6' => ':attributeは、有効なIPv6アドレスでなければなりません。',
    'json' => ':attributeは、有効なJSON文字列でなければなりません。',
    'lt' => [
        'numeric' => ':attributeは、:valueより小さくなければなりません。',
        'file' => ':attributeは、:value KBより小さくなければなりません。',
        'string' => ':attributeは、:value文字より小さくなければなりません。',
        'array' => ':attributeは、:value個より少なくなければなりません。',
    ],
    'lte' => [
        'numeric' => ':attributeは、:value以下でなければなりません。',
        'file' => ':attributeは、:value KB以下でなければなりません。',
        'string' => ':attributeは、:value文字以下でなければなりません。',
        'array' => ':attributeは、:value個以下でなければなりません。',
    ],
    'max' => [
        'numeric' => ':attributeは、:max以下でなければなりません。',
        'file' => ':attributeは、:max KB以下でなければなりません。',
        'string' => ':attributeは、:max文字以下でなければなりません。',
        'array' => ':attributeは、:max個以下でなければなりません。',
    ],
    'mimes' => ':attributeは、:valuesタイプのファイルでなければなりません。',
    'mimetypes' => ':attributeは、:valuesタイプのファイルでなければなりません。',
    'min' => [
        'numeric' => ':attributeは、:min以上でなければなりません。',
        'file' => ':attributeは、:min KB以上でなければなりません。',
        'string' => ':attributeは、:min文字以上でなければなりません。',
        'array' => ':attributeは、:min個以上でなければなりません。',
    ],
    'multiple_of' => ':attributeは、:valueの倍数でなければなりません。',
    'not_in' => '選択された:attributeは、有効ではありません。',
    'not_regex' => ':attributeの形式が無効です。',
    'numeric' => ':attributeは、数値でなければなりません。',
    'password' => 'パスワードが間違っています。',
    'present' => ':attributeが存在している必要があります。',
    'regex' => ':attributeの形式が無効です。',
    'required' => ':attributeは、必須です。',
    'required_if' => ':otherが:valueである場合、:attributeは必須です。',
    'required_unless' => ':otherが:valuesにない限り、:attributeは必須です。',
    'required_with' => ':valuesが存在する場合、:attributeは必須です。',
    'required_with_all' => ':valuesが存在する場合、:attributeは必須です。',
    'required_without' => ':valuesが存在しない場合、:attributeは必須です。',
    'required_without_all' => ':valuesのどれも存在しない場合、:attributeは必須です。',
    'same' => ':attributeと:otherは一致しなければなりません。',
    'size' => [
        'numeric' => ':attributeは、:sizeでなければなりません。',
        'file' => ':attributeは、:size KBでなければなりません。',
        'string' => ':attributeは、:size文字でなければなりません。',
        'array' => ':attributeは、:size個含まれていなければなりません。',
    ],
    'starts_with' => ':attributeは、次のいずれかで始まらなければなりません: :values',
    'string' => ':attributeは、文字列でなければなりません。',
    'throttle' => 'ログイン試行回数が多すぎます。:seconds秒後に再試行してください。',
    'timezone' => ':attributeは、有効なタイムゾーンでなければなりません。',
    'unique' => ':attributeは、既に存在します。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'url' => ':attributeの形式が無効です。',
    'uuid' => ':attributeは、有効なUUIDでなければなりません。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'name' => [
            'required' => 'ユーザー名は必須です。',
            'max' => 'ユーザー名は:max文字以内で入力してください。',
        ],
        'email' => [
            'required' => 'メールアドレスは必須です。',
            'email' => '有効なメールアドレスを入力してください。',
            'unique' => 'このメールアドレスは既に登録されています。',
            'max' => 'メールアドレスは:max文字以内で入力してください。',
        ],
        'password' => [
            'required' => 'パスワードは必須です。',
            'min' => 'パスワードは:min文字以上で入力してください。',
            'max' => 'パスワードは:max文字以内で入力してください。',
        ],
    ],



    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    // カスタム属性名の設定
    'attributes' => [
        'name' => 'ユーザー名',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'new_password' => '新しいパスワード',
        'new_password_confirmation' => '新しいパスワード（確認）',
        'title' => 'タイトル',
        'comments' => 'コメント',
        'article_id' => '記事ID',
    ],
];
