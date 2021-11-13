<?php

namespace App\Http\Controllers;

use App\Models\Gallevy;
use Illuminate\Http\Request;

class GallevyController extends Controller
{
    // gallevy image view
    public function add_gallevy($id)
    {
        $product_id = $id;
        return view('admin.product.add_gallevy')->with(compact('product_id'));
    }

    public function gallevy(Request $request)
    {
        $product_id = $request->product_id;
        $gallevy = Gallevy::orderBy('gallevy_id', 'DESC')->where('product_id', $product_id)->get();
        $gallevy_count = $gallevy->count();
        $output = '
        <table class="table table-striped b-t b-light">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên hình ảnh</th>
                <th>Hình ảnh</th>
                <th>Danh mục</th>
            </tr>
        </thead>
        <tbody>
        ';

        if ($gallevy_count > 0) {
            $i = 0;
            foreach ($gallevy as $key => $val) {
                $i++;
                $output .= '
                <tr>
                    <td>' . $i . '</td>
                    <td class="image-name" data-gal_id="' . $val->gallevy_id . '" contenteditable>' . $val->gallevy_name . '</td>
                    <td><img width="150" height="100" src="' . url('uploads/gallevy/' . $val->gallevy_image) . '" >
                        <input data-gal_id="' . $val->gallevy_id . '" type="file" id="edit_image_' . $val->gallevy_id . '" class="edit_image" >
                    </td>
                    <td><button data-pro_id="' . $val->gallevy_id . '" type="button" class="btn btn-danger delete-gallevy">Delete</button></td>
                </tr>
                ';
            }
        } else {
            $output .= '
                <tr>
                    <td colspan="4">Sản phẩm hiện chưa có thư viện ảnh</td>
                </tr>
            ';
        }
        $output .= '
        </tbody>
        </table>
        ';

        echo $output;
    }

    public function insert_gallevy(Request $request, $pro_id)
    {
        $get_gallevy = $request->file('file');

        if ($get_gallevy) {
            foreach ($get_gallevy as $get_image) {
                $path = 'uploads/gallevy/';
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);

                $gallevy = new Gallevy();
                $gallevy->gallevy_name = $new_image;
                $gallevy->gallevy_image = $new_image;
                $gallevy->product_id = $pro_id;
                $gallevy->save();
            }
        }

        return Redirect()->back()->with('status', 'Bạn đã thêm thư viện ảnh thành công!');
    }

    public function delete_gallevy(Request $request)
    {
        $gallevy_id = $request->gal_id;
        $gallevy = Gallevy::find($gallevy_id);
        $path = 'uploads/gallevy/' . $gallevy->gallevy_image;
        if (file_exists($path)) {
            unlink($path);
        }
        $gallevy->delete();
    }

    public function update_name_gallevy(Request $request)
    {
        $data = $request->all();
        $gallevy = Gallevy::find($data['id']);
        $gallevy->gallevy_name = $data['gallevy_name'];
        $gallevy->save();
    }

    public function update_image_gallevy(Request $request)
    {
        $gallevy_id = $request->gallevy_id;
        $gallevy = Gallevy::find($gallevy_id);
        $get_image = $request->file('file');
        if ($get_image) {
            $path = 'uploads/gallevy/' . $gallevy->gallevy_image;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'uploads/gallevy/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $gallevy->gallevy_image = $new_image;
        }

        $gallevy->save();
    }
}