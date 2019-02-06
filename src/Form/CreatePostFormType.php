<?php
/**
 * Created by PhpStorm.
 * User: okharabet
 * Date: 05.02.2019
 * Time: 14:37
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreatePostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content');
    }
}