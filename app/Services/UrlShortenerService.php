<?php

namespace App\Services;

use App\Models\ShortUrl;
use Exception;

class UrlShortenerService
{
    public function generateRandomHash(int $length = 6): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomHash = '';

        for ($i = 0; $i < $length; $i++) {
            $randomHash .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomHash;
    }

    public function getMinUrlAndFull(string $url): ?ShortUrl
    {
        return ShortUrl::where('url', $url)->first();
    }

    public function createShortUrl(string $hash, array $validInputs): void
    {
        ShortUrl::create([
            'hash' => $hash,
            'url' => $validInputs['url'],
            'folder' => $validInputs['folder'] ?? null
        ]);
    }

    public function generateShortUrl(object $shortUrl): string
    {
        $folder = $shortUrl->folder;

        if (!$folder || is_null($folder)) {
            return env('APP_URL') . ':' . env('APP_PORT') . '/' . $shortUrl->hash;
        }
        return env('APP_URL') . ':' . env('APP_PORT') . '/' . $folder . '/' . $shortUrl->hash;
    }

    public function findUrl(string $hash, ?string $folder = null): string
    {
        $shortUrl = ShortUrl::where([
            'folder' => $folder,
            'hash' => $hash
        ])->first();

        if (is_null($shortUrl) || !$shortUrl) {
            throw new Exception('Url is not found in database!');
        }

        return $shortUrl->url;
    }
    public function updateFolder(object $shortUrl, ?string $folder = null): void
    {
        $shortUrl->folder = $folder;
        $shortUrl->save();
    }
}
