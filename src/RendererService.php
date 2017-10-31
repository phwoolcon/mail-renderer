<?php

namespace Phwoolcon\MailRenderer;

use Phalcon\Di;
use Phwoolcon\Config;
use Phwoolcon\View;

class RendererService extends View
{
    /**
     * @var Di
     */
    protected static $di;
    /**
     * @var View
     */
    protected $view;
    /**
     * @var static
     */
    protected static $instance;
    protected $config = [
        'top_level' => 'email',
        'dir'       => 'email',
    ];
    protected $subject;

    public function __construct(array $config)
    {
        $this->view = static::$di->getShared('view');
        $this->config = $config;
    }

    protected function doRender($template, array $params = [])
    {
        $this->prepareEnvironment();
        $body = View::make($template, $params);
        $this->view->reset();
        return [$this->subject, $body];
    }

    protected function prepareEnvironment()
    {
        $view = $this->view;
        $view->_fillResponse = false;
        $view->_mainView = $this->config['top_level'];
        $view->_theme = $this->config['dir'];
        $this->subject = null;
    }

    public static function register(Di $di)
    {
        static::$di = $di;
        $di->remove('mailRenderer');
        $di->setShared('mailRenderer', function () use ($di) {
            return new static(Config::get('mail-renderer'));
        });
    }

    public static function renderEmail($template, array $params = [])
    {
        static::$instance or static::$instance = static::$di->getShared('mailRenderer');
        return static::$instance->doRender($template, $params);
    }

    public static function setSubject($subject)
    {
        static::$instance or static::$instance = static::$di->getShared('mailRenderer');
        static::$instance->subject = $subject;
    }
}
