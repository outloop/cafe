<?php

namespace App\Http\Controllers\Api;

use App\Cafe;
use App\Http\Requests\StoreCafeRequest;
use App\Http\Services\CafesService;
use App\Utilities\Maps\Gaode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CafesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cafes = Cafe::with('brewMethods')->get();
        return response()->json($cafes);
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
    public function store(StoreCafeRequest $request, CafesService $cafesService)
    {
        // 已添加的咖啡店
        $addedCafes = [];
        // 所有位置信息
        $locations = $request->input('locations');
        $saved = $cafesService->save($request->input('name'), $request->input('description'), $request->input('website'),
            $request->input('locations.0'), intval($request->input('roast', 0)), $request->input('locations.0.methodsAvailable'),
            0, $request->user()->id);
        array_push($addedCafes, $saved);

        // 第一个索引的位置信息已经使用，从第 2 个位置开始
        if (count($locations) > 1) {
            // 从索引值 1 开始，以为第一个位置已经使用了
            for ($i = 1; $i < count($locations); $i++) {
                $savedChild = $cafesService->save($request->input('name'), $request->input('description'), $request->input('website'),
                    $locations[$i], intval($request->input('roast', 0)), $locations[$i]['methodsAvailable'] ?? [],
                    $saved['id'], $request->user()->id);
                array_push($addedCafes, $savedChild);
            }
        }

        return response()->json($addedCafes, 201);
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
        $cafe = Cafe::where(['id' => $id])->with('brewMethods')->first();
        return response()->json($cafe);
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
