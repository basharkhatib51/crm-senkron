import User from './user'
import Role from './role'
import Page from './page'
import Tag from './tag'
import Slider from './slider'
import Category from './category'
import Section from './section'
import Language from './language'
import Menu from './menu'
import Product from './product'
import Translation from './translation'
import Setting from './setting'
import ServiceCategory from './service_category'

export default [
  {
    path: '/',
    component: { render: h => h('router-view') },
    meta: {
      authRequired: 'true',
      thisAuthRequired: 'true',
    },
    children: [
      ...Section,
      ...Role,
      ...Page,
      ...User,
      ...Tag,
      ...Slider,
      ...Product,
      ...Category,
      ...Menu,
      ...Language,
      ...Translation,
      ...Setting,
      ...ServiceCategory,
      {
        path: 'dashboard',
        name: 'dashboard',
        component: () => import('@/views/dashboard/dashboard.vue'),
        meta: {
          permission: 'Statistic',
        },
      },
    ],
  },

]
