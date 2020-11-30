<?php

namespace App\Form;

use App\Entity\Caregiver;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CaregiverType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('natIdCard')
            ->add('user', UserType::class)
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])

            ->add('leftDate',  DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])

            ->add('certificatedAt',  DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])

            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'query_builder' => function (EntityRepository $er) {
            //         $role = 'ROLE_CAREGIVER';
            //         return $er->createQueryBuilder('u')
            //         ->where('u.roles LIKE :roles')
            //         ->setParameter('roles', '%"'.$role.'"%')
            //         ->orderBy('u.id', 'DESC');
            //     },
            //     'choice_label' => 'firstName',
            // ])

           
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Caregiver::class,
        ]);
    }
}
