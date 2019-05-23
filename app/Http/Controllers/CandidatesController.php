<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Image;
use Validator;
use Storage;
use Illuminate\Support\Facades\Input;

use App\Candidate;
use Illuminate\Http\Request;

use App\College;
use App\Position;
use App\PartyList;

class CandidatesController extends Controller
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
            $candidates = Candidate::where('profile_pic', 'LIKE', "%$keyword%")
                ->orWhere('id_num', 'LIKE', "%$keyword%")
                ->orWhere('position', 'LIKE', "%$keyword%")
                ->orWhere('college', 'LIKE', "%$keyword%")
                ->orWhere('party_list', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $candidates = Candidate::latest()->paginate($perPage);
        }
        // dd($candidates);
        return view('admin.candidates.index', compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $colleges = College::all()->pluck('college', 'id');
        $positions = Position::all();
        $party_lists = PartyList::get()->pluck('party_list', 'id');
        // dd($colleges);
        return view('admin.candidates.create')
        ->with('colleges', $colleges)
        ->with('positions', $positions)
        ->with('party_lists', $party_lists);
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
        $candidate = new Candidate;
        $rules = Candidate::$rules;
        $msgs = [
            'id_num.required' => 'ID Number is required.',
            'id_num.exists' => 'ID Number does not exist.',
            'id_num.unique' => 'ID Number must be unique.',
        ];
        $validator = Validator::make(Input::all(),  $rules, $msgs);

        if($validator->fails()){
            return redirect()->back()
                ->withInput(Input::all())
                ->withErrors($validator);
        }else{
            $candidate->id_num = $request->id_num;
            $candidate->position_id = $request->position_id;
            $candidate->college_id = $request->college_id;
            $candidate->party_list_id = $request->party_list_id;
        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('image/'.$filename);
            Image::make($image)->resize(300, 300)->save($location);
            $candidate->profile_pic = $filename;
          }else{
            $filename = 'dummy-pic.jpg';
            $candidate->profile_pic = $filename;
          }
          $candidate->save();
        return redirect('admin/candidates')->with('flash_message', 'Candidate added!');
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
        $candidate = Candidate::findOrFail($id);
        
        return view('admin.candidates.show', compact('candidate'));
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
        $candidate = Candidate::findOrFail($id);
        $colleges = College::all()->pluck('college', 'id');
        $positions = Position::all();
        $party_lists = PartyList::get()->pluck('party_list', 'id');
        return view('admin.candidates.edit', compact('candidate'))
            ->with('colleges', $colleges)
            ->with('positions', $positions)
            ->with('party_lists', $party_lists);
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
        $candidate = Candidate::findOrFail($id);
        $rules = Candidate::$rules;
        $rules['id_num'] = $rules['id_num'] . ','.$request->id_num.',' .'id_num' ;
        $msgs = [
            'id_num.required' => 'ID Number is required.',
            'id_num.exists' => 'ID Number does not exist.',
            'id_num.unique' => 'ID Number must be unique.',
        ];
        $validator = Validator::make(Input::all(), $rules, $msgs);

        if($validator->fails()){
            return redirect()->back()
                ->withInput(Input::all())
                ->withErrors($validator);
        }else{
        $candidate->id_num = $request->id_num;
        $candidate->position_id = $request->position_id;
        $candidate->college_id = $request->college_id;
        $candidate->party_list_id = $request->party_list_id;
        if ($request->hasFile('profile_pic')) {
            $image = $request->file('profile_pic');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('image/'.$filename);
            Image::make($image)->resize(300, 300)->save($location);
    
            $oldfilename = $candidate->profile_pic;
    
            $candidate->profile_pic = $filename;
    
            Storage::delete($oldfilename);
          }else{
            $filename = 'dummy-pic.jpg';
            $candidate->profile_pic = $filename;
          }
          $candidate->save();
        return redirect('admin/candidates')->with('flash_message', 'Candidate updated!');
        }
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
        Candidate::destroy($id);

        return redirect('admin/candidates')->with('flash_message', 'Candidate deleted!');
    }
}
