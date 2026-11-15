<?php
namespace baleBotPhp\Types;

/**
 * Class PassportData
 * Describes bale Passport data shared with the bot by the user.
 *
 * @property EncryptedPassportElement[] $data Array with information about documents and other bale Passport elements that were shared with the bot.
 * @property EncryptedCredentials $credentials Encrypted credentials required to decrypt the data.
 */
class PassportData extends BaseType
{
}
