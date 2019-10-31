<?php

namespace App\Http\Controllers;

use App\ItemSchema;
use App\Website;
use Illuminate\Http\Request;

class ItemSchemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $itemSchemas = ItemSchema::orderBy('id', 'DESC')->paginate(10);
        return view('item-schema.index', compact('itemSchemas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item-schema.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'css_expression' => 'required',
            'full_content_selector' => 'required'
        ]);

        ItemSchema::create($request->all());
        return redirect()->route('item-schema.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param ItemSchema $itemSchema
     * @return void
     */
    public function edit(ItemSchema $itemSchema)
    {
        return view('item-schema.edit', compact('itemSchema'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param ItemSchema $itemSchema
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, ItemSchema $itemSchema)
    {
        $this->validate($request, [
            'title' => 'required',
            'css_expression' => 'required',
            'full_content_selector' => 'required'
        ]);

        $itemSchema->update($request->all());

        return redirect()->route('item-schema.index');
    }

}
