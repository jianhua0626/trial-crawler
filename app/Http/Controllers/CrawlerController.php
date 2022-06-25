<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use App\Models\CrawlerResult;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use App\Crawler\Parser;
use App\Crawler\FullPageScreenShot;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Crawler\CrawlerResultRepository;

class CrawlerController extends Controller
{
    private CrawlerResultRepository $repository;

    public function __construct()
    {
        $this->repository = new CrawlerResultRepository();
    }

    public function paginate(Request $request): Factory|View|Application
    {
        return view('welcome', [
            'data' => $this->repository->paginate(5),
        ]);
    }

    public function detail(int $id): Factory|View|Application
    {
        return view('detail', [
            'result' => CrawlerResult::findOrFail($id),
        ]);
    }

    public function crawling(Request $request): Redirector|Application|RedirectResponse
    {
        $url        = $request->input('url');
        $parser     = new Parser(Http::get($url)->body());
        $screenShot = new FullPageScreenShot($url, config('crawler.api_key'));

        Storage::disk('public')->put(
            $filename = sha1($url . (new \DateTime())->getTimestamp()) . '.jpg',
            base64_decode($screenShot->base64Value())
        );

        CrawlerResult::create([
            'screenshot'  => $filename,
            'title'       => $url,
            'description' => $parser->description(),
            'body'        => $parser->body(),
        ]);

        return redirect('/');
    }
}
