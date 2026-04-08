<?php

namespace baleBotPhp\Types;

use baleBotPhp\Types\{BaseType,
    Animation,
    MessageEntity,
    Audio,
    Contact,
    Document,
    Location,
    PhotoSize,
    Sticker,
    Video,
    Voice,
    User,
    Chat,
    WebAppData,
    InlineKeyboardMarkup};

/**
 * @property int          $message_id            شناسهٔ یکتا‌ی پیام (تکمیلی، لازم)
 * @property int          $date                  زمان ایجاد پیام (یونیکس)
 * @property Chat         $chat                  شیء چت (گروه/سوپرگروه/کانال)
 * @property Chat         $sender_chat           شیء چتی که پیام از آن ارسال شد (اگر وجود داشته باشد)
 * @property User         $forward_from          شیء کاربری که پیام از آن برای “forward” ارسال شد
 * @property Chat         $forward_from_chat    شیء چتی که پیام از آن برای “forward” ارسال شد
 * @property int          $forward_from_message_id   شناسهٔ پیام مبدا (اگر پیام forward بوده)
 * @property int          $forward_date          زمان پیام مبدا (یونیکس)
 * @property Message      $reply_to_message      پیام که به آن پاسخی داده شده است (اگر وجود داشته باشد)
 * @property int          $edit_date             زمان آخرین ویرایش پیام (یونیکس)
 * @property string       $media_group_id        شناسهٔ گروهی که این پیام در آن media‑group قرار دارد
 * @property string       $text                  متن پیام (اختیاری)
 * @property MessageEntity[]|null $entities      موجودیت‌های خاص در متن پیام (اختیاری)
 * @property Animation|null $animation          اگر پیام انیمیشن باشد
 * @property Audio|null     $audio               اگر پیام فایل صوتی باشد
 * @property Document|null  $document            اگر پیام فایل عمومی باشد
 * @property PhotoSize[]|null $photo              اگر پیام عکس باشد
 * @property Sticker|null   $sticker             اگر پیام استیکر باشد
 * @property Video|null     $video               اگر پیام ویدئو باشد
 * @property Voice|null     $voice               اگر پیام صوتی باشد
 * @property string|null    $caption             کپشن رسانه (اختیاری)
 * @property MessageEntity[]|null $caption_entities  موجودیت‌های خاص در کپشن (اختیاری)
 * @property Contact|null   $contact             اگر پیام مخاطب باشد
 * @property Location|null  $location            اگر پیام موقعیت مکانی باشد
 * @property User[]|null    $new_chat_members     اعضای جدید گروه (اختیاری)
 * @property User|null      $left_chat_member     کاربری که گروه را ترک کرده (اختیاری)
 * @property Invoice|null   $invoice             صورتحساب (اختیاری)
 * @property SuccessfulPayment|null $successful_payment   پرداخت موفق (اختیاری)
 * @property WebAppData|null $web_app_data       اگر پیام از وب‌اپ (WebApp) باشد
 * @property InlineKeyboardMarkup|null $reply_markup  کلیدهای inline‑keyboard (اختیاری)
 */
class Message extends BaseType
{

}
