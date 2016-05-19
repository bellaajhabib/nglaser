<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Validator\Constraints\CommunityPositionDuplicate;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;
use Hateoas\Configuration\Annotation\Relation;
use Hateoas\Configuration\Annotation\Route;
use Hateoas\Configuration\Annotation\Exclusion;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;


/**
 * Community
 * @Relation(
 *      "_self",
 *       href = @Route(
 *          "api_get_community",
 *           parameters = { "community" = "expr(object.getId())" }
 *      ),
 *      exclusion = @Exclusion(groups = {"list", "detail"})
 * ) 
 * @Relation(
 *      "_all",
 *      href = @Route("api_get_communities"),
 *      exclusion = @Exclusion(groups = {"detail"})
 * ) 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CommunityRepository")
 * @CommunityPositionDuplicate(groups={"admin"})
 */
class Community extends BaseEntity implements PositionInterface
{

    
    /**
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @Assert\NotBlank(groups={"admin"}, message="Title can not be blank.")
     * @Assert\Length(groups={"admin"}, min=5, max=80, minMessage="Title must be between 5 to 80 characters long.", maxMessage="Title must be between 5 to 80 characters long.")
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @Assert\NotBlank(groups={"admin"}, message="Description can not be blank.")
     * @Assert\Length(groups={"admin"}, min=25, max=1000, minMessage="Description length must be between 5 to 80 characters long.", maxMessage="Description length must be between 5 to 80 characters long.")
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @Assert\NotBlank(groups={"admin"}, message="The organization name can not be blank.")
     * @Assert\Length(groups={"admin"}, min=5, max=80, minMessage="The organization name must be between 5 to 80 characters long.", maxMessage="The organization name must be between 5 to 80 characters long.")
     * @ORM\Column(name="organization", type="string", length=255)
     */
    private $organization;
    
    
    /**
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @Assert\NotBlank(groups={"admin"}, message="The organization website can not be left blank.")
     * @Assert\Url(groups={"admin"}, message="Please enter a valid url.", checkDNS=true, dnsMessage="Please enter a valid url.")
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;
    
    /**
     * @var \DateTime
     * @Groups({"detail", "list"})
     * @Type("DateTime<'F, Y'>")
     * @Assert\DateTime()
     * @Assert\NotBlank(groups={"admin"}, message="Start Date can not be blank.")
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     * @Type("DateTime<'F, Y'>")
     * @Groups({"detail", "list"})
     * @Assert\DateTime()
     * @ORM\Column(name="endDate", type="datetime", nullable=true)
     */
    private $endDate;
    
    /**
     * @var integer
     * @Groups({"detail", "list"})
     * @Type("integer")
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Community
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Community
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
     * Set Organization
     *
     * @param string $organization
     *
     * @return Community
     */
    public function setOrganization($organization)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Get Organization
     *
     * @return string
     */
    public function getOrganization()
    {
        return $this->organization;
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
     * @return Community
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
    
    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Job
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Job
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
    
    public function __toString() 
    {
        return 'Community';
    }
}

