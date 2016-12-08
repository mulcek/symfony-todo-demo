<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Knp\DoctrineBehaviors\Model as ORMBehaviors,
    Symfony\Component\Validator\Constraints as Assert,
//    AppBundle\Entity as Entities,
    AppBundle\Entity\Traits as EntityTraits
;

/**
 * @ORM\Table(options={"collate"="utf8mb4_unicode_ci", "charset":"utf8mb4", "engine"="InnoDB page_compressed=1"}, 
 *     indexes={
 *         @ORM\Index(columns={"name", "deletedAt"}),
 *         @ORM\Index(columns={"surname", "deletedAt"}),
 *     }
 * )
 * @ORM\Entity
 */
class User
{
    use ORMBehaviors\SoftDeletable\SoftDeletable,
        ORMBehaviors\Timestampable\Timestampable,
        EntityTraits\SoftDeletableMethodsTrait {
            EntityTraits\SoftDeletableMethodsTrait::setDeletedAt insteadof ORMBehaviors\SoftDeletable\SoftDeletable;
        }

    /**
     * @ORM\Column(name="id", type="integer", options={"unsigned" : true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * 
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @Assert\NotBlank()
     * 
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $surname;

    /**
     * @ORM\Column(name="localeCode", type="string", length=8, nullable=false, options={"default"="en"})
     */
    protected $locale = 'en';
   
    /**
     * Constructor
     */
    public function __construct()
    {
    }
    
    /**
     * Render as a string
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf('%s %s', $this->name, $this->surname); 
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
     * @return CTPUser
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
     * Set surname
     *
     * @param string $surname
     * @return CTPUser
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set locale
     *
     * @param string $locale
     * @return CTPUser
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string 
     */
    public function getLocale()
    {
        return $this->locale;
    }
}