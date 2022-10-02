<template> 

    <div :style="{ 'margin-left': sidebarWidth }">
      <h1>Cette page affiche les statistiques du sondage.</h1>
  
      <router-view />
      <SidebarPage />
    </div>
  
</template>
<script> 
import { RouterLink, RouterView } from 'vue-router'
import SidebarPage from './SidebarPage.vue'
import { sidebarWidth } from './state'
  export default {
    name: "homepage",
    data() {
        return {
            answer: "",
            question_id: "",
            guest_id: ""
        }
    },
    components: { SidebarPage },
    setup() {
      return { sidebarWidth }
    },

  }
</script>
  
<style>
      #app {
        font-family: Avenir, Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
      }
      #nav {
        padding: 30px;
      }
      #nav a {
        font-weight: bold;
        color: #2c3e50;
      }
      #nav a.router-link-exact-active {
        color: #42b983;
      }
</style>
  
    

