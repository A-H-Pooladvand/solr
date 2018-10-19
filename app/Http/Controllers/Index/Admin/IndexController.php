<?php

namespace App\Http\Controllers\Index\Admin;

use App\Http\Src\Solr\Solr;
use App\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    protected $solr;

    protected $request;

    private $table = 'twitter';

    public function __construct(Solr $solr, Request $request)
    {
        $this->solr = $solr;

        $this->request = $request;
    }

    public function store()
    {
        $this->solr->index()->create($this->table);

        return back();
    }

    public function destroy()
    {
        $this->solr->index()->delete($this->table);

        return back();
    }

    public function truncate()
    {
        $this->solr->table($this->table)->document()->truncate();

        $this->solr->commit();

        return back();
    }

    public function seed()
    {
        $news = News::take(500)->get()->toArray();

        $this->solr->table($this->table)->document()->create($news);

        $this->solr->commit();

        return back();
    }

    public function fields()
    {
        $this->solr->table($this->table)->document()->addField([
            [
                'name' => 'title'
            ],
            [
                'name' => 'summary'
            ],
            [
                'name' => 'body'
            ],
        ]);

        return back();
    }
}
