<?php

/**
 * This filter checks for HTTP authentication of current user. Use as
 * application pre-filter.
 *
 * @package demo.filters
 * @author Benjamin Ulmer
 * @link http://github.com/remluben/rsf
 */
class HttpAuthFilter implements IFilter
{
    /**
     * @var array
     */
    private $_authData;

    /**
     * @var Registry
     */
    private $_registry;

    /**
     * @param array $authData
     *        valid auth data ( username => password )
     */
    public function __construct(Registry $registry, $authData)
    {
        $this->_registry = $registry;
        $this->_authData = $authData;
    }

    public function execute(IRequest $request, IResponse $response)
    {
        $authData = $request->getAuthData();
        if ($authData === null) {
            $this->sendAuthRequest($response);
        }
        $username = $authData['user'];
        $password = $authData['password'];
        $dispatcher = $this->_registry->get('EventDispatcher');

        if (!isset($this->_authData[$username]) ||
            $this->_authData[$username] !== $password
        ) {
            $dispatcher->triggerEvent('onInvalidLogin', $this, $authData);
            $this->sendAuthRequest($response);
        }

        $event = $dispatcher->triggerEvent('onLogin', $this, $authData);
        if ($event->isCancelled()) {
            $this->sendAuthRequest($response);
        }
    }

    /**
     * Display the HTTP auth form for username and password
     * @param IResponse $response
     */
    public function sendAuthRequest(IResponse $response)
    {
        $response->setStatus(IHttpStatus::HTTP_UNAUTHORIZED);
        $response->addHeader('WWW-Authenticate',
                             'Basic realm="Please provide your username and password"');
        $response->flush();
        exit();
    }
}
