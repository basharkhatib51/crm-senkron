export default [
  {
    path: 'setting',
    name: 'setting',
    component: () => import('@/views/dashboard/setting/setting.vue'),
    meta: {
      permission: 'Setting',
    },
  },
]
