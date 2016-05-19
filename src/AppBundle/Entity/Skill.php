<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints\SkillPosition;
use JMS\Serializer\Annotation\Groups;
use Hateoas\Configuration\Annotation\Relation;
use Hateoas\Configuration\Annotation\Route;
use Hateoas\Configuration\Annotation\Exclusion;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;


/**
 * Skill
 * @Relation(
 *      "_self",
 *       href = @Route(
 *          "api_get_skill",
 *           parameters = { "skill" = "expr(object.getId())" }
 *      ),
 *      exclusion = @Exclusion(groups = {"list", "detail"})
 * ) 
 * @Relation(
 *      "_all",
 *      href = @Route("api_get_skills"),
 *      exclusion = @Exclusion(groups = {"detail"})
 * )  
 * 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SkillRepository")
 * @SkillPosition(groups={"admin"})
 */
class Skill extends BaseEntity
{
    /**
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @Assert\NotBlank(groups={"admin"}, message="Title can not be blank.")
     * @Assert\Length(groups={"admin"}, min=2, max=80, minMessage="Title must be between 2 to 80 characters long.", maxMessage="Title must be between 2 to 80 characters long.")
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     * @Groups({"detail", "list"})
     * @Type("integer")
     * @Assert\NotBlank(groups={"admin"}, message="Title can not be blank.")
     * @Assert\Type(type="integer", groups={"admin"})
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var integer
     * @Groups({"detail", "list"})
     * @Type("integer")
     * @Assert\NotBlank(groups={"admin"}, message="Title can not be blank.")
     * @Assert\Type(type="integer", groups={"admin"})
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @Assert\NotBlank(groups={"admin"}, message="Title can not be blank.")
     * @ORM\Column(name="type", type="string", length=100)
     */
    private $type;
    

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Skill
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
     * Set level
     *
     * @param integer $level
     *
     * @return Skill
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return Skill
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Skill
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    
    public function __toString() 
    {
        return 'Skill';
    }
}

