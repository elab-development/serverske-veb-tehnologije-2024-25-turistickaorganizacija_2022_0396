<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamApiController extends Controller
{
    /**
     * GET /api/team
     * Podržava ?per_page=10 (paginacija) ili ?per_page=all (svi zapisi)
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 20);

        // Bazni upit: samo polja koja su ti korisna za javni API
        $query = TeamMember::select(
            'id','name','slug','designation','email','phone',
            'photo','facebook','twitter','linkedin','instagram'
        )->orderBy('id', 'asc');

        // Ako traže sve (bez paginacije)
        if ($perPage === 'all') {
            $items = $query->get()->map(function ($m) {
                return $this->transform($m);
            });

            return response()->json([
                'count' => $items->count(),
                'data'  => $items,
            ]);
        }

        // Paginacija
        $perPage = (int) $perPage ?: 20;
        $page = (int) $request->query('page', 1);

        $paginator = $query->paginate($perPage, ['*'], 'page', $page);

        // Transformiši rezultate (npr. apsolutni URL za fotografiju)
        $data = collect($paginator->items())->map(function ($m) {
            return $this->transform($m);
        });

        return response()->json([
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
                'last_page'    => $paginator->lastPage(),
            ],
            'data' => $data,
        ]);
    }

    private function transform(TeamMember $m): array
    {
        // Pokušaj da napraviš apsolutni URL do slike (prilagodi putanju ako koristiš drugi folder)
        $photoUrl = $m->photo
            ? url('/uploads/' . ltrim($m->photo, '/'))
            : null;

        return [
            'id'          => $m->id,
            'name'        => $m->name,
            'slug'        => $m->slug,
            'designation' => $m->designation,
            'email'       => $m->email,
            'phone'       => $m->phone,
            'photo'       => $m->photo,
            'photo_url'   => $photoUrl,
            'social'      => [
                'facebook' => $m->facebook,
                'twitter'  => $m->twitter,
                'linkedin' => $m->linkedin,
                'instagram'=> $m->instagram,
            ],
        ];
    }
}
