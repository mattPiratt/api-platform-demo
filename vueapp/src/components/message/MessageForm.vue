<template>
  <form class="py-4" @submit.prevent="emitSubmit">
    <div class="mb-2">
      <label for="message_sender" class="text-gray-700 block text-sm font-bold capitalize">
        sender
      </label>
      <input
        id="message_sender"
        v-model="item.sender"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.sender ? 'border-red-500' : 'border-gray-300'
        ]"
        type="text"
        required
        placeholder="A person who sends the message"
      />
      <div v-if="violations?.sender" class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm">
        {{ violations.sender }}
      </div>
    </div>
    <div class="mb-2">
      <label for="message_recipient" class="text-gray-700 block text-sm font-bold capitalize">
        recipient
      </label>
      <input
        id="message_recipient"
        v-model="item.recipient"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.recipient ? 'border-red-500' : 'border-gray-300'
        ]"
        type="text"
        required
        placeholder="A person who receives the message"
      />
      <div
        v-if="violations?.recipient"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.recipient }}
      </div>
    </div>
    <div class="mb-2">
      <label for="message_subject" class="text-gray-700 block text-sm font-bold capitalize">
        subject
      </label>
      <input
        id="message_subject"
        v-model="item.subject"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.subject ? 'border-red-500' : 'border-gray-300'
        ]"
        type="text"
        required
        placeholder="Subject of the message"
      />
      <div
        v-if="violations?.subject"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.subject }}
      </div>
    </div>
    <div class="mb-2">
      <label for="message_content" class="text-gray-700 block text-sm font-bold capitalize">
        content
      </label>
      <input
        id="message_content"
        v-model="item.content"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.content ? 'border-red-500' : 'border-gray-300'
        ]"
        type="text"
        required
        placeholder="Body of the message"
      />
      <div
        v-if="violations?.content"
        class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm"
      >
        {{ violations.content }}
      </div>
    </div>
    <div class="mb-2">
      <label for="message_status" class="text-gray-700 block text-sm font-bold capitalize">
        status
      </label>
      <input
        id="message_status"
        v-model="item.status"
        :class="[
          'mt-1 w-full px-3 py-2 border rounded',
          violations?.status ? 'border-red-500' : 'border-gray-300'
        ]"
        type="number"
        placeholder="Status of the message where 0 means removed and 1 means visible"
      />
      <div v-if="violations?.status" class="bg-red-100 rounded py-4 px-4 my-2 text-red-700 text-sm">
        {{ violations.status }}
      </div>
    </div>

    <button
      type="submit"
      class="px-6 py-2 bg-green-500 text-white font-medium rounded shadow-md hover:bg-green-600"
    >
      Submit
    </button>
  </form>
</template>

<script lang="ts" setup>
import { toRef, ref, type Ref } from 'vue'
import type { Message } from '@/types/message'
import type { SubmissionErrors } from '@/types/error'

const props = defineProps<{
  values?: Message
  errors?: SubmissionErrors
}>()

const emit = defineEmits<{
  (e: 'submit', item: Message): void
}>()

const violations = toRef(props, 'errors')

let item: Ref<Message> = ref({})

if (props.values) {
  item.value = {
    ...props.values
  }
}

function emitSubmit() {
  emit('submit', item.value)
}
</script>
