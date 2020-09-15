@extends('base')
@section('content')
    <div class="container my-5 table-responsive">
        <ul class="nav nav-pills nav-fill flex-column flex-md-row col-lg-6 col-md-8 mx-auto mb-5" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 active" data-type="0" id="0-tab" data-toggle="tab" href="#tab-doc0" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                    <i class="ni ni-zoom-split-in mr-2"></i>
                    Я ищу документ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" data-type="1" id="1-tab" data-toggle="tab" href="#tab-doc1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">
                    <i class="ni ni-circle-08 mr-2"></i>
                    Что ищут другие
                </a>
            </li>
        </ul>
        

        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-doc0" role="tabpanel" aria-labelledby="0-tab">
                @include('layouts.doc-list', ['docs' => $docs_0, 'type' => 0, 'ad_docs' => $ad_docs])
            </div>
            <div class="tab-pane fade" id="tab-doc1" role="tabpanel" aria-labelledby="0-tab">
                @include('layouts.doc-list', ['docs' => $docs_1, 'type' => 1, 'ad_docs' => $ad_docs])
            </div>
        </div>
    </div>
@endsection