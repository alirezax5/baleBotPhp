<?php

declare(strict_types=1);

namespace baleBotPhp;

use baleBotPhp\Traits\{isChatTypes, isMedia, isUpdates, method, otherTrait};
use baleBotPhp\Types\{BaseType, CallbackQuery, Message, PreCheckoutQuery};

class bale
{
    use isUpdates, isChatTypes, isMedia, method, otherTrait;

    private const API_BASE_URL = 'https://tapi.bale.ai';
    private const DEFAULT_FILE_URL_TEMPLATE = '{url}/file/bot{token}/{file_path}';

    // Chat Types
    public const PRIVATE    = 'private';
    public const GROUP      = 'group';
    public const SUPERGROUP = 'supergroup';
    public const CHANNEL    = 'channel';

    // Message Types
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

    public string $urlFile;           // برای سازگاری عقب‌گرد

    private \stdClass $data;
    private array $cacheType = [];
    private array $cacheField = [];

    private string $botToken;
    private string $apiUrl;
    private string $fileUrlTemplate;

    public function __construct(
        string $token,
        string $apiUrl = self::API_BASE_URL,
        string $fileUrlTemplate = self::DEFAULT_FILE_URL_TEMPLATE
    ) {
        $this->botToken = $token;
        $this->apiUrl = rtrim($apiUrl, '/');
        $this->fileUrlTemplate = $fileUrlTemplate;
        $this->urlFile = $fileUrlTemplate; // سازگاری با کدهای قدیمی

        $this->initialize();
    }

    private function initialize(): void
    {
        $input = file_get_contents('php://input') ?: '{}';
        $decoded = json_decode($input, false);

        $this->data = $decoded instanceof \stdClass ? $decoded : new \stdClass();

        $this->clearCache();
    }

    // ====================== Input Data Management ======================

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

    // ====================== Core API Call ======================

    public function bot(string $method, array $data = [], bool $isUpload = false): ?\stdClass
    {
        $url = $this->buildUrl($method);
        $data = $this->prepareData($data);

        $ch = curl_init();

        $options = [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $data,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_TIMEOUT        => 30,           // افزایش زمان
            CURLOPT_SSL_VERIFYPEER  => true,
            CURLOPT_USERAGENT      => 'Bale Bot API Client/2.0 (PHP)',
            CURLOPT_HTTPHEADER     => ['Accept: application/json'],
        ];

        // اگر آپلود فایل باشد، تنظیمات خاص
        if ($isUpload) {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_SAFE_UPLOAD] = true;
        }

        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($response === false) {
            return (object)[
                'ok'        => false,
                'error'     => $error,
                'http_code' => $httpCode,
            ];
        }

        $decoded = json_decode($response, false);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return (object)[
                'ok'        => false,
                'error'     => json_last_error_msg(),
                'http_code' => $httpCode,
            ];
        }

        return $decoded;
    }

    private function prepareData(array $data): array
    {
        // prepareData اصلی حالا در trait method است
        // این متد فقط برای سازگاری نگه داشته شده یا می‌توان حذف کرد
        return $data;
    }

    private function buildUrl(string $method): string
    {
        return "{$this->apiUrl}/bot{$this->botToken}/{$method}";
    }

    // ====================== File URL Helpers ======================

    public function getFileUrl(string $filePath): string
    {
        return str_replace(
            ['{url}', '{token}', '{file_path}'],
            [$this->apiUrl, $this->botToken, ltrim($filePath, '/')],
            $this->fileUrlTemplate
        );
    }

    public function getFileDownloadUrl(string $filePath): string
    {
        return $this->getFileUrl($filePath);
    }

    // ====================== Update Helpers ======================

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