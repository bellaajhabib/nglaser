<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;
use Hateoas\Configuration\Annotation\Relation;
use Hateoas\Configuration\Annotation\Route;
use Hateoas\Configuration\Annotation\Exclusion;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Type;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Page
 * @Relation(
 *      "_self",
 *       href = @Route(
 *          "api_get_page",
 *           parameters = { "slug" = "expr(object.getSlug())" }
 *      ),
 *      exclusion = @Exclusion(groups = {"list", "detail"})
 * ) 
 * @Relation(
 *      "_all",
 *      href = @Route("api_get_pages"),
 *      exclusion = @Exclusion(groups = {"detail"})
 * ) 
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\PageRepository")
 * @UniqueEntity(fields="title", message="Your title must be unique.")
 */
class Page extends BaseEntity
{
    /**
     * The Page's Title
     * @var string
     * @Groups({"detail", "list"})
     * @Type("string")
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     * @Exclude()
     * @ORM\Column(name="s3_key", type="string", length=255)
     */
    private $s3Key;
    
    /** 
     * @var string 
     * @Groups({"detail", "list"})
     * @Type("string")
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;
    
    /**
     * @var UploadedFile
     * @Exclude()
     */    
    private $picture;


    /**
     * Page's Description
     * @var string
     * @Groups({"detail"})
     * @Type("string")
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /** 
     * The Picture's Url
     * @var string 
     * @Type("string")
     * @Groups({"detail"})
     */
    private $pictureUrl;

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Page
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
     * Set s3Key
     *
     * @param string $s3Key
     *
     * @return Page
     */
    public function setS3Key($s3Key)
    {
        $this->s3Key = $s3Key;

        return $this;
    }

    /**
     * Get s3Key
     *
     * @return string
     */
    public function getS3Key()
    {
        return $this->s3Key;
    }
    
    /** 
     * Get Picture
     * @return UploadedFile
     */
    public function getPicture()
    {
        return $this->picture;
    }
    
    /** 
     * Set Picture
     * @param type $picture
     * @return \AppBundle\Entity\Page
     */
    public function setPicture($picture)
    {
        //Done to trigger doctrine listener
        $this->preUpdate();
        $this->picture = $picture;
        return $this;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Page
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
    
    public function getPictureUrl()
    {
        return $this->pictureUrl;
    }
    
    public function setPictureUrl($pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;
        
        return $pictureUrl;
    }
    
    public function getSlug() 
    {
        return $this->slug;
    }
    
    public function setSlug($slug)
    {
        $this->slug = $slug;
        
        return $this;
    }
    
    public function __toString()   
    {
        return 'Page';
    }
   
    
}

