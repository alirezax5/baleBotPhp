<?php

declare(strict_types=1);

namespace baleBotPhp\Traits;

use baleBotPhp\Types\{returned, returnedMessage, returnedString, returnedTransaction};

trait Payments
{

    /**
     * @return returnedMessage
     */
    public function sendInvoice($chat_id, $title, $description, $payload, $currency, $prices, array $options = []): returnedMessage
    {

        $data = compact('chat_id', 'title', 'description', 'payload', 'currency', 'prices') + $options;

        return returnedMessage::create($this->call('sendInvoice', $data));
    }

    /**
     * @return returnedString
     */
    public function createInvoiceLink($title, $description, $payload, $currency, $prices, array $options = []): returnedString
    {

        $data = compact('title', 'description', 'payload', 'currency', 'prices') + $options;

        return returnedString::create($this->call('createInvoiceLink', $data));
    }

    /**
     * @return returned
     */
    public function answerPreCheckoutQuery($pre_checkout_query_id, $ok, array $options = []): returned
    {

        $data = compact('pre_checkout_query_id', 'ok') + $options;

        return returned::create($this->call('answerPreCheckoutQuery', $data));
    }

    /**
     * [Bale-specific] Ask the user to review the bot.
     * Not available in the Telegram Bot API.
     */
    public function askReview(int $user_id, int $delay_seconds): returned
    {
        return returned::create($this->call('askReview', compact('user_id', 'delay_seconds')));
    }

    /**
     * [Bale-specific] Inquire the status of a payment transaction.
     * Not available in the Telegram Bot API.
     */
    public function inquireTransaction(string $transaction_id): returnedTransaction
    {
        return returnedTransaction::create($this->call('inquireTransaction', compact('transaction_id')));
    }

}
