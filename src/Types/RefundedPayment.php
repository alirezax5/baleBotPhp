<?php
namespace baleBotPhp\Types;

/**
 * Class RefundedPayment
 * Contains basic information about a refunded payment.
 *
 * @property string $currency Three-letter ISO 4217 currency code, or “XTR” for bale Stars payments (always “XTR” currently).
 * @property int $total_amount Total refunded price in the smallest units of the currency (integer, not float/double).
 * @property string $invoice_payload Bot-specified invoice payload.
 * @property string $bale_payment_charge_id bale payment identifier.
 * @property string|null $provider_payment_charge_id Optional. Provider payment identifier.
 */
class RefundedPayment extends BaseType
{
}
