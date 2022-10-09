<script>
    import axios from "axios";
    import Vuelidate from 'vuelidate'
    
    
    const questionsURL = "http://127.0.0.1:8000/api/questions";
    const answersURL = "http://127.0.0.1:8000/api/answers";
    
    let data;
    
    export default {
        data(){
            return{
                questionData  : [], // push questions from db
                answerData : [], // push answers from guest
                guestData:"", // guest email
                dataState:"", // state of data for display
                link:"",
                formErrors:[],
                message : ''
            }
        },
        mounted() { // call when the page is loaded
            this.getQuestions(questionsURL)
        },
        methods: {
            getQuestions(url){
                axios.get(url) // get datas from db
                    .then((response) => { // datas get is in response
                        this.questionData = response.data.questions; // put response in questionData
                        this.dataState = true; // if datas is return from db then it will be true
                        console.log(this.answerData)
                    })
                    .catch((error) => { // catch error
                        console.log(error.response.data); // display error in console
                        this.dataState = false; // if error is return from db then it will be false
                    });
            },
            // function activate when the form is submit
            onSubmit(){
                this.formErrors = [];
                console.log(this.answerData.flat().length);
                if(this.answerData.flat().length === 19 && this.guestData !==''){
                    this.postForm()
                }
                else{
                    if(this.answerData.length == 0 && this.guestData ==='' ){
                        this.formErrors.push('Tous les champs du formulaire sont vides')
                    }
                    else{
                        this.formErrors.push('Veuillez compléter ces champs :')
                        if(this.guestData ==='' ){
                            this.formErrors.push(this.questionData[0].question)
                        }
                        if(this.answerData.length >= 0){
                            for (let index = 1; index < this.questionData.length; index++) {
                                if(this.answerData[index] === undefined){
                                    this.formErrors.push(this.questionData[index].question)
                                }
                            }
                        }
                    }
                }
            },
            postForm() {
                // answers are put in answerData with v-model in the from 
                this.answerData.forEach((answer, index) => { // use foreach to loop the answers
                        data = {
                            'answer': answer, 
                            "question_id":index+1,
                            "email":this.guestData // use v-model in the form to get email
                        }
                    axios.post(answersURL, data ) // send data to db
                    .then((response) => {
                        this.link = 'http://127.0.0.1:5173/answerPage/'+response.data.link;
                        this.message = response.data.message
                        
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
        <form v-if="this.dataState" @submit.prevent="onSubmit" class="mt-6 ">
            <fieldset class="card" >
                <legend class="card-header">Formulaire de sondage</legend>
                <p> Merci de répondre a toutes les questions et valider le formulaire en bas de la page</p>

                <div v-for="(question, index) in this.questionData" :key="index">
                    <label :for='"question-"+question.id'  class="form-label mt-3 mb-3">{{question.question}} {{question.id}}/20</label><br>
                    <div v-if="question.question_type == 'A'">
                        <select v-model="answerData[index]" :name='"question-"+question.id' class="form-select" aria-label="Default select example">
                            <option  v-for="answer in question.answer_choice.split(',')" :value="answer" :key="answer" >
                                {{ answer }}
                            </option>
                        </select>
                    </div> 
                    <div v-if="question.question_type == 'B'">
                        <input v-if="question.id == 1" v-model="guestData" :id='"question-"+question.id' :name='"question-"+question.id' class="form-control" />
                        <input v-if="(question.id !== 1 && question.id !== 20)" v-model="answerData[index]" :id='"question-"+question.id' :name='"question-"+question.id' class="form-control"/>
                        <textarea v-if="question.id == 20"  :name='"question-"+question.id' v-model="answerData[index]" :id='"question-"+question.id' class="form-control"/>
                        <p v-if="this.answerData[index]  && question.id == 20">{{this.answerData[19].length}}/500</p>
                    </div>
                    <div v-if="question.question_type == 'C'" v-for="answer in question.answer_choice.split(',')" class="form-check form-check-inline" :key="answer" >
                        <input v-model="answerData[index]" type="radio" :value="answer" :name="'question-'+question.id+'-anwer-'+answer"  class="form-check-input"/>
                        <label :for="'question-'+question.id+'-anwer-'+answer" class="form-check-label">{{ answer }}</label>
                    </div>
                </div>
                <div>
                    <p v-if="this.link !== ''"> {{this.message}}<a :href="this.link">{{this.link}}</a></p>
                    <p v-if="this.formErrors !== ''" v-for="error in this.formErrors">{{error}}</p>
                    <button type="submit" class="btn btn-primary ">Envoyer vos réponses</button>
                </div>
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

    <style> 
     form {
        width: 120%;
        /* margin-left: 150px;
        margin-inline: 50px; */
        /* margin: auto; */
    }

    button {
        margin-top: 20px;
        margin-bottom: 10px;
        margin-left: 10px;
    }
    </style>