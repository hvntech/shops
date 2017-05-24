<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use App\Services\Interfaces\VideoServiceInterface;
use App\Http\Requests\Admin\StoreVideoRequest;
use Illuminate\Http\Request;
use App\Models\Partner;

class VideoController extends AdminBaseController
{
    protected $videoService;
    public function __construct(VideoServiceInterface $videoService)
    {
        parent::__construct();
        $this->videoService = $videoService;
    }

    public function index(Request $request) {
        return view('admin.video.index', [
            'fields' => $request->input('fields', []),
            'sorts' => $request->input('sorts', []),
            'page' => $request->input('page', 1),
        ]);
    }

    public function getVideos(Request $request) {
        $videos = $this->videoService->getVideoLists($request->all());

        return response()->json([
            'templates' => [
                'rows' => view('admin.video.rows', compact('videos'))->render(),
                'pagination' => $videos->links()->toHtml(),
            ],
            'url' => route('video_lists', $request->all()),
        ]);
    }

    public function create() {
        $partners = Partner::all();
        return view('admin.video.create', compact('partners'));
    }

    public function store(StoreVideoRequest $request) {
        if ($request->videoId) {
            $updateVideoStatus = $this->videoService->update($request->all());
        } else {
            $addVideostatus = $this->videoService->add($request->all());
        }

        if (isset($addVideostatus) || isset($updateVideoStatus)) {
            return redirect()->to('admin/video')->with('success', trans('message.success'));
        } else {
            return redirect()->back()->with('error', trans('message.failure'));
        }
    }

    public function update(Request $request, $videoId) {
        $video = $this->videoService->getVideoById($videoId);
        $partners = Partner::all();
        return view('admin.video.update', compact('video', 'partners'));
    }

    public function videoListsDelete(Request $request) {
        $videoIds = $request->input('videoIds');
        $status = $this->videoService->delete($videoIds);

        return response()->json(compact('status'));
    }

    public function delete(Request $request, $videoId) {
        $deleteStatus = $this->videoService->delete($videoId);

        if ($deleteStatus) {
            return redirect()->back()->with('success', trans('message.success'));
        } else {
            return redirect()->back()->with('error', trans('message.failure'));
        }
    }

    public function getVideoById() {
        return view('admin.video.create');
    }
}
