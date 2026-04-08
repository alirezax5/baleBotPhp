<?php
namespace baleBotPhp\Types;

use baleBotPhp\Types\{BaseType,
    ChatPhoto,
};

/**
 * Class ChatFullInfo
 *
 * اطلاعات کامل یک گفت‌وگو.
 *
 * @property int          $id           شناسه یکتای گفتگو. می‌تواند بیش از ۲۳۱ باشد؛ در
 *                                     زبان‌های مختلف بهتر است از نوع ۶۴‑بیتی
 *                                     استفاده کنید.
 * @property string       $type         نوع گفتگو: «private»، «group» یا «channel».
 * @property string|null  $title        عنوان گفتگو در گروه‌ها یا کانال‌ها (اختیاری).
 * @property string|null  $username     نام کاربری گفتگو (اختیاری).
 * @property string|null  $first_name  نام کوچک طرف دیگر در گفت‌وگوی خصوصی (اختیاری).
 * @property string|null  $last_name   نام خانوادگی طرف دیگر در گفت‌وگوی خصوصی (اختیاری).
 * @property ChatPhoto|null $photo     تصویر گفتگو (اختیاری).
 * @property string|null  $bio          متن بخش «درباره من» (اختیاری).
 * @property string|null  $description متن بخش «توضیحات» گروه یا کانال (اختیاری).
 * @property string|null  $invite_link  پیوند دعوت (اختیاری).
 * @property string|null  $linked_chat_id شناسه یکتای گروه دیدگاه‌های کانال (اختیاری).
 */
class ChatFullInfo extends BaseType
{
}
