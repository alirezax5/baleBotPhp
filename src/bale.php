<?php

declare(strict_types=1);

namespace baleBotPhp;

use baleBotPhp\Traits\{isChatTypes, isMedia, isUpdates, method, otherTrait};
use baleBotPhp\Types\{BaseType, CallbackQuery, Message, PreCheckoutQuery};

class bale
{
    use isUpdates,
        isChatTypes,
        isMedia,
        method,
        otherTrait {
        // حل تعارض بین دو trait
        otherTrait::isMedia insteadof isMedia;
    }

    private const API_BASE_URL = 'https://tapi.bale.ai';
    private const DEFAULT_FILE_URL_TEMPLATE = '{url}/file/bot{token}/{file_path}';

    // تنظیمات Retry
    private int $maxRetries = 3;
    private int $retryDelayMs = 500;

    // ثابت‌های چت و نوع پیام
    public const PRIVATE    = 'private';
    public const GROUP      = 'group';
    public const SUPERGROUP = 'supergroup';
    public const CHANNEL    = 'channel';

    public const _PHOTO      = 'photo';
    public const _VIDEO      = 'video';
    public const _FORWARD    = 'forward';
    public const _VIDEO_NOTE = 'video_note';
    public const _AUDIO      = 'audio';
    public const _VOICE      = 'voice';
    public const _ANIMATION  = 'animation';
    public const _STICKER    = 'sticker';
    public const _DOCUMENT   = 'document';
    public const _LOCATION   = 'location';
    public const _CONTACT    = 'contact';
    public const _GAME       = 'game';
    public const _TEXT       = 'text';
    public const _MEDIA      = 'media';

    public string $urlFile;

    private \stdClass $data;
    private array $cacheType = [];
    private array $cacheField = [];

    private string $botToken;
    private string $apiUrl;
    private string $fileUrlTemplate;

    public function __construct(
        string $token,
        string $apiUrl = self::API_BASE_URL,
        string $fileUrlTemplate = self::DEFAULT_FILE_URL_TEMPLATE,
        int $maxRetries = 3,
        int $retryDelayMs = 500
    ) {
        $this->apiUrl = rtrim($apiUrl, '/');
        $this->fileUrlTemplate = $fileUrlTemplate;
        $this->urlFile = $fileUrlTemplate;

        $this->maxRetries = $maxRetries;
        $this->retryDelayMs = $retryDelayMs;

        $this->setToken($token);   // استفاده از متد setter
        $this->initialize();
    }

    private function initialize(): void
    {
        $input = file_get_contents('php://input') ?: '{}';
        $decoded = json_decode($input, false);
        $this->data = $decoded instanceof \stdClass ? $decoded : new \stdClass();
        $this->clearCache();
    }

    // ====================== Token Management (مولتی ربات) ======================

    /**
     * تغییر توکن
     */
    public function setToken(string $token): self
    {
        $this->botToken = $token;
        $this->urlFile = str_replace('{token}', $token, $this->fileUrlTemplate);
        $this->clearCache();                    // مهم: کش را پاک کن
        return $this;
    }

    /**
     * دریافت توکن فعلی
     */
    public function getToken(): string
    {
        return $this->botToken;
    }

    /**
     * ایجاد یک نمونه جدید با توکن دلخواه (Immutable)
     */
    public function withToken(string $token): self
    {
        $clone = clone $this;
        $clone->setToken($token);
        // داده ورودی را هم کپی می‌کنیم
        $clone->data = clone $this->data;
        return $clone;
    }

    /**
     * بهترین روش برای تعویض موقت توکن
     * توکن اصلی بعد از اتمام callback به صورت خودکار برمی‌گردد
     */
    public function usingToken(string $token, callable $callback): mixed
    {
        $originalToken = $this->getToken();

        try {
            $this->setToken($token);
            return $callback($this);
        } finally {
            $this->setToken($originalToken);   // تضمین بازگشت حتی در صورت خطا
        }
    }

    // ====================== Core API Call با Retry ======================

    public function bot(string $method, array $data = [], bool $isUpload = false): ?\stdClass
    {
        $url = $this->buildUrl($method);
        $attempt = 0;

        while ($attempt <= $this->maxRetries) {
            $ch = curl_init();

            $options = [
                CURLOPT_URL            => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST           => true,
                CURLOPT_POSTFIELDS     => $data,
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_SSL_VERIFYPEER  => true,
                CURLOPT_USERAGENT      => 'Bale Bot API Client/2.0 (PHP)',
                CURLOPT_HTTPHEADER     => ['Accept: application/json'],
            ];

            if ($isUpload) {
                $options[CURLOPT_SAFE_UPLOAD] = true;
            }

            curl_setopt_array($ch, $options);

            $response = curl_exec($ch);
            $curlError = curl_error($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($response !== false) {
                $decoded = json_decode($response, false);
                if (json_last_error() === JSON_ERROR_NONE) {
                    return $decoded;
                }
            }

            $attempt++;

            if (!$this->shouldRetry($curlError, $httpCode, $attempt)) {
                break;
            }

            $delay = $this->retryDelayMs * (2 ** ($attempt - 1));
            usleep($delay * 1000);
        }

        return (object)[
            'ok'        => false,
            'error'     => $curlError ?: 'API Error after ' . $attempt . ' attempts',
            'http_code' => $httpCode ?? 0,
            'attempts'  => $attempt,
        ];
    }

    private function shouldRetry(string $curlError, int $httpCode, int $attempt): bool
    {
        if ($attempt > $this->maxRetries) {
            return false;
        }

        if (!empty($curlError)) {
            return true;
        }

        if ($httpCode >= 500 && $httpCode < 600) {
            return true;
        }

        if ($httpCode === 429) {
            return true;
        }

        return false;
    }

    public function setRetryConfig(int $maxRetries = 3, int $retryDelayMs = 500): self
    {
        $this->maxRetries = $maxRetries;
        $this->retryDelayMs = $retryDelayMs;
        return $this;
    }

    // ====================== سایر متدها ======================

    private function buildUrl(string $method): string
    {
        return "{$this->apiUrl}/bot{$this->botToken}/{$method}";
    }

    public function getFileUrl(string $filePath): string
    {
        return str_replace(
            ['{url}', '{token}', '{file_path}'],
            [$this->apiUrl, $this->botToken, ltrim($filePath, '/')],
            $this->fileUrlTemplate
        );
    }

    public function getInputData(): \stdClass
    {
        return $this->data;
    }

    public function setInputData(array|\stdClass|BaseType $data): \stdClass
    {
        $this->clearCache();

        if ($data instanceof BaseType) {
            $data = json_decode(json_encode($data, JSON_UNESCAPED_UNICODE), false);
        }

        if (is_array($data)) {
            $data = json_decode(json_encode($data, JSON_UNESCAPED_UNICODE), false);
        }

        return $this->data = $data instanceof \stdClass ? $data : new \stdClass();
    }

    public function clearCache(): void
    {
        $this->cacheType = [];
        $this->cacheField = [];
    }

    public function getUpdateId(): int
    {
        return $this->data->update_id ?? 0;
    }

    public function checkUpdateExists(string $key): bool
    {
        return isset($this->data->$key) && !empty($this->data->$key);
    }

    private function getCachedUpdate(string $key, string $class): ?BaseType
    {
        if (!array_key_exists($key, $this->cacheType) && $this->checkUpdateExists($key)) {
            $this->cacheType[$key] = new $class($this->data->$key);
        }

        return $this->cacheType[$key] ?? null;
    }

    public function message(): ?Message
    {
        return $this->getCachedUpdate('message', Message::class);
    }

    public function editedMessage(): ?Message
    {
        return $this->getCachedUpdate('edited_message', Message::class);
    }

    public function callbackQuery(): ?CallbackQuery
    {
        return $this->getCachedUpdate('callback_query', CallbackQuery::class);
    }

    public function preCheckoutQuery(): ?PreCheckoutQuery
    {
        return $this->getCachedUpdate('pre_checkout_query', PreCheckoutQuery::class);
    }
}