<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

namespace SFM\FormsBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContext;

/**
 * @author Moisés Maciá <mmacia@gmail.com>
 *
 * @Assert\Callback(methods={"checkPassword", "checkCaptcha"})
 */
class UserRegister
{
    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede estar en blanco")
     */
    public $name;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede estar en blanco")
     */
    public $surname;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede estar en blanco")
     */
    public $password;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede estar en blanco")
     */
    public $password2;

    /**
     * @var string
     * @Assert\NotBlank(message="Este campo no puede estar en blanco")
     */
    public $captcha;


    /**
     * @param ExecutionContext $context
     */
    public function checkPassword(ExecutionContext $context)
    {
        if (empty($this->password) || ($this->password !== $this->password2)) {
            $propertyPath = $context->getPropertyPath() . '.password';
            $context->setPropertyPath($propertyPath);
            $context->addViolation('Las constraseñas no coinciden', array(), null);
        }
    }

    /**
     * @param ExecutionContext $context
     */
    public function checkCaptcha(ExecutionContext $context)
    {
        if (strtolower($this->captcha) !== 'broadway overcome') {
            $propertyPath = $context->getPropertyPath() . '.captcha';
            $context->setPropertyPath($propertyPath);
            $context->addViolation('El captcha no coincide', array(), null);
        }
    }
}
