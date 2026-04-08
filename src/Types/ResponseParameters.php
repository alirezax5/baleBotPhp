<?php
namespace baleBotPhp\Types;

use baleBotPhp\Types\BaseType;

/**
 * Class ResponseParameters
 *
 * @property int $retry_after اختیاری. در صورت عبور از محدودیت نرخ ارسال درخواست، تعداد ثانیه‌های باقیمانده تا زمانی که درخواست دوباره قابل ارسال باشد را نشان می‌دهد.
 * @property string $small_file_unique_id Unique file identifier of small (160x160) chat photo
 */
class ResponseParameters extends BaseType
{
}
