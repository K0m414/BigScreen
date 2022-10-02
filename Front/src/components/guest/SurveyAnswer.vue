<script>
    import axios from "axios";
    import { RouterLink } from "vue-router";
    
    const questionsURL = `http://127.0.0.1:8000/api/questions`
    const answerURL = "http://127.0.0.1:8000/api/guest/84e9f377-07f3-461a-a594-2cdb4c920785"
    let linkURL =window.location.href;

    export default {
        data(){
            return{
                data  : {
                    answer : '',
                    question_id : '',
                    question : ''
                }, // push all datas from db
                dataState:"", // state of data for display
            }
        },
        mounted() { // call when the page is loaded
            axios.get(answerURL) // get datas from db
            .then((response) => { // datas get is in response
                console.log(response);
                this.data.answer = response.data.data.answer;
                this.data.question_id = response.data.data.question;
                this.dataState = true; // if datas is return from db then it will be true

                axios.get(questionsURL)
                .then((response) => { 
                    this.data.question = response.data.questions;
                    console.log(this.data.question[0].question);
                })
                .catch(errors => {
                    console.log(errors);
                })
            })
            .catch((error) => { // catch error
                console.log(error); // display error in console
                this.dataState = false; // if error is return from db then it will be false
            });
        },
        methods: {
        },
    }
    </script>
    <template>
    <div>
        <!-- <ul>
            <li>question n° 1/20 {{ this.data.question[0].question }} </li>
            <li>get user email</li>
        </ul> -->
        <ul v-if="this.dataState" v-for="(answer, index) in this.data.answer">
            <li>question n° {{ this.data.question_id[index] }}/20 {{ this.data.question[index+1].question }} </li>
            <li>answer: {{ answer }}</li>            
        </ul>
        <div v-if="this.dataState === false">
            <p>
                Oups ! il y une erreur !
                Veuillez rafraichir la page ou réessayer plus tard.
            </p>
        </div>
        
    </div>
    </template>