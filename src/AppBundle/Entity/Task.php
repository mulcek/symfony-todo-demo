<?php

namespace AppBundle\Entity;

use //Symfony\Component\Validator\Constraints as Assert,
//    Doctrine\Common\Collections\ArrayCollection,
    Doctrine\ORM\Mapping as ORM,
    Knp\DoctrineBehaviors\Model as ORMBehaviors,
    AppBundle\Entity\Traits as EntityTraits
;

/**
 * @ORM\Table(options={"collate"="utf8mb4_unicode_ci", "charset":"utf8mb4", "engine"="InnoDB page_compressed=1"}, 
 *     indexes={
 *         @ORM\Index(columns={"user", "deletedAt"}),
 *         @ORM\Index(columns={"name", "deletedAt"}),
 *     }
 * )
 * @ORM\Entity
 */
class Task
{
    use ORMBehaviors\SoftDeletable\SoftDeletable,
        ORMBehaviors\Timestampable\Timestampable,
        EntityTraits\SoftDeletableMethodsTrait {
            EntityTraits\SoftDeletableMethodsTrait::setDeletedAt insteadof ORMBehaviors\SoftDeletable\SoftDeletable;
        }
    
    /**
     * @ORM\Column(type="integer", options={"unsigned" : true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    protected $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $startTime;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    protected $endTime;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $user;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $location = null;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->startTime = 
        $this->endTime = new \DateTime();
    }

    /**
     * Render as a string
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s - %s', $this->startTime-format('c'), $this->name);
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Task
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set description
     *
     * @param string $description
     * @return Task
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set startTime
     *
     * @param DateTime $startTime
     * @return Task
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return DateTime 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param DateTime $endTime
     * @return Task
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return DateTime 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set user
     *
     * @param int $user
     *
     * @return Task
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Task
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }
}
