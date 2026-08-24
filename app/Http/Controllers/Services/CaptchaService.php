<?php

namespace App\Http\Controllers\Services;

class CaptchaService
{
    protected $width = 150;
    protected $height = 50;
    protected $characters = 'ABCDEFGHJKLMNPRSTUVWXYZ123456789';

    public function generateCode($length = 5): string
    {
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $this->characters[rand(0, strlen($this->characters) - 1)];
        }
        return $code;
    }

    public function createCaptchaImage(string $code): string
    {
        $width = $this->width;
        $height = $this->height;

        $image = imagecreate($width, $height);

        $background = imagecolorallocate($image, 255, 255, 255); // خلفية بيضاء
        $textColor = imagecolorallocate($image, 0, 0, 0); // أسود
        $noiseColor = imagecolorallocate($image, 100, 120, 180); // لون الضوضاء

        // خطوط الضوضاء
        for ($i = 0; $i < 7; $i++) {
            imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $noiseColor);
        }

        // عرض الرمز
        $fontSize = 5;
        $x = ($width - imagefontwidth($fontSize) * strlen($code)) / 2;
        $y = ($height - imagefontheight($fontSize)) / 2;
        imagestring($image, $fontSize, $x, $y, $code, $textColor);

        ob_start();
        imagepng($image);
        $data = ob_get_clean();
        imagedestroy($image);

        return $data;
    }
    public function storeCaptchaInSession(string $code, int $ttlSeconds = 300) // 5 دقائق مثلاً
    {
        session([
            'captcha_code' => $code,
            'captcha_expiry' => now()->addSeconds($ttlSeconds)->timestamp,
        ]);
    }

}
