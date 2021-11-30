<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class Articles extends Component
{
    public $articles, $query;

    public $pins = [];

    public function mount()
    {
        $this->refresh();
    }

    public function refresh()
    {
        $this->articles = [];
        $this->articles = $this->fetch_news();
    }

    public function fetch_news() {
        $query = $this->query;
        $request = Request::create('/api/news', 'GET', ['query'=>$query]);
        $result = app()->handle($request);
        

        $data = $result->getContent();
        $data = json_decode($data, true);
        
        if (!empty($data)) {
            $articles = $data['articles'];
            return $articles;
        }
    }

    public function render()
    {
        return view('livewire.articles');
    }
}
