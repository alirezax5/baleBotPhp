<?php
namespace baleBotPhp\Types;

/**
 * Class GiveawayCompleted
 * Represents a service message about the completion of a giveaway without public winners.
 *
 * @property int $winner_count Number of winners in the giveaway.
 * @property int $unclaimed_prize_count Optional. Number of undistributed prizes.
 * @property Message $giveaway_message Optional. Message with the giveaway that was completed, if it wasn't deleted.
 * @property bool $is_star_giveaway Optional. True, if the giveaway is a bale Star giveaway. Otherwise, currently, the giveaway is a bale Premium giveaway.
 */
class GiveawayCompleted extends BaseType
{
}
