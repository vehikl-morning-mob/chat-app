import {RouteConfig} from "vue-router/types/router";
import VueRouter from "vue-router";
import LandingPage from "./views/LandingPage.vue";
import Vue from "vue";

Vue.use(VueRouter);

const routes: RouteConfig[] = [
    {
        component: LandingPage,
        path: "/"
    }
];

const router: VueRouter = new VueRouter({
    mode: 'history',
    routes
});

export default router;
