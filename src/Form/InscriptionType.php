<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user', NULL,  ["label"=> "Votre pseudo", "attr"=>["value"=>"votre pseudo" ]])
            ->add('email', \Symfony\Component\Form\Extension\Core\Type\EmailType::class, ["required"=>TRUE ,"label"=> "Email"])
            ->add('password', RepeatedType::class, ['type' => PasswordType::class,
                    'invalid_message' => 'Le mot de passe doit etre identique.',
                 'options' => ['attr' => ['class' => 'password-field']],
                    'required' => true,
                'first_options'  => ['label' => 'Entrez le mot de passe'],
                'second_options' => ['label' => 'Repetez le mot de passe']])

                                        
                
                
                ->add('role', \Symfony\Component\Form\Extension\Core\Type\RepeatedType::Password)
            ->add("Login", \Symfony\Component\Form\Extension\Core\Type\SubmitType::class)
                ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
