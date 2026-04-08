<?php
namespace baleBotPhp\Types;

/**
 * Class InlineKeyboardButton
 * Represents one button of an inline keyboard. Exactly one of the optional fields must be used to specify type of the button.
 *
 * @property string $text Label text on the button.
 * @property string $url Optional. HTTP or tg:// URL to be opened when the button is pressed.
 * @property string $callback_data Optional. Data to be sent in a callback query to the bot when the button is pressed, 1-64 bytes.
 * @property WebAppInfo $web_app Optional. Description of the Web App that will be launched when the user presses the button.
 * @property CopyTextButton $copy_text Optional. Description of the button that copies the specified text to the clipboard.
 */
class InlineKeyboardButton extends BaseType
{
}
