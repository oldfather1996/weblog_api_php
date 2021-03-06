<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0bf67ac9723c6aff2db25df2fdde15e7
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'project\\' => 8,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'project\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0bf67ac9723c6aff2db25df2fdde15e7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0bf67ac9723c6aff2db25df2fdde15e7::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0bf67ac9723c6aff2db25df2fdde15e7::$classMap;

        }, null, ClassLoader::class);
    }
}
