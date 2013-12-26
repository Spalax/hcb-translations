<?php
namespace HcbTranslations\Entity;

use Doctrine\ORM\Mapping as ORM;
use HcBackend\Entity\EntityInterface;

/**
 * Translation
 *
 * @ORM\Table(name="translation")
 * @ORM\Entity
 */
class Translation implements EntityInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=6, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=50, nullable=false)
     */
    private $module;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="po_updated_timestamp", type="datetime", nullable=false)
     */
    private $poUpdatedTimestamp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="js_updated_timestamp", type="datetime", nullable=false)
     */
    private $jsUpdatedTimestamp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_timestamp", type="datetime", nullable=false)
     */
    private $createdTimestamp;

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
     * Set code
     *
     * @param string $code
     * @return Translation
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set poUpdatedTimestamp
     *
     * @param \DateTime $poUpdatedTimestamp
     * @return Translation
     */
    public function setPoUpdatedTimestamp($poUpdatedTimestamp)
    {
        $this->poUpdatedTimestamp = $poUpdatedTimestamp;

        return $this;
    }

    /**
     * Get poUpdatedTimestamp
     *
     * @return \DateTime 
     */
    public function getPoUpdatedTimestamp()
    {
        return $this->poUpdatedTimestamp;
    }

    /**
     * Set jsUpdatedTimestamp
     *
     * @param \DateTime $jsUpdatedTimestamp
     * @return Translation
     */
    public function setJsUpdatedTimestamp($jsUpdatedTimestamp)
    {
        $this->jsUpdatedTimestamp = $jsUpdatedTimestamp;

        return $this;
    }

    /**
     * Get jsUpdatedTimestamp
     *
     * @return \DateTime 
     */
    public function getJsUpdatedTimestamp()
    {
        return $this->jsUpdatedTimestamp;
    }

    /**
     * Set createdTimestamp
     *
     * @param \DateTime $createdTimestamp
     * @return Translation
     */
    public function setCreatedTimestamp($createdTimestamp)
    {
        $this->createdTimestamp = $createdTimestamp;

        return $this;
    }

    /**
     * Get createdTimestamp
     *
     * @return \DateTime 
     */
    public function getCreatedTimestamp()
    {
        return $this->createdTimestamp;
    }

    /**
     * Set module
     *
     * @param string $module
     * @return Translation
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string 
     */
    public function getModule()
    {
        return $this->module;
    }
}
