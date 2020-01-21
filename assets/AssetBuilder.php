<?php


namespace app\assets;


use app\base\BaseObject;
use app\engine\App;


abstract class AssetBuilder extends BaseObject
{
    /**
     * @var $css array links styles
     */
    public static $css;
    /**
     * @var $js array links scripts
     */
    public static $js;

    /**
     * @return false|string output scripts in page
     */
    public static function buildCss()
    {
        $styles = array_unique(array_filter(static::$css));
        print_r(self::$css);
        ob_start();
        foreach ($styles as $style) : ?>
            <?php if (file_exists(App::$config['webPath'] . DS . $style)) : ?>

                <link type="text/css"
                      rel="stylesheet"
                      href="<?= static::getTimeStampFile($style, App::$config['webPath'])?>"
                />
            <?php endif;
        endforeach;
        return ob_get_clean();
    }

    /**
     * @return false|string output scripts in page
     */
    public static function buildJs()
    {
        $scripts = array_unique(array_filter(static::$js));
        ob_start();
        foreach ($scripts as $script) : ?>
            <?php if (file_exists(App::$config['webPath'] . DS . $script)) : ?>
                <script
                        src="<?= static::getTimeStampFile($script, App::$config['webPath'])?>">
                </script>
            <?php endif;
        endforeach;
        return ob_get_clean();
    }

    /**
     * @param $params string|array register scripts in stack
     */
    public static function registerJs($params)
    {
        if (is_string($params)) {
            static::$js[] = $params;
        }
        if (is_array($params)) {
            static::$js = array_merge(static::$js, $params);
        }
    }

    /**
     * @param $params string|array register styles in stack
     */
    public static function registerCss($params)
    {
        if (is_string($params)) {
            static::$css[] = $params;
        }
        if (is_array($params)) {
            static::$css = array_merge(static::$css, $params);
        }
    }

    public static function getTimeStampFile($file, $dir)
    {
        return implode('?', [$file, filemtime($dir . DS . $file)]);
    }
}