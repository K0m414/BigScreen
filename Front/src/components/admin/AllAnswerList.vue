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
                    questions: [],
                    guest : [],
                }, // put datas from db
                dataState:"", // state of data for display
            }
        },
        mounted() { // call when the page is loaded
            axios.all([requestOne, requestTwo, requestThree])
            .then(axios.spread((...responses) => {
            this.data.questions =  responses[0].data.questions;
            this.data.answers =  responses[1].data.answers;
            this.data.guest =  responses[2].data.guests;

            console.log(this.data.guest[0].email);

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
        <table v-if="this.dataState" v-for="(answer, question, index) in this.data.answers">
            <thead>
                <th>
                    <td>{{answer.guest_id}}</td>
                    <td>{{this.data.guest[0].email}}</td>
                    <!-- <td>{{answer.guest_id}}</td> -->
                </th>
            </thead>
            <tbody >
                <tr>
                    <td>numero de question</td>
                    <td>question</td>
                    <td>reponse</td>
                </tr>
                <tr>
                    <!-- <td>{{answer.question_id}}</td>
                    <td>{{answer.question_id}}</td> -->
                    <td>{{answer.answer}}</td>
                    <!-- <td>{{index}}</td> -->

                    <!-- <td>{{this.data.questions[index].question}}</td> -->
                    <!-- <td>{{answer}}</td> -->
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