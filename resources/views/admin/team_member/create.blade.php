@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')

<div class="main-content">
  <section class="section">
    <div class="section-header justify-content-between">
      <h1>Dodaj člana tima</h1>
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
          <form action="{{ route('admin_team_member_store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
              <label>Ime *</label>
              <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Slug *</label>
              <input type="text" name="slug" value="{{ old('slug') }}" class="form-control" required>
              <small class="text-muted">Dozvoljeni su slova, brojevi, crtice i donje crte.</small>
            </div>

            <div class="form-group">
              <label>Nadimak (opciono)</label>
              <input type="text" name="nickname" value="{{ old('nickname') }}" class="form-control">
            </div>

            <div class="form-group">
              <label>Pozicija *</label>
              <input type="text" name="designation" value="{{ old('designation') }}" class="form-control" required>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label>Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
              </div>
              <div class="form-group col-md-6">
                <label>Telefon *</label>
                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" required>
              </div>
            </div>

            <div class="form-group">
              <label>Adresa *</label>
              <input type="text" name="address" value="{{ old('address') }}" class="form-control" required>
            </div>

            <div class="form-group">
              <label>Biografija</label>
              <textarea name="biography" class="form-control" rows="4">{{ old('biography') }}</textarea>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                <label>Facebook</label>
                <input type="text" name="facebook" value="{{ old('facebook') }}" class="form-control">
              </div>
              <div class="form-group col-md-4">
                <label>LinkedIn</label>
                <input type="text" name="linkedin" value="{{ old('linkedin') }}" class="form-control">
              </div>
              <div class="form-group col-md-4">
                <label>Instagram</label>
                <input type="text" name="instagram" value="{{ old('instagram') }}" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label>Administrator (opciono)</label>
              <select name="admin_id" class="form-control">
                <option value="">— Bez veze —</option>
                @foreach($admins as $a)
                  <option value="{{ $a->id }}" @selected(old('admin_id') == $a->id)>{{ $a->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label>Fotografija *</label>
              <input type="file" name="photo" class="form-control-file" required>
            </div>

            <button class="btn btn-primary">Sačuvaj</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
