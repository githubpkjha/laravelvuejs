import { createWebHistory, createRouter } from "vue-router";
import CreateUser from './components/Form.vue';
import Users from './components/List.vue';

const routes = [
  {
    path: "/",
    name: "users",
    component: Users,
  },
  {
    path: "/createuser",
    name: "createuser",
    component: CreateUser,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;