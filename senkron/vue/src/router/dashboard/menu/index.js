export default [
  {
    path: 'menu',
    name: 'menu',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'menu.list',
        meta: {
          permission: 'Menu',
        },
        component: () => import('@/views/dashboard/menu/list.vue'),
      },
      {
        path: 'create',
        name: 'menu.create',
        meta: {
          permission: 'Menu',
        },
        component: () => import('@/views/dashboard/menu/create.vue'),
      },
      {
        path: 'edit/:menu',
        name: 'menu.edit',
        meta: {
          permission: 'Menu',
        },
        component: () => import('@/views/dashboard/menu/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'menu.trashed',
        meta: {
          permission: 'Menu',
        },
        component: () => import('@/views/dashboard/menu/trashed.vue'),
      },
    ],
  },
]
