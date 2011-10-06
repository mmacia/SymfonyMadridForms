<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

namespace SFM\FormsBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Moisés Maciá <mmacia@gmail.com>
 */
abstract class AbstractHandler
{
    protected $request;
    protected $form;
    protected $container;

    /**
     * @param Form               $form
     * @param Request            $request
     * @param ContainerInterface $container
     */
    public function __construct(Form $form, Request $request, ContainerInterface $container)
    {
        $this->form      = $form;
        $this->request   = $request;
        $this->container = $container;
    }

    /**
     * @return bool
     */
    abstract public function process($obj);
}
