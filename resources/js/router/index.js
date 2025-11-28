import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import PostView from "../views/PostView.vue";
import RegisterView from "../views/RegisterView.vue";

const routes = [
    { path: "/", component: HomeView },
    { path: "/about", component: PostView },
    { path: "/register", component: RegisterView },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
