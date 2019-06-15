<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mission
 *
 * @ORM\Table(name="mission")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MissionRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Mission
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
     * @var \DateTime
     *
     * @ORM\Column(name="service_date", type="datetime")
     */
    private $serviceDate;

    /**
     * @var string
     *
     * @ORM\Column(name="product_name", type="string", length=255)
     */
    private $productName;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var string
     *
     * @ORM\Column(name="destination_country", type="string", length=255)
     */
    private $destinationCountry;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_name", type="string", length=255)
     */
    private $vendorName;

    /**
     * @var string
     *
     * @ORM\Column(name="vendor_email", type="string", length=255)
     */
    private $vendorEmail;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="missions")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

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
     * Set serviceDate
     *
     * @param \DateTime $serviceDate
     * @return Mission
     */
    public function setServiceDate($serviceDate)
    {
        $this->serviceDate = $serviceDate;

        return $this;
    }

    /**
     * Get serviceDate
     *
     * @return \DateTime 
     */
    public function getServiceDate()
    {
        return $this->serviceDate;
    }

    /**
     * Set productName
     *
     * @param string $productName
     * @return Mission
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string 
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     * @return Mission
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set destinationCountry
     *
     * @param string $destinationCountry
     * @return Mission
     */
    public function setDestinationCountry($destinationCountry)
    {
        $this->destinationCountry = $destinationCountry;

        return $this;
    }

    /**
     * Get destinationCountry
     *
     * @return string 
     */
    public function getDestinationCountry()
    {
        return $this->destinationCountry;
    }

    /**
     * Set vendorName
     *
     * @param string $vendorName
     * @return Mission
     */
    public function setVendorName($vendorName)
    {
        $this->vendorName = $vendorName;

        return $this;
    }

    /**
     * Get vendorName
     *
     * @return string 
     */
    public function getVendorName()
    {
        return $this->vendorName;
    }

    /**
     * Set vendorEmail
     *
     * @param string $vendorEmail
     * @return Mission
     */
    public function setVendorEmail($vendorEmail)
    {
        $this->vendorEmail = $vendorEmail;

        return $this;
    }

    /**
     * Get vendorEmail
     *
     * @return string 
     */
    public function getVendorEmail()
    {
        return $this->vendorEmail;
    }

    /**
     * Set client
     *
     * @param \AppBundle\Entity\User $client
     * @return Mission
     */
    public function setClient(\AppBundle\Entity\User $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\User 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Mission
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
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
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Mission
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PreUpdate()
     */
    public function updateModifiedDatetime() {
        // update the modified time
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * @ORM\PrePersist()
     */
    public function updateCreatedDate() {
        // update the modified time
        $this->setCreatedAt(new \DateTime());
        $this->setUpdatedAt(new \DateTime());
    }
}
