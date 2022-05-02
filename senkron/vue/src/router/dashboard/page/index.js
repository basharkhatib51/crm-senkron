export default [
  {
    path: 'page',
    name: 'page',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'page.list',
        meta: {
          permission: 'Page',
        },
        component: () => import('@/views/dashboard/page/list.vue'),
      },
      {
        path: 'create',
        name: 'page.create',
        meta: {
          permission: 'Page',
        },
        component: () => import('@/views/dashboard/page/create.vue'),
      },
      {
        path: 'edit/:page',
        name: 'page.edit',
        meta: {
          permission: 'Page',
        },
        component: () => import('@/views/dashboard/page/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'page.trashed',
        meta: {
          permission: 'Page',
        },
        component: () => import('@/views/dashboard/page/trashed.vue'),
      },
    ],
  },
]
