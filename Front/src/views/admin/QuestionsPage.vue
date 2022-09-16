<template> 
    <h1>Cette page affiche les 20 questions sous forme de tableau de données</h1>
    
    </template>
    
    
    <script> 
    export default {
        name: "QuestionsPage",
        data() {
            return {
               
                question: "",
                question_type: "",
                answer_choice: "",
                survey_id: ""
            }
        }
    }
    </script>