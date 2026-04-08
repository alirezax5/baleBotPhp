<?php
namespace baleBotPhp\Types;

use baleBotPhp\Types\BaseType;
use baleBotPhp\Types\User;

/**
 * Class PreCheckoutQuery
 * This object contains information about an incoming pre-checkout query.
 *
 * @property string $id Unique query identifier
 * @property User $from User who sent the query
 * @property string $currency Three-letter ISO 4217 currency code, or “XTR” for payments in Telegram Stars
 * @property int $total_amount Total price in the smallest units of the currency (integer, not float/double)
 * @property string $invoice_payload Bot-specified invoice payload

 */
class PreCheckoutQuery extends BaseType
{
}
