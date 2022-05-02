export default [
  {
    path: 'product',
    name: 'product',
    meta: {
      permission: 'Product',
    },
    component: { render: h => h('router-view') },
    children: [
      {
        path: 'list',
        name: 'product.list',
        meta: {
          permission: 'Product',
        },
        component: () => import('@/views/dashboard/product/list.vue'),
      },
      {
        path: 'create',
        name: 'product.create',
        meta: {
          permission: 'Product',
        },
        component: () => import('@/views/dashboard/product/create.vue'),
      },
      {
        path: 'edit/:product',
        name: 'product.edit',
        meta: {
          permission: 'Product',
        },
        component: () => import('@/views/dashboard/product/edit.vue'),
      },
      {
        path: 'trashed',
        name: 'product.trashed',
        meta: {
          permission: 'Product',
        },
        component: () => import('@/views/dashboard/product/trashed.vue'),
      },
    ],
  },
]
