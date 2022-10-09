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
                result : [], // array where all datas from data  
                dataState:false, // state of data for display
            }
        },
        mounted() { 
            axios.all([requestOne, requestTwo, requestThree])// axios with multiple request
            .then(axios.spread((...responses) => {
                this.data.questions =  responses[0].data.questions;
                this.data.answers =  responses[1].data.answers;
                this.data.guest =  responses[2].data.guests;
                
                this.data.guest.forEach(element => {
                    const user = {
                        email: element.email,
                        id: element.id,
                        responses: []
                    };
                    for (let index = 0; index < this.data.answers.length; index++) {
                        if(this.data.answers[index].guest_id == user.id){
                            let obj = {};
                            obj.question_id = this.data.answers[index].question_id;
                            obj.question = this.data.questions[this.data.answers[index].question_id - 1].question;
                            obj.answer = this.data.answers[index].answer;
                            user.responses.push(obj)
                        }                  
                    }
                    this.result.push(user);
                });
                // this.result = result                
                this.dataState = true; // if datas is return from db then it will be true
            
            }))
            .catch((error) => { // catch error
                console.log(error); // display error in console
                this.dataState = false; // if error is return from db then it will be false
            });
        },

    }
    </script>
    <template>
    <div>
        <h3>La liste de toutes les réponses du sondage</h3>
        <table v-if="this.dataState" v-for="guest in this.result" class="table table-bordered table-striped" :key="guest">
            <thead>
                <tr>
                    <th colspan="100%">{{guest.email}}</th>     
                </tr>
                <tr>
                    <th  scope="col">N° des questions</th>
                    <th  scope="col">Questions</th>
                    <th  scope="col">Réponses</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="response in guest.responses">
                    <td scope="row">Question N°{{response.question_id}}</td>
                    <td scope="row">{{response.question}}</td>
                    <td scope="row">{{response.answer}}</td>
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
        width:150%;
        margin-top:20px;
        margin-left:200px;
        
    }
    h3{
        width:100%;
        margin-left:200px;
    }
</style>