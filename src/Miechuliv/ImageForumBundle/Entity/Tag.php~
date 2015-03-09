<?php

namespace Miechuliv\ImageForumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Miechuliv\ImageForumBundle\Entity\TagRepository")
 */
class Tag
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
     * @ORM\Column(name="value", type="string", length=255)
     */
    private $value;
    
    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="tags")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id")
     **/
    private $post;
    
    


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
     * Set value
     *
     * @param string $value
     * @return Tag
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

    /**
     * Set post
     *
     * @param \Miechuliv\ImageForumBundle\Entity\Post $post
     * @return Tag
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
}
