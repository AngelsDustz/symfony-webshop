<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderLineRepository")
 * @ORM\Table(name="order_lines")
 */
class OrderLine extends AbstractEntity
{
}
