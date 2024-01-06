<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(Request $request){
        //search
        $keyword = $request->keyword;
        if(strlen($keyword)){
            $member = Member::where('name', 'like', '%' . $keyword . '%')->get();
        }else{
            $member = Member::orderBy('name', 'asc')->get();
        }
        return view('members.index', compact('member'));
    }
    public function create(){
        //get all members data and pass to create view
        $member = Member::all();
        return view('members.create', compact('member'));
    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required | email',
            'phone' => 'required'
        ]);
        //insert data
        Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return redirect('/members')->with('success', 'New Member Successfully Added');
    }

    public function edit($id){
        //get the selected member data
        $member = Member::find($id);
        return view('members.edit', compact('member'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required | email',
            'phone' => 'required'
        ]);
        //update selected member's data
        $member = Member::find($id);
        $member->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return redirect('/members')->with('success', 'Changes Saved');
    }

    public function destroy($id)
    {
        //delete selected member data
        $member = Member::find($id);
        $member->delete();
        return redirect('/members')->with('success', 'Member Deleted');
    }
}
