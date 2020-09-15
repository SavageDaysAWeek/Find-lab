@extends('base')
@section('content')
<div class="container text-center my-5">
    @if ($type === 0)
    <span>На странице приведен список имеющихся документов.<br> Найдите нужный и напишите его владельцу.</span>
    @else
    <span>На странице приведен список искомых документов.<br> Если у вас имеется подходящий документ, вы можете помочь.</span>
    @endif
    
    <div class="col-lg-4 col-sm-6 col-10 mt-5 mb-2 mx-auto bg-secondary">
        <input type="search" class="form-control form-control-lg form-control-alternative searchInput" id="searchTitle" placeholder="Название документа">
    </div>
    <div class="row mb-4">
        <div class="col-lg-3 col-sm-5 col-10 my-2 mx-auto bg-secondary">
            <input type="search" class="form-control form-control-alternative searchInput" id="searchUniver" placeholder="Университет">
        </div>
        <div class="col-lg-3 col-sm-5 col-10 my-2 mx-auto bg-secondary">
            <input type="search" class="form-control form-control-alternative searchInput" id="searchSubject" placeholder="Предмет">
        </div>
        <div class="col-lg-3 col-sm-5 col-10 my-2 mx-auto bg-secondary">
            <input type="number" min="1" max="5" class="form-control form-control-alternative searchInput" id="searchYear" placeholder="Курс">
        </div>
        <div class="col-lg-3 col-sm-5 col-10 my-2 mx-auto bg-secondary">
            <select class="form-control form-control-alternative searchInput" id="searchSemester">
                <option>Семестр</option>
                <option value="0">Осенний</option>
                <option value="1">Весенний</option>
            </select>
        </div>
    </div>

    <div id="doc-list">
        @include('layouts.doc-list')
    </div>
</div>
@endsection

@section('script')
    <script>
        $('.searchInput').on('input', function() {
            $.ajax({
                type: "POST",
                url: "/search-doc",
                data: {
                    title: $('#searchTitle').val(),
                    subject: $('#searchSubject').val(),
                    univer: $('#searchUniver').val(),
                    year: $('#searchYear').val(),
                    semester: $('#searchSemester').val(),
                    type: {{ $type }}
                },
                dataType: "text",
                success: function (response) {
                    $('#doc-list').html(response);
                }
            });
        });
    </script>
@endsection