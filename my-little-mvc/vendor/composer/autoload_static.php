<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7d8b2aa1a59ed47aeee593344dd27975
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'src\\Model\\' => 10,
            'src\\Controller\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'src\\Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Model',
        ),
        'src\\Controller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/Controller',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7d8b2aa1a59ed47aeee593344dd27975::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7d8b2aa1a59ed47aeee593344dd27975::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7d8b2aa1a59ed47aeee593344dd27975::$classMap;

        }, null, ClassLoader::class);
    }
}
