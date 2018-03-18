<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Entry;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;

class EntryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $entry = Entry::all();

        return response()
            ->json($entry);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backEnd.entry.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        pr($request);die;
        (Entry::create($request->all()) ? $message = true : $message = false);
        return response()
            ->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $entry = Entry::findOrFail($id);

        return view('backEnd.entry.show', compact('entry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $entry = Entry::findOrFail($id);

        return view('backEnd.entry.edit', compact('entry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {

        $entry = Entry::findOrFail($id);
        $entry->update($request->all());

        Session::flash('message', 'Entry updated!');
        Session::flash('status', 'success');

        return redirect('api/entry');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $entry = Entry::findOrFail($id);

        $entry->delete();

        Session::flash('message', 'Entry deleted!');
        Session::flash('status', 'success');

        return redirect('api/entry');
    }

    /**
     * Get csrf token for angular
     */
    public function csrf()
    {
        return response()->json(csrf_token());
    }

}
