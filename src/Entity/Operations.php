<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Operations
 *
 * @ORM\Table(name="operations")
 * @ORM\Entity
 */
class Operations
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type_operation", type="string", length=255, nullable=true)
     */
    private $typeOperation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="visual_headband", type="string", length=255, nullable=true)
     */
    private $visualHeadband;

    /**
     * @var string|null
     *
     * @ORM\Column(name="visuel_lateral", type="string", length=255, nullable=true)
     */
    private $visuelLateral;


}
