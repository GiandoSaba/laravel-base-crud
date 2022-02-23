<?php

namespace App\Http\Controllers;

use App\Comics;
use Illuminate\Http\Request;

class ComicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comics = Comics::paginate(10);
        $data = [
            'comics' => $comics,
            'title' => 'Comics Home',
        ];
        return view('comics.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comics.create', ['title' => 'Add new comic']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataArray = $request->all();
        $comic = new Comics();
        $comic->title = $dataArray['title'];
        $comic->description = $dataArray['description'];
        $comic->thumb = $dataArray['thumb'];
        $comic->price = $dataArray['price'];
        $comic->series = $dataArray['series'];
        $comic->sale_date = $dataArray['sale_date'];
        $comic->type = $dataArray['type'];
        $comic->artist = $dataArray['artist'];
        $comic->writer = $dataArray['writer'];

        $save = $comic->save();

        if (!$save) {
            dd('salvataggio non riuscito');
        }

        return redirect()->route('comics.show', $comic->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comics  $comics
     * @return \Illuminate\Http\Response
     */
    public function show(Comics $comics)
    {
        $data = [
            'comic' => $comics,
            'title' => $comics->title
        ];
        return view('comics.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comics  $comics
     * @return \Illuminate\Http\Response
     */
    public function edit(Comics $comics)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comics  $comics
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comics $comics)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comics  $comics
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comics $comics)
    {
        //
    }
}
