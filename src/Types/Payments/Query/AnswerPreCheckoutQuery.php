<?php
declare(strict_types=1);

namespace labile\thief\Types\Payments\Query;


use labile\thief\Types\BaseType;

/**
 * Class AnswerPreCheckoutQuery
 * Use this method to respond to such pre-checkout queries.
 *
 */
class AnswerPreCheckoutQuery extends BaseType
{
    /**
     * @var array
     */
    protected static array $requiredParams = ['pre_checkout_query_id', 'ok'];

    /**
     * @var array
     */
    protected static array $map = [
        'pre_checkout_query_id' => true,
        'ok' => true,
        'error_message' => true,
    ];

    /**
     * Unique identifier for the query to be answered
     *
     * @var string
     */
    protected string $preCheckoutQueryId;

    /**
     * Specify True if everything is alright
     *
     * @var bool
     */
    protected bool $ok;

    /**
     * Error message in human readable form that explains the reason for failure to proceed with the checkout
     *
     * @var string
     */
    protected string $errorMessage;

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

    /**
     * @author MY
     * @return string
     */
    public function getPreCheckoutQueryId(): string
    {
        return $this->preCheckoutQueryId;
    }

    /**
     * @param string $preCheckoutQueryId
          *
     * @return void
     *@author MY
     *
     */
    public function setPreCheckoutQueryId(string $preCheckoutQueryId): void
    {
        $this->preCheckoutQueryId = $preCheckoutQueryId;
    }
}
