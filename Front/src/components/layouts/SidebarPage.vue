<script>
  import SidebarLink from './SidebarLink.vue'
  import { collapsed, toggleSidebar, sidebarWidth } from './state.js'
  export default {
// logout admin 
    name:"SidebarPage",
    methods: {
          logout() {
             localStorage.clear();
             this.$router.push({nam:"SignIn"})
             window.location.href = 'http://127.0.0.1:5173/signin'

          }
      },

    props: {},
    components: { SidebarLink },
    setup() {
      return { collapsed, toggleSidebar, sidebarWidth }
    }
    
   
  }
  </script>
  
  <template>
    <div class="sidebar" :style="{ width: sidebarWidth }">
      <button v-on:click="logout">Deconnexion</button>
      <h1>
        <span v-if="collapsed">
          <div>V</div>
          <div>S</div>
        </span>
        <span v-else>BigScreen</span>
      </h1>
  
      <SidebarLink to="/homepage" icon="fas fa-home">Accueil</SidebarLink>
      <SidebarLink to="/questionspage" icon="fas fa-columns">Questionnaire</SidebarLink>
      <SidebarLink to="/answerspage" icon="fas fa-chart-bar">Reponses</SidebarLink>
      

  
      <span
        class="collapse-icon"
        :class="{ 'rotate-180': collapsed }"
        @click="toggleSidebar"
      >
        <i class="fas fa-angle-double-left" />
      </span>
    </div>
  </template>
  
  <style>
  :root {
    --sidebar-bg-color: #3772ff;
    --sidebar-item-hover: #789df3;
    --sidebar-item-active: #0c3eb1;
  }
  </style>
  
  <style scoped>
  .sidebar {
    color: white;
    background-color: var(--sidebar-bg-color);
    float: right;
    position: fixed;
    z-index: 2;
    top: 0;
    left: 0;
    bottom: 0;
    padding: 0.5em;
    transition: 0.3s ease;
    display: flex;
    flex-direction: column;
  }
  .sidebar h1 {
    height: 2.5em;
  }
  .collapse-icon {
    position: absolute;
    bottom: 0;
    padding: 0.75em;
    color: rgba(255, 255, 255, 0.7);
    transition: 0.2s linear;
  }
  .rotate-180 {
    transform: rotate(180deg);
    transition: 0.2s linear;
  }

  .sidebar .deconnexion{
      position: left;
  }
  button{
    border: none;
  }
  </style>
  