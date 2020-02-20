<?php

namespace App\Http\Controllers;

use App\Services\BinaryManageService;
use App\Services\BinaryOutputService;
use App\Services\BinaryStoreService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class BinaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bla       = new BinaryOutputService();
        $tree      = $bla->outputBinaryTree(1);//get binary tree structure
        $parentIds = (new BinaryStoreService())->getParentIds();//get parent ids to add for him new items

        return view('binaries.index', compact('parentIds', 'tree'));
    }

    /**
     * Auto fill binary tree
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fill()
    {
        $binaryManageService = new BinaryManageService();

        $binaryManageService->autoFill(5);

        return redirect()->back();
    }

    public function reset()
    {
        $binaryManageService = new BinaryManageService();
        $binaryManageService->clearData();

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input   = $request->all();
        $res     = (new BinaryStoreService())->store($input['parent_id'], $input['position']);
        $message = ($res) ? Lang::get('translations.form.success') : Lang::get('translations.form.exists');

        return redirect()->back()->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
