<script>
import axios from "axios";
import { RouterLink } from "vue-router";

const questionsURL = `http://127.0.0.1:8000/api/questions`
const answersURL = "http://127.0.0.1:8000/api/answers"

let data;

export default {
    data() {
        return {
            questionData: [], // push questions from db
            answerData: [], // push answers from guest
            guestData: "", // guest email
            dataState: "", // state of data for display
        }
    },
    mounted() { // call when the page is loaded
        axios.get(questionsURL) // get datas from db
            .then((response) => { // datas get is in response
                this.questionData = response.data.questions; // put response in questionData
                this.dataState = true; // if datas is return from db then it will be true
            })
            .catch((error) => { // catch error
                console.log(error.response.data); // display error in console
                this.dataState = false; // if error is return from db then it will be false
            });
    },
    methods: {
        // function activate when the form is submit
        submitForm() {
            // answers are put in answerData with v-model in the from 
            this.answerData.forEach((answer, index) => { // use foreach to loop the answers
                data = {
                    'answer': answer,
                    "question_id": index + 1,
                    "email": this.guestData // use v-model in the form to get email
                }
                axios.post(answersURL, data) // send data to db
                    .then((response) => {
                        console.log(response); // action to do if data is send succesfully
                    })
                    .catch((error) => {
                        console.log(error); // display error in console
                    });
            });
        },
    },
}
</script>
<template>
    <div>
        <form v-if="this.dataState" action="">
            <fieldset>
                <legend>Formulaire de sondage</legend>
                <div v-for="(question, index) in this.questionData" :key="index">
                    <div v-if="question.id == 1">
                        <label :for='"question-"+question.id'> {{question.question}} {{question.id}}/20 </label>
                        <input v-model="guestData" :id='"question-"+question.id' />
                    </div>
                    <label v-if="question.id !== 1" :for='"question-"+question.id'>{{question.question}}
                        {{question.id}}/20 </label>
                    <div v-if="question.question_type == 'A'">
                        <select v-model="answerData[index]" :name="question.id">
                             <option v-for="answer in question.answer_choice.split(',')" :value="answer" > {{answer}}
                            </option> 
                        </select>
                    </div>
                    <div v-if="question.question_type == 'B'">
                        <input v-if="question.id !== 1" v-model="answerData[index]" :id='"question-"+question.id'/>
                    </div>
                    <div v-if= "question.question_type == 'C'" v-for="answer in question.answer_choice.split(',')" >
                        <input v-model="answerData[index]" type="radio" :value="answer" :name="'anwer-'+answer" />
                        <label for="answer">{{ answer }}</label>
                    </div>
                </div>
                <button @click.prevent="submitForm"> Envoyer les résultats </button>
            </fieldset>
        </form>
        <div v-if="this.dataState === false">
            <p>
                Oups ! il y une erreur !
                Veuillez rafraichir la page ou réessayer plus tard.
            </p>
        </div>
    </div>
</template>