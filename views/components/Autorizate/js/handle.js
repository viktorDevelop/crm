export default {
    data()
    {
        return {
            login:'',
            password:''
        }
    },
    methods:{
      async  send()
        {
            const userData = {
                "login":this.login,
                "password":this.password
            }

            fetch('/autorizate/', {
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