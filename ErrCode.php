<?php
/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/11/9 5:31 下午
 * description : HI 错误码
 * wiki：http://wiki.duxiaoman-int.com/pages/viewpage.action?pageId=9109282
 */

class Gring_Hi_ErrCode {

    const SYSTEM_ERROR = -1;
    const SUCCESS = 0;
    const PARAMS_ERROR_1 = 40000;
    const GROUP_ID_INVALID = 40035;
    const NOT_COMPANY_GROUP = 40036;
    const PARAMS_ERROR_2 = 40040;
    const AGENT_ID_NOT_DISPATCH = 40044;
    const AGENT_ID_INVALID = 40045;
    const SEND_LIMIT = 40046;
    const UPLOAD_FAILED = 40047;
    const BODY_LIMIT = 40060;
    const TEXT_LIMIT = 40061;
    const LINK_LIMIT = 40062;
    const IMAGE_LIMIT = 40063;
    const OFFLINE_NOTIFY_LIMIT = 40064;
    const COMPATIBLE_LIMIT = 40065;
    const IMAGE_SIZE_LIMIT = 40066;
    const MARKDOWN_NUM_LIMIT = 40067;
    const MARKDOWN_LENGTH_LIMIT = 40068;
    const MESSAGE_FORMAT_ERROR = 40069;
    const AT_LIMIT = 40071;
    const ROBOT_SEND_FORBID = 40200;
    const ROBOT_RECEIVED_FORBID = 40201;
    const ROBOT_STOP = 40300;

    const DEFAULT_ERR_CODE = 404000;

    public static $MSG = array(
        self::SYSTEM_ERROR => '系统错误',
        self::SUCCESS => 'ok',
        self::PARAMS_ERROR_1 => '参数错误',
        self::GROUP_ID_INVALID => '群聊ID不合法',
        self::NOT_COMPANY_GROUP => '群聊非企业群',
        self::PARAMS_ERROR_2 => '参数错误',
        self::AGENT_ID_NOT_DISPATCH => '机器人未被添加到群中',
        self::AGENT_ID_INVALID => 'agentId不合法',
        self::SEND_LIMIT => '发送消息频率超限',
        self::UPLOAD_FAILED => '文件上传失败',
        self::BODY_LIMIT => 'body超过9k',
        self::TEXT_LIMIT => 'text类型文本总长度超过2k',
        self::LINK_LIMIT => 'link类型单个链接长度超过1k',
        self::IMAGE_LIMIT => 'image类型图片数量超过1个，或者与其他类型消息混合发送',
        self::OFFLINE_NOTIFY_LIMIT => 'header中offlinenotify长度超过1k',
        self::COMPATIBLE_LIMIT => 'header中offlinenotify长度超过1k',
        self::IMAGE_SIZE_LIMIT => 'image类型图片大小超过1m',
        self::MARKDOWN_NUM_LIMIT => 'markdown类型数量超过1个',
        self::MARKDOWN_LENGTH_LIMIT => 'markdown内容长度超过2048个字符',
        self::MESSAGE_FORMAT_ERROR => 'message属性格式不正确',
        self::AT_LIMIT => 'at超过50人',
        self::ROBOT_SEND_FORBID => '机器人发送消息权限已被封禁',
        self::ROBOT_RECEIVED_FORBID => '机器人接受消息权限已被封禁',
        self::ROBOT_STOP => '机器人已被停用',
        self::DEFAULT_ERR_CODE => '为止错误',
    );

    /**
     * @param  int  $errNo
     * @return string
     */
    public static function getMsg($errNo, $en = false) {
        $message = self::$MSG;

        return isset($message[$errNo]) ? $message[$errNo] : $message[self::DEFAULT_ERR_CODE];
    }

}
