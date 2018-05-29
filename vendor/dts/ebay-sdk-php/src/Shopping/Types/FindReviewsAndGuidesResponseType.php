<?php
/**
 * DO NOT EDIT THIS FILE!
 *
 * This file was automatically generated from external sources.
 *
 * Any manual change here will be lost the next time the SDK
 * is updated. You've been warned!
 */

namespace DTS\eBaySDK\Shopping\Types;

/**
 *
 * @property integer $ReviewCount
 * @property integer $BuyingGuideCount
 * @property integer $ReviewerRank
 * @property integer $TotalHelpfulnessVotes
 * @property \DTS\eBaySDK\Shopping\Types\ProductIDType $ProductID
 * @property string $ReviewsAndGuidesURL
 * @property integer $PageNumber
 * @property integer $TotalPages
 * @property \DTS\eBaySDK\Shopping\Types\BuyingGuideDetailsType $BuyingGuideDetails
 * @property \DTS\eBaySDK\Shopping\Types\ReviewDetailsType $ReviewDetails
 * @property integer $PositiveHelpfulnessVotes
 */
class FindReviewsAndGuidesResponseType extends \DTS\eBaySDK\Shopping\Types\AbstractResponseType
{
    /**
     * @var array Properties belonging to objects of this class.
     */
    private static $propertyTypes = [
        'ReviewCount' => [
            'type' => 'integer',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'ReviewCount'
        ],
        'BuyingGuideCount' => [
            'type' => 'integer',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'BuyingGuideCount'
        ],
        'ReviewerRank' => [
            'type' => 'integer',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'ReviewerRank'
        ],
        'TotalHelpfulnessVotes' => [
            'type' => 'integer',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'TotalHelpfulnessVotes'
        ],
        'ProductID' => [
            'type' => 'DTS\eBaySDK\Shopping\Types\ProductIDType',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'ProductID'
        ],
        'ReviewsAndGuidesURL' => [
            'type' => 'string',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'ReviewsAndGuidesURL'
        ],
        'PageNumber' => [
            'type' => 'integer',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'PageNumber'
        ],
        'TotalPages' => [
            'type' => 'integer',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'TotalPages'
        ],
        'BuyingGuideDetails' => [
            'type' => 'DTS\eBaySDK\Shopping\Types\BuyingGuideDetailsType',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'BuyingGuideDetails'
        ],
        'ReviewDetails' => [
            'type' => 'DTS\eBaySDK\Shopping\Types\ReviewDetailsType',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'ReviewDetails'
        ],
        'PositiveHelpfulnessVotes' => [
            'type' => 'integer',
            'repeatable' => false,
            'attribute' => false,
            'elementName' => 'PositiveHelpfulnessVotes'
        ]
    ];

    /**
     * @param array $values Optional properties and values to assign to the object.
     */
    public function __construct(array $values = [])
    {
        list($parentValues, $childValues) = self::getParentValues(self::$propertyTypes, $values);

        parent::__construct($parentValues);

        if (!array_key_exists(__CLASS__, self::$properties)) {
            self::$properties[__CLASS__] = array_merge(self::$properties[get_parent_class()], self::$propertyTypes);
        }

        if (!array_key_exists(__CLASS__, self::$xmlNamespaces)) {
            self::$xmlNamespaces[__CLASS__] = 'xmlns="urn:ebay:apis:eBLBaseComponents"';
        }

        $this->setValues(__CLASS__, $childValues);
    }
}
