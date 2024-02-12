import { createRouter, createWebHistory } from 'vue-router';
import dashboard from '@/pages/dashboard.vue';
import partners from '@/pages/partners.vue';
import partner from '@/pages/partner.vue';
import projects from '@/pages/projects.vue';
import project from '@/pages/project.vue';

const router = createRouter({
  history: createWebHistory('/aibou'),
  routes: [
    {
      path: '/',
      name: 'dashboard',
      component: dashboard,
    },
    {
      path: '/partners',
      name: 'partners',
      component: partners,
    },
    {
      path: '/partners/:id',
      name: 'partner',
      component: partner,
      props: true,
    },
    {
      path: '/projects',
      name: 'projects',
      component: projects,
    },
    {
      path: '/projects/:id',
      name: 'project',
      component: project,
      props: true,
    },
  ],
});

export default router;
