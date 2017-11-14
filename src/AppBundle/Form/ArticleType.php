<?php

namespace AppBundle\Form;

use AppBundle\Entity\Article;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Názov'])
            ->add('url', TextType::class, ['label' => 'Seo cesta (nepovinné)', 'required' => false])
            ->add('perex')
            ->add('text', CKEditorType::class, ['config' => ['height' => '500px', 'language' => 'sk']])
            ->add('tmpMainImgFile', FileType::class,
                ['required' => false, 'label' => 'Hlavný obrázok', 'data_class' => null])
            ->add('submit', SubmitType::class, [
                'attr' => ['formnovalidate' => true, 'label' => 'Uložiť']
            ]);

        return $builder;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Article::class]);
    }

    public function getName()
    {
        return 'app_bundle_article_type';
    }
}
