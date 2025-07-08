@extends('layouts.app')

@section('content')
    @if($page === 'makanan')
        @include('admin.menu.index', ['menus' => $menus, 'kategoris' => $kategoris])
    @elseif($page === 'minuman')
        @include('admin.minuman.index', ['minumans' => $minumans])
    @elseif($page === 'snack')
        @include('admin.snack.index', ['snacks' => $snacks])
    @elseif($page === 'kategori')
        @include('admin.kategori.index', ['kategoris' => $kategoris])
    @else
        <p class="text-muted">Silakan pilih menu dari sidebar.</p>
    @endif
@endsection
