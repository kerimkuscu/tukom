@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('fligram.store') }}" method="POST" enctype='multipart/form-data'>
            @csrf
            <input type="file" name="file">

            <button type="submit">
                submit
            </button>
        </form>
    </div>
@endsection
