export default [
  {
    path: 'slider',
    name: 'slider',
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'slider.list',
        meta: {
          permission: 'Slider',
        },
        component: () => import('@/views/dashboard/slider/list.vue'),
      },
      {
        path: 'create',
        name: 'slider.create',
        meta: {
          permission: 'Slider',
        },
        component: () => import('@/views/dashboard/slider/create.vue'),
      },
      {
        path: 'edit/:slider',
        name: 'slider.edit',
        meta: {
          permission: 'Slider',
        },
        component: () => import('@/views/dashboard/slider/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'slider.trashed',
        meta: {
          permission: 'Slider',
        },
        component: () => import('@/views/dashboard/slider/trashed.vue'),
      },
    ],
  },
]
