<template>
  <div class="container mx-auto px-4 max-w-2xl mt-4">
    <div class="flex items-center justify-between">
      <router-link :to="{ name: 'MessageList' }" class="text-blue-600 hover:text-blue-800">
        &lt; Back to list
      </router-link>

      <button
        class="px-6 py-2 bg-red-600 text-white text-xs rounded shadow-md hover:bg-red-700"
        @click="deleteItem"
      >
        Delete
      </button>
    </div>

    <h1 class="text-3xl my-4">Edit Message {{ item?.['@id'] }}</h1>

    <div
      v-if="isLoading || deleteLoading"
      class="bg-blue-100 rounded py-4 px-4 text-blue-700 text-sm"
      role="status"
    >
      Loading...
    </div>

    <div
      v-if="error || deleteError"
      class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      role="alert"
    >
      {{ error || deleteError }}
    </div>

    <div
      v-if="created || updated"
      class="bg-green-100 rounded py-4 px-4 my-2 text-green-700 text-sm"
      role="status"
    >
      <template v-if="created">{{ created['@id'] }} created. </template>
      <template v-else-if="updated">{{ updated['@id'] }} updated. </template>
    </div>

    <Form v-if="item" :values="item" :errors="violations" @submit="update" />
  </div>
</template>

<script lang="ts" setup>
import { onBeforeUnmount } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { storeToRefs } from 'pinia'
import { useMessageCreateStore } from '@/stores/message/create'
import { useMessageDeleteStore } from '@/stores/message/delete'
import { useMessageUpdateStore } from '@/stores/message/update'
import type { Message } from '@/types/message'
import Form from '@/components/message/MessageForm.vue'
import { useMercureItem } from '@/composables/mercureItem'

const route = useRoute()
const router = useRouter()

const messageCreateStore = useMessageCreateStore()
const { created } = storeToRefs(messageCreateStore)

const messageDeleteStore = useMessageDeleteStore()
const { error: deleteError, isLoading: deleteLoading } = storeToRefs(messageDeleteStore)

const messageUpdateStore = useMessageUpdateStore()
const { retrieved: item, updated, error, isLoading, violations } = storeToRefs(messageUpdateStore)

useMercureItem({
  store: messageUpdateStore,
  deleteStore: messageDeleteStore,
  redirectRouteName: 'MessageList'
})

await messageUpdateStore.retrieve(decodeURIComponent(route.params.id as string))

function update(item: Message) {
  messageUpdateStore.update(item)
}

async function deleteItem() {
  if (!item?.value) {
    messageUpdateStore.setError('No message found. Please reload')
    return
  }

  if (window.confirm('Are you sure you want to delete this message?')) {
    await messageDeleteStore.deleteItem(item.value)

    if (messageDeleteStore.deleted) {
      router.push({ name: 'MessageList' })
    }
  }
}

onBeforeUnmount(() => {
  messageUpdateStore.$reset()
  messageCreateStore.$reset()
  messageDeleteStore.$reset()
})
</script>
