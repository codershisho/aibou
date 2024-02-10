import { createRouter, createWebHistory } from 'vue-router';
import dashboard from '@/pages/dashboard.vue';
import partners from '@/pages/partners.vue';
import partner from '@/pages/partner.vue';

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
  ],
});

export default router;
