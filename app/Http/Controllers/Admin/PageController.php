<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UpdatePageRequest;
use App\Models\PageContent;
use App\Services\Interfaces\PageServiceInterface;
use App\Upload\UploadServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PageController extends AdminBaseController
{
    /**
     * @var PageServiceInterface
     */
    protected $pageService;

    /**
     * @var UploadServiceInterface
     */
    protected $uploadService;

    public function __construct(PageServiceInterface $pageService, UploadServiceInterface $uploadService)
    {
        parent::__construct();

        $this->pageService = $pageService;
        $this->uploadService = $uploadService;
    }

    public function index($type) {
        $page = $this->pageService->getPageByType($type);

        if (!$page) {
            $page = new PageContent([
                'type' => $type,
            ]);
        }

        return view('admin.page.index', compact('page'));
    }

    public function update(UpdatePageRequest $request) {
        $data = $request->all();

        if ($request->hasFile('banner_file')) {
            $bannerUrl = $this->uploadService->saveFile('page_banners', $request->type, $request->banner_file);

            if ($bannerUrl) {
                $data['banner_url'] = $bannerUrl;
            }
        }

        if ($this->pageService->updateOrInsert($data)) {
            return redirect()->route('page_edit', [
                'type' => $request->type,
            ]);
        }
        return redirect()->back()
            ->withErrors([trans('message.failure')]);
    }
}
