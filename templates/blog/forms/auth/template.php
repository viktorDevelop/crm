<div id="authForm" >
    <form @submit.prevent = "send()">
        <input type="text" name="login" v-model="login" >
        <input type="password" name="password" v-model="password" >
        <input type="submit"  value="войти" >
    </form>
</div>
<script type="module" src="/templates/blog/forms/auth/js/auth.js"></script>