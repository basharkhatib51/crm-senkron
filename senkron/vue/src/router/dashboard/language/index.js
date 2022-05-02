export default [
  {
    path: 'language',
    name: 'language',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'language.list',
        meta: {
          permission: 'Language',
        },
        component: () => import('@/views/dashboard/language/list.vue'),
      },
      {
        path: 'create',
        name: 'language.create',
        meta: {
          permission: 'Language',
        },
        component: () => import('@/views/dashboard/language/create.vue'),
      },
      {
        path: 'edit/:language',
        name: 'language.edit',
        meta: {
          permission: 'Language',
        },
        component: () => import('@/views/dashboard/language/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'language.trashed',
        meta: {
          permission: 'Language',
        },
        component: () => import('@/views/dashboard/language/trashed.vue'),
      },
    ],
  },
]
