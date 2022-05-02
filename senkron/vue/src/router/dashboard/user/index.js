export default [
  {
    path: 'user',
    name: 'user',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'user.list',
        meta: {
          permission: 'User',
        },
        component: () => import('@/views/dashboard/user/list.vue'),
      },
      {
        path: 'create',
        name: 'user.create',
        meta: {
          permission: 'User',
        },
        component: () => import('@/views/dashboard/user/create.vue'),
      },
      {
        path: 'edit',
        name: 'user.edit',
        meta: {
          permission: 'User',
        },
        component: () => import('@/views/dashboard/user/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'user.trashed',
        meta: {
          permission: 'User',
        },
        component: () => import('@/views/dashboard/user/trashed.vue'),
      },
    ],
  },
]
