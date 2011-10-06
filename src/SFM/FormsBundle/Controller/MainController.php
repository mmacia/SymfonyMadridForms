<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

namespace SFM\FormsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SFM\FormsBundle\Entity\User;
use SFM\FormsBundle\Form\Type\UserFormType;
use SFM\FormsBundle\Form\Handler\UserRegisterHandler;
use SFM\FormsBundle\Form\UserRegister;

/**
 * @author Moisés Maciá <mmacia@gmail.com>
 **/
class MainController extends Controller
{
    /**
     * @Route("/new", name="forms_new")
     * @Template("SFMFormsBundle:User:new.html.twig")
     */
    public function newAction()
    {
        $form = $this->createForm(new UserFormType());
        return array('form' => $form->createView());
    }

    /**
     * @Route("/create", name="forms_create", requirements={"_method" = "POST"})
     */
    public function createAction()
    {
        $request = $this->get('request');
        $data = $request->request->get('form');
        $user = new User();

        $form = $this->createForm(new UserFormType());
        $formHnd = new UserRegisterHandler($form, $request, $this->container);

        if ($formHnd->process($user)) {
            $vars = array('user' => $user);
            return $this->render('SFMFormsBundle:User:create.html.twig', $vars);
        }

        $vars = array('form' => $form->createView());
        return $this->render('SFMFormsBundle:User:new.html.twig', $vars);
    }
}
