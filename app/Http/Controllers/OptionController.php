<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultList = Option::paginate(config('constants.RECORD_PER_PAGE'));

        return view('console/options/index', compact('resultList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOptionRequest $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        //
    }

    public function getOptionWithGroups(){
        //SELECT * FROM options
        //JOIN option_groups ON option_groups.id = group_id

        return Option::paymentMethod()->select('options.id','options.name as opt_name','option_groups.name as group_name')
            ->join('option_groups','option_groups.id','=','group_id')
            ->where('options.id','>', 3)
            ->get();
    }
}
