export default [
  {
    path: 'translation',
    name: 'translation',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'translation.list',
        component: () => import('@/views/dashboard/translation/list.vue'),
        meta: {
          permission: 'Translation',
        },
      },
    ],
  },
]
