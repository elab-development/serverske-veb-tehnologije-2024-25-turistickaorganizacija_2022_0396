@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Izmeni člana tima</h1>
      <div class="ml-auto">
        <a href="{{ route('admin_team_member_index') }}" class="btn btn-secondary">Nazad</a>
      </div>
    </div>

    <div class="section-body">
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="card">
        <div class="card-body">
          <form action="{{ route('admin_team_member_update', $team_member->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
              <label>Ime *</label>
              <input type="text" name="name" value="{{ old('name', $team_member->name) }}" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Slug *</label>
              <input type="text" name="slug" value="{{ old('slug', $team_member->slug) }}" class="form-control" required>
              <small class="text-muted">Dozvoljeni su slova, brojevi, crtice i donje crte.</small>
            </div>

            <div class="form-group">
              <label>Nadimak (opciono)</label>
              <input type="text" name="nickname" value="{{ old('nickname', $team_member->nickname) }}" class="form-control">
            </div>

            <div class="form-group">
              <label>Pozicija *</label>
              <input type="text" name="designation" value="{{ old('designation', $team_member->designation) }}" class="form-control" required>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Email *</label>
                <input type="email" name="email" value="{{ old('email', $team_member->email) }}" class="form-control" required>
              </div>
              <div class="form-group col-md-6">
                <label>Telefon *</label>
                <input type="text" name="phone" value="{{ old('phone', $team_member->phone) }}" class="form-control" required>
              </div>
            </div>

            <div class="form-group">
              <label>Adresa *</label>
              <input type="text" name="address" value="{{ old('address', $team_member->address) }}" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Biografija</label>
              <textarea name="biography" class="form-control" rows="4">{{ old('biography', $team_member->biography) }}</textarea>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Facebook</label>
                <input type="text" name="facebook" value="{{ old('facebook', $team_member->facebook) }}" class="form-control">
              </div>
              <div class="form-group col-md-4">
                <label>LinkedIn</label>
                <input type="text" name="linkedin" value="{{ old('linkedin', $team_member->linkedin) }}" class="form-control">
              </div>
              <div class="form-group col-md-4">
                <label>Instagram</label>
                <input type="text" name="instagram" value="{{ old('instagram', $team_member->instagram) }}" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label>Administrator (opciono)</label>
              <select name="admin_id" class="form-control">
                <option value="">— Bez veze —</option>
                @foreach($admins as $a)
                  <option value="{{ $a->id }}" @selected(old('admin_id', $team_member->admin_id) == $a->id)>{{ $a->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-row align-items-end">
              <div class="form-group col-md-6">
                <label>Nova fotografija (opciono)</label>
                <input type="file" name="photo" class="form-control-file">
                <small class="text-muted d-block">Dozvoljeni formati: jpeg, png, jpg, gif, svg. Max 2MB.</small>
              </div>
              <div class="form-group col-md-6">
                <label>Trenutna fotografija</label>
                <div>
                  @if($team_member->photo && file_exists(public_path('uploads/'.$team_member->photo)))
                    <img src="{{ asset('uploads/'.$team_member->photo) }}" alt="photo" class="img-fluid" style="max-height:100px;">
                  @else
                    <span class="text-muted">Nema</span>
                  @endif
                </div>
              </div>
            </div>

            <button class="btn btn-primary">Sačuvaj izmene</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
