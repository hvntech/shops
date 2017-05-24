<?php

namespace App\Services\Interfaces;

interface NewsServiceInterface extends BaseServiceInterface
{
    public function getNewsCategories($requestData);

    public function getNews($requestData);

    public function getNewsById($newsId);

    public function getNewsCategoryById($newsCategoryId);

    public function update($newsId);

    public function newsCategoryUpdate($newsCategoryId);

    public function delete($newsIds);

    public function newsCategoryDelete($newsCategoryId);
}
