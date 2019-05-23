<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Voter;
use App\College;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Session;

class VotersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('voting_auth')->except(['create', 'store']);
    }
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $voters = Voter::where('id_num', 'LIKE', "%$keyword%")
                ->orWhere('voter', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $voters = Voter::latest()->paginate($perPage);
        }

        return view('voting.voters.index', compact('voters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function start()
    {
        return redirect('/voting/votes');
    }
    public function create(Request $request)
    {   

        $colleges = College::all()->pluck('college', 'id');
        $flash_message = Session::get('flash_message');
        Session::forget('flash_message');
        // dd($flash_message);
        return view('voting.voters.create')            
            ->with('colleges', $colleges)
            ->with('flash_message', $flash_message);
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
        $rules = [
            'id_num' => 'required|exists:students,id_num|unique:voters,id_num',
        ];

        $msgs = [
            'id_num.unique' => 'ID Number already voted.',
            'id_num.required' => 'ID Number is required.',
            'id_num.exists' => 'ID Number does not exist.'
        ];
        $validator = Validator::make(Input::all(), $rules, $msgs);

        if($validator->fails()){
            return redirect()->back()
                ->withInput(Input::all())
                ->withErrors($validator);
        }else{

        $voter = new Voter;
        $voter->id_num = $request->id_num;
        $voter->college_id = $request->college_id;
        // dd($voter->id_num);
        // dd($voter);
        Session::put('voter', $voter->toArray());
        return redirect('voting/votes/ssg');
        }
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
        
        $voter = Voter::findOrFail($id);

        return view('voting.voters.show', compact('voter'));
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
        $voter = Voter::findOrFail($id);

        return view('voting.voters.edit', compact('voter'));
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
        
        $voter = Voter::findOrFail($id);
        $voter->update($requestData);

        return redirect('voting/voters')->with('flash_message', 'Voter updated!');
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
        Voter::destroy($id);

        return redirect('voting/voters')->with('flash_message', 'Voter deleted!');
    }
}
