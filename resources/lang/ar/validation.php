<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | الـ following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'الـ :attribute يجب ان يوافق عليه.',
    'active_url' => 'الـ :attribute ليس عنوان ويب صحيح.',
    'after' => 'الـ :attribute يجب ان يكون تاريخ اكبر من  :date.',
    'after_or_equal' => 'الـ :attribute يجب ان يكون تاريخ اكبر من او يساوى :date.',
    'alpha' => 'الـ :attribute يحتوى على حروف فقط.',
    'alpha_dash' => 'الـ :attribute يحتوى على حروف او ارقام او حروف خاصة صغيرة وكيبرة.',
    'alpha_num' => 'الـ :attribute يحتوى على حروف وارقام فقط.',
    'array' => 'الـ :attribute يجب ان يكون array.',
    'before' => 'الـ :attribute يجب ان يكون تاريخ اقل من :date.',
    'before_or_equal' => 'الـ :attribute يجب ان يكون تاريخ اقل من او يساوى :date.',
    'between' => [
        'numeric' => 'الـ :attribute يجب ان يكون بين :min و :max.',
        'file' => 'الـ :attribute يجب ان يكون بين :min و :max kilobytes.',
        'string' => 'الـ :attribute يجب ان يكون بين :min و :max characters.',
        'array' => 'الـ :attribute يجب ان يكون بين :min و :max items.',
    ],
    'boolean' => 'الـ :attribute يجب ان يكون  true او false.',
    'confirmed' => 'الـ :attribute التاكيد غير صحيح.',
    'date' => 'الـ :attribute تاريخ عير صحيح.',
    'date_equals' => 'الـ :attribute يجب ان يكون تاريخ  يساوى  :date.',
    'date_format' => 'الـ :attribute التاريخ غير مطابق لـ :format.',
    'different' => 'الـ :attribute و :other يجب ان يكونوا مختلفين.',
    'digits' => 'الـ :attribute يجب ان  :digits حروف.',
    'digits_between' => 'الـ :attribute يجب ان  يكون بين :min و :max حروف.',
    'dimensions' => 'الـ :attribute لها مقاس صورة خاطئ.',
    'distinct' => 'الـ :attribute له قيمة مكررة.',
    'email' => 'الـ :attribute يجب ان يكون ايميل صحيح.',
    'exists' => 'الـ selected :attribute غير صحيح.',
    'file' => 'الـ :attribute يجب ان يكون ملف.',
    'filled' => 'الـ :attribute يجب ان يحتوى على قيمة.',
    'gt' => [
        'numeric' => 'الـ :attribute يجب ان يكون اكبر من :value.',
        'file' => 'الـ :attribute يجب ان يكون اكبر من :value kilobytes.',
        'string' => 'الـ :attribute يجب ان يكون اكبر من :value characters.',
        'array' => 'الـ :attribute يجب انيحتوى على اكبر من :value متغيرات.',
    ],
    'gte' => [
        'numeric' => 'الـ :attribute يجب ان يكون اكبر من او يساوى :value.',
        'file' => 'الـ :attribute يجب ان يكون اكبر من او يساوى :value kilobytes.',
        'string' => 'الـ :attribute يجب ان يكون اكبر من او يساوى :value حروف.',
        'array' => 'الـ :attribute يجب ان يحتوى   :value متغيرات او اكثر.',
    ],
    'image' => 'الـ :attribute يجب ان يكون صورة  .',
    'in' => 'الـ :attribute غير صحيح.',
    'in_array' => 'الـ :attribute غير موجود :other.',
    'integer' => 'الـ :attribute يجب ان يكون رقم صحيح.',
    'ip' => 'الـ :attribute يجب ان يكون IPصحيح.',
    'ipv4' => 'الـ :attribute يجب ان يكون IPv4 address.',
    'ipv6' => 'الـ :attribute يجب ان يكون IPv6 address.',
    'json' => 'الـ :attribute يجب ان يكون JSON string.',
    'lt' => [
        'numeric' => 'الـ :attribute must be less than :value.',
        'file' => 'الـ :attribute must be less than :value kilobytes.',
        'string' => 'الـ :attribute must be less than :value characters.',
        'array' => 'الـ :attribute يجب ان يحتوى   less than :value items.',
    ],
    'lte' => [
        'numeric' => 'الـ :attribute must be less than او يساوى :value.',
        'file' => 'الـ :attribute must be less than او يساوى :value kilobytes.',
        'string' => 'الـ :attribute must be less than او يساوى :value characters.',
        'array' => 'الـ :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'الـ :attribute may not be greater than :max.',
        'file' => 'الـ :attribute may not be greater than :max kilobytes.',
        'string' => 'الـ :attribute may not be greater than :max characters.',
        'array' => 'الـ :attribute may not have more than :max items.',
    ],
    'mimes' => 'الـ :attribute يجب ان يكون ملف من نوع: :values.',
    'mimetypes' => 'الـ :attribute يجب ان يكون ملف من نوع: :values.',
    'min' => [
        'numeric' => 'الـ :attribute must be at least :min.',
        'file' => 'الـ :attribute must be at least :min kilobytes.',
        'string' => 'الـ :attribute must be at least :min characters.',
        'array' => 'الـ :attribute يجب ان يحتوى   at least :min items.',
    ],
    'not_in' => 'الـ selected :attribute غير صحيح.',
    'not_regex' => 'الـ :attribute format غير صحيح.',
    'numeric' => 'الـ :attribute يجب ان يكون رقم .',
    'present' => 'الـ :attribute يجب ان يمون موجود.',
    'regex' => 'الـ :attribute format غير صحيح.',
    'required' => 'يجب اختيار كل الحقول.',
    'required_if' => 'اللا :attribute field is required when :other is :value.',
    'required_unless' => 'اللا :attribute field is required unless :other is in :values.',
    'required_with' => 'اللا :attribute field is required when :values is present.',
    'required_with_all' => 'الـ :attribute field is required when :values are present.',
    'required_without' => 'الـ :attribute field is required when :values is not present.',
    'required_without_all' => 'الـ :attribute field is required when none of :values are present.',
    'same' => 'الـ :attribute and :other must match.',
    'size' => [
        'numeric' => 'الـ :attribute must be :size.',
        'file' => 'الـ :attribute must be :size kilobytes.',
        'string' => 'الـ :attribute must be :size characters.',
        'array' => 'الـ :attribute must contain :size items.',
    ],
    'starts_with' => 'الـ :attribute يجب ان يبدأ ب: :values',
    'string' => 'الـ :attribute يجب ان يكون حروف.',
    'timezone' => 'الـ :attribute يجب ان يكون فى رنج صحيح.',
    'unique' => 'الـ :attribute تم استخدامه من قبل.',
    'uploaded' => ' فشل فى رفع الملف.',
    'url' => 'الـ :attribute format غير صحيح.',
    'uuid' => 'الـ :attribute يجب ان يكون UUID صحيح.',

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
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | الـ following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
