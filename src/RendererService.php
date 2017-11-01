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
        'layout'    => 'phwoolcon-default',
        'dir'       => 'email',
    ];
    protected $subject;
    protected $cssFiles = [];

    public function __construct(array $config)
    {
        $this->view = static::$di->getShared('view');
        $this->config = $config;
    }

    protected function doRender($template, array $params = [])
    {
        $this->prepareEnvironment();
        $body = View::make($template, $params);
        $subject = $this->subject;
        $this->reset();
        return [$subject, $body];
    }

    public static function getSubject()
    {
        static::$instance or static::$instance = static::$di->getShared('mailRenderer');
        return static::$instance->subject;
    }

    protected function prepareEnvironment()
    {
        $view = $this->view;
        $view->_fillResponse = false;
        $view->_mainView = $this->config['top_level'];
        $view->_layout = $this->config['layout'];
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

    public static function renderCss()
    {
        static::$instance or static::$instance = static::$di->getShared('mailRenderer');
        if ($cssFiles = static::$instance->cssFiles) {
            echo '<style type="text/css">';
            foreach ($cssFiles as $file) {
                include $file;
            }
            echo '</style>';
        }
    }

    public static function renderEmail($template, array $params = [])
    {
        static::$instance or static::$instance = static::$di->getShared('mailRenderer');
        return static::$instance->doRender($template, $params);
    }

    public function reset()
    {
        $this->subject = null;
        $this->cssFiles = [];
        $this->view->reset();
    }

    public static function setCssFiles(array $files)
    {
        static::$instance or static::$instance = static::$di->getShared('mailRenderer');
        static::$instance->cssFiles = $files;
    }

    public static function setSubject($subject)
    {
        static::$instance or static::$instance = static::$di->getShared('mailRenderer');
        static::$instance->subject = $subject;
    }
}
