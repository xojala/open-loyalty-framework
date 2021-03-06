<?php
/**
 * Copyright © 2017 Divante, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace OpenLoyalty\Bundle\CampaignBundle\Service;

use OpenLoyalty\Bundle\CampaignBundle\Model\CampaignPhoto;
use OpenLoyalty\Component\Campaign\Domain\Model\CampaignFile;

/**
 * Class CampaignPhotoUploader.
 */
class CampaignPhotoUploader extends CampaignFileUploader
{
    const FOLDER_NAME = 'campaign_photos';

    /**
     * {@inheritdoc}
     */
    public function getFolderName(): string
    {
        return self::FOLDER_NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function getNewInstance(): CampaignFile
    {
        return new CampaignPhoto();
    }
}
