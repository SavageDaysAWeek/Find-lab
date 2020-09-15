@extends('base')
@section('content')
<div class="container my-5">
    <h2 class="text-center">Профиль</h2>

    <div class="container d-flex justify-content-center align-items-center my-4">
        @if (Auth::user()->is_activated)
        <label class="custom-toggle">
            <input type="checkbox" id="privateVal" @if (Auth::user()->is_private) checked @endif>
            <span class="custom-toggle-slider rounded-circle" data-label-off="Нет" data-label-on="Да" id="privateCheck"></span>
        </label>
        <span class="mx-2">Скрыть мое имя</span>
        <button type="button" class="btn btn-primary px-1 py-0" data-container="body" data-toggle="popover" data-color="secondary" data-placement="top" 
            data-content="Ваше имя не будет отображаться в описании документа. Также пользователи не смогут напрямую написать вам сообщение. Вместо этого вам придет уведомление от нашей группы о новой заявке с именем человека и названием документа. Вам необходимо самостоятельно написать ему.">
            ?
        </button>
        @else
        <span><a class="text-primary" href="http://vk.me/-195788628" target="_blank" rel="noopener noreferrer">Активируйте</a> аккаунт, чтобы получить возможность анонимно создавать объявления.</span>
        @endif
    </div>

    <div class="nav-wrapper">
        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0 active" id="doc-tab" data-toggle="tab" href="#tab-doc" role="tab" aria-controls="tab-doc" aria-selected="true">
                    <i class="ni ni-book-bookmark mr-1"></i>
                    Документы
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="orders-tab" data-toggle="tab" href="#tab-orders" role="tab" aria-controls="tab-orders" aria-selected="false">
                    <i class="ni ni-notification-70 mr-1"></i>
                    Запросы
                </a>
            </li>
            @if (false)
            <li class="nav-item">
                <a class="nav-link mb-sm-3 mb-md-0" id="ads-tab" data-toggle="tab" href="#tab-ads" role="tab" aria-controls="tab-ads" aria-selected="false">
                    <i class="ni ni-notification-70 mr-1"></i>
                    Реклама
                </a>
            </li>
            @endif
        </ul>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-doc" role="tabpanel" aria-labelledby="doc-tab">
                    <table class="table align-items-center rounded-lg">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort text-center">Документ</th>
                                <th scope="col" class="sort text-center d-none d-md-table-cell">Стоимость</th>
                                <th scope="col" class="sort text-center d-none d-md-table-cell">Показов</th>
                                <th scope="col" class="sort text-center d-none d-lg-table-cell">Дата добавления</th>
                                <th scope="col" class="sort text-center"></th>
                            </tr>
                        </thead>
            
                        <tbody class="list">
                            @foreach ($my_docs as $doc)
                            @if ($doc->isAd($doc->id))
                            <tr class="bg-success text-white">
                            @else
                            <tr>
                            @endif
                                <th scope="row text-center">
                                    <div class="media align-items-center">
                                        <a href="/doc/{{ $doc->id }}" class="media-body text-dark text-center">
                                            <span class="name mb-0 text-sm">{{ $doc->title }}</span>
                                        </a>
                                    </div>
                                </th>
                                <td class="budget text-center d-none d-md-table-cell">
                                    {{ ($doc->price) ? $doc->price . ' руб' : null }}
                                </td>
                                <td class="budget text-center d-none d-md-table-cell">
                                    {{ $doc->views }}
                                </td>
                                <td class="budget text-center d-none d-lg-table-cell">
                                    {{ $doc->created_at }}
                                </td>
                                <td class="budget text-center">
                                    <button class="p-0 btn btn-dark deleteDoc" data-title="{{ $doc->title }}" data-doc="{{ $doc->id }}">
                                        <i class="ni ni-fat-remove my-0"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="tab-orders" role="tabpanel" aria-labelledby="orders-tab">
                    <table class="table align-items-center rounded-lg">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort text-center">Документ</th>
                                <th scope="col" class="sort text-center d-none d-md-table-cell">Предмет</th>
                                <th scope="col" class="sort text-center d-none d-lg-table-cell">Направление</th>
                                <th scope="col" class="sort text-center d-none d-lg-table-cell">Стоимость (до)</th>
                                <th scope="col" class="sort text-center d-none d-md-table-cell">Показов</th>
                                <th scope="col" class="sort text-center"></th>
                            </tr>
                        </thead>
            
                        <tbody class="list">
                            @foreach ($my_orders as $doc)
                            @if ($doc->isAd($doc->id))
                            <tr class="bg-success text-white">
                            @else
                            <tr>
                            @endif
                                <th scope="row text-center">
                                    <div class="media align-items-center">
                                        <a href="/doc/{{ $doc->id }}" class="media-body text-dark text-center">
                                            <span class="name mb-0 text-sm">{{ $doc->title }}</span>
                                        </a>
                                    </div>
                                </th>
                                <td class="budget text-center d-none d-md-table-cell">
                                    {{ $doc->subject }}
                                </td>
                                <td class="budget text-center d-none d-lg-table-cell">
                                    {{ $doc->group }}
                                </td>
                                <td class="budget text-center d-none d-lg-table-cell">
                                    {{ ($doc->price) ? $doc->price . ' руб' : null }}
                                </td>
                                <td class="budget text-center d-none d-md-table-cell">
                                    {{ $doc->views }}
                                </td>
                                <td class="budget text-center">
                                    <button class="p-0 btn btn-dark deleteDoc" data-title="{{ $doc->title }}" data-doc="{{ $doc->id }}">
                                        <i class="ni ni-fat-remove my-0"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
				
				@if (false)
                <div class="tab-pane fade" id="tab-ads" role="tabpanel" aria-labelledby="ads-tab">
                    <div class="col-lg-6 col-md-8 mx-auto">
                        <p class="mb-0 text-center">Площадка является бесплатной и не имеет какой-либо прибыли.</p>
                        <p class="mb-0 text-center">Вы можете поддержать проект, отправив пожертвование.</p>
                        <p class="mb-0 text-center">Взмен мы поможем вам, разместив выбранный вами документ на первые позиции главной страницы в указанный день.</p>
                        <div class="text-center">
                            <small>Документ предварительно пройдет модерацию.</small>
                        </div>
                        <h3 class="text-center mb-4">Спасибо!</h3>
                        @if (Auth::user()->docs->count() == 0)
                        <h3 class="text-center">Загрузите документы, чтобы начать их рекламировать.</h3>
                        @else
                        <p class="mb-0 text-center">Обратите внимание, что после перевода, если вы желаете рекламировать документ, <strong class="text-warning">ОБЯЗАТЕЛЬНО</strong> необходимо нажать кнопку <strong class="text-primary">"Вернуться на сайт"</strong>.</p>
                        <p class="mb-0 text-center">Таким образом происходит подтверждение.</p>
                        <img src="/pay.png" class="mx-auto mb-5 w-100" alt="Фото оплаты">
                        <h3 class="text-center">Выберите дату</h3>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                </div>
                                <input class="form-control datepicker" required placeholder="День рекламы" id="date" type="text" data-date-start-date="+2d">
                            </div>
                        </div>

                        <h3 class="text-center mt-3">Выберите документ</h3>
                        @foreach ($my_docs as $doc)
                        <div class="custom-control custom-radio mb-0">
                            <input type="radio" id="doc{{ $doc->id }}" @if ($loop->first) checked @endif value="{{ $doc->id }}" name="doc" class="custom-control-input">
                            <label class="custom-control-label" for="doc{{ $doc->id }}">{{ $doc->title }}</label>
                        </div>
                        @endforeach
                        <div class="dropdown-divider"></div>
                        @foreach ($my_orders as $doc)
                        <div class="custom-control custom-radio mb-0">
                            <input type="radio" id="doc{{ $doc->id }}" @if ($loop->first) checked @endif value="{{ $doc->id }}" name="doc" class="custom-control-input">
                            <label class="custom-control-label" for="doc{{ $doc->id }}">{{ $doc->title }}</label>
                        </div>
                        @endforeach

                        <h3 class="text-center mt-3">Вариант оплаты</h3>
                        <form method="POST" id="formAds" class="mt-2" action="https://money.yandex.ru/quickpay/confirm.xml">
                            <input type="hidden" id="bill" name="receiver" value="410011502711398">
                            <input type="hidden" id="adId" name="label" value="$order_id">
                            <input type="hidden" name="quickpay-form" value="donate">
                            <input type="hidden" name="targets" value="Оплата рекламы">
                            <input type="hidden" id="successURL" name="successURL">
                            <input type="hidden" id="amount" name="sum" value="{{ $doc->price }}" data-type="number">
                            <div class="custom-control custom-radio my-1">
                                <input type="radio" id="paymentType1" required name="paymentType" value="PC" class="custom-control-input" checked>
                                <label class="custom-control-label" for="paymentType1">Яндекс.Деньгами</label>
                            </div>
                            <div class="custom-control custom-radio my-1">
                                <input type="radio" id="paymentType2" required name="paymentType" value="AC" class="custom-control-input">
                                <label class="custom-control-label" for="paymentType2">Банковской картой</label>
                            </div>
                        </form>
                        <div class="text-center">
                            <button class="btn btn-primary mt-2" id="newAds">
                                <i class="ni ni-credit-card mr-1"></i>Перевести
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmation" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-danger">
                
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Удаление документа</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="ni ni-bell-55 ni-3x"></i>
                        <h4 id="deleteTitle" class="heading mt-4"></h4>
                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" id="btnConfirmDelete" class="btn btn-white">Удалить</button>
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        @if (Auth::user()->is_activated)
        $('#privateCheck').on('click', function() {
            let val = !$('#privateVal').prop('checked');

            $.ajax({
                type: "POST",
                url: "/set-private",
                data: {private: val},
                dataType: "text"
            });
        });
        @endif

    	@if (false)
        $('#newAds').on('click', function() {
            let btn = $(this);
            $(btn).attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: "/new-ad",
                data: {doc_id: $('[name="doc"]:checked').val(), date: $('#date').val()},
                dataType: "text",
                success: function (response) {
                    let data = JSON.parse(response);
                    $('#bill').val(data.bill);
                    $('#adId').val(data.ad_id);
                    $('#amount').val(data.amount);
                    $('#successURL').val('http://phocean.ru/ad/' + data.ad_id + '_' + data.hash);
                    $('#formAds').submit();
                    $(btn).removeAttr('disabled');
                },
                error: function (data) {
                    $(btn).removeAttr('disabled');
                }
            });
        });
        @endif

        $('.deleteDoc').bind('click', function() {
            $('#deleteTitle').text('Вы действительно желаете удалить документ "' + $(this).data('title') + '"?');
            $('#btnConfirmDelete').data('doc', $(this).data('doc'));
            $('#deleteConfirmation').modal('show');
        });

        $('#btnConfirmDelete').on('click', function() {
            let btn = $(this);
            $(btn).attr('disabled', 'disabled');
            $.ajax({
                type: "POST",
                url: "/delete-doc",
                data: {doc_id: $(this).data('doc')},
                dataType: "text",
                success: function (response) {
                    $(btn).removeAttr('disabled');
                    document.location.reload();
                },
                error: function () {
                    $(btn).removeAttr('disabled');
                }
            });
        })
    </script>
@endsection