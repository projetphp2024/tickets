<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Status;
use App\Entity\Technologies;
use App\Entity\Tickets;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('status', EntityType::class,[
                'class' => Status::class,
                'choice_label' => 'label'
            ])
            ->add('categorie',EntityType::class,[
                'class' => Categories::class,
                'choice_label' => 'label'
            ])
            ->add('technologie', EntityType::class,[
                'class' => Technologies::class,
                'choice_label' => 'label'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tickets::class,
        ]);
    }
}
