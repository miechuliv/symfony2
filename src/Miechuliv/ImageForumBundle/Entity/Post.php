<?php

namespace Miechuliv\ImageForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vlabs\MediaBundle\Annotation\Vlabs;

/**
 * Post
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Miechuliv\ImageForumBundle\Entity\PostRepository")
 */
class Post
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
    * @var VlabsFile
    *
    * @ORM\OneToOne(targetEntity="Image", cascade={"persist", "remove"}, orphanRemoval=true))
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="image", referencedColumnName="id")
    * })
    * 
    * @Vlabs\Media(identifier="image_entity", upload_dir="/var/www/html/Mgag/files/images")
    * @Assert\Valid()
    */
   private $image;

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
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     **/
    private $author;
    
      /**
     * @ORM\OneToOne(targetEntity="Post")
     * @ORM\JoinColumn(name="parent_post_id", referencedColumnName="id")
     **/
    private $parentPost;
    
    /**
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="posts")
     **/
    private $categories;
    
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post")
     **/
    private $comments;
    
    /**
     * @ORM\OneToMany(targetEntity="Rating", mappedBy="post")
     **/
    private $ratings;
    
    /**
     * @ORM\OneToMany(targetEntity="Tag", mappedBy="post")
     **/
    private $tags;


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
     * @return Post
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
    * Set image
    *
    * @param Miechuliv\ImageForumBundle\Entity\Image $image
    * @return Post
    */
   public function setImage(Image $image = null)
   {
       $this->image = $image;

       return $this;
   }

   /**
    * Get image
    *
    * @return Miechuliv\ImageForumBundle\Entity\Image 
    */
   public function getImage()
   {
       return $this->image;
}

    /**
     * Set active
     *
     * @param boolean $active
     * @return Post
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
     * @return Post
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
     * @return Post
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
     * Set authorId
     *
     * @param integer $authorId
     * @return Post
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get authorId
     *
     * @return integer 
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Set parent_post_id
     *
     * @param \interger $parentPostId
     * @return Post
     */
    public function setParentPostId(\interger $parentPostId)
    {
        $this->parent_post_id = $parentPostId;

        return $this;
    }

    /**
     * Get parent_post_id
     *
     * @return \interger 
     */
    public function getParentPostId()
    {
        return $this->parent_post_id;
    }

    /**
     * Set author
     *
     * @param \Miechuliv\ImageForumBundle\Entity\User $author
     * @return Post
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

    /**
     * Set parentPost
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Post $parentPost
     * @return Post
     */
    public function setParentPost(\Miechuliv\ImageForumBundle\Entity\Post $parentPost = null)
    {
        $this->parentPost = $parentPost;

        return $this;
    }

    /**
     * Get parentPost
     *
     * @return \Miechuliv\ImageForumBundle\Entity\Post 
     */
    public function getParentPost()
    {
        return $this->parentPost;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ratings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add categories
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Category $categories
     * @return Post
     */
    public function addCategory(\Miechuliv\ImageForumBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Category $categories
     */
    public function removeCategory(\Miechuliv\ImageForumBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Add comments
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Comment $comments
     * @return Post
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
     * @return Post
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

    /**
     * Add tags
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Tag $tags
     * @return Post
     */
    public function addTag(\Miechuliv\ImageForumBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;

        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Tag $tags
     */
    public function removeTag(\Miechuliv\ImageForumBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
    
    public function __toString() {
        return $this->title;
    }
}
