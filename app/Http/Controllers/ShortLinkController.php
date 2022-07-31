<?php

namespace App\Http\Controllers;

use App\Models\ShortLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortLinkController extends Controller
{

    public function __construct(ShortLink $short_link)
    {
        $this->short_link = $short_link;
    }

    public function index()
    {
        $shortLinks = $this->short_link->latest()->get();

        return view('index', [
            'shortLinks' => $shortLinks
        ]);
    }
    

    public function findLink(Request $request, string $short_url)
    {
        $shortLink = $this->short_link->where('short_url', $short_url)->first();
    
        if ($shortLink === null) {
            $request->session()->put("message", ['type' => 'danger', 'text' => 'Link não encontrado']);
            return redirect('/');
        }

        return redirect($shortLink->link);
    }

    public function store(Request $request)
    {
        $request->validate([
            'link' => 'required|url'
        ], [
            'link.required' => "É necessário passar um link",
            'link.url' => "O link precisa ser uma URL válida",
        ]);

        $link = $request->link;

        $short_url = Str::random(8);

        $this->short_link->create([
            'link' => $link,
            'short_url' => $short_url
        ]);

        $request->session()->flash("message", ['type' => 'success', 'text' => 'URL gerada com sucesso!']);

        return redirect('/');
    }
}
