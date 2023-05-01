<?php

namespace App\Http\Controllers;

use App\Exports\FileReportExport;
use App\Models\FileReport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class FileReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    }

    public function export()
    {
        return Excel::download(new FileReportExport, 'filereport.xlsx');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileReport  $fileReport
     * @return \Illuminate\Http\Response
     */
    public function show(FileReport $fileReport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileReport  $fileReport
     * @return \Illuminate\Http\Response
     */
    public function edit(FileReport $fileReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileReport  $fileReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileReport $fileReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileReport  $fileReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileReport $fileReport)
    {
        //
    }
}
