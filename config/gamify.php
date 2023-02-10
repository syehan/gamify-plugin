<?php

return [
    // Model which will be having points, generally it will be User
    'payee_model' => env('GAMIFY_PAYEE_MODEL', \RainLab\User\Models\User::class),

    // Reputation model
    'reputation_model' => env('GAMIFY_REPUTATION_MODEL', \Syehan\Gamify\Models\Reputation::class),

    // Allow duplicate reputation points
    'allow_reputation_duplicate' => env('GAMIFY_ALLOW_REPUTATION_DUPLICATE', false),

    // Broadcast on private channel
    'broadcast_on_private_channel' => env('GAMIFY_BROADCAST_ON_PRIVATE_CHANNEL', false),

    // Channel name prefix, user id will be suffixed
    'channel_name' => env('GAMIFY_CHANNEL_NAME', 'user.reputation.'),

    // Badge model
    'badge_model' => env('GAMIFY_BADGE_MODEL', \Syehan\Gamify\Models\Badge::class),

    // Where all badges icon stored
    'badge_icon_folder' => env('GAMIFY_BADGE_ICON_FOLDER', 'images/badges/'),

    // Extention of badge icons
    'badge_icon_extension' => env('GAMIFY_BADGE_ICON_EXTENSION', '.svg'),

    // All the levels for badge (example value on .env 'beginner|1,intermediate|2')
    'badge_levels' => env('GAMIFY_BADGE_LEVELS') 
    ? array_map('explode', explode(',', env('GAMIFY_BADGE_LEVELS')), '|') 
    : [
        'beginner' => 1,
        'intermediate' => 2,
        'advanced' => 3,
    ],

    // Default level
    'badge_default_level' => env('GAMIFY_BADGE_DEFAULT_LEVEL', 1)
];
