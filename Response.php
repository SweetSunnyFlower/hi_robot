<?php
/**
 * author : v_gaobingbing@duxiaoman.com
 * createTime : 2020/12/8 3:38 下午
 * description :
 */

class Gring_Hi_Response {

    private $webhook;

    private $payload;

    /**
     * @var array
     */
    protected $handlers = array();

    public function __construct($webhook) {
        $this->webhook = $webhook;
    }

    public function bindPayload(Gring_Hi_Payload $payload) {
        $payload->setAttribute('webhook', $this->webhook);
        $this->payload = $payload->attributes;
    }

    /**
     * @param  array  $eventHandlers
     * @throws ReflectionException
     */
    public function registerHandlers($eventHandlers = array()) {
        /* @var Gring_Hi_Contracts_EventHandlerInterface $eventHandler */
        foreach ($eventHandlers as $directive => $eventHandler) {
            $this->registerHandler($directive, $eventHandler);
        }
    }

    /**
     * @param $directive
     * @param $eventHandler
     * @throws ReflectionException
     */
    public function registerHandler($directive, $eventHandler) {
        if (!in_array(
            Gring_Hi_Contracts_EventHandlerInterface::class,
            (new ReflectionClass($eventHandler))->getInterfaceNames(),
            true
        )) {
            throw new InvalidArgumentException(
                sprintf(
                    'Class "%s" not an instance of "%s".',
                    $eventHandler,
                    Gring_Hi_Contracts_EventHandlerInterface::class
                )
            );
        }
        $this->handlers[strtoupper($directive)] = new $eventHandler();
    }

    /**
     * 分发处理
     */
    public function handle() {
        $commandName = $this->payload['commandName'];
        if (isset($this->handlers[$commandName])) {
            $this->handlers[$commandName]->handle($this->payload);
        }
    }

}