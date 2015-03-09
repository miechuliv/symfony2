<?php

namespace Miechuliv\ImageForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Miechuliv\ImageForumBundle\Entity\RatingRepository")
 */
class Rating
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
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="ratings")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     **/
    private $post;
    
     /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="ratings")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     **/
    private $author;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_positive", type="boolean")
     */
    private $isPositive;


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
     * Set userId
     *
     * @param integer $userId
     * @return Rating
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set postId
     *
     * @param integer $postId
     * @return Rating
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;

        return $this;
    }

    /**
     * Get postId
     *
     * @return integer 
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set isPositive
     *
     * @param boolean $isPositive
     * @return Rating
     */
    public function setIsPositive($isPositive)
    {
        $this->isPositive = $isPositive;

        return $this;
    }

    /**
     * Get isPositive
     *
     * @return boolean 
     */
    public function getIsPositive()
    {
        return $this->isPositive;
    }

    /**
     * Set post
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Post $post
     * @return Rating
     */
    public function setPost(\Miechuliv\ImageForumBundle\Entity\Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \Miechuliv\ImageForumBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set author
     *
     * @param \Miechuliv\ImageForumBundle\Entity\User $author
     * @return Rating
     */
    public function setAuthor(\Miechuliv\ImageForumBundle\Entity\User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \Miechuliv\ImageForumBundle\Entity\User 
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
