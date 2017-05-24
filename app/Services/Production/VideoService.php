<?php

namespace App\Services\Production;

use App\Services\Interfaces\VideoServiceInterface;
use App\Models\Video;
use App\Models\Partner;
use DB;
use Carbon\Carbon;

class VideoService extends BaseService implements VideoServiceInterface
{
    public function add($dataRequest)
    {
        $video = new Video;
        $video->name = $dataRequest['name'];
        $video->link = $dataRequest['link'];
        $video->description = $dataRequest['description'];
        $video->partners_id = $dataRequest['partners_id'];
        $video->upload_date = Carbon::now();
        $video->delete_flag = 0;
        $video->thumbnail = str_random(30); // todo

        return $video->save();
    }

    public function getVideoById($videoId)
    {
        return Video::findOrFail($videoId);
    }

    public function getVideoLists($requestData)
    {
        $query = Video::select('videos.id', 'videos.name', 'videos.link', 'videos.description', 'videos.partners_id', 'videos.upload_date', 'videos.updated_at')->join('partners', 'videos.partners_id', 'partners.id');
        if (isset($requestData['fields']['name'])) {
            $query->where('videos.name', 'like', '%' . $requestData['fields']['name'] . '%');
        }

        if (isset($requestData['fields']['link'])) {
            $query->where('videos.link', 'like', '%' . $requestData['fields']['link'] . '%');
        }

        if (isset($requestData['fields']['description'])) {
            $query->where('videos.description', 'like', '%' . $requestData['fields']['description'] . '%');
        }

        if (isset($requestData['fields']['partner_name'])) {
            $query->where('partners.name', 'like', '%' . $requestData['fields']['partner_name'] . '%');
        }

        if (isset($requestData['fields']['upload_date'])) {
            $query->whereDate('videos.upload_date', \Helper::datepickerToDateStr($requestData['fields']['upload_date']));
        }

        if (isset($requestData['fields']['updated_at'])) {
            $query->whereDate('videos.updated_at', \Helper::datepickerToDateStr($requestData['fields']['updated_at']));
        }

        $query->where('videos.delete_flag', 0);

        if (isset($requestData['sorts'])) {
            foreach($requestData['sorts'] as $field => $sort) {
                if ($field == 'partner_name') {
                    $query->orderby('partners.name', $sort);
                } else {
                    $query->orderby('videos.' . $field, $sort);
                }
            }
        }

        $videos = $query->paginate(Video::PERPAGE);
        return $videos;
    }

    public function update($dataRequest)
    {
        $videoInfo = Video::where('id', '=', $dataRequest['videoId'])->firstOrFail();
        $videoInfo->name = $dataRequest['name'];
        $videoInfo->link = $dataRequest['link'];
        $videoInfo->description = $dataRequest['description'];
        $videoInfo->partners_id = $dataRequest['partners_id'];

        return $videoInfo->save();
    }

    public function delete($videoIds)
    {
        if (!is_array($videoIds)) {
            return Video::where('id', '=', $videoIds)->update(['delete_flag' => 1]);
        } else {
            DB::beginTransaction();
            $delete = Video::whereIn('id', $videoIds)->update(['delete_flag' => 1]);
            if ($delete) {
                DB::commit();
                return true;
            } else {
                DB::rollback();
                return false;
            }
        }
    }

}
