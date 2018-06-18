<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\handlers;


use common\models\PostQuery;
use common\models\SeriesQuery;
use yii\base\Component;

/**
 * 用以过滤用户所拥有的日志和系列
 * @package common\handlers
 */
class LimitToOwn extends Component
{
    /**
     * 给后台的事件处理，用以过滤用户所拥有的日志和系列
     */
    public static function backend()
    {
        PostQuery::limitToOwnPosts();
        SeriesQuery::limitToOwnPosts();
    }

    /**
     * 给前台的事件处理，过滤未审核的日志只有发布人和管理员可见
     */
    public static function frontend()
    {
        PostQuery::limitToAuditedOrOwnPosts();
    }
}