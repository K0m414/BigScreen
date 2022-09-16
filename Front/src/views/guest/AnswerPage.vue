<template> 
    <h1>C’est une page unique qui affiche les 20 questions et les réponses de l’utilisateur.</h1>
    
    </template>
    
    
    <script> 
    export default {
        name: "AnswerPage",
        data() {
            return {
               
                answer: "",
                question_id: "",
                guest_id: ""
            }
        }
    }
    </script>