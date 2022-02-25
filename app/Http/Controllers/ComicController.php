<?php

namespace App\Http\Controllers;

use App\Comic;
use Illuminate\Http\Request;

class ComicController extends Controller
{

    protected $ruleValidation =  [
        'title' => 'required|max:100',
        'description' => 'required',
        'thumb' => 'required|max:100',
        'price' => 'required|integer',
        'series' => 'required',
        'sale_date' => 'required',
        'type' => 'required',
        'artist' => 'required',
        'writer' => 'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comics = Comic::paginate(12);
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
        $validateData = $request->validate($this->ruleValidation);

        $dataArray = $request->all();
        $comic = new Comic();
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
     * @param  \App\Comic  $comics
     * @return \Illuminate\Http\Response
     */
    public function show(Comic $comic)
    {
        $data = [
            'comic' => $comic,
            'title' => $comic->title
        ];
        return view('comics.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comic  $comics
     * @return \Illuminate\Http\Response
     */
    public function edit(Comic $comic)
    {
        return view('comics.edit', ['comic' => $comic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comic $comic)
    {
        $validateData = $request->validate($this->ruleValidation);

        $data = $request->all();
        $updated = $comic->update($data);
        if (!$updated) {
            dd('update non riuscito');
        }

        return redirect()->route('comics.show', $comic->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comic  $comic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comic $comic)
    {
        $comic->delete();

        return redirect()
            ->route('comics.index')
            ->with('status', "$comic->title è stato eliminato!");
    }
}
