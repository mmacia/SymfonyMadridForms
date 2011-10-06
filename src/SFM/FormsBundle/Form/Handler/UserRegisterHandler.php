<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

namespace SFM\FormsBundle\Form\Handler;

use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\EntityManager;
use SFM\FormsBundle\Entity\User;
use SFM\FormsBundle\Form\UserRegister;

/**
 * @author Moisés Maciá <mmacia@gmail.com>
 */
class UserRegisterHandler extends AbstractHandler
{
    /**
     * @param $user
     * @return bool
     */
    public function process($user)
    {
        if ($this->request->getMethod() != 'POST' || !($user instanceof User)) {
            return false;
        }

        $em = $this->container->get('doctrine')->getEntityManager();

        $register = new UserRegister();

        // hydrate form with request data
        $this->form->setData($register);
        $this->form->bindRequest($this->request);

        if (!$this->form->isValid()) {
            return false;
        }

        // hydrate entity with form data
        $user->setName($register->name);
        $user->setSurname($register->surname);
        $user->setPassword(sha1($register->password));

        $em->persist($user);
        $em->flush();

        return true;
    }
}
