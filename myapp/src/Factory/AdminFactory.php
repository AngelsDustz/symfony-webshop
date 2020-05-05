<?php


namespace App\Factory;


use App\DTO\AdminDTO;
use App\Entity\Admin;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class AdminFactory.
 */
class AdminFactory
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param AdminDTO $adminDTO
     *
     * @return Admin
     */
    public function createFromDTO(AdminDTO $adminDTO): Admin
    {
        $admin = new Admin($adminDTO->username, 'password', $adminDTO->email);
        $admin->setPassword(
            $this->passwordEncoder->encodePassword(
                $admin,
                $adminDTO->password
            )
        );

        return $admin;
    }
}