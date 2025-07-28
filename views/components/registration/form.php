<div id="formReg">
    <form @submit.prevent="sendRegistry">
        <input type="text" v-model="login"  >
        <input type="text" v-model="name" >
        <input type="password" v-model="password" >
        <input type="submit" value="send"  >
    </form>
</div>

<script type="module" src="/views/components/registration/js/main.js"></script>