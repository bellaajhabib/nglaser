<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;
use Hateoas\Configuration\Annotation\Relation;
use Hateoas\Configuration\Annotation\Route;
use Hateoas\Configuration\Annotation\Exclusion;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;

/**
 * Setting
 * @Relation(
 *      "_self",
 *       href = @Route(
 *          "api_get_setting",
 *           parameters = { "setting" = "expr(object.getId())" }
 *      ),
 *      exclusion = @Exclusion(groups = {"list", "detail"})
 * ) 
 * @Relation(
 *      "_all",
 *      href = @Route("api_get_settings"),
 *      exclusion = @Exclusion(groups = {"detail"})
 * )   
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\SettingRepository")
 */
class Setting extends BaseEntity
{

    /**
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @ORM\Column(name="value", type="text")
     */
    private $value;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Setting
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
     * Set value
     *
     * @param string $value
     *
     * @return Setting
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}

