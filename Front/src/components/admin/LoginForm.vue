<template>
        <div class="register">
            <h1>BigScreen</h1><br>
            <input type="email" v-model="email" placeholder="adresse e-mail">
            <input type="password" v-model="password" placeholder="Mot de passe">
            <button v-on:click="signIn">Connexion</button>
        </div>
  
    
</template>

<script>
import axios from 'axios'
export default {
    name: "SignIn",
    data() {
        return {
           
            email: "",
            password: ""
        }
    },

    methods:{
       async  signIn(){
            console.log("signIn",this.email,this.password)

            let result = await axios.post("http://127.0.0.1:8000/api/auth/login",{
                email:this.email,
                password:this.password,
                
            });
            console.warn(result);

            if(result.status==201) {
              localStorage.setItem("user-token",result.data.token)
            //   redirection de la page home apres connexion
            window.location.href = 'http://127.0.0.1:5173"/questionspage'
            //   this.$router.push({name:'ViewPair'})
            }
        }
    }
}


</script>

<style scoped>
    h1{
    font-family: monospace;
    margin-right: auto;
    margin-left: auto;
    }
.register input {
    width: 300px;
    height: 40px;
    padding-left: 20px;
    display: block;
    margin-bottom: 30px;
    margin-right: auto;
    margin-left: auto;
    border: 1px solid #3772ff;
}

.register button {
    width: 300px;
    height: 40px;
    border: 1px solid #3772ff;
    background: #3772ff;
    color: #ffff;
    cursor: pointer;


}
</style>