@extends('base')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            <div class="card bg-secondary border-primary mb-0">
                <div class="card-body px-lg-5 py-lg-5">
                    <div class="text-center mb-2">
                        <strong>Авторизация</strong>
                    </div>
                    <div class="text-center text-muted mb-3">
                        <small class="mb-2 text-center">После авторизации сайту будут доступны ваши имя, фамилия и фотография.</small>
                    </div>
                    <div id="vk_auth" class="mx-auto"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    VK.init({apiId: 7459503});
    VK.Widgets.Auth("vk_auth", {"authUrl": "/auth"});
</script>
@endsection