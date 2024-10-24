@extends('layouts.app')

@section('title', 'Unverified Words')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="soft-black text-secondary">
                <i class="fa-solid fa-file-circle-check mr-2"></i>
                Unverified Words
            </h1>
        </div>
        <br>
        <div class="row">
            <form class="submit" method="post" action="{{ route('add_unverified_words') }}">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <label for="word">Word</label>
                        <input class="form-control" id="word" name="word" type="text" required
                            placeholder="Word">
                    </div>
                    <div class="col-3">
                        <label for="language">Language</label>
                        <select class="form-select" id="language" id="language" name="language"
                            aria-label="Select Language" required>
                            <option value="" selected disabled>Language</option>
                            <option value="BL">Balochi</option>
                            <option value="UR">Urdu</option>
                            <option value="EN">English</option>
                            <option value="RB">Roman Balochi</option>
                        </select>
                    </div>
                    <div class="col-3">
                        <br>
                        <input class="btn btn-primary submit" type="submit" value="Add Word">
                    </div>
                </div>
            </form>
        </div>

        <br>
        <hr>
        <br>

        <div class="data-table-container row bg-body">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Word</th>
                        <th>Language</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Word</th>
                        <th>Language</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->word }}</td>
                            <td>
                                @if ($row->language == 'BL')
                                    Balochi
                                @elseif($row->language == 'UR')
                                    Urdu
                                @elseif($row->language == 'EN')
                                    English
                                @elseif($row->language == 'RB')
                                    Roman Balochi
                                @endif
                            </td>
                            <td class="d-flex justify-content-end">
                                <button class="btn btn-primary mx-2">
                                    Definition
                                </button>
                                <button class="btn btn-danger mx-2">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script')

@endsection
