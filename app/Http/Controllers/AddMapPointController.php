<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\map;
use App\Models\tiding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddMapPointController extends Controller
{
    public function mappoint()/*Вывод точек на карте и новотсей на главной стр*/
    {
        $row = map::orderBy('title')->get();
        $new = tiding::paginate(3);
        return view('index', [
            'list'=>$row,
            'news' => $new
        ]);


    }
    /*Добавление новостей -- НАЧАЛО*/
    public function indexadmin()/*Вывод всех новостей в админке*/
    {
        $show = tiding::paginate(5);
        return view('add_tiding', [
            'show' => $show
        ]);

    }


    public function addtiding(Request $request)/*Обработчик добавления новостей*/
    {


        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'description_max'=>'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $images = $request->file('images');
        $images_name = [];

        foreach($images as $image){
            $imageName = md5(random_bytes(32)) . '.' . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $imageName);

            $images_name[] = $imageName;
        }

        $query = DB::table('tidings')-> insert([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'description_max'=>$request->input('description_max'),
            'image'=>json_encode($images_name)
        ]);
        if($query)
        {
            return back()->with('success', 'Данные успешно загружены');
        }
        else
        {
            return  back()-> with ('fail', 'Данные не были загружены');
        }

    }
    /*Добавление новостей -- КОНЕЦ*/
    /*Редактирование новостей -- НАЧАЛО*/
    public function edittiding($id)/*Передача всех данных новости*/
    {
        $row = DB::table('tidings')
            ->where('id', $id)
            ->first();
        $data =[
            'Info'=>$row,
            'Title'=>'Редактирование данных'
        ];

        return view('edit_tiding', $data);
    }
    public function updatetiding(Request $request)/*запись всех данных новости в БД*/
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'description_max'=>'required'
        ]);
        $updating = DB::table('tidings')
            ->where('id', $request->input('id_tiding'))
            ->update([
                'title'=>$request->input('title'),
                'description'=>$request->input('description'),
                'description_max'=>$request->input('description_max'),
                'image'=>$request->input('image')

            ]);
        return redirect('/add_tiding');

    }
    /*Редактирование новостей -- КОНЕЦ*/
    /*Удаление новостей -- НАЧАЛО*/
    public function deletetiding($id)
    {
        $delete = DB::table('tidings')
            ->where('id', $id)
            ->delete();
        return redirect('/add_tiding');


    }
    /*Удаление новостей -- Конец*/
    /*Добавление сообщения пользователя -- НАЧАЛО*/
    public function indexmessagepols()/*Вывод всех новостей в админке*/
    {
        $show = map::all();
        return view('add_message', [
            'show' => $show
        ]);

    }
    public function addmessage(Request $request)/*Обработчик добавления новостей*/
    {


        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'index'=>'required',
            'uik'=>'required',
            'status'=>'required'
        ]);

        $query = DB::table('maps')-> insert([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'gor'=>$request->input('gor'),
            'index'=>$request->input('index'),
            'uik'=>$request->input('uik'),
            'koordinat'=>$request->input('koordinat'),
            'status'=>$request->input('status'),
            'image'=>$request->input('image')
        ]);
        if($query)
        {
            return back()->with('success', 'Данные успешно загружены');
        }
        else
        {
            return  back()-> with ('fail', 'Данные не были загружены');
        }

    }
    /*Добавление сообщения пользователя -- КОНЕЦ*/
    /*Вывод новости*/
    public function tidinggen($id)/*Передача всех данных новости*/
    {
        $row = DB::table('tidings')
            ->where('id', $id)
            ->first();
        $data =[
            'Info'=>$row,
            'Title'=>'Редактирование данных'
        ];

        return view('tiding_gen', $data);
    }
    public function addtidings(Request $request)/*Обработчик добавления новостей*/
    {


        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'description_max'=>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        $image = $request->file('image');
        $imageName = md5(random_bytes(32)) . '.' . $image->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $image->move($destinationPath, $imageName);



        $query = DB::table('tidings')-> insert([
            'title'=>$request->input('title'),
            'description'=>$request->input('description'),
            'description_max'=>$request->input('description_max'),
            'image'=>$imageName
        ]);
        if($query)
        {
            return back()->with('success', 'Данные успешно загружены');
        }
        else
        {
            return  back()-> with ('fail', 'Данные не были загружены');
        }

    }
}
