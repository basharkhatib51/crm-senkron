export default [
  {
    path: 'section',
    name: 'section',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'section.list',
        component: () => import('@/views/dashboard/section/list.vue'),
        meta: {
          permission: 'Section',
        },
      },
    ],
  },
]
