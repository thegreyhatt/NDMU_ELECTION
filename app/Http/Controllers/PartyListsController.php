<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PartyList;
use Illuminate\Http\Request;

class PartyListsController extends Controller
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
            $partylists = PartyList::where('partylist', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('college', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $partylists = PartyList::latest()->paginate($perPage);
        }

        return view('admin.party-lists.index', compact('partylists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.party-lists.create');
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
        
        PartyList::create($requestData);

        return redirect('admin/party-lists')->with('flash_message', 'PartyList added!');
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
        $partylist = PartyList::findOrFail($id);

        return view('admin.party-lists.show', compact('partylist'));
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
        $partylist = PartyList::findOrFail($id);

        return view('admin.party-lists.edit', compact('partylist'));
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
        
        $partylist = PartyList::findOrFail($id);
        $partylist->update($requestData);

        return redirect('admin/party-lists')->with('flash_message', 'PartyList updated!');
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
        PartyList::destroy($id);

        return redirect('admin/party-lists')->with('flash_message', 'PartyList deleted!');
    }
}
