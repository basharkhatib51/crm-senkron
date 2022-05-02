export default [
  {
    path: 'tag',
    name: 'tag',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'tag.list',
        meta: {
          permission: 'Tag',
        },
        component: () => import('@/views/dashboard/tag/list.vue'),
      },
      {
        path: 'create',
        name: 'tag.create',
        meta: {
          permission: 'Tag',
        },
        component: () => import('@/views/dashboard/tag/create.vue'),
      },
      {
        path: 'edit/:tag',
        name: 'tag.edit',
        meta: {
          permission: 'Tag',
        },
        component: () => import('@/views/dashboard/tag/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'tag.trashed',
        meta: {
          permission: 'Tag',
        },
        component: () => import('@/views/dashboard/tag/trashed.vue'),
      },
    ],
  },
]
