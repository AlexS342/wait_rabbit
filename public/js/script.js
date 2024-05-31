let reviewButton = document.getElementById('review_button');
reviewButton.addEventListener('click', controlForm);

function controlForm (event){
    event.preventDefault()
    let reviewForm = document.getElementById('review_form');
    let username = reviewForm['username']['value'];
    let email = reviewForm['email']['value'];
    let review = reviewForm['review']['value'];

    if(!/^[A-Za-z0-9]{3,15}$/.test(username)){
        alert('Имя пользователя содержит недопустимые символы');
        return;
    }

    if(!/^[\w-_\.]+@[\w-]+\.[a-z]{2,4}$/.test(email)){
        alert('email не соответствует ожидаемому формату');
        return;
    }

    if(/[<]{1}[\S]+[>]{1}/.test(review)){
        alert('В тексте не допускается использование html тегов');
        return;
    }
    reviewForm.submit();
}
