<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Entity
 * @ORM\Table(name="comment")
 */
class Comment
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $owner;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var int
     *
     * @ORM\Column(name="repoId", type="integer")
     */
    private $repoId;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * Comment constructor.
     * @param int $repoId
     * @param string $owner
     */
    public function __construct($repoId, $owner)
    {
        $this->repoId = $repoId;
        $this->owner = $owner;
        $this->date = new \Datetime();
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
     * Set comment
     *
     * @param string $comment
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set repoId
     *
     * @param integer $repoId
     * @return Comment
     */
    public function setRepoId($repoId)
    {
        $this->repoId = $repoId;

        return $this;
    }

    /**
     * Get repoId
     *
     * @return integer 
     */
    public function getRepoId()
    {
        return $this->repoId;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Set owner
     *
     * @param User $owner
     *
     * @return Comment
     */
    public function setOwner(User $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     */
    public function getOwner()
    {
        return $this->owner;
    }
}
