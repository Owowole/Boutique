<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var User|null $user */
        $user = $options['data'] ?? null;
        $currentRole = 'ROLE_INTERMEDIAIRE';

        if ($user instanceof User) {
            $roles = $user->getRoles();
            if (in_array('ROLE_ADMIN', $roles, true)) {
                $currentRole = 'ROLE_ADMIN';
            } elseif (in_array('ROLE_USER', $roles, true)) {
                $currentRole = 'ROLE_USER';
            } elseif (in_array('ROLE_INTERMEDIAIRE', $roles, true)) {
                $currentRole = 'ROLE_INTERMEDIAIRE';
            }
        }

        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            // Rôle principal (un seul)
            ->add('role', ChoiceType::class, [
                'label'   => 'Rôle',
                'mapped'  => false,
                'choices' => [
                    'Intermédiaire (en attente)' => 'ROLE_INTERMEDIAIRE',
                    'Utilisateur'                => 'ROLE_USER',
                    'Administrateur'             => 'ROLE_ADMIN',
                ],
                'data' => $currentRole,
            ])
            // Champ mot de passe optionnel (pour reset)
            ->add('plainPassword', PasswordType::class, [
                'label'    => 'Nouveau mot de passe',
                'mapped'   => false,
                'required' => $options['require_password'] ?? false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'       => User::class,
            'require_password' => false, // true pour création
        ]);
    }
}
