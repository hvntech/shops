<?php

namespace App\Services\Production;

use App\Models\PageContent;
use App\Services\Interfaces\PageServiceInterface;

class PageService extends BaseService implements PageServiceInterface
{
    public function getPageByType($type) {
        return PageContent::where('type', $type)->first();
    }

    public function updateOrInsert(array $data)
    {
        $page = PageContent::where('type', $data['type'])->first();

        $data['text'] = isset($data['text']) ? $data['text'] : '';

        if (!$page) {
            $page = PageContent::create($data);
        } else {
            $page->type = $data['type'];
            $page->text = $data['text'];
            if (!empty($data['banner_url'])) {
                $page->banner_url = $data['banner_url'];
            }

            $page->save();
        }

        return $page;
    }
}
