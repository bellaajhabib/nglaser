<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Validator\Constraints\JobDate;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;
use Hateoas\Configuration\Annotation\Relation;
use Hateoas\Configuration\Annotation\Route;
use Hateoas\Configuration\Annotation\Exclusion;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;


/**
 * Job
 * @Relation(
 *      "_self",
 *       href = @Route(
 *          "api_get_job",
 *           parameters = { "job" = "expr(object.getId())" }
 *      ),
 *      exclusion = @Exclusion(groups = {"list", "detail"})
 * ) 
 * @Relation(
 *      "_all",
 *      href = @Route("api_get_jobs"),
 *      exclusion = @Exclusion(groups = {"detail"})
 * )
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\JobRepository")
 * @JobDate(groups={"admin"})
 */
class Job extends BaseEntity
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @Assert\NotBlank(groups={"admin"}, message="Company name can not be blank.")
     * @Assert\Length(groups={"admin"}, min=5, max=80, minMessage="Company name must be between 5 to 80 characters long.", maxMessage="Company name must be between 5 to 80 characters long.")
     * @ORM\Column(name="company", type="string", length=255)
     */
    private $company;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Job
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
     * @return Job
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

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Job
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    public function __toString() 
    {
        return 'Job';
    }
}

