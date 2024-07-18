<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitfa0f0f79fc239f0ca873dad683e3cfc8
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitfa0f0f79fc239f0ca873dad683e3cfc8', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitfa0f0f79fc239f0ca873dad683e3cfc8', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitfa0f0f79fc239f0ca873dad683e3cfc8::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}