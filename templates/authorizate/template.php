<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>авторизация</title>
</head>
<body>

<form id="form_auth">
    <input type="text" name="login" placeholder="login">
    <input type="password" name="password" placeholder="password">
    <input type="submit" value="отправить" name="send">
</form>

<script>
    window.addEventListener('load',function (){

        const form = document.getElementById('form_auth');

        document.getElementById('form_auth');
        form.addEventListener('submit',async (e)=>{
            e.preventDefault();
            const formData = new FormData(form);
            const data = {
                login:formData.get('login'),
                password:formData.get('password')
            }

            console.log(data)
        })

    });


</script>
</body>
</html>