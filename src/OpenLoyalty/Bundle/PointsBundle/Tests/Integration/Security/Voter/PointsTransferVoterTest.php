<?php
/**
 * Copyright © 2017 Divante, Inc. All rights reserved.
 * See LICENSE for license details.
 */
namespace OpenLoyalty\Bundle\PointsBundle\Tests\Integration\Security\Voter;

use OpenLoyalty\Bundle\CoreBundle\Tests\Integration\BaseVoterTest;
use OpenLoyalty\Bundle\PointsBundle\Security\Voter\PointsTransferVoter;
use OpenLoyalty\Component\Account\Domain\PointsTransferId;
use OpenLoyalty\Component\Account\Domain\ReadModel\PointsTransferDetails;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;

/**
 * Class PointsTransferVoterTest.
 */
class PointsTransferVoterTest extends BaseVoterTest
{
    private const TRANSFER_ID = '00000000-0000-474c-b092-b0dd880c0700';

    /**
     * @test
     */
    public function it_works(): void
    {
        $attributes = [
            PointsTransferVoter::LIST_POINTS_TRANSFERS => ['seller' => true, 'customer' => false, 'admin' => true],
            PointsTransferVoter::LIST_CUSTOMER_POINTS_TRANSFERS => ['seller' => false, 'customer' => true, 'admin' => false],
            PointsTransferVoter::ADD_POINTS => ['seller' => false, 'customer' => false, 'admin' => true],
            PointsTransferVoter::SPEND_POINTS => ['seller' => false, 'customer' => false, 'admin' => true],
            PointsTransferVoter::CANCEL => ['seller' => false, 'customer' => false, 'admin' => true, 'id' => self::TRANSFER_ID],
        ];

        $voter = new PointsTransferVoter();

        $this->makeAssertions($attributes, $voter);
    }

    /**
     * @test
     */
    public function it_is_grand_access_to_add_point_when_user_is_seller_and_is_allowed_to_add_points(): void
    {
        $voter = new PointsTransferVoter();
        $this->assertEquals(VoterInterface::ACCESS_GRANTED, $voter->vote($this->getSellerToken(true), null, [PointsTransferVoter::ADD_POINTS]));
    }

    /**
     * @test
     */
    public function it_is_denied_access_to_add_point_when_user_is_seller_and_is_not_allowed_to_add_points(): void
    {
        $voter = new PointsTransferVoter();
        $this->assertEquals(VoterInterface::ACCESS_DENIED, $voter->vote($this->getSellerToken(false), null, [PointsTransferVoter::ADD_POINTS]));
    }

    /**
     * @param $id
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getSubjectById($id)
    {
        $level = $this->getMockBuilder(PointsTransferDetails::class)->disableOriginalConstructor()->getMock();
        $level->method('getPointsTransferId')->willReturn(new PointsTransferId($id));

        return $level;
    }
}
