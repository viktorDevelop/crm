export default {

    data()
    {
        return {
            login:null,
            password:null
        }
    },

    methods:{
        async send()
        {
          const res = await fetch('/api/users/',{
              method: 'POST',
              body:JSON.stringify({
                  login:this.login,
                  password:this.password
              }),
              headers: {
                  'Content-type': 'application/json; charset=UTF-8',
              },
          });

        }
    }


}