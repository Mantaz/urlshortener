<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUrlRequest;
use App\Services\UrlShortenerService;
use Illuminate\Http\RedirectResponse;
use Inertia\Response;
use Throwable;

class UrlShortenerController extends Controller
{
    public function __construct(private UrlShortenerService $service)
    {
    }

    // UrlShorter vue page.
    public function index(): Response
    {
        return inertia()->render('UrlShortener');
    }

    /**
     * Storing short url record and generating short url.
     * @throws Throwable
     */
    public function store(CreateUrlRequest $request): RedirectResponse
    {
        try {
            $validInputs = $request->validated();
            $existingShortUrl = $this->service->getMinUrlAndFull($validInputs['url']);

            if ($existingShortUrl && $existingShortUrl->folder !== $validInputs['folder']) {
                $this->service->updateFolder($existingShortUrl, $validInputs['folder']);
            }
            if (!$existingShortUrl) {
                $hash = $this->service->generateRandomHash();
                $this->service->createShortUrl($hash, $validInputs);
                $existingShortUrl = $this->service->getMinUrlAndFull($validInputs['url']);
            }

            return back()
                ->with([
                    'success' => 'Successfully generated short url.',
                    'shortUrl' => $this->service->generateShortUrl($existingShortUrl)
                ]);
        } catch (Throwable $throwable) {
            if (config('app.env') === 'production') {
                return back()->with('throwable', $throwable->getMessage());
            }
            throw $throwable;
        }
    }

    /**
     * Redirecting to url using short url with hash.
     * @throws Throwable
     */
    public function redirectToUrl(string $hash): RedirectResponse
    {
        try {
            $url = $this->service->findUrl($hash);
            return redirect()->to($url);
        } catch (Throwable $throwable) {
            if (config('app.env') === 'production') {
                return back()->with('throwable', $throwable->getMessage());
            }
            throw $throwable;
        }
    }

    /**
     * Redirecting to url using short url with folder and hash.
     * @throws Throwable
     */
    public function redirectToUrlWithFolder(string $folder, string $hash): RedirectResponse
    {
        try {
            $url = $this->service->findUrl($hash, $folder);
            return redirect()->to($url);
        } catch (Throwable $throwable) {
            if (config('app.env') === 'production') {
                return back()->with('throwable', $throwable->getMessage());
            }
            throw $throwable;
        }
    }
}
