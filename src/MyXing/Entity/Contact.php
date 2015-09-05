<?php
namespace MyXing\Entity;

class Contact
{
    /** @var string */
    private $displayName;
    /** @var string */
    private $image;
    /** @var string */
    private $organization;

    /**
     * @param \stdClass $contactObject
     */
    public function __construct(\stdClass $contactObject)
    {
        $this->displayName = $contactObject->display_name;
        $this->image = $contactObject->photo_urls->medium_thumb;
        $this->organization = $contactObject->professional_experience->primary_company->name;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getOrganization()
    {
        return $this->organization;
    }
}