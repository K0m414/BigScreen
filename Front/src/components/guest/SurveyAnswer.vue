<script>
    import axios from "axios";
    import { RouterLink } from "vue-router";
    
    const linkURL =window.location.href;
    const questionsURL = `http://127.0.0.1:8000/api/questions`
    const answerURL = "http://127.0.0.1:8000/api/guest/"
    let link = linkURL.replace('http://127.0.0.1:5173/answerPage/','');
    export default {
        data(){
            return{
                data  : {
                    email : '',
                    answer : '',
                    question_id : '',
                    question : ''
                }, // push all datas from db
                dataState:"", // state of data for display
            }
        },
        mounted() { // call when the page is loaded
            this.getQuestions(questionsURL);
            this.getAnswers(answerURL+link);
            
        },
        methods: {
            getQuestions(URL){
                axios.get(URL)
                .then((response) => { 
                    this.data.question = response.data.questions;
                })
                .catch(errors => {
                    console.log(errors);
                    this.dataState = false; 
                })
            },
            getAnswers(URL){
                axios.get(URL) // get datas from db
                .then((response) => { // datas get is in response
                this.data.answer = response.data.data.answer;
                this.data.question_id = response.data.data.question;
                this.data.email = response.data.data.guest_email;
                this.dataState = true; // if datas is return from db then it will be true
            })
            .catch((error) => { // catch error
                console.log(error); // display error in console
                this.dataState = false; // if error is return from db then it will be false
            });
            }
        },
    }
    </script>
    <template>
    <div>
        <table v-if="this.dataState" class="table table-bordered table-striped" >
            <thead>
                <tr>
                    <th scope="col">N° des questions</th>
                    <th scope="col">Questions</th>
                    <th scope="col">Réponses</th>
                </tr>
            </thead >
            <tbody>
                <tr>
                    <td scope="row">Question n° 1/20 </td>
                    <td scope="row">{{ this.data.question[0].question }}</td>
                    <td scope="row">{{this.data.email}}</td>
                </tr>
                <tr v-if="this.dataState" v-for="(answer, index) in this.data.answer" :key="index">
                    <td scope="row">Question n° {{ this.data.question_id[index] }}/20</td>
                    <td scope="row">{{ this.data.question[index+1].question }}</td>
                    <td scope="row">{{ answer }}</td>
                </tr>
            </tbody>    
        </table>
        <div v-if="this.dataState === false">
            <p>
                Oups ! il y une erreur !
                Veuillez rafraichir la page ou réessayer plus tard.
            </p>
        </div>
        
    </div>
    </template>