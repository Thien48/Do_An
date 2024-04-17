<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
class SinhVienController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        // Định dạng theo định dạng chuẩn của PHP
        $formattedDateTime = $now->format('d-m-Y');

        return view(
            'sinhVien.index',
            ['formattedDateTime' => $formattedDateTime],
            ['title' => 'Thêm danh mục mới']
        );

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
