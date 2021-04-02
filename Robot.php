<?php
/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/11/9 5:31 下午
 * description : 机器人library
 */

class Gring_Hi_Robot {

    private $webhook;

    private $toId;

    private $curlServer;

    private $attaches = array();

    public $proxy;

    /**
     * Gring_Hi_Robot constructor.
     * @param $webhook
     */
    public function __construct($webhook) {
        $this->webhook = $webhook;
        $this->curlServer = new Gring_Service_Curl();
    }

    /**
     * @param  Gring_Hi_Contracts_MessageInterface  $contractsMessage
     * @return $this
     */
    public function addAttach(Gring_Hi_Contracts_MessageInterface $contractsMessage) {
        $this->attaches[] = $contractsMessage;

        return $this;
    }

    /**
     * @param $contractsMessage
     * @return $this
     */
    public function addAttaches($contractsMessage) {
        foreach ($contractsMessage as $message) {
            if ($message instanceof Gring_Hi_Contracts_MessageInterface) {
                $this->addAttach($message);
            } else {
                throw new InvalidArgumentException('type is not support.');
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getAttaches() {
        if (empty($this->attaches)) {
            throw new InvalidArgumentException('type must exist.');
        }

        return $this->attaches;
    }

    /**
     * @param $proxy
     * @return $this
     */
    public function setProxy($proxy) {
        $this->proxy = $proxy;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProxy() {
        return $this->proxy;
    }

    /**
     * @param  array  $toId
     * @return $this
     */
    public function setToId($toId = array()) {
        if (!is_array($toId)) {
            throw new InvalidArgumentException(sprintf('toid [%s] must array.', $this->toId));
        }
        $this->toId = $toId;

        return $this;
    }

    /**
     * @return mixed
     */
    private function getToId() {
        return $this->toId;
    }

    /**
     * @return array[]
     */
    private function getHeader() {
        return array(
            "header" => array(
                'toid' => $this->getToId(),
            ),
        );
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function response() {
        return $this->parseResponse(
            $this->curlServer->withProxy($this->proxy)
                ->to($this->webhook)
                ->asJsonRequest()
                ->withData($this->getResponseData())
                ->post()
        );
    }

    /**
     * @param $response
     * @return mixed
     * @throws Exception
     */
    public function parseResponse($response) {
        $response = json_decode($response, true);
        if (!$response || $response['errcode'] != Gring_Hi_ErrCode::SUCCESS) {
            throw new Exception(Gring_Hi_ErrCode::getMsg($response['errcode']), $response['errcode']);
        }
        if (isset($response['data']['fail']) && !empty($response['data']['fail']) && $response['data']['fail'] != Gring_Hi_ErrCode::SUCCESS) {
            $errno = array_values($response['data']['fail']);
            throw new Exception(Gring_Hi_ErrCode::getMsg($errno[0]), $errno[0]);
        }

        return $response;
    }

    /**
     * @return array[][]
     */
    private function getResponseData() {
        $body = array();

        /* @var Gring_Hi_Contracts_MessageInterface $attach */
        foreach ($this->getAttaches() as $key => $attach) {
            $body[$key] = $attach->getBody();
        }

        $responseData = array(
            "message" => array(
                "body" => $body,
            ),
        );
        if (!empty($this->getToId())) {
            $responseData['message'] = $this->getHeader();
        }

        return $responseData;
    }
}
