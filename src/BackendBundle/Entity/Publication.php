<?php

namespace BackendBundle\Entity;

/**
 * Publication
 */
class Publication
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $document;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var string
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $creteadAt;

    /**
     * @var \BackendBundle\Entity\User
     */
    private $user;


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
     * Set text
     *
     * @param string $text
     *
     * @return Publication
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set document
     *
     * @param string $document
     *
     * @return Publication
     */
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return string
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Publication
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Publication
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set creteadAt
     *
     * @param \DateTime $creteadAt
     *
     * @return Publication
     */
    public function setCreteadAt($creteadAt)
    {
        $this->creteadAt = $creteadAt;

        return $this;
    }

    /**
     * Get creteadAt
     *
     * @return \DateTime
     */
    public function getCreteadAt()
    {
        return $this->creteadAt;
    }

    /**
     * Set user
     *
     * @param \BackendBundle\Entity\User $user
     *
     * @return Publication
     */
    public function setUser(\BackendBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BackendBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}

