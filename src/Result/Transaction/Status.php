<?php

namespace Paynl\Result\Transaction;

use Paynl\Result\Result;

class Status extends Result
{
    /**
     * @return string The EX-code of the transaction
     */
    public function getTransactionId()
    {
        return $this->data['paymentDetails']['transactionId'];
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->data['paymentDetails']['orderId'];
    }

    /**
     * @return int
     */
    public function getPaymentProfileId()
    {
        return $this->data['paymentDetails']['paymentProfileId'];
    }

    /**
     * @return mixed the status id
     */
    public function getState()
    {
        return $this->data['paymentDetails']['state'];
    }

    /**
     * @return string The name of the status
     */
    public function getStateName()
    {
        return $this->data['paymentDetails']['stateName'];
    }

    /**
     * @return float|int The amount in euro
     */
    public function getAmount()
    {
        return $this->data['paymentDetails']['amount']['value'] / 100;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->data['paymentDetails']['amount']['currency'];
    }

    /**
     * @return float|int The paid amount
     */
    public function getAmountOriginal()
    {
        return $this->data['paymentDetails']['amountOriginal']['value'] / 100;
    }

    /**
     * @return float|int The paid amount
     */
    public function getAmountOriginalCurrency()
    {
        return $this->data['paymentDetails']['amountOriginal']['currency'];
    }

    /**
     * @return float|int The paid amount
     */
    public function getAmountPaidOriginal()
    {
        return $this->data['paymentDetails']['amountPaidOriginal']['value'] / 100;
    }

    /**
     * @return float|int The paid amount
     */
    public function getAmountPaidOriginalCurrency()
    {
        return $this->data['paymentDetails']['amountPaidOriginal']['currency'];
    }
    
    /**
     * @return float|int The paid amount
     */
    public function getAmountPaid()
    {
        return $this->data['paymentDetails']['amountPaid']['value'] / 100;
    }

    /**
     * @return float|int The paid amount
     */
    public function getAmountPaidCurrency()
    {
        return $this->data['paymentDetails']['amountPaid']['currency'];
    }

    /**
     * @return float|int The amount that has been refunded in the used currency
     */
    public function getAmountRefundOriginal()
    {
        return $this->data['paymentDetails']['amountRefundOriginal']['value'] / 100;
    }

    /**
     * @return float|int The amount that has been refunded in the used currency
     */
    public function getAmountRefundOriginalCurrency()
    {
        return $this->data['paymentDetails']['amountRefundOriginal']['currency'];
    }

    /**
     * @return float|int The amount that has been refunded in the used currency
     */
    public function getAmountRefund()
    {
        return $this->data['paymentDetails']['amountRefund']['value'] / 100;
    }

    /**
     * @return float|int The amount that has been refunded in the used currency
     */
    public function getAmountRefundCurrency()
    {
        return $this->data['paymentDetails']['amountRefund']['currency'];
    }

    /**
     * Checks whether the payment is being verified
     *
     * @return bool
     */
    public function isBeingVerified()
    {
        return $this->data['paymentDetails']['stateName'] === 'VERIFY';
    }

    /**
     * @return string The name of the payment method
     */
    public function getPaymentMethodName()
    {
        return isset($this->data['paymentDetails']['paymentProfileName']) ? $this->data['paymentDetails']['paymentProfileName'] : '';
    }

    /**
     * @return string The account number, or masked creditcard number
     */
    public function getAccountNumber()
    {
        return $this->data['paymentDetails']['identifierPublic'];
    }

    /**
     * Checks whether the payment is authorized
     *
     * @return bool
     */
    public function isAuthorized()
    {
        return $this->data['paymentDetails']['state'] == 95;
    }

    /**
     * @return string The name of the account holder
     */
    public function getAccountHolderName()
    {
        return $this->data['paymentDetails']['identifierName'];
    }

    /**
     * @return string The ordernumber of the order provided by the external integrator.
     */
    public function getOrderNumber()
    {
        return $this->data['paymentDetails']['orderNumber'];
    }

    /**
     * @return bool Transaction is paid
     */
    public function isPaid()
    {
        return $this->data['paymentDetails']['stateName'] === 'PAID';
    }

    /**
     * Checks whether the payment is pending
     *
     * @return bool
     */
    public function isPending()
    {
        return $this->data['paymentDetails']['stateName'] === 'PENDING' || $this->data['paymentDetails']['stateName'] === 'VERIFY';
    }

    /**
     * Alias for isCanceled
     *
     * @return bool Transaction is Canceled
     */
    public function isCancelled()
    {
        return $this->isCanceled();
    }

    /**
     *
     * Check whether the status of the transaction is chargeback
     *
     * @return bool
     */
    public function isChargeBack()
    {
        return $this->data['paymentDetails']['stateName'] === 'CHARGEBACK';
    }

    /**
     * @return bool Transaction is Canceled
     */
    public function isCanceled()
    {
        return $this->data['paymentDetails']['state'] < 0;
    }

    /**
     * @return string The transaction id
     */
    public function getId()
    {
        return $this->data['paymentDetails']['orderId'];
    }


    /**
     * @param bool|true $allowPartialRefunds
     *
     * @return bool
     */
    public function isRefunded($allowPartialRefunds = true)
    {
        if ($this->data['paymentDetails']['stateName'] === 'REFUND') {
            return true;
        }

        if ($allowPartialRefunds && $this->data['paymentDetails']['stateName'] === 'PARTIAL_REFUND') {
            return true;
        }

        return false;
    }


    /**
     * Check whether the payment is partial refunded
     *
     * @return bool
     */
    public function isPartiallyRefunded()
    {
        return $this->data['paymentDetails']['stateName'] === 'PARTIAL_REFUND';
    }


    /**
     * Check whether the payment is a partial payment.
     *
     * @return bool
     */
    public function isPartialPayment()
    {
        return $this->data['paymentDetails']['stateName'] === 'PARTIAL_PAYMENT';
    }


    /**
     * @return string The account number, or masked creditcard number
     */
    public function getAccountHash()
    {
        return $this->data['paymentDetails']['identifierHash'];
    }

    /**
     * @return string The transaction description, as defined while starting the transaction
     */
    public function getDescription()
    {
        return empty($this->data['paymentDetails']['description']) ? '' : $this->data['paymentDetails']['description'];
    }

}