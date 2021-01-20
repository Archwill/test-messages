<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit03f61ef647f141761f594026be105a19
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Tests\\' => 6,
        ),
        'I' => 
        array (
            'Interfaces\\' => 11,
        ),
        'C' => 
        array (
            'Classes\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Tests\\' => 
        array (
            0 => __DIR__ . '/../..' . '/tests',
        ),
        'Interfaces\\' => 
        array (
            0 => __DIR__ . '/../..' . '/interfaces',
        ),
        'Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit03f61ef647f141761f594026be105a19::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit03f61ef647f141761f594026be105a19::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit03f61ef647f141761f594026be105a19::$classMap;

        }, null, ClassLoader::class);
    }
}
