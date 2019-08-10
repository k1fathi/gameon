<?php

return [
    'common'       => [
        'error'       => 'Error',
        'save-error'  => 'Unable to save an error occurred',
        'input-error' => 'Input data an error occurred',
        'not-found'   => 'Object not found',
        'bad-request' => 'The 400 Bad Request error',
    ],
    'auth'         => [
        'unauthenticated' => 'You are unauthenticated.',
        'invalid'         => 'Invalid e-mail address or password.',
        'social'          => [
            'unsupported' => 'Unsupported social provider.',
            'invalid'     => 'Invalid oath token',
            'missing'     => 'Some information missing',
        ],
        'password'        => [
            'invalid' => 'Invalid password',
        ],
        'forgot'          => [
            'invalid' => 'Invalid e-mail address.',
            'recent'  => 'You recently requested a reset mail. Please wait',
        ],
        'reset'           => [
            'invalid' => 'Reset code invalid or expired.',
        ],
    ],
    'question'     => [
        'not-found' => 'Question not found.',
    ],
    'answer'       => [
        'not-found' => 'Answer not found.',
    ],
    'category'     => [
        'not-found' => 'Category not found.',
    ],
    'post'         => [
        'not-found' => 'Post not found.',
    ],
    'project'      => [
        'not-found' => 'Project not found.',
        'name-valid' => 'Name is valid',
    ]

];
