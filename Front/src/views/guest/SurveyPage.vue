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
  import Header from "@/components/layouts/Header.vue";
    import Footer from "@/components/layouts/Footer.vue";
</script>

<template>
  <main>        
    <Header />
    <SurveyForm />        
    <Footer />
  </main>
</template>