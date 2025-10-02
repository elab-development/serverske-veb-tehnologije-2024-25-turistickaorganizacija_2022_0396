<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TeamMemberApiController extends Controller
{
    public function index(Request $r)
    {
        $q = TeamMember::query();

        if ($s = $r->get('q')) {
            $q->where(function($w) use ($s) {
                $w->where('name','like',"%{$s}%")
                  ->orWhere('designation','like',"%{$s}%")
                  ->orWhere('email','like',"%{$s}%");
            });
        }

        $per = (int)($r->get('per_page', 10));
        $items = $q->orderBy('id','desc')->paginate($per);

        return response()->json([
            'data' => $items->items(),
            'meta' => [
                'current_page'=>$items->currentPage(),
                'per_page'=>$items->perPage(),
                'total'=>$items->total(),
                'last_page'=>$items->lastPage(),
            ],
        ]);
    }

    public function show($id)
    {
        try {
            $tm = TeamMember::findOrFail($id);
            return response()->json(['data'=>$tm]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error'=>'Not found'], 404);
        }
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'name'=>'required',
            'slug'=>'required|alpha_dash|unique:team_members,slug',
            'designation'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'address'=>'required',
            'biography'=>'nullable|string',
            'facebook'=>'nullable|string',
            'linkedin'=>'nullable|string',
            'instagram'=>'nullable|string',
            'nickname'=>'nullable|string|max:255',
            'admin_id'=>'nullable|exists:admins,id',
        ]);

        $tm = TeamMember::create($data);

        return response()->json(['message'=>'Created','data'=>$tm], 201);
    }

    public function update(Request $r, $id)
    {
        try {
            $tm = TeamMember::findOrFail($id);

            $data = $r->validate([
                'name'=>'sometimes|required',
                'slug'=>"sometimes|required|alpha_dash|unique:team_members,slug,{$tm->id}",
                'designation'=>'sometimes|required',
                'email'=>'sometimes|required|email',
                'phone'=>'sometimes|required',
                'address'=>'sometimes|required',
                'biography'=>'nullable|string',
                'facebook'=>'nullable|string',
                'linkedin'=>'nullable|string',
                'instagram'=>'nullable|string',
                'nickname'=>'nullable|string|max:255',
                'admin_id'=>'nullable|exists:admins,id',
            ]);

            $tm->update($data);

            return response()->json(['message'=>'Updated','data'=>$tm]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error'=>'Not found'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $tm = TeamMember::findOrFail($id);
            $tm->delete();
            return response()->json(['message'=>'Deleted']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error'=>'Not found'], 404);
        }
    }
}
