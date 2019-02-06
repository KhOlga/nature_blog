<?php
/**
 * Created by PhpStorm.
 * User: okharabet
 * Date: 05.02.2019
 * Time: 12:26
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Article;


class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',
                TextType::class,
                ['help' => 'Please type here name of title'])
            ->add('slug',
                TextType::class,
                ['help' => 'Please type here short slug'])
            ->add('content'
                ,
                TextType::class,
                ['help' => 'Please type here content']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class
        ]);
    }


}