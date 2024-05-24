<?php
declare(strict_types=1);

namespace labile\thief\Types\Payments\Query;

use labile\thief\Types\BaseType;
use labile\thief\Types\Payments\ArrayOfLabeledPrice;

/**
 * Class AnswerShippingQuery
 * If you sent an invoice requesting a shipping address and the parameter is_flexible was specified,
 * the Bot API will send an Update with a shipping_query field to the bot
 *
 */
class AnswerShippingQuery extends BaseType
{
    /**
     * @var array
     */
    protected static array $requiredParams = ['shipping_query_id', 'ok'];

    /**
     * @var array
     */
    protected static array $map = [
        'shipping_query_id' => true,
        'ok' => true,
        'shipping_options' => ArrayOfLabeledPrice::class,
        'error_message' => true,
    ];

    /**
     * Unique identifier for the query to be answered
     *
     * @var string
     */
    protected string $shippingQueryId;

    /**
     * Specify True if delivery to the specified address is possible and False if there are any problems
     *
     * @var true
     */
    protected bool $ok;

    /**
     * Required if ok is True. A JSON-serialized array of available shipping options.
     *
     * @var array
     */
    protected array $shippingOptions;

    /**
     * Required if ok is False. Error message in human readable form that explains why it is impossible to complete
     * the order
     *
     * @var string
     */
    protected string $errorMessage;

    /**
     * @author MY
     * @return string
     */
    public function getShippingQueryId(): string
    {
        return $this->shippingQueryId;
    }

    /**
     * @param string $shippingQueryId
     *
          * @return void
     *@author MY
     *
     */
    public function setShippingQueryId(string $shippingQueryId): void
    {
        $this->shippingQueryId = $shippingQueryId;
    }

    /**
     * @author MY
     * @return bool
     */
    public function getOk(): bool
    {
        return $this->ok;
    }

    /**
     * @param bool $ok
     *
     * @return void
     *@author MY
     *
     */
    public function setOk(bool $ok): void
    {
        $this->ok = $ok;
    }

    /**
     * @author MY
     * @return array
     */
    public function getShippingOptions(): array
    {
        return $this->shippingOptions;
    }

    /**
     * @param array $shippingOptions
     *
          * @return void
     *@author MY
     *
     */
    public function setShippingOptions(array $shippingOptions): void
    {
        $this->shippingOptions = $shippingOptions;
    }

    /**
     * @author MY
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     *
          * @return void
     *@author MY
     *
     */
    public function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }
}
