import { createRouter, createWebHistory } from 'vue-router'
import SignIn from '../views/admin/SignIn.vue'
import HomePage from '../views/admin/HomePage.vue'
import QuestionsPage from '../views/admin/QuestionsPage.vue'
import AnswersPage from '../views/admin/AnswersPage.vue'
import SurveyPage from '../views/guest/SurveyPage.vue'
import AnswerPage from '../views/guest/AnswerPage.vue'


const routes = [

  // routes admin
  {

    name: "SignIn",
    component: SignIn,
    path: "/signin"
  },

  {

    name: "HomePage",
    component: HomePage,
    path: "/homepage"
  },

  {
    name: "QuestionsPage",
    component: QuestionsPage,
    path: "/questionspage"
  },

  {
    name: "AnswersPage",
    component: AnswersPage,
    path: "/answerspage"
  },



  // routes guest
  {

    name: "SurveyPage",
    component: SurveyPage,
    path: "/"
  },

  {

    name: "AnswerPage",
    component: AnswerPage,
    path: "/answerpage/:link"
  },




  //   {
  //     // path: '/about',
  //     // name: 'about',
  //     // route level code-splitting
  //     // this generates a separate chunk (About.[hash].js) for this route
  //     // which is lazy-loaded when the route is visited.
  //     component: () => import('../views/AboutView.vue')
  //   }
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes


});

export default router;
