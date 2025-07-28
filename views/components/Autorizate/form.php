<div id="formAuth">
    <h1>Авторизация</h1>
    <form @submit.prevent="send" >
        <input type="text" v-model="login" >
        <input type="text" v-model="password" >
        <input type="submit" value="send">
    </form>
</div>

<script type="module" src="/views/components/Autorizate/js/main.js"></script>