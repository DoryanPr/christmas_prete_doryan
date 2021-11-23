<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ean')
            ->add('name')
            ->add('teaser')
            ->add('description')
            ->add('price')
            ->add('stack')
            ->add('picturemain', FileType::class, [
                'label' => 'Image JPEG, PNG',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => "Merci d' enregistrer une image au format jpeg,png",
                    ])
                ],
            ])
            ->add('picturefront', FileType::class, [
                'label' => 'Image JPEG, PNG',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => "Merci d' enregistrer une image au format jpeg,png",
                    ])
                ],
            ])
            ->add('pictureback', FileType::class, [
                'label' => 'Image JPEG, PNG',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png'
                        ],
                        'mimeTypesMessage' => "Merci d' enregistrer une image au format jpeg,png",
                    ])
                ],
            ])
            ->add('manuel', FileType::class, [
                'label' => 'Manuel (PDF file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                        ],
                        'mimeTypesMessage' => "Merci d' enregistrer un document au format PDF",
                    ])
                ],
            ])
            ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'multiple' => false,
                    'expanded' => true,
                    'required' => true
                ]
            )
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
