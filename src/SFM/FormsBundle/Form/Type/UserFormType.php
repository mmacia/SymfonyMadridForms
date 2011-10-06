<?php
/* vim: set expandtab tabstop=4 shiftwidth=4: */

namespace SFM\FormsBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * @author Moisés Maciá <mmacia@gmail.com>
 */
class UserFormType extends AbstractType
{
    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilder $builder, array $options)
    {
        $opts = array(
            'trim'     => true,
            'required' => true);

        $builder->add('name', 'text', array_merge($opts, array('label' => 'Nombre')))
                ->add('surname', 'text', array_merge($opts, array('label' => 'Apellidos')))
                ->add('password', 'password', array_merge($opts, array('label' => 'Contraseña')))
                ->add('password2', 'password', array('required' => true, 'label' => '(otra vez)'))
                ->add('captcha', 'text', array_merge($opts, array('label' => 'captcha')));
    }

    /**
     * @inheritdoc
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'SFM\FormsBundle\Form\UserRegister',
        );
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'user';
    }
}
