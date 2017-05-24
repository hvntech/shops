<?php

namespace App\Services\Production;

use App\Models\AdminUser;
use App\Services\Interfaces\NewsServiceInterface;
use App\Models\NewsCategory;
use App\Models\News;
use DB;
use Carbon\Carbon;

class NewsService extends BaseService implements NewsServiceInterface
{
    public function add($dataRequest)
    {
        $news = new News;
        $news->name = $dataRequest['name'];
        $news->description = $dataRequest['description'];
        $news->partner_id = $dataRequest['partner_id'];
        $news->news_categories_id = $dataRequest['news_categories_id'];
        $news->banner = 'default'; // todo
        $news->created_by = AdminUser::all()->random()->id; //  todo
        $news->delete_flag = 0;

        return $news->save();
    }

    public function getNewsCategories($requestData)
    {
        $query = NewsCategory::select('id', 'category_name', 'created_at')->where('delete_flag', 0);

        if (isset($requestData['fields']['category_name'])) {
            $query->where('category_name', 'like', '%' . $requestData['fields']['category_name'] . '%');
        }

        if (isset($requestData['fields']['created_at'])) {
            $query->whereDate('created_at', '=', \Helper::datepickerToDateStr($requestData['fields']['created_at']));
        }

        if (isset($requestData['sorts'])) {
            foreach($requestData['sorts'] as $field => $sort) {
                $query->orderby($field, $sort);
            }
        }

        $newsCategories = $query->paginate(NewsCategory::PERPAGE);
        return $newsCategories;
    }

    public function getNews($requestData)
    {
        $query = News::select('news.id', 'news.partner_id', 'news.name', 'news.description', 'news.news_categories_id', 'news.created_at', 'partners.name as partner_name', 'news_categories.category_name as category_name')
            ->join('partners', 'news.partner_id', 'partners.id')
            ->join('news_categories', 'news.news_categories_id', 'news_categories.id');

        if (isset($requestData['fields']['name'])) {
            $query->where('news.name', 'like', '%' . $requestData['fields']['name'] . '%');
        }

        if (isset($requestData['fields']['description'])) {
            $query->where('news.description', 'like', '%' .  $requestData['fields']['description'] . '%');
        }

        if (isset($requestData['fields']['partner_name'])) {
            $query->where('partners.name', 'like', '%' . $requestData['fields']['partner_name'] . '%');
        }

        if (isset($requestData['fields']['news_category_name'])) {
            $query->where('news_categories.category_name', 'like', '%' . $requestData['fields']['news_category_name'] . '%');
        }

        if (isset($requestData['fields']['created_at'])) {
            $query->whereDate('news.created_at', '=', \Helper::datepickerToDateStr($requestData['fields']['created_at']));
        }

        $query->where('news.delete_flag', 0);

        if (isset($requestData['sorts'])) {
            foreach($requestData['sorts'] as $field => $sort) {
                if ($field == 'partner_name') {
                    $query->orderby('partners.name', $sort);
                } elseif ($field == 'category_name') {
                    $query->orderby('news_categories.category_name', $sort);
                } else {
                    $query->orderby('news.' . $field, $sort);
                }
            }
        }

        $news = $query->paginate(News::PERPAGE);

        return $news;
    }

    public function getNewsById($newsId)
    {
        return News::findOrFail($newsId);
    }

    public function getNewsCategoryById($newsCategoryId)
    {
        return NewsCategory::findOrFail($newsCategoryId);
    }

    public function update($dataRequest)
    {
        $news = News::where('id', '=', $dataRequest['newsId'])->firstOrFail();
        $news->name = $dataRequest['name'];
        $news->description = $dataRequest['description'];
        $news->partner_id = $dataRequest['partner_id'];
        $news->news_categories_id = $dataRequest['news_categories_id'];
        $news->banner = 'default'; // todo

        return $news->save();
    }

    public function newsCategoryUpdate($dataRequest)
    {
        $newsCategories = NewsCategory::where('id', '=', $dataRequest['newsCategoryId'])->firstOrFail();
        $newsCategories->category_name = $dataRequest['category_name'];

        return $newsCategories->save();
    }

    public function delete($newsIds)
    {
        if (!is_array($newsIds)) {
            return News::where('id', '=', $newsIds)->update(['delete_flag' => 1]);
        } else {
            DB::beginTransaction();
            $delete = News::whereIn('id', $newsIds)->update(['delete_flag' => 1]);
            if ($delete) {
                DB::commit();
                return true;
            } else {
                DB::rollback();
                return false;
            }
        }
    }

    public function newsCategoryDelete($newsCategoryIds)
    {
        if (!is_array($newsCategoryIds)) {
            $newsCategoryDelete = NewsCategory::where('id', $newsCategoryIds)->update(['delete_flag' => 1]);
            if ($newsCategoryDelete) {
                $newsDelete = News::where('news_categories_id', $newsCategoryIds)->update(['delete_flag' => 1]);
                return true;
            }
        } else {
            DB::beginTransaction();

            $newsCategoryDelete = NewsCategory::whereIn('id', $newsCategoryIds)->update(['delete_flag' => 1]);
            if ($newsCategoryDelete) {
                // delete flag news
                $newsDelete = News::whereIn('news_categories_id', $newsCategoryIds)->update(['delete_flag' => 1]);
                DB::commit();
                return true;
            } else {
                DB::rollback();
                return false;
            }
        }
    }
}
