<?php

return [
    'api_key' => env('TINYMCE_API_KEY', ''),
    'options' => [
        'plugins' => [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount'
        ],
        'toolbar' => 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        'height' => 500,
    ],
];
