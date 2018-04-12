<?php
/**
 * bilibili plugin 使用方法：[bilibili]av(id)[/bilibili]
 *
 * @package bilibili
 * @author Hcreak
 * @version 1.0.0 beta
 * @dependence 9.9.2-*
 * @link https://xeonphi.cn
 */
class bilibili_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('bilibili_Plugin', 'parse');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){}

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 解析bilibili标签
     *
     * @access public
     * @return void
     */
    public static function parse($text, $widget, $lastResult) {

        $text = empty($lastResult) ? $text : $lastResult;

        if ($widget instanceof Widget_Archive){
            $text = preg_replace(
                    "/(\[bilibili\]aid(.*?)cid(.*?)\[\/bilibili\])/is",
                    //'<embed height="416" width="544" quality="high" allowfullscreen="true" type="application/x-shockwave-flash" src="//static.hdslb.com/miniloader.swf" flashvars="aid=$2&page=1" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash"></embed>',
                    '<iframe src="//player.bilibili.com/player.html?aid=$2&cid=$3&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe>',
                    $text
                    );
        }

        return $text;
    }
}
