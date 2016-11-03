<?php

namespace App\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="App\CoreBundle\Repository\ArticleRepository")
 * @Serializer\ExclusionPolicy("ALL")
 * @Serializer\XmlRoot("article")
 */
class Article
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\XmlAttribute
     * @Serializer\Expose
     */
    private $id;
    


    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Serializer\Expose
     * @Assert\NotBlank
     * @Assert\Length(min=2, max=100)
     * @Assert\Regex("/^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]+$/")
     */
    private $title;
    
    /**
     * @var string
     * @Serializer\Expose
     * @ORM\Column(name="leading_", type="string", length=255)
     */
    
    private $leading;
    
    /**
     * @var string
     * @Serializer\Expose
     *
     * @ORM\Column(name="body", type="string", length=255)
     */
    
    private $body;
     
    /**
     * @var \Datetime
     * @Serializer\Expose
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     */
    
    private $createdAt;
    
     /**
     * @Gedmo\Slug(fields={"title"})
     * @Serializer\Expose
     * @ORM\Column(length=255, unique=true)
     */
     
    private $slug;
    
    /**
     * @var string
     * @Serializer\Expose
     *
     * @ORM\Column(name="createdBy", type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(min=2, max=100)
     * @Gedmo\Blameable(on="create")
    */

    private $createdBy;

    /**
     * @param string $title
     * @param string $slug
     */
    public function __construct($title)
    {
        $this->title = $title;
        $this->createdAt = new \DateTime('now');
    }

    public function update(Article $article)
    {
        $this->title = $article->title;
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
     * Set title
     *
     * @param string $title
     *
     * @return Article
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
     * Set leading
     *
     * @param string $leading
     *
     * @return Article
     */
    public function setLeading($leading)
    {
        $this->leading = $leading;

        return $this;
    }

    /**
     * Get leading
     *
     * @return string
     */
    public function getLeading()
    {
        return $this->leading;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Article
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
    * Set createdAt
    *
    * @param datetime $createdAt
    */
    
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }
    
    /**
    * Get createdAt
    *
    * @return \DateTime
    */
    
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Article
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * Set createdBy
     *
     * @param string $createdBy
     *
     * @return Article
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
}
