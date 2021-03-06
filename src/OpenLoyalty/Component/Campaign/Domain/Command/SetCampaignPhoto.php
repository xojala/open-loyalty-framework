<?php
/**
 * Copyright © 2017 Divante, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace OpenLoyalty\Component\Campaign\Domain\Command;

use OpenLoyalty\Bundle\CampaignBundle\Model\CampaignPhoto;
use OpenLoyalty\Component\Campaign\Domain\CampaignId;
use OpenLoyalty\Component\Campaign\Domain\Model\CampaignFile;

/**
 * Class SetCampaignPhoto.
 */
class SetCampaignPhoto extends CampaignCommand
{
    /**
     * @var CampaignPhoto
     */
    protected $campaignPhoto;

    /**
     * SetCampaignPhoto constructor.
     *
     * @param CampaignId   $campaignId
     * @param CampaignFile $campaignFile
     */
    public function __construct(CampaignId $campaignId, CampaignFile $campaignFile)
    {
        parent::__construct($campaignId);
        $this->campaignPhoto = $campaignFile;
    }

    /**
     * @return CampaignPhoto
     */
    public function getCampaignPhoto(): CampaignPhoto
    {
        return $this->campaignPhoto;
    }
}
