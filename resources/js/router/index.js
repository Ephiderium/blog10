import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import PostView from "../views/PostView.vue";
import RegisterView from "../views/RegisterView.vue";
import LoginView from "@/views/LoginView.vue";
import LogoutView from "@/views/LogoutView.vue";
import CreateView from "@/views/CreateView.vue";
import UpdateView from "@/views/UpdateView.vue";

const routes = [
    { path: "/", component: HomeView },
    { path: "/about", component: PostView },
    { path: "/register", component: RegisterView },
    { path: "/login", component: LoginView },
    { path: "/logout", component: LogoutView },
    { path: "/post/:id", component: PostView },
    { path: "/post", component: CreateView },
    { path: "/update/:id", component: UpdateView },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
