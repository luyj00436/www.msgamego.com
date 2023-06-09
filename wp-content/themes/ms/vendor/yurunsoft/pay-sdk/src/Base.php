<?php

namespace Yurun\PaySDK;

use Yurun\PaySDK\Lib\XML;
use Yurun\Util\HttpRequest;

/**
 * SDK类基类
 */
abstract class Base
{
    /**
     * HttpRequest
     * @var \Yurun\Util\HttpRequest
     */
    public $http;

    /**
     * 接口请求的返回结果
     * @var \Yurun\Util\YurunHttp\Http\Response
     */
    public $response;

    /**
     * 请求数据
     * @var array
     */
    public $requestData;

    /**
     * 公共参数
     * @var mixed
     */
    public $publicParams;

    /**
     * 最后请求的url地址
     * @var string
     */
    public $url;

    /**
     * 最后请求的结果
     * @var mixed
     */
    public $result;

    /**
     * swoole 请求类
     *
     * @var \swoole_http_request
     */
    public $swooleRequest;

    /**
     * swoole 响应类
     *
     * @var \swoole_http_response
     */
    public $swooleResponse;

    public function __construct($publicParams)
    {
        $this->publicParams = $publicParams;
        $this->http = new HttpRequest;
    }

    /**
     * 调用执行接口
     * @param mixed $params
     * @param string $method
     * @return mixed
     */
    public function execute($params, $format = 'JSON')
    {
        if ($params->__onExecute($this, $format)) {
            return $this->result;
        }
        $this->prepareExecute($params, $url, $data);
        $this->url = $url;
        $this->response = $this->http->send($url, $this->requestData, $params->_method);
        switch ($format) {
            case 'JSON':
                $this->result = $this->response->json(true);
                break;
            case 'XML':
                $this->result = XML::fromString($this->response->body());
                break;
            default:
                $this->result = $this->response->body();
        }
        if ($params->_isSyncVerify && !$this->verifySync($params, $this->result)) {
            throw new \Exception('同步返回数据验证失败');
        } else {
            return $this->result;
        }
    }

    /**
     * 准备处理数据
     * @param string $params
     * @param string $url
     * @param array $data
     * @return void
     */
    public function prepareExecute($params, &$url = null, &$data = null)
    {
        $this->__parseExecuteData($params, $data, $requestData, $url);
        $this->requestData = $requestData;
        if ('GET' === $params->_method) {
            if (false === strpos($url, '?')) {
                $url .= '?';
            } else {
                $url .= '&';
            }
            $url .= \http_build_query($data, '', '&');
        }
    }

    /**
     * 处理执行接口的数据
     * @param $params
     * @param &$data 数据数组
     * @param &$requestData 请求用的数据，格式化后的
     * @param &$url 请求地址
     * @return array
     */
    public abstract function __parseExecuteData($params, &$data, &$requestData, &$url);

    /**
     * 验证同步返回内容
     * @param mixed $params
     * @param array $data
     * @return bool
     */
    public abstract function verifySync($params, $data);

    /**
     * 调用执行接口，将结果保存至文件
     * @param mixed $params
     * @param string $saveFilename
     * @return void
     */
    public function executeDownload($params, $saveFilename)
    {
        $this->prepareExecute($params, $url, $data);
        $this->url = $url;
        $this->http->saveFile($saveFilename)->send($url, $this->requestData, $params->_method);
    }

    /**
     * 签名
     * @param array $data
     * @return string
     */
    public abstract function sign($data);

    /**
     * 验证回调通知是否合法
     * @param $data
     * @return bool
     */
    public abstract function verifyCallback($data);

    /**
     * 检查是否执行成功
     * @param array $result
     * @return boolean
     */
    public function checkResult($result = null)
    {
        return $this->__checkResult(null === $result ? $this->result : $result);
    }

    /**
     * 检查是否执行成功
     * @param array $result
     * @return boolean
     */
    protected abstract function __checkResult($result);

    /**
     * 获取错误信息
     * @param array $result
     * @return string
     */
    public function getError($result = null)
    {
        return $this->__getError(null === $result ? $this->result : $result);
    }

    /**
     * 获取错误信息
     * @param array $result
     * @return string
     */
    protected abstract function __getError($result);

    /**
     * 获取错误代码
     * @param array $result
     * @return string
     */
    public function getErrorCode($result = null)
    {
        return $this->__getErrorCode(null === $result ? $this->result : $result);
    }

    /**
     * 获取错误代码
     * @param array $result
     * @return string
     */
    protected abstract function __getErrorCode($result);

    /**
     * 使用跳转的方式处理
     * @param array $params
     * @return void
     */
    public function redirectExecute($params)
    {
        $this->__parseExecuteData($params, $data, $requestData, $url);
        if (false === strpos($url, '?')) {
            $url .= '?';
        } else {
            $url .= '&';
        }
        $this->requestData = $data;
        $url .= \http_build_query($data, '', '&');
        if (null === $this->swooleResponse) {
            header('HTTP/1.1 302 Temporarily Moved');
            header('Status: 302 Temporarily Moved');
            header('Location: ' . $url);
            exit;
        } else {
            $this->swooleResponse->redirect($url, 302);
        }
    }

    /**
     * [redirectExecuteUrl 使用返回支付url处理]
     * @Author   Dadong2g
     * @DateTime 2019-06-03T03:07:15+0800
     * @param    [type]                   $params [description]
     * @return   [type]                           [description]
     */
    public function redirectExecuteUrl($params)
    {
        $this->__parseExecuteData($params, $data, $requestData, $url);
        if (false === strpos($url, '?')) {
            $url .= '?';
        } else {
            $url .= '&';
        }
        $this->requestData = $data;
        $url .= \http_build_query($data, '', '&');
        if (null === $this->swooleResponse) {
            return $url;
        } else {
            return $url;
        }
    }

    /**
     * 处理异步通知
     * @param mixed $notifyHandle
     * @return void
     */
    public function notify($notifyHandle)
    {
        $notifyHandle->sdk = $this;
        $notifyHandle->exec();
    }
}