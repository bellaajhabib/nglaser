<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints\ProjectPositionDuplicate;
use JMS\Serializer\Annotation\Groups;
use Hateoas\Configuration\Annotation\Relation;
use Hateoas\Configuration\Annotation\Route;
use Hateoas\Configuration\Annotation\Exclusion;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;

/**
 * Project
 * @Relation(
 *      "_self",
 *       href = @Route(
 *          "api_get_project",
 *           parameters = { "project" = "expr(object.getId())" }
 *      ),
 *      exclusion = @Exclusion(groups = {"list", "detail"})
 * ) 
 * @Relation(
 *      "_all",
 *      href = @Route("api_get_projects"),
 *      exclusion = @Exclusion(groups = {"detail"})
 * )  
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ProjectRepository")
 * @ProjectPositionDuplicate(groups={"admin"})
 */
class Project extends BaseEntity implements PositionInterface
{

    /**
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @Assert\NotBlank(groups={"admin"}, message="Title can not be blank.")
     * @Assert\Length(groups={"admin"}, min=5, max=80, minMessage="Title must be between 5 to 80 characters long.", maxMessage="Title must be between 5 to 80 characters long.")
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @Assert\NotBlank(groups={"admin"}, message="Description can not be blank.")
     * @Assert\Length(groups={"admin"}, min=25, max=1000, minMessage="Description length must be between 5 to 80 characters long.", maxMessage="Description length must be between 5 to 80 characters long.")
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var integer
     * @Groups({"detail", "list"})
     * @Type("integer")
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @Assert\NotBlank(groups={"admin"}, message="The project url can not be left blank.")
     * @Assert\Url(groups={"admin"}, message="Please enter a valid url.", checkDNS=true, dnsMessage="Please enter a valid url.")
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Project
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
     *
     * @return Project
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
     * Set position
     *
     * @param integer $position
     *
     * @return Project
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
     * Set url
     *
     * @param string $url
     *
     * @return Project
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
    
    public function __toString()
    {
        return 'Project';
    }
}

