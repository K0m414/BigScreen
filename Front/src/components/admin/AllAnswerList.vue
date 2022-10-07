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
                result : [],
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
                
                const result = [];
                
                this.data.guest.forEach(element => {

                    const user = {
                        email: element.email,
                        id: element.id,
                        responses: []
                    };

                    for (let index = 0; index < this.data.answers.length; index++) {
                        if(this.data.answers[index].guest_id == user.id){
                            let tab = {};
                            tab.question_id = this.data.answers[index].question_id;
                            tab.question = this.data.questions[this.data.answers[index].question_id - 1].question;
                            tab.reponse = this.data.answers[index].answer;
                            user.responses.push(tab)
                        }                  
                    }

                    result.push(user);
                });
                this.result = result

                console.log(this.result);
                
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
        <table v-if="this.dataState" v-for="guest in this.result" class="table table-bordered table-striped" >
            <caption>{{guest.email}}</caption>
            <thead>
                <tr>
                    <th  scope="col">Numero de question</th>
                    <th  scope="col">Questions</th>
                    <th  scope="col">Réponses</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="response in guest.responses">
                    <td scope="row">Question N°{{response.question_id}}</td>
                    <td scope="row">{{response.question}}</td>
                    <td scope="row">{{response.reponse}}</td>

                 
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