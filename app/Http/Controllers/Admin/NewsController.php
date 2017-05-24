<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Services\Interfaces\NewsServiceInterface;
use App\Http\Requests\Admin\StoreNewsRequest;
use App\Http\Requests\Admin\StoreNewsCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\NewsCategory;

class NewsController extends AdminBaseController
{
    protected $newsService;
    public function __construct(NewsServiceInterface $newsService)
    {
        parent::__construct();
        $this->newsService = $newsService;
    }

    public function index(Request $request) {
        return view('admin.news.index', [
            'fields' => $request->input('fields', []),
            'sorts' => $request->input('sorts', []),
            'page' => $request->input('page', 1),
        ]);
    }

    public function getNews(Request $request) {
        $news = $this->newsService->getNews($request->all());

        return response()->json([
            'templates' => [
                'rows' => view('admin.news.rows', compact('news'))->render(),
                'pagination' => $news->links()->toHtml(),
            ],
            'url' => route('news_lists', $request->all()),
        ]);
    }

    public function create() {
        $partners = Partner::all();
        $categories = NewsCategory::all();
        return view('admin.news.create', compact('partners', 'categories'));
    }

    public function newsCategoryCreate() {
        return view('admin.news.news_category_create');
    }

    public function newsCategories(Request $request) {
        return view('admin.news.news_category', [
            'fields' => $request->input('fields', []),
            'sorts' => $request->input('sorts', []),
            'page' => $request->input('page', 1),
        ]);
    }

    public function getNewCategories(Request $request) {
        $newsCategories = $this->newsService->getNewsCategories($request->all());
        return response()->json([
            'templates' => [
                'rows' => view('admin.news.news_category_rows', compact('newsCategories'))->render(),
                'pagination' => $newsCategories->links()->toHtml(),
            ],
            'url' => route('news_category_lists', $request->all()),
        ]);
    }

    public function store(StoreNewsRequest $request) {
        if ($request->newsId) {
            $updatenewtatus = $this->newsService->update($request->all());
        } else {
            $addnewtatus = $this->newsService->add($request->all());
        }

        if (isset($addnewtatus) || isset($updatenewtatus)) {
            return redirect()->to('admin/news')->with('success', trans('message.success'));
        } else {
            return redirect()->back()->with('error', trans('message.failure'));
        }
    }

    public function newsCategoryStore(StoreNewsCategoryRequest $request) {
        if ($request->newsCategoryId) {
            $updateStatus = $this->newsService->newsCategoryUpdate($request->all());
        } else {
            $addStatus = $this->newsService->addNewsCategory($request->all());
        }

        if (isset($addStatus) || isset($updateStatus)) {
            return redirect()->to('admin/news/category')->with('success', trans('message.success'));
        } else {
            return redirect()->back()->with('error', trans('message.failure'));
        }
    }

    public function update(Request $request, $newsId) {
        $news = $this->newsService->getNewsById($newsId);
        $partners = Partner::all();
        $categories = NewsCategory::all();
        return view('admin.news.update', compact('news', 'partners', 'categories'));
    }

    public function newsCategoryUpdate(Request $request, $newsCategoryId) {
        $newsCategory = $this->newsService->getNewsCategoryById($newsCategoryId);
        return view('admin.news.news_category_update', compact('newsCategory'));
    }

    public function newsListsDelete(Request $request) {
        $newsIds = $request->input('newsIds');
        $status = $this->newsService->delete($newsIds);

        return response()->json(compact('status'));
    }

    public function delete(Request $request, $newsId) {
        $deleteStatus = $this->newsService->delete($newsId);

        if ($deleteStatus) {
            return redirect()->back()->with('success', trans('message.success'));
        } else {
            return redirect()->back()->with('error', trans('message.failure'));
        }
    }

    public function newsCategoryDelete(Request $request, $newsCategoryId) {
        $deleteStatus = $this->newsService->newsCategoryDelete($newsCategoryId);

        if ($deleteStatus) {
            return redirect()->back()->with('success', trans('message.success'));
        } else {
            return redirect()->back()->with('error', trans('message.failure'));
        }
    }

    public function newsCategoryListsDelete(Request $request) {
        $newsCategoryIds = $request->input('newsCategoryIds');
        $status = $this->newsService->newsCategoryDelete($newsCategoryIds);

        return response()->json(compact('status'));
    }

    public function getnewsById() {
        return view('admin.news.create');
    }
}
