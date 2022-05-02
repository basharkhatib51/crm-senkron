export default [
  {
    path: 'category',
    name: 'category',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'category.list',
        meta: {
          permission: 'Category',
        },
        component: () => import('@/views/dashboard/category/list.vue'),
      },
      {
        path: 'create',
        name: 'category.create',
        meta: {
          permission: 'Category',
        },
        component: () => import('@/views/dashboard/category/create.vue'),
      },
      {
        path: 'edit/:category',
        name: 'category.edit',
        meta: {
          permission: 'Category',
        },
        component: () => import('@/views/dashboard/category/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'category.trashed',
        meta: {
          permission: 'Category',
        },
        component: () => import('@/views/dashboard/category/trashed.vue'),
      },
    ],
  },
]
