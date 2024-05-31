<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('css/reset.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <title>Гостевая книга</title>
</head>

<body>

<header class="header">
    <h1 class="header__name">Гостевая книга</h1>
    <div class="header__info">
        <p class="header__infoItem">Уважаемые гости!</p>
        <p class="header__infoItem">Вы можете оставить свой отзыв о нашей деятельности.</p>
        <p class="header__infoItem">Нам приятно читать ваши благодарности, а ваша критика помогает нам развиваться!</p>
    </div>
</header>

<main>
    <nav class="nav">
        <ol class="nav__list">
            <li class="nav__listItem__disable"><a class="nav__listItemLink" href="#">Главная</a></li>
            <li class="nav__listItem__disable"><a class="nav__listItemLink" href="#">Услуги</a></li>
            <li class="nav__listItem"><a class="nav__listItemLink" href="{{Route('review')}}">Отзывы</a></li>
            <li class="nav__listItem__disable"><a class="nav__listItemLink" href="#">Контакты</a></li>
        </ol>
    </nav>

    <div class="review">

        @if($errors->any())
            @foreach($errors->all() as $error)
                <p style="color: red">{{$error}}</p>
            @endforeach
        @endif

        @if(session()->has('message'))
            <div style="color: green">
                {{ session()->get('message') }}
            </div>
        @endif

        <h3 class="review__header">Обратная связь</h3>
        <form class="review__form" id="review_form" name="form_review" action="{{Route('create')}}" method="post">
            @csrf
            <div class="review__formWRP">
                <div class="review__formItem">
                    <label class="review__formItemLabel" for="username">Введите ваш Username</label>
                    <input autocomplete="username" class="review__formItemInput" id="username" name="username" type="text" min="3" max="15" required autofocus>
                    <p class="review__formItemText">(латинские символы и цифры без пробела)</p>
                </div>
                <div class="review__formItem">
                    <label class="review__formItemLabel" for="email">Введите ваш email</label>
                    <input autocomplete="email" class="review__formItemInput" id="email" name="email" type="text" max="50" required >
                    <p class="review__formItemText">(Для обратной связи. НИ КАКОГО СПАМ!!!)</p>
                </div>
            </div>
            <div class="review__formItem">
                <label class="review__formItemLabel" for="review">Напишите ваше впечатления о сотрудничестве с нами</label>
                <textarea class="review__formItemTextarea" id="review" name="review" required rows="5"></textarea>
            </div>

            <div class="review__formCaptcha">
                <img class="review__formCaptchaImg" src="{{Route('captcha')}}">
                <div class="review__formCaptchaAction">
                    <label class="review__formCaptchaActionLabel" for="captcha">Введите символы с картинки</label>
                    <p class="review__formCaptchaActionText">Подсказка: заглавные буквы нужно писать прописными (не нажимайте клавиши Shift или Caps Lock)</p>
                    <input class="review__formCaptchaActionInput" id="captcha" name="user_captcha" type="text" placeholder="Введите код с картинки">
                </div>
            </div>
            <div class="review__formButtons">
                <button type="button" id="review_button" class="btn btn-outline-primary">Отправить</button>
            </div>
        </form>
    </div>

    <div class="data">
        <div class="data__headerWRP">
            <h3 class="data__header">отзывы наших клиентов</h3>
            <div class="data__sort">
                <h5 class="data__sortHeader">Сортировать отзывы</h5>
                <form class="data__sortForm" action="{{Route('review')}}" method="get">
                    <div class="data__sortFormItem">
                        <label class="data__sortFormItemLabel" for="username">
                            <input class="data__sortFormItemLabelInput" id="username_more" name="sort" value="{{\App\Enum\SortEnum::UM}}" type="radio">
                            &#9650; по имени
                        </label>
                        <label class="data__sortFormItemLabel" for="username">
                            <input class="data__sortFormItemLabelInput" id="username_less" name="sort" value="{{\App\Enum\SortEnum::UL}}" type="radio">
                            &#9660; по имени
                        </label>
                    </div>
                    <div class="data__sortFormItem">
                        <label class="data__sortFormItemLabel" for="email_more">
                            <input class="data__sortFormItemLabelInput" id="email_more" name="sort" value="{{\App\Enum\SortEnum::EM}}" type="radio">
                            &#9650; по email
                        </label>
                        <label class="data__sortFormItemLabel" for="email_less">
                            <input class="data__sortFormItemLabelInput" id="email_less" name="sort" value="{{\App\Enum\SortEnum::EL}}" type="radio">
                            &#9660; по email
                        </label>
                    </div>
                    <div class="data__sortFormItem">
                        <label class="data__sortFormItemLabel" for="created_more">
                            <input class="data__sortFormItemLabelInput" id="created_more" name="sort" value="{{\App\Enum\SortEnum::DM}}" type="radio">
                            &#9650; по дате
                        </label>
                        <label class="data__sortFormItemLabel" for="created_less">
                            <input class="data__sortFormItemLabelInput" id="created_less" name="sort" value="{{\App\Enum\SortEnum::DL}}" type="radio" checked>
                            &#9660; по дате
                        </label>
                    </div>
                    <div class="data__sortFormItem">
                        <button type="submit" class="btn btn-sm btn-outline-secondary">Сортировать</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="data__reviewsLineHeader">
            <h5 class="data__reviewsLineHeaderName">Username</h5>
            <h5 class="data__reviewsLineHeaderEmail">Email</h5>
            <h5 class="data__reviewsLineHeaderText">Отзыв</h5>
            <h5 class="data__reviewsLineHeaderIp">ip</h5>
            <h5 class="data__reviewsLineHeaderBrowser">Браузер</h5>
            <h5 class="data__reviewsLineHeaderDate">Дата</h5>
        </div>
        @foreach($reviews as $review)
            <div class="data__reviewsLineData">
                <p class="data__reviewsLineDataName">{{$review['username']}}</p>
                <p class="data__reviewsLineDataEmail">{{$review['email']}}</p>
                <p class="data__reviewsLineDataText">{{$review['review']}}</p>
                <p class="data__reviewsLineDataIp">{{$review['ip']}}</p>
                <p class="data__reviewsLineDataBrowser">{{$review['browser']}}</p>
                <p class="data__reviewsLineDataDate">{{date_format($review['created_at'], 'd-m-Y H:i:s')}}</p>
            </div>
        @endforeach
    </div>

    <div class="pagination">
        {{$reviews->links() }}
    </div>

    <script src="{{asset('js/script.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</main>

</body>
</html>
