<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AdminDTO.
 */
class AdminDTO
{
    /**
     * @Assert\NotBlank
     *
     * @var string
     */
    public $username;

    /**
     * @Assert\NotBlank
     *
     * @var string
     */
    public $password;

    /**
     * @var string|null
     */
    public $email;

    /**
     * @var array<string>
     */
    public $roles = [];
}
