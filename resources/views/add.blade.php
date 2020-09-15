@extends('base')
@section('content')
    <div class="container my-5">
        <form method="POST" action="/add" enctype="multipart/form-data" class="col-lg-6 col-md-8 mx-auto">
            <p class="lead text-center mb-5">
                @if ($type === 0)
                Здесь вы можете добавить имеющуюсю работу. Другие пользователи смогут найти ее и связаться с вами.
                @else
                Здесь вы можете указать нужную вам работу. Если у других пользователей она имеется, они смогут связаться с вами.
                @endif
            </p>

            @csrf
            <input class="form-control" required name="type" type="hidden" value="{{ $type }}">
            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Название работы</label>
                <input class="form-control" required name="title" type="text" placeholder="Тема работы">
            </div>

            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Предмет</label>
                <input class="form-control" required name="subject" type="text" placeholder="Полностью или сокращенно">
                <small>Например, МПИС или Физика</small>
            </div>

            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Учебное заведение</label>
                <input class="form-control" required name="univer" type="text" placeholder="Желательно сокращенно">
                <small>Например, РГРТУ</small>
            </div>

            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Преподаватель</label>
                <input class="form-control" name="prep" type="text" placeholder="Имя преподавателя">
                <small>(Не обязательно)</small>
            </div>

            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Код направления</label>
                <input class="form-control" required name="group" type="text" placeholder="Номер вашей группы БЕЗ года поступления">
                <small>(Не обязательно). Для группы с номером 123 - <strong>23</strong></small>
            </div>

            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Курс</label>
                <input class="form-control" required name="year" type="number" min="1" max="5" placeholder="Номер курса">
            </div>

            <div class="custom-control custom-radio my-3">
                <input type="radio" id="semester1" required name="semester" value="0" class="custom-control-input" checked>
                <label class="custom-control-label" for="semester1">Осенний семестр</label>
            </div>
            <div class="custom-control custom-radio mb-3">
                <input type="radio" id="semester2" required name="semester" value="1" class="custom-control-input">
                <label class="custom-control-label" for="semester2">Весенний семестр</label>
            </div>

            <div class="form-group">
                <label for="example-text-input" class="form-control-label">Стоимость</label>
                <input class="form-control" name="price" type="number" placeholder="В рублях">
                <small>(Не обязательно). @if ($type === 1) Сумма, которую вы можете предложить @endif</small>
            </div>

            <div class="form-group">
                <label class="form-control-label" for="comment">Дополнительное описание</label>
                <textarea class="form-control" placeholder="Опишите подробности" name="comment" id="comment" rows="3"></textarea>
                <small>(Не обязательно)</small>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Добавить</button>
            </div>
        </form>
    </div>
@endsection