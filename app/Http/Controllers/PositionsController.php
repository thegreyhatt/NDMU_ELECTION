<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Position;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $positions = Position::where('position', 'LIKE', "%$keyword%")
                ->orWhere('order', 'LIKE', "%$keyword%")
                ->orWhere('is_ssg', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $positions = Position::latest()->paginate($perPage);
        }

        return view('admin.positions.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.positions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Position::create($requestData);

        return redirect('admin/positions')->with('flash_message', 'Position added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $position = Position::findOrFail($id);

        return view('admin.positions.show', compact('position'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $position = Position::findOrFail($id);

        return view('admin.positions.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $position = Position::findOrFail($id);
        $position->update($requestData);

        return redirect('admin/positions')->with('flash_message', 'Position updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Position::destroy($id);

        return redirect('admin/positions')->with('flash_message', 'Position deleted!');
    }
}
