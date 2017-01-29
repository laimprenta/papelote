<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Site
 *
 * @ORM\Table(name="site")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\SiteRepository")
 */
class Site
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string;
     *
     * @ORM\Column(name="security_token", length=255, type="string", unique=true)
     */
    private $securityToken;

    /**
     *
     * @ORM\OneToMany(targetEntity="Article", mappedBy="site")
     */
    private $articles;


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
     * @return Site
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
     * Set securityToken
     *
     * @param string $securityToken
     * @return Site
     */
    public function setSecurityToken($securityToken)
    {
        $this->securityToken = $securityToken;

        return $this;
    }

    /**
     * Get securityToken
     *
     * @return string 
     */
    public function getSecurityToken()
    {
        return $this->securityToken;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add articles
     *
     * @param \ApiBundle\Entity\Article $articles
     * @return Site
     */
    public function addArticle(\ApiBundle\Entity\Article $articles)
    {
        $this->articles[] = $articles;

        return $this;
    }

    /**
     * Remove articles
     *
     * @param \ApiBundle\Entity\Article $articles
     */
    public function removeArticle(\ApiBundle\Entity\Article $articles)
    {
        $this->articles->removeElement($articles);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }


    function __toString()
    {
        return $this->getName();
    }
}
