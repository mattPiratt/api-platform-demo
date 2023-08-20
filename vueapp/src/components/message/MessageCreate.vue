<template>
  <div class="container mx-auto px-4 max-w-2xl mt-4">
    <router-link :to="{ name: 'MessageList' }" class="text-blue-600 hover:text-blue-800">
      &lt; Back to list
    </router-link>

    <h1 class="text-3xl my-4">Create Message</h1>

    <div v-if="isLoading" class="bg-blue-100 rounded py-4 px-4 text-blue-700 text-sm" role="status">
      Loading...
    </div>
    <div v-if="error" class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm" role="alert">
      {{ error }}
    </div>

    <Form :errors="violations" @submit="create" />
  </div>
</template>

<script lang="ts" setup>
import { onBeforeUnmount } from 'vue'
import { useRouter } from 'vue-router'
import { storeToRefs } from 'pinia'
import Form from '@/components/message/MessageForm.vue'
import { useMessageCreateStore } from '@/stores/message/create'
import type { Message } from '@/types/message'

const router = useRouter()

const messageCreateStore = useMessageCreateStore()
const { isLoading, error, violations } = storeToRefs(messageCreateStore)

async function create(item: Message) {
  await messageCreateStore.create(item)

  if (!messageCreateStore.created) return

  router.push({
    name: 'MessageUpdate',
    params: { id: messageCreateStore.created['@id'] }
  })
}

onBeforeUnmount(() => {
  messageCreateStore.$reset()
})
</script>
