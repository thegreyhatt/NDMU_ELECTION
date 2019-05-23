<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Vote;
use App\Voter;
use Illuminate\Http\Request;
use App\Candidate;
use App\College;
use App\Position;
use App\PartyList;
use Auth;
use Session;
use Validator;
use Illuminate\Support\Facades\Input;

class VotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function __construct()
    {
        $this->middleware('voting_auth');
    }
    
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $votes = Vote::latest()->paginate($perPage);
        } else {
            $votes = Vote::latest()->paginate($perPage);
        }

        return view('votes.index', compact('votes'));
    }

    public function ssg_display()
    {
        $candidates = Candidate::all();
        $positions = Position::all()->where('is_ssg', 1)
            ->sortBy('order')->pluck('position', 'id')->toArray();
        // dd($positions);
        // $voter = Session::get('voter');
        // Session::put('voter', $voter);

        return view('voting.votes.ssg_vote')
            ->with('candidates', $candidates)
            ->with('positions', $positions);
    }

    public function ssg_post(Request $request)
    {
        
        $candidates = Candidate::all();
        $positions = Position::all()->where('is_ssg', 0)
            ->sortBy('order')->pluck('position', 'id')->toArray();
        // dd($positions);
        // $voter = Session::get('voter');
        Session::put($request->all());
        // dd($request->Vice_President);
        return redirect('voting/votes/council')
            ->with('candidates', $candidates)
            ->with('positions', $positions);
    }


    public function council_display()
    {   
        $voter = Session::get('voter');
        // dd($voter['college_id']);
        $candidates = Candidate::all()->where('college_id',$voter['college_id']);
        $positions = Position::all()->where('is_ssg', 0)
            ->sortBy('order')->pluck('position', 'id')->toArray();
        // dd($positions);
        // $voter = Session::get('voter');
        Session::put('voter', $voter);
        
        return view('voting.votes.council_vote')
            ->with('college_id', $voter['college_id'])
            ->with('candidates', $candidates)
            ->with('positions', $positions);
    }

    public function council_post(Request $request)
    {
        $rules = [
            'id_num' => 'exists:students,id_num|unique:voters,id_num',
        ];

        $msgs = [
            'id_num.unique' => 'ID Number already voted.',
            'id_num.exists' => 'ID Number does not exist.'
        ];

        $validator = Validator::make(Session::get('voter'), $rules, $msgs);

        if($validator->fails()){

            Session::flush();

        return redirect('voting/votes');
        }else{
        $positions_ssg = Position::all()->where('is_ssg', 1)
            ->sortBy('order')->pluck('position', 'id')->toArray();

        $positions_council = Position::all()->where('is_ssg', 0)
            ->sortBy('order')->pluck('position', 'id')->toArray();
        Session::put($request->all());
        // dd(Session::all());
        $voter = Session::get('voter');
        $voter_save = new Voter;
        $voter_save->id_num = $voter['id_num'];
        $voter_save->college_id = $voter['college_id'];
        $voter_save->save();
        $voterID = $voter_save->id;
        
        // dd($voted);
        foreach ($positions_ssg as $position) {
            $votes = new Vote;
            $votes->voter_id = $voterID;
            if(!Session::get(str_replace(' ', '_', $position))){
                continue;
            }
            if (is_array(Session::get(str_replace(' ', '_', $position)))) {
                // dd(Session::get($position));
                $position_breakdowns = Session::get(str_replace(' ', '_', $position));
                foreach ($position_breakdowns as $position_breakdown) {
                    $votes = new Vote;
                    $votes->voter_id = $voter_save->id;
                    $votes->candidate_id = (int) $position_breakdown;
                    $votes->save();
                }
                
            }else{
                $votes->candidate_id = (int) Session::get(str_replace(' ', '_', $position));
            // }
            $votes->save();
            // dd(Session::get($position));
        }
    }
 
   
    foreach ($positions_council as $position) {
        $votes = new Vote;
        $votes->voter_id = $voterID;
        if(!Session::get(str_replace(' ', '_', $position))){
            continue;
        }
        if (is_array(Session::get(str_replace(' ', '_', $position)))) {
            $position_breakdowns = Session::get(str_replace(' ', '_', $position));
            // dd($position_breakdowns);
            foreach ($position_breakdowns as $position_breakdown) {
                $votes = new Vote;
                $votes->voter_id = $voter_save->id;
                $votes->candidate_id = (int) $position_breakdown;
                $votes->save();
            }
            
        }else{
            $votes->candidate_id = (int)Session::get(str_replace(' ', '_', $position));
        // }
        $votes->save();
        // dd(Session::get($position));
    }
}
        
        Session::flush();
        Session::put('flash_message','Successfully Voted!');
        return redirect('voting/votes');
    }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('voting.voters.create');
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
        
        // $requestData = $request->all();
        
        // Vote::create($requestData);
        // Auth::logout();
        return redirect('voting/votes')->with('flash_message', 'Vote added!');
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
        $vote = Vote::findOrFail($id);

        return view('votes.show', compact('vote'));
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
        $vote = Vote::findOrFail($id);

        return view('votes.edit', compact('vote'));
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
        
        $vote = Vote::findOrFail($id);
        $vote->update($requestData);

        return redirect('votes')->with('flash_message', 'Vote updated!');
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
        Vote::destroy($id);

        return redirect('votes')->with('flash_message', 'Vote deleted!');
    }
}
