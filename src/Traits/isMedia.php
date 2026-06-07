<?php

namespace baleBotPhp\Traits;

trait isMedia
{
    /**
     * Immutable map of media types
     */
    private const MEDIA_TYPES = [
        'video' => 'video',
        'photo' => 'photo',
        'audio' => 'audio',
        'voice' => 'voice',
        'animation' => 'animation',
        'video_note' => 'video_note',
        'contact' => 'contact',
        'document' => 'document',
        'sticker' => 'sticker',
        'game' => 'game',
        'location' => 'location',
    ];

    public function isVideo(): bool
    {
        return $this->isMediaType('video');
    }

    public function isPhoto(): bool
    {
        return $this->isMediaType('photo');
    }

    public function isAudio(): bool
    {
        return $this->isMediaType('audio');
    }

    public function isVoice(): bool
    {
        return $this->isMediaType('voice');
    }

    public function isAnimation(): bool
    {
        return $this->isMediaType('animation');
    }

    public function isVideoNote(): bool
    {
        return $this->isMediaType('video_note');
    }

    public function isContact(): bool
    {
        return $this->isMediaType('contact');
    }

    public function isDocument(): bool
    {
        return $this->isMediaType('document');
    }

    public function isSticker(): bool
    {
        return $this->isMediaType('sticker');
    }

    public function isGame(): bool
    {
        return $this->isMediaType('game');
    }

    public function isLocation(): bool
    {
        return $this->isMediaType('location');
    }

    /**
     * سریع‌ترین check بدون loop
     */
    public function isMedia(): bool
    {
        return isset(self::MEDIA_TYPES[$this->mediaType()]);
    }

    /**
     * امن‌تر + سریع‌تر + بدون notice
     */
    protected function isMediaType(string $type): bool
    {
        $current = $this->mediaType();

        return isset(self::MEDIA_TYPES[$type])
            && $current === self::MEDIA_TYPES[$type];
    }
}