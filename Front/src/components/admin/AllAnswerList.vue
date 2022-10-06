<script>
    import axios from "axios";
    
    const questionsURL = `http://127.0.0.1:8000/api/questions`
    const answersURL = `http://127.0.0.1:8000/api/answers`
    const guestURL = `http://127.0.0.1:8000/api/guest`

    const requestOne = axios.get(questionsURL);
    const requestTwo = axios.get(answersURL);
    const requestThree = axios.get(guestURL);

    export default {
        data(){
            return{
                data  : {
                    answers: [],
                    question_id :[],
                    questions: [],
                    guest : [],
                }, // put datas from db
                dataState:false, // state of data for display
            }
        },
        mounted() { // call when the page is loaded
            axios.all([requestOne, requestTwo, requestThree])
            .then(axios.spread((...responses) => {
                this.data.questions =  responses[0].data.questions;
                this.data.answers =  responses[1].data.answers;
                // this.data.question_id = this.getQuestionId(this.data.answers);
                this.data.guest =  responses[2].data.guests;

                // for (let index = 0; index < this.data.question_id.length; index++) {
                //     const element = this.data.questions[this.data.question_id[index]].question;
                //     // console.log(element);
                // }

                this.dataState = true; // if datas is return from db then it will be true
            
            }))
            .catch((error) => { // catch error
                console.log(error); // display error in console
                this.dataState = false; // if error is return from db then it will be false
            });
        },
        methods: {
            getQuestionId(data ){
                let arr = [];
                for (let index = 0; index < data.length; index++) {
                    arr.push(data[index].question_id);
                }
                return arr;
            },
        }
    }
    </script>
    <template>
    <div>
        <h3> La liste de toutes les reponses du sondage</h3>
        <table v-if="this.dataState" class="table table-bordered table-striped" >
            <thead>
                <tr>
                    <th  scope="col">email</th>
                    <th  scope="col">numero de question</th>
                    <th  scope="col">question</th>
                    <th  scope="col">reponse</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="answer in this.data.answers">
                  
                  
                    <th scope="row">{{this.data.guest[answer.guest_id - 1].email}}</th>
                    <th scope="row">Question N°{{answer.question_id}}</th >
                    <th scope="row">{{this.data.questions[answer.question_id - 1 ].question}}</th >
                    <th scope="row">{{answer.answer}}</th>
                 
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

<style>
    .table{ 
        width:200%;
        height: 100%;
        margin-top:20px;
        margin-left:100px;
        margin-right:50px;
        
    }
    h3{
        width:100%;
        margin-left:100px;
        margin-right:50px;
    }
</style>