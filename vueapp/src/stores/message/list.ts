import { defineStore } from 'pinia'
import api from '@/utils/api'
import { extractHubURL } from '@/utils/mercure'
import type { Message } from '@/types/message'
import type { View } from '@/types/view'
import type { ListState } from '@/types/stores'
import type { PagedCollection } from '@/types/collection'

interface State extends ListState<Message> {}

export const useMessageListStore = defineStore('messageList', {
  state: (): State => ({
    items: [],
    isLoading: false,
    error: undefined,
    hubUrl: undefined,
    view: undefined
  }),

  actions: {
    async getItems(page?: string) {
      this.setError('')
      this.toggleLoading()

      try {
        const path = page ? `messages?page=${page}` : 'messages'
        const response = await api(path)
        const data: PagedCollection<Message> = await response.json()
        const hubUrl = extractHubURL(response)

        this.toggleLoading()

        this.setItems(data['hydra:member'])
        this.setView(data['hydra:view'])

        if (hubUrl) {
          this.setHubUrl(hubUrl)
        }
      } catch (error) {
        this.toggleLoading()

        if (error instanceof Error) {
          this.setError(error.message)
        }
      }
    },

    toggleLoading() {
      this.isLoading = !this.isLoading
    },

    setItems(items: Message[]) {
      this.items = items
    },

    setView(view: View) {
      this.view = view
    },

    setHubUrl(hubUrl: URL) {
      this.hubUrl = hubUrl
    },

    setError(error: string) {
      this.error = error
    },

    updateItem(updatedItem: Message) {
      const item: Message | undefined = this.items.find((i) => i['@id'] === updatedItem['@id'])

      if (!item) return

      Object.assign(item, updatedItem)
    },

    deleteItem(deletedItem: Message) {
      this.items = this.items.filter((item) => {
        return item['@id'] !== deletedItem['@id']
      })
    }
  }
})
