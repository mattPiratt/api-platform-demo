export default [
  {
    name: 'MessageList',
    path: '/messages/',
    component: () => import('@/views/message/ViewList.vue')
  },
  {
    name: 'MessageCreate',
    path: '/messages/create',
    component: () => import('@/views/message/ViewCreate.vue')
  },
  {
    name: 'MessageUpdate',
    path: '/messages/edit/:id',
    component: () => import('@/views/message/ViewUpdate.vue')
  },
  {
    name: 'MessageShow',
    path: '/messages/show/:id',
    component: () => import('@/views/message/ViewShow.vue')
  }
]
