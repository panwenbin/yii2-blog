<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\helpers;

/**
 * 网址辅助类
 * @package common\helpers
 */
class UrlHelper
{
    /**
     * 绝对地址生成
     * @param $url
     * @param $baseUrl
     * @return string
     */
    public static function urlAbsolutely($url, $baseUrl)
    {
        if ($url[0] == '/') {
            $pathInfo = parse_url($baseUrl);
            return $pathInfo['scheme'] . '://' . $pathInfo['host'] . $url;
        } else if (strpos($url, '://') !== false) {
            return $url;
        } else {
            return dirname($baseUrl) . '/' . $url;
        }
    }
}