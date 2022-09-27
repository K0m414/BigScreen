<!-- <template> 
    <h1>Le sondage est une page unique présentant l’ensemble des questions au visiteur.</h1>
    
    </template>
    
    
    <script> 
    export default {
        name: "SurveyPage",
        data() {
            return {
               
                question: "",
                question_type: "",
                answer_choice: "",
                survey_id: ""
            }
        }
    }
    </script> -->

    <script setup>
import SurveyForm from "@/components/guest/SurveyForm.vue";
</script>

<template>
  <main>
    <SurveyForm />
  </main>
</template>