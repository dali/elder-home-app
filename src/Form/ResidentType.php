<?php

namespace App\Form;

use App\Entity\Family;
use App\Entity\Resident;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Doctrine\ORM\EntityRepository;

class ResidentType extends AbstractType
{
    
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('birthdate', BirthdayType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                
            ])
            ->add('endingDate', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer avatar',
                'download_uri' => false,
                'image_uri' => true,
                'asset_helper' => true,
            ])
            ->add('roomNumber')
            ->add('isActive', CheckboxType::class, [
                'label'    => 'Active',
                'required' => false,
                
            ])
            ->add('liveStreaming')
            ->add('family', EntityType::class, [
                'class' => Family::class,
                // 'query_builder' => function (EntityRepository $er) {
                //     $role = 'ROLE_FAMILY';
                //     return $er->createQueryBuilder('u')
                //     ->where('u.roles LIKE :roles')
                //     ->setParameter('roles', '%"'.$role.'"%')
                //     ->orderBy('u.id', 'DESC');
                // },
                 'choice_label' => 'user.firstName',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Resident::class,
        ]);
    }
}
