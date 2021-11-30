<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        
        $guardian = Http::get('https://content.guardianapis.com/search', [
            'api-key' => '5af13b24-15a1-4976-88c8-71043ff11cf6',
            'q' => $query
        ]);
        $data = $guardian->json();
        $articles = [];
        if (!empty($data['response']['results'])) {
            $results = $data['response']['results'];
            foreach ($results as $result) {
                $item = [
                    'id' => $result['id'], 
                    'title' => $result['webTitle'], 
                    'url' => $result['webUrl'], 
                    'date' => Carbon::parse($result['webPublicationDate'])->format('d/m/Y')
                ];
                $articles[$result['sectionName']][] = $item;
            }
        }
        
        return ['articles' => $articles];
    }
}
