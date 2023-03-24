<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit03b728f96cb4317214a9c350a591615a
{
    public static $prefixLengthsPsr4 = array(
        'Y' =>
            array(
                'Yurun\\Util\\' => 11,
                'Yurun\\PaySDK\\' => 13,
                'Yurun\\OAuthLogin\\' => 17,
            ),
        'P' =>
            array(
                'Psr\\Http\\Message\\' => 17,
            ),
    );

    public static $prefixDirsPsr4 = array(
        'Yurun\\Util\\' =>
            array(
                0 => __DIR__ . '/..' . '/yurunsoft/yurun-http/src',
            ),
        'Yurun\\PaySDK\\' =>
            array(
                0 => __DIR__ . '/..' . '/yurunsoft/pay-sdk/src',
            ),
        'Yurun\\OAuthLogin\\' =>
            array(
                0 => __DIR__ . '/..' . '/yurunsoft/yurun-oauth-login/src',
            ),
        'Psr\\Http\\Message\\' =>
            array(
                0 => __DIR__ . '/..' . '/psr/http-message/src',
            ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit03b728f96cb4317214a9c350a591615a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit03b728f96cb4317214a9c350a591615a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}