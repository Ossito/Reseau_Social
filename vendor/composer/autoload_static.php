<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit428060a1ff91f16f2a736fbc63404803
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit428060a1ff91f16f2a736fbc63404803::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit428060a1ff91f16f2a736fbc63404803::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
