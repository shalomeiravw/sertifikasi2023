<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(){
        $member = Member::all();
        return view('members.index', compact('member'));
    }
    public function create(){
        $member = Member::all();
        return view('members.create', compact('member'));
    }
    public function store(Request $request){
        
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required | email',
            'phone' => 'required'
        ]);
        
        Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        return redirect('/members')->with('success', 'New Member Successfully Added');
    }

    public function edit($id){
        $member = Member::find($id);
        return view('members.edit', compact('member'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|min:2',
            'email' => 'required | email',
            'phone' => 'required'
        ]);
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
        $member = Member::find($id);
        $member->delete();
        return redirect('/members')->with('success', 'Member Deleted');
    }
}
