@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Članovi tima</h1>
      <div class="ml-auto">
        <a href="{{ route('admin_team_member_create') }}" class="btn btn-primary">
          <i class="fas fa-plus"></i> Dodaj novog
        </a>
      </div>
    </div>

    <div class="section-body">

      {{-- Flash poruke --}}
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      {{-- Pretraga / Filter --}}
      <form method="GET" class="mb-3 d-flex" style="gap: 10px;">
        <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Pretraga (ime, pozicija, email, telefon)">

        <select name="admin_id" class="form-control" style="max-width: 260px;">
          <option value="">— Svi administratori —</option>
          @foreach($admins as $a)
            <option value="{{ $a->id }}" @selected(request('admin_id') == $a->id)>{{ $a->name }}</option>
          @endforeach
        </select>

        <button class="btn btn-primary">Filtriraj</button>
        <a href="{{ route('admin_team_member_index') }}" class="btn btn-light">Reset</a>
      </form>

      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="example1">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Foto</th>
                  <th>Ime</th>
                  <th>Nadimak</th>
                  <th>Pozicija</th>
                  <th>Slug</th>
                  <th>Email</th>
                  <th>Telefon</th>
                  <th>Admin</th>
                  <th>Akcija</th>
                </tr>
              </thead>
              <tbody>
                @forelse($team_members as $idx => $item)
                  <tr>
                    <td>{{ $team_members->firstItem() + $idx }}</td>
                    <td style="width: 80px;">
                      @if($item->photo && file_exists(public_path('uploads/'.$item->photo)))
                        <img src="{{ asset('uploads/'.$item->photo) }}" alt="photo" class="img-fluid" style="max-height:60px;">
                      @else
                        <span class="text-muted">Nema</span>
                      @endif
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->nickname ?: '—' }}</td>
                    <td>{{ $item->designation }}</td>
                    <td><small class="text-monospace">{{ $item->slug }}</small></td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ optional($item->admin)->name ?: '—' }}</td>
                    <td>
                      <a href="{{ route('admin_team_member_edit',$item->id) }}" class="btn btn-sm btn-warning">Izmeni</a>
                      <form action="{{ route('admin_team_member_delete',$item->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Da li sigurno želiš da obrišeš ovog člana?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Obriši</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="10" class="text-center text-muted">Nema rezultata.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          {{-- Paginacija --}}
          <div class="mt-3">
            {{ $team_members->links() }}
          </div>
        </div>
      </div>

    </div>
  </section>
</div>
@endsection
