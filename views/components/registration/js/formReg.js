export default {
    data()
    {
        return {
            login:'',
            name:'',
            password:'',
            role:'public'
        }
    },
    methods:{
       async sendRegistry()
        {
            console.log(this.login)
            const userData = {
                "login":this.login,
                "name":this.name,
                "password":this.password,
                "role":this.role

            }

            fetch('/registation/', {
                method: 'POST',
                body: JSON.stringify(userData),
                headers: {
                    'Content-type': 'application/json; charset=UTF-8',
                },
            })
                .then((response) => response.json())
                .then((json) => console.log(json));
        }
    }
}