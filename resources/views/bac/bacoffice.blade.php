<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <title>BAC Office Page</title>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/dist/css/adminlte.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
</head>

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
    }

    main {
        background-color: lightblue;

        display: flex;
        justify-content: center;
        width: 100%;
        height: 100%;
        padding: 1rem 2rem;
    }

    main div {
        width: 100%;
        display: flex;
        justify-content: space-around;
        align-items: center;
        gap: 2rem;
    }

    .goods,
    .infra {
        box-shadow: 0px 0px 10px 2px #555;
        background-color: #fff;
        border-radius: 1rem;
        display: flex;
        flex-direction: column;
        padding: 2rem 1rem;
    }

    .goods span,
    .infra span {
        font-size: 2rem;
        letter-spacing: 0.5px;
        font-weight: bold;

    }


    button {
        border: 1px solid #000;
        width: 20rem;
        height: 20rem;
        cursor: pointer;
    }
</style>

<body>

    <main>
        <div class="button-container">
            <div class="goods">
                <button type="button" onclick="location.href='{{ url('bacgoods') }}'" class="btn btn-white btn-lg btn fa fa-truck fa-8x"></button>
                <span>Goods & Services</span>
            </div>
            <div class="infra">
                <button type="button" onclick="location.href='{{ url('bacinfra') }}'" class="btn btn-white btn-lg fa fa-building fa-8x"></button>
                <span>Infrastructure</span>
            </div>
        </div>
    </main>

</body>

</html>