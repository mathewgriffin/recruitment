<?php

namespace Core\Controller;

use DI\Container;
use DI\ContainerBuilder;
use Twig_Loader_Filesystem;
use Twig_Environment;

/**
 * Class BaseController
 *
 * @package Core\Controller
 */
class BaseController
{
    /** @var Twig_Environment */
    protected $twig;

    /** @var Container */
    protected $container;

    /** @var array  */
    protected $postVars = [];

    /** @var array  */
    protected $getVars = [];


    /**
     * BaseController constructor.
     */
    public  function __construct()
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../../app/Templates');
        $this->twig = new Twig_Environment($loader);

        $containerBuilder = new ContainerBuilder();
        $this->container = $containerBuilder->build();

        $this->processParameters();
    }

    /**
     * @param string $templateName
     * @param array  $variables
     *
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    protected function render(string $templateName, array $variables = [])
    {
        return $this->twig->render($templateName, $variables);
    }

    private function processParameters()
    {
        foreach ($_GET as $key => $value)
        {
            $this->getVars[$key] = $value;
        }

        foreach ($_POST as $key => $value)
        {
            $this->postVars[$key] = $value;
        }
    }
}
