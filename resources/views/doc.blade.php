@extends('base')
@section('content')
<div class="container my-5 d-flex justify-content-center">
    <div class="card">
        <div class="card-body px-5">
            <div class="d-flex justify-content-center">
                <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                    <i class="ni ni-book-bookmark"></i>
                </div>
            </div>
            <h2 class="card-title text-uppercase mt-3 text-center">{{ $doc->title }}</h2>

            <div class="d-flex flex-column">
                <span class="mt-1 mb-0">
                    <i class="ni ni-single-02"></i> Владелец: 
                    <strong>
                        @if (!$doc->user->is_private)
                        {{ $doc->user->last_name }} {{ $doc->user->first_name }}
                        @else
                        Скрыт
                        @endif
                    </strong>
                </span>
                <span class="mt-1 mb-0">
                    <i class="ni ni-building"></i> Университет: <strong>{{ $doc->univer }}</strong>
                </span>
                <span class="mt-1 mb-0">
                    <i class="ni ni-books"></i> Предмет: <strong>{{ $doc->subject }}</strong>
                </span>
                <span class="mt-1 mb-0">
                    <i class="ni ni-app"></i> Преподаватель: <strong>{{ ($doc->prep) ? $doc->prep : '-' }}</strong>
                </span>
                <span class="mt-1 mb-0">
                    <i class="ni ni-single-copy-04"></i> Направление: <strong>{{ ($doc->group) ? $doc->group : '-' }}</strong>
                </span>
                <span class="mt-1 mb-0">
                    <i class="ni ni-hat-3"></i> Курс: <strong>{{ $doc->year }}</strong>
                </span>
                <span class="mt-1 mb-0">
                    <i class="ni ni-ruler-pencil"></i> Семестр: <strong>{{ ($doc->semester === 0) ? 'Осенний' : 'Весенний' }}</strong>
                </span>
                <span class="mt-1 mb-0">
                    <i class="ni ni-calendar-grid-58"></i> Добавлен: <strong>{{ date('d.m.Y', strtotime($doc->created_at)) }}</strong>
                </span>
                <div class="dropdown-divider"></div>
                <span class="mt-1 mb-0">
                    <i class="ni ni-money-coins"></i> Цена: <strong>{{ ($doc->price) ? $doc->price . ' руб' : 'Не указана' }}</strong>
                </span>
                @if (Auth::check() && Auth::user()->id === $doc->user->id)
                <span class="mt-1 mb-0">
                    <i class="ni ni-zoom-split-in"></i> Просмотров: <strong>{{ $doc->views }}</strong>
                </span>
                @else
                    @if (!$doc->user->is_private)
                    <a href="//vk.me/{{ $doc->user->id }}" target="_blank" class="btn btn-primary mt-3" rel="noopener noreferrer">Написать</a>
                    @elseif (Auth::check())
                    <button id="sendNotify" class="btn btn-primary mt-3">Уведомить владельца</button>
                    @else
                    <span class="mt-3"><a href="/login">Авторизуйтесь</a>, чтобы уведомить владельца.</span>
                    @endif
                @endif

                @if ($doc->comment)
                <div class="dropdown-divider"></div>
                <span class="mt-1 mb-0">
                    <i class="ni ni-chat-round"></i> Комментарий владельца:
                    <textarea class="form-control bg-white mt-2" readonly rows="8">{{ $doc->comment }}</textarea>
                </span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        @if ($doc->user->is_private)
        $('#sendNotify').on('click', function() {
            $.ajax({
                type: "POST",
                url: "/notify",
                data: {doc: {{ $doc->id }}},
                dataType: "text",
                success: function (response) {
                    successMessage(response);
                },
                error: function(response) {
                    errorMessage(response.responseText);
                }
            });
        })
        @endif

        @if (Auth::check())
        $('#btnOrder').on('click', function() {
            let btn = $(this);
            $(btn).attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: "/new-order",
                data: {user: {{ Auth::user()->id }}, doc: {{ $doc->id }}},
                dataType: "text",
                success: function (response) {
                    let data = JSON.parse(response);
                    $('#bill').val(data.bill);
                    $('#orderId').val(data.order_id);
                    $('#amount').val(data.amount);
                    $('#successURL').val('http://phocean.ru/success/' + data.order_id + '_' + data.hash);
                    $('#formOrder').submit();
                    $(btn).removeAttr('disabled');
                },
                error: function (data) {
                    $(btn).removeAttr('disabled');
                }
            });
        });
        @endif
    </script>
@endsection