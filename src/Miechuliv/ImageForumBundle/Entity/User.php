<?php

namespace Miechuliv\ImageForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Miechuliv\ImageForumBundle\Entity\UserRepository")
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="display_name", type="string", length=255)
     */
    private $displayName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=32)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=32)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime")
     */
    private $dateAdded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_modified", type="datetime")
     */
    private $dateModified;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_logged", type="datetime")
     */
    private $lastLogged;

     /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="author")
     **/
    private $posts;
    
     /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="author")
     **/
    private $comments;
    
    /**
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="author")
     **/
    private $ratings;
    

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
     * Set displayName
     *
     * @param string $displayName
     * @return User
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;

        return $this;
    }

    /**
     * Get displayName
     *
     * @return string 
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return User
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return User
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime 
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set dateModified
     *
     * @param \DateTime $dateModified
     * @return User
     */
    public function setDateModified($dateModified)
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    /**
     * Get dateModified
     *
     * @return \DateTime 
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }

    /**
     * Set lastLogged
     *
     * @param \DateTime $lastLogged
     * @return User
     */
    public function setLastLogged($lastLogged)
    {
        $this->lastLogged = $lastLogged;

        return $this;
    }

    /**
     * Get lastLogged
     *
     * @return \DateTime 
     */
    public function getLastLogged()
    {
        return $this->lastLogged;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ratings = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add posts
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Post $posts
     * @return User
     */
    public function addPost(\Miechuliv\ImageForumBundle\Entity\Post $posts)
    {
        $this->posts[] = $posts;

        return $this;
    }

    /**
     * Remove posts
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Post $posts
     */
    public function removePost(\Miechuliv\ImageForumBundle\Entity\Post $posts)
    {
        $this->posts->removeElement($posts);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Add comments
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Comment $comments
     * @return User
     */
    public function addComment(\Miechuliv\ImageForumBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Comment $comments
     */
    public function removeComment(\Miechuliv\ImageForumBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add ratings
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Rating $ratings
     * @return User
     */
    public function addRating(\Miechuliv\ImageForumBundle\Entity\Rating $ratings)
    {
        $this->ratings[] = $ratings;

        return $this;
    }

    /**
     * Remove ratings
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Rating $ratings
     */
    public function removeRating(\Miechuliv\ImageForumBundle\Entity\Rating $ratings)
    {
        $this->ratings->removeElement($ratings);
    }

    /**
     * Get ratings
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRatings()
    {
        return $this->ratings;
    }
    
    
}
