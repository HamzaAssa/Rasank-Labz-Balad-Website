@extends('layouts.app')

@section('title', 'Verified Words')

@section('content')
    <div class="container">
        <div class="row">
            <h1 class="soft-black text-secondary">
                <i class="fa-solid fa-file-circle-xmark mr-2"></i>
                Verified Words
            </h1>
        </div>
        @if (Auth::user() && (Auth::user()->role === 'admin' || Auth::user()->role === 'publisher'))
            <div class="row">
                <div class="col-8"></div>
                <div class="col-4 d-flex justify-content-end">
                    <button class="btn btn-primary mx-2" data-action="{{ route('publish_verified_words') }}"
                        data-text="Are you sure you want to publish all new words." data-bs-target="#confirmModal"
                        data-bs-toggle="modal">
                        Publish Words
                    </button>
                </div>
            </div>
        @endif
        <br>
        <div class="data-table-container row bg-body">
            <table class="table table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Word</th>
                        <th>Language</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Word</th>
                        <th>Language</th>
                        <th>Status</th>
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
                            <td>
                                @if ($row->status == 2)
                                    <span class="badge bg-danger fw-light">Un Published</span>
                                @else
                                    <span class="badge bg-primary fw-light">Published</span>
                                @endif
                            </td>
                            <td class="d-flex justify-content-end">
                                <button class="btn btn-primary mx-2" data-id="{{ $row->id }}"
                                    data-word="{{ $row->word }}" data-language="{{ $row->language }}"
                                    data-bs-toggle="modal" data-balochi="{{ $row->meanings()['balochi']->id }}"
                                    data-urdu="{{ $row->meanings()['urdu']->id }}"
                                    data-english="{{ $row->meanings()['english']->id }}"
                                    data-roman_balochi="{{ $row->meanings()['romanBalochi']->id }}"
                                    data-relation_id="{{ $row->meanings()['relationId'] }}" data-bs-target="#meaningModal"
                                    type="button">
                                    Meaning
                                </button>
                                <a class="btn btn-secondary mx-2 text-light"
                                    href="/definition/wordid/{{ $row->id }}">Definition</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="meaningModal" aria-labelledby="meaningModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="meaningModalLabel">Add Word meaning</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="submit" method="post" action="{{ route('add_meaning_unverified_words') }}">
                        @csrf
                        <div class="row" id="fields">
                            <div class="col-12 my-3 mt-1 form-group" id="BL">
                                <label>Balochi Word: </label>
                                @php
                                    $words = \App\Models\Word::balochiWords();
                                @endphp
                                <select class="form-select" name="balochi_id">
                                    @foreach ($words as $word)
                                        <option value="{{ $word->id }}">{{ $word->word }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 my-3 form-group" id="UR">
                                <label>Urdu Word: </label>
                                @php
                                    $words = \App\Models\Word::urduWords();
                                @endphp
                                <select class="form-select" name="urdu_id">
                                    @foreach ($words as $word)
                                        <option value="{{ $word->id }}">{{ $word->word }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 my-3 form-group" id="EN">
                                <label>English Word: </label>
                                @php
                                    $words = \App\Models\Word::englishWords();
                                @endphp
                                <select class="form-select" name="english_id">
                                    @foreach ($words as $word)
                                        <option value="{{ $word->id }}">{{ $word->word }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 my-3 form-group" id="RB">
                                <label>Roman Balochi Word: </label>
                                @php
                                    $words = \App\Models\Word::romanBalochiWords();
                                @endphp
                                <select class="form-select" name="roman_balochi_id">
                                    @foreach ($words as $word)
                                        <option value="{{ $word->id }}">{{ $word->word }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input name="date" type="hidden" value="{{ date('Y-m-d') }}">
                            <input id="id" name="id" type="hidden" value="">
                            <button class="btn btn-primary" type="submit">Save Changes</button>
                    </form>
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        let balochiSelectBox = $(`#BL`);
        let urduSelectBox = $(`#UR`);
        let englishSelectBox = $(`#EN`);
        let romanBalochiSelectBox = $(`#RB`);

        $('#meaningModal').on('show.bs.modal', function(event) {
            let modal = $(this);
            modal.find('.modal-body #fields').empty();

            let button = $(event.relatedTarget);
            let id = button.data('id');
            let language = button.data('language');
            let word = button.data('word');
            let relationId = button.data('relation_id');

            let balochiId = button.data("balochi")
            let urduId = button.data("urdu")
            let englishId = button.data("english")
            let romanBalochiId = button.data("roman_balochi")

            copyBalochiSelectBox = balochiSelectBox.clone();
            copyBalochiSelectBox.find('select').val(balochiId);

            copyUrduSelectBox = urduSelectBox.clone();
            copyUrduSelectBox.find('select').val(urduId);

            copyEnglishSelectBox = englishSelectBox.clone();
            copyEnglishSelectBox.find('select').val(englishId);

            copyRomanBalochiSelectBox = romanBalochiSelectBox.clone();
            copyRomanBalochiSelectBox.find('select').val(romanBalochiId);


            let newOption = document.createElement('option');
            newOption.value = id;
            newOption.text = word;

            if (language == "BL") {
                copyBalochiSelectBox.find('select').empty().append(newOption);
                copyBalochiSelectBox.find('select').val(newOption.value);
            } else if (language == "UR") {
                copyUrduSelectBox.find('select').empty().append(newOption);
                copyUrduSelectBox.find('select').val(newOption.value);
            } else if (language == "EN") {
                copyEnglishSelectBox.find('select').empty().append(newOption);
                copyEnglishSelectBox.find('select').val(newOption.value);
            } else if (language == "RB") {
                copyRomanBalochiSelectBox.find('select').empty().append(newOption);
                copyRomanBalochiSelectBox.find('select').val(newOption.value);
            }

            modal.find('.modal-body #fields')
                .append(copyBalochiSelectBox)
                .append(copyUrduSelectBox)
                .append(copyEnglishSelectBox)
                .append(copyRomanBalochiSelectBox);
            modal.find(".modal-body #id").val(relationId);

        });
    </script>
@endsection
