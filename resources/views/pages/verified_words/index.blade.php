@extends('layouts.app')

@section('title', 'Unverified Words')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="soft-black text-secondary">
                <i class="fa-solid fa-file-circle-xmark mr-2"></i>
                Verified Words
            </h1>
        </div>
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
                        @php
                            $dir = 'ltr';
                            $language = '';
                        @endphp
                        @if ($row->language == 'BL')
                            @php
                                $dir = 'rtl';
                                $language = 'Balochi';
                            @endphp
                        @elseif($row->language == 'UR')
                            @php
                                $dir = 'rtl';
                                $language = 'Urdu';
                            @endphp
                        @elseif($row->language == 'EN')
                            @php
                                $dir = 'ltr';
                                $language = 'English';
                            @endphp
                        @elseif($row->language == 'RB')
                            @php
                                $dir = 'ltr';
                                $language = 'Roman Balochi';
                            @endphp
                        @endif
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td class="{{ $dir }}">{{ $row->word }}</td>
                            <td>{{ $language }}</td>
                            <td class="d-flex justify-content-end">
                                <a class="btn btn-primary mx-2 text-light"
                                    href="/definition/wordid/{{ $row->id }}">Definition</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
