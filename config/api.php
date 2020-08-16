<?php

return [
    /**
     * 接口频率限制
     */
    'rate_limits' => [
        // 访问频率限制, 次数/分钟 一分钟调用60次
        'access' => env('RATE_LIMITS', '60,1'),
        // 登录相关,次数/分钟, 一分钟调用10次
        'sign' => env('SIGN_RATE_LIMITS', '10,1'),
    ],
];
