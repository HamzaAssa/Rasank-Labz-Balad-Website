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
                            <td class="d-flex justify-content-center">
                                <button class="btn btn-primary mx-2">
                                    Meaning
                                </button>
                                <button class="btn btn-secondary mx-2 text-light">
                                    Definition
                                </button>
                                <button class="btn btn-success mx-2" data-id="{{ $row->id }}"
                                    data-word="{{ $row->word }}" data-language="{{ $row->language }}"
                                    data-bs-toggle="modal" data-bs-target="#updateModal" type="button">
                                    Update
                                </button>
                                <button class="btn btn-danger submit mx-1"
                                    data-action="{{ route('delete_unverified_words') }}" data-id="{{ $row->id }}"
                                    data-bs-target="#deleteModal" data-bs-toggle="modal">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="updateModal" aria-labelledby="updateModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Word Info</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="submit" method="post" action="{{ route('update_unverified_words') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="word">Word</label>
                                <input class="form-control" id="updateWord" name="word" type="text" required
                                    placeholder="Word">
                            </div>
                            <div class="col-12">
                                <label for="language">Language</label>
                                <select class="form-select" id="updateLanguage" id="language" name="language"
                                    aria-label="Select Language" required>
                                    <option value="BL">Balochi</option>
                                    <option value="UR">Urdu</option>
                                    <option value="EN">English</option>
                                    <option value="RB">Roman Balochi</option>
                                </select>
                            </div>
                            <input id="updateId" name="id" type="hidden" value="">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Save changes</button>
                    </form>
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $('#updateModal').on('show.bs.modal', function(event) {
            let button = $(event.relatedTarget)
            let id = button.data('id')
            let word = button.data('word')
            let language = button.data('language')

            let modal = $(this)
            modal.find('.modal-body #updateId').val(id)
            modal.find('.modal-body #updateWord').val(word);
            modal.find('.modal-body #updateLanguage').val(language);
        })
    </script>

@endsection
