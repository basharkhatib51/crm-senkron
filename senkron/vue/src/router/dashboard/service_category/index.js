export default [
  {
    path: 'service_category',
    name: 'service_category',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'service_category.list',
        meta: {
          permission: 'ServiceCategory',
        },
        component: () => import('@/views/dashboard/service_category/list.vue'),
      },
      {
        path: 'create',
        name: 'service_category.create',
        meta: {
          permission: 'ServiceCategory',
        },
        component: () => import('@/views/dashboard/service_category/create.vue'),
      },
      {
        path: 'edit/:service_category',
        name: 'service_category.edit',
        meta: {
          permission: 'ServiceCategory',
        },
        component: () => import('@/views/dashboard/service_category/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'service_category.trashed',
        meta: {
          permission: 'ServiceCategory',
        },
        component: () => import('@/views/dashboard/service_category/trashed.vue'),
      },
    ],
  },
]
