<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class VideosController extends Controller
{
    public function list_video()
    {
        return view('admin.video.index');
    }

    public function select_video()
    {
        $video = Videos::orderBy('video_id', 'DESC')->get();
        $video_count = $video->count();
        $output = '
        <table class="table table-striped b-t b-light">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên Video</th>
                    <th>Hình ảnh</th>
                    <th>Slug</th>
                    <th>Link</th>
                    <th>Mô tả</th>
                    <th>Demo</th>
                    <th>Quản lí</th>
                </tr>
            </thead>
            <tbody>
        ';
        if ($video_count > 0) {
            $i = 0;
            foreach ($video as $key => $val_video) {
                $i++;
                $output .= '
                <tr>
                    <td>' . $i . '</td>
                    <td class="edit_video video_title_' . $val_video->video_id . '" contenteditable data-type="video_title" data-vid_id="' . $val_video->video_id . '" >' . $val_video->video_title . '</td>
                    <td><img width="150" height="100" src="' . url('uploads/video/' . $val_video->video_image) . '" >
                        <input data-vid_id="' . $val_video->video_id . '" type="file" id="file_image_' . $val_video->video_id . '" name="file" class="edit_image" >
                    </td>
                    <td class="edit_video video_slug_' . $val_video->video_id . '" data-type="video_slug" data-vid_id="' . $val_video->video_id . '"  contenteditable>' . $val_video->video_slug . '</td>
                    <td class="edit_video video_link_' . $val_video->video_id . '" data-type="video_link" data-vid_id="' . $val_video->video_id . '"  contenteditable><iframe width="250" height="315" src="https://www.youtube.com/embed/' . $val_video->video_link . '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>
                    <td class="edit_video video_desc_' . $val_video->video_id . '" data-type="video_desc" data-vid_id="' . $val_video->video_id . '"  contenteditable>' . $val_video->video_desc . '</td>
                    <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                    Watch demo
                  </button></td>
                    <td><button type="button" class="btn btn-danger delete_video" data-video_id="' . $val_video->video_id . '">Delete</button></td>
                </tr>
                ';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="6">Hiện chưa có video nào được thêm vào</td>
                </tr>
            ';
        }
        $output .= '
        </tbody>
        </table>
        ';

        echo $output;
    }

    public function store_video(Request $request)
    {
        $data = $request->all();
        $video = new Videos();
        $video->video_title = $data['video_title'];
        $video->video_slug = $data['video_slug'];
        $sub_video = substr($data['video_link'], 17);
        $video->video_link = $sub_video;
        $video->video_desc = $data['video_desc'];
        $get_image = $request->file('file');
        if ($get_image) {
            $path = 'uploads/video/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $video->video_image = $new_image;
        }
        $video->save();
    }

    public function delete_video(Request $request)
    {
        $data = $request->all();
        $video_id = $data['video_id'];
        $video = Videos::find($video_id);
        $video->delete();
    }

    //edit video ajax
    public function edit_video(Request $request)
    {
        $data = $request->all();
        $video = Videos::find($data['video_id']);
        if ($data['video_type'] == 'video_title') {
            $video->video_title = $data['video_edit'];
        } else if ($data['video_type'] == 'video_slug') {
            $video->video_slug = $data['video_edit'];
        } else if ($data['video_type'] == 'video_link') {
            $video->video_link = $data['video_edit'];
        } else if ($data['video_type'] == 'video_desc') {
            $video->video_desc = $data['video_edit'];
        }

        $video->save();
    }

    //edit image
    public function edit_image(Request $request)
    {
        $video_id = $request->video_id;
        $video = Videos::find($video_id);
        $get_image = $request->file('file');
        if ($get_image) {
            $path = 'uploads/video/' . $video->video_image;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'uploads/video/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $video->video_image = $new_image;
        }
        $video->save();
    }
}