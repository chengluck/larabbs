<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CaptchasController extends Controller
{
    public function store(CaptchaRequest $request, CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha-' . Str::random(15);
        $phone = $request->phone;

        //创建验证吗图片
        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinutes(2);
        // getPhrase() //获取验证码文本
        \Cache::put($key, ['phone' => $phone, 'code' => $captcha->getPhrase()], $expiredAt);

        $result = [
            'catpcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            // inline() //获取base64图片验证吗
            'captcha_image_content' => $captcha->inline()
        ];

        return response()->json($result)->setStatusCode(201);
    }
}
