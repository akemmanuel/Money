<?php

return [
    'required' => 'The :attribute field is required.',
    'string' => 'The :attribute must be a string.',
    'max' => 'The :attribute must not be greater than :max characters.',
    'numeric' => 'The :attribute must be a number.',

    'custom' => [
        'name' => [
            'required' => 'Please enter a name for your bank account.',
            'string' => 'The bank account name must be text.',
            'max' => 'The bank account name may not be greater than :max characters.',
        ],
        'balance' => [
            'required' => 'Please enter an initial balance for your bank account.',
            'numeric' => 'The balance must be a number.',
        ],
    ],
];
