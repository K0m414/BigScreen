<script>
    import axios from "axios";
    
    const questionsURL = `http://127.0.0.1:8000/api/questions`
    
    export default {
        data(){
            return{
                questionData  : [], // push questions from db
                dataState:"", // state of data for display
            }
        },
        mounted() { // call when the page is loaded
            axios.get(questionsURL) // get datas from db
            .then((response) => { // datas get is in response
                this.questionData = response.data.questions; // put response in questionData
                this.dataState = true; // if datas is return from db then it will be true
            })
            .catch((error) => { // catch error
                console.log(error); // display error in console
                this.dataState = false; // if error is return from db then it will be false
            });
        },
    }
    </script>
    <template>
    <div>
        <h3> La liste des 20 questions du sondage</h3>
        <table v-if="this.dataState" class="table table-bordered table-striped" >
            <thead>
                <tr>
                    <th scope="col" :style="{'color':blue}" >question</th>
                    <th scope="col">reponse possible</th>
                    <th scope="col">type</th>
                </tr>
            </thead >
            <tbody>
                <tr v-for="question in this.questionData">
                    <th scope="row">{{question.question}}</th>
                    <th scope="row">{{question.answer_choice}}</th>
                    <th scope="row">{{question.question_type}}</th>
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
            margin-bottom:20px;
            margin-left:100px;
            margin-right:50px;
        }

        h3{
        width:100%;
        margin-left:100px;
        margin-right:50px;
    }
    </style>